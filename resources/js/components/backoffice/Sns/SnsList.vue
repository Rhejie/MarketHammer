<template>
	<div class="main-container">
		<div class="table-container">
			<div class="card borderless">
				<div class="card-actions">
					<div class="header-title">
                        <h5>{{ __('SNS List') }}</h5>
                    </div>
					<div class="search-container">
						<el-input
							suffix-icon="fas fa-search"
							class="search-box round-input"
							clearable
							@keyup.enter.native="applyFilter"
							v-model="search"
							:placeholder="__('Type to search')">
						</el-input>
					</div>
					<div class="secondary-action-buttons">
						<base-filter-dropdown-box
							:width="400"
							:disabled="true">
							<el-form
								slot="body">
								<div class="row">
									<div class="col-md-12">
										<el-form-item
											:label="__('Date Added')">
											<el-date-picker
												class="full-width"
												v-model="filters.daterange"
												type="daterange"
												value-format="yyyy-MM-dd"
												clearable
												:placeholder="__('Pick a date')">
											</el-date-picker>
										</el-form-item>
									</div>
								</div>

								<el-button
									@click="applyFilter"
									class="full-width mb-3"
									type="primary">
									{{ __("Apply") }}
								</el-button>
							</el-form>
						</base-filter-dropdown-box>
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
							class="btn btn-black"
							@click="showForm = true">
							<i class="fas fa-plus"></i> {{ __("Add New SNS") }}
						</el-button>
					</div>
				</div>
			</div>
				<el-table
				 	class="table-list-container"
					fit
					v-loading="loading"
					:data="snsList"
					@row-click="update">
					<el-table-column
						v-for="column in columns"
						:key="column.prop"
						:label="column.label"
						:show-overflow-tooltip="column.showTooltip"
						:sortable="column.sortable"
						:prop="column.prop">
							<template slot-scope="scope">
								<div v-if = "column.prop == 'name'">
									{{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
								</div>
								<div v-else-if = "column.prop == 'description'">
									{{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
								</div>
								<div v-else>
									{{ scope.row[column.prop] }}
								</div>
							</template>
					</el-table-column>


					<el-table-column :label="__('Actions')">
						<template slot-scope="scope">
							<div>
								<button class="btn btn-default text-red" @click.stop @click="deleteData(scope.row, scope.row.index)">
									<i class="fas fa-trash-alt"></i> {{ __('Delete') }}
								</button>
							</div>
						</template>
					</el-table-column>
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

			<sns-form
				:model="selectedSns"
				v-if="showForm"
				:visible.sync="showForm"
				@close="handleClose">
			</sns-form>
		</div>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'

	export default {
		name: 'SnsList',
		mixins: [pagination],
		data() {
			let columns = [
				{label: this.__('SNS Name'), prop: 'name', showTooltip: true, sortable: true},
				{label: this.__('Description'), prop: 'description', showTooltip: true, sortable: true},
				{label: this.__('Website'), prop: 'website', showTooltip: true, sortable: true},
				{label: this.__('Color'), prop: 'color', showTooltip: true, sortable: true}
			]

			return {
				filters: {
					searchString: null,
					daterange: null
				},
				columns: columns,
				snsList: [],
				loading: false,
				showForm: false,
				selectedSns: null,
                search: null
			}
		},
		created() {
			// check pagination mixins
			this.functionName = 'fetch'

			this.fetch()

			this.$EventDispatcher.listen('SNS_MODULE_ITEM_CREATED', sns => {
				this.snsList.unshift(sns)
			})

			this.$EventDispatcher.listen('SNS_MODULE_ITEM_UPDATED', sns => {
				let index = this.snsList.findIndex(fa => fa.id == sns.id)

				if (index > -1) {
					this.snsList.splice(index, 1, sns)
				}
			})
		},
        watch: {
            search(newSearch, oldSearch) {
                if(newSearch != oldSearch) {
                    this.applyFilter();
                    return;
                }
            }
        },
		methods: {
			applyFilter() {
				this.filters.page = 1
                this.filters.searchString = this.search;
				this.fetch()
			},
			update(sns) {
				this.selectedSns = cloneDeep(sns)
				this.showForm = true
			},
			deleteData(sns, index) {
				this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                  	confirmButtonText: this.__('Delete'),
                  	cancelButtonText: this.__('Cancel'),
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(() => {

                    this.$API.Sns.delete(sns.id)
                    .then(res => {
                    	if (res.data) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		this.snsList.splice(index, 1);

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
			fetch() {
				this.loading = true

				let postData = cloneDeep(this.filters)

				this.$API.Sns.fetch(postData)
				.then(res => {
					this.snsList = cloneDeep(res.data.data)
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
				if (info.action === 'delete') {
					this.delete(info.data)
				}
				else if (info.action === 'update') {
					this.update(info.data)
				}
			},
			handleClose() {
				this.showForm = false
				this.selectedSns = null
			}
		}
	}
</script>

<style lang="scss">
	.sns-list-component {

	}
</style>
