<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Role') }}</h5>
                    </div>
                    <div class="search-container" style="margin-right: 15px;">
                        <el-input
                            class="input-search"
                            v-model="search"
                            :placeholder="__('Type to search')"
                            @keyup.enter.native="showList"
                        >
                            <i
                                slot="suffix"
                                class="el-input__icon el-icon-search"
                            ></i>
                        </el-input>
                    </div>
                    <div class="add-new-button">
                        <button
                            type="button"
                            class="btn btn-primary btn-black"
                            @click="openCreateModal"
                        >
                            <i class="fas fa-plus"></i> {{ __('Add New Role') }}
                        </button>
                    </div>
                </div>
                <el-table
                    class="table-list-container"
                    :data="filteredList"
                    row-key="id"
                    style="width: 100%; margin-top: 15px;"
                    v-loading="loading"
                    @row-click="editData">
                >
                    <el-table-column prop="name" :label="__('Role')" :sortable="true">
                        <template slot-scope="scope">
                            {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
                        </template>
                    </el-table-column>
                    <el-table-column :label="__('Action')" align="center">
                        <template slot-scope="scope">
                            <div>
                                <button
                                    class="btn btn-default text-red"
                                    @click.stop
                                    @click="askToDelete(scope.row.id, scope.row.index)"
                                >
                                   <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                </button>
                            </div>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="text-right">
                    <global-pagination
                        :current_page="current_page"
                        :current_size="current_size"
                        :pagination="typePagination"
                        @handleSizeChange="handleSizeChange"
                        @handleCurrentChange="handleCurrentChange"
                    ></global-pagination>
                </div>
            </div>
        </div>

        <!-- EL DIALOG FOR CREATE -->
        <el-dialog
            :title="mode == 'create' ? __('Add New Role') : __('Update Role')"
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="industry-type-dialog"
            :close-on-click-modal="false"
        >
            <el-form
                ref="modelForm"
                :model="modelForm"
                :rules="modelFormRules"
                class="industry-type-form"
            >
                <el-form-item :label="__('Role')" prop="name">
                    <el-input
                        v-model="modelForm.name"
                        :placeholder="__('Role')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm('name', modelForm.name, 'text')
                        "
                    >
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
                    @click="validateForm"
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
    data() {
        return {
            search: null,
            typeList: [],
            typePagination: {},
            loading: false,
            current_page: 1,
            current_size: 25,
            formDropdownLoading: true,
            selectedModel: null,
            parentData: {},
            modelForm: {
                name: null,
                description: null
            },
            modelFormRules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input name"),
                        trigger: "blur"
                    }
                ]
            },
            mode: "create",
            formDialogVisible: false
        };
    },
    created() {
        this.formFields = ["name"];
        this.fromTable = "contact_role";

        //this.populateDefault()
        this.showList();
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.showList();
                return;
            }
        }
    },
    methods: {
        showList() {
            this.loading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.ContactRole.getList(params)
                .then(result => {
                    let res = result.data;
                    this.typeList = res.role.data;
                    this.typePagination = res.role;
                })
                .catch(err => {
                    console.log("Error: ", err);
                })
                .finally(_ => {
                    this.loading = false;
                });
        },
        openCreateModal() {
            this.mode = "create";
            this.formDialogVisible = true;
            this.populateDefault();
        },
        validateForm() {
            this.$refs["modelForm"].validate(valid => {
                if (valid) {
                    if (this.mode == "create") {
                        this.storeData();
                    } else {
                        this.updateData();
                    }
                }
            });
        },

        closeFormDialog() {
            this.formDialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs["modelForm"].resetFields();
            this.modelForm.name = null;
            this.modelForm.description = null;
        },
        editData(data) {
            this.modelForm = cloneDeep(data);
            this.mode = "edit";
            this.formDialogVisible = true;

            this.populateDefault(cloneDeep(this.modelForm.translations));
        },
        handleAction(info) {
				if (info.action === 'delete') {
					this.askToDelete(info.data, info.index)
				}
				else if (info.action === 'update') {
					this.editData(info.data)
				}
			},
        storeData() {

            let postData = cloneDeep(this.modelForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.ContactRole.store(postData)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });

                    this.typeList.unshift(res.data.data);
                    this.resetFields();
                    this.formDialogVisible = false;
                })
                .catch(err => {
                    console.log("Err: ", err);
                    this.formDialogVisible = true;
                    this.showValidationError(err);
                })
                .finally(_ => {
                    this.loading = false;
                });
        },
        updateData() {

            let postData = cloneDeep(this.modelForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.ContactRole.update(postData)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });
                    this.mode = "create";
                    const data = res.data.data;

                    this.typeList.map(ty => {
                        if (ty.id === data.id) {
                            for (let key in data) {
                                ty[key] = data[key];
                            }
                        }
                    });

                    this.resetFields();
                    this.formDialogVisible = false;
                })
                .catch(err => {
                    console.log("Err: ", err);
                    this.formDialogVisible = true;
                    this.showValidationError(err);
                })
                .finally(_ => {
                    this.loading = false;
                });
        },
        showValidationError(err) {
            let errors = [];
            const h = this.$createElement;
            if (err.response && err.response.status == 422) {
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
        askToDelete(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                confirmButtonClass: "el-button--danger",
                type: "warning"
            })
                .then(() => {
                    this.deleteData(id, index);
                })
                .catch(() => {});
        },
        deleteData(id, index) {
            this.$API.ContactRole.destroy(id)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });
                    this.typeList.splice(index, 1);
                })
                .catch(_ => {})
                .finally(_ => {
                    this.loading = false;
                });
        },

        handleSizeChange(val) {
            this.current_size = val;
            this.current_page = 1;

            this.showList();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showList();
        }
    },
    computed: {
        filteredList() {
            return this.typeList;
        }
    }
};
</script>

<style lang="scss">
.el-message-box {
    width: auto !important;
    padding-bottom: 10px !important;
}
</style>
