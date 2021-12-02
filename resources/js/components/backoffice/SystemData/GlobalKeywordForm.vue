<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeForm"
    	:title="hasModel ? __('Update Keyword') : __('Add New Keyword')"
    	width="60%"
    	top="4vh">
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="modelForm"
    		ref="modelForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
    			<div class="col-md-6">
					<el-form-item
		    			:label="__('Keyword')"
		    			prop="name">
	    				<el-autocomplete
	    					style="width: 100% !important"
							v-if="source"
							value-key="name"
							clearable
						  	v-model="modelForm.name"
						  	:fetch-suggestions="searchKeywords"
						  	:placeholder="__('Enter Keyword')"
	    					class="full-width round-input"
						  	@select="handleSelect"
						  	@change="handleChange">
						</el-autocomplete>

						<el-input
							v-else
	    					class="full-width round-input"
	    					clearable
	    					v-model="modelForm.name"
	    					:placeholder="__('Enter Keyword')">
	    				</el-input>
	    			</el-form-item>

	    			<el-form-item
		    			:label="__('Korean')"
		    			prop="lang_ko">
	    				<el-input
	    					:disabled="isPredefined"
	    					class="full-width round-input"
	    					clearable
	    					v-model="modelForm.lang_ko"
	    					:placeholder="__('Enter Korean Translation')">
	    				</el-input>
	    			</el-form-item>

	    			<el-form-item
		    			:label="__('Chinese')"
		    			prop="lang_zh">
	    				<el-input
	    					:disabled="isPredefined"
	    					class="full-width round-input"
	    					clearable
	    					v-model="modelForm.lang_zh"
	    					:placeholder="__('Enter Chinese Translation')">
	    				</el-input>
	    			</el-form-item>
    			</div>

    			<div class="col-md-6">
    				<el-form-item
		    			:label="__('Japanese')"
		    			prop="lang_zh">
	    				<el-input
	    					:disabled="isPredefined"
	    					class="full-width round-input"
	    					clearable
	    					v-model="modelForm.lang_jp"
	    					:placeholder="__('Enter Japanese Translation')">
	    				</el-input>
	    			</el-form-item>

	    			<el-form-item
		    			:label="__('German')"
		    			prop="lang_de_de">
	    				<el-input
	    					:disabled="isPredefined"
	    					class="full-width round-input"
	    					clearable
	    					v-model="modelForm.lang_de_de"
	    					:placeholder="__('Enter German Translation')">
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
		    	<u>{{ __('Cancel') }}</u>
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
		name: 'GlobalKeywordForm',
		mixins: [formHelper, dialogComponent],
		props: {
			source: {},
			sourceObject: {},
			model: {}
		},
		data() {
			return {
				modelForm: {
					id: null,
					name: null,
					lang_ko: null,
					lang_zh: null,
					lang_jp: null,
					lang_de_de: null,
					from: this.source,
					from_id: this.sourceObject ? this.sourceObject.id : null
				},
				isPredefined: false,
				rules: {
					name: {required: true, message: this.__('This field is required.'), trigger: 'blur'}
				},
				loading: false
			}
		},
		created() {
			if (this.model && this.model.id) {
				this.modelForm = {
					id: this.model.id,
					name: this.model.name,
					lang_ko: this.model.lang_ko,
					lang_zh: this.model.lang_zh,
					lang_jp: this.model.lang_jp,
					lang_de_de: this.model.lang_de_de
				}
			}
		},
		methods: {
			validateForm() {
				this.$refs.modelForm.validate(valid => {
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

				let postData = cloneDeep(this.modelForm)

				this.$API.GlobalKeyword.create(postData)
				.then(res => {
					if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('GLOBAL_KEYWORD_MODULE_ITEM_CREATED', res.data.data)

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

				let postData = cloneDeep(this.modelForm)

				this.$API.GlobalKeyword.update(postData, postData.id)
				.then(res => {
					if (res.data.data) {
						this.$notify({
                			title: this.__("Successful"),
                			message: this.$msg.notif.success_update,
                			type: "success"
                		})

                		this.$EventDispatcher.fire('GLOBAL_KEYWORD_MODULE_ITEM_UPDATED', res.data.data)

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
			searchKeywords(query, cb) {
				if (!query) {
					cb([])

					return
				}

				let postData = {
					from: this.source,
					from_id: this.sourceObject.id
				}

				this.$API.GlobalKeyword.searchKeywords(query, postData)
				.then(res => {
					if (res.data) {
						cb(res.data)

						return
					}

					cb([])
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {})
			},
			handleSelect(keyword) {
				this.isPredefined = true

				keyword = cloneDeep(keyword)

				this.modelForm.id = keyword.id
				this.modelForm.name = keyword.name
				this.modelForm.lang_ko = keyword.lang_ko
				this.modelForm.lang_zh = keyword.lang_zh
				this.modelForm.lang_jp = keyword.lang_jp
				this.modelForm.lang_de_de = keyword.lang_de_de
			},
			handleChange(item) {
				if (this.isPredefined) {
					this.isPredefined = false

					this.modelForm.id = null
					this.modelForm.lang_ko = null
					this.modelForm.lang_zh = null
					this.modelForm.lang_jp = null
					this.modelForm.lang_de_de = null
					this.modelForm.from = this.source
					this.modelForm.from_id = this.sourceObject ? this.sourceObject.id : null
				}
			},
			closeForm() {
				this.$refs.modelForm.clearValidate()
                
                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
			},
			resetForm() {
                this.modelForm = {
					id: null,
					name: null,
					lang_ko: null,
					lang_zh: null,
					lang_jp: null,
					lang_de_de: null,
					from: this.source,
					from_id: this.sourceObject ? this.sourceObject.id : null
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