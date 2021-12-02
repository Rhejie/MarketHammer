<template>
    <div>
        <el-form
            :model="editComplexLocationData"
            :rules="rules"
            ref="editComplexLocationData"
            class="demo-ruleForm"
        >

            <el-form-item :label="__('Name')" prop="name">
                <el-input v-model="editComplexLocationData.name" :placeholder="__('Complex Location Name')"></el-input>
                <div v-if="errors.name" class="el-form-item__error">
                    {{errors.name[0]}}
                </div>
            </el-form-item>
            <el-form-item :label="__('Description')" prop="description">
                <el-input
                    type="textarea"
                    :placeholder="__('Description')"
                    v-model="editComplexLocationData.description"
                ></el-input>
                <div v-if="errors.description" class="el-form-item__error">
                    {{errors.description[0]}}
                </div>
            </el-form-item>
            <el-form-item>
                <el-button
                    type="primary"
                    @click="submitForm('editComplexLocationData')"
                    >{{ __("Create") }}</el-button
                >
                <el-button @click="dialogVisible('editComplexLocationData')"
                    >{{ __("Cancel") }}</el-button
                >
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
export default {
    name: "EditComplexlocation",
    props: {
        editComplexLocationData: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            rules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input area name"),
                        trigger: "blur",
                    },
                ],
                description: [
                    {
                        required: true,
                        message: this.__("Please input description"),
                        trigger: "blur",
                    },
                ],
            },
            errors: [],
        };
    },
    methods: {
        dialogVisible() {
            this.$emit("dialogVisble");
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.update(this.editComplexLocationData);
                } else {
                    console.log("error submit!!");
                    return false;
                }
            });
        },
        update(data) {
            this.$API.ComplexLocation.update(data, data.id)
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
            this.EditdialogVisible = false;
        },
    },
};
</script>
