<template>
	<el-dialog
        :title="hasModel ? __('Update Partner') : __('Add New Partner')"
        :visible.sync="showDialog"
        width="50%"
        :before-close="closeFormDialog"
        class="create-partner-dialog"
        :close-on-press-escape="false"
        :close-on-click-modal="false"
        top="5vh">
        <el-form
        	ref="partnerForm"
        	:model="partnerForm"
        	:rules="rules"
        	class="market-hammer-el-form"
        	v-loading="loading">
        	<div class="row">
        		<div class="col-sm-12 col-md-6">
        			 <el-form-item
		            	:label="__('Company Name')"
		            	prop="company_name"
		            	:error="hasError('company_name', true)">
		            	<el-input
		            		v-if = "hasModel"
		                	class="full-width"
		                	v-model="partnerForm.company_name"
		                	:placeholder="__('Enter company name')"
		                	clearable>
		            	</el-input>

		            	<el-select
		            		v-else
						    v-model="partnerForm.company_name"
						    remote
						    filterable
						    allow-create
						    @change = "selectList"
						    :placeholder="__('Enter company name')"
						    :remote-method="getBusiness"
						    :loading="selectLoading"
						    class="cluster-dropdown full-width">
						    <el-option
						      v-for="item in companyList"
						      :key="item.id"
						      :label="item.legal_name"
						      :value="item.id">
						    </el-option>
						</el-select>

		            </el-form-item>

		            <el-form-item
		            	v-if = "!parentData || (!parentData && !hasModel)"
		            	:label="__('Business')"
		            	prop="business_id"
		            	:error="hasError('business_id', true)">
		                <el-select
			                v-model="partnerForm.business_id"
			                :placeholder="__('Select Business')"
			                class="cluster-dropdown full-width"
			                filterable
			                clearable
			                :disabled = "hasModel">
		                    <el-option
			                    v-for="type in businessList"
			                    :key="type.id"
			                    :label="type.legal_name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>


		            </el-form-item>

		            <el-form-item
		            	:label="__('Type')"
		            	prop="type"
		            	:error="hasError('type', true)">
		                <el-input
		                	class="full-width"
		                	v-model="partnerForm.type"
		                	:placeholder="__('Enter type')"
		                	clearable>
		            	</el-input>
		            </el-form-item>

		            <el-form-item
		            	:label="__('Partner Since')"
		            	prop="partner_since"
		            	:error="hasError('partner_since', true)">
		            	<el-date-picker
		            		class="full-width"
					      	v-model="partnerForm.partner_since"
					      	type="date"
					      	:placeholder="__('Select date')">
					    </el-date-picker>
		            </el-form-item>

		            <el-form-item
		            	:label="__('Website')"
		            	prop="website"
		            	:error="hasError('website', true)">
		                <el-input
		                	class="full-width"
		                	v-model="partnerForm.website"
		                	:placeholder="__('Enter website')"
		                	clearable>
		            	</el-input>
		            </el-form-item>
        		</div>
        		<div class="col-sm-12 col-md-6">

        			<el-form-item
		            	:label="__('Contact Person') "
		            	prop="contact_person"
		            	:error="hasError('contact_person', true)">
		                <el-input
		                	class="full-width"
		                	v-model="partnerForm.contact_person"
		                	:placeholder="__('Enter contact name')"
		                	clearable>
		            	</el-input>
		            </el-form-item>
		            <el-form-item
		            	:label="__('Contact Email')"
		            	prop="contact_email"
		            	:error="hasError('contact_email', true)">
		                <el-input
		                	class="full-width"
		                	v-model="partnerForm.contact_email"
		                	:placeholder="__('Enter contact email')"
		                	clearable>
		            	</el-input>
		            </el-form-item>
		            <el-form-item
		            	:label="__('Contact Phone')"
		            	prop="contact_phone"
		            	:error="hasError('contact_phone', true)">
		                <el-input
		                	type = "number"
		                	class="full-width"
		                	v-model="partnerForm.contact_phone"
		                	:placeholder="__('Enter contact phone')"
		                	clearable>
		            	</el-input>
		            </el-form-item>
        		</div>
        	</div>
        </el-form>
        <span slot="footer">
            <button
                type="button"
                class="btn btn-default"
                @click="closeFormDialog">
                {{ __('Cancel') }}
            </button>
            <button
                type="button"
                class="btn btn-primary btn-black"
                @click="validatePartnerForm">
                {{ __("Save") }}
            </button>
        </span>
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../mixins/formHelper'
	import { dialogComponent } from '../../../mixins/dialogComponent'

	export default {
		name: 'BusinessPartnerForm',
		mixins: [dialogComponent, formHelper],
		props: {
			model: {},
			businessList: {},
			parentData:  {
                type: Object,
                required: false
            }
		},
		data() {

			return {
				loading: false,
				partnerForm: {
		            id: null,
		            company_name: null,
		            business_id: null,
		            type: null,
		            partner_since: null,
		            website: null,
		            contact_person: null,
		            contact_email: null,
		            contact_phone: null,
		        },
		        rules: {},
		        selectLoading : false,
		        businessSelected : null,
		        companyList : []

			}
		},
		created() {
			var validateWebsite = (rule, value, callback) => {
		        if (value === '' || value == null) {
		          	callback();
		        } else {
		        	let validatUrl = this.$sf.validateURL(value)
		          	if (!validatUrl) {
		            	callback(new Error(this.__('Please input valid website address.')));
		          	}
		          	callback();
		        }
		    };
			this.rules = {
        		company_name: {required: true, message: this.__('Company Name is required.'), trigger: 'blur'},
        		business_id: {required: true, message: this.__('Business field is required.'), trigger: 'change'},
        		contact_email: {type: 'email', message: this.__('Please input correct email address.'), trigger: ['blur', 'change']},
	          	website: { validator: validateWebsite, trigger: 'blur' },
	        }
			if (this.model && this.model.id) {
				this.partnerForm = {
		            id: this.model.id,
		            company_name: this.model.company_name,
		            business_id: this.model.business_id,
		            type: this.model.type,
		            website: this.model.website,
		            partner_since: this.model.partner_since,
		            contact_person: this.model.contact_person,
		            contact_email: this.model.contact_email,
		            contact_phone: this.model.contact_phone
		        }
			}
			else{
				if(this.parentData && this.parentData.id){
					this.partnerForm.business_id = this.parentData.id
				}
			}

		},
		methods: {
			getBusiness(query){
				this.selectLoading = true
				this.businessSelected = null

				let postData = {searchString : query}

				this.$API.BusinessList.getBusinessList(postData)
				.then(res => {
					if (res.data.success) {
						this.companyList = res.data.data
					}

				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.selectLoading = false
				})
			},
			selectList(val){
				console.log('selectList', val)
				this.businessSelected = this.companyList.find(fn => fn.id == val)
			},
			validatePartnerForm() {
				this.$refs['partnerForm'].validate((valid) => {
	                if (valid) {
	                	this.resetErrors()

	                	if (this.hasModel) {
	                		this.updatePartner()

	                		return
	                	}

	                    this.createPartner()
	                }
	            })
			},
			createPartner() {
	            this.loading = true;

	            let data = cloneDeep(this.partnerForm)
	            data.partner_since ? data.partner_since = this.$df.formatDate(data.partner_since, "YYYY-MM-DD") : null

				let getName = this.companyList.find(fn => fn.id == data.company_name)
				data.company_name = getName ? getName.legal_name : data.company_name


	            this.$API.BusinessPartner.storeBusinessPartner(data)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		this.$EventDispatcher.fire('BUSINESS_PARTNER_NEW_ITEM_CREATED', res.data)

	            		this.$notify({
		                    title: this.__("Success"),
		                    message: this.$msg.notif.success_add,
		                    type: "success"
		                })

		                this.closeFormDialog()

		                //Save company name
		                this.createCompany(data.company_name)

	            		return
	            	}

	            	res.data.success === false ? this.form.errors = res.data.errors : null

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
	                    message: this.$msg.notif.server_error,
	                    type: "error"
	                })
	            })
	            .finally(_ => {
	            	this.loading = false
	            })
			},
			createCompany(name){
				if(this.businessSelected){
					return
				}

				this.loading = false
				let data = {
					name : name
				}
				console.log('name', name, data)
				this.$API.Company.storeCompany(data)
	            .then(result => {

	            })
	            .catch(err => {
	            	console.log(err)
	            })
	            .finally(_ => {
	            	this.loading = false
	            })
			},
			updatePartner() {
	            this.loading = true

	            let data = cloneDeep(this.partnerForm)
	            data.partner_since ? data.partner_since = this.$df.formatDate(data.partner_since, "YYYY-MM-DD") : null

	            this.$API.BusinessPartner.updateBusinessPartner(data, data.id)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		this.$EventDispatcher.fire('BUSINESS_PARTNER_ITEM_UPDATED', res.data)

	            		this.$notify({
		                    title: this.__("Success"),
		                    message: this.$msg.notif.success_update,
		                    type: "success"
		                })

		                this.closeFormDialog()

	            		return
	            	}

	            	res.data.success === false ? this.form.errors = res.data.errors : null

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
			},
			closeFormDialog() {
				this.resetForm()

				setTimeout(_ => {
					this.$refs.partnerForm.clearValidate()
					this.closeModal()
				}, 200)
			},
			resetForm() {
				this.partnerForm = {
		            id: null,
		            name: null,
		            business_id: null,
		            title: null,
		            role: null,
		            email: null,
		            phone: null,
		            fax: null,
		            is_president: null,
		            is_primary: null
		        }
			}
		},
		computed: {
			hasModel() {
				return this.model && this.model.id ? true : false
			},
		}
	}
</script>

<style lang="scss">
	.el-form-item.el-form-checkbox{
		margin-bottom: 0px !important;
	}

</style>
