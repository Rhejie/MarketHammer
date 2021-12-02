<template>
    <div class="main-container" v-loading="loading">
        <div class="table-container table-container-business-tab">
            <div class="card borderless">
                    <div class="card-actions">
                        <div class="header-title">
						</div>
                        <div class="search-container">
                            <!-- <el-input
                                class="input-search"
                                v-model="search"
                                placeholder="Search Partners"
                                @keyup.enter.native="showList">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
                            </el-input> -->
                        </div>
                        <div class="secondary-action-buttons">
                                        <base-filter-dropdown-box
                                            hidden
                                            disabled>
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
                                <i class="fas fa-plus"></i> {{ __('Add New Partner') }}
                            </button>
                        </div>
                    </div>

                <el-table
                    class="table-list-container"
                    :data="filteredList"
                    row-key="id"
                    @row-click="editData">
                    <el-table-column
                        prop="company_name"
                        :label="__('Company Name')">
                        <template slot-scope="scope">
                            {{ $sf.ucwords(scope.row.company_name) }}
                        </template>
                    </el-table-column>
                    <!-- <el-table-column
                        label="Company">
                        <template slot-scope="scope">
                            {{ scope.row.parent_business.legal_name }}
                        </template>
                    </el-table-column> -->
                    <el-table-column
                        prop="type"
                        :label="__('Type')">
                        <template slot-scope="scope">
                            {{ $sf.ucwords(scope.row.type) }}
                        </template>
                    </el-table-column>
                    <el-table-column
                        prop="website"
                        :label="__('Website')">
                        <template slot-scope="scope">
                            <a v-if = "scope.row.website" :href="$sf.isValidHttpUrl(scope.row.website) ? scope.row.website : '//'+scope.row.website" target = "_blank">{{ scope.row.website }}</a>
                        </template>
                    </el-table-column>
                    <el-table-column
                        prop="partner_since"
                        :label="__('Partner Since')">
                        <template slot-scope="scope">
                            {{ scope.row.partner_since }}
                        </template>
                    </el-table-column>
                    <el-table-column
                        :label="__('Action')"
                        align="center">
                        <template slot-scope="scope">
                            <div>
                                <button class="btn btn-default text-red" @click.stop @click="askToDelete(scope.row.id)">
                                    <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                </button>
                            </div>
                        </template>
                    </el-table-column>
                    <!--el-table-column :label="__('Actions')" align="center">
							<template slot-scope="scope">
								<el-dropdown
									trigger="click"
									@command="handleAction">
									<el-button
										class="text-black"
										type="text"
										icon="fas fa-ellipsis-v">
									</el-button>
									<el-dropdown-menu slot="dropdown">
										<el-dropdown-item :command="{action: 'update', data: scope.row}">
											<span class="btn-update">
												<i class="fas fa-edit"></i> {{ __('Update') }}
											</span>
										</el-dropdown-item>
										<el-dropdown-item divided :command="{action: 'delete', data: scope.row.id}">
											<span class="btn-update">
												<i class="fas fa-trash-alt"></i> {{ __('Delete') }}
											</span>
										</el-dropdown-item>
									</el-dropdown-menu>
								</el-dropdown>
							</template>
                    </el-table-column-->
                </el-table>
                <div class="text-right">
                    <global-pagination
                    :current_page="current_page"
                    :current_size="current_size"
                    :pagination="partnerPagination"
                    @handleSizeChange="handleSizeChange"
                    @handleCurrentChange="handleCurrentChange"></global-pagination>
                </div>
            </div>
        </div>
        <business-partner-form
            :model="selectedModel"
            :parent-data="parentData"
            :business-list="pageData.businessList ? pageData.businessList : []"
            v-if="formDialogVisible"
            :visible.sync="formDialogVisible"
            @close="handleClose">
        </business-partner-form>
    </div>
</template>

<script>
    import cloneDeep from 'lodash/cloneDeep'

    export default {
        props: {
            business: {
                type: Object,
                required: false
            },
            pageData: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                search: null,
                partnerList: [],
                partnerPagination: {},
                loading: false,
                current_page: 1,
                current_size: 25,
                mode: 'create',
                selectedModel : null,
                parentData : this.business && this.business.id ? this.business : null,
                formDialogVisible : false
            }
        },
        created(){
           this.$EventDispatcher.listen('BUSINESS_PARTNER_NEW_ITEM_CREATED', data => {
                this.showList();
            })

            this.$EventDispatcher.listen('BUSINESS_PARTNER_ITEM_UPDATED', data => {
                this.updatePartner(data)
            })
        },
        mounted(){
            this.showList()
        },
        methods: {
            handleClose() {
                this.formDialogVisible = false
                this.selectedModel = null
            },
            showList() {
                this.loading = true;
                let params = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.search,
                    business_id : this.parentData ? this.parentData.id : null
                };
                this.$API.BusinessPartner.getBusinessPartners(params).then(result => {
                    let res = result.data
                    this.partnerList = res.partner.data;
                    this.partnerPagination = res.partner;
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
            updatePartner(data){
                let getPartner = this.partnerList.findIndex(fn => { return fn.id == data.id})
                if(getPartner >= 0){
                    this.partnerList.splice(getPartner, 1, data);
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
            showValidationError(err) {
                let errors = [];
                const h = this.$createElement;
                if(err.response && err.response.status == 422) {
                    if(err.response.data.errors) {
                        for (var key in err.response.data.errors) {
                            errors.push(err.response.data.errors[key][0]);
                        }

                        this.$notify({
                            title: "Error",
                            message: h('div', { style: 'list-style-type: none' }, errors.map(errmsg => {
                            return h('div', { style: 'list-style-type: none' }, errmsg);
                            })),
                            type: "error"
                        });
                    }
                }
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
                this.$API.BusinessPartner.destroyBusinessPartner(id).then(res => {
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
                this.current_page = 1

                this.showList();
            },
            handleCurrentChange(val) {
                this.current_page = val;
                this.showList();
            },
            handleAction(info) {
                if (info.action === 'delete') {
                    this.askToDelete(info.data)
                }
                else if (info.action === 'update') {
                    this.editData(info.data)
                }
            }
        },
        computed: {
            filteredList(){
                return this.partnerList
            },
        },
        watch: {
            business(val) {
              this.parentData = val && val.id ? val : null
              this.showList();
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
