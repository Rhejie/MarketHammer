<template>
    <div class="main-container">
            <div class="table-container">
                <div class="card borderless">
                        <div class="card-actions">
                            <div class="search-container">
                                <el-input
                                class="input-search"
                                v-model="search"
                                :placeholder="__('Type to search')"
                                @keyup.enter.native="showKeywords">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="action-button-container text-center" style="margin-top: 3px !important;">
                            </div>
                            <div class="add-btn-container">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-black"
                                    @click="openCreateKeywordModal">
                                    <i class="fas fa-plus"></i> {{ __('Add Keyword') }}
                                </button>
                            </div>
                        </div>
                        <!-- Table -->
                        <el-table
                        class="table-list-container"
                        :data="keywordDataTable"
                        style="width: 100%; margin-top: 15px;"
                        v-loading="tableLoading">
                            <!-- <el-table-column prop="id" label="Keyword ID">
                            </el-table-column> -->
                            <el-table-column prop="name" :label="__('Keyword Name')">
                            </el-table-column>
                            <el-table-column prop="color" :label="__('Color')">
                            </el-table-column>
                            <el-table-column prop="translator.lang_en" :label="__('English')">
                            </el-table-column>
                            <el-table-column prop="translator.lang_ko" :label="__('Korean')">
                            </el-table-column>
                            <el-table-column prop="translator.lang_jap" :label="__('Japanese')">
                            </el-table-column>
                            <el-table-column :label="__('Action') " align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button class="btn btn-default" @click="editKeyword(scope.row)"> {{ __("Edit") }} </button>
                                        <button class="btn btn-default" @click="askToDeleteKeyword(scope.row.id, scope.$index)"> {{ __("Delete") }} </button>
                                    </div>
                                </template>
                            </el-table-column>
                        </el-table>
                        <div class="text-right">
                            <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="keywordPagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination>
                        </div>
                </div>
            </div>

        <!-- EL DIALOG FOR CREATE -->
        <product-keyword-form
            :model="selectedModel"
            :parent-data="product"
            v-if="formDialogVisible"
            :visible.sync="formDialogVisible"
            @close="handleClose">
        </product-keyword-form>
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
        },
        product: {}
    },
    data: function() {
        return {
            keywordData: [],
            keywordPagination: {},
            search: '',
            current_page: 1,
            current_size: 10,
            tableLoading: false,
            // Form Dialog
            formDialogVisible: false,
            mode: 'create',
            keywordForm: {
                name: null,
                product_id: null,
                color: null
            },
            keywordFormRules: {
                name: [
                    { required: true, message: this.__('Please input keyword'), trigger: 'blur' }
                ]
            },
            selectedModel : null,
            parentData : null,
            formDialogVisible : false,
        }
    },
    created() {
        this.showKeywords()

        this.$EventDispatcher.listen('KEYWORD_NEW_ITEM_CREATED', data => {
            console.log(data);
            // this.showKeywords();
            this.keywordDataTable.unshift(data)
        })

        this.$EventDispatcher.listen('KEYWORD_ITEM_UPDATED', data => {
            // let getKeyword = this.keywordData.findIndex(fn => { return fn.id == data.id})
            // if(getKeyword >= 0){
            //     this.keywordData.splice(getKeyword, 1, data);
            // }
            console.log(data);
            this.keywordDataTable.map(k => {
                if(k.id === data.id) {
                    for(let key in data) {
                        k[key] = data[key];
                    }
                }
            })
        })
    },
    computed: {
        keywordDataTable(){
            let list = cloneDeep(this.keywordData)
            _forEach(list, lt => {
                lt.translator = lt.translations.length > 0 ? lt.translations[0] : null
            })

            return list
        }
    },
    methods: {
        handleClose() {
            this.formDialogVisible = false
            this.selectedModel = null
        },
        showKeywords() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
                product_id: this.product ? this.product.id : null,
            };

            this.$API.ProductKeyword.getKeywordList(params).then(res => {
                this.keywordData = res.data.product_keyword.data;
                this.keywordPagination = res.data.product_keyword;

            }).catch(_ => {

            }).finally(_ => {
                this.tableLoading = false;
            });;
        },
        openCreateKeywordModal() {
            this.mode = 'create';
            this.selectedModel = null;
            this.formDialogVisible = true;
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showKeywords();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showKeywords();
        },
        editKeyword(data) {
            this.selectedModel = cloneDeep(data)
            this.mode = 'edit';
            this.formDialogVisible = true;
        },
        askToDeleteKeyword(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                confirmButtonText: this.__('OK'),
                cancelButtonText: this.__('Cancel'),
                type: 'warning'
            }).then(() => {
                this.deleteKeyword(id, index);
            }).catch(() => {

            });
        },
        deleteKeyword(id, index) {
            this.$API.ProductKeyword.destroy(id).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_delete,
                    type: "success"
                });

                // this.showKeywords();
                this.keywordDataTable.splice(index, 1);
            }).catch(_ => {

            });
        }
    },
    watch: {
        'product.id'() {
            this.showKeywords()
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
