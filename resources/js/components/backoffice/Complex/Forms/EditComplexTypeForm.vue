<template>
    <div>
        <el-form
            :model="editeDataComplexType"
            :rules="rules"
            ref="editeDataComplexType"
            class="demo-ruleForm"
        >

            <el-form-item :label="__('Name')" prop="name">
                <el-input v-model="editeDataComplexType.name" :placeholder="__('Complex Type Name')"></el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('name', editeDataComplexType.name, 'text')">
                </value-translator-btn> 
                <div v-if="errors.name" class="el-form-item__error">
                    {{errors.name[0]}}
                </div>
            </el-form-item>
            <el-form-item :label="__('Description')" prop="description">
                <el-input
                    type="textarea"
                    :placeholder="__('Description')"
                    v-model="editeDataComplexType.description"
                ></el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('description', editeDataComplexType.description, 'textarea')">
                </value-translator-btn>
            </el-form-item>
            <el-form-item>
                <div style="float: right">
                        <button
                            type="button"
                            class="btn btn-default"
                            @click="dialogVisible('editeDataComplexType')"
                        >
                            {{ __("Cancel") }}
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary btn-black"
                            @click="submitForm('editeDataComplexType')"
                        >
                            {{ __("Update") }}
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
    name: "EditComplexDialog",
    mixins: [translationForm],
    props: {
        editeDataComplexType: {
            type: Object,
            required: true,
        },
        model: {},
    },
    data() {
        return {
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

        this.populateDefault(cloneDeep(this.editeDataComplexType.translations))
        /*if (this.model && this.model.id) {
            this.editeDataComplexType = {
                id: this.model.id,
                name: this.$sf.ucwords(this.model.name),
                description: this.model.description
            }
            this.populateDefault(cloneDeep(this.model.translations))
        }*/
        /*this.editeDataComplexType = {
            id: this.editeDataComplexType.id,
            name: this.$sf.ucwords(this.editeDataComplexType.name),
            description: this.editeDataComplexType.description
        }
        this.populateDefault(cloneDeep(this.editeDataComplexType.translations))*/
    },
    methods: {
        dialogVisible() {
            //this.$refs[formName].resetFields();
            this.$emit("dialogVisble");
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.update(this.editeDataComplexType);
                } else {
                    console.log("error submit!!");
                    return false;
                }
            });
        },
        update(data) {
            let postData = cloneDeep(data)
			this.setCurrrentLangDefaultValue(postData)

            this.$API.ComplexType.update(postData.id, postData)
                .then((response) => {
                    // console.log(response.data.data);
                    this.$emit("editComplexData", response.data);
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
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
