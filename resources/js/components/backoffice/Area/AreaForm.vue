<template>
    <div>
        <el-form
            :model="areaForm"
            :rules="rules"
            ref="areaForm"
            class="demo-ruleForm"
        >
            <el-form-item :label="__('Name')" prop="name">
                <el-input
                    v-model="areaForm.name"
                    :placeholder="__('Usage Area Name')"
                ></el-input>
                <div v-if="errors.name" class="el-form-item__error">
                    {{ errors.name[0] }}
                </div>
            </el-form-item>
            <el-form-item :label="__('Description')" prop="description">
                <el-input
                    type="textarea"
                    v-model="areaForm.description"
                    :placeholder="__('Description')"
                ></el-input>
            </el-form-item>
            <el-form-item>
                <div style="float: right">
                    <button
                        type="button"
                        class="btn btn-default"
                        @click="dialogVisible('areaForm')"
                    >
                        {{ __("Cancel") }}
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary btn-black"
                        @click="submitForm('areaForm')"
                    >
                        {{ __("Create") }}
                    </button>
                </div>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
export default {
    name: "AreaForm",
    props: {
        errorsData: {
            type: Object,
            require: true,
        },
    },
    data() {
        return {
            areaForm: {
                name: null,
                description: null,
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
                    // this.$emit("addNewFormData", this.areaForm);
                    this.addNewAreaFormData(this.areaForm);
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
        addNewAreaFormData(formdata) {
            this.$API.Area.storeArea(formdata)
                .then((response) => {
                    // this.areasData.unshift(response.data);
                    this.$emit("addNewFormData", response.data);
                    this.$notify({
                        title: "Successful",
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
<style scoped>
.error_message {
    color: red;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    font-size: 15px;
}
</style>
