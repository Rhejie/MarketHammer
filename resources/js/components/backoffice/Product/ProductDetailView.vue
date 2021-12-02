<template>
	<div class="main-detail-view">
		<div class="side-list" v-if = "showList">
			<el-card shadow="never" class="box-card" v-loading="loading">
				<div class="action-header">
					<el-button
						round
						size="small"
						class="btn btn-primary btn-black"
						@click = "addProduct">
						<i class="el-icon-plus"></i> {{ __('Add New Product') }}
					</el-button>

					<div class="secondary-action-buttons list-btn">
						<base-filter-dropdown-box>
						</base-filter-dropdown-box>

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
						v-model="filters.search"
						:placeholder="__('Search')"
						@keypress.enter.native="applyFilter('search')">
						<i slot="suffix" class="el-input__icon el-icon-search"></i>
					</el-input>
				</div>

				<div class="data-section mt-3">
					<el-table
						fit
						:data="products"
						:show-header="false"
						height="78%"
						ref="productTable"
						highlight-current-row
						current-row-key="id"
						row-key="id"
						@current-change="selectProduct">
						<el-table-column>
							<template slot-scope="scope">
								<div class="company-name">
									{{ scope.row.name }}
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
														<i class="fas fa-trash-alt"></i> {{ __('Delete') }}
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

		<div :class = "(showList ? 'side-detail' : '') + ' main-content'">
		<!-- <div class = "side-detail product-main-content"> -->
			<el-card shadow="never" class="box-card header-section">
				<div class="header-inner">
					<h4>{{ selectedProduct ? selectedProduct.name : 'N/A' }}</h4>
					<!-- <span>{{ selectedProduct ? selectedProduct.email : 'N/A' }}</span>
					<span>{{ selectedProduct ? selectedProduct.phone : 'N/A' }}</span> -->
					<!-- <span>{{ selectedProduct ? selectedProduct.address.name : 'N/A' }}</span> -->
				</div>
			</el-card>

			<div class="main-content-section mt-3">
				<el-tabs
					@tab-click="handleClick"
					class="market-hammer-tabs"
					v-model="tabModels.outerTabs">
					<!-- <el-tab-pane label="Activities" name="activities">
						<activities-main-template></activities-main-template>
					</el-tab-pane> -->
					<el-tab-pane :label="__('Overview')" name="overview">
						<product-overview-main-template
							:product="selectedProduct"
							:page-data="pageData"
							:products="products">
						</product-overview-main-template>
					</el-tab-pane>
				</el-tabs>
			</div>
		</div>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'

	export default {
		name: 'ProductDetailView',
		props: {
			isCreate: {
				type: Boolean,
				default: false
			},
			pageData: {
				type: Object,
				required: true
			},
			config: {},
			productData: {}
		},
		data() {
			return {
				loading: false,
				filters: {
					search: null,
				},
				tabModels: {
					outerTabs: 'overview'
				},
				products: [],
				selectedProduct: null,
				showList : this.config.showList !== undefined ? this.config.showList : true
			}
		},

		created() {
			if (this.config.reloadData) {
				this.getProductList()
			} else {
				this.products = cloneDeep(this.config.productList)
			}

			this.$EventDispatcher.listen('PRODUCT_MODULE_ITEM_UPDATED', product => {
				let index = this.products.findIndex(bl => bl.id == product.id)

				if (index > -1) {
					this.products.splice(index, 1, product)
					this.selectedProduct = this.products[index]
				}
			})

			this.$EventDispatcher.listen('PRODUCT_NEW_ITEM_CREATED', data => {
				this.getProductList(data.data)
			})

			this.$EventDispatcher.listen('PRODUCT_ITEM_UPDATE', data => {
				let product = data.data
				let index = this.products.findIndex(bl => bl.id == product.id)
				if (index > -1) {
					this.products.splice(index, 1, product)
					this.selectedProduct = this.products[index]
				}
			})

			/*this.$EventDispatcher.listen('VALUE_TRANSLATOR_SAVED', data => {
				let translator = data.data
				console.log('VALUE_TRANSLATOR_SAVED', translator)
				let index = this.products.findIndex(bl => { return translator.value == bl.name})
				console.log('index', index)
				if (index > -1) {
					let prod = cloneDeep(this.products[index])
					prod.translator = translator
					console.log('prod', prod)
					this.products.splice(index, 1, prod)
					this.$set(this.selectedProduct, 'translator', translator)
					//this.selectedProduct = this.products[index]
				}
			})*/

			this.$EventDispatcher.listen('PRODUCT_NEW_ITEM_CREATED', data => {
				this.getProductList(data.data)
			})

			if(this.productData){
				this.selectedProduct = this.productData
			}
		},
		mounted() {
			if(!this.config.isModal){
				this.setSelectedProductByHash()
			}
		},
		methods: {
			addProduct(){
				this.$EventDispatcher.fire('PRODUCT_SHOW_ADD_FORM')
			},
			getProductList(newData = null) {
				this.loading = true

				let postData = cloneDeep(this.filters)

				this.$API.Product.productList(postData).then(res => {
	                this.products = res.data.product.data;

	                if(this.selectedProduct == null){
	                	this.setSelectedProductByHash()
	                }
	                else if(newData){
	                	this.changeSelected(newData.id)
	                }

	            }).catch(_ => {

	            }).finally(_ => {
	                this.loading = false;
	            });
			},
			handleTableAction(info) {
				if (info.action === 'delete') {
					this.deleteProduct(info.data)
				}
			},
			deleteProduct(product) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                  	confirmButtonText: this.__('Delete'),
                  	cancelButtonText: this.__('Cancel'),
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true;

                    this.$API.Product.destroy(product.id)
                    .then(res => {
                    	if (res.data) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		let index = this.products.findIndex(co => co.id == product.id)

                    		if (index > -1) {
                    			this.products.splice(index, 1)
                    			this.selectedProduct = null
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
            },
			handleClick() {

			},
			applyFilter() {
				// if (!this.filters.search) return

				this.filters.page = 1

				this.getProductList()

                if(this.filters.search == null) {
                    this.getProductList();
                }
			},
			selectProduct(val, oldVal) {
				this.selectedProduct = cloneDeep(val)

				if (val) {
	      			window.history.replaceState('', `Market Happer | Products`, `#${val.id}`)
	      		}
			},
			setCurrentRow(index) {
				this.$nextTick(_ => {
					setTimeout(_ => {
						this.$refs.productTable.setCurrentRow(this.products[index])
					}, 200)
				})
			},
			setSelectedProductByHash() {
				let productId = location.hash.substr(1, location.hash.length)[0]
				console.log('productId', productId)

				let changeSelected = this.changeSelected(productId)
				if(changeSelected){
					return
				}

				if (this.products.length) {
					this.setCurrentRow(0)
				}
			},
			changeSelected(productId){
				if (productId) {
					let index = this.products.findIndex(product => product.id == productId)

					if (index > -1) {
						let product = cloneDeep(this.products[index])
						this.selectedProduct = product

						this.setCurrentRow(index)
					}

					return true
				}
				return false
			},
			changeToListView() {
				this.$EventDispatcher.fire('PRODUCT_MODULE_CHANGE_TO_LIST_VIEW')
			}
		},
		watch:{
	        productData(newVal){
	        	this.selectedProduct = newVal
	        },
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
	.side-detail.business-main-content {
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
		padding-left: 20px;
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
</style>
