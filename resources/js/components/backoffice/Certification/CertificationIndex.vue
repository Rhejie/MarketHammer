<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Certifications') }}</h5>
                    </div>
                    <div class="search-container">
                        <el-input
                            class="input-search"
                            v-model="search"
                            :placeholder="__('Type to search')"
                            @keyup.enter.native="showCertifications"
                        >
                            <i
                                slot="suffix"
                                class="el-input__icon el-icon-search"
                            ></i>
                        </el-input>
                    </div>
                    <div class="secondary-action-buttons">
                        <el-popover
                            v-model="filterVisible"
                            placement="bottom"
                            width="300"
                            trigger="manual"
                            class="filter-container"
                        >
                            <div class="filterContainer">
                                <div class="header-container">
                                    <span class="header">
                                        {{ __("Filter Options") }}
                                    </span>
                                    <i
                                        class="el-icon-close"
                                        @click="filterVisible = false"
                                    ></i>
                                </div>

                                <el-form
                                    :model="filterForm"
                                    ref="filterForm"
                                    :label-position="'top'"
                                    class="filterForm"
                                >
                                    <el-form-item
                                        :label="__('Certification Type')"
                                    >
                                        <el-select
                                            v-model="
                                                filterForm.certification_type_id
                                            "
                                            filterable
                                            :placeholder="
                                                __('Select Certification Type')
                                            "
                                            class="filter-form-dropdown"
                                        >
                                            <el-option
                                                key="All"
                                                :label="__('All')"
                                                value="All"
                                            ></el-option>
                                            <el-option
                                                v-for="type in certificationTypeData"
                                                :key="type.id"
                                                :label="type.name"
                                                :value="type.id"
                                            ></el-option>
                                        </el-select>
                                    </el-form-item>
                                    <el-form-item
                                        :label="__('Cerfication Holder')"
                                    >
                                        <el-select
                                            v-model="
                                                filterForm.certification_holder_id
                                            "
                                            filterable
                                            placeholder="Select Certification Holder"
                                            class="filter-form-dropdown"
                                        >
                                            <el-option
                                                key="All"
                                                :label="__('All')"
                                                value="All"
                                            ></el-option>
                                            <el-option
                                                v-for="org in certificationHoldersData"
                                                :key="org.id"
                                                :label="org.name"
                                                :value="org.id"
                                            ></el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-form>

                                <button
                                    type="button"
                                    class="btn btn-primary btn-black filter-button"
                                    @click="filterList"
                                >
                                    {{ __("Filter") }}
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-default filter-button"
                                    @click="resetFilters"
                                >
                                    {{ __("Reset") }}
                                </button>
                            </div>

                            <el-button
                                icon="fas fa-filter"
                                class="btn btn-outline-gray"
                                slot="reference"
                                @click="filterVisible = !filterVisible"
                            >
                                <!-- <svg
                                    width="1em"
                                    height="1em"
                                    viewBox="0 0 16 16"
                                    class="fas fa-filter"
                                    fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"
                                    />
                                </svg> -->
                            </el-button>
                        </el-popover>
                    </div>
                    <div class="add-new-button">
                        <button
                            type="button"
                            class="btn btn-primary btn-black"
                            @click="openCreateCertificationModal"
                        >
                            <i class="fas fa-plus"></i>
                            {{ __("Add Certification") }}
                        </button>
                    </div>
                </div>
                <!-- Table -->
                <el-table
                    class="table-list-container"
                    :data="certificationData"
                    style="width: 100%; margin-top: 15px"
                    v-loading="tableLoading"
                    @row-click="show"
                >
                    <el-table-column
                        prop="name"
                        :label="__('Certification Name')"
                        :sortable="true"
                    >
                        <template slot-scope="scope">

                            {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}

                        </template>
                    </el-table-column>

                    <el-table-column
                        prop="certification_type.name"
                        :label="__('Certification Type')"
                        :sortable="true"
                    >
                        <template slot-scope="scope">
                            {{ __dt(scope.row.certification_type.translations[0], 'certification_type.name', $sf.ucwords(scope.row.certification_type.name)) }}
                        </template>
                    </el-table-column>
                    <el-table-column
                        prop="certification_holder.name"
                        :label="__('Certification Holder')"
                        :sortable="true"
                    >
                        <template slot-scope="scope">
                            {{ __dt(scope.row.certification_holder.translations[0], 'certification_holder.name', $sf.ucwords(scope.row.certification_holder.name)) }}
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
                                <button
                                    class="btn btn-default text-red"
                                    @click.stop
                                    @click="
                                        askToDeleteCertification(
                                            scope.row.id,
                                            scope.$index
                                        )
                                    "
                                >
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
                        :pagination="certificationPagination"
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
                    ? __('Add New Certification')
                    : __('Update Certification')
            "
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="certification-dialog"
            :close-on-click-modal="false"
        >
            <el-form
                ref="certificationForm"
                :model="certificationForm"
                :rules="certificationFormRules"
                class="industry-type-form"
            >
                <el-form-item :label="__('Certification Name')" prop="name">
                    <el-input
                        v-model="certificationForm.name"
                        :placeholder="__('Certification Name')"
                    ></el-input>

                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'name',
                                certificationForm.name,
                                'text'
                            )
                        "
                    >
                    </value-translator-btn>
                </el-form-item>
                <el-form-item
                    :label="__('Certification Type')"
                    prop="certification_type_id"
                >
                    <el-select
                        v-model="certificationForm.certification_type_id"
                        filterable
                        :placeholder="__('Select')"
                        class="full-width"
                    >
                        <el-option
                            v-for="item in certificationTypeData"
                            :key="item.id"
                            :value="item.id"
                            :label="item.name"
                        >
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item
                    :label="__('Certification Holder')"
                    prop="certification_holder_id"
                >
                    <el-select
                        v-model="certificationForm.certification_holder_id"
                        filterable
                        :placeholder="__('Select')"
                        class="full-width"
                    >
                        <el-option
                            v-for="item in certificationHoldersData"
                            :key="item.id"
                            :value="item.id"
                            :label="item.name"
                        >
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item :label="__('Description')" prop="description">
                    <el-input
                        type="textarea"
                        :rows="3"
                        v-model="certificationForm.description"
                        :placeholder="__('Description')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'description',
                                certificationForm.description,
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
                    @click="validateCertificationForm"
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
        pageData: {}
    },
    mixins: [translationForm],
    data() {
        return {
            certificationTypeData: [],
            certificationHoldersData: [],
            certificationData: [],
            certificationPagination: {},
            search: "",
            current_page: 1,
            current_size: 25,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: "create",
            certificationForm: {
                name: null,
                certification_type_id: null,
                certification_holder_id: null,
                description: null
            },
            certificationFormRules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input certification name"),
                        trigger: "blur"
                    }
                ],
                certification_type_id: [
                    {
                        required: true,
                        message: this.__("Please select a certification type"),
                        trigger: "blur"
                    }
                ],
                certification_holder_id: [
                    {
                        required: true,
                        message: this.__(
                            "Please select a certification holder"
                        ),
                        trigger: "blur"
                    }
                ]
            },
            filterVisible: false,
            filterForm: {
                certification_type_id: "All",
                certification_holder_id: "All"
            },
            showTranslationForm: false,
            savedCertificateData: []
        };
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "certification";

        if (this.pageData) {
            this.certificationTypeData = this.pageData.certificationTypes;
            this.certificationHoldersData = this.pageData.certificationHolders;
        } else {
            this.loadMetaData();
        }

        this.showCertifications();
    },
    methods: {
        loadMetaData() {
            let toLoad = ["certification_holder", "certification_types"];
            this.$API.Utils.getMetaData(toLoad)
                .then(res => {
                    if (Array.isArray(res.data)) {
                        this.certificationTypeData =
                            res.data.certification_holder;
                        this.certificationHoldersData =
                            res.data.certification_holder;
                    }
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(_ => {});
        },
        filterList() {
            this.filterVisible = false;
            this.showCertifications();
        },
        resetFilters() {
            this.filterForm = {
                certification_type_id: "All",
                certification_holder_id: "All"
            };

            this.showCertifications();
        },
        showCertifications() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
                filter: {
                    certification_type_id:
                        this.filterForm.certification_type_id == "All"
                            ? null
                            : this.filterForm.certification_type_id,
                    certification_holder_id:
                        this.filterForm.certification_holder_id == "All"
                            ? null
                            : this.filterForm.certification_holder_id
                }
            };
            this.$API.Certification.showCertifications(params)
                .then(res => {
                    this.certificationData = res.data.certifications.data;
                    this.certificationPagination = res.data.certifications;

                    this.tableLoading = false;
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(_ => {
                    this.tableLoading = false;
                });
        },
        openCreateCertificationModal() {
            this.mode = "create";
            this.resetFields();
            this.formDialogVisible = true;

            this.populateDefault();
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showCertifications();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showCertifications();
        },
        show(row, table) {
            this.tableLoading = true;

            this.$API.Certification.show(row.id)
                .then(res => {
                    this.certificationForm = res.data.certification;
                    this.mode = "edit";
                    this.formDialogVisible = true;

                    this.populateDefault(
                        cloneDeep(this.certificationForm.translations)
                    );
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(_ => {
                    this.tableLoading = false;
                });
        },
        askToDeleteCertification(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                confirmButtonClass: "el-button--danger",
                type: "warning"
            })
                .then(() => {
                    this.delete(id, index);
                })
                .catch(() => {});
        },
        closeFormDialog() {
            this.formDialogVisible = false;
            this.translate = [];
            this.resetFields();
        },
        resetFields() {
            this.certificationForm = {
                name: null,
                certification_type_id: null,
                certification_holder_id: null,
                description: null
            };
        },
        validateCertificationForm() {
            this.$refs["certificationForm"].validate(valid => {
                if (valid) {
                    if (this.mode == "create") {
                        this.store();
                    } else {
                        this.update();
                    }
                }
            });
        },
        store() {
            this.formDialogVisible = false;

            let postData = cloneDeep(this.certificationForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.Certification.store(postData)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });

                    // this.showCertifications();
                    this.certificationData.unshift(res.data);
                    this.resetFields();
                })
                .catch(err => {
                    this.formDialogVisible = true;
                    this.showValidationError(err);
                })
                .finally(_ => {
                    this.tableLoading = false;
                });
        },
        update() {
            this.formDialogVisible = false;

            let postData = cloneDeep(this.certificationForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.Certification.update(postData)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });

                    this.mode = "create";
                    this.resetFields();
                    // this.showCertifications();
                    this.certificationData.map(cert => {
                        if(cert.id === res.data.id) {
                            for(let key in res.data) {
                                cert[key] = res.data[key];
                            }
                        }
                    });
                })
                .catch(err => {
                    this.formDialogVisible = true;
                    this.showValidationError(err);
                })
                .finally(_ => {
                    this.tableLoading = false;
                });
        },
        delete(id, index) {

            this.$API.Certification.delete(id)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    this.certificationData.splice(index, 1);
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(_ => {
                    this.tableLoading = false;
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
        }
    }
};
</script>
<style lang="scss">

</style>
