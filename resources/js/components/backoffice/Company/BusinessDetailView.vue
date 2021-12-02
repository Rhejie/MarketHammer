<template>
	<div class="main-detail-view">
		<div class="side-list">
			<el-card shadow="never" class="box-card" >
				<div class="action-header">
					<el-button
						round
						size="small"
						@click="showAddBusinessForm = true"
						class="btn btn-primary btn-black">
						<i class="fas fa-plus"></i>  {{ __('Add New Company') }}
					</el-button>

					<div class="secondary-action-buttons list-btn">
						<base-business-filter
                            ref="baseBusinessFilter"
                            :filter-list="filterList"
                            :filter-data.sync = "filterData"
                            @change = "changeFilter" >
                        </base-business-filter>

						<el-button
						    class="mh-btn"
							:title="__('List View')"
							@click="changeToListView"
							icon="fas fa-expand-arrows-alt">
						</el-button>
					</div>
				</div>

				<div class="search_bar">
					<el-input
						class="full-width input-search"
						v-model="search"
						:placeholder="__('Search')"
						@keypress.enter.native="applyFilter('search')">
						<i slot="suffix" class="el-input__icon el-icon-search"></i>
					</el-input>
				</div>
				<div class = "pd-5">
					<base-business-filter-tags
		                :filter-data = "filterData"
		                :filter-list="filterList">
		            </base-business-filter-tags>
		        </div>
				<div class="data-section mt-3">
					<el-table
						fit
						:data="businesses"
                        v-loading="loading"
						:show-header="false"
						height="70%"
						ref="businessTable"
						highlight-current-row
						current-row-key="id"
						row-key="id"
						@current-change="selectCompany"
						class = "business-list-table">
						<el-table-column>
							<template slot-scope="scope">
								<div class="company-name">
									{{ scope.row.legal_name }}
									<!--span class="company-actions">
										<el-dropdown
											trigger="click"
											@command="handleTableAction">
											<el-button
												class="text-gray"
												type="text"
												icon="fas fa-ellipsis-v">
											</el-button>
											<el-dropdown-menu slot="dropdown">
												<el-dropdown-item :command="{action: 'delete', data: scope.row}">
													<span class="text-red">
														<i class="fas fa-trash-alt"></i> {{ __('Delete') }}
													</span>
												</el-dropdown-item>
											</el-dropdown-menu>
										</el-dropdown>
									</span-->
								</div>
							</template>
						</el-table-column>
					</el-table>

				</div>

			</el-card>
             <global-pagination
                slot="append"
                :current_page="filters.current_page"
                :current_size="filters.current_size"
				:pagination="businessesPagination"
				:layout="'sizes, prev, pager, next'"
				@handleSizeChange="handleSizeChange"
				@handleCurrentChange="handleCurrentChange">
			</global-pagination>
		</div>

		<div class="side-detail main-content">
			<el-card shadow="never" class="box-card header-section">
				<div class="header-inner">
					<div class="row">
						<div class="col-md-12">
							<h6 v-if="selectedCompany.website">
								<a :href="`//${selectedCompany.website}`" target="_blank">
									{{ selectedCompany ? selectedCompany.legal_name : 'N/A' }}
								</a>
							</h6>
							<h6 v-else>
								{{ selectedCompany ? selectedCompany.legal_name : 'N/A' }}
							</h6>
						</div>
						<div class="col-md-12">
							<i class="fas fa-map-marker-alt"  v-if="selectedCompany.address"></i><span>  {{ selectedCompany ? selectedCompany.address : 'N/A' }}</span>
						</div>
						<div class="col-md-2">
							<i class="fas fa-phone-alt" v-if="selectedCompany.phone"></i><span>  {{ selectedCompany ? selectedCompany.phone : 'N/A' }}</span>
						</div>
						<div class="col-md-4" v-if="selectedCompany ? true : false">
							<i class="fas fa-envelope"  v-if="selectedCompany.email"></i><span>  {{ selectedCompany ? selectedCompany.email : 'N/A' }}</span>
						</div>
					</div>
				</div>
			</el-card>

			<div class="main-content-section">
				<el-tabs
					@tab-click="handleClick"
					class="market-hammer-tabs"
					v-model="tabModels.outerTabs">
					<el-tab-pane :label="__('Activities')" name="activities">
						<activities-main-template></activities-main-template>
					</el-tab-pane>
					<el-tab-pane :label="__('Overview')" name="overview">
						<overview-main-template
							:business="selectedCompany"
							:page-data="pageData"
							:businesses="businesses">
						</overview-main-template>
					</el-tab-pane>
				</el-tabs>
			</div>
		</div>

		<el-dialog
			:title="__('Add New Company')"
			:visible.sync="showAddBusinessForm"
			width="70%"
			top="20px"
			@close="showAddBusinessForm = false"
			class="add-business-dialog">
			<business-form
				:business-data="pageData" :pageData="pageData">
			</business-form>
		</el-dialog>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'

	export default {
		name: 'BusinessDetailView',
		props: {
			pageData: {
				type: Object,
				required: true
			},
			config: {}
		},
        mixins: [pagination],
		data() {

			let durations = [
	            {value : '1_5_years', label : "1-5 Years"},
	            {value : '6_10_years', label : "6-10 Years"},
	            {value : '11_20_years', label : "11-20 Years"},
	            {value : '21_years_more', label : "21 Years More"},
	        ]
			let filterList = {countries : this.pageData.countries,
            industries : this.pageData.industryTypes,
            businessCategories : this.pageData.businessCategories,
            durations : durations}

			return {
				loading: false,
				filters: {
					searchString: null,
					current_page: 1,
            		current_size: 10,
				},
				tabModels: {
					outerTabs: 'overview'
				},
				businesses: [],
				businessesPagination : {},
				selectedCompany: null,
                search: null,
				showAddBusinessForm: false,
				filterList       : filterList,
            	filterData       : {country_id : "All", industry_type_id : "All", category_id : "All", daterange : null, established_duration : "All", est_max : null, est_min : null, rangeType : 5},
            	lastSelectedIndex : null

			}
		},
		created() {
			this.$EventDispatcher.listen('BUSINESS_MODULE_ITEM_UPDATED', business => {
				let index = this.businesses.findIndex(bl => bl.id == business.id)

				if (index > -1) {
					this.businesses.splice(index, 1, business)
					this.selectedCompany = this.businesses[index]
				}
			})

			this.$EventDispatcher.listen('BUSINESSDATA_GET', data => {
				this.businesses.unshift(data)
				this.setCurrentRow(0)
				this.showAddBusinessForm = false
			})

            this.$EventDispatcher.listen('CLOSE_BUSINESSFORM', data => {
                this.showAddBusinessForm = false;
            });

            this.contact_id = this.$route && this.$route.params && this.$route.params.id ? this.$route.params.id : null
		},
		mounted() {
			this.firstLoad()

			/*if (this.config.reloadData) {
				this.getBusinessList()
			} else {
				//this.businesses = cloneDeep(this.config.businessList)
				//this.selectedCompany = cloneDeep(this.config.businessList)
				this.getBusinessList()
			}*/

			//this.setSelectedCompanyByHash()
		},
        watch: {
            search(newVal, oldVal) {
                if(newVal != oldVal) {
                    this.filters.searchString = this.search;
                    this.getBusinessList();
                    return
                }
            }
        },
		methods: {
			async firstLoad(){
				//Set filter from query
				let query = this.$route && this.$route.query ? this.$route.query : null
				console.log('firstLoad', query)
				if(query && Object.keys(query).length > 0){
					this.filterData.country_id = query.country_id && query.country_id != "All" ? Number(query.country_id) : query.country_id
		            this.filterData.city = query.city
		            this.filterData.industry_type_id = query.industry_type_id
		            this.filterData.category_id = query.category_id
		            this.filterData.established_duration = query.established_duration
		            this.filterData.daterange = [query.registered_start, query.registered_end]
		            this.filterData.established_duration = query.established_duration
		            this.filterData.est_min = query.est_min ? query.est_min : null
		            this.filterData.est_min = query.est_max ? query.est_max : null
		            this.filterData.rangeType = query.rangeType
		            this.filters.searchString = query.search
		            this.filters.current_page = parseInt(query.current_page)
		            this.filters.current_size = parseInt(query.count)
				}
				if (this.config.reloadData) {
					await this.getBusinessList()
				} else {
					if(this.config.businessList && this.config.businessList.length > 0){
						this.businesses = cloneDeep(this.config.businessList)
					}
					else{
						await this.getBusinessList()
					}

				}

				let params = this.$route && this.$route.params ? this.$route.params : null
				let companyId = params && params.id ? params.id : null
				this.setSelectedBusiness(companyId)

				/*let companyId = this.config.business ? this.config.business.id : null
				this.setSelectedCompanyByHash(companyId)*/
			},
	        async setSelectedBusiness(companyId = null){
	        	companyId = companyId ? companyId : (this.businesses.length > 0 ? this.businesses[0].id : null)
	        	//Get from the list first
	        	if(companyId){
	        		let getBusiness = this.businesses.find(fn => { return fn.id == companyId })
	        		if(!getBusiness){
	        			let params = {id : companyId}
	        			await this.$API.BusinessList.getBusiness(params)
		                .then((result) => {
		                    getBusiness = result.data.businessData;
		                })
		                .catch((err) => {
		                    console.log("Error!", err);
		                })
		                .finally((_) => {
		                    this.loading = false;
		                });
	        		}
	        		if(getBusiness){
	        			this.selectedCompany = getBusiness
	        			let fndInd = this.businesses.findIndex(fn => fn.id == getBusiness.id)
	        			if(fndInd >= 0){
	        				this.setCurrentRow(fndInd)
	        			}
	        		}
	        	}

	        },
			changeFilter(){
		        setTimeout(_ => {
		            this.getBusinessList()
		        }, 500)
		    },
			async getBusinessList() {
            	let params = this.filterData
	            params.user_id =  this.$userData.activeUserId
	            params.search = this.filters.searchString ? this.filters.searchString : ""
	            params.count = this.filters.current_size
	            params.current_page = this.filters.searchString ? 1 : this.filters.current_page
	            params.registered_start = this.filterData.daterange && this.filterData.daterange[0] ? this.$df.formatDate(this.filterData.daterange[0], "YYYY-MM-DD") : "All"
	            params.registered_end = this.filterData.daterange && this.filterData.daterange[1] ? this.$df.formatDate(this.filterData.daterange[1], "YYYY-MM-DD") : "All"

	            let concatParams = ""
	            if(this.filterData.est_min) {
	                concatParams += `&est_min=${this.filterData.est_min}`
	            }
	            if(this.filterData.est_max) {
	                concatParams += `&est_max=${this.filterData.est_max}`
	            }

	            this.loading = true;

	            await this.$API.BusinessList.getBusinesses(params, concatParams)
                .then((result) => {
                    this.businesses = result.data.businessList.data;
                    this.businessesPagination = result.data.businessList;

                    if(this.$refs.businessTable){
                    	console.log('doLayout')
                    	this.$refs.businessTable.doLayout()
                    }

                })
                .catch((err) => {
                    console.log("Error!", err);
                })
                .finally((_) => {
                    this.loading = false;
                });
	        },
			/*handleTableAction(info) {
				if (info.action === 'delete') {
					this.deleteBusiness(info.data)
				}
			},
			deleteBusiness(company) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                  	confirmButtonText: this.__('Delete'),
                  	cancelButtonText: this.__('Cancel'),
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true;

                    this.$API.BusinessList.deleteBusiness(company.id)
                    .then(res => {
                    	if (res.data.success) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		let index = this.businesses.findIndex(co => co.id == company.id)

                    		if (index > -1) {
                    			this.businesses.splice(index, 1)
                    			this.selectedCompany = null
                    			this.setCurrentRow(0)
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
            },*/
			handleClick() {

			},
			applyFilter() {
				if (!this.filters.searchString) return

				this.filters.page = 1

				this.getBusinessList()
			},
			selectCompany(val, oldVal) {
				this.selectedCompany = cloneDeep(val)

				/*if (val) {
	      			window.history.replaceState('', `Market Happer | Businesses`, `#/${val.id}`)
	      		}*/
			},
			setCurrentRow(index) {
				/*this.$nextTick(_ => {
					setTimeout(_ => {
						this.$refs.businessTable.setCurrentRow(this.businesses[index])
					}, 200)
				})*/
				if(this.$refs.businessTable){
					setTimeout(_ => {
						this.$refs.businessTable.setCurrentRow(this.businesses[index])
					}, 200)
				}
			},
			setSelectedCompanyByHash(companyId) {
				if(companyId == null){
					let hashData = location.hash.substr(2, location.hash.length)
					if(hashData.length > 0){
						let num = ''
						for (var i = 0; i < hashData.length; i++) {
							num = num+''+hashData[i]
						}
						companyId = num !== '' ? parseInt(num) : null
					}

					console.log("companyId", companyId, hashData)
				}

				if (companyId) {
					let index = this.businesses.findIndex(company => company.id == companyId)

					if (index > -1) {
						let company = cloneDeep(this.businesses[index])
						this.selectedCompany = company

						this.setCurrentRow(index)
					}

					return
				}

				if (this.businesses.length) {
					this.setCurrentRow(0)
				}
			},
			changeToListView() {
				//this.$EventDispatcher.fire('BUSINESS_MODULE_CHANGE_TO_LIST_VIEW')

				let params = this.filterData
	            params.user_id =  this.$userData.activeUserId
	            params.search = this.filters.searchString ? this.filters.searchString : ""
	            params.count = this.filters.current_size
	            params.current_page = this.filters.current_page
	            params.registered_start = this.filterData.daterange && this.filterData.daterange[0] ? this.$df.formatDate(this.filterData.daterange[0], "YYYY-MM-DD") : "All"
	            params.registered_end = this.filterData.daterange && this.filterData.daterange[1] ? this.$df.formatDate(this.filterData.daterange[1], "YYYY-MM-DD") : "All"

	            this.$router.push({
	                /*name: 'Business List',*/
	                path: "/business",
	                query: params
	            })
			},
	        handleSizeChange(val) {
	            this.filters.current_size = val;
	            this.getBusinessList();
	        },
	        handleCurrentChange(val) {
	            this.filters.current_page = val;
	            this.getBusinessList();
	        },
		}
	}
</script>

<style lang="scss">
	.main-detail-view {
		.content-section {
			margin-top: 10px;
		}

		/* .business-list-table{
			height: 77% !important;
		} */

		.el-pagination{
			white-space: unset;
			display: flex;

			.el-pager > li{
				font-size: 12px;
				min-width: 25px;
			}
		}
	}
        .company-name{
            /*text-align: justify; */
            word-break: break-word;
            margin-right: 20px;
        }

	.content-wrapper {
    background: #ffffff;
	padding:0px;
	}
	.el-card, .el-message {
		border-radius: 0px;
	}
	.business-detail-view {
		padding: 0px;
	}
	.side-detail {
		margin-left: 0px;
		width: 75%;
		padding: 5px;
	}
	.side-list {
		padding: 10px;
	}
	.main-content .header-section .header-inner, .product-main-content .header-section .header-inner {
    	padding: 10px 15px;
	}
	div#tab-activities {
    	padding: 0px 10px;
	}
	div#tab-overview {
    	padding: 0px 25px;
	}
	.el-tabs__active-bar.is-top {
   	    width: 75px !important;
		margin-left: -10px;
	}
	.el-card.box-card.header-section.is-never-shadow {
		border: 0px;
	}
	.side-detail.main-content {
		border: 1px solid #EBEEF5;
		margin-top: 10px;
	}
	.el-tabs--border-card {
		box-shadow: none;
		border: 1px solid #EBEEF5;
	}
	.el-card.is-always-shadow, .el-card.is-hover-shadow:focus, .el-card.is-hover-shadow {
		box-shadow: none;
	}
	.el-tabs--border-card>.el-tabs__content{
		padding: 0px
	}
	.el-tabs__nav-next, .el-tabs__nav-prev {
		line-height: 35px;
	}
	.el-tabs__item.is-top:nth-child(1) {
		padding-left: 0px;
		padding-right: 20px;
	}
	.el-tabs__item.is-top:nth-child(2) {
		padding-left: 10px;
	}
	.market-hammer-tabs.el-tabs.el-tabs--border-card.el-tabs--top .el-tabs__content {
		overflow-y: auto;
		max-height: 538px;
	}
	.el-tabs--border-card>.el-tabs__header .is-scrollable .el-tabs__item:first-child {
		margin-left: 0;
		padding-left: 20px;
	}
	.el-tabs--border-card>.el-tabs__header .el-tabs__item.is-active{
		color: #ffa954;
	}
	.market-hammer-tabs .header-title {
		display:none !important;
	}
</style>
