<template>
    <div class="main-container">
            <div class="table-container table-container-business-tab">
                <div class="card borderless">
                        <div class="card-actions">
                            <div class="header-title">
                                <h5>{{ __('QSA List') }}</h5>
                            </div>
                            <div class="search-container">
                                <el-input
                                    class="input-search"
                                    v-model="search"
                                    :placeholder="__('Type to search')"
                                    @keyup.enter.native="showList">
                                    <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="secondary-action-buttons">
                                <base-filter-dropdown-box
                                disabled
                                class="mh-btn filter">
                                </base-filter-dropdown-box>
                                <el-button
                                disabled
                                class="mh-btn"
                                title="Import">
                                <i class="fas fa-table"></i>
                                </el-button>
                                <el-button
                                disabled
                                class="mh-btn"
                                title="Export">
                                <i class="fas fa-file-alt"></i>
                                </el-button>
                            </div>
                            <div class="add-new-button">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-black"
                                    @click="openCreateModal">
                                    <i class="fas fa-plus"></i>
                                    {{ __("Add New QSA") }}
                                </button>
                            </div>
                        </div>
                        <el-table
                            class="table-list-container"
                            :data="typeList"
                            row-key="id"
                            style="width: 100%; margin-top: 15px;"
                            v-loading="loading"
                            @row-click="editData">
                            <el-table-column
                                prop="name"
                                :label="__('QSA Name')"
                                :sortable="true">
                                <template slot-scope="scope">
                                        {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}

                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="qsa_type.name"
                                :label="__('QSA Type')"
                                :sortable="true">
                                <template slot-scope="scope">
                                    {{ __dt(scope.row.qsa_type.translations[0], 'qsa_type.name', $sf.ucwords(scope.row.qsa_type.name)) }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="description"
                                :label="__('Description')"
                                :sortable="true">
                                <template slot-scope="scope">
                                    {{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                :label="__('Actions')"
                                align="center">
                                    <template slot-scope="scope">
                                        <div>
                                            <button class="btn btn-default text-red" @click.stop @click="askToDelete(scope.row, scope.$index)">
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
                            :pagination="typePagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination>
                        </div>
                </div>
            </div>

        <!-- EL DIALOG FOR CREATE -->
        <qsa-list-form
            :model="selectedModel"
            :page-data="{business}"
            :qsa-type-list="qsaTypeList"
            v-if="formDialogVisible"
            :visible.sync="formDialogVisible"
            @close="handleClose">
        </qsa-list-form>

    </div>
</template>

<script>
    import cloneDeep from 'lodash/cloneDeep'
    import pagination from "../../../mixins/pagination";
    import translationForm from "../../../mixins/translationForm.js";

    export default {
        props: {
            business: {}
        },
        mixins: [pagination, translationForm],
        data() {
            return {
                search: null,
                typeList: [],
                typePagination: {},
                loading: false,
                current_page: 1,
                current_size: 25,
                formDropdownLoading: true,
                selectedModel: null,
                parentData : {},
                modelForm: {
                    name: null,
                    qsa_type_id: null,
                    description : null
                },
                mode: 'create',
                formDialogVisible: false,
                qsaTypeList : []
            }
        },
        created(){
            this.loadMetaData()
            this.showList()

            this.$EventDispatcher.listen('QSALIST_NEW_ITEM_CREATED', data => {
                console.log(data);
                this.typeList.unshift(data);
                this.filters.total++;
                // this.showList();

            })

            this.$EventDispatcher.listen('QSALIST_ITEM_UPDATED', data => {
                // let getData = this.typeList.findIndex(fn => { return fn.id == data.id})
                // if(getData >= 0){
                //     this.typeList.splice(getData, 1, data);
                // }
                console.log(data);
                this.typeList.map(qsa => {
                    if(qsa.id === data.id) {
                        for(let key in data) {
                            qsa[key] = data[key];
                        }
                    }
                })
            })
        },
        methods: {
            loadMetaData() {
                let toLoad = [
                    'qsa_type'
                ]

                this.$API.Utils.getMetaData(toLoad)
                .then(res => {
                    this.qsaTypeList = res.data.qsa_type
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {})
            },
            showList() {
                this.loading = true;
                let params = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.search
                };

                if(this.business && this.business.id){
                    params.business_id = this.business.id
                }

                this.$API.QsaList.getQsaList(params).then(result => {
                    let res = result.data
                    this.typeList = res.qsa_list.data;
                    this.typePagination = res.qsa_list;
                }).catch(err => {
                    console.log('Error: ', err)
                }).finally(_ => {
                    this.loading = false
                });
            },
            openCreateModal() {
                this.mode = 'create';
                this.selectedModel = null;
                this.formDialogVisible = true;
            },
            closeFormDialog() {
                this.formDialogVisible = false;
                this.resetFields();
            },
            resetFields() {
                this.$refs['modelForm'].resetFields();
                this.modelForm.name = null
                this.modelForm.description = null
            },
            editData(data) {
                this.selectedModel = cloneDeep(data)
                this.mode = 'edit';
                this.formDialogVisible = true;
            },
            handleClose() {
                this.formDialogVisible = false
                this.selectedModel = null
            },
            askToDelete(data, index) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    confirmButtonClass: "el-button--danger",
                    type: 'warning'
                }).then(() => {
                    if(this.business && this.business.id){
                        if(data.business_qsa){
                            this.deleteDataInBusiness(data.business_qsa.id, index)
                        }
                    }
                    else{
                        this.deleteData(data.id, index);
                    }

                }).catch(() => {

                });
            },
            handleAction(info) {
				if (info.action === 'delete') {
					this.askToDelete(info.data, info.index)
				}
				else if (info.action === 'update') {
					this.editData(info.data)
				}
			},
            deleteData(id, index) {
                this.$API.QsaList.destroy(id).then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    // this.showList();
                    this.typeList.splice(index, 1)
                    this.filters.total--;
                }).catch(_ => {

                }).finally(_ => {
                    this.loading = false
                })
            },
            deleteDataInBusiness(id, index) {
                this.$API.BusinessQsa.destroy(id).then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    // this.showList();
                    this.typeList.splice(index, 1);
                }).catch(_ => {

                }).finally(_ => {
                    this.loading = false
                })
            },

            handleSizeChange(val) {
                this.current_size = val;
                this.current_page = 1

                this.showList();
            },
            handleCurrentChange(val) {
                this.current_page = val;
                this.showList();
            },
        },
        computed: {
            filteredList(){
                return this.typeList
            },
        },
        watch: {
            'business.id'() {
                this.showList()
            }
        }
    }
</script>


<style lang="scss">

     .el-message-box {
        width: auto !important;
        padding-bottom: 10px !important;
    }

</style>
