<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Complex Location') }}</h5>
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
                            <i class="fas fa-plus"></i> {{ __('Add New Complex Location') }}
                        </el-button>
                    </div>   
                </div>
                            <el-table
                                class="table-list-container"
                                v-loading="tableLoading"
                                fit
                                :data="complexLocationData"
                                @row-click="editComplex"
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
                        :pagination="complexLocationPaginationData"
                        :total="filters.total"
                        @handleSizeChange="handleSizeChange"
                        @handleCurrentChange="handleCurrentChange"
                    >
                    </global-pagination>
                </div>
        </div>
        <el-dialog
            :title="mode == 'create'
                    ? __('Add New Complex Location')
                    : __('Update Complex Location')"
            :visible.sync="AdddialogVisible"
            width="45%">
            <el-form
                :model="addNewLocationData"
                :rules="rules"
                ref="addNewLocationData"
                class="demo-ruleForm"
            >
                <el-form-item :label="__('Complex Location')" prop="name">
                    <el-input
                        v-model="addNewLocationData.name"
                        :placeholder="__('Complex Location Name')"
                    ></el-input>
                    <div v-if="errors.name" class="el-form-item__error">
                        {{ errors.name[0] }}
                    </div>
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
                <el-form-item :label="__('Country')" prop="country_id">
                    <el-select v-model="addNewLocationData.country_id"
                        filterable
                        placeholder = "Country"
                        class="full-width">
                        <el-option
                          v-for="item in countryList"
                          :key="item.id"
                          :label="item.name"
                          :value="item.id">
                        </el-option>
                    </el-select>
                </el-form-item>

                            <el-form-item>
                                <div style="float: right">
                                    <button
                                        type="button"
                                        class="btn btn-default"
                                        @click="dialogVisible"
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
                        @settranslationdata="setTranslationData">
                    </value-translator-form>
            </div>
        </div>
</template>
<script>
import pagination from "../../../mixins/pagination";
import translationForm from "../../../mixins/translationForm.js";
import cloneDeep from 'lodash/cloneDeep'
export default {
    name: "ComplexLocations",
    mixins: [pagination, translationForm],
    data() {
        return {
            complexLocationData: [],
            addNewLocationData: {
                name: null,
                description: null,
                country_id: null,
            },
            complexLocationPaginationData: [],
            columns: [
                {
                    label: this.__("Complex Location"),
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
                    label: this.__("Country"),
                    prop: "country",
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
            search: "",
            current_page: 1,
            current_size: 25,
            filters: {
                search: null,
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
                country_id: [
                    {
                        required: true,
                        message: this.__("Please select country"),
                        trigger: "change",
                    },
                ],
            },
            errors: [],
            countryList : []
        };
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.getComplexLocations();
                return;
            }
        },
    },
    created() {
        this.formFields = ['name', 'description', 'country_id']
        this.fromTable = 'complex_locations'

        //this.getComplexLocations()
    },
    mounted() {
        this.mountedData()
    },
    methods: {
        async mountedData(){
            this.tableLoading = true;
            await this.loadMetaData()
            this.getComplexLocations();
        },
        async loadMetaData() {
            let toLoad = ["countries"];
           await this.$API.Utils.getMetaData(toLoad)
            .then(res => {
                let result = res.data
                console.log('result', result)
                this.countryList = result.countries;
            })
            .catch(err => {
                console.log(err);
            })
            .finally(_ => {});

            return true
        },
        addLocation() {
            this.mode = "create";
            this.AdddialogVisible = true;

            this.populateDefault()
        },
        applyFilter() {
            this.getComplexLocations();
        },
        getComplexLocations() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
            };
            this.$API.ComplexLocation.fetch(params)
            .then(
                (response) => {
                    this.complexLocationData = response.data.data;
                    this.complexLocationPaginationData = response.data;
                    this.filters.total = response.data.total;
                    this.tableLoading = false;
                }
            );
        },
        editComplex(data) {
            //this.addNewLocationData = {...data};
            this.addNewLocationData = cloneDeep(data)
            this.mode = 'edit';
            this.AdddialogVisible = true;
            //this.populateDefault(cloneDeep(data.translations))
            this.populateDefault(cloneDeep(this.addNewLocationData.translations));
        },
        handleAction(info) {
				if (info.action === 'delete') {
					this.askToDeleteComplex(info.data, info.index)
				}
				else if (info.action === 'update') {
					this.editComplex(info.data)
				}
			},
        submitForm() {
            this.$refs['addNewLocationData'].validate((valid) => {
                if (valid) {
                    if (this.mode == 'create') {
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
            this.$API.ComplexLocation.create(postData)
                .then((response) => {
                    this.complexLocationData.unshift(response.data);
                    this.$notify({
                        title: this.__("Successful"),
                        message: this.$msg.notif.success_add,
                        type: "success",
                    });
                    this.filters.total++;
                    //this.AdddialogVisible = false;
                    this.mode = 'create';
                    this.dialogVisible();
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
        update() {
            let postData = cloneDeep(this.addNewLocationData)
            this.setCurrrentLangDefaultValue(postData)
            console.log(postData);

            this.$API.ComplexLocation.update(postData, this.addNewLocationData.id)
                .then((response) => {

                    let data = response.data;

                    this.complexLocationData.map((complex) => {
                        if (complex.id == data.id) {
                            for (let key in data) {
                                complex[key] = data[key];
                            }
                        }
                    });

                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success",
                    });
                    this.mode = 'create';
                    this.dialogVisible();
                })
                .catch((err) => {
                    switch (err.response.status) {
                        case 422:
                            this.errors = err.response.data.errors;
                            break;
                        default:
                            this.$notify({
                                title: this.__("Error"),
                                message: this.$msg.notif.service_error,
                                type: "error",
                            });
                            break;
                    }
                });
            this.AdddialogVisible = false;
        },
        askToDeleteComplex(id, index) {
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
            this.$API.ComplexLocation.delete(id)
                .then((response) => {
                    this.complexLocationData.splice(index, 1);
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
        cancelEdit() {
            this.EditdialogVisible = false;
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
                .then((_) => {
                    done();
                })
                .catch((_) => {});
        },
        dialogVisible() {
            this.AdddialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs['addNewLocationData'].resetFields();
            this.addNewLocationData.name = null
            this.addNewLocationData.description = null
        },
    },
};
</script>
