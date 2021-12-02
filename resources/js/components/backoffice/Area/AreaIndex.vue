<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Area Type') }}</h5>
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
                                <el-button disabled>
                                    <i class="fas fa-table"></i>
                                </el-button>
                                <el-button disabled>
                                    <i class="fas fa-file-alt"></i>
                                </el-button>
                    </div>
                    <div class="add-new-button">
                        <el-button
                            round
                            class="btn btn-black"
                            @click="addArea"
                        >
                            <i class="fas fa-plus"></i> {{ __("Add New Area Type") }}
                        </el-button>
                    </div>
                </div>
                <el-table
                class="table-list-container"
                v-loading="tableLoading"
                fit
                :data="areasData"
                @row-click="editArea">
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
                        :pagination="areasDataPagination"
                        :total="filters.total"
                        @handleSizeChange="handleSizeChange"
                        @handleCurrentChange="handleCurrentChange"
                    >
                    </global-pagination>
                </div>
            </div>

            <el-dialog
            :title="mode == 'create'
                    ? __('Add New Area Type')
                    : __('Update Area Type')"
            :visible.sync="AdddialogVisible"
            width="45%">
                <el-form
                    :model="addNewAreaData"
                    :rules="rules"
                    ref="addNewAreaData"
                    class="demo-ruleForm"
                >
                    <el-form-item label="Area Name" prop="name">
                        <el-input
                            v-model="addNewAreaData.name"
                            :placeholder="__('Area Name')"
                        ></el-input>
                        <value-translator-btn
                            @showTranslationForm="
                                setTranslationForm(
                                    'name',
                                    addNewAreaData.name,
                                    'text'
                                )
                            "
                        >
                        </value-translator-btn>
                    </el-form-item>
                    <el-form-item label="Description" prop="description">
                        <el-input
                            type="textarea"
                            :placeholder="__('Description')"
                            v-model="addNewAreaData.description"
                        ></el-input>
                        <value-translator-btn
                            @showTranslationForm="
                                setTranslationForm(
                                    'description',
                                    addNewAreaData.description,
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
                @settranslationdata="setTranslationData">
            </value-translator-form>
        </div>

    </div>
</template>
<script>
import cloneDeep from "lodash/cloneDeep";
import pagination from "../../../mixins/pagination";
import translationForm from "../../../mixins/translationForm.js";

export default {
    name: "Area",
    mixins: [pagination, translationForm],
    data() {
        return {
            areasData: [],
            addNewAreaData: {
                name: null,
                description: null,
            },
            areasDataPagination: [],
            showForm: false,
            columns: [
                {
                    label: this.__("Area"),
                    prop: "name",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Description"),
                    prop: "description",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Date Added"),
                    prop: "created_at",
                    showTooltip: true,
                    sortable: true,
                },
            ],
            editAreaData: [],
            AdddialogVisible: false,
            EditdialogVisible: false,
            search: "",
            current_page: 1,
            current_size: 25,
            filters: {
                search: null,
            },
            mode: null,
            current_total: 0,
            tableLoading: true,
            errors: { name: "", description: "" },
            rules: {
                name: [
                    {
                        required: true,
                        message: "Please input area name",
                        trigger: "blur",
                    },
                ],
            },
        };
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.getAreas();
                return;
            }
        },
    },
    created() {
        this.formFields = ['name', 'description']
        this.fromTable = 'usage_areas'

    },
    mounted() {
        this.getAreas();
    },
    methods: {
        addArea() {
            this.mode = "create";
            this.AdddialogVisible = true;

            this.populateDefault()
        },
        applyFilter() {
            this.getAreas();
        },
        getAreas() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
            };

            this.$API.Area.showAreas(params).then((response) => {
                this.areasData = response.data.data;
                this.areasDataPagination = response.data;
                this.filters.total = response.data.total;
                this.tableLoading = false;
            });
        },
        handleClose(done) {
            this.$confirm(this.__("Are you sure to close?"))
                .then((_) => {
                    done();
                })
                .catch((_) => {});
        },
        submitForm() {
            this.$refs['addNewAreaData'].validate((valid) => {
                if (valid) {
                    if (this.mode == 'create') {
                        this.store();
                    } else {
                        this.update();
                    }
                }
            });
        },
        handleAction(info) {
				if (info.action === 'delete') {
					this.askToDeleteCertification(info.data, info.index)
				}
				else if (info.action === 'update') {
					this.editArea(info.data)
				}
			},
        store() {
            let postData = cloneDeep(this.addNewAreaData);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.Area.storeArea(postData)
                .then((response) => {
                    this.areasData.unshift(response.data);
                    this.$notify({
                        title: "Successful",
                        message: this.$msg.notif.success_add,
                        type: "success",
                    });
                    this.filters.total++;
                    //this.AdddialogVisible = false;
                    this.mode = 'create';
                    this.dialog();
                })
                .catch((err) => {
                    switch (err.response.status) {
                        case 422:
                            this.errors = err.response.data.errors;
                            break;
                        default:
                            this.$notify({
                                title: "Error",
                                message: this.$msg.notif.service_error,
                                type: "error",
                            });
                            break;
                    }
                });
        },
        askToDeleteCertification(id, index) {
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
        delete(id, index) {
            this.$API.Area.deleteArea(id)
                .then((response) => {
                    this.areasData.splice(index, 1);
                    this.$notify({
                        title: this.__("Successful"),
                        message: this.$msg.notif.success_delete,
                        type: "success",
                    });
                    this.filters.total--;
                })
                .catch((err) => {
                    console.log(err);
                    this.$notify({
                        title: this.__("Error"),
                        message: this.$msg.notif.service_error,
                        type: "error",
                    });
                });
        },
        editArea(AreaData) {
            /*this.editAreaData = { ...AreaData };
            this.EditdialogVisible = true;*/

            this.addNewAreaData = cloneDeep(AreaData)
            this.mode = 'edit';
            this.AdddialogVisible = true;

            this.populateDefault(cloneDeep(this.addNewAreaData.translations));
        },
        update() {
            let postData = cloneDeep(this.addNewAreaData)
            this.setCurrrentLangDefaultValue(postData)

            this.$API.Area.updateArea(postData.id, postData)
                .then((response) => {

                    let data = response.data;

                    this.areasData.map((complex) => {
                        if (complex.id == data.id) {
                            for (let key in data) {
                                complex[key] = data[key];
                            }
                        }
                    });

                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.success_update,
                        type: "success",
                    });
                    this.mode = 'create';
                    this.dialog();
                })
                .catch((err) => {
                    switch (err.response.status) {
                        case 422:
                            this.errors = err.response.data.errors;
                            break;
                        default:
                            this.$notify({
                                title: "Error",
                                message: this.$msg.notif.service_error,
                                type: "error",
                            });
                            break;
                    }
                });
            this.AdddialogVisible = false;
        },
        cancelEdit() {
            this.EditdialogVisible = false;
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.getAreas();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.getAreas();
        },
        dialog() {
            this.AdddialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs['addNewAreaData'].resetFields();
            this.addNewAreaData.name = null
            this.addNewAreaData.description = null
        },
    },
};
</script>

<style lang="scss">
.area_data {
    margin-bottom: 20px;
}
</style>
