<template>
    <div class="main-container">
            <div class="table-container">
                <div class="card borderless">
                    <div class="card-actions">
                        <div class="header-title">
                            <h5>{{ __('Material Type') }}</h5>
                        </div>
                        <div class="search-container" style="margin-right:15px;">
                            <el-input
                                class="input-search"
                                v-model="search"
                                :placeholder="__('Type to search')"
                                @keyup.enter.native="showMaterialTypes"
                            >
                                <i
                                    slot="suffix"
                                    class="el-input__icon el-icon-search"
                                ></i>
                            </el-input>
                        </div>
                        <div
                            class="action-button-container text-center"
                            style="margin-top: 3px !important;"
                        ></div>
                        <div class="add-new-button">
                            <button
                                type="button"
                                class="btn btn-primary btn-black"
                                @click="openCreateMaterialTypeModal"
                            >
                                <i class="fas fa-plus"></i>
                                {{ __("Add Material Type") }}
                            </button>
                        </div>
                    </div>
                    <!-- Table -->
                    <el-table
                        class="table-list-container"
                        :data="materialTypeData"
                        style="width: 100%; margin-top: 15px;"
                        v-loading="tableLoading"
                        @row-click="editMaterialType"
                    >
                        <el-table-column
                            prop="name"
                            :label="__('Material Type Name')"
                            :sortable="true"
                        >
                            <template slot-scope="scope">
                                {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
                            </template>
                        </el-table-column>
                        <el-table-column
                            prop="description"
                            :label="__('Description')"
                            :sortable="true"
                        >
                            <template slot-scope="scope">
                                {{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
                            </template>
                        </el-table-column>
                        <el-table-column :label="__('Action')" align="center">
                            <template slot-scope="scope">
                                <div>
                                    <button class="btn btn-default text-red" @click.stop @click="askToDeleteMaterialType(scope.row.id, scope.row.index)">
                                       <i class="fas fa-trash-alt"></i> {{ __("Delete") }}
                                    </button>
                                </div>
                            </template>
                        </el-table-column>
                    </el-table>
                    <div class="text-right">
                        <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="materialTypePagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"
                        ></global-pagination>
                    </div>
                </div>
            </div>

        <!-- EL DIALOG FOR CREATE -->
        <el-dialog
            :title="
                mode == 'create'
                    ? __('Add New Material Type')
                    : __('Update Material Type')
            "
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="material-type-dialog"
            :close-on-click-modal="false"
        >
            <el-form
                ref="materialTypeForm"
                :model="materialTypeForm"
                :rules="materialTypeFormRules"
                class="material-type-form"
            >
                <el-form-item :label="__('Material Type Name')" prop="name">
                    <el-input
                        v-model="materialTypeForm.name"
                        :placeholder="__('Material Type Name')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm('name', materialTypeForm.name, 'text')
                        "
                    >
                    </value-translator-btn>
                </el-form-item>
                <el-form-item :label="__('Description')" prop="description">
                    <el-input
                        type="textarea"
                        :rows="3"
                        v-model="materialTypeForm.description"
                        :placeholder="__('Description')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="setTranslationForm('description', materialTypeForm.description, 'textarea')">
                    </value-translator-btn>
                </el-form-item>
            </el-form>
            <span slot="footer">
                <button
                    type="button"
                    class="btn btn-default"
                    @click="closeFormDialog"
                >
                    {{ __("Cancel") }}
                </button>
                <button
                    type="button"
                    class="btn btn-primary btn-black"
                    @click="validateMaterialTypeForm"
                >
                    {{ mode == 'create' ? __('Save') : __('Save') }}
                </button>
            </span>
        </el-dialog>
        <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData"
        >
        </value-translator-form>
    </div>
</template>
<script>
import cloneDeep from "lodash/cloneDeep";
import translationForm from "../../../mixins/translationForm.js";
export default {
    mixins: [translationForm],
    data: function() {
        return {
            materialTypeData: [],
            materialTypePagination: {},
            search: "",
            current_page: 1,
            current_size: 25,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: "create",
            materialTypeForm: {
                name: null,
                description: null
            },
            materialTypeFormRules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input material name"),
                        trigger: "blur"
                    }
                ]
            }
        };
    },
    created() {
        this.formFields = ['name', 'description']
        this.fromTable = 'material_type'

        this.showMaterialTypes();
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.showMaterialTypes();
                return;
            }
        }
    },
    methods: {
        showMaterialTypes() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.MaterialType.getMaterialTypeList(params)
                .then(res => {
                    this.materialTypeData = res.data.materialTypes.data;
                    this.materialTypePagination = res.data.materialTypes;
                    this.tableLoading = false;
                })
                .catch(_ => {});
        },
        openCreateMaterialTypeModal() {
            this.mode = "create";
            this.formDialogVisible = true;
            this.populateDefault();
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showMaterialTypes();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showMaterialTypes();
        },
        editMaterialType(data) {
            /*let mData = cloneDeep(data);
            this.materialTypeForm.id = mData.id;
            this.materialTypeForm.name = mData.name;
            this.materialTypeForm.description = mData.description;
            this.materialTypeForm.cas_num = mData.cas_num;
            this.mode = "edit";
            this.formDialogVisible = true;

            this.populateDefault(cloneDeep(this.mData.translations));

            /*this.tableLoading = true;
            this.$API.MaterialType.showMaterialType(id).then(res => {
                this.materialTypeForm = res.data.materialType;
                this.tableLoading = false;
                this.mode = 'edit';
                this.formDialogVisible = true;
            }).catch(_ => {

            });*?

            /*this.tableLoading = true
            this.$API.IndustryType.editMaterialType(data)
            .then(res => {
                this.materialTypeForm = res.data.materialType
                this.mode = 'edit'
                this.formDialogVisible = true

                this.populateDefault(cloneDeep(this.materialTypeForm.translations))
            })
            .catch(err => {
                console.log(err)
            })
            .finally(_ => {
                this.tableLoading = false
            })*/

            this.materialTypeForm = cloneDeep(data);
            this.mode = "edit";
            this.formDialogVisible = true;

            this.populateDefault(cloneDeep(this.materialTypeForm.translations));
        },
        askToDeleteMaterialType(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                confirmButtonClass: "el-button--danger",
                type: "warning"
            })
                .then(() => {
                    this.deleteMaterialType(id, index);
                })
                .catch(() => {});
        },
        closeFormDialog() {
            this.formDialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.materialTypeForm = {
                name: null,
                description : null
            }
            this.$refs["materialTypeForm"].resetFields();
        },
        validateMaterialTypeForm() {
            this.$refs["materialTypeForm"].validate(valid => {
                if (valid) {
                    if (this.mode == "create") {
                        this.storeMaterialType();
                    } else {
                        this.updateMaterialType();
                    }
                }
            });
        },
        handleAction(info) {
				if (info.action === 'delete') {
					this.askToDeleteMaterialType(info.data, info.index)
				}
				else if (info.action === 'update') {
					this.editMaterialType(info.data)
				}
		},
        storeMaterialType() {
            this.formDialogVisible = false;

            let postData = cloneDeep(this.materialTypeForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.MaterialType.storeMaterialType(postData)
                .then(result => {
                    console.log(result);
                    let res = result.data;
                    if (res) {
                        this.$notify({
                            title: this.__("Success"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        });
                        this.materialTypeData.unshift(res);
                        // return;
                    }
                })
                .catch(err => {
                    console.log(err);
                    this.formDialogVisible = true;
                    this.tableLoading = false;
                    this.showValidationError(err);
                    // this.$notify({
                    //     title: "Failed",
                    //     message: this.$msg.notif.failed_add,
                    //     type: "error"
                    // });
                })
                .finally(_ => {
                    this.tableLoading = false;
                });
        },
        updateMaterialType() {
            this.formDialogVisible = false;

            let postData = cloneDeep(this.materialTypeForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.MaterialType.updateMaterialType(postData)
                .then(result => {
                    let res = result.data;
                    if (res) {
                        this.$notify({
                            title: this.__("Success"),
                            message: this.$msg.notif.success_update,
                            type: "success"
                        });
                        // this.updateData(res.data);
                        this.materialTypeData.map(ma => {
                            if(ma.id === res.id) {
                                for(let key in res) {
                                    ma[key] = res[key]
                                }
                            }
                        });
                    }
                })
                .catch(err => {
                    console.log(err);
                    this.formDialogVisible = true;
                    this.tableLoading = false;
                    this.showValidationError(err);
                    this.$notify({
                        title: this.__("Failed"),
                        message: this.$msg.notif.failed_update,
                        type: "error"
                    });
                })
                .finally(_ => {
                    this.tableLoading = false;
                });
        },
        updateData(data) {
            let getMaterialType = this.materialTypeData.findIndex(fn => {
                return fn.id == data.id;
            });
            if (getMaterialType >= 0) {
                this.materialTypeData.splice(getMaterialType, 1, data);
            }
        },
        showValidationError(err) {
            let errors = [];
            const h = this.$createElement;
            if (err.response.status == 422) {
                if (err.response.data.errors) {
                    for (var key in err.response.data.errors) {
                        errors.push(err.response.data.errors[key][0]);
                    }

                    this.$notify({
                        title: this.__("Error"),
                        message: h(
                            "div",
                            { style: "list-style-type: none" },
                            errors.map(errmsg => {
                                return h(
                                    "div",
                                    { style: "list-style-type: none" },
                                    errmsg
                                );
                            })
                        ),
                        type: "error"
                    });
                }
            }
        },
        deleteMaterialType(id, index) {
            this.$API.MaterialType.destroyMaterialType(id)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });
                    this.materialTypeData.splice(index, 1);
                })
                .catch(_ => {});
        }
    }
};
</script>
<style lang="scss">
.material-type-list {
    .el-dialog {
        .el-dialog__body {
            padding: 20px;
        }
        .material-type-form {
        }
    }
}
</style>
