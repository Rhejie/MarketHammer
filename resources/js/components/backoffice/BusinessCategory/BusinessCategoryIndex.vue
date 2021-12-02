<template>
    <div class="main-container" v-loading = "loading">
            <div class="table-container">
                <div class="card borderless">
                        <div class="card-actions">
                            <div class="header-title">
                                <h5>{{ __('Business Category') }}</h5>
                            </div>
                            <div class="search-container">
                                <el-input
                                    class="input-search"
                                    v-model="search"
                                    @keyup.enter.native="getBusinessSearch"
                                    :placeholder="__('Type to search')">
                                    <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="secondary-action-buttons">
                                        <button type="button" class="btn btn-outline-gray" @click="openCategoryImportModal()">
                                            <i class="el-icon-upload2"></i>
                                        </button>
                            </div>
                            <div class="add-new-button">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-black"
                                    @click="parentData = {}; showBusinessCategoryForm = true;">
                                    <i class="el-icon-plus"></i> {{ __("Add Category") }}
                                </button>
                            </div>
                        </div>
                        <!-- Table -->
                        <business-category-tree :data-business-category = "categoriesData" :filter-search = "null">
                        </business-category-tree>
                        <!-- Table -->
                        <!-- <el-table
                            class="table-category-list"
                            :data="filteredCategories"
                            row-key="id"
                            style="width: 100%; margin-top: 15px;"
                            v-loading="loading">
                            <el-table-column
                                prop="name"
                                label="Category Name">
                                <template slot-scope="scope">
                                    {{ $sf.ucwords(scope.row.name) }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                label="Industry Type">
                                <template slot-scope="scope">
                                    {{ $sf.ucwords(scope.row.industry_type ? scope.row.industry_type.name : '') }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                label="Action"
                                align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button
                                            class="btn btn-default"
                                            @click="updateBusinessCategory(scope.row)">
                                            Edit
                                        </button>
                                        <button
                                            class="btn btn-default btn-red"
                                            @click="deleteCategory(scope.row.id)">
                                            Delete
                                        </button>
                                    </div>
                                </template>
                            </el-table-column>
                        </el-table> -->
                        <div class="text-right">
                            <!-- <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination> -->
                        </div>
                </div>
            </div>

        <business-category-import-modal></business-category-import-modal>

        <business-category-form
            :model="selectedModel"
            :parent-data="parentData"
            :industry-types="industryTypes"
            :business-categories="masterCategories"
            v-if="showBusinessCategoryForm"
            :visible.sync="showBusinessCategoryForm"
            @close="handleClose">
        </business-category-form>

    </div>
</template>

<script>
    import cloneDeep from 'lodash/cloneDeep'
    import GlobalPagination from './utilities/GlobalPagination.vue'

    import translationForm from '../../../mixins/translationForm'

    export default {
        components: {
            GlobalPagination
        },
        mixins: [translationForm],
        data() {
            return {
                showBusinessCategoryForm: false,
                search: null,
                categoriesData: [],
                masterCategories: [],
                loading: false,
                current_page: 1,
                current_size: 10,
                formDropdownLoading: true,
                selectedModel: null,
                parentData : {},
                industryTypes: []
            }
        },
        created() {
            this.loadMetaData()

            this.getBusinessCategories(true)

            this.$EventDispatcher.listen('IMPORT_DONE', data => {
                this.getBusinessCategories(true);
                this.$notify({
                    title: this.__("Success"),
                    message: this.__("Successfully imported categories from excel file."),
                    type: "success"
                });
            })

            // this.$EventDispatcher.listen('BUSINESS_CATEGORY_NEW_ITEM_CREATED', data => {
            //     this.categoriesData.unshift(data)
            // })

            // this.$EventDispatcher.listen('BUSINESS_CATEGORY_ITEM_UPDATED', data => {
            //     let index = this.categoriesData.findIndex(cat => cat.id == data.id)

            //     if (index > -1) {
            //         this.categoriesData.splice(index, 1, data)
            //     }
            // })

            this.$EventDispatcher.listen('BUSINESS_CATEGORY_ADD', data => {
                //this.selectedModel = cloneDeep(businessCategory)
                this.parentData = data.data
                this.showBusinessCategoryForm = true
            })

            this.$EventDispatcher.listen('BUSINESS_CATEGORY_UPDATE', data => {
                this.selectedModel = cloneDeep(data.data)
                this.populateDefault(cloneDeep(data.data.translations))
                this.showBusinessCategoryForm = true
            })

            this.$EventDispatcher.listen('BUSINESS_CATEGORY_DELETE', data => {
                //console.log('BUSINESS_CATEGORY_DELETE')
                //this.selectedModel = cloneDeep(businessCategory)
                this.deleteCategory(data.data.id)
            })
        },
        methods: {
            loadMetaData() {
                let toLoad = [
                    'industry_type'
                ]

                this.$API.Utils.getMetaData(toLoad)
                .then(res => {
                    this.industryTypes = res.data.industry_type
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {})
            },
            openCategoryImportModal(){
                this.$EventDispatcher.fire('SHOW_IMPORT_DIALOG');
                this.populateDefault()
            },
            handleClose() {
                this.showBusinessCategoryForm = false
                this.selectedModel = null
            },
            getBusinessSearch(){
                this.getBusinessCategories()
            },
            getBusinessCategories(firstLoad = false) {
                this.loading = true;

                let params = {

                };
                if(this.search){
                    params.keyword = this.search
                    params.type = 'all'
                }

                this.$API.BusinessCategory.getCategoryList(params)
                .then(res => {
                    this.categoriesData = res.data.categories
                    //console.log(this.categoriesData, firstLoad);
                    if(firstLoad){
                        this.masterCategories = res.data.categories
                    }
                })
                .catch(_ => {})
                .finally(_ => {
                    this.loading = false
                })
            },
            updateBusinessCategory(businessCategory) {
                this.selectedModel = cloneDeep(businessCategory)
                this.populateDefault();
                this.showBusinessCategoryForm = true
            },
            deleteCategory(id) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    confirmButtonClass: "el-button--danger",
                    type: 'warning'
                })
                .then(() => {
                    this.loading = true;

                    this.$API.BusinessCategory.destroyCategory(id)
                    .then(res => {
                        if (res.data.success) {
                            this.$notify({
                                title: "Success",
                                message: this.$msg.notif.success_delete,
                                type: "success"
                            })

                            this.$EventDispatcher.fire('BUSINESS_CATEGORY_ITEM_DELETED', id);
                            return
                        }
                        else if(res.data.error && res.data.error == "has_children"){
                            this.$notify({
                                title: "Failed",
                                message: this.$msg.notif.failed_delete + " " + this.__("Category has sub categories."),
                                type: "error"
                            })
                            return
                        }

                        this.$notify({
                            title: "Failed",
                            message: this.$msg.notif.failed_delete,
                            type: "error"
                        })
                    })
                    .catch(err => {
                        console.log(err)

                        this.$notify({
                            title: this.__("Server Error"),
                            message: this.$msg.notif.service_error,
                            type: "error"
                        })
                    })
                    .finally(_ => {
                        this.loading = false
                    })
                })
                .catch(err => {
                    console.log("Confirm Error:", err)
                })
            },
            handleSizeChange(val) {
                this.current_size = val;
                this.current_page = 1

                this.getBusinessCategories();
            },
            handleCurrentChange(val) {
                this.current_page = val;
                this.getBusinessCategories();
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
