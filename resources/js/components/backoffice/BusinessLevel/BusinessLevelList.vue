<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Business Level') }}</h5>
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
                             <el-button round class="btn btn-black" @click="addLevel"
                                    ><!---->
                                    <i class="fas fa-plus"></i>
                                    {{ __("Add New Business Level") }}
                            </el-button>
                    </div>
                </div>

                        <el-table 
                        class="table-list-container"
                        fit 
                        v-loading="loading" 
                        :data="businessLevelList"
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
                                :current_page="filters.page"
                                :current_size="filters.size"
                                :pagination="filters"
                                @handleSizeChange="handleSize"
                                @handleCurrentChange="handlePage"
                            >
                            </global-pagination>
                        </div>

                    <el-dialog
                        :visible.sync="showForm"
                        @close="handleClose"
                        :title="
                            mode == 'create'
                                ? __('Add New Business Level')
                                : __('Update Business Level')
                        "
                        width="30%"
                        top="4vh"
                    >
                        <el-form
                            v-loading="loading"
                            :rules="rules"
                            :model="businessLevelForm"
                            ref="businessLevelForm"
                            autocomplete="off"
                            label-position="top"
                        >
                            <div class="row">
                                <div class="col-md-12">
                                    <el-form-item
                                        :label="__('Business Level')"
                                        prop="name"
                                    >
                                        <el-input
                                            class="full-width round-input"
                                            :placeholder="__('Enter Business Level')"
                                            clearable
                                            v-model="businessLevelForm.name"
                                        >
                                        </el-input>

                                        <value-translator-btn
                                            @showTranslationForm="
                                                setTranslationForm(
                                                    'name',
                                                    businessLevelForm.name,
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
                                            v-model="businessLevelForm.description"
                                        >
                                        </el-input>
                                        <value-translator-btn
                                            @showTranslationForm="
                                                setTranslationForm(
                                                    'description',
                                                    businessLevelForm.description,
                                                    'textarea'
                                                )
                                            "
                                        >
                                        </value-translator-btn>
                                    </el-form-item>

                                    <el-form-item :label="__('Level')" prop="level">
                                        <el-input
                                            class="full-width round-input"
                                            :placeholder="__('Enter Business Level')"
                                            clearable
                                            type="number"
                                            v-model="businessLevelForm.level"
                                        >
                                        </el-input>
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
                                type="primary"
                                class="btn btn-black"
                                @click="submitForm"
                            >
                                {{ mode == 'create' ? __('Save') : __('Save') }}
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
import cloneDeep from "lodash/cloneDeep";
import pagination from "../../../mixins/pagination";
import translationForm from "../../../mixins/translationForm.js";
export default {
    name: "BusinessLevel",
    mixins: [pagination, translationForm],
    data() {
        let columns = [
            {
                label: this.__("Business Level"),
                prop: "name",
                showTooltip: true,
                sortable: true
            },
            {
                label: this.__("Level"),
                prop: "level",
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
            businessLevelForm: {
                id: null,
                name: null,
                level: null,
                description: null
            },
            filters: {
                searchString: null
            },
            businessLevelList: [],
            columns: columns,
            selectedModel: null,
            loading: false,
            showForm: false,
            search: null,
            mode: null,
            rules: {
                name: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                },
                level: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                }
            }
        };
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "business_levels";
        // check pagination mixins
        this.functionName = "fetch";
        this.filters.searchString = this.search;
        this.fetch();
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
        addLevel() {
            this.mode = "create";
            this.showForm = true;

            this.populateDefault();
        },
        applyFilter() {
            this.filters.page = 1;

            this.fetch();
        },
        fetch() {
            this.loading = true;

            let postData = cloneDeep(this.filters);

            this.$API.BusinessLevel.fetch(postData)
                .then(res => {
                    this.businessLevelList = res.data.data;
                    this.filters.total = res.data.total;
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(_ => {
                    this.loading = false;
                });
        },
        submitForm() {
            this.$refs["businessLevelForm"].validate(valid => {
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
            let postData = cloneDeep(this.businessLevelForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.BusinessLevel.store(postData)
                .then(response => {
                    this.businessLevelList.unshift(response.data);
                    this.$notify({
                        title: this.__("Success"),
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
        edit(id) {
            this.businessLevelForm = cloneDeep(id);
            this.mode = "edit";
            this.showForm = true;

            this.populateDefault(
                cloneDeep(this.businessLevelForm.translations)
            );
        },
        update() {
            let postData = cloneDeep(this.businessLevelForm);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.BusinessLevel.update(postData, postData.id)
                .then(response => {
                    let data = response.data;

                    this.businessLevelList.map(level => {
                        if (level.id == data.id) {
                            for (let key in data) {
                                level[key] = data[key];
                            }
                        }
                    });

                    this.$notify({
                        title: this.__("Success"),
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
            this.$API.BusinessLevel.delete(id)
                .then(response => {
                    this.businessLevelList.splice(index, 1);
                    this.$notify({
                        title: this.__("Success"),
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
            this.$refs["businessLevelForm"].resetFields();
            this.businessLevelForm.name = null;
            this.businessLevelForm.description = null;
            this.businessLevelForm.level = null;
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

<style lang="scss"></style>
