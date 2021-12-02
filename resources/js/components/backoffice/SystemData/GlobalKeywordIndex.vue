<template>
	<div class="main-container">
		<div class="table-container">
			<div class="card borderless">
				<div class="card-actions">
					 <div class="header-title">
                        <h5>{{ __('Keywords') }}</h5>
                    </div>
					<div class="search-container">
						<el-input
								v-if="!source"
								suffix-icon="fas fa-search"
								class="search-box round-input full-width"
								clearable
								@keyup.enter.native="applyFilter"
								v-model="filters.searchString"
								:placeholder="__('Type to search')">
						</el-input>
						<el-autocomplete
								v-else
								value-key="name"
								clearable
								v-model="filters.searchString"
								:fetch-suggestions="searchKeywords"
								:placeholder="__('Add new keyword')"
								suffix-icon="fas fa-search"
								class="search-box round-input full-width"
								@select="handleSelect">
						</el-autocomplete>
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
										{{ __('Apply') }}
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
								:disabled="source && !sourceObject"
								round
								v-if="!source"
								class="btn btn-black"
								@click="showForm = true">
								<i class="fas fa-plus"></i> {{ __('Add New Keyword') }}
							</el-button>
					</div>
				</div>
					<el-table
						class="table-list-container"
						fit
						:data="keywordList"
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
									{{ scope.row.name }}
								</div>
								<div v-else>
									{{ scope.row[column.prop] }}
								</div>
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

				<global-keyword-form
					:source="source"
					:source-object="sourceObject"
					:model="model"
					v-if="showForm"
					:visible.sync="showForm"
					@close="handleClose">
				</global-keyword-form>
			</div>
		</div>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'

	export default {
		name: 'GlobalKeyword',
		props: {
			source: {},
			sourceObject: {}
		},
		mixins: [pagination],
		data() {
			let columns = [
				{label: this.__('Keywords'), prop: 'name', showTooltip: true, sortable: true},
				{label: this.__('Korean'), prop: 'lang_ko', showTooltip: true, sortable: true},
				{label: this.__('Chinese'), prop: 'lang_zh', showTooltip: true, sortable: true},
				{label: this.__('Japanese'), prop: 'lang_jp', showTooltip: true, sortable: true},
				{label: this.__('German'), prop: 'lang_de_de', showTooltip: true, sortable: true}
			]

			return {
				filters: {
					searchString: null
				},
				columns: columns,
				keywordList: [],
				loading: false,
				showForm: false,
				model: null,
				activeUserId: window.Laravel.userData.activeUserId,
				userTypeId: window.Laravel.userData.userTypeId,
			}
		},
		created() {
			// check pagination mixins
			this.functionName = 'fetch'

			this.fetch()

			this.$EventDispatcher.listen('GLOBAL_KEYWORD_MODULE_ITEM_CREATED', keyword => {
				this.fetch()
			})

			this.$EventDispatcher.listen('GLOBAL_KEYWORD_MODULE_ITEM_UPDATED', keyword=> {
				this.fetch()
			})
		},
		methods: {
			applyFilter() {
				this.filters.page = 1

				this.fetch()
			},
			update(keyword) {
				this.model = cloneDeep(keyword)
				this.showForm = true
			},
			fetch() {
				let postData = cloneDeep(this.filters)

				if (this.source) {
					postData.from = this.source
					postData.from_id = this.sourceObject ? this.sourceObject.id : null

					if (!this.sourceObject) return
				}

				this.loading = true

				this.$API.GlobalKeyword.fetch(postData)
				.then(res => {
					this.keywordList = cloneDeep(res.data.data)
                    console.log(res.data.data);
					this.filters.total = res.data.total
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			deleteData(keyword) {
				this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                  	confirmButtonText: this.__('Delete'),
                  	cancelButtonText: this.__('Cancel'),
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true

                    let id = this.source === 'business' ? keyword.business_keyword_id : keyword.id

                    let request = null

                    if (this.source === 'business') {
                    	request = this.$API.BusinessKeyword.delete(id)
                    } else {
                    	request = this.$API.GlobalKeyword.delete(id, this.source || 'global')
                    }

                    request
                    .then(res => {
                    	if (res.data) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		let index = this.keywordList.findIndex(co => co.id == keyword.id)

                    		if (index > -1) {
                    			this.keywordList.splice(index, 1)
                    			this.model = null
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
				this.model = null
			},
			searchKeywords(query, cb) {
				if (!query) {
					cb([])

					return
				}

				let postData = {
					from: this.source,
					from_id: this.sourceObject.id
				}

				this.$API.GlobalKeyword.searchKeywords(query, postData)
				.then(res => {
					if (res.data) {
						cb(res.data)

						return
					}

					cb([])
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {})
			},
			handleSelect(item) {
				console.log(item)

				let postData = {
					business_id: this.sourceObject.id,
					global_keyword_id: item.id
				}

				this.create(postData)
			},
			create(postData) {
				this.loading = true

				this.$API.BusinessKeyword.create(postData)
				.then(res => {
					if (res.data.data) {
						this.filters.searchString = null
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('GLOBAL_KEYWORD_MODULE_ITEM_CREATED', res.data.data)

                        this.closeForm()

                        return
                    }

                    this.$notify({
                        title: this.__("Failed"),
                        message: this.$msg.notif.failed_add,
                        type: "error"
                    })
				})
				.catch(err => {
					console.log(err)

					this.showValidationError(err)
				})
				.finally(_ => {
					this.loading = false
				})
			}
		},
		computed: {
			isSupplier() {
				return window.Laravel.userData.userTypeId == 2 ? true : false
			}
		},
		watch: {
			sourceObject() {
				this.fetch()
			}
		}
	}
</script>

<style lang="scss">
	.global-keyword-index {

	}
</style>
