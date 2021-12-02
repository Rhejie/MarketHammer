<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Employee Count') }}</h5>
                    </div>
                    <div class="search-container" style="margin-right: 15px;">
                        <el-input
                            class="input-search"
                            v-model="search"
                            :placeholder="__('Type to search')"
                            @keyup.enter.native="showEmployeeCounts"
                        >
                            <i
                                slot="suffix"
                                class="el-input__icon el-icon-search"
                            ></i>
                        </el-input>
                    </div>
                    <div class="add-new-button">
                        <button
                            group="button"
                            class="btn btn-primary btn-black"
                            @click="openCreateEmployeeCountModal"
                        >
                            <i class="fas fa-plus"></i>
                            {{ __("Add Employee Count") }}
                        </button>
                    </div>
                </div>
                <!-- Table -->
                <el-table
                    class="table-list-container"
                    :data="employeeCountData"
                    style="width: 100%; margin-top: 15px;"
                    v-loading="tableLoading"
                    @row-click="editEmployeeCount"
                >
                    <el-table-column prop="name" :label="__('Employee Count')" :sortable="true">
                        <template slot-scope="scope">
                                {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
                        </template>
                    </el-table-column>

                    <el-table-column prop="description" :label="__('Description')" :sortable="true">
                        <template slot-scope="scope">
                            {{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
                        </template>
                    </el-table-column>

                    <el-table-column :label="__('Action')" align="center">
                        <template slot-scope="scope">
                            <div>
                                <button class="btn btn-default text-red" @click.stop @click="askToDeleteEmployeeCount(scope.row.id, scope.row.index)">
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
                        :pagination="employeeCountPagination"
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
                    ? __('Add New Employee Count')
                    : __('Update Employee Count')
            "
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="employee-count-dialog"
            :close-on-click-modal="false"
        >
            <el-form
                ref="employeeCountForm"
                :model="employeeCountForm"
                :rules="employeeCountFormRules"
                class="employee-count-form"
            >
                <el-form-item :label="__('Employee Count')" prop="name">
                    <el-input
                        v-model="employeeCountForm.name"
                        :placeholder="__('Employee Count')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'name',
                                employeeCountForm.name,
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
                        v-model="employeeCountForm.description"
                        :placeholder="__('Description')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'description',
                                employeeCountForm.description,
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
                    @click="validateEmployeeCountForm"
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
            employeeCountData: [],
            employeeCountPagination: {},
            search: "",
            current_page: 1,
            current_size: 25,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: "create",
            employeeCountForm: {
                name: null,
                description: null
            },
            employeeCountFormRules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input employee count"),
                        trigger: "blur"
                    }
                ]
            }
        };
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "employee_count";

        this.showEmployeeCounts();
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.showEmployeeCounts();
                return;
            }
        }
    },
    methods: {
        showEmployeeCounts() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.EmployeeCount.showEmployeeCounts(params)
                .then(res => {
                    this.employeeCountData = res.data.employeeCounts.data;
                    this.employeeCountPagination = res.data.employeeCounts;
                    this.tableLoading = false;
                })
                .catch(_ => {});
        },
        openCreateEmployeeCountModal() {
            this.mode = "create";
            this.formDialogVisible = true;

            this.populateDefault();
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showEmployeeCounts();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showEmployeeCounts();
        },
        editEmployeeCount(row) {
            this.mode = 'update'
            this.employeeCountForm = {...row};
            this.formDialogVisible = true;
            this.populateDefault(cloneDeep(this.employeeCountForm.translations));
        },
        askToDeleteEmployeeCount(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                confirmButtonClass: "el-button--danger",
                type: "warning"
            })
                .then(() => {
                    this.deleteEmployeeCount(id, index);
                })
                .catch(() => {});
        },
        closeFormDialog() {
            this.formDialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs["employeeCountForm"].resetFields();
        },
        validateEmployeeCountForm() {
            this.$refs["employeeCountForm"].validate(valid => {
                if (valid) {
                    if (this.mode == "create") {
                        this.storeEmployeeCount();
                    } else {
                        this.updateEmployeeCount();
                    }
                }
            });
        },
        storeEmployeeCount() {

            let postData = cloneDeep(this.employeeCountForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.EmployeeCount.storeEmployeeCount(postData)
                .then(res => {
                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });
                    // this.showEmployeeCounts();

                    this.employeeCountData.unshift(res.data);
                    console.log(res);
                    this.formDialogVisible = false;

                    this.resetFields();
                })
                .catch(err => {
                    this.formDialogVisible = true;
                    this.tableLoading = false;
                    this.showValidationError(err);
                });
        },
        updateEmployeeCount() {

            let postData = cloneDeep(this.employeeCountForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.EmployeeCount.updateEmployeeCount(postData)
                .then(res => {
                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });
                    this.mode = "create";
                    let data = res.data;
                    console.log(data);

                    this.employeeCountData.map(emp => {
                        for(let key in data) {
                            if(data.id === emp.id) {
                                emp[key] = data[key];
                            }
                        }
                    });

                    this.resetFields();
                    this.formDialogVisible = false;
                })
                .catch(err => {
                    this.formDialogVisible = true;
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
        deleteEmployeeCount(id, index) {
            this.$API.EmployeeCount.destroyEmployeeCount(id)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    this.employeeCountData.splice(index, 1);
                })
                .catch(_ => {});
        }
    }
};
</script>
<style lang="scss">
.employee-count-list {
    .el-dialog {
        .el-dialog__body {
            padding: 20px;
        }
        .employee-count-form {
        }
    }
}
</style>
