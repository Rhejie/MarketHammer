<template>
    <div class="theme-list container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card borderless">
                    <div class="card-header">
                        <div class="card-title"> Theme List </div>
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <div class="search-container">
                                <el-input
                                class="input-search"
                                v-model="search"
                                placeholder="Type to search"
                                @keyup.enter.native="showThemes">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="add-btn-container">
                                <button type="button" class="btn btn-primary btn-red" @click="openCreateThemeModal">Add Theme</button>
                            </div>
                        </div>
                        <!-- Table -->
                        <el-table
                        class="table-theme-list"
                        :data="themesData"
                        style="width: 100%; margin-top: 15px;"
                        v-loading="tableLoading">
                            <el-table-column prop="color" label="Name">
                                <template slot-scope="scope">
                                    {{ scope.row.color }}
                                </template>
                            </el-table-column>
                            <el-table-column prop="color" label="Color">
                                <template slot-scope="scope">
                                    <span style="padding:":style="{'background-color': scope.row.hexCode, 'color': scope.row.hexCode, 'padding' : '15px', 'cursor' : 'pointer', 'user-select': 'none'}">O</span>
                                </template>
                            </el-table-column>
                            <el-table-column label="Action" align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button class="btn btn-default" @click="editTheme(scope.row.id)"> Edit </button>
                                        <button class="btn btn-default btn-red" @click="askToDeleteTheme(scope.row.id)"> Delete </button>
                                    </div>
                                </template>
                            </el-table-column>
                        </el-table>
                        <div class="text-right">
                            <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="themesPagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- EL DIALOG FOR CREATE -->
        <el-dialog
        :title="mode == 'create' ? 'New Theme' : 'Edit Theme'"
        :visible.sync="formDialogVisible"
        width="35%"
        :before-close="closeFormDialog"
        class="add-theme-dialog"
        :close-on-press-escape="false"
        :close-on-click-modal="false">
            <el-form ref="themeForm" :model="themeForm" :rules="themeFormRules">
                <el-form-item label="Theme Name" prop="color">
                    <el-input v-model="themeForm.color" placeholder="Theme Name"></el-input>
                </el-form-item>
                <el-form-item label="Theme Color" prop="hexCode">
                    <el-color-picker v-model="themeForm.hexCode" class="full-width mg-t-10 "></el-color-picker>
                </el-form-item>
            </el-form>
            <span slot="footer">
                <button type="button" class="btn btn-default" @click="closeFormDialog">Cancel</button>
                <button type="button" class="btn btn-primary btn-red" @click="validateThemeForm"> {{ mode == 'create' ? 'Save' : 'Update' }} </button>
            </span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    props: {
        themes: {
            type: Object,
            required: true
        },
    },
    data: function() {
        return {
            themesData: this.themes.data,
            themesPagination: this.themes,
            current_page: 1,
            current_size: 10,
            search: '',
            tableLoading: false,
            mode: 'create',

            // Form dialog
            formDialogVisible: false,
            themeForm: {
                color: '',
                hexCode: '#EC3434',
            },
            themeFormRules: {
                color: [
                    { required: true, message: 'Please input theme color', trigger: 'blur' }
                ]
            }
        }
    },
    methods: {
        showThemes() {
            this.tableLoading = true;
            let params = {
                current_page: this.current_page,
                current_size: this.current_size,
                search: this.search
            };
            this.$API.Theme.showThemes(params).then(res => {
                this.themesData = res.data.themes.data;
                this.themesPagination = res.data.themes;
                this.tableLoading = false;
            }).catch(_ => {

            });
        },
        openCreateThemeModal() {
            this.themeForm.color = '';
            this.themeForm.hexCode = '#EC3434';
            this.formDialogVisible = true;
            this.mode = 'create';
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showThemes();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showThemes();
        },
        closeFormDialog() {
            this.formDialogVisible = false;
            this.resetFields();
        },
        resetFields() {
            this.$refs['themeForm'].resetFields();
        },
        validateThemeForm() {
            this.$refs['themeForm'].validate((valid) => {
                if(valid) {
                    if(this.mode == 'create') {
                        this.storeTheme();
                    }else{
                        this.updateTheme();
                    } 
                }
            });
        },
        editTheme(id) {
            this.tableLoading = true;
            this.$API.Theme.showTheme(id).then(res => {
                this.themeForm = {
                    id: res.data.theme.id,
                    color: res.data.theme.color,
                    hexCode: res.data.theme.hexCode
                };

                this.formDialogVisible = true;
                this.tableLoading = false;
                this.mode = 'edit';
            }).catch(_ => {

            });
        },
        storeTheme() {
            this.tableLoading = true;
            this.formDialogVisible = false;
            this.$API.Theme.storeTheme(this.themeForm).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_add,
                    type: "success"
                });
                this.resetFields();
                this.showThemes();
            }).catch(err => {
                this.formDialogVisible = true;
                this.tableLoading = false;
                this.showValidationError(err);
            });
        },
        updateTheme() {
            this.tableLoading = true;
            this.formDialogVisible = false;
            this.$API.Theme.updateTheme(this.themeForm).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_update,
                    type: "success"
                });
                this.resetFields();
                this.showThemes();
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
        askToDeleteTheme(id) {
            this.$confirm(this.$msg.notif.confirm_delete, 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(() => {
                this.deleteTheme(id);
            }).catch(() => {
                    
            });
        },
        deleteTheme(id) {
            this.tableLoading = true;
            this.$API.Theme.destroyTheme(id).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_delete,
                    type: "success"
                });
                
                this.showThemes();
            }).catch(_ => {

            });
        }
    }

}
</script>
<style lang="scss">
    .theme-list {
        .el-dialog__body {
            padding: 20px;
        }

        .el-table {
            td.el-table_1_column_1, th.el-table_1_column_1 {
                padding-left: 30px;
            }
        }

        .el-form-item__content {
            .el-input {
                margin-toP: 10px;
            }
        }
    }
</style>