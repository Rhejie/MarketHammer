<template>
    <div class="main-container">
            <div class="table-container">
                <div class="card borderless">
                    <div class="card-actions">
                        <div class="header-title">
                            <h5>{{ __('Certification Holder') }}</h5>
                        </div>
                        <div class="search-container" style="margin-right:15px;">
                            <el-input
                                class="input-search"
                                v-model="search"
                                :placeholder="__('Type to search')"
                                @keyup.enter.native="showCertificationHolders"
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
                        >
                            <!-- <div class="cloud-container" style="margin-top: 3px !important;margin-left: 3px !important;">
                                      <button type="button" class="btn btn-outline-gray" @click="openImportModal()">
                                        <i class="el-icon-upload2"></i>
                                      </button>
                                </div> -->
                        </div>
                        <div class="add-new-button">
                            <button
                                type="button"
                                class="btn btn-primary btn-black"
                                @click="openCreateCertificationHolderModal"
                            >
                                <i class="fas fa-plus"></i>
                                {{ __("Add Certification Holder") }}
                            </button>
                        </div>
                    </div>
                    <!-- Table -->
                    <el-table
                        class="table-list-container"
                        :data="certificationHolderData"
                        style="width: 100%; margin-top: 15px;"
                        v-loading="tableLoading"
                        @row-click="editCertificationHolder"
                    >
                        <el-table-column
                            prop="name"
                            :label="__('Certification Holder Name')"
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
                                    <button class="btn btn-default text-red" @click.stop @click="askToDeleteCertificationHolder(scope.row.id, scope.row.index)">
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
                            :pagination="certificationHolderPagination"
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
                    ? __('Add New Certification Holder')
                    : __('Update Certification Holder')
            "
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="certification-holder-dialog"
            :close-on-click-modal="false"
        >
            <el-form
                ref="certificationHolderForm"
                :model="certificationHolderForm"
                :rules="certificationHolderFormRules"
                class="certification-holder-form"
            >
                <el-form-item
                    :label="__('Certification Holder Name')"
                    prop="name"
                >
                    <el-input
                        v-model="certificationHolderForm.name"
                        :placeholder="__('Certification Holder Name')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'name',
                                certificationHolderForm.name,
                                'text'
                            )
                        "
                    >
                    </value-translator-btn>
                </el-form-item>
                <el-form-item :label="__('Description')" prop="description">
                    <el-input
                        type="textarea"
                        :rows="3"
                        v-model="certificationHolderForm.description"
                        :placeholder="__('Description')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'description',
                                certificationHolderForm.description,
                                'textarea'
                            )
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
                    @click="validateCertificationHolderForm"
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
    props: {
        certificationHolder: {}
    },
    mixins: [translationForm],
    data: function() {
        return {
            certificationHolderData: [],
            certificationHolderPagination: {},
            search: "",
            current_page: 1,
            current_size: 25,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: "create",
            certificationHolderForm: {
                name: null,
                description: null
            },
            certificationHolderFormRules: {
                name: [
                    {
                        required: true,
                        message: this.__(
                            "Please input certification holder name"
                        ),
                        trigger: "blur"
                    }
                ]
            }
        };
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "certification_holder";
        this.showCertificationHolders();
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.showCertificationHolders();
                return;
            }
        }
    },
    methods: {
        showCertificationHolders() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.CertificationHolder.showCertificationHolders(params)
                .then(res => {
                    this.certificationHolderData =
                        res.data.certificationHolder.data;
                    this.certificationHolderPagination =
                        res.data.certificationHolder;
                    this.tableLoading = false;
                })
                .catch(_ => {});
        },
        openCreateCertificationHolderModal() {
            this.mode = "create";
            this.resetFields();
            this.formDialogVisible = true;
            this.populateDefault();
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showCertificationHolders();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showCertificationHolders();
        },
        editCertificationHolder(row) {

            // this.$API.CertificationHolder.showCertificationHolder(row.id)
            //     .then(res => {
            //         this.certificationHolderForm = res.data.certificationHolder;
            //         this.tableLoading = false;
            //         this.mode = "edit";
            //         this.formDialogVisible = true;

            //         this.populateDefault(
            //             cloneDeep(this.certificationHolderForm.translations)
            //         );
            //     })
            //     .catch(_ => {});
            this.certificationHolderForm = {...row}
            this.mode = 'edit';
            this.formDialogVisible = true;
            this.populateDefault(cloneDeep(this.certificationHolderForm.translations));
        },
        askToDeleteCertificationHolder(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                confirmButtonClass: "el-button--danger",
                type: "warning"
            })
                .then(() => {
                    this.deleteCertificationHolder(id, index);
                })
                .catch(() => {});
        },
        closeFormDialog() {
            this.formDialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.certificationHolderForm = {
                name: null,
                description: null
            };
        },
        validateCertificationHolderForm() {
            this.$refs["certificationHolderForm"].validate(valid => {
                if (valid) {
                    if (this.mode == "create") {
                        this.storeCertificationHolder();
                    } else {
                        this.updateCertificationHolder();
                    }
                }
            });
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.askToDeleteCertificationHolder(info.data, info.index);
            } else if (info.action === "update") {
                this.editCertificationHolder(info.data);
            }
        },
        storeCertificationHolder() {
            this.formDialogVisible = false;

            let postData = cloneDeep(this.certificationHolderForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.CertificationHolder.storeCertificationHolder(postData)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });

                    this.certificationHolderData.unshift(res.data);
                    this.resetFields();
                })
                .catch(err => {
                    this.formDialogVisible = true;
                    this.tableLoading = false;
                    this.showValidationError(err);
                });
        },
        updateCertificationHolder() {
            this.formDialogVisible = false;

            let postData = cloneDeep(this.certificationHolderForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.CertificationHolder.updateCertificationHolder(postData)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });
                    this.mode = "create";
                    this.resetFields();
                    this.certificationHolderData.map ( cert => {
                        if(cert.id === res.data.id) {
                            for(let key in res.data) {
                                cert[key] = res.data[key];
                            }
                        }
                    } )
                })
                .catch(err => {
                    this.formDialogVisible = true;
                    this.tableLoading = false;
                    this.showValidationError(err);
                });
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
        deleteCertificationHolder(id, index) {
            this.$API.CertificationHolder.destroyCertificationHolder(id)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    this.certificationHolderData.splice(index, 1);
                })
                .catch(_ => {});
        }
    }
};
</script>
<style lang="scss"></style>
