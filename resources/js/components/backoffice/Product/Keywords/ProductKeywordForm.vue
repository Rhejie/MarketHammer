<template>
	<el-dialog
    :title="hasModel ? __('Edit Product Keyword') : __('New Product Keyword')"
    :visible.sync="showDialog"
    width="45%"
    :before-close="closeFormDialog"
    :close-on-press-escape="false"
    class="model-dialog"
    :close-on-click-modal="false"
    v-loading = "loading"
    append-to-body>
         <el-form ref="modelForm" :model="modelForm" :rules="rules" class="model-form">
            <el-form-item :label="__('Product Keyword')" prop="name">
                <el-input v-model="modelForm.name" :placeholder="__('Product Keyword')"></el-input>
                <value-translator-btn @showTranslationForm = "setTranslationForm('name', modelForm.name, 'text')"></value-translator-btn>
            </el-form-item>
            <el-form-item :label="__('Color')" prop="color">
                <el-input v-model="modelForm.color" :placeholder="__('Color')"></el-input>
            </el-form-item>
        </el-form>
        <span slot="footer">
            <button type="button" class="btn btn-default" @click="closeFormDialog">{{ __("Cancel") }}</button>
            <button type="button" class="btn btn-primary btn-black" @click="validateModelForm">{{ __("Submit") }}</button>
        </span>

	    <value-translator-form
            ref = "translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata = "setTranslationData"
            >
        </value-translator-form>
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../../mixins/formHelper'
	import { dialogComponent } from '../../../../mixins/dialogComponent'
	import translationForm from '../../../../mixins/translationForm.js'

	export default {
		mixins: [dialogComponent, formHelper, translationForm],
		props: {
			model: {},
			parentData:  {
                type: Object,
                required: false
            }
		},
		data() {
			return {
				loading: false,
				modelForm: {
	                name: null,
	                product_id: null,
	                color: null
		        },
		        rules: {
		        	name: [
	                    { required: true, message: this.__('Please input product keyword'), trigger: 'blur' }
	                ]
		        },
		        selectLoading : false,
		        businessSelected : null,
		        companyList : []

			}
		},
		created() {
			this.formFields = ['name']
        	this.fromTable = 'product_keywords'

			if (this.model && this.model.id) {
				this.modelForm = {
		            id: this.model.id,
		            name: this.model.name,
		            color: this.model.color,
		            product_id: this.model.product_id,
		        }

                this.populateDefault(cloneDeep(this.model.translations))
			}
			else{
                this.populateDefault()
				if(this.parentData && this.parentData.id){
					this.modelForm.product_id = this.parentData.id
				}
			}

		},
		methods: {

			validateModelForm() {
				this.$refs['modelForm'].validate((valid) => {
	                if (valid) {
	                	this.resetErrors()

	                	if (this.hasModel) {
	                		this.updateModel()

	                		return
	                	}

	                    this.createModel()
	                }
	            })
			},
			async createModel() {

	            let data = cloneDeep(this.modelForm)
	            this.setCurrrentLangDefaultValue(data)

	       		let savedData = null
	           	await this.$API.ProductKeyword.store(data)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		savedData = res.data
	            	}
	            	else{
	            		res.data.success === false ? this.form.errors = res.data.errors : null

		            	this.$notify({
		                    title: "Failed",
		                    message: this.$msg.notif.failed_add,
		                    type: "error"
		                })
	            	}
	            })
	            .catch(err => {
	            	console.log(err)
	            	this.showValidationError(err);
	            })

	            await this.dataSaved(savedData, 'create')
			},
			async updateModel() {

	            let data = cloneDeep(this.modelForm)
	            this.setCurrrentLangDefaultValue(data)


	            let savedData = null
	            await this.$API.ProductKeyword.update(data, data.id)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		savedData = res.data

	            	    this.loading = false
	            	}
	            	else{

		            	res.data.success === false ? this.form.errors = res.data.errors : null

		            	this.$notify({
		                    title: "Failed",
		                    message: this.$msg.notif.failed_update,
		                    type: "error"
		                })

	            	    this.loading = false
		            }
	            })
	            .catch(err => {
	                console.log(err)
	                this.showValidationError(err);
	            })

	            await this.dataSaved(savedData, 'update')
			},
			async dataSaved(data, mode){

				if(data){
	            	//save translation
	                /*let valueTranslated = await this.saveFieldValueTranslator(data)
	                if(valueTranslated){
	                    data.translator = valueTranslated
	                }*/

	                let msg = "";
	                if(mode == 'create'){
	                	this.$EventDispatcher.fire('KEYWORD_NEW_ITEM_CREATED', data)
	                	msg = this.$msg.notif.success_add
	                }
	                else if(mode == 'update'){
	                	this.$EventDispatcher.fire('KEYWORD_ITEM_UPDATED', data)
	                	msg = this.$msg.notif.success_add
	                }

            		this.$notify({
                        title: 'Success',
	                    message: msg,
	                    type: "success"
	                })
	            	this.closeFormDialog()
	            }

	            this.loading = false
			},
			closeFormDialog() {
				this.resetForm()

				setTimeout(_ => {
					this.$refs.modelForm.clearValidate()
					this.closeModal()
				}, 200)
			},
			resetForm() {
				this.modelForm = {
		            id: null,
		            name: null,
		            description: null,
		            product_id: null,
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
