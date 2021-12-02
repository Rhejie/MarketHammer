<template>
	<div class="main-container" v-loading="loading">
		<div class="table-container table-container-business-tab">
			<div class="card borderless">
						<div class="card-actions">
							<div class="header-title">
							</div>
							<div class="search-container">
								<el-input
									hidden
									disabled
									:title="__('No function yet')"
									class="input-search"
									:placeholder="__('Type to search')"
									>
									<i hidden slot="suffix" class="el-input__icon el-icon-search"></i>
								</el-input>
							</div>
							<div class="secondary-action-buttons">
								<el-button
								disabled
								hidden
								class="mh-btn"
								size="small"
								type="default"
								slot="reference"
								:title="__('Filter')"
								icon="fas fa-filter">
								</el-button>

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
									size="small"
									class="btn  btn-primary btn-black ml-auto"
									@click="showAddressForm = true"
									:disabled="!business">
									<i class="fas fa-plus"></i>  {{ __('Add New Address') }}
								</el-button>
							</div>
						</div>
					<section class="content-section">
						<div class="row">

							<div class="col-md-5">
								<el-card
									shadow="never"
									v-if="businessAddresses.length && business"
									class="p-3 address-item mb-2"
									v-for="address in businessAddresses"
									:key="address.id"
									>
									<div>
										<span>{{ address.address_type ? address.address_type.name : "" }}</span><br>
										<!--span>{{ address.address || 'N/A' }}</span><br-->
										<span>{{ address.address_line_1 || 'N/A' }}, {{ address.city || 'N/A' }}, {{ address.country.name || 'N/A' }}</span><br>
										<span>{{ address.phone || 'N/A' }}</span>
									</div>

									<div class="ml-auto">
										<el-button
											@click="updateAddress(address)"
											type="text">
											<span class="text-black"><u>{{ __('Edit') }}</u></span>
										</el-button>

										<el-button
											@click="deleteCompany(address)"
											class="text-black"
											type="text">
											<span class="text-black"><u>{{ __('Delete') }}</u></span>
										</el-button>

										<el-button
											@click="viewMap(address)"
											class="text-black"
											type="text">
											<span class="text-black"><u>{{ __('View Map') }}</u></span>
										</el-button>

									</div>

									<!--div id="map" style="display:inline-block; width: 57%; height:600px; background-color: red">
									</div-->



								</el-card>

								<div v-if="!businessAddresses.length || !business" class="d-flex justify-content-center align-items-center" style="height: 300px;">
									No Data
								</div>

							</div>

							<business-address-map
								v-if="businessAddresses.length && business"
								:model="addressCoordinates"
								style="display:inline-block;">
							</business-address-map>

						</div>
					</section>


			<business-address-form
				:business="business"
				:page-data="formPageData"
				:model="selectedAddress"
				v-if="showAddressForm"
				:visible.sync="showAddressForm"
				@close="handleClose">
			</business-address-form>
			</div>
		</div>
	</div>
</template>

<script>
import Vue from 'vue';
import cloneDeep from 'lodash/cloneDeep'
import BusinessAddressMap from './map/BusinessAddressMap.vue'

	export default {
  components: { BusinessAddressMap },
		name: 'BusinessAddresses',
		props: {
			pageData: {
				type: Object,
				required: true
			},
			business: {}
		},
		data() {
			return {
				loading: false,
				showAddressForm: false,
				selectedAddress: null,
				selectedMap: null,
				businessAddresses: [],
				formPageData : this.pageData,
				addressCoordinates: [],
			}
		},
		created() {
			this.getBusinessAddresses()

			this.$EventDispatcher.listen('BUSINESS_ADDRESS_MODULE_ITEM_CREATED', address => {
				this.businessAddresses.unshift(address)
			})

			this.$EventDispatcher.listen('BUSINESS_ADDRESS_MODULE_ITEM_UPDATED', address => {
				let index = this.businessAddresses.findIndex(fa => fa.id == address.id)

				if (index > -1) {
					this.businessAddresses.splice(index, 1, address)
				}
			})

			if(!this.pageData.addressTypes || this.pageData.addressTypes==undefined ||
				!this.pageData.factory_types || this.pageData.factory_types==undefined||
				!this.pageData.countries || this.pageData.countries==undefined){
				this.loadMetaData()
			}

		},
		mounted(){
			console.log(this.businessAddresses[0])
		},
		methods: {
			loadMetaData() {
                let toLoad = [
                    'address_types',
                    'factory_type',
                    'countries',
                    'complex_type',
                    'complex_location',
                ]

                this.$API.Utils.getMetaData(toLoad)
                .then(res => {
                    this.formPageData['addressTypes'] = res.data.address_types
                    this.formPageData['factory_type'] = res.data.factory_type
                    this.formPageData['countries'] = res.data.countries
                    this.formPageData['complex_type'] = res.data.complex_type
                    this.formPageData['complex_location'] = res.data.complex_location
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {})
            },
			getBusinessAddresses() {
				if (!this.business) return

				this.loading = true

				let postData = {
					business_id: this.business.id
				}

				this.$API.BusinessAddress.getBusinessAddresses(postData)
				.then(res => {
					if (Array.isArray(res.data)) {
						this.businessAddresses = res.data

						//code to show the map of the 1st address list. set as default view
						this.selectedMap = cloneDeep(this.businessAddresses[0])

						Vue.$geocoder.setDefaultMode('address');      // this is default
						var addressObj = {
							address_line_1: this.selectedMap.address_line_1,
							address_line_2: this.selectedMap.address_line_2,
							city:           this.selectedMap.city,
							country:        this.selectedMap.country.name
						}
						Vue.$geocoder.send(addressObj, response => {
							this.addressCoordinates = response.results[0].geometry.location
						});
					}
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			updateAddress(address) {
				this.showAddressForm = true
				this.selectedAddress = cloneDeep(address)
			},
			viewMap(address)
			{
				this.selectedMap = cloneDeep(address)
				Vue.$geocoder.setDefaultMode('address');      // this is default
				var addressObj = {
					address_line_1: this.selectedMap.address_line_1,
					address_line_2: this.selectedMap.address_line_2,
					city:           this.selectedMap.city,
					country:        this.selectedMap.country.name
				}
				Vue.$geocoder.send(addressObj, response => {
					this.addressCoordinates = response.results[0].geometry.location
				});
			},
			deleteCompany(address) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Delete Address'), {
	                confirmButtonText: this.__('Delete'),
	                cancelButtonText: this.__('Cancel'),
	                type: 'warning',
	                confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true;

                    this.$API.BusinessAddress.deleteBusinessAddress(address.id)
                    .then(res => {
                    	if (res.data.success) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		let index = this.businessAddresses.findIndex(co => co.id == address.id)

                    		if (index > -1) {
                    			this.businessAddresses.splice(index, 1)
                    			this.selectedAddress = null
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
				this.selectedAddress = null
				this.showAddressForm = false
			}
		},
		watch: {
			'business.id'() {
				this.getBusinessAddresses()
			}
		}
	}
</script>

<style lang="scss">
	.company-addresses-component {
		.address-item {
			.el-card__body {
				display: flex;
				align-items: center;
			}
		}
	}
</style>
