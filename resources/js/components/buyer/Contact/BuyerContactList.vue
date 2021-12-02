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
                    v-loading="loading"
                    @row-click="view">

                    <el-table-column :label="__('Name')" prop="name">
                        <template slot-scope="scope">
                            {{ scope.row.user.first_name }}  {{ scope.row.user.last_name }}
                        </template>
                    </el-table-column>

                    <el-table-column :label="__('Email')" prop="email">
                        <template slot-scope="scope">
                            <span v-if = "scope.row.status == 'accepted'">
                                {{ scope.row.user.email }} 
                            </span>
                        </template>
                    </el-table-column>

                    <el-table-column :label="__('Phone')" prop="phone">
                        <template slot-scope="scope">
                            <span v-if = "scope.row.status == 'accepted'">
                                {{ scope.row.user.phone }} 
                            </span>
                        </template>
                    </el-table-column>

                    <el-table-column :label="__('Request Date')" prop="followed_at">
                        <template slot-scope="scope">
                            <span v-if = "scope.row.status == 'accepted'">
                                {{ scope.row.followed_at ? $df.formatDate(scope.row.followed_at, 'MM/DD/YYYY') : "" }}
                            </span>
                        </template>
                    </el-table-column>


                    <el-table-column :label="__('Status')" prop="status">
                        <template slot-scope="scope">
                            <span v-if = "scope.row.status == 'pending'">
                                {{ __('Waiting for request approval') }}
                            </span>
                            <span v-else-if = "scope.row.status == 'accepted'">
                                {{ __('Contact') }}
                            </span>
                        </template>
                    </el-table-column>
                    <el-table-column :label="__('Actions')">
                        <template slot-scope="scope">
                            <button class="btn btn-default text-red" @click.stop @click="askToDelete(scope.row.id)"> 
                            <i class="fas fa-trash-alt"></i> {{ __("Delete") }} 
                            </button>
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
            type : {
                type: String,
                default: 'contact'
            }
        },
        data() {

            return {
                userData : this.pageData.userData,
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
                mode: 'create',
            }
        },
        created(){
            if(this.type == 'contact'){
                this.$EventDispatcher.listen('LOAD_FOLLOWING_LIST', data => {
                    this.showList();
                });
            }
            
        },
        mounted(){
            //this.loadMetaData()
            this.showList()
        },
        methods: {
            handleAction(info) {
                if (info.action === 'delete') {
                    this.askToDelete(info.data.id)
                }
                else if (info.action === 'approve') {
                    this.approveRequest(info.data)
                }
                else if (info.action === 'view') {
                    this.$router.push({name: 'Contact Details', params: { contact: info.data, id : info.data.id, contacts: this.contactList }})
                }
            },
            view(info){
                this.$router.push({
                    name: 'Contact Details', 
                    params: { contact: info, id : info.id, contacts: this.contactList }
                })
            },
            async approveRequest(data){
                this.loading = true

                //Accept business follower
                let params = {
                    user_id : this.userData.id, 
                    business_id: data.business_id,
                    status : "accepted"
                }

                await this.$API.BusinessFollower.follow(params)
                .then(res => {
                    let result = res.data
                })
                .catch(err => {
                    console.log("Error: ", err)
                })
                .then(_ => { })

                //Update user follower to pending
                let paramsUpdate = data
                paramsUpdate.status = 'accepted'

                await this.$API.UserFollower.follow(paramsUpdate)
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
            applyFilter() {

            },
            showList() {
                if ( !this.userData || !this.userData.id) return

                this.loading = true;

                let params = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.filters.searchString,
                    following_id: this.userData ? this.userData.id : null,
                    joinWith: ['user', 'business'],
                    status: this.type == 'contact' ? ['accepted'] : ['pending']
                }

                this.$API.UserFollower.getList(params)
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
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    type: 'warning',
                    confirmButtonClass: 'el-button--danger'
                }).then(() => {
                    this.deleteData(id);
                }).catch(() => {
                        
                });
            },
            deleteData(id) {
                this.loading = true;
                this.$API.UserFollower.destroy(id).then(res => {
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