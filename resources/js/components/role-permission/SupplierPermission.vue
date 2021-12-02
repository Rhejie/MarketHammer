<template>
    <div class="material-list" v-loading = "tableLoading">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card borderless">
                    <div class="card-header">
                        <div class="card-title"> Role Permission </div>
                    </div>
                    <div class="card-body">
                        <table class = "table no-bordered">
                            <tr>
                                <td></td>
                                <td>Public</td>
                                <td>Buyer</td>
                                <td>Supplier</td>
                                <td>MH Partner</td>
                            </tr>
                            <tr v-for="row in tableList"
                                :key="row.permission_id">
                                <td>{{ row.name }}</td>
                                <td>
                                    <el-switch @change = "setPermissionRole(-1, 'buyer'+row.code, row)" v-model="row['public'+row.code]"></el-switch>
                                </td>
                                <td>
                                    <el-switch @change = "setPermissionRole(1, 'buyer'+row.code, row)" v-model="row['buyer'+row.code]"></el-switch>
                                </td>
                                <td>
                                    <el-switch @change = "setPermissionRole(2, 'supplier'+row.code, row)" v-model="row['supplier'+row.code]"></el-switch>
                                </td>
                                <td>
                                    <el-switch @change = "setPermissionRole(0, 'partner'+row.code, row)" v-model="row['partner'+row.code]"></el-switch>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import cloneDeep from 'lodash/cloneDeep'
    import _forEach from 'lodash/forEach'

export default {
    props: {
        pageData: {
            type: Object,
            required: true
        }
    },
    data: function() {
        let userTypes = [
            {name: "public", id : -1},
            {name: "buyer", id : 1},
            {name: "supplier", id : 2},
            {name: "partner", id : 0},
        ]
        return {
            tableLoading        : false,
            businessPermission  : [],
            tableList           : [],
            permissionList      : this.pageData.permissions,
            businessData        : this.pageData.business,
            userTypes           : userTypes
        }
    },
    created() {
        this.getBusinessPermission()
        
    },
    methods: {
        setDataList(){
            let prList = cloneDeep(this.permissionList)
            let list = []
            console.log('this.$sf',this.$sf)

            _forEach(prList, pr =>{

                _forEach(this.userTypes, ut =>{

                    //Set switch data
                    let switchName = ut.name+pr.code
                    if(pr[switchName] == undefined){
                        this.$set(pr, switchName, false)
                    }

                    //Get business permission
                    let getDataPermission = this.getDataPermission(pr.id, ut.id)
                    pr[switchName] = getDataPermission ? true : false

            
                })
                
            }) 
            console.log('prList', prList)

            list = prList
            this.tableList = list
        },
        getDataPermission(permission_id, user_type_id){
            let getPerm = this.businessPermission.find(fn => { return Number(user_type_id) === Number(fn.user_type_id) && Number(permission_id) ==  fn.user_type_permission_id })
            if(getPerm){
                return getPerm
            }
        },
        getBusinessPermission() {
            console.log('getRolePermission')
            if(this.businessData){
                this.tableLoading = true;
                let params = {
                    business_id : this.businessData.id
                };
                this.$API.BusinessUserTypePermission.getPermission(params).then(res => {
                    this.businessPermission = res.data.permission;
                    this.setDataList()
                }).catch(_e => {
                    console.log("Error: ", _e)
                }).finally(_ => {
                    this.tableLoading = false;
                });
            }
            
        },
        setPermissionRole(user_type_id, permissionName, row){
            let permName = row[permissionName]
            console.log('setPermissionRole', user_type_id, permissionName, row, permName)
            if(permName){
                this.savePermission(user_type_id, row.id)
            }
            else if(!permName){
                this.removePermission(user_type_id, row.id)
            }
            
        },
        savePermission(user_type_id, permission_id){
            this.tableLoading = true;
            let data = {
                user_type_id : user_type_id,
                user_type_permission_id : permission_id,
                business_id : this.businessData.id
            }
            this.$API.BusinessUserTypePermission.store(data).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_save,
                    type: "success"
                });

            }).catch(_ => {

            }).finally(_ => {
                this.tableLoading = false
            });
        },
        removePermission(user_type_id, permission_id) {
            let getDataPermission = this.getDataPermission(permission_id, user_type_id)
            if(getDataPermission){

                this.tableLoading = true;
                this.$API.BusinessUserTypePermission.destroy(getDataPermission.id).then(res => {
                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.success_remove,
                        type: "success"
                    });

                }).catch(_ => {

                }).finally(_ => {
                    this.tableLoading = false
                });
                
            }
            
        },
    }
}
</script>
<style lang="scss">
    .material-list {
        .el-dialog {
            .el-dialog__body {
                padding: 20px;
            }
            .material-form {
            }
        }
    }
</style>Pe