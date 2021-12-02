<template>
    <div class="answer_response_content">
        <div v-for="form in formData" :key="form.id">
            <div class="form_group_answer">
                {{form.name}}
                <hr>
            </div>
            <div class="row">
                <div v-for="answer in answerFromSupplier" :key="answer.id" class="answer_wrapper_response">
                    <div class="answer_content_response" v-for="ans in answer.answer_submission.filter(as => as.form_submission_fields.form_builder_field_group.name == form.name)" :key="ans.id">

                        <span v-if="ans.form_submission_fields.field_type  != 'Single Checkbox'" class="response_label">
                            {{ans.form_submission_fields.field_label}}
                        </span>

                        <el-input class="full-width" :placeholder="__('Please input')" disabled v-model="ans.value" v-if="ans.form_submission_fields.field_type == 'Single Text'"></el-input>
                        <el-input class="full-width" :placeholder="__('Please input')" disabled type="textarea" v-model="ans.value" v-if="ans.form_submission_fields.field_type == 'Multiline Text'"></el-input>

                        <el-radio-group class="full-width" disabled v-model="ans.value" v-if="ans.form_submission_fields.field_type == 'Radio Select'">
                            <el-radio v-for="radio in ans.form_submission_fields.field_options" :key="radio.key" :value="radio.value" :label="__(radio.label)"></el-radio>
                        </el-radio-group>

                        <div v-if="ans.form_submission_fields.source_table != '' && ans.value != ''">
                            <field-with-source-table :ans="ans" v-if="['Dropdown Select', 'Currency'].some(o => o === ans.form_submission_fields.field_type)"></field-with-source-table>
                        </div>

                        <div v-else>
                            <el-select class="full-width" disabled v-model="ans.value" placeholder="Select"
                                v-if="['Dropdown Select', 'Currency'].some(o => o === ans.form_submission_fields.field_type)">
                                <el-option
                                v-for="item in ans.form_submission_fields.field_options"
                                :key="item.key"
                                :label="__(item.label)"
                                :value="item.value">
                                </el-option>
                            </el-select>
                        </div>

                        <el-checkbox v-model="ans.value" disabled v-if="ans.form_submission_fields.field_type == 'Single Checkbox'" style="font-weight:bold">{{ans.form_submission_fields.field_label}}</el-checkbox>

                        <el-checkbox-group disabled class="full-width" v-model="ans.value" v-if="ans.form_submission_fields.field_type == 'Multiple Checkboxes'">
                            <el-checkbox v-for="item in ans.form_submission_fields.field_options"
                                :key="item.key"
                                :label="__(item.label)"
                                :value="item.value">
                            </el-checkbox>
                        </el-checkbox-group>

                        <el-input-number
							v-if="['Unformatted Number', 'Formatted Number'].some(o => o === ans.form_submission_fields.field_type)"
							v-model="ans.value"
                            disabled
							class="full-width">
						</el-input-number>

                        <el-upload
							v-if="ans.form_submission_fields.field_type === 'File'"
							class="upload-demo"
							drag
                            disabled
							action="">
								<i class="el-icon-upload"></i>
								<div class="el-upload__text">{{ __('Drop file here or') }}<em>{{ __('click to upload') }}</em></div>
						</el-upload>

                        <div v-if="ans.form_submission_fields.field_type == 'Matrix'">
                            <el-table
                                :data="JSON.parse(ans.value)"
                                style="width: 100%">
                                <el-table-column v-for="(options, index) in ans.form_submission_fields.field_options" :key="index"
                                        :label="__(options.label)">
                                        <template slot-scope="scope">
                                            <div>
                                                {{scope.row[options.value]}}
                                            </div>
                                        </template>
                                    </el-table-column>
                            </el-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ResponseSubmissionFromSupplier',
    props: {
        formData: {
            type: Array,
            required: true
        },
        answerFromSupplier: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            newANswer: []
        }
    },
    created() {
    },
    methods: {

    },

    watch: {
        answerFromSupplier(val) {
            this.newANswer = val;
        }
    },


}
</script>
<style lang="scss">
    .answer_div {
        padding: 10px;
    }
    .answer_wrapper_response{
        display:  flex;
        flex-flow: wrap;
        width: 100%;

        .answer_content_response{
            width: 100%;
            font-size: 13px;
            padding: 10px;
        }
    }
    .form_group_answer{
        font-weight: bold;
        font-size: 19px;
    }
    .answer_response_content {
        padding-left: 10px;
        padding-right: 10px;
    }
    .response_label {
        font-weight: bold;
    }
</style>
