<?php

namespace App\Imports;

use App\Model\Business;
use App\Model\FieldValueTranslator;
use App\Model\BusinessCategory;
use App\Model\Country;
use App\Model\Setting\AddressType;
use App\Model\Setting\FactoryType;
use App\Model\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class BusinessImportFromExcel implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $errorRow;
    private $row = 1;
    private $importedNum = 0;

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            ++$this->row;
            $bcategoryTranslation = FieldValueTranslator::whereNull('deleted_at')->where('table', 'business_category')
                ->where('value', $row['business_category'])->orWhere('lang_en', $row['business_category'])
                ->orWhere('lang_ko', $row['business_category'])
                ->orWhere('lang_jap', $row['business_category'])->orderBy('table_id', 'DESC')->first();

            $b_categories = BusinessCategory::whereNull('deleted_at')->where('name', $row['business_category'])->first();

            if ($row['phone'] != null && $row['legal_name'] != null && $row['business_category'] != null) {
                $address = $this->transformAddress($row);
                $business = Business::query()
                    ->select(DB::raw(1))
                    ->where(function ($query) use ($address, $row) {
                        $query->whereExists(function ($q) use ($address) {
                            $q->select(DB::raw(1))
                                ->from('business_address')
                                ->whereRaw('business_address.business_id=business.id')
                                ->where('business_address.address', $address);
                        })
                            ->where('business.legal_name', $row['legal_name']);
                    })
                    ->orWhere(function ($query) use ($address, $row) {
                        $query->whereExists(function($q) use ($address) {
                            $q->select(DB::raw(1))
                                ->from('business_address')
                                ->whereRaw('business_address.business_id=business.id')
                                ->where('business_address.address', $address);
                        })
                            ->where('business.phone', $row['phone']);
                    })
                    ->orWhere(function($query) use ($address, $row) {
                        $query->whereExists(function($q) use ($address) {
                            $q->select(DB::raw(1))
                                ->from('business_address')
                                ->whereRaw('business_address.business_id = business.id');
                        })
                            ->where('business.corp_ssn', $row['corp_ssn'])
                            ->where('business.eid', $row['eid']);
                    })
                    ->exists();
                if (!empty($business)) {
                    $this->errorRow[] = [
                        'errorMessage' => 'Duplicate Business',
                        'row' => $this->row,
                        'legal_name' => $row['legal_name'],
                        'eid' => $row['eid'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                        'business_category' => $row['business_category'],
                        'address_type' => $row['address_type'],
                        'factory_type' => $row['factory_type'],
                        'status' => 'duplicate'
                    ];
                } else if (empty($bcategoryTranslation) && empty($b_categories)) {
                    $this->errorRow[] = [
                        'errorMessage' => 'No Business Category found',
                        'row' => $this->row,
                        'legal_name' => $row['legal_name'],
                        'eid' => $row['eid'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                        'business_category' => $row['business_category'],
                        'address_type' => $row['address_type'],
                        'factory_type' => $row['factory_type'],
                        'status' => 'noBusiness'
                    ];
                } else {
                    ++$this->importedNum;
                    $bCategories = BusinessCategory::whereNull('deleted_at')->where('name', $row['business_category'])->orderBy('id', 'DESC')->first();
                    if (!empty($bcategoryTranslation) && empty($business)) {
                        $this->storeBusinessCategoriesFormTranslation($row, $bcategoryTranslation->table_id);
                    } else if (!empty($bCategories) && empty($business)) {

                        $business = Business::create([
                            'industry_type_id' => $bCategories->industry_type_id,
                            'business_category_id' => $bCategories->id,
                            'legal_name' => $row['legal_name'],
                            'phone' => $row['phone'],
                            'fax' => $row['fax'],
                            'eid' => $row['eid'],
                            'email' => $row['email'],
                            'corp_ssn' => $row['corp_ssn'],
                            'about_us' => $row['about_us'],
                            'website' => $row['website'],
                            'date_established' => !is_null($row['date_established']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_established']) : NULL,
                            // 'date_established' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_established']),
                        ]);

                        $this->addAddress($row, $business);

                        $this->addContact($row, $business);
                    }
                }
            } else if ($row['phone'] == null || $row['legal_name'] == null || $row['business_category'] == null) {


//                $businessEID = Business::whereNull('deleted_at')->where('eid', $row['eid'])->first();
//                $businessPhone = Business::whereNull('deleted_at')->where('phone', $row['phone'])->first();
//                $businessEID = Business::query()->whereNull('deleted_at')->where('eid', $row['eid'])->whereNotNull('eid')->first();

                if (empty($bcategoryTranslation) && empty($b_categories)) {
                    $this->errorRow[] = [
                        'errorMessage' => 'No Business Category found',
                        'row' => $this->row,
                        'legal_name' => $row['legal_name'],
                        'eid' => $row['eid'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                        'business_category' => $row['business_category'],
                        'address_type' => $row['address_type'],
                        'factory_type' => $row['factory_type'],
                        'status' => 'noBusiness'
                    ];
//                } else if (!empty($businessEID)) {
//                    $this->errorRow[] = [
//                        'errorMessage' => 'Duplicate Business',
//                        'row' => $this->row,
//                        'legal_name' => $row['legal_name'],
//                        'eid' => $row['eid'],
//                        'phone' => $row['phone'],
//                        'email' => $row['email'],
//                        'business_category' => $row['business_category'],
//                        'address_type' => $row['address_type'],
//                        'factory_type' => $row['factory_type'],
//                        'status' => 'duplicate'
//                    ];
//                } else if (!empty($businessPhone)) {
//                    $this->errorRow[] = [
//                        'errorMessage' => 'Duplicate Business',
//                        'row' => $this->row,
//                        'legal_name' => $row['legal_name'],
//                        'eid' => $row['eid'],
//                        'phone' => $row['phone'],
//                        'email' => $row['email'],
//                        'business_category' => $row['business_category'],
//                        'address_type' => $row['address_type'],
//                        'factory_type' => $row['factory_type'],
//                        'status' => 'duplicate'
//                    ];
                } else {

                    $this->errorRow[] = [
                        'errorMessage' => 'Missing Field (Legal Name, Phone, Business Category)',
                        'row' => $this->row,
                        'legal_name' => $row['legal_name'],
                        'eid' => $row['eid'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                        'business_category' => $row['business_category'],
                        'address_type' => $row['address_type'],
                        'factory_type' => $row['factory_type'],
                        'status' => 'missing'
                    ];
                }
            }
        }
    }

    public function rules(): array
    {
        return [
            // '*.legal_name' => function ($attribute, $value, $onFailure) {
            //     $business_translation = FieldValueTranslator::whereNull('deleted_at')->where('table', 'business_category')
            //         ->where('value', $value)->orWhere('lang_en', $value)->orWhere('lang_ko', $value)->orWhere('lang_jap', $value)->orderBy('table_id', 'DESC')->first();
            //     $business = Business::whereNull('deleted_at')->where('legal_name', $value)->first();
            //     if (!empty($business_translation)) {
            //         if (!empty($business)) {
            //             $onFailure('The company has been imported!');
            //         }
            //     } else if (!empty($business)) {
            //         $onFailure('The company has been imported!');
            //     }
            // },
            '*.legal_name' => ['required'],
            '*.business_category' => function ($attribute, $value, $onFailure) {
                $basic_category_translation = FieldValueTranslator::whereNull('deleted_at')->where('table', 'business_category')
                    ->where('value', $value)->orWhere('lang_en', $value)->orWhere('lang_ko', $value)->orWhere('lang_jap', $value)->orderBy('table_id', 'DESC')->first();
                $businessCategory = BusinessCategory::whereNull('deleted_at')->where('name', $value)->first();
                if (empty($basic_category_translation)) {
                    if (empty($businessCategory)) {
                        $onFailure('No business category found in system data');
                    }
                }
            },
        ];
    }

    public function chunkSize(): int
    {
        return 60;
    }

    public function storeBusinessCategoriesFormTranslation($row, $table_id)
    {
        $b = BusinessCategory::whereNull('deleted_at')->where('id', $table_id)->orderBy('id', 'DESC')->first();
        $business = Business::whereNull('deleted_at')->where('legal_name', $row['legal_name'])->where('phone', $row['phone'])->first();
        if (!empty($b) && empty($business)) {
            $business = Business::create([
                'industry_type_id' => $b->industry_type_id,
                'business_category_id' => $b->id,
                'legal_name' => $row['legal_name'],
                'phone' => $row['phone'],
                'email' => $row['email'],
//                'fax' => $row['fax'],
                'fax' => $row['fax'],
                'eid' => $row['eid'],
                'corp_ssn' => $row['corp_ssn'],
                'about_us' => $row['about_us'],
                'website' => $row['website'],
                'date_established' => !is_null($row['date_established']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_established']) : NULL,
                // 'date_established' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_established']),
            ]);


            $this->addAddress($row, $business);

            $this->addContact($row, $business);
        }
    }

    public function addAddress($row, $business)
    {
        // factory type validation
        $address_type_id = NULL;
        $factorytype_id = NULL;
        $country_name = NULL;
        $country_id = NULL;
        $state_id = 1;
        $state_name = "";
        if ($row['factory_type'] != null && $row['address_type'] != null) {
            $factory_translation = FieldValueTranslator::whereNull('deleted_at')->where('table', 'factory_type');
            $factory_type_translation = $factory_translation
                ->where('value', $row['factory_type'])
                ->orWhere('lang_en', $row['factory_type'])
                ->orWhere('lang_ko', $row['factory_type'])
                ->orWhere('lang_jap', $row['factory_type'])
                ->first();

            $factorytype = FactoryType::whereNull('deleted_at')->where('name', $row['factory_type'])->first();

            if (!empty($factory_type_translation)) {
                $factorytype_id = $factory_type_translation->table_id;
            } else if (!empty($factorytype)) {
                $factorytype_id = $factorytype->id;
            } else if ($row['factory_type'] != null) {
                $factorytype = FactoryType::create(['name' => $row['factory_type']]);
                $factory = FactoryType::orderBy('id', 'DESC')->first();
                $factorytype_id = $factory->id;
            }
            // end factory type

            // start address type
            $addressType_translation = FieldValueTranslator::whereNull('deleted_at')->where('table', 'address_type');
            $address_type_translation = $addressType_translation
                ->where('value', $row['address_type'])
                ->orWhere('lang_en', $row['address_type'])
                ->orWhere('lang_ko', $row['address_type'])
                ->orWhere('lang_jap', $row['address_type'])
                ->first();

            $addressType = AddressType::whereNull('deleted_at')->where('name', $row['address_type'])->first();
            if (!empty($address_type_translation)) {
                $address_type_id = $address_type_translation->table_id;
            } else if (!empty($addressType)) {
                $address_type_id = $addressType->id;
            } else if ($row['address_type'] != null) {
                AddressType::create(['name' => trim($row['address_type'])]);
                $address = AddressType::orderBy('id', 'DESC')->first();
                $address_type_id = $address->id;
            }
        }
        if ($row['state'] != null) {
            $state = State::where('name', $row['state'])->first();
            if (!empty($state)) {
                $state_name = $state->name;
                $state_id = $state->id;
            } else {
                $state_name = "";
                $state_id = 1;
            }
        }

        if ($row['country'] != null) {
            $country = Country::where('name', $row['country'])->first();
            if (!empty($country)) {
                $country_id = $country->id;
                $country_name = $country->name;
            } else {
                $country_id = null;
                $country_name = null;
            }
        }
        $business->businessAddress()->create([
            'address_type_id' => $address_type_id,
            'factory_type_id' => $factorytype_id,
            'lot_area_size' => $row['lot_area'],
            'address_line_1' => $row['street1'],
            'address_line_2' => null,
            'street' => null,
            'city' => $row['city'],
            'state_id' => $state_id,
            'postal' => $row['postal_code'],
            'country_id' => $country_id,
            'manufacturer_area_size' => $row['mfr_area'],
            'address' => $row['street1'] . ", " . $state_name . ", " . $country_name,
            'incidental_area_size' => null,
            'building_area_size' => null,
        ]);
    }

    public function addContact($row, $business)
    {
        if ($row['name'] != null) {
            $business->contact()->create([
                'name' => $row['name'],
                'title' => $row['title'],
                'is_primary' => 1
            ]);
        }
    }

    public function getErrorMessage()
    {
        return $this->errorRow;
    }

    public function getNumberOfImported()
    {
        return $this->importedNum;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    private function transformAddress($row): string
    {
        $stateName = !is_null($row['state']) ? $row['state'] : "";
        $countryName = !is_null($row['country']) ? $row['country'] : "";

        return $row['street1'] . ", " . $stateName . ", " . $countryName;
    }
}
