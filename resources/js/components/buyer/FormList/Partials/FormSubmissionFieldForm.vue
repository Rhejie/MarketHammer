<template>
    <el-dialog
        class = "form-field-form"
        :visible.sync="showDialog"
        @close="closeForm"
        :title="hasModel ? __('Update Form Builder Field') : __('Add New Form Builder Field')"
        width="40%"
        top="4vh">
        <el-form
            v-loading="loading"
            :rules="rules"
            :model="formFieldForm"
            ref="formFieldForm"
            autocomplete="off"
            label-position="top">
            <div class="row">
                <div class="col-md-6">
                    <el-form-item 
                        :label="__('Form Group')" 
                        prop="form_submission_group_id">
                        <el-select
                            class="full-width round-input"
                            :placeholder="__('Select Group')"
                            filterable
                            clearable
                            v-model="formFieldForm.form_submission_group_id">
                            <el-option
                                v-for="group in formGroups"
                                :label="group.name"
                                :value="group.id"
                                :key="group.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </div>

                <div class="col-md-6">
                    <el-form-item 
                        :label="__('Field Type')" 
                        prop="field_type">
                        <el-select
                            class="full-width round-input"
                            :placeholder="__('Select Field Type')"
                            filterable
                            clearable
                            @change="fieldTypeChange"
                            v-model="formFieldForm.field_type">
                            <template v-for="type in typeList">
                                <el-option-group
                                    v-if="type.options && type.options.length"
                                    :key="type.id"
                                    :label="type.label">
                                    <el-option
                                        v-for="option in type.options"
                                        :label="option.label"
                                        :value="option.value"
                                        :key="option.id">
                                    </el-option>
                                </el-option-group>

                                <el-option
                                    v-else
                                    :label="type.label"
                                    :value="type.value"
                                    :key="type.id">
                                </el-option>
                            </template>
                            
                        </el-select>
                    </el-form-item>
                </div>
            </div>

            <!-- Start Option Reference -->
            <el-form-item
                v-if="selectedType && selectedType.type === 'option'"
                prop="source_table"
                :label="__('Option Reference')"
            >
                <el-select
                    class="full-width round-input"
                    :placeholder="__('Define')"
                    filterable
                    clearable
                    @change="sourceChange"
                    v-model="formFieldForm.source_table"
                >
                    <el-option
                        v-for="option in listOption"
                        :label="option.label"
                        :value="option.value"
                        :key="option.id">
                    </el-option>
                    
                </el-select>
            </el-form-item>
            <el-form-item
                v-else-if="selectedType && selectedType.type === 'matrix'"
                prop="source_table"
                :label="__('Matrix Reference')">
                <el-select
                    class="full-width round-input"
                    :placeholder="__('Define')"
                    filterable
                    clearable
                    @change = "changeMatrix"
                    v-model="formFieldForm.source_table">
                    <el-option
                        v-for="option in selectedType.option_reference"
                        :label="option.label"
                        :value="option.value"
                        :key="option.id">
                    </el-option>
                </el-select>
            </el-form-item>
            <!-- End Option Reference -->

            <!-- Add Option Button -->
            <transition name="fade">
                <el-button
                    v-if="(selectedSource && !selectedSource.value) || (selectedType.type === 'matrix' && !formFieldForm.source_table)"
                    round
                    size="mini"
                    class="btn btn-black"
                    @click="addOption(selectedType.type)">
                    <i class="fas fa-plus"> {{ __('Add Option') }} </i>
                </el-button>
            </transition>
            <!-- End of Add Option Button -->

             <!-- Field Options -->
             <template v-if = "selectedType && selectedType.type === 'option'">
                <transition-group 
                    v-if="formFieldForm.field_options.length && selectedSource && !selectedSource.value"
                    name="slide-fade" 
                    mode="in-out"
                    tag="div">
                    <div 
                        class="row"
                        v-for="(option, index) in formFieldForm.field_options"
                        :key="option.key">
                        <div class="col-md-5">
                            <el-form-item 
                                :label="__('Label')" 
                                :prop="`field_options[${index}].label`">
                                <el-input
                                    class="full-width round-input"
                                    :placeholder="__('Enter Label')"
                                    clearable
                                    v-model="option.label"
                                    >
                                </el-input>
                            </el-form-item>
                        </div>
                        <div class="col-md-5">
                            <el-form-item 
                                :label="__('Value')" 
                                :prop="`field_options[${index}].value`">
                                <el-input
                                    class="full-width round-input"
                                    :placeholder="__('Enter Value')"
                                    clearable
                                    v-model="option.value"
                                    >
                                </el-input>
                            </el-form-item>
                        </div>
                        <div class="col-md-2 d-flex">
                            <el-button
                                type="text"
                                icon="fas fa-trash-alt"
                                class="text-red"
                                @click="removeOption(option, index)">
                            </el-button>
                        </div>
                    </div>
                </transition-group>
            </template>
            <!-- End of Field Options -->

            <!-- Start Matrix Columns -->
            <template v-if = "selectedType && selectedType.type === 'matrix' && formFieldForm.field_options.length">
                <div class="row mg-t-10 option-header">
                    <div class="col-md-4">
                        <span>{{__('Label')}}</span>
                    </div>
                    <div class="col-md-4">
                        <span>{{__('Value')}}</span>
                    </div>
                    <div class="col-md-4">
                        <span>{{__('Type')}}</span>
                    </div>
                </div>
                <transition-group 
                    v-if="formFieldForm.field_options.length"
                    name="slide-fade" 
                    mode="in-out"
                    tag="tbody">
                    <div 
                        class="row option-list"
                        v-for="(option, index) in formFieldForm.field_options"
                        :key="option.key">
                        <div class="col-md-4">
                            <el-form-item >
                                <el-input
                                    class="full-width round-input"
                                    :placeholder="__('Enter Label')"
                                    clearable
                                    v-model="option.label">
                                </el-input>
                            </el-form-item>
                        </div>
                        <div :class="formFieldForm.source_table ? 'col-md-4' : 'col-md-3'">
                            <el-form-item >
                                <el-input
                                    class="full-width round-input"
                                    :placeholder="__('Enter Value')"
                                    :disabled = "disableField"
                                    clearable
                                    v-model="option.value">
                                </el-input>
                            </el-form-item>
                        </div>

                        <div class="col-md-4">
                            <el-form-item >
                                <el-select
                                    class="full-width round-input"
                                    :placeholder="__('Select Field Type')"
                                    filterable
                                    :disabled = "disableField"
                                    clearable
                                    v-model="option.type">
                                    <template v-for="type in typeList" v-if = "type.value !== 'Matrix'">
                                        <el-option-group
                                            v-if="type.options && type.options.length"
                                            :key="type.id"
                                            :label="type.label">
                                            <el-option
                                                v-for="option in type.options"
                                                :label="option.label"
                                                :value="option.value"
                                                :key="option.id">
                                            </el-option>
                                        </el-option-group>

                                        <el-option
                                            v-else
                                            :label="type.label"
                                            :value="type.value"
                                            :key="type.id">
                                        </el-option>
                                    </template>
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-md-1 d-flex" v-if = "!formFieldForm.source_table">
                            <el-button
                                type="text"
                                icon="fas fa-trash-alt"
                                class="text-red"
                                @click="removeOption(option, index)">
                            </el-button>
                        </div>
                        <div class="col-md-12 section-option" v-if = "getField(option.type, 'type') == 'option'">
                            <form-field-form-options :type = "option.type" 
                                :option-list = "listOption" 
                                :option-form.sync = "option.type_option"
                                :disabled = "disableField">
                            </form-field-form-options>
                        </div>
                    </div>
                </transition-group>
            </template>
            <!-- End Matrix Columns -->

            <!-- Undo Section -->
            <transition name="fade">
                <div 
                    v-if="showUndo" 
                    class="mt-3">
                    <el-button
                        type="text"
                        @click="triggerUndo">
                        <i class="fas fa-undo-alt"> {{ __('Undo') }} </i>
                    </el-button>

                     <el-button
                        type="text"
                        class="text-red"
                        @click="closeUndo">
                        <i class="text-red fas fa-times-circle"> {{ __('Close') }} </i>
                    </el-button>
                </div>
            </transition>
            <!-- End of Undo Section -->

            <el-form-item 
                :label="__('Label')" 
                prop="field_label">
                <el-input
                    class="full-width round-input"
                    :placeholder="__('Enter Label')"
                    clearable
                    v-model="formFieldForm.field_label">
                </el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('field_label', formFieldForm.field_label, 'text')">
                </value-translator-btn>
            </el-form-item>

            <template v-if = "allowToLink">
                <el-form-item
                    :label="__('Link To Table')">
                    <el-switch v-model="formFieldForm.is_link_to_table" :disabled = "formFieldForm.field_type === 'Matrix'"></el-switch>
                </el-form-item>

                <template v-if="formFieldForm.is_link_to_table && formFieldForm.field_type !== 'Matrix'">
                    <el-form-item
                        :label="__('Table & Column')"
                        :rules="{
                            required: true,
                            validator: validateTableConnection,
                            trigger: 'change'                  
                        }"
                        prop="table_column">
                        <el-cascader 
                            :options="dbConnectionOptions"
                            class="full-width"
                            @change="tableConnectionChange"
                            clearable>
                            <template slot-scope="{ node, data }">
                                <span>{{ data.label }}</span>
                                <span v-if="!node.isLeaf"> ({{ data.children.length }}) </span>
                            </template>
                        </el-cascader>
                    </el-form-item>
                </template>
            </template>

            <el-form-item 
                :label="__('Description')" 
                prop="field_description">
                <el-input
                    class="full-width round-input"
                    :placeholder="__('Enter Description')"
                    type="textarea"
                    :rows="4"
                    v-model="formFieldForm.field_description">
                </el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('field_description', formFieldForm.field_description, 'textarea')">
                </value-translator-btn>
            </el-form-item>

           
        </el-form>

        <span slot="footer" class="dialog-footer">
            <el-button type="text" class="text-black" @click="closeForm">
                <u>{{ __("Cancel") }}</u>
            </el-button>
            <el-button
                round
                @click="validateForm"
                type="primary"
                class="btn btn-black">
                {{ hasModel ? __('Save') : __('Create') }}
            </el-button>
        </span>
        <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData">
        </value-translator-form>
    </el-dialog>
</template>

<script>
import cloneDeep from "lodash/cloneDeep";
import _forEach from "lodash/forEach";
import { formHelper } from "../../../../mixins/formHelper";
import { dialogComponent } from "../../../../mixins/dialogComponent";
import translationForm from "../../../../mixins/translationForm.js";
import { fieldTypeList } from '../../../../constants/field-type-list'
import { optionReferences } from '../../../../constants/option-references'

export default {
    name: "FormFieldForm",
    mixins: [formHelper, dialogComponent, translationForm],
    props: {
        model: {},
        formGroups: {
            required: true,
            type: Array
        },
        submissionId: {
        	required: true
        },
        pageData: {
            required: false,
            type: Object,
            default() {
                return {}
            }
        },
        loadedFromTemplate: {}
    },
    data() {
        return {
            typeList: fieldTypeList,
            formFieldForm: {
                id: null,
                form_submission_id: this.submissionId,
                form_submission_group_id: null,
                field_label: null,
                field_type: null,
                field_description: null,
                field_options: [],
                is_link_to_table: false,
                table_name: null,
                table_column: null,
                source_table: null,
            },
            rules: {
                form_submission_group_id: {required: true, message: this.__("This field is required"), trigger: "change"},
                field_label: {required: true, message: this.__("This field is required"), trigger: "blur"},
                field_type: {required: true, message: this.__("This field is required"), trigger: "change"},
                //source_table: {required: true, message: this.__("This field is required"), trigger: "change"},
                field_options: {required: true, message: this.__("This field is required"), trigger: "change"},
            },
            
            fieldsList: [],
            showUndo: false,
            loading: false,
            prevSlicedItem: {},
            listOption : optionReferences,
            dbConnectionOptions: [
                {
                    value: 'business',
                    label: this.__('Business'),
                    children: [
                        {
                            value: 'legal_name',
                            label: this.__('Legal Name')
                        },
                        {
                            value: 'english_name',
                            label: this.__('English Name')
                        },
                        {
                            value: 'dba',
                            label: this.__('DBA')
                        },
                        {
                            value: 'date_established',
                            label: this.__('Date Established')
                        },
                        {
                            value: 'website',
                            label: this.__('Website')
                        },
                        {
                            value: 'about_us',
                            label: this.__('About Us')
                        },
                        {
                            value: 'email',
                            label: this.__('Email')
                        },
                        {
                            value: 'phone',
                            label: this.__('Phone')
                        },
                        {
                            value: 'fax',
                            label: this.__('Fax')
                        }
                    ]
                },
                {
                    value: 'business_address',
                    label: this.__('Business Address'),
                    children: [
                        {
                            value: 'address_line_1',
                            label: this.__('Street Line 1')
                        },
                        {
                            value: 'address_line_2',
                            label: this.__('Street Line 2')
                        },
                        {
                            value: 'city',
                            label: this.__('City')
                        },
                        {
                            value: 'state',
                            label: this.__('State')
                        },
                        {
                            value: 'country_id',
                            label: this.__('Country')
                        },
                        {
                            value: 'address',
                            label: this.__('Address')
                        },
                        {
                            value: 'phone',
                            label: this.__('Phone')
                        },
                    ]
                }
            ]
        };
    },
    created() {
        this.formFields = ["field_label", "field_description"];
        this.fromTable = "form_fields";

        if (this.model && this.model.id) {
            this.formFieldForm = {
                id: this.model.id,
                form_submission_id: this.model.form_submission_id,
                form_submission_group_id: this.model.form_submission_group_id,
                field_label: this.model.field_label,
                field_type: this.model.field_type,
                field_description: this.model.field_description,
                field_options: this.model.field_options || [],
                is_link_to_table: this.model.is_link_to_table == 1 ? true : false,
                table_name: this.model.table_name,
                table_column: this.model.table_column,
                source_table: this.model.source_table,
            }

            this.populateDefault(cloneDeep(this.model.translations))
        }

        //this.getFields();
    },
    methods: {
        changeMatrix(val){
            let getRef = []
            if(this.selectedType && this.selectedType.option_reference){
                let option_reference = this.selectedType.option_reference.find(fn => fn.value == val)
                if(option_reference && option_reference.columns){
                    _forEach(cloneDeep(option_reference.columns), (fn, fnIndex) =>{
                        fn.key = Date.now() + fnIndex
                        getRef.push(fn)
                    })
                }
                
            }

            if(this.selectedType.option_reference){
                this.formFieldForm.is_link_to_table = true
            }

            this.formFieldForm.field_options = getRef
        },
        getField(value, index){
            let type = this.typeList.find(fn => {return fn.value == value})
            return type && type[index] ?  type[index] : null
        },
        validateForm() {
            this.$refs.formFieldForm.validate(valid => {
                if (valid) {
                    this.resetErrors();

                    if (this.hasModel) {
                        this.update();

                        return;
                    }

                    this.create();
                }
            });
        },
        create() {
        	let postData = cloneDeep(this.formFieldForm)
        	postData.type = this.selectedType.type
            this.setCurrrentLangDefaultValue(postData)

        	if (this.loadedFromTemplate) {
				postData.id = Date.now()
				
				this.$EventDispatcher.fire(
                    "FORM_SUBMISSION_FIELD_MODULE_ITEM_CREATED",
                    postData
                );

                this.closeForm();

				return
			}

            if(postData.field_type === 'Matrix'){
                if(postData.source_table){
                    postData.table_column = postData.source_table
                }
                else{
                    postData.is_link_to_table = false
                }
            }

            this.loading = true;

            this.$API.FormBuilderField.create(postData)
            .then(res => {
                if (res.data.data) {
                    this.$notify({
                        title: this.__("Successful"),
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });

                    this.$EventDispatcher.fire("FORM_SUBMISSION_FIELD_MODULE_ITEM_CREATED", res.data.data);

                    this.closeForm();

                    return;
                }

                this.$notify({
                    title: "Failed",
                    message: this.$msg.notif.failed_add,
                    type: "error"
                });
            })
            .catch(err => {
                console.log(err);

                this.showValidationError(err);
            })
            .finally(_ => {
                this.loading = false;
            });
        },
        update() {
            this.loading = true;

            let postData = cloneDeep(this.formFieldForm)
            postData.type = this.selectedType.type
            this.setCurrrentLangDefaultValue(postData)

            if(postData.field_type === 'Matrix' && postData.source_table){
                postData.table_column = postData.source_table
            }

            this.$API.FormBuilderField.update(postData, postData.id)
            .then(res => {
                if (res.data.data) {
                    this.$notify({
                        title: this.__("Successful"),
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });

                    this.$EventDispatcher.fire("FORM_BUILDER_FIELD_MODULE_ITEM_UPDATED", res.data.data);

                    this.closeForm();

                    return;
                }

                this.$notify({
                    title: this.__("Failed"),
                    message: this.$msg.notif.failed_update,
                    type: "error"
                });
            })
            .catch(err => {
                console.log(err);

                this.$notify({
                    title: this.__("Server Error"),
                    message: this.$msg.notif.service_error,
                    type: "error"
                });
            })
            .finally(_ => {
                this.loading = false;
            });
        },
        closeForm() {
            this.$refs.formFieldForm.clearValidate();

            this.resetForm();

            setTimeout(_ => {
                this.closeModal();
            });
        },
        resetForm() {
            this.formFieldForm = {
                id: null,
                form_submission_id: this.submissionId,
                form_submission_group_id: null,
                field_label: null,
                field_type: null,
                field_description: null,
                field_options: [],
                is_link_to_table: false,
                table_name: null,
                table_column: null,
                source_table: null,
            };
        },
        fieldTypeChange(val) {
            this.formFieldForm.field_options = [] 

            if (this.selectedType && (this.selectedType.type === 'option' || this.selectedType.type === 'matrix')) {
                this.addOption(this.selectedType.type)
            }
        },
        addOption(type = null) {
            let arr = {
                label: null,
                value: null,
                key: Date.now()
            }
            if(type == 'matrix'){
                arr.type = 'Single Text'
                arr.type_option = {
                    source_table : null,
                    field_options : []
                }
            }

            this.formFieldForm.field_options.push(arr)
        },
        removeOption(item, index) {
            if (item.value || item.label) {
                this.$confirm(this.__("Are you sure you want to remove this option?"), this.__('Confirmation'), {
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    type: 'warning',
                    confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.trackLastSliced(index, this.formFieldForm.field_options.splice(index, 1))
                })
                .catch(() => {})
            } else {
                this.trackLastSliced(index, this.formFieldForm.field_options.splice(index, 1))
            }
        },
        sourceChange() {
            if (this.selectedSource.value != null) 
            {
                this.formFieldForm.field_options = [] 
                this.trackLastSliced(index, this.formFieldForm.field_options.splice(index, 1))
            }   
        },
        trackLastSliced(index, sliced) {
            this.prevSlicedItem = {
                index: index,
                item: cloneDeep(sliced[0])
            }

            this.triggerShowUndo()
        },
        triggerShowUndo() {
            this.showUndo = true

            setTimeout(_ => {
                this.closeUndo()
            }, 10000)

            console.log('first fuck')
        },
        triggerUndo() {
            let index = this.prevSlicedItem.index
            let firstHalf = [...this.formFieldForm.field_options.slice(0, index), ...[this.prevSlicedItem.item]]

            this.formFieldForm.field_options = [...firstHalf, ...this.formFieldForm.field_options.slice(index)]

            this.closeUndo()
        },
        closeUndo() {
            this.showUndo = false
            this.prevSlicedItem = {}
        },
        tableConnectionChange(value) {
            if (Array.isArray(value)) {
                this.formFieldForm.table_name = cloneDeep(value[0])
                this.formFieldForm.table_column = cloneDeep(value[1])
            
                return
            }

            this.formFieldForm.table_name = null
            this.formFieldForm.table_column = null
        },
        validateTableConnection(rule, value, callback) {
            if (!this.formFieldForm.table_name) {
                callback(new Error(this.__('This field is required')))
            }

            if (!this.formFieldForm.table_column) {
                callback(new Error(this.__('This field is required')))
            }

            callback()
        },
        findType(array, id) {
            for (let i of array) {
                if (i.value == this.formFieldForm.field_type) {
                    return i
                }

                if (i.options && i.options.length) {
                    let type = this.findType(i.options, id)
                    if (type) {
                       return type
                    }
                }
            }

            return false
        },
        findSource(array, id) {
            for (let i of array) {
                if (i.value == this.formFieldForm.source_table) {
                    return i
                }

                if (i.options && i.options.length) {
                    let type = this.findSource(i.options, id)
                    if (type) {
                       return option
                    }
                }
            }

            return false
        }
    },
    computed: {
        hasModel() {
            return this.model && this.model.id ? true : false;
        },
        selectedType() {
            return this.findType(this.typeList)
        },
        selectedSource() {
            return this.findSource(this.listOption)
        },
        disableField(){
            return this.formFieldForm.field_type == 'Matrix' && this.formFieldForm.source_table ? true : false
        },
        allowToLink(){
            if(this.pageData && this.pageData.allowToLink !== undefined){
                return this.pageData.allowToLink
            }
            return true
        }
    }
};
</script>

<style lang="scss">
.el-color-picker__trigger {
    width: 100% !important;
}
.form-field-form{
    .section-option{
        section{
            padding: 0px 20px;
        }
    }

    .option-list{
        margin-bottom: 10px;
        .el-form-item{
            margin-bottom: 0px;
        }
    }

    .option-header{
        span{
            font-size: 12px;
        }
    }
}

</style>
