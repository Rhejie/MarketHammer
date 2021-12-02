<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Form Type') }}</h5>
                    </div>
                    <div class="search-container">
                        <el-input
                            suffix-icon="fas fa-search"
                            class="search-box round-input"
                            clearable
                            @keyup.enter.native="applyFilter"
                            v-model="search"
                            :placeholder="__('Type to search')">
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
                                    @click="addFormType"
                                >
                                    <i class="fas fa-plus"></i>
                                    {{ __("Add New Form Type") }}
                                </el-button>
                    </div>
                </div>
                            <el-table 
                            class="table-list-container"
                            fit 
                            v-loading="loading" 
                            :data="formTypeList"
                            @row-click="edit"
                            >
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
                                <el-table-column :label="__('Action')" align="center"  >
                                    <template slot-scope="scope">
                                        <div>
                                            <button class="btn btn-default text-red" @click.stop @click="askToDelete(scope.row.id)"> 
                                                <i class="fas fa-trash-alt"></i> {{ __("Delete") }} 
                                            </button>
                                        </div>
                                    </template>
                                </el-table-column>
                            </el-table>

                            <div class="text-right mb-3">
                                <global-pagination
                                    :current_page="current_page"
                                    :current_size="current_size"
                                    :pagination="formTypePagination"
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
                                    ? __('Add New Form Type')
                                    : __('Update Form Type')
                            "
                            width="30%"
                            top="4vh"
                        >
                            <el-form
                                v-loading="loading"
                                :rules="rules"
                                :model="formTypeForm"
                                ref="formTypeForm"
                                autocomplete="off"
                                label-position="top"
                            >
                                <div class="row">
                                    <div class="col-md-12">
                                        <el-form-item
                                            :label="__('Form Type Name')"
                                            prop="name"
                                        >
                                            <el-input
                                                class="full-width round-input"
                                                :placeholder="__('Enter Form Type Name')"
                                                clearable
                                                v-model="formTypeForm.name"
                                            >
                                            </el-input>

                                            <value-translator-btn
                                                @showTranslationForm="
                                                    setTranslationForm(
                                                        'name',
                                                        formTypeForm.name,
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
    name: "FormTypeIndex",
    mixins: [pagination, translationForm],
    data() {
        let columns = [
            {
                label: this.__("Form Type"),
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
            formTypeForm: {
                id: null,
                name: null
            },
            filters: {
                search: null
            },
            formTypeList: [],
            formTypePagination: [],
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
        this.fromTable = "form_types";

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

            this.$API.FormType.fetch(params).then(response => {
                this.formTypeList = response.data.data;
                this.formTypePagination = response.data;
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
        addFormType() {
            this.mode = "create";
            this.showForm = true;

            this.populateDefault();
        },
        edit(id) {
            this.formTypeForm = cloneDeep(id);
            this.mode = "edit";
            this.showForm = true;

            this.populateDefault(
                cloneDeep(this.formTypeForm.translations)
            );
        },
        submitForm() {
            this.$refs["formTypeForm"].validate(valid => {
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
            let postData = cloneDeep(this.formTypeForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.FormType.create(postData)
                .then(response => {
                    this.formTypeList.unshift(response.data);
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
            let postData = cloneDeep(this.formTypeForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.FormType.update(postData, postData.id)
                .then(response => {
                    let data = response.data;

                    this.formTypeList.map(level => {
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
            this.$API.FormType.delete(id)
                .then(response => {
                    this.formTypeList.splice(index, 1);
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
            this.$refs["formTypeForm"].resetFields();
            this.formTypeForm.name = null;
        },
    }
};
</script>
