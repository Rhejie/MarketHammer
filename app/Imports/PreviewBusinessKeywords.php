<?php

namespace App\Imports;

use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\FieldValueTranslator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class PreviewBusinessKeywords implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param Collection $collection
     */
    private $excelData;
    private $row = 1;
    public function collection(Collection $collection)
    {
        foreach ($collection as $rows) {
            ++$this->row;
            if ($rows['legal_name'] == null || $rows['eid'] == null || $rows['phone'] == null || $rows['keywords'] == null) {
                $hasMissing = 'hasMissing';
            } else {
                $hasMissing = null;
            }

            if ($rows['legal_name'] != null && $rows['eid'] != null && $rows['phone'] != null) {
                $business = Business::whereNull('deleted_at')
                    ->where('legal_name', $rows['legal_name'])
                    ->where('eid', $rows['eid'])
                    ->where('phone', $rows['phone'])->first();

                if (empty($business)) {
                    $status = 'undefined';
                } else {
                    $status = null;
                }
            } else {
                $status = null;
            }

            $this->excelData[] = [
                'row' => $this->row,
                'legal_name' => $rows['legal_name'],
                // 'fax' => $rows['fax'],
                'eid' => $rows['eid'],
                'phone' => $rows['phone'],
                // 'business_category' => $rows['business_category'],
                'keywords' => $rows['keywords'],
                'hasMissing' => $hasMissing,
                'status' => $status
            ];
        }
    }

    public function chunkSize(): int
    {
        return 60;
    }


    public function getData()
    {
        return $this->excelData;
    }

    public function rules(): array
    {
        return [
            '*.legal_name' => ['required'],
            // '*.business_category' => ['required'],
            '*.phone' => ['required'],
            '*.eid' => ['required'],
            '*.keywords' => ['required'],
        ];
    }
}
