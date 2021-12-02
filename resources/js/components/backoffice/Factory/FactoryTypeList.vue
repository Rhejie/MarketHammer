<template>
	<div class="main-container">
		<div class="table-container">
			<div class="card borderless">
				<div class="card-actions">
					<div class="header-title">
                        <h5>{{ __('Factory Types') }}</h5>
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
									<div class="col-md-4">
										<el-form-item
											:label="__('To Filter')">
											<el-select
												class="full-width"
												v-model="filters.toFilter">
												<el-option :label="__('Issued Date')" value="issued_date"></el-option>
												<el-option :label="__('Expiry Date')" value="expiry_date"></el-option>
											</el-select>
										</el-form-item>
									</div>
									<div class="col-md-8">
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
							<i class="fas fa-plus"></i> {{ __("Add New Factory Type") }}
						</el-button>
					</div>
				</div>

				<el-table
					class="table-list-container"
					fit
					v-loading="loading"
					:data="factoryTypeList"
					@row-click="update">

					<el-table-column
						v-for="column in columns"
						:key="column.prop"
						:label="column.label"
						:show-overflow-tooltip="column.showTooltip"
						:sortable="column.sortable"
						:prop="column.prop">
						<template slot-scope="scope">
							<template v-if = "column.prop == 'name'">
								{{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
							</template>

							<template v-else-if = "column.prop == 'description'">
								{{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
							</template>

							<template v-else-if="column.prop === 'created_at'">
								{{ $df.formatDate(scope.row.created_at, 'YYYY-MM-DD') }}
							</template>

							<template v-else>
								{{ scope.row[column.prop] }}
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

				<div class="text-right mb-3">
					<global-pagination
						:current_page="filters.page"
						:current_size="filters.size"
						:pagination="filters"
						@handleSizeChange="handleSize"
						@handleCurrentChange="handlePage">
					</global-pagination>
				</div>

				<factory-type-form
					:model="selectedModel"
					v-if="showForm"
					:visible.sync="showForm"
					@update_total="updateTotal"
					@close="handleClose">
				</factory-type-form>
			</div>
		</div>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'

	export default {
		name: 'FactoryTypeList',
		mixins: [pagination],
		data() {
			let columns = [
				{label: this.__('Factory Type'), prop: 'name', showTooltip: true, sortable: true},
				{label: this.__('Description'), prop: 'description', showTooltip: true, sortable: true},
				{label: this.__('Date Added'), prop: 'created_at', showTooltip: true, sortable: true}
			]

			return {
				filters: {
					searchString: null
				},
				factoryTypeList: [],
				columns: columns,
				selectedModel: null,
				loading: false,
				showForm: false,
                search: null
			}
		},
		created() {
			// check pagination mixins
			this.functionName = 'fetch'

			this.fetch()

			this.$EventDispatcher.listen('FACTORY_TYPE_MODULE_ITEM_CREATED', type => {
				this.factoryTypeList.push(type)
			})

			this.$EventDispatcher.listen('FACTORY_TYPE_MODULE_ITEM_UPDATED', type => {
				let index = this.factoryTypeList.findIndex(fa => fa.id == type.id)

				if (index > -1) {
					this.factoryTypeList.splice(index, 1, type)
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
            updateTotal(total) {
                this.filters.total = this.filters.total + 1;
            },
			fetch() {
				this.loading = true

				let postData = cloneDeep(this.filters)

				this.$API.FactoryType.fetch(postData)
				.then(res => {
					this.factoryTypeList = res.data.data;
                    this.filters.total = res.data.total;
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			update(model) {
				this.showForm = true
				this.selectedModel = cloneDeep(model)
			},
			deleteData(type) {
				this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                  	confirmButtonText: this.__('Delete'),
                  	cancelButtonText: this.__('Cancel'),
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true

                    this.$API.FactoryType.delete(type.id)
                    .then(res => {
                    	if (res.data) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		let index = this.factoryTypeList.findIndex(co => co.id == type.id)

                            this.filters.total--

                    		if (index > -1) {
                    			this.factoryTypeList.splice(index, 1)
                    			this.selectedModel = null
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
				this.selectedModel = null
			}
		}
	}
</script>

<style lang="scss">
    .factory_data {
        .el-card__body {
            height: 600px;
        }
    }
</style>
