<?php

namespace App\Exports;

use App\Model\IndustryType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BusinessListExport implements FromCollection, WithEvents, WithStrictNullComparison, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $results;
    protected $plans;

    function __construct($plans) {
        $this->plans = $plans;
        $this->results = IndustryType::select('name')->get();
        // dd($this->options);
    }


    public function collection()
    {
        // store the results for later use
        // $this->results = IndustryType::select('name')->get();
        // $this->options = IndustryType::pluck('name')->toArray();
        // dd($this->options);
        return collect([]);
    }

    

    public function headings(): array
    {
        return [
            'businessName', 
            'IndustryType', 
            'Plan',
            'street',
            'city',
            'state',
            'zip'
        ];
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {

                // get layout counts (add 1 to rows for heading row)
                // $row_count = $this->results->count() + 1;
                // $column_count = count($this->results[0]->toArray());

                // set dropdown column
                $drop_column = 'B';
                $plans_column = 'C';

                // set dropdown options
                $options = [
                    'Agriculture & Forestry/Wildlife',
                    'Business & Information',
                    'Construction/Utilities/Contracting',
                    'Education',
                    'Finance & Insurance',
                    'Food & Hospitality',
                    'Gaming',
                    'Health Services',
                    'Motor Vehicle',
                    'Natural Resources/Environmental',
                    'Personal Services',
                    'Real Estate & Housing',
                ];

                // dd($options, $option);

                // set dropdown list for first data row
                $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST );
                $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Input error');
                $validation->setError('Value is not in list.');
                $validation->setPromptTitle('Pick from list');
                $validation->setPrompt('Please pick a value from the drop-down list.');
                $validation->setFormula1(sprintf('"%s"',implode(',',$options)));

                $plans = $event->sheet->getCell("{$plans_column}2")->getDataValidation();
                $plans->setType(DataValidation::TYPE_LIST );
                $plans->setErrorStyle(DataValidation::STYLE_INFORMATION );
                $plans->setAllowBlank(false);
                $plans->setShowInputMessage(true);
                $plans->setShowErrorMessage(true);
                $plans->setShowDropDown(true);
                $plans->setErrorTitle('Input error');
                $plans->setError('Value is not in list.');
                $plans->setPromptTitle('Pick from list');
                $plans->setPrompt('Please pick a value from the drop-down list.');
                $plans->setFormula1(sprintf('"%s"',implode(',',$this->plans)));


                // clone validation to remaining rows
                for ($i = 3; $i <= 50; $i++) {
                    $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                }

                for ($i = 3; $i <= 50; $i++) {
                    $event->sheet->getCell("{$plans_column}{$i}")->setDataValidation(clone $plans);
                }

            },
        ];
    }
}