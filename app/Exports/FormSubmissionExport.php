<?php

namespace App\Exports;

use App\Model\Buyer\FormSubmissionToSupplier;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;

class FormSubmissionExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $id;
    private $headingArray;
    private $data;
    private $answer = [];

    public function __construct($id) {
        $this->id = $id;
    }

    public function headings():array {
        $formSubmissiontoSupplier = FormSubmissionToSupplier::with(['supplierData', 'fromGroup', 'answerSubmission' => function ($q) {
            $q->with(['formSubmissionFields' => function ($query) {
                $query->with('formBuilderFieldGroup');
            }]);
        }])
            ->where('status', 'submitted')->where('form_submission_id', $this->id)->where('buyer_id', auth()->user()->id)
            ->has('answerSubmission')->limit(1)->get();
            $data = [];
        foreach($formSubmissiontoSupplier as $form) {
            foreach($form->answerSubmission as $answer) {
                array_push($data, $answer->formSubmissionFields->field_label);
            }
        }

        return $data;
    }

    public function collection()
    {
        $formSubmissiontoSupplier = FormSubmissionToSupplier::with(['supplierData', 'fromGroup', 'answerSubmission'=> function ($q) {
            $q->with(['formSubmissionFields' => function ($query) {
                $query->with('formBuilderFieldGroup');
            }]);
        }])
            ->where('status', 'submitted')->where('form_submission_id', $this->id)->where('buyer_id', auth()->user()->id)
            ->has('answerSubmission')->get();

            $form = $formSubmissiontoSupplier->map(function ($q) {
                $q->answerSubmission->map(function ($ans) {
                    if($ans->formSubmissionFields->field_type === 'Matrix' && $ans->value != null) {
                        $data = str_replace(array('[', ']', '{', '}', '"'), '', $ans->value);
                        $data1 = str_replace(array(':'), ': ', $data);
                        $data2 = str_replace(array(','), ', ', $data1);
                        $ans['value'] = $data2;
                    }

                    if($ans->formSubmissionFields->source_table != null && $ans->value != null) {

                        $fromTable = DB::table($ans->formSubmissionFields->source_table)->where('id', $ans->value)->get();

                         foreach($fromTable as $form) {
                            $ans['value'] = $form->name;
                         }
                         return $ans;

                    }

                    if($ans->formSubmissionFields->field_type == 'Multiple Checkboxes' && $ans->value != null) {
                        $data = json_decode($ans->value, true);
                        $newData = str_replace(array('[', ']', '"', 'values', '{', '}', ':'), '', json_encode($data));
                        $newData1 = str_replace(array(','), ', ', $newData);
                        $ans['value'] = $newData1;
                        return $ans;
                    }
                    if($ans->formSubmissionFields->field_type == 'Single Checkbox' && $ans->value != null) {
                        if($ans->value == "1") {
                            $ans['value'] = 'Yes';
                        }
                        else {
                            $ans['value'] = 'No';
                        }
                        return $ans;
                    }
                });
                return $q;
            });

            return $form;
    }

    public function map($formSubmissiontoSupplier): array
    {
        $rows = [];

        foreach($formSubmissiontoSupplier->answerSubmission as $answer) {
            array_push($rows, $answer->value);
        }

        return $rows;
    }



}
