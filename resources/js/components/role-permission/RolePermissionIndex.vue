<template>
    <div class="material-list">
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
                                <td>Buyer</td>
                                <td>Supplier</td>
                            </tr>
                            <tr v-for="row in tableList"
                                :key="row.permission_id">
                                <td>{{ row.label }}</td>
                                <td>
                                    <el-switch @change = "setPermissionRole('buyer', 'buyer_'+row.name, row)" v-model="row['buyer_'+row.name]"></el-switch>
                                </td>
                                <td>
                                    <el-switch @change = "setPermissionRole('supplier', 'supplier_'+row.name, row)" v-model="row['supplier_'+row.name]"></el-switch>
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
        return {
            tableLoading        : false,
            rolePermissionList  : [],
            tableList           : [],
            permissionList      : this.pageData.permissions
        }
    },
    created() {
        this.getRolePermission()

    },
    methods: {
        setDataList(){
            let prList = cloneDeep(this.permissionList)
            let list = []
            console.log('this.$sf',this.$sf)

            _forEach(this.rolePermissionList, rp =>{
                if(rp.permissions.length > 0){
                    _forEach(rp.permissions, perm => {
                        let fndPrIndex = prList.findIndex(fn => perm.name == fn.name)
                        if(fndPrIndex >= 0){
                            let switchName = rp.name+"_"+prList[fndPrIndex].name
                            console.log('switchName', switchName, fndPrIndex)
                            if(prList[fndPrIndex][switchName] == undefined){
                                this.$set(prList[fndPrIndex], switchName, true)
                            }
                            else{
                                prList[fndPrIndex][switchName] = true
                            }
                        }
                    })
                }

            })
            console.log('prList', prList)

            _forEach(prList, pr =>{
                if(pr.type != 'role_permission'){
                    let lblArr = pr.type.split("_");
                    let label = ""
                    _forEach(lblArr, lb =>{
                        let ltWord = this.$sf.ucwords(lb)
                        label += ltWord + " "
                    })

                    pr.label = label
                    list.push(pr)
                }

            })

            this.tableList = list
        },
        getRolePermission() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.RolePermission.getRolePermission(params).then(res => {
                this.rolePermissionList = res.data.role_permission;
                this.setDataList()
            }).catch(_ => {

            }).finally(_ => {
                this.tableLoading = false;
            });;
        },
        setPermissionRole(role, permissionName, row){
            console.log('setPermissionRole', role, permissionName, row)
            let permName = row[permissionName]
            if(permName){
                this.savePermission(role, row.name)
            }
            else if(!permName){
                this.removePermission(role, row.name)
            }

        },
        savePermission(role, permission){
            let data = {
                role : role,
                permission : permission
            }
            this.$API.RolePermission.save(data).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_save,
                    type: "success"
                });

            }).catch(_ => {

            });
        },
        removePermission(role, permission) {
            this.tableLoading = true;
            let data = {
                role : role,
                permission : permission
            }
            this.$API.RolePermission.remove(data).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_remove,
                    type: "success"
                });

            }).catch(_ => {

            });
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
</style>
