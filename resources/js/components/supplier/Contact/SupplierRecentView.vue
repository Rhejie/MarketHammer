<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">

                <!-- Global Header Type -->
                <div class="card-actions">
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
                                title="Filter"
                                icon="fas fa-filter">
                            </el-button>

                            <el-button
                                disabled
                                class="mh-btn">
                                <i class="fas fa-table"></i>
                            </el-button>
                    </div>
                </div>
                <!-- End of Global Header Type -->

                <el-table
                    class="table-list-container"
                    :data="filteredList"
                    row-key="id"
                    style="width: 100%;"
                    v-loading="loading">

                    <el-table-column :label="__('Name')" prop="name">
                        <template slot-scope="scope">
                            {{ scope.row.user.first_name }}  {{ scope.row.user.last_name }}
                        </template>
                    </el-table-column>

                    <el-table-column :label="__('Viewed On')" prop="created_at">
                        <template slot-scope="scope">
                            {{ scope.row.created_at ? $df.formatDate(scope.row.created_at, 'MM/DD/YYYY') : "" }}
                        </template>
                    </el-table-column>

                    <el-table-column :label="__('Actions')">
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
                                    <el-dropdown-item v-if = "scope.row.status == 'view'" :command="{action: 'follow', data: scope.row}">
                                        <span class="text-blue">
                                            <i class="fas fa-edit"></i> {{ __("Request to Follow") }}
                                        </span>
                                    </el-dropdown-item>
                                    <el-dropdown-item divided :command="{action: 'delete', data: scope.row}">
                                        <span class="text-red">
                                            <i class="fas fa-trash-alt"></i> {{ __("Remove") }}
                                        </span>
                                    </el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="text-right">
                    <global-pagination
                    :current_page="current_page"
                    :current_size="current_size"
                    :pagination="contactPagination"
                    @handleSizeChange="handleSizeChange"
                    @handleCurrentChange="handleCurrentChange"></global-pagination>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import cloneDeep from 'lodash/cloneDeep'

    export default {
        props: {
            pageData: {
                type: Object,
                required: true
            },
            business: {}
        },
        data() {
            return {
                filters: {
                    searchString: null,
                    toFilter: null,
                    daterange: null
                },
                contactList: [],
                contactPagination: {},
                loading: false,
                current_page: 1,
                current_size: 25,
            }
        },
        created(){
           
        },
        mounted(){
            //this.loadMetaData()
            console.log('Supplier mounted')
            this.showList()
        },
        methods: {
            handleAction(info) {
                if (info.action === 'delete') {
                    this.askToDelete(info.data.id)
                }
                else if (info.action === 'follow') {
                    this.requestToFollow(info.data)
                }
            },
            applyFilter() {

            },
            async requestToFollow(data){
                this.loading = true

                //Follow user
                let params = {
                    following_id : data.user_id, 
                    follower_id: this.$userData.activeUserId, 
                    business_id: this.business ? this.business.id : null,
                    status : "pending"
                }
                await this.$API.UserFollower.follow(params)
                .then(res => {
                    let result = res.data
                })
                .catch(err => {
                    console.log("Error: ", err)
                })
                .then(_ => { })

                //Update business follower to pending
                let paramsUpdate = data
                paramsUpdate.status = 'pending'

                await this.$API.BusinessFollower.update(paramsUpdate)
                .then(res => {
                    let result = res.data
                })
                .catch(err => {
                    console.log("Error: ", err)
                })
                .then(_ => { })


                this.$notify({
                    title: this.__("Success"),
                    message: this.__("Successfully followed."),
                    type: "success"
                });

                this.$EventDispatcher.fire('LOAD_FOLLOWING_LIST')
                this.loading = false
                this.showList()

            },
            showList() {
                if (!this.business || !this.business.id) return

                this.loading = true;

                let params = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.filters.searchString,
                    business_id: this.business ? this.business.id : null,
                    joinWith: ['user'],
                    status: 'view'
                }

                this.$API.BusinessFollower.getList(params)
                .then(result => {
                    let res = result.data
                    this.contactList = res.list.data;
                    this.contactPagination = res.list;
                })
                .catch(err => {
                    console.log('Error: ', err)
                })
                .finally(_ => {
                    this.loading = false
                });
            },
            askToDelete(id) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                    confirmButtonText: this.__('OK'),
                    cancelButtonText: this.__('Cancel'),
                    type: 'warning'
                }).then(() => {
                    this.deleteData(id);
                }).catch(() => {
                        
                });
            },
            deleteData(id) {
                this.loading = true;
                this.$API.BusinessFollower.destroy(id).then(res => {
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
        },
        computed: {
            filteredList(){
                return this.contactList
            },
        },
    }
</script>
