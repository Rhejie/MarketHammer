<template>
    <el-dialog
        :title="hasModel ? 'Update Material' : 'Add New Material'"
        :visible.sync="showDialog"
        width="45%"
        :before-close="closeFormDialog"
        :close-on-press-escape="false"
        class="material-dialog"
        :close-on-click-modal="false">
        <el-form
            ref="materialForm"
            :model="materialForm"
            :rules="rules"
            class="material-form">
            <el-form-item label="Material Name" prop="name">
                <el-input
                    v-model="materialForm.name"
                    placeholder="Material Name">
                </el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('name', materialForm.name, 'text')">
                </value-translator-btn>
            </el-form-item>
            <el-form-item
                v-if="!parentData"
                label="Material Type"
                prop="business_id"
                :error="hasError('business_id', true)">
                <el-select
                    v-model="materialForm.material_type_id"
                    placeholder="Select Type"
                    class="cluster-dropdown full-width"
                    filterable
                    clearable
                    :disabled="hasModel">
                    <el-option
                        v-for="type in materialTypes"
                        :key="type.id"
                        :label="type.name"
                        :value="type.id">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Description" prop="description">
                <el-input
                    type="textarea"
                    :rows="3"
                    v-model="materialForm.description"
                    placeholder="Description">
                </el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('description', materialForm.description, 'textarea')">
                </value-translator-btn>
            </el-form-item>
        </el-form>
        <span slot="footer">
            <button
                type="button"
                class="btn btn-default"
                @click="closeFormDialog">
                Cancel
            </button>
            <button
                type="button"
                class="btn btn-primary btn-black"
                @click="validateMaterialForm">
                {{ hasModel ? __('Save') : __('Save') }}
            </button>
        </span>

         <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData">
        </value-translator-form>
    </el-dialog>
</template>

<script>
    import cloneDeep from "lodash/cloneDeep";
    import { formHelper } from "../../../mixins/formHelper";
    import { dialogComponent } from "../../../mixins/dialogComponent";
    import translationForm from '../../../mixins/translationForm.js'

    export default {
        name: "MaterialForm",
        mixins: [dialogComponent, formHelper, translationForm],
        props: {
            model: {},
            materialTypes: {},
            parentData: {
                type: Object,
                required: false
            }
        },
        data() {
            return {
                loading: false,
                materialForm: {
                    name: null,
                    material_type_id: null,
                    description: null
                },
                rules: {
                    name: [
                        {
                            required: true,
                            message: "Please input material name",
                            trigger: "blur"
                        }
                    ]
                },
                selectLoading: false,
                businessSelected: null,
                companyList: []
    			//this.populateDefault();
            };
        },
        created() {
    		this.formFields = ['name', 'description']
            this.fromTable = 'material'

            if (this.model && this.model.id) {
                this.materialForm = {
                    id: this.model.id,
                    name: this.model.name,
                    description: this.model.description,
                    material_type_id: this.model.material_type_id
                };
    			this.populateDefault(cloneDeep(this.model.translations))
            } else {
                if (this.parentData && this.parentData.id) {
                    this.materialForm.business_id = this.parentData.id;
                }
    			//this.populateDefault(cloneDeep(this.model.translations))
            }
    		//this.populateDefault(cloneDeep(this.model.translations))
        },
        methods: {
            validateMaterialForm() {
                this.$refs["materialForm"].validate(valid => {
                    if (valid) {
                        this.resetErrors();

                        if (this.hasModel) {
                            this.updateMaterial();

                            return;
                        }

                        this.createMaterial();
                    }
                });
            },
            createMaterial() {
                this.loading = true;

                let data = cloneDeep(this.materialForm);
    			this.setCurrrentLangDefaultValue(data)

                this.$API.Material.storeMaterial(data)
                    .then(result => {
                        let res = result.data;
                        if (res.data) {
                            this.$EventDispatcher.fire(
                                "MATERIAL_NEW_ITEM_CREATED",
                                res.data
                            );

                            this.$notify({
                                title: "Success",
                                message: this.$msg.notif.success_add,
                                type: "success"
                            });

                            this.closeFormDialog();

                            return;
                        }

                        res.data.success === false
                            ? (this.form.errors = res.data.errors)
                            : null;

                        this.$notify({
                            title: "Failed",
                            message: this.$msg.notif.failed_add,
                            type: "error"
                        });
                    })
                    .catch(err => {
                        console.log(err);

                        this.$notify({
                            title: "Server Error",
                            message: this.$msg.notif.server_error,
                            type: "error"
                        });
                    })
                    .finally(_ => {
                        this.loading = false;
                    });
            },
            updateMaterial() {
                this.loading = true;

    			let data = cloneDeep(this.materialForm);
    			this.setCurrrentLangDefaultValue(data)

                this.$API.Material.updateMaterial(data)
                    .then(result => {
                        let res = result.data;
                        if (res.data) {
                            this.$EventDispatcher.fire(
                                "MATERIAL_ITEM_UPDATED",
                                res.data
                            );

                            this.$notify({
                                title: "Success",
                                message: this.$msg.notif.success_update,
                                type: "success"
                            });

                            this.closeFormDialog();

                            return;
                        }

                        res.data.success === false
                            ? (this.form.errors = res.data.errors)
                            : null;

                        this.$notify({
                            title: "Failed",
                            message: this.$msg.notif.failed_update,
                            type: "error"
                        });
                    })
                    .catch(err => {
                        console.log(err);

                        this.$notify({
                            title: "Server Error",
                            message: this.$msg.notif.service_error,
                            type: "error"
                        });
                    })
                    .finally(_ => {
                        this.loading = false;
                    });
            },
            closeFormDialog() {
                this.resetForm();

                setTimeout(_ => {
                    this.$refs.materialForm.clearValidate();
                    this.closeModal();
                }, 200);
            },
            resetForm() {
                this.materialForm = {
                    id: null,
                    name: null,
                    description: null,
                    material_type_id: null
                };
            }
        },
        computed: {
            hasModel() {
                return this.model && this.model.id ? true : false;
            }
        }
    }
</script>

<style lang="scss">
    .el-form-item.el-form-checkbox {
        margin-bottom: 0px !important;
    }
</style>
