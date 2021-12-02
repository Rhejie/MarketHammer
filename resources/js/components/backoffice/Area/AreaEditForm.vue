<template>
    <div>
        <el-form
            :model="editAreaData"
            :rules="rules"
            ref="editAreaData"
            class="demo-ruleForm"
        >
            <el-form-item :label="__('Name')" prop="name">
                <el-input v-model="editAreaData.name" :placeholder="__('Usage Area Name')"></el-input>
                <div v-if="errors.name" class="el-form-item__error">
                    {{errors.name[0]}}
                </div>
            </el-form-item>
            <el-form-item :label="__('Description')" prop="description">
                <el-input
                    type="textarea"
                    v-model="editAreaData.description"
                    :placeholder="__('Description')"
                ></el-input>
            </el-form-item>
            <el-form-item>
                <div style="float: right">
                        <button
                            type="button"
                            class="btn btn-default"
                            @click="dialogVisible('editAreaData')"
                        >
                            {{ __("Cancel") }}
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary btn-black"
                            @click="submitForm('editAreaData')"
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
    name: "EditAreaForm",
    props: {
        editAreaData: {
            type: Object,
            reuired: true,
        },
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
    methods: {
        dialogVisible() {
            this.$emit("dialogVisble");
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.updateArea(this.editAreaData);
                } else {
                    console.log("error submit!!");
                    return false;
                }
            });
        },
        updateArea(data) {
            this.$API.Area.updateArea(data.id, data)
                .then((response) => {
                    this.$emit("editAreaData", response.data);
                    this.$notify({
                        title: "Success",
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
