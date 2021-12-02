<?php

namespace App\Imports;

use App\Model\Business;
use App\Model\Keyword\BusinessKeyword;
use App\Model\Keyword\GlobalKeyword;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class BusinessKeywords implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $errorsFound;
    private $rowNumber = 1;
    private $importedNum = 0;

    public function collection(\Illuminate\Support\Collection $collection)
    {
        foreach ($collection as $row) {
            ++$this->rowNumber;
            $business_list = Business::whereNull('deleted_at')->where('legal_name', $row['legal_name'])->where('eid', $row['eid'])->where('phone', $row['phone'])->first();
            if ($row['legal_name'] != null & $row['phone'] != null & $row['eid'] != null) {
                if (!empty($business_list)) {
                    if ($row['keywords'] != null) {
                        foreach (explode(',', $row['keywords']) as $rowItem) {
                            if (trim($rowItem) != null) {

                                ++$this->importedNum;
                                $global = GlobalKeyword::whereNull('deleted_at')->where('name', trim($rowItem))->first();
                                $business = Business::whereNull('deleted_at')->where('legal_name', $row['legal_name'])->where('phone', $row['phone'])->first();
                                if (!empty($global)) {
                                    $businessKeywords = BusinessKeyword::whereNull('deleted_at')->where('business_id', $business->id)->first();
                                    if (empty($businessKeywords)) {
                                        BusinessKeyword::create([
                                            'business_id' => $business->id,
                                            'global_keyword_id' => $global->id
                                        ]);
                                    } else {
                                        $businessKeywords_b = BusinessKeyword::whereNull('deleted_at')->where('business_id', $business->id)->where('global_keyword_id', $global->id)->first();
                                        if (empty($businessKeywords_b)) {
                                            BusinessKeyword::create([
                                                'business_id' => $business->id,
                                                'global_keyword_id' => $global->id
                                            ]);
                                        }
                                    }
                                } else {
                                    GlobalKeyword::create(['name' => trim($rowItem), 'created_by' => auth()->user()->id]);
                                    $g = GlobalKeyword::whereNull('deleted_at')->orderBy('id', 'DESC')->first();
                                    BusinessKeyword::create([
                                        'business_id' => $business->id,
                                        'global_keyword_id' => $g->id
                                    ]);
                                }
                            }
                        }
                    } else {
                        $this->errorsFound[] = [
                            'row' => $this->rowNumber,
                            'errorMessage' => 'Missing keywords',
                            'legal_name' => $row['legal_name'],
                            'eid' => $row['eid'],
                            'phone' => $row['phone'],
                            'keywords' => $row['keywords'],
                            // 'business_category' => $row['business_category'],
                            'status' => 'missing'
                        ];
                    }
                } else {
                    $this->errorsFound[] = [
                        'row' => $this->rowNumber,
                        'errorMessage' => 'No business found',
                        'legal_name' => $row['legal_name'],
                        'eid' => $row['eid'],
                        'phone' => $row['phone'],
                        'keywords' => $row['keywords'],
                        // 'business_category' => $row['business_category'],
                        'status' => 'noBusiness'
                    ];
                }
            } else {
                $this->errorsFound[] = [
                    'row' => $this->rowNumber,
                    'errorMessage' => 'Missing fields (Legal Name, EID, Phone)',
                    'legal_name' => $row['legal_name'],
                    'eid' => $row['eid'],
                    'phone' => $row['phone'],
                    'keywords' => $row['keywords'],
                    // 'business_category' => $row['business_category'],
                    'status' => 'missing'
                ];
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.legal_name' => function ($attribute, $value, $onFailure) {
                if ($value == null) {
                    $onFailure('Legal name is required.');
                } else {
                    $business = Business::where('legal_name', $value)->first();
                    if (empty($business)) {
                        $onFailure('No business found!');
                    }
                }
            },
            '*.phone' => ['required'],
            '*.keywords' => ['required']
        ];
    }


    public function chunkSize(): int
    {
        return 60;
    }

    public function getErrorsKeywords()
    {
        return $this->errorsFound;
    }
    public function getNumberOfImported()
    {
        return $this->importedNum;
    }
}
