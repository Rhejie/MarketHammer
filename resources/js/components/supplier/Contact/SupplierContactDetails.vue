<template>
	<div class="product-detail-view">
		<div class="side-list">
			<el-card shadow="never" class="box-card" v-loading="loading">
				<div class="action-header">
					<div class="secondary-action-buttons">
						<base-filter-dropdown-box>
						</base-filter-dropdown-box>

						<el-button
							size="small"
							type="default"
							:title="__('List View')"
							@click="changeToListView"
							icon="fas fa-expand-arrows-alt">
						</el-button>
					</div>
				</div>

				<div class="search_bar">
					<el-input
						class="full-width input-search"
						v-model="filters.search"
						placeholder="Search"
						@keypress.enter.native="applyFilter('search')">
						<i slot="suffix" class="el-input__icon el-icon-search"></i>
					</el-input>
				</div>

				<div class="data-section mt-3">
					<el-table
						fit
						:data="tableList"
						:show-header="false"
						height="78%"
						ref="contactTable"
						highlight-current-row
						current-row-key="id"
						row-key="id"
						@current-change="selectContact">
						<el-table-column>
							<template slot-scope="scope">
								<div class="company-name">
									<span>{{ scope.row.name }}</span>
									
									<!-- <span class="company-actions">
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
														<i class="fas fa-trash-alt"></i> Delete
													</span>
												</el-dropdown-item>
											</el-dropdown-menu>
										</el-dropdown>
									</span> -->
								</div>
							</template>
						</el-table-column>
					</el-table>
				</div>
			</el-card>
		</div>

		<div class = "side-detail product-main-content">
		<!-- <div class = "side-detail product-main-content"> -->
			<el-card shadow="never" class="box-card header-section">
				<div class="header-inner">
					<h4>{{ selectedContact ? selectedContact.name : 'N/A' }}</h4>
					<span v-if = "isContact">{{ selectedContact ? selectedContact.email : 'N/A' }}</span>
					<span v-if = "isContact">{{ selectedContact ? selectedContact.phone : 'N/A' }}</span>
					<!-- <span>{{ selectedProduct ? selectedProduct.address.name : 'N/A' }}</span> -->
				</div>
			</el-card>

			<div class="main-content-section mt-3">
				<el-tabs
					type="card"
					@tab-click="handleClick"
					class="market-hammer-tabs"
					v-model="tabModels.outerTabs">
					<!-- <el-tab-pane label="Activities" name="activities">
						<activities-main-template></activities-main-template>
					</el-tab-pane> -->
					<el-tab-pane :label="__('Overview')" name="overview">
						<contact-details-overview
							:contact="selectedContact"
							:page-data="pageData">
						</contact-details-overview>
					</el-tab-pane>

				</el-tabs>
			</div>
		</div>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import _forEach from 'lodash/forEach'
	import pagination from '../../../mixins/pagination'

	export default {
		props: {
			pageData: {
				type: Object,
				required: true
			},
			contact: {},
			contacts: {},
		},
		data() {
			return {
				filters: {
					search: null,
				},
				tabModels: {
					outerTabs: 'overview'
				},
				loading 		: false,
				contactList 	: [],
				selectedContact : null,
				contact_id 		: null
			}
		},
		created(){
			this.contact_id = this.$route && this.$route.params && this.$route.params.id ? this.$route.params.id : null
		},
		mounted(){
			this.getList()
		},
		methods:{
			async getList(){
				this.loading = true;

				if(this.contacts){	

					this.contactList = this.contacts

				}else{
					let params = {
	                    current_size: this.current_size,
	                    current_page: this.current_page,
	                    search: this.filters.search,
	                    joinWith: ['user'],
	                    status: ['accepted', 'pending']
	                }

					if(this.pageData.pageType == 'buyer'){
						if ( !this.pageData.userData || !this.pageData.userData.id) { this.loading = false; return; }
						params.following_id = this.pageData.userData ? this.pageData.userData.id : null
						params.joinWith = ['user', 'business.category', 'business.industryType']
						await this.getBuyerList(params)

					}
					else{
						if ( !this.pageData.business || !this.pageData.business.id) { this.loading = false; return; }
						business_id: this.pageData.business ? this.pageData.business.id : null
						params.joinWith = ['user']
						await this.getSupplierList(params)
					}
				}

				setTimeout(_ => {
					console.log("this.contact_id", this.contact_id)
					if(this.contact_id){
                    	this.contactSelect(this.contact_id)
                    }
				}, 500)
				this.loading = false;
			},
			async getSupplierList(params) {

                await this.$API.BusinessFollower.getList(params)
                .then(result => {
                    let res = result.data
                    this.contactList = res.list.data;     
                })
                .catch(err => {
                    console.log('Error: ', err)
                })
                return true

			},
			async getBuyerList(params) {

                await this.$API.UserFollower.getList(params)
                .then(result => {
                    let res = result.data
                    this.contactList = res.list.data;     
                })
                .catch(err => {
                    console.log('Error: ', err)
                })
                return true

			},
			changeToListView() {

				if(this.pageData.pageType == 'buyer'){
					this.$router.push({name: 'Buyer Contact List'})
				}
				else{
					this.$router.push({name: 'Supplier Contact List'})
				}
				
			},
			selectContact(val, oldVal) {
				console.log("selectContact", val ,oldVal)
				if((!oldVal || val.id != oldVal.id) && (this.selectedContact && val.id != this.selectedContact.id)){

					this.selectedContact = cloneDeep(val)

					this.$router.push({name: 'Contact Details', params: { contact: val, id : val.id }})
				}
			},
			contactSelect(id){
				let findInd = this.tableList.findIndex(fn => fn.id == id)
				this.selectedContact = findInd >= 0 ? this.tableList[findInd] : this.selectedContact
				this.setCurrentRow(findInd)
			},
			setCurrentRow(index) {
				this.$nextTick(_ => {
					setTimeout(_ => {
						this.$refs.contactTable.setCurrentRow(this.tableList[index])
					}, 200)
				})
			},
			handleClick() {

			},
		},
		computed:{
			tableList(){
				let list = cloneDeep(this.contactList)
				_forEach(list, tl => {
					tl.name = tl.user ? tl.user.first_name + " " + tl.user.last_name : ""
					tl.email = tl.user ? tl.user.email : ""
					tl.phone = tl.user ? tl.user.phone : ""
				})
				return list
			},
			isContact(){
				return this.selectedContact && this.selectedContact.status == 'accepted'
			}
		}
	}
</script>

<style lang="scss">
	.product-detail-view {
		.content-header {
			display: flex;
			align-items: center;
			border-bottom: 1px solid #E9E9E9;

			.search-box {
				width: 300px;
			}
		}

		.content-section {
			margin-top: 10px;
		}
	}
</style>
