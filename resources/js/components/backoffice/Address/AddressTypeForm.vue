<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeForm"
    	:title="hasModel ? __('Update Address Type') : __('Add New Address Type')"
    	width="30%"
    	top="4vh">
    	<el-form
    		:rules="rules"
    		:model="addressTypeForm"
    		ref="addressTypeForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
    			<div class="col-md-12">
		    		<el-form-item
		    			:label="__('Address Type')"
		    			prop="name">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Address Type')"
		    				clearable
		    				v-model="addressTypeForm.name">
		    			</el-input>
						<value-translator-btn
							@showTranslationForm="setTranslationForm('name', addressTypeForm.name, 'text')">
						</value-translator-btn>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('Description')"
		    			prop="description">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Description')"
		    				clearable
		    				type="textarea"
		    				:autosize="{ minRows: 2, maxRows: 6}"
		    				v-model="addressTypeForm.description">
		    			</el-input>
						<value-translator-btn
							@showTranslationForm="setTranslationForm('description', addressTypeForm.description, 'textarea')">
						</value-translator-btn>
		    		</el-form-item>
    			</div>
    		</div>
    	</el-form>

    	<span slot="footer" class="dialog-footer">
		    <el-button
		    	type="text"
                :disabled="buttonDisable"
		    	class="text-black"
		    	@click="closeForm">
		    	<u>{{ __("Cancel") }}</u>
		    </el-button>
		    <el-button
		    	round
		    	@click="validateForm"
                :disabled="buttonDisable"
		    	type="primary"
		    	class="btn btn-black">
		    	{{ hasModel ? __('Save') : __('Save') }}
		    </el-button>
		</span>

		<value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData">
        </value-translator-form>
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../mixins/formHelper'
	import { dialogComponent } from '../../../mixins/dialogComponent'
	import translationForm from '../../../mixins/translationForm.js'

	export default {
		name: 'AddressTypeForm',
		mixins: [formHelper, dialogComponent, translationForm],
		props: {
			model: {},
			business: {}
		},
		data() {
			return {
				addressTypeForm: {
					id: null,
					name: null,
					description: null
				},
				rules: {
					name: {required: true, message: this.__('This field is required.'), trigger: 'blur'}
				},
				loading: false,
                buttonDisable: false
			}
		},
		created() {
			this.formFields = ['name', 'description']
            this.fromTable = 'address_type'

			if (this.model && this.model.id) {
				this.addressTypeForm = {
					id: this.model.id,
					name: this.$sf.ucwords(this.model.name),
					description: this.model.description
				}
				this.populateDefault(cloneDeep(this.model.translations))
			}
		},
		methods: {
			validateForm() {
				this.$refs.addressTypeForm.validate(valid => {
                    if (valid) {
                        this.resetErrors()

                        if (this.hasModel) {
                            this.update()

                            return
                        }

                        this.create()
                    }
                })
			},
			create() {
                this.buttonDisable = true
				let postData = cloneDeep(this.addressTypeForm)
				this.setCurrrentLangDefaultValue(postData)

				this.$API.AddressType.create(postData)
				.then(res => {
					if (res.data.data) {
                        this.$notify({
                            title: this.__("Success"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('ADDRESS_TYPE_MODULE_ITEM_CREATED', res.data.data)

                        this.$emit("update_total", 1);
                        this.buttonDisable = false;

                        this.closeForm()

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
			update() {
                this.buttonDisable = true;
				let postData = cloneDeep(this.addressTypeForm)
				this.setCurrrentLangDefaultValue(postData)

				this.$API.AddressType.update(postData, postData.id)
				.then(res => {
					if (res.data.data) {
						this.$notify({
                			title: this.__("Success"),
                			message: this.$msg.notif.success_update,
                			type: "success"
                		})

                		this.$EventDispatcher.fire('ADDRESS_TYPE_MODULE_ITEM_UPDATED', res.data.data)
                        this.buttonDisable = false;
                		this.closeForm()

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
			},
			closeForm() {
				this.$refs.addressTypeForm.clearValidate()

                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
			},
			resetForm() {
                this.addressTypeForm = {
					id: null,
					name: null,
					description: null
				}
            }
		},
		computed: {
			hasModel() {
				return this.model && this.model.id ? true : false
			}
		}
	}
</script>

<style lang="scss">
</style>
