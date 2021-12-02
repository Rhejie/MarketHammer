<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeForm"
    	:title="hasModel ? __('Update Translation') : __('Add New Translation')"
    	width="60%"
    	top="4vh">
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="transForm"
    		ref="transForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
    			<div class="col-md-6">
		    		<el-form-item
		    			:label="__('Default Text (English)')"
		    			prop="en">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter English Text')"
		    				clearable
		    				v-model="transForm.en">
		    			</el-input>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('Code')"
		    			prop="key">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Translation Code')"
		    				clearable
		    				disabled
		    				v-model="transForm.key">
		    			</el-input>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('Korean')"
		    			prop="ko">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Korean Text')"
		    				clearable
		    				v-model="transForm.ko">
		    			</el-input>
		    		</el-form-item>
    			</div>

    			<div class="col-md-6">
    				<el-form-item
		    			:label="__('Chinese')"
		    			prop="zh">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Chinese Text')"
		    				clearable
		    				v-model="transForm.zh">
		    			</el-input>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('Japanese')"
		    			prop="jp">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter Japanese Text')"
		    				clearable
		    				v-model="transForm.jp">
		    			</el-input>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('German')"
		    			prop="de_de">
		    			<el-input
		    				class="full-width round-input"
		    				:placeholder="__('Enter German Text')"
		    				clearable
		    				v-model="transForm.de_de">
		    			</el-input>
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
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../mixins/formHelper'
	import { dialogComponent } from '../../../mixins/dialogComponent'

	export default {
		name: 'TranslationForm',
		mixins: [formHelper, dialogComponent],
		props: {
			model: {}
		},
		data() {
			return {
				transForm: {
					id: null,
					en: null,
					ko: null,
					zh: null,
					jp: null,
					de_de: null
				},
				rules: {
					en: {required: true, message: this.__('This field is required.'), trigger: 'blur'}
				},
				loading: false
			}
		},
		created() {
			if (this.model && this.model.id) {
				this.transForm = {
					id: this.model.id,
					en: this.model.en,
					ko: this.model.ko,
					zh: this.model.zh,
					jp: this.model.jp,
					de_de: this.model.de_de
				}
			}
		},
		methods: {
			validateForm() {
				this.$refs.transForm.validate(valid => {
                    if (valid) {
                        this.resetErrors()

                        if (this.hasModel) {
                            this.updateTranslation()

                            return
                        }

                        this.saveNewTranslation()
                    }
                })
			},
			saveNewTranslation() {

				let postData = cloneDeep(this.transForm)

				this.$API.Translation.create(postData)
				.then(res => {
					if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('TRANSLATION_MODULE_ITEM_CREATED', res.data.data)

                        this.$emit('update_total');

                        this.closeForm()

                        return
                    }

                    this.$notify({
                        title: "Failed",
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
			updateTranslation() {
				this.loading = true

				let postData = cloneDeep(this.transForm)

				this.$API.Translation.update(postData, postData.id)
				.then(res => {
					if (res.data.data) {
						this.$notify({
                			title: this.__("Successful"),
                			message: this.$msg.notif.success_update,
                			type: "success"
                		})

                		this.$EventDispatcher.fire('TRANSLATION_MODULE_ITEM_UPDATED', res.data.data)

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
				this.$refs.transForm.clearValidate()

                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
			},
			resetForm() {
                this.transForm = {
					id: null,
					en: null,
					ko: null,
					zh: null,
					jp: null,
					de_de: null
				}
            }
		},
		computed: {
			hasModel() {
				return this.model && this.model.id ? true : false
			}
		},
		watch: {
			'transForm.en'(val) {
				this.transForm.key = val
			}
		}
	}
</script>
