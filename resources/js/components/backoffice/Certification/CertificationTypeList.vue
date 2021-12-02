<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Certification Type') }}</h5>
                    </div>
                    <div class="search-container">
                         <el-input
                                    suffix-icon="fas fa-search"
                                    class="search-box round-input"
                                    clearable
                                    @keyup.enter.native="applyFilter"
                                    v-model="search"
                                    :placeholder="__('Type to search')"
                                >
                        </el-input>
                    </div>
                    <div class="secondary-action-buttons">
                         <base-filter-dropdown-box :width="400" :disabled="true">
                                    <el-form slot="body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <el-form-item label="To Filter">
                                                    <el-select
                                                        class="full-width"
                                                        v-model="filters.toFilter"
                                                    >
                                                        <el-option
                                                            :label="__('Issued Date')"
                                                            value="issued_date"
                                                        ></el-option>
                                                        <el-option
                                                            :label="__('Expiry Date')"
                                                            value="expiry_date"
                                                        ></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </div>
                                            <div class="col-md-8">
                                                <el-form-item :label="__('Date Added')">
                                                    <el-date-picker
                                                        class="full-width"
                                                        v-model="filters.daterange"
                                                        type="daterange"
                                                        value-format="yyyy-MM-dd"
                                                        clearable
                                                        :placeholder="__('Pick a date')"
                                                    >
                                                    </el-date-picker>
                                                </el-form-item>
                                            </div>
                                        </div>

                                        <el-button
                                            @click="applyFilter"
                                            class="full-width mb-3"
                                            type="primary"
                                        >
                                            {{ __("Apply") }}
                                        </el-button>
                                    </el-form>
                                </base-filter-dropdown-box>
                                <el-button disabled>
                                    <i class="fas fa-table"></i>
                                </el-button>
                                <el-button disabled>
                                    <i class="fas fa-file-alt"></i>
                                </el-button>
                    </div>
                    <div class="add-new-button">
                        <el-button round class="btn btn-black" @click="addType">
                            <i class="fas fa-plus"></i>
                            {{ __("Add New Certification Type") }}
                        </el-button>
                    </div>
                </div>
                <el-table
                class="table-list-container"
                fit
                v-loading="loading"
                :data="certificationTypeList"
                @row-click="edit">

                    <el-table-column
                        v-for="column in columns"
                        :key="column.prop"
                        :label="column.label"
                        :show-overflow-tooltip="column.showTooltip"
                        :sortable="column.sortable"
                        :prop="column.prop"
                    >
                        <template slot-scope="scope">
                            <template v-if = "column.prop == 'name'">
                                {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
                            </template>

                            <template v-else-if = "column.prop == 'description'">
                                {{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
                            </template>

                            <template v-else-if="column.prop === 'created_at'">
                                {{
                                    $df.formatDate(
                                        scope.row.created_at,
                                        "YYYY-MM-DD"
                                    )
                                }}
                            </template>

                            <template v-else>
                                {{ scope.row[column.prop] }}
                            </template>
                        </template>
                    </el-table-column>

                    <el-table-column :label="__('Actions')">
                        <template slot-scope="scope">
                            <div>
                                <button
                                    class="btn btn-default text-red"
                                    @click.stop
                                    @click="deleteData(scope.row, scope.row.index)"
                                >
                                    <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                </button>
                            </div>
                        </template>
                    </el-table-column>
                </el-table>

                <div class="text-right mb-3">
                    <global-pagination
                        :current_page="filters.page"
                        :current_size="filters.size"
                        :pagination="filters"
                        @handleSizeChange="handleSize"
                        @handleCurrentChange="handlePage"
                    >
                    </global-pagination>
                </div>

                <el-dialog
                    :visible.sync="showDialog"
                    @close="handleClose"
                    :title="
                        mode == 'create'
                            ? __('Add New Certification Type')
                            : __('Update Certification Type')
                    "
                    width="30%"
                    top="4vh"
                >
                    <el-form
                        v-loading="loading"
                        :rules="rules"
                        :model="certificationTypeForm"
                        ref="certificationTypeForm"
                        autocomplete="off"
                        label-position="top"
                    >
                        <div class="row">
                            <div class="col-md-12">
                                <el-form-item :label="__('Certification Type')" prop="name">
                                    <el-input
                                        class="full-width round-input"
                                        :placeholder="__('Enter Certification Type')"
                                        clearable
                                        v-model="certificationTypeForm.name"
                                    >
                                    </el-input>

                                    <value-translator-btn
                                        @showTranslationForm="
                                            setTranslationForm(
                                                'name',
                                                certificationTypeForm.name,
                                                'text'
                                            )
                                        "
                                    >
                                    </value-translator-btn>
                                </el-form-item>

                                <el-form-item
                                    :label="__('Description')"
                                    prop="description"
                                >
                                    <el-input
                                        class="full-width round-input"
                                        :placeholder="__('Enter Description')"
                                        clearable
                                        type="textarea"
                                        :autosize="{ minRows: 2, maxRows: 6 }"
                                        v-model="certificationTypeForm.description"
                                    >
                                    </el-input>
                                    <value-translator-btn
                                        @showTranslationForm="
                                            setTranslationForm(
                                                'description',
                                                certificationTypeForm.description,
                                                'textarea'
                                            )
                                        "
                                    >
                                    </value-translator-btn>
                                </el-form-item>
                            </div>
                        </div>
                    </el-form>

                    <span slot="footer" class="dialog-footer">
                        <el-button type="text" class="text-black" @click="handleClose">
                            <u>{{ __("Cancel") }}</u>
                        </el-button>
                        <el-button
                            round
                            @click="submitForm"
                            type="primary"
                            class="btn btn-black"
                        >
                            {{ mode == 'create' ? __('Save') : __('Save') }}
                        </el-button>
                    </span>
                </el-dialog>
            </div>
        </div>
    </div>
</template>

<script>
import cloneDeep from "lodash/cloneDeep";
import pagination from "../../../mixins/pagination";
import translationForm from "../../../mixins/translationForm.js";
export default {
    name: "CertificationTypeList",
    mixins: [pagination, translationForm],
    data() {
        let columns = [
            {
                label: this.__("Certification Type"),
                prop: "name",
                showTooltip: true,
                sortable: true
            },
            {
                label: this.__("Description"),
                prop: "description",
                showTooltip: true,
                sortable: true
            },
            {
                label: this.__("Date Added"),
                prop: "created_at",
                showTooltip: true,
                sortable: true
            }
        ];

        return {
            certificationTypeForm: {
                id: null,
                name: null,
                description: null
            },
            filters: {
                searchString: null
            },
            certificationTypeList: [],
            columns: columns,
            selectedModel: null,
            loading: false,
            //showForm: false,
            showDialog: false,
            search: null,
            mode: null,
            rules: {
                name: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                }
            }
        };
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "certification_type";
        // check pagination mixins
        this.functionName = "fetch";

        this.fetch();

        this.$EventDispatcher.listen(
            "CERTIFICATION_TYPE_MODULE_ITEM_CREATED",
            type => {
                this.certificationTypeList.unshift(type);
            }
        );

        this.$EventDispatcher.listen(
            "CERTIFICATION_TYPE_MODULE_ITEM_UPDATED",
            type => {
                let index = this.certificationTypeList.findIndex(
                    fa => fa.id == type.id
                );

                if (index > -1) {
                    this.certificationTypeList.splice(index, 1, type);
                }
            }
        );
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.applyFilter();
                return;
            }
        }
    },
    methods: {
        addType() {
            this.mode = "create";
            this.showDialog = true;

            this.populateDefault();
        },
        applyFilter() {
            this.filters.page = 1;
            this.filters.searchString = this.search;
            this.fetch();
        },
        fetch() {
            this.loading = true;

            let postData = cloneDeep(this.filters);

            this.$API.CertificationType.fetch(postData)
                .then(res => {
                    this.certificationTypeList = res.data.data;
                    this.filters.total = res.data.total;
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(_ => {
                    this.loading = false;
                });
        },
        addTotalCertificationTypes() {
            this.filters.total++;
        },
        submitForm() {
            this.$refs["certificationTypeForm"].validate(valid => {
                if (valid) {
                    if (this.mode == "create") {
                        this.store();
                    } else {
                        this.update();
                    }
                }
            });
        },
        store() {;

            let postData = cloneDeep(this.certificationTypeForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.CertificationType.create(postData)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        });

                        this.$EventDispatcher.fire(
                            "CERTIFICATION_TYPE_MODULE_ITEM_CREATED",
                            res.data.data
                        );

                        this.$emit("addTotalCertification");

                        this.filters.total++;
                        this.mode = "create";
                        this.handleClose();

                        return;
                    }

                    this.$notify({
                        title: this.__("Failed"),
                        message: this.$msg.notif.failed_add,
                        type: "error"
                    });
                })
                .catch(err => {
                    console.log(err);

                    this.showValidationError(err);
                })
                .finally(_ => {
                    this.loading = false;
                });
        },
        edit(model) {
            /*this.showForm = true;
            this.selectedModel = cloneDeep(model);*/

            this.certificationTypeForm = cloneDeep(model);
            this.mode = "edit";
            this.showDialog = true;

            this.populateDefault(
                cloneDeep(this.certificationTypeForm.translations)
            );
        },
        update() {

            let postData = cloneDeep(this.certificationTypeForm);
			this.setCurrrentLangDefaultValue(postData);

            this.$API.CertificationType.update(postData, postData.id)
                .then(res => {
                    if (res.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_update,
                            type: "success"
                        });

                        // this.$EventDispatcher.fire(
                        //     "CERTIFICATION_TYPE_MODULE_ITEM_UPDATED",
                        //     res.data.data
                        // );

                        this.certificationTypeList.map(cert => {
                            for(let key in res.data) {
                                if(cert.id === res.data.id) {
                                    cert[key] = res.data[key];
                                }
                            }
                        });

                        this.mode = "create";
                        this.handleClose();
                        this.showDialog = false;

                        return;
                    }

                    this.$notify({
                        title: this.__("Failed"),
                        message: this.$msg.notif.failed_update,
                        type: "error"
                    });
                })
                .catch(err => {
                    console.log(err);

                    this.$notify({
                        title: this.__("Server Error"),
                        message: this.$msg.notif.service_error,
                        type: "error"
                    });
                })
                .finally(_ => {
                    this.loading = false;
                });
        },
        deleteData(type, index) {
            this.$confirm(
                this.$msg.notif.confirm_delete,
                this.__("Warning"),
                {
                    confirmButtonText: this.__("Delete"),
                    cancelButtonText: this.__("Cancel"),
                    type: "warning",
                    confirmButtonClass: "el-button--danger"
                }
            )
                .then(() => {
                    this.$API.CertificationType.delete(type.id)
                        .then(res => {
                            if (res.data) {
                                this.$notify({
                                    title: this.__("Successful"),
                                    message: this.$msg.notif.success_delete,
                                    type: "success"
                                });

                                this.certificationTypeList.splice(index, 1);

                                return;
                            }

                            this.$notify({
                                title: this.__("Delete Failed"),
                                message: this.$msg.notif.failed_delete,
                                type: "error"
                            });
                        })
                        .catch(err => {
                            console.log(err);

                            this.$notify({
                                title: this.__("Error"),
                                message: this.$msg.notif.service_error,
                                type: "error"
                            });
                        })
                        .finally(_ => {
                            this.loading = false;
                        });
                })
                .catch(() => {});
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.delete(info.data);
            } else if (info.action === "edit") {
                this.edit(info.data);
            }
        },
        handleClose() {
            this.showDialog = false;
            //this.selectedModel = null;
            this.resetFields();
        },
        resetFields() {
            this.$refs['certificationTypeForm'].resetFields();
            this.certificationTypeForm.name = null
            this.certificationTypeForm.description = null
        },
    }
};
</script>

<style lang="scss"></style>
