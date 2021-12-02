<template>
    <div>
        <el-form
            :model="addNewLocationData"
            :rules="rules"
            ref="addNewLocationData"
            class="demo-ruleForm"
        >

            <el-form-item :label="__('Name')" prop="name">
                <el-input v-model="addNewLocationData.name" :placeholder="__('Complex Location Name')"></el-input>
                <div v-if="errors.name" class="el-form-item__error">
                    {{errors.name[0]}}
                </div>
            </el-form-item>
            <el-form-item :label="__('Description')" prop="description">
                <el-input
                    type="textarea"
                    :placeholder="__('Description')"
                    v-model="addNewLocationData.description"
                ></el-input>
                <div v-if="errors.description" class="el-form-item__error">
                    {{errors.description[0]}}
                </div>
            </el-form-item>
            <el-form-item>
                <el-button
                    type="primary"
                    @click="submitForm('addNewLocationData')"
                    >{{ __("Create") }}</el-button
                >
                <el-button @click="dialogVisible('addNewLocationData')"
                    >{{ __("Cancel") }}</el-button
                >
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
export default {
    name: "AddNewLocationFOrm",
    data() {
        return {
            addNewLocationData: {
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
    methods: {
        dialogVisible(formName) {
            this.$refs[formName].resetFields();
            this.$emit("dialogVisble");
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.addNewComplexLocationeData(this.addNewLocationData);
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
        addNewComplexLocationeData(formdata) {
            this.$API.ComplexLocation.create(formdata)
                .then((response) => {
                    this.$emit("addNewFormData", response.data);
                    this.$notify({
                        title: this.__("Successful"),
                        message: this.$msg.notif.success_add,
                        type: "success",
                    });
                    this.filters.total++;
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
