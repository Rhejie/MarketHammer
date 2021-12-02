<template>
	<div class="main-container" v-loading="loading">
		<div class="table-container">
			<div class="card borderless">
					<div class="card-actions">
						<div class="header-title">
							<h5>{{ __('Translations') }}</h5>
						</div>
						<div class="header-dropdown">
							<el-dropdown>
								<span class="el-dropdown-link">
									Select Language<i class="el-icon-arrow-down el-icon--right"></i>
								</span>
								<el-dropdown-menu slot="dropdown">
									<el-dropdown-item>{{ __("English") }}</el-dropdown-item>
									<el-dropdown-item>{{ __("Korean") }}</el-dropdown-item>
									<el-dropdown-item>{{ __("Japanese") }}</el-dropdown-item>
									<el-dropdown-item>{{ __("German") }}</el-dropdown-item>
								</el-dropdown-menu>
							</el-dropdown>
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
						<div class="secondary-action-buttons" style="width: 45%">
							<base-filter-dropdown-box
								:width="400"
								:disabled="true">
								<el-form
									slot="body">
									<div class="row">
										<div class="col-md-4">
											<el-form-item
												label="To Filter">
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

							<el-button
								class="mh-btn"
								@click="syncTranslations">
								<i class="fas fa-sync-alt"></i>
							</el-button>
								<el-button
									round
									class="btn btn-black"
									@click="showForm = true">
									<i class="fas fa-plus"></i> {{ __("Add New Translation") }}
								</el-button>
						</div>
					</div>
			<div>
					<el-table
						class="table-list-container"
						fit
						:data="translations"
						@row-click="update">
						<el-table-column
							v-for="column in columns"
							:key="column.prop"
							:label="column.label"
							:show-overflow-tooltip="column.showTooltip"
							:sortable="column.sortable"
							:prop="column.prop">
							<template slot-scope="scope">
								<div v-if = "column.prop == 'key'">
									<el-button
										@click="update(scope.row)"
										type="text"
									>
										{{ scope.row.key }}
									</el-button>
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
			</div>

			<translation-form
				:model="selectedTranslation"
				v-if="showForm"
				:visible.sync="showForm"
				@update_total="updateTotal"
				@close="handleClose">
			</translation-form>
			</div>
		</div>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'

	export default {
		name: 'TranslationIndex',
		mixins: [pagination],
		data() {
			let columns = [
				{label: this.__('Translation Code'), prop: 'key', showTooltip: true, sortable: true},
				{label: this.__('Default Text (English)'), prop: 'en', showTooltip: true, sortable: true},
				{label: this.__('Korean'), prop: 'ko', showTooltip: true, sortable: true},
				{label: this.__('Chinese'), prop: 'zh', showTooltip: true, sortable: true},
				{label: this.__('Japanese'), prop: 'jp', showTooltip: true, sortable: true},
				{label: this.__('German'), prop: 'de_de', showTooltip: true, sortable: true}
			]
			return {
				filters: {
					searchString: null
				},
				columns: columns,
				translations: [],
				selectedTranslation: null,
				showForm: false,
				loading: false
			}
		},
		created() {
			// check pagination mixins
			this.functionName = 'fetch'

			this.fetch()

			this.$EventDispatcher.listen('TRANSLATION_MODULE_ITEM_CREATED', trans => {
				this.translations.unshift(trans)
			})

			this.$EventDispatcher.listen('TRANSLATION_MODULE_ITEM_UPDATED', address => {
				let index = this.translations.findIndex(fa => fa.id == address.id)

				if (index > -1) {
					this.translations.splice(index, 1, address)
				}
			})
		},
		methods: {
			fetch() {
				this.loading = true

				let postData = cloneDeep(this.filters)

				this.$API.Translation.fetch(postData)
				.then(res => {
					this.translations = res.data.data
                    this.filters.total = res.data.total
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
            updateTotal() {
                this.filters.total++;
            },
			update(translation) {
				this.selectedTranslation = cloneDeep(translation)
				this.showForm = true
			},
			deleteData(translation, index) {
				this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                  	confirmButtonText: this.__('Delete'),
                  	cancelButtonText: this.__('Cancel'),
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(() => {

                    this.$API.Translation.delete(translation.id)
                    .then(res => {
                    	if (res.data) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		this.translations.splice(index, 1);

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
			syncTranslations() {
				this.loading = true

				this.$API.Translation.syncTranslations()
				.then(res => {

				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			applyFilter(from) {
				this.filters.page = 1

				this.fetch()
			},
			handleClose() {
				this.showForm = false
				this.selectedTranslation = null
			},
		}
	}
</script>

<style lang="scss">
    .translation_data {
        .el-card__body {
            height: 600px;
        }
    }

</style>
