<template>
    <div class="main-container">
        <div class="table-container table-container-business-tab">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                    </div>
                    <div class="search-container">
                        <el-input
                            disabled
                            :title="__('No function yet')"
                            class="input-search"
                            placeholder="Type to search"
                            @keyup.enter.native="applyFilter"
                            v-model="search"
                        >
                            <i
                                slot="suffix"
                                class="el-input__icon el-icon-search"
                            ></i>
                        </el-input>
                    </div>
                    <div class="secondary-action-buttons">
                        <el-button
                            disabled
                            class="mh-btn"
                            slot="reference"
                            :title="__('Filter')"
                            icon="fas fa-filter">
                        </el-button>

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
                            size="small"
                            class="btn btn-primary btn-black ml-auto"
                            @click="addEsg"
                            :disabled="!business">
                            <i class="fas fa-plus"></i> {{ __("Add New ESG") }}
                        </el-button>
                    </div>
                </div>

                <el-table
                class="table-list-container"
                v-loading="tableLoading"
                fit
                :data="esgList"
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
                                <template v-if="column.prop === 'noise'">
                                    {{ scope.row.noise == 0 ? __("Yes") : __("No") }}
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
                        :pagination="esgPagination"
                        :total="filters.total"
                        @handleSizeChange="handleSizeChange"
                        @handleCurrentChange="handleCurrentChange"
                    >
                    </global-pagination>
                </div>

                <el-dialog
                :visible.sync="dialogVisible"
                @close="handleClose"
                :title="
                    mode == 'create'
                        ? __('Add New ESG')
                        : __('Update ESG')
                "
                width="30%"
                top="4vh"
                >
                    <el-form
                        v-loading="tableLoading"
                        :rules="rules"
                        :model="esgForm"
                        ref="esgForm"
                        autocomplete="off"
                        label-position="top"
                    >
                        <div class="row">
                            <div class="col-md-12">
                                <el-form-item
                                    :label="__('Air Pollution Grade')"
                                    prop="air_pollu_grade"
                                >
                                    <el-radio-group v-model="esgForm.air_pollu_grade">
                                        <el-radio :label="1">1</el-radio>
                                        <el-radio :label="2">2</el-radio>
                                        <el-radio :label="3">3</el-radio>
                                        <el-radio :label="4">4</el-radio>
                                        <el-radio :label="5">5</el-radio>
                                    </el-radio-group>
                                </el-form-item>

                                <el-form-item
                                    :label="__('Water Pollution Grade')"
                                    prop="water_pollu_grade"
                                >
                                    <el-radio-group v-model="esgForm.water_pollu_grade">
                                        <el-radio :label="1">1</el-radio>
                                        <el-radio :label="2">2</el-radio>
                                        <el-radio :label="3">3</el-radio>
                                        <el-radio :label="4">4</el-radio>
                                        <el-radio :label="5">5</el-radio>
                                    </el-radio-group>
                                </el-form-item>

                                <el-form-item
                                    :label="__('Noise')"
                                    prop="noise"
                                >
                                    <el-radio-group v-model="esgForm.noise">
                                        <el-radio :label="0">Yes</el-radio>
                                        <el-radio :label="1">No</el-radio>
                                    </el-radio-group>
                                </el-form-item>

                                <el-form-item
                                    :label="__('Domestic Water Waste')"
                                    prop="dom_water_waste"
                                >
                                    <el-input-number
                                        class="full-width round-input"
                                        clearable
                                        v-model="esgForm.dom_water_waste"
                                        :precision="2"
                                        :step="0.1"
                                        :max="10"
                                    >
                                    </el-input-number>
                                </el-form-item>

                                <el-form-item
                                    :label="__('Industrial Water Waste')"
                                    prop="ind_water_waste"
                                >
                                    <el-input-number
                                        class="full-width round-input"
                                        clearable
                                        v-model="esgForm.ind_water_waste"
                                        :precision="2"
                                        :step="0.1"
                                        :max="10"
                                    >
                                    </el-input-number>
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
                            {{  __("Save") }}
                        </el-button>
                    </span>
                </el-dialog>
            </div>
        </div>
    </div>
</template>
<script>
import pagination from "../../../../../mixins/pagination";
import cloneDeep from "lodash/cloneDeep";
export default {
    name: "BusinessEsg",
    mixins: [pagination],
    props: {
        pageData: {
            type: Object,
            required: true,
        },
        business: {},
    },
    data() {
        let columns = [
            {
                label: this.__("Air Pollution Grade"),
                prop: "air_pollu_grade",
                showTooltip: true,
                sortable: true
            },
            {
                label: this.__("Water Pollution Grade"),
                prop: "water_pollu_grade",
                showTooltip: true,
                sortable: true
            },
            {
                label: this.__("Noise"),
                prop: "noise",
                showTooltip: true,
                sortable: true
            },
            {
                label: this.__("Domestic Water Waste"),
                prop: "dom_water_waste",
                showTooltip: true,
                sortable: true
            },
            {
                label: this.__("Industrial Water Waste"),
                prop: "ind_water_waste",
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
            columns: columns,
            esgForm: {
                id: null,
                business_id: this.business.id,
                air_pollu_grade: null,
                water_pollu_grade: null,
                noise: null,
                dom_water_waste: null,
                ind_water_waste: null,
            },
            search: "",
            current_page: 1,
            current_size: 25,
            esgList: [],
            esgPagination: [],
            dialogVisible: false,
            tableLoading: false,
            filters: {
                search: null
            },
            mode: null,
            rules: {
                air_pollu_grade: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                },
                water_pollu_grade: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                },
                noise: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                },
                ind_water_waste: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                },
                dom_water_waste: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                },
            },
        };
    },
    created() {
        this.fetch();
    },
    watch: {
        search(newSearch, oldSearch) {
            if(newSearch != oldSearch) {
                this.applyFilter();
                return;
            }
        },
        business(newBusiness, oldBusiness) {
            if(newBusiness != oldBusiness) {
                this.fetch();
                return;
            }
        }
    },
    methods: {
        applyFilter() {
            this.filters.page = 1;

            this.fetch();
        },
        fetch() {
            if (!this.business) return;

            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
            };
            this.$API.BusinessEsg.fetch(this.business.id, params).then((res) => {
                this.esgPagination = res.data;
                this.esgList = res.data.data;
                this.filters.total = res.data.total;
                this.tableLoading = false;
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
        addEsg() {
            this.mode = "create";
            this.dialogVisible = true;
        },
        edit(id) {
            this.esgForm = cloneDeep(id);
            this.mode = "edit";
            this.dialogVisible = true;
        },
        submitForm() {
            this.$refs["esgForm"].validate(valid => {
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
            let postData = cloneDeep(this.esgForm);

            this.$API.BusinessEsg.create(postData)
                .then(response => {
                    this.esgList.unshift(response.data);
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
            let postData = cloneDeep(this.esgForm);

            this.$API.BusinessEsg.update(postData, postData.id)
            .then(response => {
                let data = response.data;

                this.esgList.map(level => {
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
            this.$API.BusinessEsg.delete(id)
            .then(response => {
                this.esgList.splice(index, 1);
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
            this.dialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs["esgForm"].resetFields();
            this.esgForm.name = null;
        },
    }
};
</script>
