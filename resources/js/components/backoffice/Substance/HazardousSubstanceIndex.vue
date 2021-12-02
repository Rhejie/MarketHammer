<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Hazardous Substances') }}</h5>
                    </div>
                    <div class="search-container" style="margin-right: 15px;">
                        <el-input
                            class="input-search"
                            v-model="search"
                            :placeholder="__('Type to search')"
                            @keyup.enter.native="showHazardousSubstances"
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
                            @click="openCreateHazardousSubstanceModal"
                        >
                            <i class="fas fa-plus"></i>
                            {{ __("Add Hazardous Substance") }}
                        </button>
                    </div>
                </div>
                <!-- Table -->
                <el-table
                    class="table-list-container"
                    :data="hazardousSubstanceData"
                    style="width: 100%; margin-top: 15px"
                    v-loading="tableLoading"
                    @row-click="show"
                >
                    <el-table-column prop="cas_num" :label="__('Cas No.')" :sortable="true">
                        <template slot-scope="scope">
                            {{ __dt(scope.row.translations, 'cas_num', $sf.ucwords(scope.row.cas_num)) }}
                        </template>
                    </el-table-column>
                    <el-table-column prop="name" :label="__('Substance Name')" :sortable="true">
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
                                <button class="btn btn-default text-red" @click.stop @click="askToDeleteHazardousSubstance(scope.row.id, scope.row.index)">
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
                        :pagination="hazardousSubstancePagination"
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
                    ? __('Add New Hazardous Substance')
                    : __('Update Hazardous Substance')
            "
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="hazardous-substance-dialog"
            :close-on-click-modal="false"
        >
            <el-form
                ref="hazardousSubstanceForm"
                :model="hazardousSubstanceForm"
                :rules="hazardousSubstanceFormRules"
                class="hazardous-substance-form"
            >
                <el-form-item :label="__('Cas No.')" prop="cas_num">
                    <el-input
                        v-model="hazardousSubstanceForm.cas_num"
                        :placeholder="__('Cas No.')"
                    >
                    </el-input>

                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'cas_num',
                                hazardousSubstanceForm.cas_num,
                                'text'
                            )
                        "
                    >
                    </value-translator-btn>
                </el-form-item>
                <el-form-item :label="__('Substance Name')" prop="name">
                    <el-input
                        v-model="hazardousSubstanceForm.name"
                        :placeholder="__('Substance Name')"
                    >
                    </el-input>

                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'name',
                                hazardousSubstanceForm.name,
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
                        v-model="hazardousSubstanceForm.description"
                        :placeholder="__('Description')"
                    >
                    </el-input>

                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'description',
                                hazardousSubstanceForm.description,
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
                    @click="validateHazardousSubstanceForm"
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
    name: "HazardousSubstanceIndex",
    mixins: [translationForm],
    data() {
        return {
            hazardousSubstanceData: [],
            hazardousSubstancePagination: {},
            search: "",
            current_page: 1,
            current_size: 25,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: "create",
            hazardousSubstanceForm: {
                cas_num: null,
                name: null,
                description: null,
            },
            hazardousSubstanceFormRules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input substance name"),
                        trigger: "blur",
                    },
                ],
            },
        };
    },
    created() {
        this.formFields = ["cas_num", "name", "description"];
        this.fromTable = "hazardous_substance";

        this.showHazardousSubstances();
    },
    methods: {
        showHazardousSubstances() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
            };
            this.$API.HazardousSubstance.showHazardousSubstances(params)
                .then((res) => {
                    this.hazardousSubstanceData =
                        res.data.hazardousSubstances.data;
                    this.hazardousSubstancePagination =
                        res.data.hazardousSubstances;
                    this.tableLoading = false;
                })
                .catch((_) => {});
        },
        openCreateHazardousSubstanceModal() {
            this.mode = "create";
            this.formDialogVisible = true;

            this.populateDefault();
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showHazardousSubstances();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showHazardousSubstances();
        },
        show(row) {
            // this.tableLoading = true;
            // this.$API.HazardousSubstance.show(row.id)
            //     .then((res) => {
            //         this.hazardousSubstanceForm = res.data.hazardousSubstance;
            //         this.mode = "edit";
            //         this.formDialogVisible = true;

            //         this.populateDefault(
            //             cloneDeep(this.hazardousSubstanceForm.translations)
            //         );
            //     })
            //     .catch((err) => {
            //         console.log(err);
            //     })
            //     .finally((_) => {
            //         this.tableLoading = false;
            //     });

            this.formDialogVisible = true;
            this.hazardousSubstanceForm = {...row};
            this.mode = 'update';
            this.populateDefault(cloneDeep(this.hazardousSubstanceForm.translations));
        },
        askToDeleteHazardousSubstance(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                confirmButtonClass: "el-button--danger",
                type: "warning",
            })
                .then(() => {
                    this.delete(id, index);
                })
                .catch(() => {});
        },
        closeFormDialog() {
            this.formDialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs["hazardousSubstanceForm"].resetFields();
        },
        validateHazardousSubstanceForm() {
            this.$refs["hazardousSubstanceForm"].validate((valid) => {
                if (valid) {
                    if (this.mode == "create") {
                        this.store();
                    } else {
                        this.update();
                    }
                }
            });
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.askToDeleteHazardousSubstance(info.data, info.index);
            } else if (info.action === "update") {
                this.show(info.data);
            }
        },

        store() {
            // this.tableLoading = true;
            this.formDialogVisible = false;

            let postData = cloneDeep(this.hazardousSubstanceForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.HazardousSubstance.store(postData)
                .then((res) => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_add,
                        type: "success",
                    });

                    // this.showHazardousSubstances();
                    this.hazardousSubstanceData.unshift(res.data);
                    this.resetFields();
                })
                .catch((err) => {
                    this.formDialogVisible = true;
                    this.showValidationError(err);
                })
                .finally((_) => {
                    this.tableLoading = false;
                });
        },
        update() {
            // this.tableLoading = true;
            this.formDialogVisible = false;

            let postData = cloneDeep(this.hazardousSubstanceForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.HazardousSubstance.update(postData)
                .then((res) => {
                    let data = res.data;
                    this.hazardousSubstanceData.map(hazard => {
                        if(hazard.id === data.id) {
                            for(let key in data) {
                                hazard[key] = data[key];
                            }
                        }
                    });
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success",
                    });

                    this.mode = "create";
                    this.resetFields();
                })
                .catch((err) => {
                    this.formDialogVisible = true;
                    this.showValidationError(err);
                })
                .finally((_) => {
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
                            errors.map((errmsg) => {
                                return h(
                                    "div",
                                    { style: "list-style-type: none" },
                                    errmsg
                                );
                            })
                        ),
                        type: "error",
                    });
                }
            }
        },
        delete(id, index) {
            // this.tableLoading = true;

            this.$API.HazardousSubstance.delete(id)
                .then((res) => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success",
                    });

                    // this.showHazardousSubstances();
                    this.hazardousSubstanceData.splice(index, 1);
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally((_) => {
                    this.tableLoading = false;
                });
        },
    },
    watch: {
        search(val) {
            if(val === '') {
                this.showHazardousSubstances();
            }
        }
    }
};
</script>
<style lang="scss">
.hazardous-substance-list {
    .el-dialog {
        .el-dialog__body {
            padding: 20px;
        }
        .hazardous-substance-form {
        }
    }
}
</style>
