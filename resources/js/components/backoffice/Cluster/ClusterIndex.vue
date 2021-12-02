<template>
    <div class="cluster-list container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card borderless">
                    <div class="card-header">
                        <div class="card-title"> Cluster List </div>
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <div class="search-container">
                                <el-input
                                class="input-search"
                                v-model="search"
                                placeholder="Type to search"
                                @keyup.enter.native="showClusters">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="add-btn-container">
                                <button type="button" class="btn btn-primary btn-red" @click="openCreateClusterModal">Add Cluster</button>
                            </div>
                        </div>
                        <!-- Table -->
                        <el-table
                        class="table-cluster-list"
                        :data="clustersData"
                        style="width: 100%; margin-top: 15px;"
                        v-loading="tableLoading">
                            <el-table-column prop="code" label="Cluster Code">
                            </el-table-column>
                            <el-table-column prop="name" label="Cluster Name">
                            </el-table-column>
                            <el-table-column label="Theme">
                                <template slot-scope="scope">
                                    <span v-if="scope.row.theme"> {{ scope.row.theme.color }} </span>
                                </template>
                            </el-table-column>
                            <el-table-column label="Country">
                                <template slot-scope="scope">
                                    <span v-if="scope.row.country"> {{ scope.row.country.name }} </span>
                                </template>
                            </el-table-column>
                            <el-table-column label="Action" align="center">
                                <template slot-scope="scope">
                                    <div>
                                        <button class="btn btn-default" @click="editCluster(scope.row.id)"> Edit </button>
                                        <button class="btn btn-default btn-red" @click="askToDeleteCluster(scope.row.id)"> Delete </button>
                                    </div>
                                </template>
                            </el-table-column>
                        </el-table>
                        <div class="text-right">
                            <global-pagination
                            :current_page="current_page"
                            :current_size="current_size"
                            :pagination="clusterPagination"
                            @handleSizeChange="handleSizeChange"
                            @handleCurrentChange="handleCurrentChange"></global-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- EL DIALOG FOR CREATE -->
        <el-dialog
        :title="mode == 'create' ? 'New Cluster' : 'Edit Cluster'"
        :visible.sync="formDialogVisible"
        width="45%"
        class="cluster-dialog"
        :close-on-press-escape="false"
        :before-close="closeFormDialog" 
        :close-on-click-modal="false">
            <el-tabs type="card" @tab-click="handleTabClick" class="cluster-card" v-model="activeTab">
                <el-tab-pane label="Basic Info" name="basicInfo">
                    <el-form ref="clusterForm" :model="clusterForm" :rules="clusterFormRules" class="cluster-form">
                        <el-form-item label="Cluster Code" prop="code">
                            <el-input v-model="clusterForm.code" placeholder="Cluster Code"></el-input>
                        </el-form-item>
                        <el-form-item label="Cluster Name" prop="name">
                            <el-input v-model="clusterForm.name" placeholder="Cluster Name"></el-input>
                        </el-form-item>
                        <el-form-item label="Themes">
                            <el-select 
                            v-model="clusterForm.themeColor"
                            placeholder="Select a theme" 
                            class="cluster-dropdown"
                            filterable
                            remote
                            :remote-method="searchTheme"
                            :loading="formDropdownLoading"
                            @focus="searchTheme('')"
                            @change="changeSelectedTheme">
                                <el-option
                                v-for="theme in themesData"
                                :key="theme.id"
                                :label="theme.color"
                                :value="theme.color"></el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Country" prop="countryName">
                            <el-select 
                            v-model="clusterForm.countryName"
                            placeholder="Select a country" 
                            class="cluster-dropdown"
                            filterable
                            remote
                            :remote-method="searchCountries"
                            :loading="formDropdownLoading"
                            @focus="searchCountries('')"
                            @change="changeSelectedCountry">
                                <el-option
                                v-for="country in countriesData"
                                :key="country.id"
                                :label="country.name"
                                :value="country.name"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-form>
                </el-tab-pane>
                <el-tab-pane label="Categories" name="categories">
                <!-- <el-tab-pane label="Categories" name="categories" v-if="mode == 'edit'"> -->
                    <!-- <label for=""> {{ 'Cluster Categories' }} </label> -->      
                        <!-- <div class="search-container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <el-input
                                        size="mini"
                                        placeholder="Type to search"
                                        style="width:75%;"
                                        @keyup.enter.native="filterCategory"
                                        v-model="filterCategoryQuery">
                                        <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                    </el-input>
                                    <el-button size="mini" type="danger" class="pull-right" @click="categoryDialogVisible = true">Add Category</el-button>
                                </div>
                            </div>
                            
                        </div>           
                        <el-table
                            class="table-category-list"
                            :data="filteredCategories"
                            row-key="id"
                            size="mini"
                            :show-header="showHeader"
                            style="width: 100%; margin-top: 15px;"
                            v-loading="categoryLoading">
                            <el-table-column prop="name" label="Category Name">
                            </el-table-column>
                        </el-table> -->
                        <div class="search-container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <el-checkbox v-model="showCheckedOnly" @change="handleShowCheckedOnly">Show checked only</el-checkbox>
                                </div>
                                <div class="col-sm-6">
                                    <el-input
                                        size="mini"
                                        class="pull-right"
                                        placeholder="Type to search"
                                        v-model="filterCategoryQuery">
                                        <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                    </el-input>
                                </div>
                            </div>
                            
                        </div>           
                        <el-tree
                          class="filter-tree"
                          :data="filteredAllCategories"
                          :props="defaultProps"
                          default-expand-all
                          :default-checked-keys="selectedCategoryIds"
                          show-checkbox
                          :check-strictly="strict"
                          node-key="id"
                          :filter-node-method="filterNode"
                          v-loading="categoryLoading"
                          @check="handleCategoryChange"
                          ref="tree">
                        </el-tree>
                </el-tab-pane>
            </el-tabs>
            
            <span slot="footer">
                <button type="button" class="btn btn-default" @click="closeFormDialog">Cancel</button>
                <button type="button" class="btn btn-primary btn-red" @click="vaidateClusterForm"> {{ mode == 'create' ? 'Save' : 'Update' }} </button>
            </span>
        </el-dialog>

        <!-- EL DIALOG FOR CREATE -->
        <el-dialog
        title="New Category"
        :visible.sync="categoryDialogVisible"
        width="35%"
        :before-close="handleClose"
        class="create-category-dialog"
        :close-on-click-modal="false">
            <el-form ref="categoryForm" :model="categoryForm" :rules="categoryFormRules" v-loading="formDialogLoading">
                <el-form-item label="Category Name" prop="name">
                    <el-input v-model="categoryForm.name" placeholder="Category Name"></el-input>
                </el-form-item>
                <el-form-item label="Category Level" v-if="pageData">
                    <el-select 
                    v-model="categoryForm.parentLevel" 
                    placeholder="Select category level"
                    class="cluster-dropdown"
                    filterable
                    @change="changeSelectedParentLevel">
                        <el-option 
                        v-for="(level, index) in pageData.categoryLevels" 
                        :key="index"
                        :label="'Level ' + level"
                        :value="level"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Parent Category" v-if="categoryForm.isChild">
                    <el-select 
                    v-model="categoryForm.parentCategoryId" 
                    placeholder="Select parent category"
                    class="cluster-dropdown"
                    filterable
                    @change="changeSelectedParentCategory">
                        <el-option 
                        v-for="parentCategory in pageData.parentCategories" 
                        :key="parentCategory.id"
                        :label="parentCategory.name"
                        :value="parentCategory.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Image upload">
                    <el-upload
                    class="avatar-uploader"
                    :action="imageRoute"
                    :show-file-list="false"
                    :on-success="handleAvatarSuccess"
                    :before-upload="beforeAvatarUpload"
                    :on-remove="removeAvatar">
                    <img v-if="categoryForm.imageUrl" :src="'../storage/' + categoryForm.imageUrl" class="avatar">
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                    <div class="text-center" v-if="categoryForm.imageUrl">
                        <button type="button" class="btn btn-default" @click="removeAvatar"> {{ 'Remove Image' }} </button>
                    </div>
                </el-form-item>
            </el-form>
            <span slot="footer">
                <button type="button" class="btn btn-default" @click="closeCategoryFormDialog">Cancel</button>
                <button type="button" class="btn btn-primary btn-red" @click="validateCategoryForm"> {{ 'Save' }} </button>
            </span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    props: {
        clusters: {
            type: Object,
            required: true
        },
        imageRoute: {
            required: false,
        },
    },
    data: function() {
        return {
            defaultProps: {
              children: 'children',
              label: 'name'
            },
            filterType: 'search',
            showCheckedOnly: false,
            strict: true,
            showHeader: false,
            categoryLoading: false,
            categoryDialogVisible: false,
            formDialogLoading: false,
            pageData: null,
            clustersData: this.clusters.data,
            clusterPagination: this.clusters,
            current_page: 1,
            current_size: 10,
            tableLoading: false,
            search: '',
            filterCategoryQuery: '',
            mode: 'create',

            //category modal
            categoryForm: {
                id: null,
                name: null,
                imageUrl: null,
                clusterId: null,
                // industryTypeNames: [],
                // industryTypeIds: [],
                industryTypeName: null,
                industryTypeId: null,
                parentLevel: 1,
                isChild: false,
                parentCategoryId: null
            },
            categoryFormRules: {
                name: [
                    { required: true, message: 'Please input category name', trigger: 'blur' }
                ]
            },

            // Cluster modal
            formDialogVisible: false,
            clusterForm: {
                code: null,
                name: null,
                countryId: null,
                countryName: null,
                themeColor: null,
                themeId: null,
                selectedClusterId: null,
                clusterCategoryNames: [],
                clusterCategoryIds: []
            },
            clusterFormRules: {
                code: [
                    { required: true, message: 'Please input cluster code', trigger: 'blur' }
                ],
                name: [
                    { required: true, message: 'Please input cluster name', trigger: 'blur' }
                ],
                countryName: [
                    { required: true, message: 'Please input country', trigger: 'blur' }
                ],
            },
            formDropdownLoading: false,
            themesData: [],
            categoriesData: [],
            categories: [],
            selectedCategoryIds: [],
            countriesData: [],
            activeTab: 'basicInfo',
        }
    },
    created() {
        this.getTreeCategoryData();
    },
    computed: {
        filteredCategories(){
            if (this.categoriesData != []) {
                return this.categoriesData.filter(category => category.parentCategoryID == null);
            } else {
                return [];
            }
            
        },
        filteredAllCategories(){
            if (this.categories != []) {
                return this.categories.filter(category => category.parentCategoryID == null);
            } else {
                return [];
            }
            
        },
    },
    methods: {
        handleShowCheckedOnly() {
            // console.log(this.showCheckedOnly)
            // if (this.selectedClusterId != null && this.showCheckedOnly) {
            //     this.$API.Cluster.getOnlyCheckedCategories(this.selectedClusterId).then(res => {
            //         this.categories = res.data.categories;
            //         this.categoryLoading = false;
            //     });
            // }

            if (this.showCheckedOnly) {
                this.filterType = 'checked';
                // this.categories.filter((cat) => this.$refs.tree.getCheckedKeys().includes(cat.id))
                // console.log(this.categories);
            } else {
                this.filterType = 'search';
                this.getTreeCategoryData();
            }
            
        },
        handleCategoryChange(check, node){
            this.selectedCategoryIds = node.checkedKeys
            // console.log(check)
            // console.log(node)
        },
        filterNode(value, data) {
            console.log(!value && !this.showCheckedOnly)
            if (!value && !this.showCheckedOnly) return true;

            if (this.filterType == 'search') {
                // console.log('a')
                if (this.showCheckedOnly) {
                    let arr = this.$refs.tree.getCheckedKeys().filter(x => x == data.id);

                    if (arr.length > 0) {
                        return data.name.indexOf(value) !== -1;
                    }
                } else {
                    return data.name.indexOf(value) !== -1;
                }
            } else {
                // console.log(data.id, this.$refs.tree.getCheckedKeys())
                // return data.id == this.$refs.tree.getCheckedKeys()[this.idIndex];
                // return data.filter((cat) => this.$refs.tree.getCheckedKeys().includes(cat.id))
                let arr = this.$refs.tree.getCheckedKeys().filter(x => x == data.id);

                if (arr.length > 0) {
                    return true;
                }

                
            }
            
        },
        // filterChecked(value, data) {
        //     if (!value) return true;
        //     return data.filter((cat) => this.$refs.tree.getCheckedKeys().includes(cat.id))
        //     // return data.id.indexOf(value) !== -1;
        // },
        getTreeCategoryData() {
            this.categoryLoading = true;
            let params = {
                searchQuery: this.filterCategoryQuery
            }
            this.$API.Cluster.getAllCategoriesData(params).then(res => {
                this.categories = res.data.categories;
                this.categoryLoading = false;
            });
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.showClusters();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showClusters();
        },
        closeFormDialog() {
            this.formDialogVisible = false;
            this.clearFields();
        },
        clearFields() {
            this.clusterForm = {
                code: null,
                name: null,
                themeColor: null,
                themeId: null,
                countryId: null,
                countryName: null,
                clusterCategoryNames: [],
                clusterCategoryIds: []
            };
            this.$refs['clusterForm'].resetFields();
            this.mode = 'create';
            this.$forceUpdate();
        },
        resetFields() {
            this.categoryForm = {
                id: null,
                name: null,
                imageUrl: null,
                industryTypeName: null,
                parentLevel: 1,
                isChild: false,
                clusterId: null,
                parentCategoryId: null
            };
        },
        handleTabClick(value) {

        },
        vaidateClusterForm() {
            this.$refs['clusterForm'].validate((valid) => {
                if(valid) {
                    if(this.mode == 'create') {
                        this.createCluster();
                    }else{
                        this.updateCluster();
                    } 
                }
            });
        },
        searchTheme(query) {
            this.formDropdownLoading = true;
            this.$API.Cluster.getThemesData(query).then(res => {
                this.themesData = res.data.themes.data;
                this.formDropdownLoading = false;
            });
        },
        openCreateClusterModal() {
            this.activeTab = 'basicInfo';
            this.formdata
            this.formDialogVisible = true;
            this.clusterForm.clusterCategoryIds = [];
            this.selectedCategoryIds = [];
            this.showCheckedOnly = false;
            this.filterType = 'search';
            this.getTreeCategoryData()
        },
        changeSelectedTheme(val) {
            let selectedTheme = this.themesData.find(theme => {
                if(theme.color == val) {
                    return theme;
                }
            });

            this.clusterForm.themeId = selectedTheme.id;
        },
        createCluster() {
            this.formDialogVisible = false;
            this.tableLoading = false;
            this.clusterForm.clusterCategoryIds = this.selectedCategoryIds
            this.$API.Cluster.storeCluster(this.clusterForm).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_add,
                    type: "success"
                });
                this.clearFields();
                this.showClusters();
            }).catch(err => {
                this.formDialogVisible = true;
                this.tableLoading = false;
                this.showValidationError(err);
            });
        },
        showClusters() {
            this.tableLoading = true;
            let params = {
                search: this.search,
                current_page: this.current_page,
                current_size: this.current_size
            };
            this.$API.Cluster.showClusters(params).then(res => {
                this.clustersData = res.data.clusters.data;
                this.clusterPagination = res.data.clusters;
                this.tableLoading = false;
            });
        },
        editCluster(id) {
            this.tableLoading = true;
            this.activeTab = 'basicInfo';
            this.showCheckedOnly = false;
            this.filterType = 'search';

            this.$API.Cluster.showCluster(id).then(res => {
                // this.searchCategory('');
                this.selectedCategoryIds = res.data.cluster.cluster_category_ids;

                // this.searchCategoryById(id);
                this.selectedClusterId = id;
                this.categoryForm.clusterId = id;
                this.clusterForm = {
                    id: res.data.cluster.id,
                    code: res.data.cluster.code,
                    name: res.data.cluster.name,
                    themeColor: res.data.cluster.theme ? res.data.cluster.theme.color : null,
                    themeId: res.data.cluster.theme ? res.data.cluster.theme.id : null,
                    countryName: res.data.cluster.country ? res.data.cluster.country.name : null,
                    countryId: res.data.cluster.country ? res.data.cluster.country.id : null,
                    clusterCategoryNames: res.data.cluster.cluster_category_names,
                    clusterCategoryIds: this.selectedCategoryIds
                };

                // let ids = data.categories.map((item) => item.id);
                

                this.tableLoading = false;
                this.mode = 'edit';
                this.formDialogVisible = true;
            }).catch(_ => {
                
            });
        },
        updateCluster() {
            this.categoryLoading = true;
            this.clusterForm.clusterCategoryIds = this.selectedCategoryIds
            this.$API.Cluster.updateCluster(this.clusterForm.id, this.clusterForm).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_update,
                    type: "success"
                });
                this.showClusters();
                this.categoryLoading = false;
            }).catch(err => {
                this.formDialogVisible = true;
                this.categoryLoading = false;
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
        searchCategoryById(id) {
            this.categoryLoading = true;
            this.$API.Cluster.getCategoriesDataById(id).then(res => {
                this.categoriesData = res.data.categories;
                this.categoryLoading = false;
            });
        },
        searchCategory(searchQuery, id) {
            let params = {
                id: id,
                searchQuery: searchQuery
            }
            this.categoryLoading = true;
            this.$API.Cluster.getCategoriesData(params).then(res => {
                this.categoriesData = res.data.categories;
                this.categoryLoading = false;
            });
        },
        openCreateCategoryDialog() {
            this.mode = 'create';
            this.tableLoading = true;
            this.selectedClusterId = null;
            this.getPageData(this.categoryForm.parentLevel).then(res => {
                this.categoryDialogVisible = true;
            });
        },
        filterCategory(){
            // console.log(this.filterCategoryQuery, this.clusterForm.d)
            this.searchCategory(this.filterCategoryQuery, this.selectedClusterId)
            // console.log();
        },
        changeSelectedCategories(val) {
            let categories = val;
            this.clusterForm.clusterCategoryIds = [];
            categories.forEach(category => {
                let tempCategory = this.categoriesData.find(data => {
                    if(category == data.name) {
                        return data;
                    }
                });
                if(tempCategory) {
                    this.clusterForm.clusterCategoryIds.push(tempCategory.id);
                }
            });
        },
        askToDeleteCluster(id) {
            this.$confirm(this.$msg.notif.confirm_delete, 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(() => {
                this.deleteCluster(id);
            }).catch(() => {
                    
            });
        },
        deleteCluster(id) {
            this.tableLoading = true;
            this.$API.Cluster.destroyCluster(id).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_delete,
                    type: "success"
                });
                this.showClusters();
            }).catch(_ => {
                
            });
        },
        searchCountries(val) {
            this.formDropdownLoading = true;
            this.$API.Cluster.getCountriesData(val).then(res => {
                this.countriesData = res.data.countries.data;
                this.formDropdownLoading = false;
            }).catch(_ => {

            });
        },
        changeSelectedCountry(val) {
            let selectedCountry = this.countriesData.find(country => {
                if(country.name == val) {
                    return country;
                }
            });

            this.clusterForm.countryId = selectedCountry.id;
        },
        validateCategoryForm() {
            this.$refs['categoryForm'].validate((valid) => {
                if(valid) {
                        this.createCategory();
                }
            });
        },
        createCategory() {
            
            // this.tableLoading = true;
            this.$API.Category.storeCategory(this.categoryForm).then(res => {
                this.$notify({
                    title: "Success",
                    message: this.$msg.notif.success_add,
                    type: "success"
                });
                this.resetFields();
                this.searchCategoryById(this.selectedClusterId);
                this.categoryDialogVisible = false;
            }).catch(err => {
                this.showValidationError(err);
                this.tableLoading = false;
                // this.formDialogVisible = true;
            });
        },
        changeSelectedParentLevel(val) {
            if(val == 1) {
                this.categoryForm.isChild = false;
                this.categoryForm.parentCategoryId = null;
                return ;
            }
            this.formDialogLoading = true;
            this.getPageData(val).then(res => {
                this.categoryForm.isChild = true;
                this.categoryForm.parentCategoryId = null;
                this.formDialogLoading = false;
            });
        },
        changeSelectedParentCategory(val) {
            this.$set(this.categoryForm,'parentCategoryId', val);
            this.$forceUpdate();
        },
        removeAvatar(file) {
            this.categoryForm.imageUrl = null;
            this.$forceUpdate();
        },
        closeCategoryFormDialog() {
            this.categoryDialogVisible = false;
            setTimeout(() => {
                this.resetFields();
            }, 600);
        },
        handleClose() {
            this.categoryDialogVisible = false;
            this.resetFields();
        },
        handleAvatarSuccess(res, file) {
            // this.imageUrl = URL.createObjectURL(file.raw);
            this.categoryForm.imageUrl = res.filepath;
            this.$forceUpdate();
        },
        beforeAvatarUpload(file) {
            const isJPG = file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
            this.$message.error('Avatar picture must be JPG format!');
            }
            if (!isLt2M) {
            this.$message.error('Avatar picture size can not exceed 2MB!');
            }
            return isJPG && isLt2M;
        },
        removeAvatar(file) {
            this.categoryForm.imageUrl = null;
            this.$forceUpdate();
        },
    },
    watch:{
        filterCategoryQuery(val) {
            this.filterType = 'search';
            this.$refs.tree.filter(val);
        },
        showCheckedOnly(val) {
            if (val) {
                this.$refs.tree.filter(val);
            }
            
        }
    }
}
</script>
<style lang="scss">
    .cluster-list {
        .el-dialog__body {
            padding: 20px;
        }
        .el-loading-spinner .path {
            stroke: #EC3434;
        }

        .cluster-card {
            .el-tabs__item.is-active {
                color: #EC3434;
            }

            .el-tabs__item:hover {
                color: #EC3434;
            }
            
            .el-tab-pane {
                margin-top: 10px;
                padding-left: 15px;
                padding-right: 15px;
            }
            .cluster-dropdown {
                width: 100%;
            }
        }
    }
</style>