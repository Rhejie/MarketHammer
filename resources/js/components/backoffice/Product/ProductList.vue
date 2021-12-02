<template>
    <div class="main-container">
            <div class="table-container table-container-business-tab">
                <div class="card borderless">
                    <div class="card-actions">
                        <div class="header-title">
                            <h5>Product List </h5>
                        </div>
                        <div class="search-container" v-if="!isCreate">
                            <el-input
                                class="input-search"
                                v-model="search"
                                :placeholder="__('Type to search')"
                                @keyup.enter.native="showProducts"
                            >
                                <i
                                    slot="suffix"
                                    class="el-input__icon el-icon-search"
                                ></i>
                            </el-input>
                        </div>

                        <div class="secondary-action-buttons">
                            <base-filter-dropdown-box
                                v-if="!isCreate"
                            >
                                <el-form
                                    class="wit_form_default calendar_checkboxes"
                                    slot="body"
                                >
                                    <el-form-item
                                        :label="__('Master Category')"
                                    >
                                        <el-select
                                            v-model="filter.master_category_id"
                                            :placeholder="__('Select')"
                                            class="full-width"
                                            clearable
                                            filterable
                                            @chage="masterChange"
                                        >
                                            <el-option
                                                :label="__('All')"
                                                :value="null"
                                            ></el-option>
                                            <el-option
                                                v-for="cat in masterCategories"
                                                :key="cat.id"
                                                :label="cat.name"
                                                :value="cat.id"
                                            >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>

                                    <el-form-item :label="__('Main Category')">
                                        <el-select
                                            v-model="filter.main_category_id"
                                            :placeholder="__('Select')"
                                            class="full-width"
                                            clearable
                                            filterable
                                            @chage="mainChange"
                                        >
                                            <el-option
                                                label="All"
                                                :value="null"
                                            ></el-option>
                                            <el-option
                                                v-for="cat in mainCategories"
                                                :key="cat.id"
                                                :label="cat.name"
                                                :value="cat.id"
                                            >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>

                                    <el-form-item :label="__('Sub Category')">
                                        <el-select
                                            v-model="filter.sub_category_id"
                                            :placeholder="__('Select')"
                                            class="full-width"
                                            clearable
                                            filterable
                                        >
                                            <el-option
                                                :label="__('All')"
                                                :value="null"
                                            ></el-option>
                                            <el-option
                                                v-for="cat in subCategories"
                                                :key="cat.id"
                                                :label="cat.name"
                                                :value="cat.id"
                                            >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                    <div class="pull-right mg-b-10">
                                        <el-button
                                            round
                                            size="small"
                                            class="btn btn-primary btn-black"
                                            @click.prevent="applyFilter()"
                                        >
                                            {{ __("Apply") }}
                                        </el-button>
                                    </div>
                                </el-form>
                            </base-filter-dropdown-box>

                            <el-button
                                disabled
                                class="mh-btn"
                                :title="__('Import')">
                                <i class="fas fa-table"></i>
                            </el-button>
                            <el-button
                                disabled
                                class="mh-btn"
                                :title="__('Export')">
                                <i class="fas fa-file-alt"></i>
                            </el-button>
                        </div>

                        <div class="add-new-button">
                            <el-button
                                round
                                size="small"
                                class="btn btn-primary btn-black"
                                @click="openCreateProductModal"
                            >
                                <i class="fas fa-plus"></i>
                                {{ __("Add New Product") }}
                            </el-button>
                        </div>
                    </div>

                    <!-- Table -->
                    <el-table
                        class="table-list-container"
                        :data="productData"
                        style="width: 100%;"
                        v-loading="tableLoading"
                        @row-click="viewBusinessDetail"
                    >
                        <!-- <el-table-column prop="id" label="Product ID">
                        </el-table-column> -->
                        <el-table-column
                            prop="name"
                            :label="__('Product Name')"
                            :sortable="true"
                        >
                            <template slot-scope="scope">
                                    {{ scope.row.name }}
                            </template>
                        </el-table-column>
                        <el-table-column
                            prop="sub_category.name"
                            :label="__('Category')"
                            :sortable="true"
                        >
                        </el-table-column>
                        <el-table-column prop="brand_name" :label="__('Brand')" :sortable="true">
                        </el-table-column>
                        <el-table-column prop="model_no" :label="__('Model')" :sortable="true">
                        </el-table-column>
                        <el-table-column prop="origin" :label="__('Origin')" :sortable="true">
                        </el-table-column>
                        <el-table-column
                            prop="unit_measure.name"
                            :label="__('Unit')"
                            :sortable="true"
                        >
                        </el-table-column>
                        <el-table-column v-if="!business" :label="__('Actions')">
                            <template slot-scope="scope">
                                <div>
                                    <button class="btn btn-default text-red" @click.stop @click="deleteProductData(scope.row.index, scope.row.id )">
                                        <i class="fas fa-trash-alt"></i> {{ __("Delete") }}
                                    </button>
                                </div>
                            </template>
                            <!-- <template slot-scope="scope">
                                <el-dropdown
                                    trigger="click"
                                    @command="handleAction"
                                >
                                    <el-button
                                        class="text-black"
                                        type="text"
                                        icon="fas fa-ellipsis-v"
                                        @click.stop
                                    >
                                    </el-button>
                                    <el-dropdown-menu slot="dropdown">
                                        <el-dropdown-item
                                            divided
                                            :command="{
                                                action: 'delete',
                                                data: scope.row,
                                                index: scope.$index
                                            }"
                                        >
                                            <span class="text-red">
                                                <i class="fas fa-trash-alt"></i>
                                                {{ __("Delete") }}
                                            </span>
                                        </el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </template> -->
                        </el-table-column>
                    </el-table>

                    <div class="text-right" v-if="!isCreate">
                        <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="productPagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"
                        >
                        </global-pagination>
                    </div>
                </div>
            </div>

    </div>
</template>
<script>
import cloneDeep from "lodash/cloneDeep";

export default {
    props: {
        isCreate: {
            type: Boolean,
            default: false
        },
        pageData: {
            type: Object,
            required: true
        },
        business: {}
    },
    data: function() {
        return {
            productData: [],
            productPagination: {},
            search: "",
            current_page: 1,
            current_size: 25,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: "create",
            productForm: {
                name: null,
                product_type_id: null,
                description: null
            },
            productFormRules: {
                name: [
                    {
                        required: true,
                        message: this.__("Please input product name"),
                        trigger: "blur"
                    }
                ]
            },
            selectedModel: null,
            parentData: null,
            filter: {
                unit_of_measure_id: null,
                master_category_id: null,
                main_category_id: null,
                sub_category_id: null
            },
            categories: this.pageData.categories
                ? this.pageData.categories
                : [],
            measurements: this.pageData.measurements
                ? this.pageData.measurements
                : [],
            formTitle: this.__("Add New Product")
        };
    },
    created() {
        if (!this.isCreate) {
            this.showProducts();
        }

        this.$EventDispatcher.listen('PRODUCT_NEW_ITEM_CREATED', data => {
            console.log(data.data);
            console.log('hahaha');
            this.productData.unshift(data.data);
        })

        this.$EventDispatcher.listen("PRODUCT_ITEM_UPDATE", data => {
            let dataP = data.data;
            let index = this.productData.findIndex(fn => {
                return fn.id == dataP.id;
            });

            if (index >= 0) {
                this.productData.splice(index, 1, dataP);
            }
        });

        // this.$EventDispatcher.listen("PRODUCT_GET_LIST", data => {
        //     console.log('PRODUCT_GET_LIST')
        //     this.showProducts();
        // });

        this.$EventDispatcher.listen("ADD_NEW_PRODUCT_FROM_CREATE", data => {
            data.sub_category = this.pageData.categories.find(
                cat => cat.id == data.sub_category_id
            );
            data.unit_measure = this.pageData.measurements.find(
                m => m.id == data.unit_of_measure_id
            );
            this.productData.push(data);
        });
    },
    methods: {
        deleteProductData(index, id) {
            this.isCreate ? this.deleteLocalProduct(index) : this.askToDeleteProduct(id, index)
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.isCreate
                    ? this.deleteLocalProduct(info.index)
                    : this.askToDeleteProduct(info.data.id);
            } else if (info.action === "update") {
                this.editData(info.data);
            } else if (info.action === "view") {
                this.viewBusinessDetail(info.data);
            }
        },
        viewBusinessDetail(product) {
            window.history.replaceState(
                "",
                `Market Happer | Product`,
                `#${product.id}`
            );
            let paramData = { productList: this.productData, product: product };
            this.$EventDispatcher.fire(
                "PRODUCT_MODULE_VIEW_DETAILS",
                paramData
            );
        },
        masterChange(val) {
            this.filter.main_category_id = null;
            this.filter.sub_category_id = null;
        },
        mainChange(val) {
            this.filter.sub_category_id = null;
        },
        handleClose() {
            this.formDialogVisible = false;
            this.selectedModel = null;
        },
        showProducts() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
                master_category_id: this.filter.master_category_id
                    ? this.filter.master_category_id
                    : null,
                main_category_id: this.filter.main_category_id
                    ? this.filter.main_category_id
                    : null,
                sub_category_id: this.filter.sub_category_id
                    ? this.filter.sub_category_id
                    : null,
                unit_of_measure_id: null,
                business_id:
                    this.business && this.business.id ? this.business.id : null
            };
            this.$API.Product.productList(params)
                .then(res => {
                    this.productData = res.data.product.data;
                    this.productPagination = res.data.product;
                })
                .catch(_ => {})
                .finally(_ => {
                    this.tableLoading = false;
                });
        },
        openCreateProductModal() {
            this.mode = "create";
            this.selectedModel = null;
            this.formDialogVisible = true;
            this.$EventDispatcher.fire("PRODUCT_SHOW_ADD_FORM");
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showProducts();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showProducts();
        },
        editProduct(data) {
            this.selectedModel = cloneDeep(data);
            this.mode = "edit";
            this.formDialogVisible = true;
        },
        askToDeleteProduct(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                confirmButtonClass: "el-button--danger",
                type: "warning"
            })
                .then(() => {
                    this.deleteProduct(id, index);
                })
                .catch(() => {});
        },
        deleteProduct(id, index) {
            console.log(id);
            this.$API.BusinessProduct.destroy(id)
                .then(res => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    this.productData.splice(index, 1);
                })
                .catch(_ => {});
        },
        applyFilter() {
            this.showProducts();
        },
        closeFormDialog() {
            setTimeout(_ => {
                //this.$refs.categoryForm.clearValidate()
                this.closeModal();
            }, 200);
        },
        deleteLocalProduct(index) {
            this.$confirm(
                this.$msg.notif.confirm_delete,
                this.__("Confirmation"),
                {
                    confirmButtonText: this.__("Delete"),
                    cancelButtonText: this.__("Cancel"),
                    type: "warning",
                    confirmButtonClass: "el-button--danger"
                }
            )
                .then(() => {
                    this.productData.splice(index, 1);
                })
                .catch(() => {});
        }
    },
    computed: {
        masterCategories: function() {
            return this.categories.filter(
                cat => cat.master_product_category_id == null
            );
        },
        mainCategories: function() {
            if (this.filter.master_category_id) {
                return this.categories.filter(
                    cat =>
                        cat.master_product_category_id ==
                            this.filter.master_category_id &&
                        cat.main_product_category_id == null
                );
            }
            return [];
        },
        subCategories: function() {
            if (this.filter.main_category_id) {
                return this.categories.filter(
                    cat =>
                        cat.main_product_category_id ==
                        this.filter.main_category_id
                );
            }
            return [];
        }
    },
    watch: {
        "business.id"() {
            this.showProducts();
        }
    }
};
</script>
