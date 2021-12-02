<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeForm"
    	:title="hasModel ? __('Update Certification Type') : __('Add New Certification Type')"
    	width="30%"
    	top="4vh"
		append-to-parent>
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="certificationTypeForm"
    		ref="certificationTypeForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
    			<div class="col-md-12">
		    		<el-form-item
		    			:label="__('Name')"
		    			prop="name">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Name')"
		    				clearable
		    				v-model="certificationTypeForm.name">
		    			</el-input>

						<value-translator-btn
							@showTranslationForm="setTranslationForm('name', certificationTypeForm.name, 'text')">
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
		    				v-model="certificationTypeForm.description">
		    			</el-input>
						<value-translator-btn
							@showTranslationForm="setTranslationForm('description', certificationTypeForm.description, 'textarea')">
						</value-translator-btn>
		    		</el-form-item>
    			</div>
    		</div>
    	</el-form>

    	<span slot="footer" class="dialog-footer">
		    <el-button
		    	type="text"
		    	class="text-black"
		    	@click="closeForm">
		    	<u>{{ __("Cancel") }}</u>
		    </el-button>
		    <el-button
		    	round
		    	@click="validateForm"
		    	type="primary"
		    	class="btn btn-black">
		    	{{ __("Save") }}
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
		name: 'CertificationTypeForm',
		mixins: [formHelper, dialogComponent, translationForm],
		props: {
			model: {},
			business: {}
		},
		data() {
			return {
				certificationTypeForm: {
					id: null,
					name: null,
					description: null
				},
				rules: {
					name: {required: true, message: this.__('This field is required.'), trigger: 'blur'}
				},
				loading: false
			}
		},
		created() {
			this.formFields = ['name', 'description']
            this.fromTable = 'certification_type'

			if (this.model && this.model.id) {
				this.certificationTypeForm = {
					id: this.model.id,
					name: this.$sf.ucwords(this.model.name),
					description: this.model.description
				}
			}
		},
		methods: {
			validateForm() {
				this.$refs.certificationTypeForm.validate(valid => {
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
				this.loading = true

				let postData = cloneDeep(this.certificationTypeForm)

				this.$API.CertificationType.create(postData)
				.then(res => {
					if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('CERTIFICATION_TYPE_MODULE_ITEM_CREATED', res.data.data)

                        this.$emit('addTotalCertification');

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
				this.loading = true

				let postData = cloneDeep(this.certificationTypeForm)

				this.$API.CertificationType.update(postData, postData.id)
				.then(res => {
					if (res.data.data) {
						this.$notify({
                			title: this.__("Successful"),
                			message: this.$msg.notif.success_update,
                			type: "success"
                		})

                		this.$EventDispatcher.fire('CERTIFICATION_TYPE_MODULE_ITEM_UPDATED', res.data.data)

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
				this.$refs.certificationTypeForm.clearValidate()

                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
			},
			resetForm() {
                this.certificationTypeForm = {
					id: null,
					name: null,
					description: null
				}
            },
            setTranslationForm() {

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
