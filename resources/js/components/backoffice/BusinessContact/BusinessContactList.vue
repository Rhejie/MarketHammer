<template>
    <div class="main-container">
        <div class="table-container table-container-business-tab">
            <div class="card borderless">
                <!-- <div class="card-header" v-if="!pageData.isSupplierView">
                    <div class="card-title"> Contact List </div>
                </div> -->
                    <!-- Global Header Type -->
                    <div class="card-actions" v-if="!pageData.isSupplierView">
                        <div class="header-title">
                            <h5>Contacts </h5>
                        </div>
                        <div class="search-container">
                            <el-input
                                class="input-search"
                                v-model="filters.searchString"
                                :placeholder="__('Type to search')"
                                @keyup.enter.native="showList">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
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
                                    class="mh-btn"
                                    @click="exportBusinessContacts">
                                    <i class="fas fa-file-alt"></i>
                                </el-button>
                        </div>
                        <div class="add-new-button">
                            <button
                                type="button"
                                class="btn btn-primary btn-black"
                                @click="openCreateModal">
                                <i class="fas fa-plus"></i> {{ __('Add New Contact') }}
                            </button>
                        </div>
                    </div>
                    <!-- End of Global Header Type -->

                    <!-- Supplier View Mode Header Type -->
                    <div class="card-actions" v-else>
                            <div class="header-title">
                            </div>
                            <div class="search-container">
                                <el-input
                                    suffix-icon="fas fa-search"
                                    class="input-search"
                                    clearable
                                    @keyup.enter.native="showList"
                                    v-model="filters.searchString"
                                    :placeholder="__('Search Contacts')">
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
                                    class="mh-btn"
                                    title="Import">
                                    <i class="fas fa-table"></i>
                                </el-button>
                                <el-button
                                    class="mh-btn"
                                    @click="exportBusinessContacts"
                                    :title="__('Export')">
                                    <i class="fas fa-file-alt"></i>
                                </el-button>
                            </div>
                            <div class="add-new-button">
                                <el-button
                                    round
                                    :disabled="pageData.isSupplierView && (!business || !business.id)"
                                    class="btn btn-black"
                                    @click="formDialogVisible = true">
                                    <i class="fas fa-plus"></i> {{ __('Add New Contact') }}
                                </el-button>
                            </div>
                    </div>
                    <!-- End of Supplier View Mode Header Type -->


            </div>

            <el-table
            class="table-list-container"
            :data="filteredList"
            style="width: 100%"
            v-loading="loading"
            @row-click="editData">

            <el-table-column prop="name" :label="__('Name')" sortable="true" showTooltip: true> 
            </el-table-column>

            <el-table-column v-if="!hasBusiness" prop="parent_business.legal_name" :label="__('Company')" sortable="true" showTooltip: true> 
            </el-table-column>

            <el-table-column
                v-for="col in columns"
                :key="col.key"
                :label="__(col.label)"
                :prop="col.key"
                :sortable="col.sortable">
                <template slot-scope="scope">
                    <!--template v-if="col.key === 'company' && !hasBusiness">
                        {{ scope.row.parent_business ? scope.row.parent_business.legal_name : '' }}
                    </template-->

                    <template v-if="col.key === 'created_at'">
                        {{ $df.formatDate(scope.row.created_at, 'MM/DD/YYYY')  }}
                    </template>

                    <template v-else>
                        {{ scope.row[col.key] }}
                    </template>
                </template>
            </el-table-column>

            <el-table-column :label="__('Actions')">
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
                :pagination="contactPagination"
                @handleSizeChange="handleSizeChange"
                @handleCurrentChange="handleCurrentChange"></global-pagination>
            </div>
        </div>

        <business-contact-form
            :business="business"
            :model="selectedModel"
            :parent-data="parentData"
            :business-list="pageData.businessList"
            :page-data="formPageData"
            v-if="formDialogVisible"
            :visible.sync="formDialogVisible"
            @close="handleClose">
        </business-contact-form>
    </div>
</template>

<script>
    import cloneDeep from 'lodash/cloneDeep'
    import fileExporter from '../../../mixins/fileExporter'

    export default {
        props: {
            pageData: {
                type: Object,
                required: true
            },
            business: {}
        },
        mixins: [fileExporter],
        data() {
            let columns = [
                //{label: 'Name', key: 'name', sortable: true, showTooltip: true},
                //{label: 'Company', key: 'company', sortable: true, showTooltip: true},
                {label: 'Title', key: 'title', sortable: true, showTooltip: true},
                {label: 'Phone', key: 'phone', sortable: true, showTooltip: true},
                {label: 'Email', key: 'email', sortable: true, showTooltip: true},
                {label: 'Registered', key: 'created_at', sortable: true, showTooltip: true}
            ]

            return {
                filters: {
                    searchString: null,
                    toFilter: null,
                    daterange: null
                },
                contactList: [],
                columns: columns,
                contactPagination: {},
                loading: false,
                current_page: 1,
                current_size: 25,
                mode: 'create',
                selectedModel : null,
                parentData : null,
                formDialogVisible : false,
                contactRoleList : false,
                formPageData : {roles : []}
            }
        },
        created(){
           this.$EventDispatcher.listen('BUSINESS_CONTACT_NEW_ITEM_CREATED', data => {
                this.showList();
            })

            this.$EventDispatcher.listen('BUSINESS_CONTACT_ITEM_UPDATED', data => {
                this.updateContact(data)
            })
        },
        mounted(){
            this.loadMetaData()
            this.showList()
        },
        methods: {
            loadMetaData() {
                console.log('loadMetaData')
                let toLoad = [
                    'contact_role'
                ]

                this.$API.Utils.getMetaData(toLoad)
                .then(res => {
                    this.contactRoleList = res.data.contact_role
                    this.formPageData.roles = res.data.contact_role
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {})
            },
            handleAction(info) {
                if (info.action === 'delete') {
                    this.askToDelete(info.data.id)
                }
                else if (info.action === 'update') {
                    this.editData(info.data)
                }
            },
            applyFilter() {

            },
            exportBusinessContacts() {
                let postData = cloneDeep(this.contactList).map(con => {
                    return {
                        name: this.$sf.ucwords(con.name),
                        company: this.$sf.ucwords(con.company),
                        title: this.$sf.ucwords(con.title),
                        phone: this.$sf.ucwords(con.phone),
                        email: this.$sf.ucwords(con.email),
                        created_at: this.$df.formatDate(con.created_at, 'MM/DD/YYYY')
                    }
                })

                this.loading = true

                this.$API.BusinessContact.exportContacts(postData)
                .then(res => {
                    this.exporter('xlsx', this.__('Business Contacts'), res.data, false)
                })
                .catch(err => {
                    console.log(err)
                    this.$notify.error({
                        title: this.__('Import Error'),
                        message: this.__('Failed to download contacts. Refresh the page or report this to your administrator.')
                    });
                })
                .finally(_ => {
                    this.loading = false
                })
            },
            handleClose() {
                this.formDialogVisible = false
                this.selectedModel = null
                this.parentData = null
            },
            showList() {
                if (this.pageData.isSupplierView && (!this.business || !this.business.id)) return

                this.loading = true;

                let params = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.filters.searchString,
                    business_id: this.business ? this.business.id : null
                }

                this.$API.BusinessContact.getBusinessContactList(params)
                .then(result => {
                    let res = result.data
                    this.contactList = res.contact.data;
                    this.contactPagination = res.contact;
                })
                .catch(err => {
                    console.log('Error: ', err)
                })
                .finally(_ => {
                    this.loading = false
                });
            },
            openCreateModal() {
                this.mode = 'create';
                this.selectedModel = null;
                this.parentData = null;
                this.formDialogVisible = true;
            },
            updateContact(data) {
                let getContact = this.contactList.findIndex(fn => { return fn.id == data.id})
                if(getContact >= 0){
                    this.contactList.splice(getContact, 1, data);
                }
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
            askToDelete(id) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    confirmButtonClass: "el-button--danger",
                    type: 'warning'
                }).then(() => {
                    this.deleteData(id);
                }).catch(() => {

                });
            },
            deleteData(id) {
                this.loading = true;
                this.$API.BusinessContact.destroyBusinessContact(id).then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    this.showList();
                }).catch(_ => {

                }).finally(_ => {
                    this.loading = false
                })
            },

            handleSizeChange(val) {
                this.current_size = val;
                //this.current_page = 1

                this.showList();
            },
            handleCurrentChange(val) {
                this.current_page = val;
                this.showList();
            },
        },
        computed: {
            dateTitle() {
                return ''
            },
            filteredList(){
                return this.contactList
            },
            hasBusiness() {
				return this.business && this.business.id ? true : false
			}
        },
        watch: {
            'business.id'() {
                this.showList()
            }
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
