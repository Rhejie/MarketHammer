<template>
	<el-dialog
        :title="hasModel ? __('Update Category') : __('Add New Category')"
        :visible.sync="showDialog"
        width="50%"
        :before-close="closeFormDialog"
        class="create-category-dialog"
        :close-on-press-escape="false"
        :close-on-click-modal="false"
        top="5vh">
        <el-form
        	ref="categoryForm"
        	:model="categoryForm"
        	:rules="rules"
        	class="market-hammer-el-form"
        	v-loading="loading">
        	<div class="row">
        		<div class="col-sm-12 col-md-12">
        			 <el-form-item
		            	:label="__('Category Name')"
		            	prop="name"
		            	:error="hasError('name', true)">
		                <el-input
		                	class="full-width"
		                	v-model="categoryForm.name"
		                	:placeholder="__('Category Name')"
		                	clearable>
		            	</el-input>

		            	<value-translator-btn
	                        @showTranslationForm="setTranslationForm('name', categoryForm.name, 'text')">
	                    </value-translator-btn>
		            </el-form-item>

		            <el-form-item
		            	v-if = "!hasModel || (hasModel && modelCategory.masterName)"
		            	:label="__('Master Product Category')"
		            	prop="master_product_category_id"
		            	:error="hasError('master_product_category_id', true)">
		                <el-select
		                	v-if = "!hasModel"
			                v-model="categoryForm.master_product_category_id"
			                :placeholder="__('Select Category')"
			                class="cluster-dropdown full-width"
			                filterable
			                clearable
			                @change = "changeMaster"
			                :disabled = "hasModel">
		                    <el-option
			                    v-for="type in masterSelection"
			                    :key="type.id"
			                    :label="type.name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>

		                <el-input
		                	v-else-if = "hasModel && modelCategory.masterName"
		                	class="full-width"
		                	v-model="modelCategory.masterName"
		                	:placeholder="__('No Master Category')"
		                	disabled>
		            	</el-input>

		            </el-form-item>

		            <el-form-item
		            	v-if = "!hasModel || (hasModel && modelCategory.mainName)"
		            	:label="__('Main Product Category')"
		            	prop="main_product_category_id"
		            	:error="hasError('main_product_category_id', true)">
		                <el-select
		                	v-if = "!hasModel"
			                v-model="categoryForm.main_product_category_id"
			                :placeholder="__('Select Category')"
			                class="cluster-dropdown full-width"
			                filterable
			                clearable
			                :disabled = "hasModel">
		                    <el-option
			                    v-for="type in mainSelection"
			                    :key="type.id"
			                    :label="type.name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>

		                <el-input
		                	v-else-if = "hasModel && modelCategory.mainName"
		                	class="full-width"
		                	v-model="modelCategory.mainName"
		                	:placeholder="__('No Main Category')"
		                	disabled>
		            	</el-input>

		            </el-form-item>

	                <el-form-item
	                	:label="__('Description')"
	                	prop="description">
	                    <el-input
	                    	type="textarea"
	                    	:rows="3"
	                    	v-model="categoryForm.description"
	                    	:placeholder="__('Description')">
                    	</el-input>

                    	<value-translator-btn
	                        @showTranslationForm="setTranslationForm('description', categoryForm.description, 'textarea')">
	                    </value-translator-btn>
	                </el-form-item>

		            <!-- <el-form-item
		            	label="Sub Product Category"
		            	prop="sub_product_category_id"
		            	:error="hasError('sub_product_category_id', true)">
		                <el-select
			                v-model="categoryForm.sub_product_category_id"
			                placeholder="Select Category"
			                class="cluster-dropdown full-width"
			                filterable
			                clearable
			                :disabled = "hasModel">
		                    <el-option
			                    v-for="type in subSelection"
			                    :key="type.id"
			                    :label="type.name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>
		            </el-form-item> -->
        		</div>
        	</div>
        </el-form>
        <span slot="footer">
            <button
                type="button"
                class="btn btn-default"
                @click="closeFormDialog">
                {{ __("Cancel") }}
            </button>
            <button
                type="button"
                class="btn btn-primary btn-black"
                @click="validateCategoryForm">
                {{ hasModel ? __('Save') : __('Save') }}
            </button>
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
	import _forEach from 'lodash/forEach'
	import { formHelper } from '../../../../mixins/formHelper'
	import { dialogComponent } from '../../../../mixins/dialogComponent'
    import translationForm from '../../../../mixins/translationForm.js'

	export default {
		name: 'ProductCategoryForm',
		mixins: [dialogComponent, formHelper, translationForm],
		props: {
			model: {},
			productCategories: {},
			parentData: {}
		},
		data() {
			let modelCategory = this.model
			if(modelCategory){
				modelCategory.masterName = this.model.master_parent ? this.model.master_parent.name : null
				modelCategory.mainName = this.model.main_parent ? this.model.main_parent.name : null
				modelCategory.subName = this.model.sub_parent ? this.model.sub_parent.name : null
			}
			return {
				modelCategory : modelCategory,
				loading: false,
				categoryForm: {
		            id: null,
		            name: null,
		            description : null,
		            master_product_category_id: null,
		            main_product_category_id: null,
		            sub_product_category_id: null,
		        },
		        rules: {
		        	name: {required: true, message: this.__('Product Category Name is required.'), trigger: 'blur'},
		        	industry_type_id: {required: true, message: this.__('Industry Type field is required.'), trigger: 'change'}
		        },
		        categoryList : cloneDeep(this.productCategories)
			}
		},
		created() {
			this.formFields = ['name', 'description']
            this.fromTable = 'product_categories'

			if (this.model && this.model.id) {
				this.categoryForm = {
		            id: this.model.id,
		            name: this.$sf.ucwords(this.model.name),
		            description: this.model.description,
		            master_product_category_id: this.model.master_product_category_id,
		            main_product_category_id: this.model.main_product_category_id,
		            sub_product_category_id: this.model.sub_product_category_id,
		        }

		        this.populateDefault(cloneDeep(this.model.translations))
			} else {
				if(this.parentData && this.parentData.id){
					if(this.parentData.main_product_category_id){
						this.categoryForm.master_product_category_id = this.parentData.master_product_category_id
						this.categoryForm.main_product_category_id = this.parentData.main_product_category_id
						this.categoryForm.sub_product_category_id = this.parentData.id
					}
					else if(this.parentData.master_product_category_id){
						this.categoryForm.master_product_category_id = this.parentData.master_product_category_id
						this.categoryForm.main_product_category_id = this.parentData.id
					}
					else{
						this.categoryForm.master_product_category_id = this.parentData.id
					}
				}
			}

		},
		mounted(){
			if((!this.model || !this.model.id) && this.parentData && this.parentData.id){
				//This data is master or main
				let parentMaster = this.parentData.master_product_category_id ? this.parentData.master_product_category_id : this.parentData.id
				this.changeMaster(parentMaster)
			}
		},
		methods: {
			validateCategoryForm() {
				this.$refs['categoryForm'].validate((valid) => {
	                if (valid) {
	                	this.resetErrors()

	                	if (this.hasModel) {
	                		this.update()

	                		return
	                	}

	                    this.store()
	                }
	            })
			},
			store() {
	            this.loading = true;

	            let postData = cloneDeep(this.categoryForm)
	            this.setCurrrentLangDefaultValue(postData)

	            this.$API.ProductCategory.store(postData)
	            .then(res => {
	            	if (res.data.success) {
	            		this.$EventDispatcher.fire('PRODUCT_CATEGORY_NEW_ITEM_CREATED', res.data.data)

	            		this.$notify({
		                    title: "Success",
		                    message: this.$msg.notif.success_add,
		                    type: "success"
		                })

		                this.closeFormDialog()

	            		return
	            	}

	            	res.data.success === false ? this.form.errors = res.data.errors : null

	            	this.$notify({
	                    title: "Failed",
	                    message: this.$msg.notif.failed_add,
	                    type: "error"
	                })

	            })
	            .catch(err => {
	            	console.log(err)

	            	this.$notify({
	                    title: "Server Error",
	                    message: this.$msg.notif.server_error,
	                    type: "error"
	                })
	            })
	            .finally(_ => {
	            	this.loading = false
	            })
			},
			update() {
	            this.loading = true

	            let postData = cloneDeep(this.categoryForm)
	            this.setCurrrentLangDefaultValue(postData)

	            this.$API.ProductCategory.update(postData)
	            .then(res => {
	            	if (res.data.success) {
	            		this.$EventDispatcher.fire('PRODUCT_CATEGORY_ITEM_UPDATED', res.data.data)

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
			//Will fetch main categories
			changeMaster(id){
				console.log('changeMaster', id)
				let findInd = this.categoryList.findIndex(fn => fn.id == id)
				if(findInd >= 0){
					let findData = this.categoryList[findInd]

					if(!findData.isFetchChildren){
			        	let params = {master_product_category_id : null, main_product_category_id : null, sub_product_category_id : null}
			        	params.master_product_category_id = id

			        	this.getChildren(params)

						findData.isFetchChildren = true
						this.categoryList.splice(findInd, 1, findData)

					}
				}


			},
			async getChildren(params) {
	            //this.tableLoading = true;
	            this.loading = true

	            await this.$API.ProductCategory.getCategoryList(params).then(result => {
	            	let res = result.data
	            	this.categoryList = this.categoryList.concat(res.categories)
	            })
	            .catch(_ => {

	            });
	            this.loading = false
	        },
			closeFormDialog() {
				this.resetForm()

				setTimeout(_ => {
					this.$refs.categoryForm.clearValidate()
					this.closeModal()
				}, 200)
			},
			resetForm() {
				this.categoryForm = {
		            id: null,
		            name: null,
		            description: null,
		            master_product_category_id: null,
		            main_product_category_id: null,
		            sub_product_category_id: null,
		        }
			}
		},
		computed: {
			hasModel() {
				return this.model && this.model.id ? true : false
			},
			computedList(){
				_forEach(this.categoryList, ct => {
					ct.isFetchChildren === undefined ? this.$set(ct, 'isFetchChildren', false )  : null
				})

				return this.categoryList
			},
			masterSelection() {
				return this.computedList.filter(bc => {
					return !bc.master_product_category_id
						&&!bc.main_product_category_id
						&& !bc.sub_product_category_id
				})
			},
			mainSelection() {
				return this.computedList.filter(bc => {
					return bc.master_product_category_id == this.categoryForm.master_product_category_id
						&& !bc.main_product_category_id
						&& !bc.sub_product_category_id
				})
			},
			subSelection() {
				return this.computedList.filter(bc => {
					return bc.master_product_category_id == this.categoryForm.master_product_category_id
						&& bc.main_product_category_id == this.categoryForm.master_product_category_id
						&& !bc.sub_product_category_id
				})
			}
		}
	}
</script>

<style lang="scss">

</style>
