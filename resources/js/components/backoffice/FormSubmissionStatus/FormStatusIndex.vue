<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
					 <div class="header-title">
                        <h5>{{ __('Form Status') }}</h5>
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
                            <el-button 
                            disabled
                            class="mh-btn">
                                <i class="fas fa-table"></i>
                            </el-button>
                            <el-button 
                            disabled
                            class="mh-btn">
                                <i class="fas fa-file-alt"></i>
                            </el-button>
                    </div>
                    <div class="add-new-button">
                            <el-button
                                round
                                class="btn btn-black"
                                @click="addFormStatus"
                            >
                                <i class="fas fa-plus"></i>
                                {{ __("Add New Form Status") }}
                            </el-button>
                    </div>
                </div>
                        <el-table 
                        class="table-list-container"
                        fit 
                        v-loading="loading" 
                        :data="formStatusList"
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
                            <el-table-column :label="__('Action')" align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button
                                            class="btn btn-default text-red"
                                            @click.stop
                                            @click="askToDelete(scope.row.id)"
                                        >
                                        <i class="fas fa-trash-alt"></i> {{ __('Delete') }} 
                                        </button>
                                    </div>
                                </template>
                            </el-table-column>
                        </el-table>

                        <div class="text-right mb-3">
                            <!--global-pagination
                                :current_page="filters.page"
                                :current_size="filters.size"
                                :pagination="filters"
                                @handleSizeChange="handleSize"
                                @handleCurrentChange="handlePage"
                            >
                            </global-pagination-->
                            <global-pagination
                                :current_page="current_page"
                                :current_size="current_size"
                                :pagination="formStatusPagination"
                                :total="filters.total"
                                @handleSizeChange="handleSizeChange"
                                @handleCurrentChange="handleCurrentChange"
                            >
                            </global-pagination>
                        </div>

                    <el-dialog
                        :visible.sync="showForm"
                        @close="handleClose"
                        :title="
                            mode == 'create'
                                ? __('Add New Form Status')
                                : __('Update Form Status')
                        "
                        width="30%"
                        top="4vh"
                    >
                        <el-form
                            v-loading="loading"
                            :rules="rules"
                            :model="formStatusForm"
                            ref="formStatusForm"
                            autocomplete="off"
                            label-position="top"
                        >
                            <div class="row">
                                <div class="col-md-12">
                                    <el-form-item
                                        :label="__('Form Status Name')"
                                        prop="name"
                                    >
                                        <el-input
                                            class="full-width round-input"
                                            :placeholder="__('Enter Form Status Name')"
                                            clearable
                                            v-model="formStatusForm.name"
                                        >
                                        </el-input>

                                        <value-translator-btn
                                            @showTranslationForm="
                                                setTranslationForm(
                                                    'name',
                                                    formStatusForm.name,
                                                    'text'
                                                )
                                            "
                                        >
                                        </value-translator-btn>
                                    </el-form-item>
                                </div>
                            </div>
                        </el-form>

                        <span slot="footer" class="dialog-footer">
                            <el-button
                                type="text"
                                class="text-black"
                                @click="handleClose"
                            >
                                <u>{{ __("Cancel") }}</u>
                            </el-button>
                            <el-button
                                round
                                type="primary"
                                class="btn btn-black"
                                @click="submitForm"
                            >
                                {{ mode == "create" ? __("Save") : __("Save") }}
                            </el-button>
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
        </div>
    </div>
</template>
<script>
import pagination from "../../../mixins/pagination";
import translationForm from "../../../mixins/translationForm.js";
import cloneDeep from "lodash/cloneDeep";
export default {
    name: "FormStatusIndex",
    mixins: [pagination, translationForm],
    data() {
        let columns = [
            {
                label: this.__("Form Status"),
                prop: "name",
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
            search: '',
            formStatusForm: {
                id: null,
                name: null
            },
            filters: {
                search: null
            },
            formStatusList: [],
            formStatusPagination: [],
            columns: columns,
            selectedModel: null,
            loading: false,
            current_page: 1,
            current_size: 25,
            current_total: 0,
            showForm: false,
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
        this.formFields = ["name"];
        this.fromTable = "form_submission_statuses";

        /*this.functionName = "fetch";
        this.filters.searchString = this.search;*/
        this.fetch();
    },
    methods: {
        applyFilter() {
            this.filters.page = 1;

            this.fetch();
        },
        fetch() {
            this.loading = true;

            //let postData = cloneDeep(this.filters);
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };

            /*this.$API.FormStatus.fetch(params)
                .then(res => {
                    this.formStatusList = res.data.data;
                    this.filters.total = res.data.total;
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(_ => {
                    this.loading = false;
                });*/
            this.$API.FormStatus.fetch(params).then(response => {
                this.formStatusList = response.data.data;
                this.formStatusPagination = response.data;
                this.filters.total = response.data.total;
                this.loading = false;
            });
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.fetch();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.fetch();
        },
        addFormStatus() {
            this.mode = "create";
            this.showForm = true;

            this.populateDefault();
        },
        edit(id) {
            this.formStatusForm = cloneDeep(id);
            this.mode = "edit";
            this.showForm = true;

            this.populateDefault(
                cloneDeep(this.formStatusForm.translations)
            );
        },
        submitForm() {
            this.$refs["formStatusForm"].validate(valid => {
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
            let postData = cloneDeep(this.formStatusForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.FormStatus.create(postData)
                .then(response => {
                    this.formStatusList.unshift(response.data);
                    this.$notify({
                        title: "Successful",
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });
                    this.filters.total++;
                    this.mode = "create";
                    this.handleClose();
                })
                .catch(err => {
                    switch (err.response.status) {
                        case 422:
                            this.errors = err.response.data.errors;
                            break;
                        default:
                            this.$notify({
                                title: "Error",
                                message: this.$msg.notif.service_error,
                                type: "error"
                            });
                            break;
                    }
                });
        },
        update() {
            let postData = cloneDeep(this.formStatusForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.FormStatus.update(postData, postData.id)
                .then(response => {
                    let data = response.data;

                    this.formStatusList.map(level => {
                        if (level.id == data.id) {
                            for (let key in data) {
                                level[key] = data[key];
                            }
                        }
                    });

                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });
                    this.mode = "create";
                    this.handleClose();
                })
                .catch(err => {
                    switch (err.response.status) {
                        case 422:
                            this.errors = err.response.data.errors;
                            break;
                        default:
                            this.$notify({
                                title: "Error",
                                message: this.$msg.notif.service_error,
                                type: "error"
                            });
                            break;
                    }
                });
            this.AdddialogVisible = false;
        },
        askToDelete(id, index) {
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
        delete(id, index) {
            this.$API.FormStatus.delete(id)
                .then(response => {
                    this.formStatusList.splice(index, 1);
                    this.$notify({
                        title: this.__("Successful"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });
                    this.filters.total--;
                })
                .catch(err => {
                    console.log(err);
                    this.$notify({
                        title: "Error",
                        message: this.$msg.notif.service_error,
                        type: "error"
                    });
                });
        },
        handleClose() {
            this.showForm = false;
            this.selectedModel = null;
            this.resetFields();
        },
        resetFields() {
            this.$refs["formStatusForm"].resetFields();
            this.formStatusForm.name = null;
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.askToDelete(info.data, info.index);
            } else if (info.action === "update") {
                this.edit(info.data);
            }
        }
    }
};
</script>
