<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Complex Type') }}</h5>
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
                        <!-- <base-filter-dropdown-box
                                    :width="400"
                                    :disabled="true">
                                    <el-form
                                        slot="body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <el-form-item
                                                    label="To Filter">
                                                    <el-select
                                                        class="full-width"
                                                        v-model="filters.toFilter">
                                                        <el-option label="Issued Date" value="issued_date"></el-option>
                                                        <el-option label="Expiry Date" value="expiry_date"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </div>
                                            <div class="col-md-8">
                                                <el-form-item
                                                    label="Date Added">
                                                    <el-date-picker
                                                        class="full-width"
                                                        v-model="filters.daterange"
                                                        type="daterange"
                                                        value-format="yyyy-MM-dd"
                                                        clearable
                                                        placeholder="Pick a date">
                                                    </el-date-picker>
                                                </el-form-item>
                                            </div>
                                        </div>

                                        <el-button
                                            @click="applyFilter"
                                            class="full-width mb-3"
                                            type="primary">
                                            Apply
                                        </el-button>
                                    </el-form>
                                </base-filter-dropdown-box> -->
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
                        <el-button round class="btn btn-black" @click="addLocation">
                            <i class="fas fa-plus"></i>
                            {{ __('Add New Complex Type') }}
                        </el-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="area_data">
            <el-card class="box-card full-width mt-2" style="padding: 10px">
                <el-table v-loading="tableLoading" fit :data="complexTypeData" @row-click="editComplex">
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

                    <el-table-column :label="__('Action')" align="center">
                        <template slot-scope="scope">
                            <div>
                                <button
                                    class="btn btn-default text-red"
                                    @click.stop
                                    @click="
                                        askToDeleteComplex(
                                            scope.row.id,
                                            scope.$index
                                        )
                                    "
                                >
                                    <i class="fas fa-trash-alt"></i>  {{ __("Delete") }}
                                </button>
                            </div>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="text-right mb-3">
                    <global-pagination
                        :current_page="current_page"
                        :current_size="current_size"
                        :pagination="complexTypeDataPagination"
                        :total="filters.total"
                        @handleSizeChange="handleSizeChange"
                        @handleCurrentChange="handleCurrentChange"
                    >
                    </global-pagination>
                </div>
            </el-card>
        </div>

        <el-dialog
            :title="mode == 'create' ? 'Add New Complex Type' : 'Update Complex Type'"
            :visible.sync="AdddialogVisible"
            width="45%"
        >
            <el-form
                :model="addNewLocationData"
                :rules="rules"
                ref="addNewLocationData"
                class="demo-ruleForm"
            >
                <el-form-item :label="__('Complex Type')" prop="name">
                    <el-input
                        v-model="addNewLocationData.name"
                        :placeholder="__('Complex Type')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'name',
                                addNewLocationData.name,
                                'text'
                            )
                        "
                    >
                    </value-translator-btn>
                </el-form-item>
                <el-form-item :label="__('Description')" prop="description">
                    <el-input
                        type="textarea"
                        :placeholder="__('Description')"
                        v-model="addNewLocationData.description"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'description',
                                addNewLocationData.description,
                                'textarea'
                            )
                        "
                    >
                    </value-translator-btn>
                </el-form-item>
                <el-form-item>
                    <div style="float: right">
                        <button
                            type="button"
                            class="btn btn-default"
                            @click="dialog"
                        >
                            {{ __("Cancel") }}
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary btn-black"
                            @click="submitForm"
                        >
                            {{ __('Save') }}
                        </button>
                    </div>
                </el-form-item>
            </el-form>
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
import pagination from "../../../mixins/pagination";
import addNewComplexData from "./Forms/AddComplexTypeForm";
import editComplexData from "./Forms/EditComplexTypeForm";
import translationForm from "../../../mixins/translationForm.js";
import cloneDeep from "lodash/cloneDeep";
export default {
    name: "ComplexType",
    components: {
        addNewComplexData,
        editComplexData
    },
    mixins: [pagination, translationForm],
    data() {
        return {
            complexTypeData: [],
            addNewLocationData: {
                name: null,
                description: null
            },
            complexTypeDataPagination: [],
            editComplexData: [],
            columns: [
                {
                    label: this.__("Complex Type"),
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
            ],
            search: "",
            current_page: 1,
            current_size: 25,
            filters: {
                search: null
            },
            mode: null,
            current_total: 0,
            tableLoading: true,
            AdddialogVisible: false,
            EditdialogVisible: false,
            rules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input area name"),
                        trigger: "blur",
                    },
                ],
            },
        };
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.getComplexTypes();
                return;
            }
        }
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "complex_types";

        //this.getComplexLocations()
    },
    mounted() {
        this.getComplexTypes();
    },
    methods: {
        addLocation() {
            this.mode = "create";
            this.AdddialogVisible = true;

            this.populateDefault();
        },
        applyFilter() {
            this.getComplexTypes();
        },
        getComplexTypes() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.ComplexType.fetch(params).then(response => {
                this.complexTypeData = response.data.data;
                this.complexTypeDataPagination = response.data;
                this.filters.total = response.data.total;
                this.tableLoading = false;
            });
        },
        addNewComplexTypeData(formdata) {
            this.AdddialogVisible = false;
            this.complexTypeData.unshift(formdata);
        },
        editComplex(data) {
            /*this.EditdialogVisible = true;
            this.editComplexData = { ...data };*/
            this.addNewLocationData = cloneDeep(data);
            this.mode = "edit";
            this.AdddialogVisible = true;

            this.populateDefault(
                cloneDeep(this.addNewLocationData.translations)
            );
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.askToDeleteComplex(info.data, info.index);
            } else if (info.action === "update") {
                this.editComplex(info.data);
            }
        },
        submitForm() {
            this.$refs["addNewLocationData"].validate(valid => {
                if (valid) {
                    if (this.mode == "create") {
                        this.create();
                    } else {
                        this.update();
                    }
                }
            });
        },
        create() {
            let postData = cloneDeep(this.addNewLocationData);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.ComplexType.create(postData)
                .then(response => {
                    this.complexTypeData.unshift(response.data);
                    this.$notify({
                        title: "Successful",
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });
                    this.filters.total++;
                    //this.AdddialogVisible = false;
                    this.mode = "create";
                    this.dialog();
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
            let postData = cloneDeep(this.addNewLocationData);
            this.setCurrrentLangDefaultValue(postData);
            console.log(postData);

            this.$API.ComplexType.update(postData, postData.id)
                .then(response => {
                    let data = response.data;

                    this.complexTypeData.map(complex => {
                        if (complex.id == data.id) {
                            for (let key in data) {
                                complex[key] = data[key];
                            }
                        }
                    });

                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });
                    this.mode = "create";
                    this.dialog();
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
        updateComplexType(data) {
            this.complexTypeData.map(complex => {
                if (complex.id == data.id) {
                    for (let key in data) {
                        complex[key] = data[key];
                    }
                }
            });
            this.EditdialogVisible = false;
        },
        /*cancelEdit() {
            this.EditdialogVisible = false;
        },*/
        askToDeleteComplex(id, index) {
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
            this.$API.ComplexType.delete(id)
                .then(response => {
                    this.complexTypeData.splice(index, 1);
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
        handleSizeChange(val) {
            this.current_size = val;
            this.getComplexTypes();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.getComplexTypes();
        },
        handleClose(done) {
            this.$confirm(this.__("Are you sure to close?"))
                .then(_ => {
                    done();
                })
                .catch(_ => {});
        },
        dialog() {
            this.AdddialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs["addNewLocationData"].resetFields();
            this.addNewLocationData.name = null;
            this.addNewLocationData.description = null;
        }
    }
};
</script>
