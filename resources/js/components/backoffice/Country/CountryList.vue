<template>
	<div class="main-container" v-loading="loading">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>{{ __('Country List') }}</h5>
                    </div>
                    <div class="search-container">
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
            <div>
                    <el-table
                        fit
                        class="table-list-container"
                        highlight-current-row
                        :data="filteredCountries"
                        @row-click="showState">

                        <el-table-column
                            v-for="column in columns"
                            :key="column.prop"
                            :prop="column.prop"
                            :sortable="column.sortable"
                            :show-overflow-tooltip="column.showTooltip"
                            :label="column.label">
                            <template slot-scope="scope">
                                <div v-if = "column.prop == 'name'">
                                    {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }} 
                                    <value-translator-btn @showTranslationForm="editCountry(scope.row)">
                                    </value-translator-btn>
                                </div>
                                <div v-else>
                                    {{ scope.row[column.prop] }}
                                </div>
                            </template>
                        </el-table-column>

                        <!--el-table-column :label="__('Action')" align="center">
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
                                        < <el-dropdown-item
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
                                        </el-dropdown-item>>
                                        <el-dropdown-item
                                            divided
                                            :command="{
                                                action: 'states',
                                                data: scope.row,
                                                index: scope.$index
                                            }">
                                            <span class="text-blue">
                                                <i class="fas fa-eye"></i>
                                                {{ __("States") }}
                                            </span>
                                        </el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </template>
                        </el-table-column-->
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
                </div>
            </div>
        </div>

        <!-- EL DIALOG FOR CREATE -->
        <!-- <el-dialog
            :title="__('Edit Country')"
            :visible.sync="formDialogVisible"
            width="45%"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            class="industry-type-dialog"
            :close-on-click-modal="false">
            <el-form
                ref="modelForm"
                :model="modelForm" >
                <el-form-item :label="__('Country Name')" prop="name">
                    <el-input
                    	:disabled = "true"
                        v-model="modelForm.name"
                        :placeholder="__('Country Name')">
                    </el-input>
                    <value-translator-btn @showTranslationForm="setTranslationForm('name', modelForm.name, 'text')">
                    </value-translator-btn>
                </el-form-item>
                <el-form-item :label="__('Country Code')" prop="country_code">
                    <el-input
                    	:disabled = "true"
                        v-model="modelForm.country_code"
                        :placeholder="__('Country Code')">
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
                    @click="updateCountry()">
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
            @settranslationdata="updateCountry"
        >
        </value-translator-form>

        <el-dialog
        	:visible.sync="showStateList"
        	@close="closeStateDialog"
        	:title="titleState"
        	width="60%"
        	top="4vh">
        	<state-list :states = "selectedStateList">
        	</state-list>

        	<span slot="footer">
                <button
                    type="button"
                    class="btn btn-default"
                    @click="closeStateDialog">
                    {{ __("Close") }}
                </button>
            </span>
        </el-dialog>

	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'
	import translationForm from "../../../mixins/translationForm.js";

	export default {
		name: 'CountryList',
		mixins: [pagination, translationForm],
		data() {
			let columns = [
				{label: this.__('Country Code'), prop: 'country_code', showTooltip: true, sortable: true},
				{label: this.__('Country Name'), prop: 'name', showTooltip: true, sortable: true},
				{label: this.__('Currency'), prop: 'currency', showTooltip: true, sortable: true}
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
	            showStateList : false,
	            titleState : "",
	            selectedStateList : []
			}
		},
		created() {
			this.formFields = ["name"];
        	this.fromTable = "country";
			// check pagination mixins
			this.functionName = 'fetch'

			this.fetch()
		},
		methods: {
			applyFilter() {
				this.filters.page = 1

				this.fetch()
			},
			fetch() {
				this.loading = true

				let postData = cloneDeep(this.filters)

				this.$API.Country.fetch(postData)
				.then(res => {
					this.countries = res.data.data
					this.filters.total = res.data.total

				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			handleAction(info) {
	            if (info.action === "update") {
	                this.editCountry(info.data);
	            }
	            else if (info.action === "states") {
	                this.showState(info.data);
	            }
	        },
			editCountry(data){
				this.modelForm = cloneDeep(data);
				//this.formDialogVisible = true;

            	this.populateDefault(cloneDeep(this.modelForm.translations));

            	this.setTranslationForm('name', data.name, 'text')
			},
			closeFormDialog() {
	            this.formDialogVisible = false;
	            //this.resetFields();
	        },
	        updateCountry(data) {
	            this.loading = true;
	            this.formDialogVisible = false;
	        	this.setTranslationData(data)


	            let postData = cloneDeep(this.modelForm);
	            this.setCurrrentLangDefaultValue(postData);

	            this.$API.Country.update(postData)
                .then(result => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.$msg.notif.success_update,
                        type: "success"
                    });

                    //splice
                    let cnt = result.data
                    let fndInd = this.countries.findIndex(fn => fn.country_code == cnt.country_code)
                    if(fndInd >= 0){
                    	this.countries.splice(fndInd, 1, cnt)
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
	        showState(country){
	        	console.log('showState', country)
	        	this.titleState = country.name + " " + this.__('States')
	        	this.selectedStateList = country.states
	        	this.showStateList = true;
	        },
	        closeStateDialog() {
	            this.showStateList = false;
	            //this.resetFields();
	        },
		},
		computed: {
			filteredCountries() {
				let countries = cloneDeep(this.countries)

				return countries
			},
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
