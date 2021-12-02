<template>
	<div class="main-container">
		<div class="table-container table-container-business-tab">
			<div class="card borderless">
					<div class="card-actions">
						<div class="header-title">
                        </div>
						<div class="search-container">
							<!-- <el-input
								suffix-icon="fas fa-search"
								class="input-search"
								clearable
								@keyup.enter.native="applyFilter"
								v-model="filters.searchString"
								:placeholder="__('Search Finances')">
							</el-input> -->
						</div>
						<div class="secondary-action-buttons">
							<base-filter-dropdown-box
								hidden
								disabled>
								<!-- <el-form
									slot="body">
									<div class="row">
										<div class="col-md-4">
											<el-form-item
												label="To Filter">
												<el-select
													class="full-width"
													v-model="stageFilters.toFilter">
													<el-option label="Issued Date" value="issued_date"></el-option>
													<el-option label="Expiry Date" value="expiry_date"></el-option>
												</el-select>
											</el-form-item>
										</div>
										<div class="col-md-8">
											<el-form-item
												:label="dateTitle">
												<el-date-picker
													class="full-width"
													v-model="stageFilters.daterange"
													type="daterange"
													value-format="yyyy-MM-dd"
													clearable
													placeholder="Pick a date">
												</el-date-picker>
											</el-form-item>
										</div>
									</div>

									<el-button
										@click="applyFilter"
										class="full-width mb-3"
										type="primary">
										Apply
									</el-button>
								</el-form> -->
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
								:disabled="!business"
								class="btn btn-black"
								@click="showForm = true">
								<i class="fas fa-plus"></i> {{ __('Add New Finances') }}
							</el-button>
						</div>
					</div>


					<el-table
						v-loading="loading"
						class="table-list-container"
						fit
						:data="finances"
						@row-click="update">
						<el-table-column
							v-for="col in columns"
							:key="col.key"
							:prop="col.key"
							:sortable="col.sortable"
							:show-overflow-tooltip="col.showTooltip"
							:label="__(col.label)"
							:width="col.width"
							>
							<template slot-scope="scope">
								<template v-if="col.key === 'revenue'">
									{{ `$ ${scope.row[col.key]}` }}
								</template>

								<template v-else-if="col.key === 'ebit'">
									{{ `$ ${scope.row[col.key]}` }}
								</template>

								<template v-else>
									{{ scope.row[col.key] }}
								</template>
							</template>
						</el-table-column>

						<el-table-column :label="__('Actions')">
							<template slot-scope="scope">
								<div>
									<button class="btn btn-default text-red" @click.stop @click="deleteData(scope.row)">
										<i class="fas fa-trash-alt"></i> {{ __('Delete') }}
									</button>
								</div>
							</template>
						</el-table-column>
					</el-table>

					<div class="text-right">
						<global-pagination
                            :current_page="filters.page"
                            :current_size="filters.size"
                            :pagination="filters"
                            @handleSizeChange="handleSize"
                            @handleCurrentChange="handlePage">
						</global-pagination>					</div>

			</div>
		</div>

		<business-finance-form
			:business="business"
			:model="selectedFinance"
			v-if="showForm"
			:visible.sync="showForm"
            @update_total="updateTotal"
			@close="handleClose">
		</business-finance-form>
	</div>
</template>

<script>
	import moment from 'moment'
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../../../mixins/pagination'

	export default {
		name: 'BusinessFinance',
		mixins: [pagination],
		props: {
			business: {}
		},
		data() {
			let columns = [
				{label: 'Year', key: 'year', sortable: true, showTooltip: true, width: '100px'},
				{label: 'Revenue (US)', key: 'revenue', sortable: true, showTooltip: true},
				{label: 'Earning Before Interest & Tax (US)', key: 'ebit', sortable: true, showTooltip: true}
			]

			return {
				filters: {
					searchString: null
				},
				columns: columns,
				finances: [],
				selectedFinance: null,
				showForm: false,
				loading: false
			}
		},
		created() {
			// check pagination mixins
			this.functionName = 'fetch'

			this.fetch()

			this.$EventDispatcher.listen('BUSINESS_FINANCE_MODULE_ITEM_CREATED', finanace => {
				this.finances.push(finanace)
			})

			this.$EventDispatcher.listen('BUSINESS_FINANCE_MODULE_ITEM_UPDATED', finance => {
				let index = this.finances.findIndex(fa => fa.id == finance.id)

				if (index > -1) {
					this.finances.splice(index, 1, finance)
				}
			})
		},
		methods: {
			applyFilter() {
				this.filters.page = 1

				this.fetch()
			},
            updateTotal() {
                this.filters.total++;
            },
			fetch() {
				if (!this.business) {
					return
				}

				this.loading = true

				let postData = cloneDeep(this.filters)
				postData.business_id = this.business.id

				this.$API.BusinessFinance.fetch(postData)
				.then(res => {
					this.finances = res.data.data
                    this.filters.total = res.data.total
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			update(finance) {
				this.selectedFinance = cloneDeep(finance)
				this.showForm = true
			},
			deleteData(finanace) {
				this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                  	confirmButtonText: this.__('Delete'),
                  	cancelButtonText: this.__('Cancel'),
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true

                    console.log('here')

                    this.$API.BusinessFinance.delete(finanace.id)
                    .then(res => {
                    	if (res.data) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: this.__("success")
                    		})

                    		let index = this.finances.findIndex(co => co.id == finanace.id)
                            this.filters.total--;

                    		if (index > -1) {
                    			this.finances.splice(index, 1)
                    			this.selectedFinance = null
                    		}

                    		return
                    	}

	                    this.$notify({
	                        title: this.__("Delete Failed"),
	                        message: this.$msg.notif.failed_delete,
	                        type: "error"
	                    });
                    })
                    .catch(err => {
                    	console.log(err)

                    	this.$notify({
                    		title: this.__("Error"),
                    		message: this.$msg.notif.service_error,
                    		type: "error"
                    	});
                    })
                    .finally(_ => {
                    	this.loading = false
                    })
                })
                .catch(() => {});
			},
			handleClose() {
				this.showForm = false
				this.selectedFinance = null
			},
			handleAction(info) {
				if (info.action === 'delete') {
					this.delete(info.data)
				}
				else if (info.action === 'update') {
					this.update(info.data)
				}
			}
		},
		watch: {
			'business.id'() {
				this.fetch()
			}
		}
	}
</script>

<style lang="scss">
	.business-finance-component {

	}
</style>
