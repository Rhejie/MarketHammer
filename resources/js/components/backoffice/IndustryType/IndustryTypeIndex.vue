<template>
    <div class="main-container">
            <div class="table-container">
                <div class="card borderless">
                        <div class="card-actions">
                            <div class="header-title">
                                <h5>{{ __('Industry Types') }}</h5>
                            </div>
                            <div class="search-container">
                                <el-input
                                class="input-search"
                                v-model="search"
                                :placeholder="__('Type to search')"
                                @keyup.enter.native="showIndustryTypes">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            <!-- </div>
                            <div class="action-button-container text-center" style="margin-top: 3px !important;"> -->

                            </div>
                            <div class="secondary-action-buttons">
                                      <el-button class="mh-btn" @click="openImportModal()">
                                        <i class="el-icon-upload2"></i>
                                      </el-button>
                            </div>

                            <div class="add-new-button">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-black"
                                    @click="openCreateIndustryTypeModal">
                                    <i class="fas fa-plus"></i> {{ __("Add Industry Type") }}
                                </button>
                            </div>
                        </div>
                        <!-- Table -->
                        <el-table
                        class="table-list-container"
                        :data="industryTypeData"
                        style="width: 100%;"
                        v-loading="tableLoading"
                        @row-click="show">
                            <el-table-column prop="name" :label="__('Industry Name')" :sortable="true">
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
                                        <button
                                            class="btn btn-default text-red"
                                            @click.stop
                                            @click="
                                                askToDeleteIndustryType(
                                                    scope.row.id,
                                                    scope.row.index
                                                )
                                            "
                                        >
                                           <i class="fas fa-trash-alt"></i> {{ __("Delete") }}
                                        </button>
                                    </div>
                                </template>
                                    <!--el-dropdown
                                        trigger="click"
                                        @command="handleAction">
                                        <el-button
                                            class="text-black"
                                            type="text"
                                            icon="fas fa-ellipsis-v">
                                        </el-button>
                                        <el-dropdown-menu slot="dropdown">
                                            <el-dropdown-item :command="{action: 'update', data: scope.row.id}">
                                                <span class="text-blue">
                                                    <i class="fas fa-edit"></i> {{ __('Update') }}
                                                </span>
                                            </el-dropdown-item>
                                            <el-dropdown-item divided :command="{action: 'delete', data: scope.row.id, index: scope.$index}">
                                                <span class="text-red">
                                                    <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                                </span>
                                            </el-dropdown-item>
                                        </el-dropdown-menu>
                                    </el-dropdown-->
                            </el-table-column>
                        </el-table>
                        <div class="text-right">
                            <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="industryTypePagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination>
                        </div>
                </div>
            </div>

            <global-import-modal></global-import-modal>

        <!-- EL DIALOG FOR CREATE -->
        <el-dialog
            :title="mode == 'create' ? __('Add New Industry Type') : __('Update Industry Type')"
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="industry-type-dialog"
            :close-on-click-modal="false">
            <el-form
                ref="industryTypeForm"
                :model="industryTypeForm"
                :rules="industryTypeFormRules"
                class="industry-type-form">
                <el-form-item
                    :label="__('Industry Type Name')"
                    prop="name">
                    <el-input
                        v-model="industryTypeForm.name"
                        :placeholder="__('Industry Type Name')">
                    </el-input>

                    <value-translator-btn
                        @showTranslationForm="setTranslationForm('name', industryTypeForm.name, 'text')">
                    </value-translator-btn>
                </el-form-item>
                <el-form-item
                    :label="__('Description')"
                    prop="description">
                    <el-input
                        type="textarea"
                        :rows="3"
                        v-model="industryTypeForm.description"
                        :placeholder="__('Description')">
                    </el-input>

                    <value-translator-btn
                        @showTranslationForm="setTranslationForm('description', industryTypeForm.description, 'textarea')">
                    </value-translator-btn>
                </el-form-item>
            </el-form>
            <span slot="footer">
                <button
                    type="button"
                    class="btn btn-default"
                    @click="closeFormDialog">
                    {{ __("Cancel") }}
                </button>
                <button
                    type="button"
                    class="btn btn-primary btn-black"
                    @click="validateIndustryTypeForm">
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
            @settranslationdata="setTranslationData">
        </value-translator-form>
    </div>
</template>
<script>
    import cloneDeep from 'lodash/cloneDeep'
    import translationForm from '../../../mixins/translationForm.js'

    export default {
        name: 'IndustryTypeIndex',
        mixins: [translationForm],
        data() {
            return {
                industryTypeData: [],
                industryTypePagination: {},
                search: '',
                current_page: 1,
                current_size: 25,
                tableLoading: false,
                // Form Dialog
                formDialogVisible: false,
                mode: 'create',
                industryTypeForm: {
                    name: null,
                    description: null
                },
                industryTypeFormRules: {
                    name: [
                        { required: true, message: this.__('Please input industry name'), trigger: 'blur' }
                    ]
                }
            }
        },
        created() {
            this.formFields = ['name', 'description']
            this.fromTable = 'industry_type'

            this.$EventDispatcher.listen('IMPORT_DONE', data => {
                this.showIndustryTypes();
                this.$notify({
                    title: this.__("Success"),
                    message: this.__("Successfully imported industry from type excel file."),
                    type: "success"
                });
            })

            this.showIndustryTypes()
        },
        watch: {
            search(newSearch, oldSearch) {
                if(newSearch != oldSearch) {
                    this.showIndustryTypes()
                    return;
                }
            }
        },
        methods: {
            showIndustryTypes() {
                this.tableLoading = true;
                let params = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.search
                };
                this.$API.IndustryType.showIndustryTypes(params).then(res => {
                    this.industryTypeData = res.data.industryTypes.data;
                    console.log(res);
                    this.industryTypePagination = res.data.industryTypes;
                })
                .catch(_ => {

                })
                .finally(_ => {
                    this.tableLoading = false
                })
            },
            openCreateIndustryTypeModal() {
                this.mode = 'create'
                this.formDialogVisible = true

                this.populateDefault()
            },
            handleSizeChange(val) {
                this.current_size = val;
                this.showIndustryTypes();
            },
            handleCurrentChange(val) {
                this.current_page = val;
                this.showIndustryTypes();
            },
            show(row) {
                // this.tableLoading = true
                // this.$API.IndustryType.show(row.id)
                // .then(res => {
                //     this.industryTypeForm = res.data.industryType
                //     this.mode = 'edit'
                //     this.formDialogVisible = true

                //     this.populateDefault(cloneDeep(this.industryTypeForm.translations))
                // })
                // .catch(err => {
                //     console.log(err)
                // })
                // .finally(_ => {
                //     this.tableLoading = false
                // })
                this.industryTypeForm = {...row};
                this.mode = 'edit';
                this.formDialogVisible = true;
                this.populateDefault(cloneDeep(this.industryTypeForm.translations));
            },
            askToDeleteIndustryType(id, index) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    confirmButtonClass: "el-button--danger",
                    type: 'warning'
                }).then(() => {
                    this.delete(id, index);
                }).catch(() => {

                });
            },
            closeFormDialog() {
                this.formDialogVisible = false;
                this.industryTypeForm = {
                    name: null,
                    description: null
                }
            },
            resetFields() {
                this.$refs['industryTypeForm'].resetFields();
            },
            validateIndustryTypeForm() {
                this.$refs['industryTypeForm'].validate((valid) => {
                    if (valid) {
                        if (this.mode == 'create') {
                            this.store();
                        } else{
                            this.update();
                        }
                    }
                })
            },
            /*handleAction(info) {
				if (info.action === 'delete') {
					this.askToDeleteIndustryType(info.data, info.index)
				}
				else if (info.action === 'update') {
					this.show(info.data)
				}
			},*/
            store() {
                this.formDialogVisible = false

                let postData = cloneDeep(this.industryTypeForm)
                this.setCurrrentLangDefaultValue(postData)

                this.$API.IndustryType.store(postData)
                .then(res => {
                    this.industryTypeData.unshift(res.data);
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_add,
                        type: "success"
                    })

                    this.resetFields()
                })
                .catch(err => {
                    this.formDialogVisible = true
                    this.tableLoading = false
                    this.showValidationError(err)
                })
                .finally(_ => {
                    this.tableLoading = false
                })
            },
            update() {

                let postData = cloneDeep(this.industryTypeForm)
                this.setCurrrentLangDefaultValue(postData)

                this.$API.IndustryType.update(postData)
                .then(res => {
                    let data = res.data;
                    console.log(data);

                    this.industryTypeData.map(industry => {
                        if(industry.id === data.id) {
                            for(let key in data) {
                                industry[key] = data[key];
                            }
                        }
                    });


                    this.formDialogVisible = false

                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success"
                    })

                    this.mode = 'create';
                    this.resetFields();
                })
                .catch(err => {
                    this.formDialogVisible = true
                    this.showValidationError(err)
                })
                .finally(_ => {
                    this.tableLoading = false
                })
            },
            delete(id, index) {

                this.$API.IndustryType.delete(id).then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    })

                    this.industryTypeData.splice(index, 1);
                })
                .catch(_ => {

                })
                .finally(_ => {
                    this.tableLoading = false
                })
            },
            showValidationError(err) {
                let errors = [];
                const h = this.$createElement;
                if(err.response.status == 422) {
                    if(err.response.data.errors) {
                        for (var key in err.response.data.errors) {
                            errors.push(err.response.data.errors[key][0]);
                        }

                        this.$notify({
                            title: this._("Error"),
                            message: h('div', { style: 'list-style-type: none' }, errors.map(errmsg => {
                            return h('div', { style: 'list-style-type: none' }, errmsg);
                            })),
                            type: "error"
                        });
                    }
                }
            },
            openImportModal(){
                let data = {urlImport : '/industry-type/import',
                    title : this._("Import Industry"),
                    templateUrl : '/industry-template'}
                this.$EventDispatcher.fire('SHOW_IMPORT_DIALOG', data);
            }
        }
    }
</script>
<style lang="scss">
    .industry-type-list {
        .el-dialog {
            .el-dialog__body {
                padding: 20px;
            }
            .industry-type-form {
            }
        }
    }
</style>
