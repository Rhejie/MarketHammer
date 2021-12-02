<?php

namespace App\Imports;

use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\FieldValueTranslator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PreviewImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;


    private $excelData;
    private $row = 1;

    public function collection(Collection $collection)
    {

        foreach ($collection as $rows) {
            ++$this->row;
            $businessCategories = FieldValueTranslator::query()
                ->whereNull('deleted_at')
                ->where('table', 'business_category')
                ->where('value', $rows['business_category'])
                ->orWhere('lang_en', $rows['business_category'])
                ->orWhere('lang_ko', $rows['business_category'])
                ->orWhere('lang_jap', $rows['business_category'])
                ->orderBy('table_id', 'DESC')
                ->first();
            $business_cat = BusinessCategory::query()
                ->whereNull('deleted_at')
                ->where('name', $rows['business_category'])
                ->first();

            if ($rows['eid'] != null || $rows['phone'] != null) {
                $address = $this->transformAddress($rows);
                $business = Business::query()
                    ->select(DB::raw(1))
                    ->where(function ($query) use ($address, $rows) {
                        $query->whereExists(function ($q) use ($address) {
                            $q->select(DB::raw(1))
                                ->from('business_address')
                                ->whereRaw('business_address.business_id=business.id')
                                ->where('business_address.address', $address);
                        })
                            ->where('business.legal_name', $rows['legal_name']);
                    })
                    ->orWhere(function ($query) use ($address, $rows) {
                        $query->whereExists(function($q) use ($address) {
                            $q->select(DB::raw(1))
                                ->from('business_address')
                                ->whereRaw('business_address.business_id=business.id')
                                ->where('business_address.address', $address);
                        })
                            ->where('business.phone', $rows['phone']);
                    })
                    ->orWhere(function($query) use ($address, $rows) {
                        $query->whereExists(function($q) use ($address) {
                            $q->select(DB::raw(1))
                                ->from('business_address')
                                ->whereRaw('business_address.business_id = business.id');
                        })
                            ->where('business.corp_ssn', $rows['corp_ssn'])
                            ->where('business.eid', $rows['eid']);
                    })
                    ->exists();

                $res_bus = '';
                if ($business) {
                    $res_bus = 'duplicate';
                }
            } else {
                $res_bus = '';
            }

            if (!empty($businessCategories)) {
                $res = 'noError';
            } else if (!empty($business_cat)) {
                $res = 'noError';
            } else {
                $res = "hasError";
            }


            if ($rows['legal_name'] == null || $rows['phone'] == null || $rows['business_category'] == null) {
                $missing = 'hasMissing';
            } else {
                $missing = '';
            }
            $this->excelData[] = [
                'row' => $this->row,
                'legal_name' => $rows['legal_name'],
                'phone' => $rows['phone'],
                'fax' => $rows['fax'],
                'about_us' => $rows['about_us'],
                'website' => $rows['website'],
                'date_established' => date('d-m-Y', strtotime($this->transformDate($rows['date_established']))),
                'email' => $rows['email'],
                'eid' => $rows['eid'],
                'corp_ssn' => $rows['corp_ssn'],
                'business_category' => $rows['business_category'],
                'country' => $rows['country'],
                'state' => $rows['state'],
                'city' => $rows['city'],
                'postal_code' => $rows['postal_code'],
                'street1' => $rows['street1'],
                'address_type' => $rows['address_type'],
                'factory_type' => $rows['factory_type'],
                'lot_area' => $rows['lot_area'],
                'mfr_area' => $rows['mfr_area'],
                'name' => $rows['name'],
                'title' => $rows['title'],
                'errorStatusBus' => $res,
                'errorStatusDup' => $res_bus,
                'errorMissing' => $missing
            ];
        }
    }


    public function getData()
    {
        return $this->excelData;
    }

    public function getTotalRow()
    {
        return $this->row - 1;
    }

    public function rules(): array
    {
        return [
            '*.legal_name' => ['required'],
            '*.business_category' => ['required'],
            '*.phone' => ['required'],
            '*.eid' => ['required'],
        ];
    }

    public function chunkSize(): int
    {
        return 60;
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
