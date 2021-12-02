<template>
    <div>
        <el-form
            :model="complexTypeFormData"
            :rules="rules"
            ref="complexTypeFormData"
            class="demo-ruleForm"
        >

            <el-form-item :label="__('Complex Type Name')" prop="name">
                <el-input v-model="complexTypeFormData.name" :placeholder="__('Complex Type Name')"></el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('name', complexTypeFormData.name, 'text')">
                </value-translator-btn>
                <div v-if="errors.name" class="el-form-item__error">
                    {{errors.name[0]}}
                </div>
                
            </el-form-item>
            <el-form-item :label="__('Description')" prop="description">
                <el-input
                    type="textarea"
                    v-model="complexTypeFormData.description"
                    :placeholder="__('Description')"
                ></el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('description', complexTypeFormData.description, 'textarea')">
                </value-translator-btn>
                <div v-if="errors.description" class="el-form-item__error">
                    {{errors.description[0]}}
                </div>
            </el-form-item>
            <el-form-item>
                <div style="float: right">
                        <button
                            type="button"
                            class="btn btn-default"
                            @click="dialogVisible('complexTypeFormData')"
                        >
                            {{ __("Cancel") }}
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary btn-black"
                            @click="submitForm('complexTypeFormData')"
                        >
                            {{ __("Create") }}
                        </button>
                    </div>
            </el-form-item>
        </el-form>

        <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData">
        </value-translator-form>
    </div>
</template>
<script>
import cloneDeep from "lodash/cloneDeep";
import translationForm from '../../../../mixins/translationForm.js' 
export default {
    name: "AddNewFormComplexType",
    mixins: [translationForm],
    data() {
        return {
            complexTypeFormData: {
                name: "",
                description: "",
            },
            errors: [],
            rules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input area name"),
                        trigger: "blur",
                    },
                ],
            },
        };
    },
    created() {
        this.formFields = ['name', 'description']
        this.fromTable = 'complex_types'
    },
    methods: {
        dialogVisible(formName) {
            this.$refs[formName].resetFields();
            this.$emit("dialogVisble");
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.create(this.complexTypeFormData);
                } else {
                    console.log("error submit!!");
                    return false;
                }

                this.areaForm = {
                    name: "",
                    description: "",
                };
            });
        },
        create(formdata) {
            let data = cloneDeep(formdata);
            this.setCurrrentLangDefaultValue(data)

            this.$API.ComplexType.create(data)
                .then((response) => {
                    this.$emit("addNewFormData", response.data);
                    this.$notify({
                        title: this.__("Successful"),
                        message: this.$msg.notif.success_add,
                        type: "success",
                    });
                })
                .catch((err) => {
                    switch (err.response.status) {
                        case 422:
                            this.errors = err.response.data.errors;
                            break;
                        default:
                            this.$notify({
                                title: this.__("Error"),
                                message: this.$msg.notif.service_error,
                                type: "error",
                            });
                            break;
                    }
                });
        },
    },
};
</script>
