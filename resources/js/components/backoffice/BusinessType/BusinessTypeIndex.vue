<template>
    <div class="industry-type-list container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card borderless">
                    <div class="card-header">
                        <div class="card-title"> Business Type List </div>
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <div class="search-container">
                                <el-input
                                class="input-search"
                                v-model="search"
                                placeholder="Type to search"
                                @keyup.enter.native="showBusinessTypes">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="add-btn-container">
                                <button type="button" class="btn btn-primary btn-red" @click="openCreateBusinessTypeModal">Add Business Type</button>
                            </div>
                        </div>
                        <!-- Table -->
                        <el-table
                        class="table-industry-type-list"
                        :data="businessTypeData"
                        style="width: 100%; margin-top: 15px;"
                        v-loading="tableLoading">
                            <el-table-column prop="code" label="Business Code">
                            </el-table-column>
                            <el-table-column prop="name" label="Business Name">
                            </el-table-column>
                            
                            <el-table-column label="Action" align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button class="btn btn-default" @click="editBusinessType(scope.row)"> Edit </button>
                                        <button class="btn btn-default btn-red" @click="askToDeleteBusinessType(scope.row.id)"> Delete </button>
                                    </div>
                                </template>
                            </el-table-column>
                        </el-table>
                        <div class="text-right">
                            <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="businessTypePagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- EL DIALOG FOR CREATE -->
        <el-dialog
        :title="mode == 'create' ? 'New Business Type' : 'Edit Business Type'"
        :visible.sync="formDialogVisible"
        width="45%"
        :before-close="closeFormDialog" 
        :close-on-press-escape="false"
        class="industry-type-dialog"
        :close-on-click-modal="false">
             <el-form ref="BusinessTypeForm" :model="BusinessTypeForm" :rules="BusinessTypeFormRules" class="industry-type-form">
                <el-form-item label="Business Type Code" prop="code">
                    <el-input v-model="BusinessTypeForm.code" placeholder="Business Type Code"></el-input>
                </el-form-item>
                <el-form-item label="Business Type Name" prop="name">
                    <el-input v-model="BusinessTypeForm.name" placeholder="Business Type Name"></el-input>
                </el-form-item>
            </el-form>
            <span slot="footer">
                <button type="button" class="btn btn-default" @click="closeFormDialog">Cancel</button>
                <button type="button" class="btn btn-primary btn-red" @click="validateBusinessTypeForm"> {{ mode == 'create' ? 'Save' : 'Update' }} </button>
            </span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    props: {
        BusinessType: {
            type: Object,
            required: true
        }
    },
    data: function() {
        return {
            businessTypeData: this.BusinessType.data,
            businessTypePagination: this.BusinessType,
            search: '',
            current_page: 1, 
            current_size: 10,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: 'create',
            BusinessTypeForm: {
                name: null,
                code: null,
            },
            BusinessTypeFormRules: {
                code: [
                    { required: true, message: 'Please input business code', trigger: 'blur' }
                ],
                name: [
                    { required: true, message: 'Please input business name', trigger: 'blur' }
                ]
            }
        }
    },
    methods: {
        showBusinessTypes() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.BusinessType.showBusinessTypes(params).then(res => {
                this.businessTypeData = res.data.businessTypes.data;
                this.businessTypePagination = res.data.businessTypes;
                this.tableLoading = false;
            }).catch(_ => {
                this.tableLoading = false;
            });
        },
        openCreateBusinessTypeModal() {
            this.BusinessTypeForm = {
                name: null,
                code: null
            };
            this.mode = 'create';
            this.formDialogVisible = true;
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showBusinessTypes();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showBusinessTypes();
        },
        editBusinessType(data) {
            // this.tableLoading = true;
            // this.$API.BusinessType.showBusinessType(id).then(res => {
            this.BusinessTypeForm = {
                id: data.id,
                name: data.name,
                code: data.code,
            };
            // this.tableLoading = false;
            this.mode = 'edit';
            this.formDialogVisible = true;
            // }).catch(_ => {

            // });
        },
        askToDeleteBusinessType(id) {
            this.$confirm(this.$msg.notif.confirm_delete, 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(() => {
                this.deleteBusinessType(id);
            }).catch(() => {
                    
            });
        },
        closeFormDialog() {
            this.formDialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs['BusinessTypeForm'].resetFields();
        },
        validateBusinessTypeForm() {
            this.$refs['BusinessTypeForm'].validate((valid) => {
                if(valid) {
                    // if(this.mode == 'create') {
                        this.saveBusinessType();
                    // }else{
                    //     this.updateBusinessType();
                    // } 
                }
            });
        },
        saveBusinessType() {
            this.tableLoading = true;
            this.formDialogVisible = false;
            this.$API.BusinessType.saveBusinessType(this.BusinessTypeForm).then(res => {
                // console.log(res.data, res.data.success)
                if (res.data.success) {
                    this.$notify({
                        title: "Success",
                        message: this.$msg.notif.confirm_delete,
                        type: "success"
                    });
                } else {
                    if (res.data.msg && res.data.msg != '') {
                        this.$notify({
                            title: "Error",
                            message: res.data.msg,
                            type: "error"
                        });
                    } else {
                        if (res.data.success != true) {
                            this.$notify({
                                title: "Error",
                                message: this.$msg.notif.failed_add,
                                type: "error"
                            });
                        } else {
                            this.$notify({
                                title: "Success",
                                message: this.$msg.notif.success_add,
                                type: "success"
                            });
                        }
                        
                    }
                    
                }
                
                this.showBusinessTypes();
                this.tableLoading = false;
                this.resetFields();
            }).catch(err => {
                this.showBusinessTypes();
                this.formDialogVisible = true;
                this.tableLoading = false;
                this.showValidationError(err);
            });
        },
        updateBusinessType() {
            this.tableLoading = true;
            this.formDialogVisible = false;
            this.$API.BusinessType.updateBusinessType(this.BusinessTypeForm).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_update,
                    type: "success"
                });
                this.mode = 'create';
                this.resetFields();
                this.showBusinessTypes();
            }).catch(err => {
                this.formDialogVisible = true;
                this.tableLoading = false;
                this.showValidationError(err);
            });
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
                        title: "Error",
                        message: h('div', { style: 'list-style-type: none' }, errors.map(errmsg => {
                        return h('div', { style: 'list-style-type: none' }, errmsg);
                        })),
                        type: "error"
                    });
                }
            }
        },
        deleteBusinessType(id) {
            let params = {
                id: id
            };
            this.tableLoading = true;
            this.$API.BusinessType.deleteBusinessType(params).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_delete,
                    type: "success"
                });

                this.showBusinessTypes();
            }).catch(_ => {
                this.showBusinessTypes();
            });
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
                .el-input {
                    margin-top: 10px;
                }
            }
        }
    }
</style>