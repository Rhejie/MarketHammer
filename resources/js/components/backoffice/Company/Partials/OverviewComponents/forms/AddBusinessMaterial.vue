<template>
    <div>
        <el-form
            :model="materialFormData"
            :rules="rules"
            ref="materialFormData"
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
                    v-model="materialFormData.material_id"
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
                    @click="dialogVisible('materialFormData')"
                    >{{ __("Cancel") }}</el-button
                >
                <el-button
                    type="primary"
                    class="btn btn-black"
                    @click="submitForm('materialFormData')"
                    >{{ __("Save") }}</el-button
                >
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
export default {
    name: "AddNewBusinessMaterial",
    props: {
        business: {},
    },
    data() {
        return {
            materialFormData: {
                business_id: this.business.id,
                material_id: "",
            },
            errors: [],
            links: [],
            materials: [],
            selectLoading: false,
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
                    this.addNewMaterial(this.materialFormData);
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
        addNewMaterial(formdata) {
            this.$API.BusinessMaterials.storeBusinessMaterial(formdata)
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
        remoteMethod(query) {
            if (query !== "") {
                this.loading = true;
                setTimeout(() => {
                    this.loading = false;
                    this.materials.filter((item) => {
                        return item.indexOf(query) != -1 ? item : null;
                    });
                }, 200);
            } else {
            }
        },
    },
    mounted() {
        this.getmaterials();
    },
};
</script>
