<template>
	<el-dialog
        :title="hasModel ? __('Update Contact') : __('Add New Contact')"
        :visible.sync="showDialog"
        width="50%"
        :before-close="closeFormDialog"
        class="create-contact-dialog"
        :close-on-press-escape="false"
        :close-on-click-modal="false"
        top="5vh">
        <el-form
        	ref="contactForm"
        	:model="contactForm"
        	:rules="rules"
        	class="market-hammer-el-form"
        	v-loading="loading">
        	<div class="row">
        		<div class="col-sm-12 col-md-6">
        			 <el-form-item
		            	:label="__('Name')"
		            	prop="name"
		            	:error="hasError('name', true)">
		                <el-input
		                	class="full-width"
		                	v-model="contactForm.name"
		                	:placeholder="__('Name')"
		                	clearable>
		            	</el-input>
		            </el-form-item>

		            <el-form-item
		            	:label="__('Company')"
		            	prop="business_id"
		            	:error="hasError('business_id', true)"
						v-if="!hasBusiness">
		                <el-select
			                v-model="contactForm.business_id"
			                :placeholder="__('Select Business')"
			                class="cluster-dropdown full-width"
			                filterable
			                clearable
			                :disabled="hasModel || hasBusiness">
		                    <el-option
			                    v-for="type in businessList"
			                    :key="type.id"
			                    :label="type.legal_name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>
		            </el-form-item>

		            <el-form-item
		            	:label="__('Title')"
		            	prop="title"
		            	:error="hasError('title', true)">
		                <el-input
		                	class="full-width"
		                	v-model="contactForm.title"
		                	:placeholder="__('Title')"
		                	clearable>
		            	</el-input>
		            </el-form-item>

		            <el-form-item
		            	:label="__('Role')"
		            	prop="role"
		            	:error="hasError('role', true)">
		                <el-select
			                v-model="contactForm.role_id"
			                :placeholder="__('Select Role')"
			                class="cluster-dropdown full-width"
			                filterable
			                clearable>
		                    <el-option
			                    v-for="type in roleList"
			                    :key="type.id"
			                    :label="type.name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>
		            </el-form-item>
        		</div>
        		<div class="col-sm-12 col-md-6">
        			<el-form-item
		            	:label="__('Email')"
		            	prop="email"
		            	:error="hasError('email', true)">
		                <el-input
		                	class="full-width"
		                	v-model="contactForm.email"
		                	:placeholder="__('Enter Email')"
		                	clearable>
		            	</el-input>
		            </el-form-item>
		            <el-form-item
		            	:label="__('Phone')"
		            	prop="phone"
		            	:error="hasError('phone', true)">
		                <el-input
		                	type = "number"
		                	class="full-width"
		                	v-model="contactForm.phone"
		                	:placeholder="__('Enter Phone')"
		                	clearable>
		            	</el-input>
		            </el-form-item>
		            <el-form-item
		            	:label="'Fax'"
		            	prop="fax"
		            	:error="hasError('fax', true)">
		                <el-input
		                	type = "number"
		                	class="full-width"
		                	v-model="contactForm.fax"
		                	:placeholder="__('Enter Fax')"
		                	clearable>
		            	</el-input>
		            </el-form-item>
		            <el-form-item
		            	class = "el-form-checkbox"
		            	label=""
		            	prop="is_president"
		            	:error="hasError('is_president', true)">
		                <el-checkbox
		                	v-model="contactForm.is_president"
		                	:true-label="1"
		                	:false-label="0">
		                	{{ __('President') }}
		                </el-checkbox>
		            </el-form-item>
		            <el-form-item
		            	class = "el-form-checkbox"
		            	label=""
		            	prop="is_primary"
		            	:error="hasError('is_primary', true)">
		                <el-checkbox
		                	v-model="contactForm.is_primary"
		                	:true-label="1"
		                	:false-label="0">
		                	{{ __('Set as primary contact') }}
		                </el-checkbox>
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
                @click="validateContactForm">
                {{ hasModel ? __('Save') : __('Save') }}
            </button>
        </span>
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../mixins/formHelper'
	import { dialogComponent } from '../../../mixins/dialogComponent'

	export default {
		name: 'BusinessContactForm',
		mixins: [dialogComponent, formHelper],
		props: {
			model: {},
			businessList: {},
			parentData: {},
			business: {},
			pageData: {}
		},
		data() {
			return {
				loading: false,
				contactForm: {
		            id: null,
		            name: null,
		            business_id: null,
		            title: null,
		            role_id: null,
		            email: null,
		            phone: null,
		            fax: null,
		            is_president: 0,
		            is_primary: 0
		        },
		        rules: {
		        	name: {required: true, message: this.__('Contact Name is required.'), trigger: 'blur'},
		        	business_id: {required: true, message: this.__('Business field is required.'), trigger: 'change'},
		        	email: {type: 'email', message: this.__('Please input correct email address.'), trigger: ['blur', 'change']}
		        },
		        roleList : this.pageData && this.pageData.roles ? this.pageData.roles : []
			}
		},
		created() {
			if (this.model && this.model.id) {
				this.contactForm = {
		            id: this.model.id,
		            name: this.model.name,
		            business_id: this.model.business_id,
		            title: this.model.title,
		            role_id: this.model.role_id,
		            email: this.model.email,
		            phone: this.model.phone,
		            fax: this.model.fax,
		            is_president: Number(this.model.is_president),
		            is_primary: Number(this.model.is_primary)
		        }
			}
			else {
				if (this.business && this.business.id) {
					this.contactForm.business_id = this.business.business_id
				}
			}

			if (this.business && this.business.id) {
				this.contactForm.business_id = cloneDeep(this.business.id)
			}

		},
		methods: {
			validateContactForm() {
				this.$refs['contactForm'].validate((valid) => {
	                if (valid) {
	                	this.resetErrors()

	                	if (this.hasModel) {
	                		this.updateContact()

	                		return
	                	}

	                    this.createContact()
	                }
	            })
			},
			createContact() {
	            this.loading = true;

	            this.$API.BusinessContact.storeBusinessContact(this.contactForm)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		this.$EventDispatcher.fire('BUSINESS_CONTACT_NEW_ITEM_CREATED', res.data)

	            		this.$notify({
		                    title: this.__("Success"),
		                    message: this.$msg.notif.success_add,
		                    type: "success"
		                })

		                this.closeFormDialog()

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
			},
			updateContact() {
	            this.loading = true

	            this.$API.BusinessContact.updateBusinessContact(this.contactForm)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		this.$EventDispatcher.fire('BUSINESS_CONTACT_ITEM_UPDATED', res.data)

	            		this.$notify({
		                    title: this.__("Success"),
		                    message: this.$msg.notif.success_update,
		                    type: "success"
		                })

		                this.closeFormDialog()

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
	                this.showValidationError(err)
	            })
	            .finally(_ => {
	            	this.loading = false
	            })
			},
			closeFormDialog() {
				this.resetForm()

				setTimeout(_ => {
					this.$refs.contactForm.clearValidate()
					this.closeModal()
				}, 200)
			},
			resetForm() {
				this.contactForm = {
		            id: null,
		            name: null,
		            business_id: null,
		            title: null,
		            role: null,
		            email: null,
		            phone: null,
		            fax: null,
		            is_president: 0,
		            is_primary: 0
		        }
			},
			showValidationError(err) {
                let errors = [];
                const h = this.$createElement;
                if(err.response && err.response.status == 422) {
                    if(err.response.data.errors) {
                        for (var key in err.response.data.errors) {
                            errors.push(err.response.data.errors[key][0]);
                        }

                        this.$notify({
                            title: this.__("Error"),
                            message: h('div', { style: 'list-style-type: none' }, errors.map(errmsg => {
                            return h('div', { style: 'list-style-type: none' }, errmsg);
                            })),
                            type: "error"
                        });
                    }
                }
            },
		},
		computed: {
			hasModel() {
				return this.model && this.model.id ? true : false
			},
			hasBusiness() {
				return this.business && this.business.id ? true : false
			}
		},
		watch: {
			'pageData.roles'(newVal) {
				this.roleList = newVal
			},
		}
	}
</script>

<style lang="scss">
	.el-form-item.el-form-checkbox{
		margin-bottom: 0px !important;
	}
	label.el-checkbox {
		font-weight: 100 !important;
		float: left;
	}

</style>
