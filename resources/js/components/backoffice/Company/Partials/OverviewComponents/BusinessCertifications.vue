<template>
	<div class="main-container">
		<div class="table-container table-container-business-tab">
			<div class="card borderless">
					<div class="card-actions">
						<div class="header-title">
                        </div>
						<div class="search-container" v-if="!isCreate">
							<el-input
								suffix-icon="fas fa-search"
								class="input-search"
								clearable
								v-model="filters.searchString"
								:placeholder="__('Search Certifications')">
							</el-input>
						</div>
						<div class="secondary-action-buttons">
							<base-filter-dropdown-box
								v-if="!isCreate">
								<el-form
									slot="body">
									<div class="row">
										<div class="col-md-4">
											<el-form-item
												:label="__('To Filter')">
												<el-select
													class="full-width"
													v-model="stageFilters.toFilter">
													<el-option :label="__('Issued Date')" value="issued_date"></el-option>
													<el-option :label="__('Expiry Date')" value="expiry_date"></el-option>
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
													:placeholder="__('Pick a date')">
												</el-date-picker>
											</el-form-item>
										</div>
									</div>

									<el-button
										@click="applyFilter"
										class="full-width mb-3"
										type="primary"
										:title="__('Filter')">
										{{ __('Apply') }}
									</el-button>
								</el-form>
							</base-filter-dropdown-box>

							<template v-if="!isCreate">
								<el-button
									disabled
									class="mh-btn"
									:title="__('Import')">
									<i class="fas fa-table"></i>
								</el-button>
								<el-button
									class="mh-btn"
									@click="exportCertificates"
									:title="__('Export')">
									<i class="fas fa-file-alt"></i>
								</el-button>
							</template>
						</div>
						<div class="add-new-button">
						<el-button
								round
								class="btn btn-black"
								@click="showCertificationForm = true">
								<i class="fas fa-plus"></i> {{ __('Add New Certification') }}
							</el-button>
						</div>
					</div>
				<div class="content-section" v-loading="loading">
					<el-table
						class="table-list-container"
						fit
						:data="filteredCertifications"
						@row-click="updateCertification">
						<el-table-column
							:label="__('No.')"
							v-if="!isCreate"
							type="index">
						</el-table-column>

						<el-table-column
							v-for="col in columns"
							:key="col.key"
							:prop="col.key"
							:sortable="col.sortable"
							:show-overflow-tooltip="col.showTooltip"
							:label="col.label">
							<template slot-scope="scope">
								<template v-if="col.key === 'name'">
									{{ $sf.ucwords(scope.row.name) }}
								</template>

								<template v-else>
									{{ scope.row[col.key] }}
								</template>
							</template>
						</el-table-column>

						<el-table-column :label="__('Actions')">
							<template slot-scope="scope">
								<div>
									<button
										class="btn btn-default text-red"
										@click="
											deleteCertification(
												scope.row,
												scope.$index
											)
										"
									>
										<i class="fas fa-trash-alt"></i> {{ __("Delete") }}
									</button>
								</div>
							</template>
						</el-table-column>
					</el-table>

					<div class="text-right" v-if="!isCreate">
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
		<business-certification-form
			:is-create="isCreate"
			:business="business"
			:certifications="formPageData.certifications"
			:model="selectedCertification"
			v-if="showCertificationForm"
			:visible.sync="showCertificationForm"
			@close="handleClose">
		</business-certification-form>
	</div>
</template>

<script>
	import moment from 'moment'
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../../../mixins/pagination'
	import fileExporter from '../../../../../mixins/fileExporter'

	export default {
		name: 'BusinessCertifications',
		mixins: [pagination, fileExporter],
		props: {
			isCreate: {
				type: Boolean,
				default: false
			},
			business: {},
			pageData: {
				type: Object,
				required: true
			}
		},
		data() {
			let columns = [
				{label: this.__('Title'), key: 'name', sortable: true, showTooltip: true},
				{label: this.__('Description'), key: 'description', sortable: true, showTooltip: true},
				{label: this.__('Issued Date'), key: 'issued_date', sortable: true, showTooltip: true},
				{label: this.__('Expiration Date'), key: 'expiry_date', sortable: true, showTooltip: true}
			]

			return {
				loading: false,
				showCertificationForm: false,
				stageFilters: {
					daterange: null,
					toFilter: 'issued_date'
				},
				filters: {
					searchString: null,
					daterange: null,
					toFilter: 'issued_date'
				},
				businessCertifications: [],
				columns: columns,
				selectedCertification: null,
				formPageData : this.pageData
			}
		},
		created() {
			this.getCertifications()

			this.$EventDispatcher.listen('BUSINESS_CERTIFICATION_MODULE_ITEM_CREATED', certification => {
				this.businessCertifications.unshift(certification)
			})

			this.$EventDispatcher.listen('BUSINESS_CERTIFICATION_MODULE_ITEM_UPDATED', address => {
				let index = this.businessCertifications.findIndex(fa => fa.id == address.id)

				if (index > -1) {
					this.businessCertifications.splice(index, 1, address)
				}
			})

			if(!this.pageData.certifications || this.pageData.certifications==undefined){
				this.loadMetaData()
			}
		},
		methods: {
			loadMetaData() {
                let toLoad = [
                    'certifications',
                ]

                this.$API.Utils.getMetaData(toLoad)
                .then(res => {
                    this.formPageData['certifications'] = res.data.certifications
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {})
            },
			getCertifications() {
				if (!this.business) return

				this.loading = true

				let postData = {
					business_id: this.business.id
				}

				this.$API.BusinessCertification.getCertifications(postData)
				.then(res => {
					if (Array.isArray(res.data)) {
						this.businessCertifications = res.data
					}
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			deleteCertification(company, index) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                  	confirmButtonText: this.__('Delete'),
                  	cancelButtonText: this.__('Cancel'),
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                	if (this.isCreate) {
                		this.businessCertifications.splice(index, 1)

                		return
                	}

                    this.loading = true;

                    this.$API.BusinessCertification.deleteCertification(company.id)
                    .then(res => {
                    	if (res.data) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		let index = this.businessCertifications.findIndex(co => co.id == company.id)

                    		if (index > -1) {
                    			this.businessCertifications.splice(index, 1)
                    			this.selectedCertification = null
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
            exportCertificates() {
            	let postData = cloneDeep(this.filteredCertifications).map((pd, index) => {
            		return {
            			no: (index + 1),
						name: this.$sf.ucwords(pd.name),
						description: pd.description,
						issued_date: pd.issued_date,
						expiry_date: pd.expiry_date
            		}
            	})

            	this.loading = true

            	this.$API.BusinessCertification.exportCertifications(postData)
            	.then(res => {
					this.exporter('xlsx', this.__('Business Certification'), res.data, false)
				})
				.catch(err => {
					console.log(err)
					this.$notify.error({
			          	title: this.__('Import Error'),
			          	message: this.__('Failed to download certifications. Refresh the page or report this to your administrator.')
			        });
				})
				.finally(_ => {
					this.loading = false
				})
            },
            updateCertification(certification) {
				this.showCertificationForm = true
				this.selectedCertification = cloneDeep(certification)
			},
			handleClose() {
				this.selectedCertification = null
				this.showCertificationForm = false
			},
			applyFilter() {
				this.filters.daterange = cloneDeep(this.stageFilters.daterange)
				this.filters.toFilter = cloneDeep(this.stageFilters.toFilter)
			}
		},
		computed: {
			filteredCertifications() {
				let certs = cloneDeep(this.businessCertifications)
				let query = this.filters.searchString
				let offset = (this.filters.page - 1) * this.filters.size
				let limit = this.filters.page * this.filters.size
				let daterange = this.filters.daterange

				if (query) {
					query = query.toLowerCase()

					certs = certs.filter(cert => cert.name.toLowerCase().indexOf(query) > -1)
				}

				if (daterange) {
					certs = certs.filter(cert => {
						let date = moment(cert[this.filters.toFilter])

						return date.isBetween(daterange[0], daterange[1], null, '[]')
					})
				}

				certs = certs.filter((od, index) => (index + 1) > offset && ((index + 1) <= limit))

				return certs
			},
			dateTitle() {
				return this.$sf.ucwords(this.stageFilters.toFilter.replace('_', ' '))
			}
		},
		watch: {
			'business.id'() {
				this.getCertifications()
			},
			businessCertifications: {
				immediate: true,
				handler() {
					setTimeout(_ => {
						this.filters.total = this.businessCertifications.length
					}, 200)
				}
			}
		}
	}
</script>

<style lang="scss">
	.business-certifications-component {

	}
</style>
