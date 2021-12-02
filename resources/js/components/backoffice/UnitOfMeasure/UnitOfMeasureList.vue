<template>
    <div class="main-container">
            <div class="table-container">
                <div class="card borderless">
                        <div class="card-actions">
                            <div class="header-title">
                                <h5>{{ __('Unit of Measure') }}</h5>
                            </div>
                            <div class="search-container" style="margin-right: 15px;">
                                <el-input
                                    class="input-search"
                                    v-model="search"
                                    :placeholder="__('Type to search')"
                                    @keyup.enter.native="showUnitMeasures">
                                    <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="add-new-button">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-black float-right"
                                    @click="openCreateModal">
                                    <i class="fas fa-plus"></i> {{ __("Add Unit") }}
                                </button>
                            </div>
                        </div>
                        <el-table
                            class="table-list-container"
                            :data="unitMeasureList"
                            row-key="id"
                            style="width: 100%; margin-top: 15px;"
                            v-loading="loading"
                            @row-click="editUnitMeasure">
                            <el-table-column
                                prop="name"
                                :label="__('Unit')"
                                :sortable="true">
                                <template slot-scope="scope">
                                    {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                :label="__('Action')"
                                align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button class="btn btn-default text-red" @click="askToDelete(scope.row.id, scope.row.index)">
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
                                :pagination="unitMeasurePagination"
                                @handleSizeChange="handleSizeChange"
                                @handleCurrentChange="handleCurrentChange">
                            </global-pagination>
                        </div>
                </div>
            </div>

        <!-- EL DIALOG FOR CREATE -->
        <el-dialog
            :title="mode == 'create' ? __('New Unit Of Measure') : __('Update Unit Of Measure')"
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="industry-type-dialog"
            :close-on-click-modal="false">
             <el-form
                ref="unitOfMeasureForm"
                :model="unitOfMeasureForm"
                :rules="unitOfMeasureFormRules"
                class="industry-type-form">
                <el-form-item
                    :label="__('Name')"
                    prop="name">
                    <el-input
                        v-model="unitOfMeasureForm.name"
                        :placeholder="__('Name')">
                    </el-input>

                    <value-translator-btn
                        @showTranslationForm="setTranslationForm('name', unitOfMeasureForm.name, 'text')">
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
                    @click="validateUnitOfMeasureForm">
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
        mixins: [translationForm],
        data() {
            return {
                search: null,
                unitMeasureList: [],
                unitMeasurePagination: {},
                loading: false,
                current_page: 1,
                current_size: 25,
                formDropdownLoading: true,
                parentData : {},
                unitOfMeasureForm: {
                    name: null
                },
                unitOfMeasureFormRules: {
                    name: [
                        { required: true, message: this.__('Please input industry name'), trigger: 'blur' }
                    ]
                },
                mode: 'create',
                formDialogVisible: false,
            }
        },
        created() {
            this.formFields = ['name']
            this.fromTable = 'unit_of_measure'

            this.showUnitMeasures()
        },
        watch: {
            search(newSearch, oldSearch) {
                if(newSearch != oldSearch) {
                    this.showUnitMeasures();
                    return;
                }
            }
        },
        methods: {
            showUnitMeasures() {
                this.loading = true;
                let params = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.search
                };
                this.$API.UnitMeasure.showUnitMeasures(params).then(result => {
                    let res = result.data
                    this.unitMeasureList = res.units.data;
                    this.unitMeasurePagination = res.units;
                }).catch(err => {
                    console.log('Error: ', err)
                }).finally(_ => {
                    this.loading = false
                });
            },
            openCreateModal() {
                this.mode = 'create';
                this.formDialogVisible = true;
            },
            validateUnitOfMeasureForm() {
                this.$refs['unitOfMeasureForm'].validate((valid) => {
                    if(valid) {
                        if(this.mode == 'create') {
                            this.store();
                        }else{
                            this.update();
                        }
                    }
                });
            },

            closeFormDialog() {
                this.formDialogVisible = false;
                this.resetFields();
            },
            resetFields() {
                this.$refs['unitOfMeasureForm'].resetFields();
                this.unitOfMeasureForm.name = null
            },
            editUnitMeasure(data) {
                this.unitOfMeasureForm = cloneDeep(data)
                this.mode = 'edit';
                this.formDialogVisible = true;

                this.populateDefault(cloneDeep(this.unitOfMeasureForm.translations))
            },
            handleAction(info) {
				if (info.action === 'delete') {
					this.askToDelete(info.data, info.index)
				}
				else if (info.action === 'update') {
					this.editUnitMeasure(info.data)
				}
			},
            store() {
                this.formDialogVisible = false;

                let postData = cloneDeep(this.unitOfMeasureForm)
                this.setCurrrentLangDefaultValue(postData)

                this.$API.UnitMeasure.store(postData)
                .then(res => {
                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.success_add,
                        type: "success"
                    });

                    // this.showUnitMeasures();
                    this.unitMeasureList.unshift(res.data);
                    this.resetFields();
                }).catch(err => {
                    this.formDialogVisible = true;
                    this.showValidationError(err);
                })
                .finally(_ => {
                    this.loading = false
                })
            },
            update() {
                this.formDialogVisible = false;

                let postData = cloneDeep(this.unitOfMeasureForm)
                this.setCurrrentLangDefaultValue(postData)

                this.$API.UnitMeasure.update(postData)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });
                    this.mode = 'create';
                    this.resetFields();
                    this.unitMeasureList.map ( unit => {
                        if(unit.id === res.data.id) {
                            for(let key in res.data) {
                                unit[key] = res.data[key];
                            }
                        }
                    })
                }).catch(err => {
                    this.formDialogVisible = true;
                    this.showValidationError(err);
                }).finally(_ => {
                    this.loading = false
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
                            title: this.__("Error"),
                            message: h('div', { style: 'list-style-type: none' }, errors.map(errmsg => {
                            return h('div', { style: 'list-style-type: none' }, errmsg);
                            })),
                            type: "error"
                        });
                    }
                }
            },
            askToDelete(id, index) {
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
            delete(id, index) {
                this.$API.UnitMeasure.delete(id)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    this.unitMeasureList.splice(index, 1);
                }).catch(_ => {

                }).finally(_ => {
                    this.loading = false
                })
            },

            handleSizeChange(val) {
                this.current_size = val;
                this.current_page = 1

                this.showUnitMeasures();
            },
            handleCurrentChange(val) {
                this.current_page = val;
                this.showUnitMeasures();
            },
        },
        computed: {
            filteredList(){
                return this.unitMeasureList
            },
        }
    }
</script>


<style lang="scss">
    .category-list {
        .el-dialog__body {
            padding: 10px 20px 10px;
        }

        .el-loading-spinner .path {
            stroke: #EC3434;
        }
        .avatar-uploader .el-upload {
            border: 1px dashed #d9d9d9;
            border-radius: 6px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .avatar-uploader .el-upload:hover {
            border-color: #409EFF;
        }
        .avatar-uploader-icon {
            font-size: 28px;
            color: #8c939d;
            width: 178px;
            height: 178px;
            line-height: 178px;
            text-align: center;
        }
        .avatar {
            width: 178px;
            height: 178px;
            display: block;
        }

        .avatar-uploader {
            margin-top: 25px;
            text-align: center;
        }

        .cluster-dropdown {
            width: 100%;
        }
    }

     .el-message-box {
        width: auto !important;
        padding-bottom: 10px !important;
    }
</style>
