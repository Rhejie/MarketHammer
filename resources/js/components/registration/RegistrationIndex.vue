<template>
	<div class="registration-index">
		<el-card class="box-card mh__card mt-5 mb-5 registration-form" v-loading="loading">
			<div slot="header" class="clearfix">
				<span class="mh__card-title">Account Setup</span>
			</div>

			<div>
				<div class="mb-3">
					<span class="font-weight-bold">Register as a</span> 
					<el-select
						class="round-input"
						v-model="registrationForm.user_type"
						filterable
						clearable>
						<el-option
							v-for="userType in userTypes"
							:key="userType.id"
							:value="userType.id"
							:label="userType.name">
						</el-option>
					</el-select>
				</div>
			</div>

			<div>
				<el-steps :active="active" finish-status="success">
					<el-step></el-step>
					<el-step></el-step>
					<el-step></el-step>
					<el-step></el-step>
					<el-step></el-step>
					<el-step></el-step>
				</el-steps>

				<h4 class="font-weight-bolder mt-4">SUPPLIER INFORMATION</h4>

				<div class="mt-4">
					<ul class="list-indicators">
						<li :class="active == 1 ? 'list-indicator-active' : ''">User Info</li>
						<li :class="active == 2 ? 'list-indicator-active' : ''">General</li>
						<li :class="active == 3 ? 'list-indicator-active' : ''">Certifications</li>
						<li :class="active == 4 ? 'list-indicator-active' : ''">Products</li>
						<li :class="active == 5 ? 'list-indicator-active' : ''">Histories</li>
						<li :class="active == 6 ? 'list-indicator-active' : ''">Final Details</li>
					</ul>
				</div>

				<div>
					<keep-alive>
						<component 
							:is="components[active - 1]"
							ref="supplierForm"
							:page-data="pageData"
							:next-step="nextStep">
						</component>	
					</keep-alive>
				</div>
			</div>

			<div class="text-right mt-3 mb-3">
				<el-button 
			    	type="text"
			    	class="text-black"
			    	@click="cancelRegistration">
			    	<u> {{ active > 1 ? 'Back' : 'Cancel' }} </u>
			    </el-button>
			    <el-button 
			    	round
			    	@click="validateForm"
			    	type="primary"
			    	class="btn btn-black">
			    	{{ active == 6 ? 'Save' : 'Next' }}
			    </el-button>
		    </div>
		</el-card>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'

	export default {
		name: 'RegistrationIndex',
		props: {
			pageData: {
				type: Object,
				required: true
			}
		},
		data() {
			return {
				registrationForm: {
					user_type: null
				},
				active: 1,
				components: [
					'registration-user-form', 
					'supplier-general-form', 
					'supplier-certification-form', 
					'supplier-product-form', 
					'supplier-history-form', 
					'supplier-final-details-form'
				],
				userData: {},
				loading: false
			}
		},
		methods: {
			cancelRegistration() {
				if (this.active > 1) {
					this.active--
				} else {
					window.location = '/login'
				}
			},
			validateForm() {
				if (this.active == 1 || this.active == 2) {
					let isValid = this.$refs.supplierForm.validateForm()

					return
				}

				this.nextStep()
			},
			nextStep() {
				if (this.active == 1) {
					this.userData = {...this.userData, ...cloneDeep(this.$refs.supplierForm.form)}
				}
				else if (this.active == 2) {
					this.userData.supplierData = cloneDeep(this.$refs.supplierForm.form)
				}
				else if (this.active == 3) {
					this.userData.certifications = cloneDeep(this.$refs.supplierForm.$refs.supplierCertification.businessCertifications)
				}
				else if (this.active == 4) {
					this.userData.products = cloneDeep(this.$refs.supplierForm.$refs.supplierProduct.$refs.productList.productData)
				}

				if (this.active == 6) {
					this.createNewSupplier()

					return
				}

				this.active++
			},
			createNewSupplier() {
				let postData = cloneDeep(this.userData)
				delete postData.errors
				let files = postData.certifications.map(cert => cert.files)

				let form = new FormData()

				for (let key in postData) {
					if (key === 'certifications') {
						for (let [certIndex, cert] of postData[key].entries()) {
							for (let certKey in cert) {
								if (certKey === 'files') {
									for (let [oIndex, x] of cert.files.entries()) {
										form.append(`certifications[${certIndex}][${certKey}][${oIndex}]`, x.raw)
									}
								} else {
									form.append(`certifications[${certIndex}][${certKey}]`, cert[certKey])
								}
							}
						}
					}
					else if (key === 'products') {
						for (let [prodIndex, prod] of postData[key].entries()) {
							for (let prodKey in prod) {
								form.append(`products[${prodIndex}][${prodKey}]`, prod[prodKey])
							}
						}
					}
					else if (key === 'supplierData') {
						for (let sup in postData[key]) {
							form.append(`supplierData[${sup}]`, postData[key][sup])
						}
					} else {
						form.append(key, postData[key])
					}
				}

				this.loading = true

				this.$API.Registration.createNewSupplier(form)
				.then(res => {
					if (res.data) {
						window.location = '/login'
					}
				})
				.catch(err => {
					if (err.response.status == 422) {
						this.$notify({
	                        title: "Failed",
	                        message: this.$msg.notif.failed_update,
	                        type: "error"
	                    })

						for (let res in err.response.data) {
							if (this.userData.hasOwnProperty(res)) {
								this.active = 1
								setTimeout(_ => {
									this.$refs.supplierForm.setErrors(err.response.data)	
								}, 200)
							}
							else if (this.userData.supplierData.hasOwnProperty(res)) {
								this.active = 2
								setTimeout(_ => {
									this.$refs.supplierForm.setErrors(err.response.data)	
								}, 200)
							}
						}
					}
				})
				.finally(_ => {
					this.loading = false
				})
			}
		},
		computed: {
			userTypes() {
				let userTypes = cloneDeep(this.pageData.userTypes)

				userTypes = userTypes.filter(ut => ut.id == 2)
				.map(ut => {
					if (ut.name === 'Company') {
						ut.name = 'Supplier'
					}

					return ut
				})

				return userTypes
			}
		}
	}
</script>

<style lang="scss">
	.registration-index {
		width: 100%;
		display: flex;
		justify-content: center;

		.registration-form {
			width: 50%;
		}

		.list-indicators {
			list-style: none;
		    padding-inline-start: 0px !important;
		    margin-block-start: 0em !important;
		    display: flex;
		    justify-content: space-around;
		    font-size: 14px;
		    font-weight: 800;
		    color: #EEA040;
		    height: 30px;

		    .list-indicator-active {
		    	border-bottom: 3px solid;
		    	padding: 0px 30px;
		    }
		}

		.el-step__head.is-success {
			color: #EEA040;
    		border-color: #EEA040;

    		.el-step__icon.is-text {
				border: 0px solid !important;
				background: #EEA040;
				color: #FFF;
			} 
		} 

		.el-step.is-horizontal .el-step__line {
			height: 4px !important;
			top: 14px !important;
		}

		.el-step__icon {
			width: 30px !important;
			height: 30px !important;
		}

		.el-step__line-inner {
			border-width: 2px !important;
		}

		.el-step__icon.is-text {
			border: 3px solid !important;
		} 
	}
</style>