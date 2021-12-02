<template>
	<div class="state-list-component " v-loading="loading">
		<!-- <el-card class="box-card full-width">
			<div class="content-header">
				<div>
					<el-input
						suffix-icon="fas fa-search"
					 	class="search-box round-input"
						clearable
						@keyup.enter.native="applyFilter"
						v-model="filters.searchString"
						:placeholder="__('Type to search')">
					</el-input>
				</div>
			</div>
		</el-card> -->
        <div class="country_data">
            <el-card class="box-card full-width mt-2" style="height: 600px">
                <el-table
                    fit
                    highlight-current-row
                    height="400px"
                    :data="filteredState">
                    <el-table-column
                        type="index"
                        :label="__('No.')">
                    </el-table-column>

                    <el-table-column
                        v-for="column in columns"
                        :key="column.prop"
                        :prop="column.prop"
                        :sortable="column.sortable"
                        :show-overflow-tooltip="column.showTooltip"
                        :label="column.label">
                        <template slot-scope="scope">
                            <div v-if = "column.prop == 'name'">
                                {{ scope.row.name }}
                                <value-translator-btn @showTranslationForm="editState(scope.row)">
                                </value-translator-btn>
                            </div>
                            <div v-else>
                                {{ scope.row[column.prop] }}
                            </div>
                        </template>
                    </el-table-column>

                    <!-- <el-table-column :label="__('Action')" align="center">
                        <template slot-scope="scope">
                            <el-dropdown
                                trigger="click"
                                @command="handleAction"
                            >
                                <el-button
                                    class="text-black"
                                    type="text"
                                    icon="fas fa-ellipsis-v"
                                >
                                </el-button>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item
                                        divided
                                        :command="{
                                            action: 'update',
                                            data: scope.row,
                                            index: scope.$index
                                        }">
                                        <span class="text-blue">
                                            <i class="fas fa-edit"></i>
                                            {{ __("Update") }}
                                        </span>
                                    </el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                        </template>
                    </el-table-column> -->
                </el-table>

                <div class="text-right mb-3">
                    <global-pagination
                        :current_page="filters.page"
                        :current_size="filters.size"
                        :pagination="filters"
                        @handleSizeChange="handleSize"
                        @handleCurrentChange="handlePage">
                    </global-pagination>
                </div>
            </el-card>
        </div>

        <!-- EL DIALOG FOR CREATE -->
        <!-- <el-dialog
            :title="__('Edit State')"
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="industry-type-dialog"
            :close-on-click-modal="false"
            :append-to-body = "true">
            <el-form
                ref="modelForm"
                :model="modelForm" >
                <el-form-item :label="__('Name')" prop="name">
                    <el-input
                    	:disabled = "true"
                        v-model="modelForm.name"
                        :placeholder="__('Name')">
                    </el-input>
                    <value-translator-btn
                        @showTranslationForm="setTranslationForm('name', modelForm.name, 'text')">
                    </value-translator-btn>
                </el-form-item>
                <el-form-item :label="__('Code')" prop="code">
                    <el-input
                    	:disabled = "true"
                        v-model="modelForm.country_code"
                        :placeholder="__('Code')">
                    </el-input>
                </el-form-item>
            </el-form>
            <span slot="footer">
                <button
                    type="button"
                    class="btn btn-default"
                    @click="closeFormDialog">
                    {{ __("Cancel") }}
                </button>
                <button
                    type="button"
                    class="btn btn-primary btn-black"
                    @click="updateState()">
                    {{ __('Save') }}
                </button>
            </span>
        </el-dialog> -->
        <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="updateState"
        >
        </value-translator-form>

	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'
	import translationForm from "../../../mixins/translationForm.js";

	export default {
        props: {
            states : {
                required: false,
                default: []
            },
        },
		name: 'CountryList',
		mixins: [pagination, translationForm],
		data() {
			let columns = [
				{label: this.__('Code'), prop: 'code', showTooltip: true, sortable: true},
				{label: this.__('Name'), prop: 'name', showTooltip: true, sortable: true},
			]
			return {
				filters: {
					searchString: null
				},
				columns: columns,
				countries: [],
				loading: false,
                tableHeight: 250,
                modelForm: {
	                name: null,
	                description: null
	            },
	            formDialogVisible: false,
                filteredState : this.states
			}
		},
		created() {
			this.formFields = ["name"];
        	this.fromTable = "state";
		},
		methods: {
			applyFilter() {
				this.filters.page = 1

				this.fetch()
			},
			handleAction(info) {
	            if (info.action === "update") {
	                this.editState(info.data);
	            }
	        },
			editState(data){
				this.modelForm = cloneDeep(data);
				//this.formDialogVisible = true;

            	this.populateDefault(cloneDeep(this.modelForm.translations));
                this.setTranslationForm('name', data.name, 'text')
			},
			closeFormDialog() {
	            this.formDialogVisible = false;
	            //this.resetFields();
	        },
	        updateState(data) {
	            this.loading = true;
	            this.formDialogVisible = false;
                this.setTranslationData(data)

	            let postData = cloneDeep(this.modelForm);
	            this.setCurrrentLangDefaultValue(postData);

	            this.$API.State.update(postData)
                .then(result => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });

                    //splice
                    let cnt = result.data
                    let fndInd = this.filteredState.findIndex(fn => fn.id == cnt.id)
                    if(fndInd >= 0){
                    	this.filteredState.splice(fndInd, 1, cnt)
                    }
                })
                .catch(err => {
                    console.log("Err: ", err);
                    this.formDialogVisible = true;
                })
                .finally(_ => {
                    this.loading = false;
                });
	        },
		},
        watch:{
            states (newVal, oldVal){
                this.filteredState = newVal
            }
        }
	}
</script>

<style lang="scss">
    .country_data {
        .el-card__body {
            height: 600px;
        }
    }
</style>
