<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeForm"
    	:title="hasModel ? __('Update Factory Type') : __('Add New Factory Type')"
    	width="30%"
    	top="4vh">
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="factoryTypeForm"
    		ref="factoryTypeForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
    			<div class="col-md-12">
		    		<el-form-item
		    			:label="__('Factory Type')"
		    			prop="name">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Factory Type')"
		    				clearable
		    				v-model="factoryTypeForm.name">
		    			</el-input>
						<value-translator-btn
							@showTranslationForm="setTranslationForm('name', factoryTypeForm.name, 'text')">
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
		    				v-model="factoryTypeForm.description">
		    			</el-input>
						<value-translator-btn
							@showTranslationForm="setTranslationForm('description', factoryTypeForm.description, 'textarea')">
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
		name: 'FactoryTypeForm',
		mixins: [formHelper, dialogComponent, translationForm],
		props: {
			model: {},
			business: {}
		},
		data() {
			return {
				factoryTypeForm: {
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
            this.fromTable = 'factory_type'

			if (this.model && this.model.id) {
				this.factoryTypeForm = {
					id: this.model.id,
					name: this.$sf.ucwords(this.model.name),
					description: this.model.description
				}
				this.populateDefault(cloneDeep(this.model.translations))
			}
		},
		methods: {
			validateForm() {
				this.$refs.factoryTypeForm.validate(valid => {
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

				let postData = cloneDeep(this.factoryTypeForm)
				this.setCurrrentLangDefaultValue(postData)

				this.$API.FactoryType.create(postData)
				.then(res => {
					if (res.data.data) {

                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('FACTORY_TYPE_MODULE_ITEM_CREATED', res.data.data)

                        this.$emit("update_total", 1);

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

				let postData = cloneDeep(this.factoryTypeForm)
				this.setCurrrentLangDefaultValue(postData)
				
				this.$API.FactoryType.update(postData, postData.id)
				.then(res => {
					if (res.data.data) {
						this.$notify({
                			title: this.__("Successful"),
                			message: this.$msg.notif.success_update,
                			type: "success"
                		})

                		this.$EventDispatcher.fire('FACTORY_TYPE_MODULE_ITEM_UPDATED', res.data.data)

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
				this.$refs.factoryTypeForm.clearValidate()

                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
			},
			resetForm() {
                this.factoryTypeForm = {
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
