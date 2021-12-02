<?php

namespace App\Repositories\FormField;

use App\Repositories\Repository;
use App\Model\FormField\FormField;
use App\Model\Country;
use App\Repositories\Category\BusinessCategoryRepository;
use App\Repositories\SystemData\{ContactRoleRepository, StateRepository, EmployeeCountRepository};
use App\Model\{BusinessCategory, State, EmployeeCount};
use App\Model\Setting\ContactRole;


class FormFieldRepository extends Repository
{
	public function __construct(FormField $model)
    {
        parent::__construct($model);
        $this->businessCategoryRepository = new BusinessCategoryRepository( new BusinessCategory);
        $this->contactRoleRepository = new ContactRoleRepository(new ContactRole);
        $this->stateRepository = new StateRepository(new State);
        $this->employeeCount = new EmployeeCountRepository(new EmployeeCount);

    }

    /**
     * Override parent create functionality.
     *
     * @param $data <array> - post inforation
     *
     * @return <object || boolean>
     */
    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->form_field_group_id = $data['form_field_group_id'];
            $model->field_label = $data['field_label'];
            $model->field_type = $data['field_type'];
            $model->field_description = $data['field_description'];
            $model->source_table = $data['source_table'];
            $model->field_options = $data['field_options'] ? json_encode($data['field_options']) : null;
            $model->is_link_to_table = $data['is_link_to_table'];
            $model->table_name = $data['table_name'];
            $model->table_column = $data['table_column'];
            $model->created_by = auth()->user()->id;
            $model->created_at = __utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->get($model->id);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return false;
    }

    /**
     * Override parent update functionality.
     *
     * @param $id <int>
     * @param $data <array>
     *
     * @return <object || boolean>
     */
    public function update(array $data, $id)
    {
        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->form_field_group_id = $data['form_field_group_id'];
                $model->field_label = $data['field_label'];
                $model->field_type = $data['field_type'];
                $model->field_description = $data['field_description'];
                $model->source_table = $data['source_table'];
                $model->field_options = $data['field_options'] ? json_encode($data['field_options']) : null;
                $model->is_link_to_table = $data['is_link_to_table'];
                $model->table_name = $data['table_name'];
                $model->table_column = $data['table_column'];
                $model->updated_by = auth()->user()->id;
                $model->updated_at = __utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    return $this->get($model->id);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }

    /**
     * Retrieve the service data that form field module will be using
     *
     * field_types - the static field types information
     * currencies - the currencies from the countries table
     *
     * @return <array>
     * */
    public function fetchComponentServiceData()
    {
        return response()->json([
            'field_types' => $this->getFieldTypeList()
        ]);
    }

    /**
     * Retrieve list of types. Make sure if you update this list update also the `field-type-list.js` file so they could have the same content
     *
     * @return <array>
     */
    public function getFieldTypeList() {
        $fieldTypeList = [
            [
                'id' => 1,
                'label' => 'Single Text',
                'value' => 'Single Text',
                'type' => 'single',
                'value_type' => 'single',
                'separate' => false,
                'disabled' => false
            ],
            [
                'id' => 2,
                'label' => 'Multiline Text',
                'value' => 'Multiline Text',
                'type' => 'single',
                'value_type' => 'single',
                'separate' => false,
                'disabled' => false
            ],
            [
                'id' => 3,
                'label' => 'Single Checkbox',
                'value' => 'Single Checkbox',
                'type' => 'single',
                'value_type' => 'single',
                'separate' => true,
                'disabled' => false
            ],
            [
                'id' => 4,
                'label' => 'Multiple Checkboxes',
                'value' => 'Multiple Checkboxes',
                'type' => 'option',
                'value_type' => 'multiple',
                'separate' => true,
                'disabled' => false
            ],
            [
                'id' => 5,
                'label' => 'Radio Select',
                'value' => 'Radio Select',
                'type' => 'option',
                'value_type' => 'single',
                'separate' => true,
                'disabled' => false
            ],
            [
                'id' => 6,
                'label' => 'Dropdown Select',
                'value' => 'Dropdown Select',
                'type' => 'option',
                'value_type' => 'single',
                'separate' => true,
                'disabled' => false
            ],
            [
                'id' => 7,
                'label' => 'Number',
                'options' => [
                    [
                        'id' => 8,
                        'label' => 'Formatted Number',
                        'value' => 'Formatted Number',
                        'type' => 'single',
                        'value_type' => 'single',
                        'separate' => false,
                        'disabled' => false
                    ],
                    [
                        'id' => 9,
                        'label' => 'Unformatted Number',
                        'value' => 'Unformatted Number',
                        'type' => 'single',
                        'value_type' => 'single',
                        'separate' => false,
                        'disabled' => false
                    ],
                    [
                        'id' => 10,
                        'label' => 'Currency',
                        'value' => 'Currency',
                        'type' => 'option',
                        'value_type' => 'single',
                        'separate' => false,
                        'disabled' => false
                    ],
                ]
            ],
            [
                'id' => 11,
                'label' => 'File',
                'value' => 'File',
                'type' => 'single',
                'value_type' => 'multiple',
                'separate' => true,
                'disabled' => false
            ],
            [
                'id' => 12,
                'label' => 'Matrix',
                'value' => 'Matrix',
                'type' => 'matrix',
                'value_type' => 'matrix',
                'separate' => true,
                'option_reference' => $this->getMatrixOptions(),
                'disabled' => false
            ],
            [
                'id' => 13,
                'label' => 'Instruction',
                'value' => 'Instruction',
                'type' => 'single',
                'value_type' => 'single',
                'separate' => false,
                'disabled' => true
            ],
        ];

        return $fieldTypeList;
    }

    /**
     * Retrieve list of option for matrix type. If you update this method make sure to also update the `matrix-options.js` file so they can have the same content
     * <value> must be name of the table.
     * <columns> <value> must be the name of the column from selected table
     * <columns> <type> the value of the field type for that column.
     * <columns> <option> other options for that column. Like the reference for type 'dropdown'
     * @return <array>
     */
    public function getMatrixOptions(){
        $options = [
            [
                'id' => 0,
                'label' => 'Define',
                'value' => null,
                'columns' => [],
            ],
            [
                'id' => 1,
                'label' => 'Business Contact',
                'value' => 'business_contact',
                'columns' => [
                    [
                        'label' => 'Title',
                        'value' => 'title',
                        'type' => 'Single Text',
                    ],
                    [
                        'label' => 'Name',
                        'value' => 'name',
                        'type' => 'Single Text',
                    ],
                    /*[
                        'label' => 'Role',
                        'value' => 'role_id',
                        'type' => 'Dropdown Select',
                        'type_option' => ['source_table' => 'contact_role', 'field_options' => []]
                    ],*/
                    [
                        'label' => 'Email',
                        'value' => 'email',
                        'type' => 'Single Text',
                    ],
                    [
                        'label' => 'Phone',
                        'value' => 'phone',
                        'type' => 'Single Text'
                    ]
                ]
            ],

            [
                'id' => 2,
                'label' => 'Business Revenue',
                'value' => 'business_finances',
                'columns' => [
                    [
                        'label' => 'Year',
                        'value' => 'year',
                        'type' => 'Unformatted Number',
                    ],
                    [
                        'label' => 'Revenue',
                        'value' => 'revenue',
                        'type' => 'Formatted Number',
                    ],
                    [
                        'label' => 'Ebit',
                        'value' => 'ebit',
                        'type' => 'Unformatted Number',
                    ]
                ]
            ],

            [
                'id' => 3,
                'label' => 'Business Partners',
                'value' => 'business_partner',
                'columns' => [
                    [
                        'label' => 'Company Name',
                        'value' => 'company_name',
                        'type' => 'Single Text',
                    ],
                    [
                        'label' => 'Type',
                        'value' => 'type',
                        'type' => 'Single Text',
                    ],
                    [
                        'label' => 'Website',
                        'value' => 'website',
                        'type' => 'Single Text',
                    ],
                    [
                        'label' => 'Contact Person',
                        'value' => 'contact_person',
                        'type' => 'Single Text',
                    ],
                    [
                        'label' => 'Contact Email',
                        'value' => 'contact_email',
                        'type' => 'Single Text',
                    ],
                    [
                        'label' => 'Contact Phone',
                        'value' => 'contact_phone',
                        'type' => 'Single Text',
                    ]
                ]
            ],
        ];
        return $options;
    }

    /**
     * List of option references. If you update this method, make sure to also update the `option-references.js` file so they can have the same content
     *
     * @return <array>
     * */
    public function getOptionReferences()
    {
        $optionReferences = [
            [
                'id' => 1,
                'label' => 'Define',
                'value' => null
            ],
            [
                'id' => 2,
                'label' => 'Business Category',
                'value' => 'business_category'
            ],
            [
                'id' => 3,
                'label' => 'Contact Role',
                'value' => 'contact_role'
            ],
            [
                'id' => 4,
                'label' => 'Countries',
                'value' => 'country'
            ],
            [
                'id' => 5,
                'label' => 'States',
                'value' => 'state'
            ],
            [
                'id' => 6,
                'label' => 'Number of Employees',
                'value' => 'employee_count'
            ],
        ];

        //$optionReferences = \DB::select('SHOW TABLES');

        return $optionReferences;
    }

    public function getFields($name)
    {
        $fields = '';
        if ($name == 'Country')
        {
            $fields = Country::get(['id AS key', 'name AS label', 'country_code AS value'])
            ->toArray();
        }
        return $fields;
    }

    /**
     * Retrieve list of available DB table for connection and columns
     *
     * value: <table name> <column name> make sure that table name and column name exist
     * is_new_entry = will save submitted answer as new entry. Will check first for all columns if exist on the form
     * @return <array>
     */
    public function getTableWithColumns()
    {
        return [
            [
                'value' => 'business',
                'label' => __('Business'),
                'is_new_entry' => false,
                'columns' => [
                    [
                        'value' => 'legal_name',
                        'label' => __('Legal Name')
                    ],
                    [
                        'value' => 'english_name',
                        'label' => __('English Name')
                    ],
                    [
                        'value' => 'dba',
                        'label' => __('DBA Name')
                    ],
                    [
                        'value' => 'date_established',
                        'label' => __('Date Established')
                    ],
                    [
                        'value' => 'website',
                        'label' => __('Website')
                    ],
                    [
                        'value' => 'about_us',
                        'label' => __('About Us')
                    ],
                    [
                        'value' => 'email',
                        'label' => __('Email')
                    ],
                    [
                        'value' => 'phone',
                        'label' => __('Phone')
                    ],
                    [
                        'value' => 'fax',
                        'label' => __('Fax')
                    ],
                    [
                        'value' => 'business_category_id',
                        'label' => __('Business Category')
                    ],
                    [
                        'value' => 'employee_count_id',
                        'label' => __('Employee Count')
                    ],
                ]
            ],
            [
                'value' => 'business_address',
                'label' => __('Business Address'),
                'is_new_entry' => true,
                'columns' => [
                    [
                        'value' => 'address_line_1',
                        'label' => __('Street Line 1')
                    ],
                    [
                        'value' => 'address_line_2',
                        'label' => __('Street Line 2')
                    ],
                    [
                        'value' => 'city',
                        'label' => __('City')
                    ],
                    [
                        'value' => 'state_id',
                        'label' => __('State')
                    ],
                    [
                        'value' => 'country_id',
                        'label' => __('Country')
                    ],
                    [
                        'value' => 'address',
                        'label' => __('Address')
                    ],
                    [
                        'value' => 'phone',
                        'label' => __('Phone')
                    ]
                ]
            ]
        ];
    }

    /**
     * check if the given item exists to the available DB table and column
     * where data should be pre-fetched.
     *
     * @param $table <string>
     * @param $column <string>
     *
     * @return <boolean>
     */
    public function checkIfTableAndColumnExist($table, $column, $onlyTable = false)
    {
        $fields = $this->getTableWithColumns();

        $tableIndex = array_search($table, array_column($fields, 'value'));

        if ($tableIndex !== false) {
            if ($onlyTable) {
                return true;
            }

            $columnIndex = array_search($column, array_column($fields[$tableIndex]['columns'], 'value'));

            if ($columnIndex !== false) {
                return true;
            }
        }

        return false;
    }

    public function getPropertyTable($table , $key)
    {
        $fields = $this->getTableWithColumns();

        $tableIndex = array_search($table, array_column($fields, 'value'));

        if ($tableIndex !== false) {
            return $fields[$tableIndex][$key];
        }

        return false;
    }


    public function getPropertyFieldType($property_field, $key = 'type') {
        $field_type = null;

        foreach($this->getFieldTypeList() as $field) {
            if(array_key_exists('options', $field)) {
                foreach($field['options'] as $option) {
                    if($option['value'] == $property_field) {
                        $field_type = $option[$key];
                    }
                }
            }else{
                if($field['value'] == $property_field) {
                    $field_type = $field[$key];
                }
            }
        }

        return $field_type;
    }

    public function optionFromDatabase($table){
        $list = [];
        if($table == 'business_category'){
            $getList = $this->businessCategoryRepository->model();
            $getList = $getList->select(['id as value', 'name as label']);
            $getList = $getList->whereNotNull('master_business_category_id')
                        ->whereNotNull('main_business_category_id')
                        ->whereNotNull('sub_business_category_id')
                        ->get()->toArray();

            $list = $getList;
        }

        else if($table == 'contact_role'){
            $getList = $this->contactRoleRepository->model();
            $getList = $getList->select(['id as value', 'name as label'])->get()->toArray();

            $list = $getList;
        }
        else if($table == 'country'){
            $list = __get_country_list(['id as value', 'name as label']);
        }
        else if($table == 'state'){
            $getList = $this->stateRepository->model();
            $getList = $getList->select(['id as value', 'name as label', 'country_id'])->get()->toArray();

            $list = $getList;
        }
        else if($table == 'employee_count'){
            $getList = $this->employeeCount->model();
            $getList = $getList->select(['id as value', 'name as label'])->get()->toArray();
            $list = $getList;
        }

        return $list;

    }

    public function getFormFields($params){
        $fieldsList = $this->model()->with(['translations']);

        if(isset($params->form_field_group_id)){
            $fieldsList = $fieldsList->where(['form_fields.form_field_group_id' => $params->form_field_group_id]);
        }

        $fieldsList = $fieldsList->get()->toArray();

        foreach ($fieldsList as $key => $field) {
            $fieldsList[$key]['field_original_options'] = $field['field_options'];

            $getPropertyType = $this->getPropertyFieldType($field['field_type']);
            if($getPropertyType == 'option'){

                if(isset($field['source_table']) && $field['field_options'] == null){
                    $optionList = $this->optionFromDatabase($field['source_table']);
                    $fieldsList[$key]['field_options'] = $optionList;
                }
            }

            elseif($getPropertyType == 'matrix'){
                $columns = (array) $field['field_options'];
                if(count($columns) > 0){
                    foreach ($columns as $keyCol => $cols) {
                        $cols = (array)$cols;
                        if(isset($cols['type'])){
                            $colPropertyType = $this->getPropertyFieldType($cols['type']);
                            if($colPropertyType == 'option'){

                                $type_option = isset($cols['type_option']) ? (array)$cols['type_option'] : null;
                                if($type_option){
                                    if(isset($type_option['source_table']) &&
                                        ($type_option['field_options'] == null || count($type_option['field_options']) == 0) ){
                                        $colOptionList = $this->optionFromDatabase($type_option['source_table']);
                                        $type_option['field_options'] = $colOptionList;
                                    }
                                    $cols['field_options'] = $type_option['field_options'];
                                }
                            }
                            $columns[$keyCol] = $cols;
                        }
                    }
                }
                $fieldsList[$key]['field_options'] = $columns;
            }


            $getPropertyValueType = $this->getPropertyFieldType($field['field_type'], 'value_type');
            $getPropertyValue = $this->getPropertyFieldType($field['field_type'], 'value');

            //Set field_answer_value
            if($getPropertyValueType == 'multiple' || $getPropertyValueType == 'matrix') {
                $fieldsList[$key]['field_answer_value'] = [];
            }
            else if($getPropertyValue == 'Single Checkbox') {
                $fieldsList[$key]['field_answer_value'] = false;
            }
            else{
                $fieldsList[$key]['field_answer_value'] = null;
            }
        }

        return $fieldsList;
    }
}
