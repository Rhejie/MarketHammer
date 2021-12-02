<template>
    <div>
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
                    <div class="col-sm-12 col-md-6">
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
                            :label="__('Industry Type')"
                            prop="industry_type_id"
                            :error="hasError('industry_type_id', true)">
                            <el-select
                                v-model="categoryForm.industry_type_id"
                                :placeholder="__('Select Industry Type')"
                                class="cluster-dropdown full-width"
                                filterable
                                clearable
                                @change = "changeIndustry"
                                :disabled = "hasModel">
                                <el-option
                                    v-for="type in industryTypes"
                                    :key="type.id"
                                    :label="__dt(type.translations, 'name', type.name)"
                                    :value="type.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item
                            :label="__('Master Business Category')"
                            prop="master_business_category_id"
                            :error="hasError('master_business_category_id', true)">
                            <el-select
                                v-if = "!hasModel"
                                v-model="categoryForm.master_business_category_id"
                                :placeholder="__('Select Category')"
                                class="cluster-dropdown full-width"
                                filterable
                                clearable
                                @change = "changeMaster"
                                :disabled = "hasModel">
                                <el-option
                                    v-for="type in masterSelection"
                                    :key="type.id"
                                    :label="__dt(type.translations, 'name', type.name)"
                                    :value="type.id">
                                </el-option>
                            </el-select>

                            <el-input
                                v-else-if = "hasModel"
                                class="full-width"
                                v-model="modelCategory.masterName"
                                :placeholder="__('None')"
                                disabled>
                            </el-input>
                        </el-form-item>

                        <el-form-item
                            :label="__('Main Business Category')"
                            prop="main_business_category_id"
                            :error="hasError('main_business_category_id', true)">
                            <el-select
                                v-if = "!hasModel"
                                v-model="categoryForm.main_business_category_id"
                                :placeholder="__('Select Category')"
                                class="cluster-dropdown full-width"
                                filterable
                                clearable
                                @change = "changeMain"
                                :disabled = "hasModel">
                                <el-option
                                    v-for="type in mainSelection"
                                    :key="type.id"
                                    :label="__dt(type.translations, 'name', type.name)"
                                    :value="type.id">
                                </el-option>
                            </el-select>

                            <el-input
                                v-else-if = "hasModel"
                                class="full-width"
                                v-model="modelCategory.mainName"
                                :placeholder="__('None')"
                                disabled>
                            </el-input>
                        </el-form-item>

                        <el-form-item
                            :label="__('Sub Business Category')"
                            prop="sub_business_category_id"
                            :error="hasError('sub_business_category_id', true)">
                            <el-select
                                v-if = "!hasModel"
                                v-model="categoryForm.sub_business_category_id"
                                :placeholder="__('Select Category')"
                                class="cluster-dropdown full-width"
                                filterable
                                clearable
                                :disabled = "hasModel">
                                <el-option
                                    v-for="type in subSelection"
                                    :key="type.id"
                                    :label="__dt(type.translations, 'name', type.name)"
                                    :value="type.id">
                                </el-option>
                            </el-select>

                            <el-input
                                v-else-if = "hasModel"
                                class="full-width"
                                v-model="modelCategory.subName"
                                :placeholder="__('None')"
                                disabled>
                            </el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <el-form-item
                            :label="__('Ko Status Code')"
                            prop="ko_stat_code"
                            :error="hasError('ko_stat_code', true)">
                            <el-input
                                class="full-width"
                                v-model="categoryForm.ko_stat_code"
                                :placeholder="__('Enter Ko Status Code')"
                                clearable>
                            </el-input>
                            <value-translator-btn
                                @showTranslationForm="setTranslationForm('ko_stat_code', categoryForm.ko_stat_code, 'text')">
                            </value-translator-btn>
                        </el-form-item>
                        <el-form-item
                            :label="__('Tax Code')"
                            prop="tax_code"
                            :error="hasError('tax_code', true)">
                            <el-input
                                class="full-width"
                                v-model="categoryForm.tax_code"
                                :placeholder="__('Enter Tax Code')"
                                clearable>
                            </el-input>
                            <value-translator-btn
                                @showTranslationForm="setTranslationForm('tax_code', categoryForm.tax_code, 'text')">
                            </value-translator-btn>
                        </el-form-item>
                        <el-form-item
                            :label="__('SIC Code')"
                            prop="sic_code"
                            :error="hasError('sic_code', true)">
                            <el-input
                                class="full-width"
                                v-model="categoryForm.sic_code"
                                :placeholder="__('Enter SIC Code')"
                                clearable>
                            </el-input>
                            <value-translator-btn
                                @showTranslationForm="setTranslationForm('sic_code', categoryForm.sic_code, 'text')">
                            </value-translator-btn>
                        </el-form-item>
                        <el-form-item
                            :label="__('Description')"
                            prop="description"
                            :error="hasError('description', true)">
                            <el-input
                                type="textarea"
                                class="full-width"
                                v-model="categoryForm.description"
                                :placeholder="__('Enter Description')"
                                clearable>
                            </el-input>
                            <value-translator-btn
                                @showTranslationForm="setTranslationForm('description', categoryForm.description, 'textarea')">
                            </value-translator-btn>
                        </el-form-item>
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
        </el-dialog>

        <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData"
            >
        </value-translator-form>
    </div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import _forEach from 'lodash/forEach'
	import { formHelper } from '../../../mixins/formHelper'
	import { dialogComponent } from '../../../mixins/dialogComponent'
    import translationForm from '../../../mixins/translationForm.js'

	export default {
		name: 'BusinessCategoryForm',
		mixins: [dialogComponent, formHelper, translationForm],
		props: {
			model: {},
			industryTypes: {},
			businessCategories: {},
			parentData: {}
		},
		data() {
			let modelCategory = this.model
			if(modelCategory){
				modelCategory.masterName = this.model.master_parent ? this.__dt(this.model.master_parent.translations, 'name', this.model.master_parent.name) : null
				modelCategory.mainName = this.model.main_parent ? this.__dt(this.model.main_parent.translations, 'name', this.model.main_parent.name) : null
				modelCategory.subName = this.model.sub_parent ? this.__dt(this.model.sub_parent.translations, 'name', this.model.sub_parent.name)  : null
			}

			return {
				modelCategory : modelCategory,
				loading: false,
				categoryForm: {
		            id: null,
		            name: null,
		            industry_type_id: null,
		            master_business_category_id: null,
		            main_business_category_id: null,
		            sub_business_category_id: null,
		            ko_stat_code: null,
		            tax_code: null,
		            sic_code: null,
		            description: null
		        },
		        rules: {
		        	name: {required: true, message: this.__('Business Category Name is required.'), trigger: 'blur'},
		        	industry_type_id: {required: true, message: this.__('Industry Type field is required.'), trigger: 'change'}
		        },
		        categoryList : cloneDeep(this.businessCategories)
			}
		},
		created() {
            this.formFields = ['name', 'ko_stat_code', 'tax_code', 'sic_code', 'description']
            this.fromTable = 'business_category'
			if (this.model && this.model.id) {
				this.categoryForm = {
		            id: this.model.id,
		            name: this.$sf.ucwords(this.model.name),
		            industry_type_id: this.model.industry_type_id,
		            master_business_category_id: this.model.master_business_category_id,
		            main_business_category_id: this.model.main_business_category_id,
		            sub_business_category_id: this.model.sub_business_category_id,
		            ko_stat_code: this.model.ko_stat_code,
		            tax_code: this.model.tax_code,
		            sic_code: this.model.sic_code,
		            description: this.model.description
		        }
                this.populateDefault(cloneDeep(this.model.translations))
			}
			else{
				if(this.parentData && this.parentData.id){
					this.categoryForm.industry_type_id = this.parentData.industry_type_id
					if(this.parentData.main_business_category_id){
						this.categoryForm.master_business_category_id = this.parentData.master_business_category_id
						this.categoryForm.main_business_category_id = this.parentData.main_business_category_id
						this.categoryForm.sub_business_category_id = this.parentData.id
					}
					else if(this.parentData.master_business_category_id){
						this.categoryForm.master_business_category_id = this.parentData.master_business_category_id
						this.categoryForm.main_business_category_id = this.parentData.id
					}
					else{
						this.categoryForm.master_business_category_id = this.parentData.id
					}
				}
			}

		},
		mounted(){
			this.fetchOnloadCategory()
		},
		methods: {
			validateCategoryForm() {
				this.$refs['categoryForm'].validate((valid) => {
	                if (valid) {
	                	this.resetErrors()

	                	if (this.hasModel) {
	                		this.updateCategory()

	                		return
	                	}

	                    this.createCategory()
	                }
	            })
			},
			createCategory() {
	            this.loading = true;
                let postData = cloneDeep(this.categoryForm)
                this.setCurrrentLangDefaultValue(postData)
	            this.$API.BusinessCategory.createCategory(postData)
	            .then(res => {
	            	if (res.data.success) {
	            		this.$EventDispatcher.fire('BUSINESS_CATEGORY_NEW_ITEM_CREATED', res.data.data)

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
			updateCategory() {
	            this.loading = true
                let postData = cloneDeep(this.categoryForm)
                this.setCurrrentLangDefaultValue(postData)
	            this.$API.BusinessCategory.updateCategory(this.categoryForm.id, postData)
	            .then(res => {
	            	if (res.data.success) {
	            		this.$EventDispatcher.fire('BUSINESS_CATEGORY_ITEM_UPDATED', res.data.data)

	            		this.$notify({
		                    title: "Success",
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

			async fetchOnloadCategory(){
				if((!this.model || !this.model.id) && this.parentData && this.parentData.id){
					let masterID = null
					let mainID = null

					//parent is sub category
					if(this.parentData.master_business_category_id && this.parentData.main_business_category_id){
						mainID = this.parentData.main_business_category_id
						masterID = this.parentData.master_business_category_id
					}
					//parent is main category
					else if(this.parentData.master_business_category_id){
						mainID = this.parentData.id
						masterID = this.parentData.master_business_category_id
					}
					//parent is master category
					else{
						masterID = this.parentData.id
					}

					console.log('fetchOnloadCategory', masterID, mainID)

					if(masterID){
						await this.changeCategory(masterID)
					}

					if(mainID){
						console.log('mainID')
						await this.changeCategory(mainID)
					}
				}
			},
			changeIndustry(id){
				this.categoryForm.master_business_category_ide = null
				this.categoryForm.main_business_category_id = null
				this.categoryForm.sub_business_category_id = null
			},
			changeMaster(id){
				this.changeCategory(id)
				this.categoryForm.main_business_category_id = null
				this.categoryForm.sub_business_category_id = null
			},
			changeMain(id){
				this.changeCategory(id)
				this.categoryForm.sub_business_category_id = null
			},
			//Will fetch categories
			async changeCategory(id){
				let findInd = this.categoryList.findIndex(fn => fn.id == id)
				if(findInd >= 0){
					let findData = this.categoryList[findInd]

					if(!findData.isFetchChildren){
			        	let params = {master_business_category_id : null, main_business_category_id : null, sub_business_category_id : null}

			        	//Main category; fetch sub category
			        	if (findData.master_business_category_id ){
			        		params.master_business_category_id = findData.master_business_category_id
			        		params.main_business_category_id = findData.id
			        	}
			        	//Master category; fetch main category
			        	else {
			        		params.master_business_category_id = findData.id
			        	}

			        	await this.getChildren(params)

						findData.isFetchChildren = true
						this.categoryList.splice(findInd, 1, findData)

					}
				}

				return true
			},
			async getChildren(params) {
	            //this.tableLoading = true;
	            this.loading = true

	            await this.$API.BusinessCategory.getCategoryList(params).then(result => {
	            	let res = result.data
	            	this.categoryList = this.categoryList.concat(res.categories)
	            })
	            .catch(_ => {

	            });
	            this.loading = false

	            return true
	            console.log('getChildren')
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
		            industry_type_id: null,
		            master_business_category_id: null,
		            main_business_category_id: null,
		            sub_business_category_id: null,
		            ko_stat_code: null,
		            tax_code: null,
		            sic_code: null,
		            description: null
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
					return bc.industry_type_id == this.categoryForm.industry_type_id
						&& !bc.master_business_category_id
						&&!bc.main_business_category_id
						&& !bc.sub_business_category_id
				})
			},
			mainSelection() {
				return this.computedList.filter(bc => {
					return bc.industry_type_id == this.categoryForm.industry_type_id
						&& bc.master_business_category_id == this.categoryForm.master_business_category_id
						&& !bc.main_business_category_id
						&& !bc.sub_business_category_id
				})
			},
			subSelection() {
				return this.computedList.filter(bc => {
					return bc.industry_type_id == this.categoryForm.industry_type_id
						&& bc.master_business_category_id == this.categoryForm.master_business_category_id
						&& bc.main_business_category_id == this.categoryForm.main_business_category_id
						&& !bc.sub_business_category_id
				})
			}
		}
	}
</script>

<style lang="scss">

</style>
