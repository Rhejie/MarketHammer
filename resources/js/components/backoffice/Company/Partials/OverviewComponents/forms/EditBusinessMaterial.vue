<template>
    <div>
        <el-form
            :model="editMaterialFormData"
            :rules="rules"
            ref="editMaterialFormData"
            label-position="top"
            label-width="120px"
            class="demo-ruleForm"
        >
            <el-form-item
                :label="__('Material')"
                prop="material_id"
                style="with: 100%"
            >
                <el-select
                    v-model="editMaterialFormData.material_id"
                    filterable
                    class="full-width round-input"
                    :placeholder="__('Select')"
                >
                    <el-option
                        v-for="item in materials"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id"
                    >
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item>
                <el-button
                    type="text"
                    class="text-black"
                    @click="dialogVisible('editMaterialFormData')"
                    >{{ __("Cancel") }}</el-button
                >
                <el-button
                    type="primary"
                    class="btn btn-black"
                    @click="submitForm('editMaterialFormData')"
                    >{{ __("Save") }}</el-button
                >
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
export default {
    name: "EditBusinessMaterial",
    props: {
        editMaterialFormData: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            materials: [],
            rules: {
                material_id: [
                    {
                        required: true,
                        message: this.__("Please select material"),
                        trigger: "blur",
                    },
                ],
            },
        };
    },
    mounted() {
        this.getmaterials();
    },
    methods: {
        getmaterials() {
            this.$API.BusinessMaterials.getMaterials()
                .then((res) => {
                    this.materials = res.data;
                    console.log(this.materials);
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally((_) => {
                    this.selectLoading = false;
                });
        },
        dialogVisible(formName) {
            this.$refs[formName].resetFields();
            this.$emit("dialogVisble");
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.updateBusinessMaterial(this.editMaterialFormData);
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
        updateBusinessMaterial(data) {
            this.$API.BusinessMaterials.updateBusinessMaterial(data.id, data)
                .then((response) => {
                    // console.log(response.data.data);
                    this.$emit("editBusinessMaterialData", response.data);
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

<style>
.el-form-item__content {
    text-align: right;
}
</style>