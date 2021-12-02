<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeForm"
    	:title="hasModel ? __('Update Business Finance') : __('Add New Business Finance')"
    	width="30%"
    	top="4vh">
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="financesForm"
    		ref="financesForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
    			<div class="col-md-12">
		    		<el-form-item
		    			:label="__('Year')"
		    			prop="year">
		    			<el-date-picker
			    			v-model="financesForm.year"
			    			type="year"
			    			clearable
			    			value-format="yyyy"
			    			class="full-width"
			    			:placeholder="__('Pick a year')">
			    		</el-date-picker>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('Revenue')"
		    			prop="revenue">
		    			<el-input-number
		    				v-model="financesForm.revenue"
		    				:min="0"
		    				class="full-width">
	    				</el-input-number>
		    		</el-form-item>

		    		<el-form-item
		    			:label="__('EBIT')"
		    			prop="ebit">
		    			<el-input-number
		    				v-model="financesForm.ebit"
		    				:min="0"
		    				class="full-width">
	    				</el-input-number>
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
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../../../mixins/formHelper'
	import { dialogComponent } from '../../../../../mixins/dialogComponent'

	export default {
		name: 'BusinessFinanceForm',
		mixins: [formHelper, dialogComponent],
		props: {
			model: {},
			business: {}
		},
		data() {
			return {
				financesForm: {
					id: null,
					year: null,
					revenue: null,
					ebit: null,
					business_id: this.business ? this.business.id : null
				},
				rules: {
					year: {required: true, message: this.__('This field is required.'), trigger: 'blur'},
					revenue: {required: true, message: this.__('This field is required.'), trigger: 'change'},
					ebit: {required: true, message: this.__('This field is required.'), trigger: 'change'}
				},
				loading: false
			}
		},
		created() {
			if (this.model && this.model.id) {
				this.financesForm = {
					id: this.model.id,
					year: this.model.year.toString(),
					revenue: this.model.revenue,
					ebit: this.model.ebit,
					business_id: this.model.business_id
				}
			}
		},
		methods: {
			validateForm() {
				this.$refs.financesForm.validate(valid => {
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

				let postData = cloneDeep(this.financesForm)

				this.$API.BusinessFinance.create(postData)
				.then(res => {
					if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('BUSINESS_FINANCE_MODULE_ITEM_CREATED', res.data.data)

                        this.$emit("update_total");

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

				let postData = cloneDeep(this.financesForm)

				this.$API.BusinessFinance.update(postData, postData.id)
				.then(res => {
					if (res.data.data) {
						this.$notify({
                			title: this.__("Successful"),
                			message: this.$msg.notif.success_update,
                			type: "success"
                		})

                		this.$EventDispatcher.fire('BUSINESS_FINANCE_MODULE_ITEM_UPDATED', res.data.data)

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
				this.$refs.financesForm.clearValidate()

                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
			},
			resetForm() {
                this.financesForm = {
					id: null,
					year: null,
					revenue: null,
					ebit: null,
					business_id: this.business ? this.business.id : null
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
