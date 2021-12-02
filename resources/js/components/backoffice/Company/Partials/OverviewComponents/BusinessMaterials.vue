<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                    <div class="card-actions">
                        <div class="header-title">
                        </div>
                        <div class="search-container">
                            <el-input
                                hidden
                                disabled
                                :title="__('No function yet')"
                                class="input-search"
                                placeholder="Type to search"
                                @keyup.enter.native="applyFilter"
                                v-model="search"
                            >
                                <i
                                    hidden
                                    slot="suffix"
                                    class="el-input__icon el-icon-search"
                                ></i>
                            </el-input>
                        </div>
                        <div class="secondary-action-buttons">
                            <el-button
                                hidden
                                disabled
                                class="mh-btn"
                                slot="reference"
                                :title="__('Filter')"
                                icon="fas fa-filter"
                            >
                            </el-button>

                            <el-button 
                            disabled
                            class="mh-btn">
                                <i class="fas fa-table"></i>
                            </el-button>
                            <el-button 
                            disabled
                            class="mh-btn">
                                <i class="fas fa-file-alt"></i>
                            </el-button>
                        </div>
                        <div class="add-new-button">
                            <el-button
                                round
                                size="small"
                                class="btn btn-primary btn-black ml-auto"
                                @click="AdddialogVisible = true"
                                :disabled="!business"
                            >
                                <i class="fas fa-plus"></i> {{ __("Add New Material") }}
                            </el-button>
                        </div>
                    </div>

                <el-table 
                class="table-list-container"
                v-loading="tableLoading" 
                fit 
                :data="materials">
                    <el-table-column type="index" :label="__('No.')">
                    </el-table-column>
                    <el-table-column :label="__('Material')">
                        <template slot-scope="scope">
                            <div>
                                {{ scope.row.material.name }}
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column :label="__('Material Type')">
                        <template slot-scope="scope">
                            <div>
                                {{ scope.row.material.material_type.name }}
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column
                        v-for="column in columns"
                        :key="column.prop"
                        :label="column.label"
                        :show-overflow-tooltip="column.showTooltip"
                        :sortable="column.sortable"
                        :prop="column.prop"
                    >
                        <template slot-scope="scope">
                            <template v-if="column.prop === 'created_at'">
                                {{
                                    $df.formatDate(
                                        scope.row.created_at,
                                        "YYYY-MM-DD"
                                    )
                                }}
                            </template>

                            <template v-else>
                                {{ scope.row[column.prop] }}
                            </template>
                        </template>
                    </el-table-column>

                    <!--el-table-column :label="__('Action')" align="center">
                        <template slot-scope="scope">
                            <div>
                                <button
                                    class="btn btn-default"
                                    @click="editMaterial(scope.row)"
                                >
                                    {{ __("Edit") }}
                                </button>
                                <button
                                    class="btn btn-default"
                                    @click="
                                        askToDeleteBusinessMaterial(
                                            scope.row.id,
                                            scope.$index
                                        )
                                    "
                                >
                                    {{ __("Delete") }}
                                </button>
                            </div>
                        </template>
                    </el-table-column-->

                    <el-table-column :label="__('Actions')" align="center">
							<template slot-scope="scope">
								<el-dropdown
									trigger="click"
									@command="handleAction">
									<el-button
										class="text-black"
										type="text"
										icon="fas fa-ellipsis-v">
									</el-button>
									<el-dropdown-menu slot="dropdown">
										<el-dropdown-item :command="{action: 'update', data: scope.row}">
											<span class="text-blue">
												<i class="fas fa-edit"></i> {{ __('Update') }}
											</span>
										</el-dropdown-item>
										<el-dropdown-item divided :command="{action: 'delete', data: scope.row.id, index: scope.$index}">
											<span class="text-red">
												<i class="fas fa-trash-alt"></i> {{ __('Delete') }}
											</span>
										</el-dropdown-item>
									</el-dropdown-menu>
								</el-dropdown>
							</template>
						</el-table-column>
                </el-table>
                <div class="text-right mb-3">
                    <global-pagination
                        :current_page="current_page"
                        :current_size="current_size"
                        :pagination="businessMaterialPagination"
                        :total="filters.total"
                        @handleSizeChange="handleSizeChange"
                        @handleCurrentChange="handleCurrentChange"
                    >
                    </global-pagination>
                </div>
            </div>
        </div>

        <el-dialog
            :title="__('Add New Material')"
            :visible.sync="AdddialogVisible"
            width="45%"
        >
            <addNewMaterial
                @dialogVisble="dialog"
                @addNewFormData="addNewBusinessMaterialData"
                :business="business"
            ></addNewMaterial>
        </el-dialog>

        <el-dialog
            :title="__('Update New Material')"
            :visible.sync="editdialogVisible"
            width="45%"
        >
            <editBusinessMaterial
                :editMaterialFormData="editMaterialdata"
                @dialogVisble="dialog"
                @editBusinessMaterialData="editedBusinessMaterialData"
            ></editBusinessMaterial>
        </el-dialog>
    </div>
</template>
<script>
import addNewMaterial from "./forms/AddBusinessMaterial";
import pagination from "../../../../../mixins/pagination";
import editBusinessMaterial from './forms/EditBusinessMaterial';
export default {
    name: "BusinessMaterials",
    components: {
        addNewMaterial,
        editBusinessMaterial
    },
    mixins: [pagination],
    props: {
        pageData: {
            type: Object,
            required: true,
        },
        business: {},
    },
    data() {
        return {
            materials: [],
            businessMaterialPagination: [],
            AdddialogVisible: false,
            tableLoading: false,
            editdialogVisible: false,
            editMaterialdata: [],
            search: "",
            current_page: 1,
            current_size: 10,
            filters: {
                search: null,
            },
            current_total: 0,
            columns: [
                {
                    label: this.__("Date Added"),
                    prop: "created_at",
                    showTooltip: true,
                    sortable: true,
                },
            ],
        };
    },
    created() {
        this.getMaterials();
    },
    watch: {
        search(newSearch, oldSearch) {
            if(newSearch != oldSearch) {
                this.applyFilter();
                return;
            }
        },
        business(newBusiness, oldBusiness) {
            if(newBusiness != oldBusiness) {
                this.getMaterials();
                return;
            }
        }
    },
    methods: {
        applyFilter() {
            this.getComplexTypes();
        },
        getMaterials() {
            if (!this.business) return;

            // this.loading = true
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
            };
            this.$API.BusinessMaterials.getBusinessMaterials(this.business.id, params).then((res) => {
                this.businessMaterialPagination = res.data;
                this.materials = res.data.data;
                this.filters.total = res.data.total;
                this.tableLoading = false;
            });
        },
        addNewBusinessMaterialData(formdata) {
            this.AdddialogVisible = false;
            this.filters.total++
            this.materials.unshift(formdata);
        },
        dialog() {
            this.AdddialogVisible = false;
            this.editdialogVisible = false;
        },
        askToDeleteBusinessMaterial(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                confirmButtonClass: "el-button--danger",
                type: "warning",
            })
                .then(() => {
                    this.delete(id, index);
                })
                .catch(() => {});
        },
        delete(id, index) {
            this.$API.BusinessMaterials.deleteBusinessMaterial(id).then((res) => {
                this.$notify({
                    title: this.__("Successful"),
                    message: this.$msg.notif.success_delete,
                    type: "success",
                });
                this.materials.splice(index, 1);
                this.filters.total--;
            });
        },
        editMaterial(data) {
            this.editMaterialdata ={...data}
            this.editdialogVisible = true;
        },
        editedBusinessMaterialData(data) {
            this.materials.map((material) => {
                if (material.id == data.id) {
                    for (let key in data) {
                        material[key] = data[key];
                    }
                }
            });
            this.editdialogVisible = false;
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.getMaterials();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.getMaterials();
        },
        handleAction(info) {
            if (info.action === 'delete') {
                this.askToDeleteBusinessMaterial(info.data, info.index)
            }
            else if (info.action === 'update') {
                this.editMaterial(info.data)
            }
        }
    },
};
</script>
