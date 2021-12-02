<template>
    <div class="main-container">
            <div class="table-container">
                <div class="card borderless">
                        <div class="card-actions">
                            <div class="header-title">
                                <h5>{{ __('Material') }}</h5>
                            </div>
                            <div class="search-container" style="margin-right: 15px;">
                                <el-input
                                class="input-search"
                                v-model="search"
                                :placeholder="__('Type to search')"
                                @keyup.enter.native="showMaterials">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="action-button-container text-center" style="margin-top: 3px !important;">
                            </div>
                            <div class="add-new-button">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-black"
                                    @click="openCreateMaterialModal">
                                    <i class="fas fa-plus"></i> {{ __("Add Material") }}
                                </button>
                            </div>
                        </div>
                        <!-- Table -->
                        <el-table
                        class="table-list-container"
                        :data="materialData"
                        style="width: 100%; margin-top: 15px;"
                        v-loading="tableLoading"
                        @row-click="editMaterial">
                            <!-- <el-table-column prop="id" label="Material ID">
                            </el-table-column> -->
                            <el-table-column prop="name" :label="__('Material Name')" :sortable="true">
                                <template slot-scope="scope">
                                    <el-button
                                    @click="editMaterial(scope.row)"
                                    type="text"
                                    >
                                        {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
                                    </el-button>
                                </template>
                            </el-table-column>
                            <el-table-column prop="material_type.name" :label="__('Material Type')" :sortable="true">
                                <template slot-scope="scope">
                                    {{ __dt(scope.row.material_type.translations[0], 'material_type.name', $sf.ucwords(scope.row.material_type.name)) }}
                                </template>
                            </el-table-column>
                            <el-table-column prop="description" :label="__('Description')" :sortable="true">
                                <template slot-scope="scope">
                                    {{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
                                </template>
                            </el-table-column>
                            <el-table-column :label="__('Action')" align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button class="btn btn-default text-red" @click="askToDeleteMaterial(scope.row.id, scope.row.index)">
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
                            :pagination="materialPagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination>
                        </div>
                </div>
            </div>

        <!-- EL DIALOG FOR CREATE -->
        <material-form
            :model="selectedModel"
            :parent-data="parentData"
            :material-types="materialType"
            v-if="formDialogVisible"
            :visible.sync="formDialogVisible"
            @close="handleClose">
        </material-form>
    </div>
</template>
<script>
    import cloneDeep from 'lodash/cloneDeep'

export default {
    data: function() {
        return {
            materialData: [],
            materialPagination: {},
            search: '',
            current_page: 1,
            current_size: 25,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: 'create',
            materialForm: {
                name: null,
                material_type_id: null,
                description: null
            },
            materialFormRules: {
                name: [
                    { required: true, message: this.__('Please input material name'), trigger: 'blur' }
                ]
            },
            selectedModel : null,
            parentData : null,
            formDialogVisible : false,
            materialType: []
        }
    },
    created() {
        this.loadMetaData()
        this.showMaterials()

        this.$EventDispatcher.listen('MATERIAL_NEW_ITEM_CREATED', data => {
            // this.showMaterials();
            console.log(data);
            this.materialData.unshift(data);
        })

        this.$EventDispatcher.listen('MATERIAL_ITEM_UPDATED', data => {
            let getMaterial = this.materialData.findIndex(fn => { return fn.id == data.id})
            if(getMaterial >= 0){
                this.materialData.splice(getMaterial, 1, data);
            }
        })
    },
    watch: {
        search(newSearch, oldSearch) {
            if(newSearch != oldSearch) {
                this.showMaterials();
                return;
            }
        }
    },
    methods: {
         loadMetaData() {
            let toLoad = [
                'material_type'
            ]

            this.$API.Utils.getMetaData(toLoad)
            .then(res => {
                this.materialType = res.data.material_type
            })
            .catch(err => {
                console.log(err)
            })
            .finally(_ => {})
        },
        handleClose() {
            this.formDialogVisible = false
            this.selectedModel = null
        },
        showMaterials() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search
            };
            this.$API.Material.getMaterialList(params).then(res => {
                this.materialData = res.data.material.data;
                this.materialPagination = res.data.material;

            }).catch(_ => {

            }).finally(_ => {
                this.tableLoading = false;
            });;
        },
        openCreateMaterialModal() {
            this.mode = 'create';
            this.selectedModel = null;
            this.formDialogVisible = true;
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.askToDeleteMaterial(info.data, info.index);
            } else if (info.action === "update") {
                this.editMaterial(info.data);
            }
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showMaterials();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showMaterials();
        },
        editMaterial(data) {
            this.selectedModel = cloneDeep(data)
            this.mode = 'edit';
            this.formDialogVisible = true;
        },
        askToDeleteMaterial(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                confirmButtonText: this.__('Delete'),
                cancelButtonText: this.__('Cancel'),
                confirmButtonClass: "el-button--danger",
                type: 'warning'
            }).then(() => {
                this.deleteMaterial(id, index);
            }).catch(() => {

            });
        },
        deleteMaterial(id, index) {
            this.$API.Material.destroyMaterial(id).then(res => {
                this.$notify({
                    title: this.__("Success"),
                    message: this.$msg.notif.success_delete,
                    type: "success"
                });

                // this.showMaterials();
                this.materialData.splice(index, 1);
            }).catch(_ => {

            });
        }
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
