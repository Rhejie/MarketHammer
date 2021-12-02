<template>
    <div class="main-container">
         <div class="table-container">
              <div class="card borderless">
                  <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Processes') }}</h5>
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
                            class="btn btn-primary btn-black" @click="addProcess">
                            <i class="fas fa-plus"></i>
                                {{ __("Add New Process") }}
                            </el-button>
                    </div>
                </div>
              </div>
            <div>
                    <el-table
                    class="table-list-container"
                    v-loading="tableLoading"
                    fit
                    :data="processes"
                    @row-click="editProcesses">

                        <el-table-column prop="name"
                            :label="__('Process Name')"
                            :sortable="true">
                            <template slot-scope="scope">
                                {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
                            </template>
                        </el-table-column>
                        <el-table-column prop="process_type.name"
                            :label="__('Process Type')"
                            :sortable="true">
                            <template slot-scope="scope">
                                <div v-if = scope.row.process_type.name>
                                    {{ __dt(scope.row.process_type.translations[0], 'process_type.name', $sf.ucwords(scope.row.process_type.name)) }}
                                </div>
                            </template>
                        </el-table-column>
                        <el-table-column
                            v-for="column in columns"
                            :key="column.prop"
                            :label="column.label"
                            :show-overflow-tooltip="column.showTooltip"
                            :sortable="column.sortable"
                            :prop="column.prop"
                        >
                            <template slot-scope="scope">
                                <template v-if = "column.prop == 'description'">
                                    <div v-if="scope.row.description">
                                        {{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
                                    </div>
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
                                            askToDeleteProcesses(
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

                    <div class="text-right mb-3">
                        <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="processesPagination"
                            :total="filters.total"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"
                        >
                        </global-pagination>
                    </div>
            </div>
        </div>
        <el-dialog
            :title="mode == 'create' ? 'Add New Processes' : 'Update Processes'"
            :visible.sync="AdddialogVisible"
            width="45%"
        >
            <el-form
                :model="processForm"
                :rules="rules"
                ref="processForm"
                class="demo-ruleForm"
            >
                <el-form-item
                    :label="__('Process Type')"
                    prop="process_type_id"
                    >
                    <el-select
                        v-model="processForm.process_type_id"
                        filterable
                        :placeholder="__('Select')"
                        class="full-width"
                        >
                        <el-option
                            v-for="item in process_type"
                            :key="item.id"
                            :value="item.id"
                            :label="item.name"
                        >
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item :label="__('Name')" prop="name">
                    <el-input
                        v-model="processForm.name"
                        :placeholder="__('Name')"
                    ></el-input>
                    <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'name',
                                processForm.name,
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
                        v-model="processForm.description"
                    ></el-input>
                     <value-translator-btn
                        @showTranslationForm="
                            setTranslationForm(
                                'description',
                                processForm.description,
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
                            @click="dialogCancel"
                        >
                            {{ __("Cancel") }}
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary btn-black"
                            @click="submitForm"
                        >
                            {{ mode == 'create' ? __('Save') : __('Save') }}
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
import translationForm from "../../../mixins/translationForm.js";
import cloneDeep from "lodash/cloneDeep";
export default {
    name: 'ProcessesIndex',
    mixins: [pagination, translationForm],
    data() {
        return  {
            search: '',
            mode: 'create',
            AdddialogVisible: false,
            dialog: false,
            processForm: {
                process_type_id: null,
                name: null,
                description: null
            },
            processes: [],
            processesPagination: [],
            process_type: [],
            tableLoading: false,
            current_page: 1,
            current_size: 25,
            current_total: 0,
            filters: {
                search: null
            },
            rules: {
                process_type_id: [
                    {
                        required: true,
                        message: this.__("Please select process type"),
                        trigger: "blur",
                    }
                ],
                name: [
                    {
                        required: true,
                        message: this.__("Please input area name"),
                        trigger: "blur",
                    },
                ],
            },

            columns: [
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
        }
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "processes";
        this.getProcesses();
        this.getProcessType();
    },
    methods: {
        getProcesses() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.Processes.fetch(params).then(response => {
                this.processes = response.data.data;
                this.processesPagination = response.data;
                this.filters.total = response.data.total;
                this.tableLoading = false;
            });
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.getProcesses();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.getProcesses();
        },
        getProcessType() {
            this.$API.Processes.getProcessesProcess_type().then(res => {
                this.process_type = res.data;
            })
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.askToDeleteProcesses(info.data, info.index);
            } else if (info.action === "update") {
                this.editProcesses(info.data);
            }
        },
        addProcess() {
            this.AdddialogVisible = true;
            this.mode = 'create'
            this.populateDefault();
        },
        applyFilter() {

        },
        submitForm() {
            this.$refs["processForm"].validate(valid => {
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
            let postData = cloneDeep(this.processForm);
            this.setCurrrentLangDefaultValue(postData);
            this.$API.Processes.create(postData).then(res => {
                console.log(res.data);
                this.processes.unshift(res.data);
                this.$notify({
                        title: "Successful",
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });
                    this.filters.total++;
                    this.mode = "create";
                    this.AdddialogVisible = false;
                    this.resetFields();
            });
        },
        editProcesses(data) {
            this.AdddialogVisible = true;
            this.mode = 'update';
            this.processForm = cloneDeep(data);
            this.populateDefault(
                cloneDeep(this.processForm.translations)
            );
        },
        update() {
            let postData = cloneDeep(this.processForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.Processes.update(postData, postData.id)
                .then(response => {
                    let data = response.data;

                    this.processes.map(p => {
                        if (p.id == data.id) {
                            for (let key in data) {
                                p[key] = data[key];
                            }
                        }
                    });

                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });
                    this.mode = "create";
                    this.AdddialogVisible = false;
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
                    this.resetFields();
        },
        askToDeleteProcesses(id, index) {
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
            this.$API.Processes.delete(id)
                .then(response => {
                    this.processes.splice(index, 1);
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
        resetFields() {
            this.$refs["processForm"].resetFields();
            this.processForm.name = null;
            this.processForm.description = null;
            this.processForm.process_type_id = null;
        },
        dialogCancel() {
            this.AdddialogVisible = false;
            this.resetFields();
        }
    },
    watch: {
        search(newVal, oldVal) {
            if(newVal != oldVal) {
                this.getProcesses();
            }
        }
    }
}
</script>
<style lang="scss">

</style>
