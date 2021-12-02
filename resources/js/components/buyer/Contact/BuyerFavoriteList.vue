<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <!-- Global Header Type -->
                <div class="card-actions">
                    <div class="search-container">
                        <el-input
                            class="input-search"
                            v-model="filters.searchString"
                            :placeholder="__('Type to search')"
                            @keyup.enter.native="showList"
                        >
                            <i
                                slot="suffix"
                                class="el-input__icon el-icon-search"
                            ></i>
                        </el-input>
                    </div>
                    <div class="secondary-action-buttons">
                        <el-button
                            disabled
                            class="mh-btn"
                            slot="reference"
                            title="Filter"
                            icon="fas fa-filter"
                        >
                        </el-button>

                        <el-button 
                        disabled
                        class="mh-btn">
                            <i class="fas fa-table"></i>
                        </el-button>
                    </div>
                </div>
                <!-- End of Global Header Type -->

                <el-table
                    class="table-list-container"
                    :data="contactList"
                    row-key="id"
                    style="width: 100%;"
                    v-loading="loading"
                >

                    <el-table-column :label="__('Business Category')" prop="business.category">
                    </el-table-column>

                    <el-table-column :label="__('Industry Type')" prop="business.industry_type">
                    </el-table-column>

                    <el-table-column :label="__('Company')" prop="business.legal_name">
                    </el-table-column>

                    <el-table-column :label="__('Website')" prop="business.website">
                    </el-table-column>   

                    <el-table-column :label="__('Country')" prop="business.country">
                    </el-table-column>

                    <el-table-column
                        :label="__('Since')"
                        prop="followed_at"
                    >
                        <template slot-scope="scope">
                            <span v-if="scope.row.status == 'accepted'">
                                {{
                                    scope.row.followed_at
                                        ? $df.formatDate(
                                              scope.row.followed_at,
                                              "MM/DD/YYYY"
                                          )
                                        : ""
                                }}
                            </span>
                        </template>
                    </el-table-column>

                    <el-table-column :label="__('Status')" prop="supplierstatus.name">
                        <!--template slot-scope="scope">
                            <span v-if = "scope.row.supplier_status_id == 0">
                                {{ scope.row.status }} 
                            </span>
                            <span v-else>
                                {{ scope.row.supplierstatus.name }} 
                            </span>
                        </template-->
                    </el-table-column>


                    <el-table-column :label="__('Actions')">
                        <template slot-scope="scope">
                            <button class="btn btn-default text-red" @click="askToDelete(scope.row.id)"> 
                            <i class="fas fa-trash-alt"></i> {{ __("Delete") }} 
                            </button>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="text-right">
                    <global-pagination
                        :current_page="current_page"
                        :current_size="current_size"
                        :pagination="contactPagination"
                        :total="filters.total"
                        @handleSizeChange="handleSizeChange"
                        @handleCurrentChange="handleCurrentChange"
                    ></global-pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import cloneDeep from "lodash/cloneDeep";

export default {
    props: {
        pageData: {
            type: Object,
            required: true
        },
        type: {
            type: String,
            default: "contact"
        }
    },
    data() {
        return {
            userData: this.pageData.userData,
            filters: {
                searchString: null,
                toFilter: null,
                daterange: null
            },
            contactList: [],
            contactPagination: {},
            loading: false,
            current_page: 1,
            current_size: 25,
            mode: null
        };
    },
    created() {
        this.fetch();
    },
    methods: {
        fetch() {
            this.loading = true;

            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.filters.searchString
            };

            this.$API.BusinessFollower.getList(params).then(response => {
                this.contactList = response.data.data;
                this.contactPagination = response.data;
                this.filters.total = response.data.total;
                this.loading = false;
            });
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.askToDelete(info.data, info.index);
            }
        },
        applyFilter() {},
        askToDelete(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                type: "warning",
                confirmButtonClass: 'el-button--danger'
            })
                .then(() => {
                    this.deleteData(id, index);
                })
                .catch(() => {});
        },
        deleteData(id, index) {
            this.loading = true;
            this.$API.BusinessFollower.destroy(id)
                .then(res => {
                    this.contactList.splice(index, 1);
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    });

                    this.showList();
                })
                .catch(_ => {})
                .finally(_ => {
                    this.loading = false;
                });
        },

        handleSizeChange(val) {
            this.current_size = val;
            this.current_page = 1;

            this.showList();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.showList();
        }
    },
};
</script>
