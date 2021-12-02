<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeAddressForm"
    	:title="hasModel ? __('Update Address') : __('Add New Address')"
    	width="60%"
    	top="4vh">
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="addressForm"
    		ref="addressForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
    			<div class="col-md-6">
    				<el-form-item
		    			:label="__('Address Type')"
		    			prop="address_type_id">
		    			<el-select
		    				class="full-width round-input"
		    				:placeholder="addressForm.address_type_id !== null ? __('Select Address Type') : __('Unknown')"
		    				filterable
		    				clearable
		    				v-model="addressForm.address_type_id">
		    				<el-option
		    					v-for="addressType in pageData.addressTypes"
		    					:key="addressType.id"
		    					:value="addressType.id"
		    					:label="addressType.name">
		    				</el-option>
		    			</el-select>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('Factory Type')"
		    			prop="factory_type_id">
		    			<el-select
		    				class="full-width round-input"
		    				:placeholder="addressForm.factory_type_id!==null ? __('Select Factory Type') : __('Unknown')"
		    				filterable
		    				clearable
		    				v-model="addressForm.factory_type_id">
		    				<el-option
		    					v-for="factoryType in pageData.factory_type"
		    					:key="factoryType.id"
		    					:value="factoryType.id"
		    					:label="factoryType.name">
		    				</el-option>
		    			</el-select>
		    		</el-form-item>

                    <el-form-item
		    			:label="__('Area Type')"
		    			prop="usage_area_id">
		    			<el-select
		    				class="full-width round-input"
		    				:placeholder="__('Select Area Type')"
		    				filterable
		    				clearable
		    				v-model="addressForm.usage_area_id">
		    				<el-option
		    					v-for="area in pageData.usage_area"
		    					:key="area.id"
		    					:value="area.id"
		    					:label="area.name">
		    				</el-option>
		    			</el-select>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('Lot Area Size (m²)')"
		    			prop="lot_area_size">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Lot Area Size')"
		    				clearable
		    				v-model="addressForm.lot_area_size">
		    			</el-input>
		    		</el-form-item>


		    		<el-form-item
		    			:label="__('Manufacturer Area (m²)')"
		    			prop="manufacturer_area_size">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Manufacturer Area Size')"
		    				clearable
		    				v-model="addressForm.manufacturer_area_size">
		    			</el-input>
		    		</el-form-item>


		    		<el-form-item
		    			:label="__('Incidental Area Size (m²)')"
		    			prop="incidental_area_size">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Incidental Area Size')"
		    				clearable
		    				v-model="addressForm.incidental_area_size">
		    			</el-input>
		    		</el-form-item>


		    		<el-form-item
		    			:label="__('Building Area Size (m²)')"
		    			prop="building_area_size">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Building Area Size')"
		    				clearable
		    				v-model="addressForm.building_area_size">
		    			</el-input>
		    		</el-form-item>
    			</div>

    			<div class="col-md-6">

		    		<el-form-item
		    			:label="__('Phone Number')"
		    			prop="phone">
		    			<el-input
		    				type="number"
		    				class="full-width round-input"
		    				:placeholder="__('Enter Phone Number')"
		    				clearable
		    				v-model="addressForm.phone">
		    			</el-input>
		    		</el-form-item>

    				<el-form-item
		    			:label="__('Street Line 1')"
		    			prop="address_line_1">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Street Line 1')"
		    				clearable
		    				v-model="addressForm.address_line_1">
		    			</el-input>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('Street Line 2')"
		    			prop="address_line_2">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Street Line 2')"
		    				clearable
		    				v-model="addressForm.address_line_2">
		    			</el-input>
		    		</el-form-item>

		    		<div class="row">
		    			<div class="col-md-6">
		    				<el-form-item
				    			prop="city">
				    			<!-- <el-input
				    				class="full-width round-input"
				    				:placeholder="__('Enter City')"
				    				clearable
				    				v-model="addressForm.city">
				    			</el-input> -->
								<span slot="label">
									{{ __('City') }}
									<el-tooltip
										v-if="!addressForm.country_id"
										effect="dark"
										:content="__('You need to select a state/country first.')"
										placement="top">
										<i class="el-icon-question"></i>
									</el-tooltip>
								</span>

								<el-select
				    				v-loading="hasModel && gettingCities"
				    				:disabled="!addressForm.country_id"
				    				class="full-width round-input"
				    				:placeholder="__('Select City')"
				    				filterable
									allow-create
				    				clearable
				    				:loading="gettingCities"
				    				:loading-text="__('Retreiving cities...')"
				    				v-model="addressForm.city">
				    				<el-option
				    					v-for="city in filteredCities"
				    					:key="city.id"
				    					v-bind:value="city.name"
				    					:label="__($sf.removeDiacritics(city.name))">
				    				</el-option>
				    			</el-select>
				    		</el-form-item>

				    		<el-form-item
				    			prop="state_id">
				    			<span slot="label">
									{{ __('Province/State') }}
									<el-tooltip
										v-if="!addressForm.country_id"
										effect="dark"
										:content="__('You need to select a country first.')"
										placement="top">
										<i class="el-icon-question"></i>
									</el-tooltip>
								</span>

				    			<el-select
				    				v-loading="hasModel && gettingStates"
				    				:disabled="!addressForm.country_id"
				    				class="full-width round-input"
				    				:placeholder="__('Select Province/State')"
				    				filterable
				    				clearable
				    				:loading="gettingStates"
				    				:loading-text="__('Retreiving states...')"
				    				v-model="addressForm.state_id"
				    				@change="stateChange(addressForm.state_id)">
				    				<el-option
				    					v-for="state in states"
				    					:key="state.id"
				    					:value="state.id"
				    					:label="__dt( state.translations, 'name', state.name )">
				    				</el-option>
				    			</el-select>
				    		</el-form-item>
		    			</div>
		    			<div class="col-md-6">
		    				<el-form-item
				    			:label="__('Country')"
				    			prop="country_id">
				    			<el-select
				    				class="full-width round-input"
				    				:placeholder="__('Select Country')"
				    				filterable
				    				clearable
				    				v-model="addressForm.country_id"
				    				@change="countryChange(true)">
				    				<el-option
				    					v-for="country in pageData.countries"
				    					:key="country.id"
				    					:value="country.id"
				    					:label="__dt( country.translations, 'name', country.name )">
				    				</el-option>
				    			</el-select>
				    		</el-form-item>

			    			<el-form-item
				    			:label="__('Zip Code')"
				    			prop="postal">
				    			<el-input
				    				type="number"
				    				class="full-width round-input"
				    				:placeholder="__('Enter Zip Code')"
				    				clearable
				    				v-model="addressForm.postal">
				    			</el-input>
				    		</el-form-item>
		    			</div>
		    		</div>

		    		<el-form-item
                        :label="__('Complex Type')"
                        prop="complex_type_id">
                        <el-select
                            v-model="addressForm.complex_type_id"
                            filterable
                            :placeholder="__('Select')"
                            class="full-width">
                            <el-option
                                v-for="item in pageData.complex_type"
                                :key="item.id"
                                :label="__dt(item.translations, 'name', item.name)"
                                :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item
                        :label="__('Complex Location')"
                        prop="complex_location_id">
                        <el-select
                            v-model="addressForm.complex_location_id"
                            filterable
                            :placeholder="__('Select')"
                            class="full-width">
                            <el-option
                                v-for="item in pageData.complex_location"
                                :key="item.id"
                                :label="__dt(item.translations, 'name', item.name)"
                                :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
    			</div>
    		</div>
    	</el-form>

    	<span slot="footer" class="dialog-footer">
		    <el-button
		    	type="text"
		    	class="text-black"
		    	@click="closeAddressForm">
		    	<u>{{ __('Cancel') }}</u>
		    </el-button>
		    <el-button
		    	round
		    	@click="validateForm"
		    	type="primary"
		    	class="btn btn-black">
		    	{{ __('Save') }}
		    </el-button>
		</span>
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import deburr from 'lodash/deburr'
	import { formHelper } from '../../../../../mixins/formHelper'
	import { dialogComponent } from '../../../../../mixins/dialogComponent'
	import csc from 'country-state-city'
	import { ICountry, IState, ICity } from 'country-state-city'

	export default {
		name: 'CompanyAddressForm',
		mixins: [dialogComponent, formHelper],
		props: {
			model: {} ,
			pageData: {
				type: Object,
				required: true
			},
			business: {}
		},
		data() {
			return {
				loading: false,
				addressForm: {
					id: null,
					address_type_id: null,
					factory_type_id: null,
                    usage_area_id: null,
					lot_area_size: null,
					manufacturer_area_size: null,
					incidental_area_size: null,
					building_area_size: null,
					address_line_1: null,
					address_line_2: null,
					street: null,
					phone: null,
					postal: null,
					country_id: null,
					state_id: null,
					city: null,
					business_id: this.business.id,
					complex_type_id : null,
					complex_location_id : null
				},
				rules: {
					// address_type_id: {required: true, message: this.__('Address type field is required.'), trigger: 'blur'},
					// factory_type_id: {required: true, message: this.__('Factory type field is required.'), trigger: 'blur'}
				},
                states: [],
                gettingStates: false,
                factorytypes: this.pageData.factory_type,
            	complexType: this.pageData.complex_type,
            	complexLocation: this.pageData.complex_location,
				cities: null,
				selectedCountry: [],
				selectedState: [],
				filteredCities: null,
				gettingCities: false
			}
		},
        watch: {
            states(oldStates,newStates) {
                if(newStates != oldStates) {
                    return this.states;
                }
            }
        },
		created() {
            console.log(this.pageData);
			if (this.model && this.model.id) {
				this.addressForm = {
					id: this.model.id,
					address_type_id: this.model.address_type_id,
                    usage_area_id: this.model.usage_area_id,
					factory_type_id: this.model.factory_type_id,
					lot_area_size: this.model.lot_area_size,
					manufacturer_area_size: this.model.manufacturer_area_size,
					incidental_area_size: this.model.incidental_area_size,
					building_area_size: this.model.building_area_size,
					address_line_1: this.model.address_line_1,
					address_line_2: this.model.address_line_2,
					street: this.model.street,
					phone: this.model.phone,
					postal: this.model.postal,
					country_id: this.model.country_id,
					state_id: this.model.state_id,
					city: this.model.city,
					business_id: this.business.id,
					complex_type_id: this.model.complex_type_id,
					complex_location_id: this.model.complex_location_id
				}

				if (this.model.country_id) {
					this.countryChange()
				}
			}
		},
        beforeMount() {
            //this.loadMetaData();
        },
		methods: {
			stateChange(stateId) {
				if (this.addressForm.city != "") {
					this.addressForm.city = ""
				}
				this.gettingCities = true
				let state = this.states.find(state => state.id == stateId)
				this.selectedState = state
				let countryCities = csc.getCitiesOfCountry(this.selectedCountry.country_code)
				//
				console.log(this.countryCities)
				this.cities = countryCities
				if (this.selectedState) {
					let filter = this.cities.filter(f => f.stateCode == this.selectedState.code)
					if (filter) {
						this.filteredCities = filter
						this.gettingCities = false
					} else {
						this.gettingCities = false
					}
				} else {
					this.filteredCities = this.cities
					this.gettingCities = false
				}
			},
			countryChange(clear = false) {
				if (this.addressForm.country_id) {
					this.selectedCountry = this.pageData.countries.find(country => country.id == this.addressForm.country_id)
					if (this.selectedCountry) {
						this.gettingCities = true
						let countryCities = csc.getCitiesOfCountry(this.selectedCountry.country_code)
						//this.countryCities = [ ...new Set(this.countryCities) ]
						console.log(this.countryCities)
						if (countryCities) {
							this.filteredCities = _.uniqBy(countryCities, function(u) {
													return u.name;
												});
							this.gettingCities = false
						} else {
							this.gettingCities = false
						}
					}
					this.addressForm.state_id = clear ? null : this.addressForm.state_id
					this.getStates(this.addressForm.country_id)
				}
			},
            getStates(data){
                if(data != null) {
                    this.gettingStates = true;
                    this.$API.Utils.getStates(data).then(res => {
                        this.states = res.data.states;
                        this.gettingStates = false;
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
			/*filteredCities() {
				return _.uniqBy(this.countryCities, function(u) {
					return u.name;
				});
			},*/
            getFactoryType() {
                this.$API.FactoryType.getFactoryType().then(res => {
                    this.factorytypes = res.data.factory_types;
                });
            },
			removeDuplicates () {
				this.countryCities = [ ...new Set(this.countryCities) ]
			},
            loadMetaData() {
                let toLoad = [
                    'factory_type',
                    'complex_type',
                    'complex_location',
                ]

                this.$API.Utils.getMetaData(toLoad)
                .then(res => {
                    this.factorytypes = res.data.factory_type;
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {})
            },
			closeAddressForm() {
				this.$refs.addressForm.clearValidate()
				this.resetForm()

				setTimeout(_ => {
					this.closeModal()
				})
			},
			resetForm() {
				this.addressForm = {
					id: null,
					address_type_id: null,
					factory_type_id: null,
					lot_area_size: null,
					manufacturer_area_size: null,
					incidental_area_size: null,
					building_area_size: null,
					address_line_1: null,
					address_line_2: null,
					street: null,
					phone: null,
					postal: null,
					country_id: null,
					state_id: null,
					city: null,
					business_id: this.business.id
				}
			},
			validateForm() {
				this.$refs.addressForm.validate(valid => {
					if (valid) {
						if (this.hasModel) {
							this.updateAddress()

							return
						}

						this.saveNewAddress()
					}
				})
			},
			saveNewAddress() {
				this.loading = true

				let postData = cloneDeep(this.addressForm)

				this.$API.BusinessAddress.createNewAddress(postData)
				.then(res => {
					if (res.data.success) {
						this.$notify({
                			title: this.__("Successful"),
                			message: this.$msg.notif.success_add,
                			type: "success"
                		})

                		this.$EventDispatcher.fire('BUSINESS_ADDRESS_MODULE_ITEM_CREATED', res.data.data)

                		this.closeAddressForm()

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

					this.$notify({
            			title: this.__("Server Error"),
            			message: this.$msg.notif.service_error,
            			type: "error"
            		})
				})
				.finally(_ => {
					this.loading = false
				})
			},
			updateAddress() {
				this.loading = true

				let postData = cloneDeep(this.addressForm)

				this.$API.BusinessAddress.updateAddress(postData, postData.id)
				.then(res => {
					if (res.data.success) {
						this.$notify({
                			title: this.__("Successful"),
                			message: this.$msg.notif.success_update,
                			type: "success"
                		})

                		this.$EventDispatcher.fire('BUSINESS_ADDRESS_MODULE_ITEM_UPDATED', res.data.data)

                		this.closeAddressForm()

						return
					}

					this.$notify({
            			title: this.__("Failed"),
            			message: this.$msg.notif.failed_update,
            			type: "error"
            		})
				})
				.catch(err => {
					console.log(err)

					this.$notify({
            			title: this.__("Server Error"),
            			message: this.$msg.notif.service_error,
            			type: "error"
            		})
				})
				.finally(_ => {
					this.loading = false
				})
			}
		},
		computed: {
			hasModel() {
				return this.model && this.model.id ? true : false
			}
		}
	}
</script>
