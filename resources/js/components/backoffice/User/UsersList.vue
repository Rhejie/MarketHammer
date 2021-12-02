<template>
    <div class="user-list-component">
            <div class="table-container">
                <div class="card borderless">
                    <!-- Global Header Type -->
                        <div class="card-actions">
                            <div class="header-title">
                                <h5>{{ __("Users List") }} </h5>
                            </div>
                            <div class="search-container" style="margin-right: 20px;">
                                <el-input
                                    class="input-search"
                                    v-model="filters.searchString"
                                    :placeholder="__('Press enter to search')"
                                    @keyup.enter.native="applyFilter"
                                >
                                    <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                </el-input>
                            </div>
                            <div class="add-new-button">
                                <button
                                  type="button"
                                  class="btn btn-primary btn-black"
                                  @click="openUserForm = true"
                                >
                                  <i class="el-icon-plus"></i> {{ __("Add User") }}
                                </button>
                            </div>
                        </div>
                        <el-table
                        v-loading="loading"
                        :data="userList"
                        fit
                        class="table-list-container">
                            <el-table-column
                                v-for="column in columns"
                                :key="column.key"
                                :label="__(column.label)"
                                :prop="column.key"
                                :sortable="column.sortable"
                                :show-overflow-tooltip="column.showTooltip"
                            >
                                <template slot-scope="scope">
                                  <template v-if="column.key === 'type'">
                                    {{ scope.row.user_type.name }}
                                  </template>
                                  <template v-else-if="column.key === 'displayName'">
                                    {{ $sf.ucwords(scope.row[column.key]) }}
                                  </template>
                                  <template v-else>
                                    {{ scope.row[column.key] }}
                                  </template>
                                </template>
                            </el-table-column>
                            <el-table-column :label="__('Company')" prop="user_business[0].legal_name">
                            </el-table-column>

                            <el-table-column :label="__('Actions')">
                                <template slot-scope="scope">
                                    <el-dropdown trigger="click" @command="handleAction">
                                        <el-button class="text-black" type="text" icon="fas fa-ellipsis-v">
                                        </el-button>
                                        <el-dropdown-menu slot="dropdown">
                                            <el-dropdown-item :command="{ action: 'update', data: scope.row }">
                                                <span class="btn-update">
                                                    <i class="fas fa-edit"></i> {{ __("Update") }}
                                                </span>
                                            </el-dropdown-item>
                                            <el-dropdown-item
                                                divided
                                                :command="{ action: 'delete', data: scope.row, index: scope.$index }"
                                            >
                                                <span class="btn-delete">
                                                    <i class="fas fa-trash-alt"></i> {{ __("Delete") }}
                                                </span>
                                            </el-dropdown-item>
                                        </el-dropdown-menu>
                                    </el-dropdown>
                                </template>
                            </el-table-column>
                        </el-table>

                        <global-pagination
                          :current_page="filters.page"
                          :current_size="filters.size"
                          :pagination="filters"
                          @handleSizeChange="handleSize"
                          @handleCurrentChange="handlePage"
                        >
                        </global-pagination>
                </div>
            </div>

        <user-form
          :user-types="pageData.userTypes"
          :model="selectedUser"
          v-if="openUserForm"
          :visible.sync="openUserForm"
          @update_total="updateTotal"
          @close="handleClose"
        >
        </user-form>
    </div>
</template>

<script>
import cloneDeep from "lodash/cloneDeep";
import pagination from "../../../mixins/pagination";

export default {
    name: "UsersList",
    props: {
        pageData: {
          type: Object,
          required: true,
        },
    },
    mixins: [pagination],
    data() {
        let columns = [
            { label: this.__("Full Name"), key: "displayName", sortable: true, showTooltip: true },
            { label: this.__("Email"), key: "email", sortable: true, showTooltip: true },
            { label: this.__("Phone"), key: "phone", sortable: true, showTooltip: true },
            { label: this.__("Type"), key: "type", sortable: true, showTooltip: true },
        ];

        return {
            filters: {
                searchString: null,
            },
            selectedUser: null,
            openUserForm: false,
            loading: false,
            columns: columns,
            paginationData: {},
            userList: [],
            total_num: 0,
        };
    },
    created() {
        this.functionName = "getUsers";

        this.getUsers();

        this.$EventDispatcher.listen("USER_MODULE_ITEM_CREATED", (user) => {
        this.userList.unshift(user);
        });

        this.$EventDispatcher.listen("USER_MODULE_ITEM_UPDATED", (user) => {
            let index = this.userList.findIndex((fa) => fa.id == user.id);

            if (index > -1) {
                this.userList.splice(index, 1, user);
            }
        });
    },
    watch: {
        total_num(oldNum, newNum) {
            if (oldNum != newNum) {
                return (this.filters.total = this.filters.total + 1);
            }
        },
    },
    methods: {
        applyFilter() {
            this.filters.page = 1;

            this.getUsers();
        },
        getUsers() {
            this.loading = true;
            let postData = cloneDeep(this.filters);
            this.$API.User.getUsers(postData)
            .then((res) => {
                this.userList = res.data.data;
                this.paginationData = res.data;
                this.filters.total = res.data.total;
                console.log(res.data.data);
            })
            .catch((err) => {
                console.log(err);
            })
            .finally((_) => {
                this.loading = false;
            });
        },
        updateTotal(data) {
            console.log(data);
            this.filters.total = this.filters.total + data;
            console.log(this.filters.total);
        },
        updateUser(user) {
            this.selectedUser = cloneDeep(user);
            this.openUserForm = true;
        },
        deleteUser(user, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                type: "warning",
                confirmButtonClass: "el-button--danger",
            }).then(() => {

            this.$API.User.deleteUser(user.id)
                .then((res) => {
                    if (res.data) {
                      this.userList.splice(index, 1);
                      this.$notify({
                            title: this.__("Success"),
                            message: this.$msg.notif.success_delete,
                            type: "success"
                        })
                    }
                })
                .catch((err) => {
                    this.$notify.error({
                      title: this.__("Server Error"),
                      message: this.$msg.notif.service_error,
                    });

                    console.log(err);
                })
                .finally((_) => {
                    this.loading = false;
                });
            });
        },
        handleAction(info) {
            if (info.action === "delete") {
                this.deleteUser(info.data, info.index);
            } else if (info.action === "update") {
                console.log(info.data)
                this.updateUser(info.data);
            }
        },
        handleClose() {
            this.selectedUser = null;
            this.openUserForm = false;
        },
    },
};
</script>

<style lang="scss">
.user-list-component {
}
</style>
