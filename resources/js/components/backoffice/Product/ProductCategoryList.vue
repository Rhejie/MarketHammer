<template>
    <div class="main-container">
            <div class="table-container">
                <div class="card borderless">
                        <div class="card-actions">
                            <div class="header-title">
                                <h5>{{ __('Product Category') }}</h5>
                            </div>
                            <div class="search-container" style="margin-right: 15px;">
                                <el-input
                                    class="input-search"
                                    v-model="search"
                                    :placeholder="__('Type to search')"
                                    @keyup.enter.native="showList">
                                    <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="add-new-button">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-black"
                                    @click="openCreateModal">
                                    <i class="fas fa-plus"></i> {{ __("Add Category") }}
                                </button>
                            </div>
                        </div>
                        <product-category-tree
                            :data-product-category="productCategoryList"
                            :filter-search="search">
                        </product-category-tree>
                        <!-- <el-table
                            class="table-category-list"
                            :data="filteredList"
                            row-key="id"
                            style="width: 100%; margin-top: 15px;"
                            v-loading="loading">
                            <el-table-column
                                prop="name"
                                label="Name">
                                <template slot-scope="scope">
                                    {{ $sf.ucwords(scope.row.name) }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="description"
                                label="Description">
                                <template slot-scope="scope">
                                    {{ scope.row.description }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                label="Action"
                                align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button
                                            class="btn btn-default"
                                            @click="editData(scope.row)">
                                            Edit
                                        </button>
                                        <button class="btn btn-default" @click="askToDelete(scope.row.id)"> Delete </button>
                                    </div>
                                </template>
                            </el-table-column>
                        </el-table>
                        <div class="text-right">
                            <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="productCategoryPagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination>
                        </div> -->
                </div>
            </div>

        <product-category-form
            :model="selectedModel"
            :parent-data="parentData"
            :product-categories="productCategoryList"
            v-if="showProductCategoryForm"
            :visible.sync="showProductCategoryForm"
            @close="handleClose">
        </product-category-form>
    </div>
</template>

<script>
    import cloneDeep from 'lodash/cloneDeep'

    export default {
        data() {
            return {
                search: null,
                productCategoryList: [],
                loading: false,
                current_page: 1,
                current_size: 10,
                formDropdownLoading: true,
                selectedModel: null,
                parentData : {},
                modelFormRules: {
                    name: [
                        { required: true, message: this.__('Please input product category name'), trigger: 'blur' }
                    ]
                },
                mode: 'create',
                showProductCategoryForm: false,
            }
        },
        created() {
            this.showList()

            this.$EventDispatcher.listen('PRODUCT_CATEGORY_ADD', data => {
                this.parentData = data.data
                this.showProductCategoryForm = true
            })

            this.$EventDispatcher.listen('PRODUCT_CATEGORY_UPDATE', data => {
                this.selectedModel = cloneDeep(data.data)
                this.showProductCategoryForm = true
            })

            this.$EventDispatcher.listen('PRODUCT_CATEGORY_DELETE', data => {
                console.log('PRODUCT_CATEGORY_DELETE')
                this.askToDelete(data.data.id)
            })

        },
        methods: {
            showList() {
                this.loading = true;
                let params = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.search
                }

                this.$API.ProductCategory.showProductCategorys(params).then(result => {
                    let res = result.data
                    this.productCategoryList = res.productCategory
                }).catch(err => {
                    console.log('Error: ', err)
                }).finally(_ => {
                    this.loading = false
                });
            },
            openCreateModal() {
                this.parentData = {};
                this.showProductCategoryForm = true;
            },
            handleClose() {
                this.showProductCategoryForm = false
                this.selectedModel = null
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
                    this.delete(id);
                }).catch(() => {

                });
            },
            delete(id) {
                this.loading = true;
                this.$API.ProductCategory.delete(id)
                .then(res => {
                    if (res.data.success) {
                            this.$notify({
                                title: this.__("Success"),
                                message: this.$msg.notif.success_delete,
                                type: "success"
                            })

                            this.$EventDispatcher.fire('PRODUCT_CATEGORY_ITEM_DELETED', id);

                            return
                        }
                        else if(res.data.error && res.data.error == "has_children"){
                            this.$notify({
                                title: this.__("Failed"),
                                message: this.$msg.notif.failed_delete + " " + this.__("Category has sub categories."),
                                type: "error"
                            })
                            return
                        }

                        this.$notify({
                            title: this.__("Failed"),
                            message: this.$msg.notif.failed_delete,
                            type: "error"
                        })
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
                return this.productCategoryList
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
