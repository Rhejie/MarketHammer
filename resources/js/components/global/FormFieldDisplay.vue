<template>
    <div>
        <div class="form-field-display-layout">
            <el-row :gutter = "20" class = "">
                <el-col v-for="(formInput, index) in formFields" :key="index" :span = "formInput.field_type == 'Matrix' || formInput.field_type == 'Instruction'  ? 24 : 12">
                    <div class="form-builder-form-content-input">
                        <template  v-if = "formInput.field_type == 'Multiple Checkboxes' || formInput.field_type == 'Radio Select'">
                            <el-row :gutter = "20" class = "">
                                <el-col :span = "12">
                                    <label>{{ formInput.field_label }}</label>  
                                </el-col>
                                <el-col :span = "12">
                                    <element-field
                                        :field-type = "formInput.field_type"
                                        :field-label = "formInput.field_label"
                                        :field-value.sync = "formInput.field_answer_value"
                                        :field-options = "formInput.field_options"
                                        :form-field-data = "formInput"
                                        :form-fields-list = "formFields"
                                        :disabled = "formDisabled"
                                        page-type='FormAnswer'>
                                    </element-field>
                                </el-col>
                            </el-row>
                        </template>
                        <template v-else>
                            <label v-if = "formInput.field_type != 'Single Checkbox'">{{ formInput.field_label }}</label>
                           <template v-if = "formInput.field_type == 'Matrix'">
                                <element-matrix  :options-list = "formInput.field_options" :value-data = "formInput.field_answer_value"
                                    :allow-to-remove = "formInput.field_settings && formInput.field_settings.defaultValue && formInput.field_settings.defaultValue.length > 0 ? false : true" :disabled = "formDisabled"></element-matrix>
                            </template>
                           <template v-else>
                                <element-field
                                    :field-type = "formInput.field_type"
                                    :field-label = "formInput.field_label"
                                    :field-value.sync = "formInput.field_answer_value"
                                    :field-options = "formInput.field_options"
                                    :form-field-data = "formInput"
                                    :form-fields-list = "formFields"
                                    :disabled = "formDisabled"
                                    page-type='FormAnswer'>
                                </element-field>
                            </template>
                        </template>
                    </div>
                </el-col>
            </el-row>
        </div>
    </div>
</template>
<script>
import _forEach from "lodash/forEach";
export default {
    props: {
        fieldsList: {
            type: Array,
            required: true
        },
        formDisabled: {
            type: Boolean,
            required: false,
            default: false
        },
    },
    data() {
        return {
            sample: "",
            formFields: this.fieldsList,
        };
    },
    created() {
        
    },
    methods: {},
    watch: {
        fieldsList(newVal){
            this.formFields = this.fieldsList
        }
    },
    computed:{
        stateList(){

        }
    }
};
</script>
