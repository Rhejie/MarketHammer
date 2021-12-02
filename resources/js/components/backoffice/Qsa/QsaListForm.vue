<template>
	<el-dialog
    :title="hasModel ? __('Update QSA') : __('Add New QSA')"
    :visible.sync="showDialog"
    width="45%"
    :before-close="closeFormDialog"
    :close-on-press-escape="false"
    class="material-dialog"
    :close-on-click-modal="false">
    	<el-form
    		ref="modelForm"
    		:model="modelForm"
    		:rules="modelFormRules"
    		class="industry-type-form">
            <el-form-item
            	:label="__('QSA Name')"
            	prop="name">
            	<el-select
                    v-if = "enableSelect"
                    v-model="modelForm.qsa_name"
                    remote
                    filterable
                    allow-create
                    @change = "changeSelectQsa"
                    :placeholder="__('QSA Name')"
                    :remote-method="getRemoteSelect"
                    :loading="selectLoading"
                    class="cluster-dropdown full-width">
                    <el-option
                      v-for="item in qsaSelectList"
                      :key="item.id"
                      :label="item.name"
                      :value="item.id">
                    </el-option>
                </el-select>
                <template v-else>
                	<el-input
                		v-model="modelForm.name"
                		:placeholder="__('QSA Name')"
                		clearable>
            		</el-input>

                	<value-translator-btn
                        @showTranslationForm="setTranslationForm('name', modelForm.name, 'text')">
                    </value-translator-btn>
                </template>
            </el-form-item>
            <el-form-item
            	:label="__('QSA Type')"
            	prop="qsa_type_id">
                <el-select
                    v-model="modelForm.qsa_type_id"
                    :placeholder="__('Select QSA Type')"
                    class="cluster-dropdown full-width"
                    filterable
                    clearable
                    :disabled = "isDisable">
                    <el-option
                        v-for="type in qsaTypeList"
                        :key="type.id"
                        :label="type.name"
                        :value="type.id">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item
            	:label="__('Description')"
            	prop="description">
                <el-input
                	:disabled="isDisable"
                	type="textarea"
                	:rows="3"
                	v-model="modelForm.description"
                	:placeholder="__('Description')">
            	</el-input>
            	<value-translator-btn
                    @showTranslationForm="setTranslationForm('description', modelForm.description, 'textarea')">
                </value-translator-btn>
            </el-form-item>
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
            	@click="validateForm">
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
	import { formHelper } from '../../../mixins/formHelper'
	import { dialogComponent } from '../../../mixins/dialogComponent'
    import translationForm from '../../../mixins/translationForm.js'

	export default {
		name: 'QsaListForm',
		mixins: [dialogComponent, formHelper, translationForm],
		props: {
			model: {},
			qsaTypeList : {},
			pageData:  {
                type: Object,
                required: false
            }
		},
		data() {
			return {
				loading: false,
				modelForm: {
                    name: null,
                    qsa_type_id: null,
                    description : null,
                    qsa_name : null
                },
                modelFormRules: {
                    name: [
                        { required: true, message: this.__('Please input name'), trigger: 'blur' },
                    ],
                    qsa_type_id: [
                        { required: true, message: this.__('Please select type'), trigger: 'change' }
                    ]
                },
                businessQsaForm : {
                	business_id : null,
                	qsa_detail_id : null
                },
		        selectLoading : false,
		        qsaSelectList : [],
            	selectedSelectQsa : null,
		        businessSelected : null,
		        businessData : this.pageData && this.pageData.business ? this.pageData.business : null

			}
		},
		created() {
			this.formFields = ['name', 'description']
            this.fromTable = 'qsa_list'

			if (this.model && this.model.id) {
				this.modelForm = {
		            id: this.model.id,
		            name: this.model.name,
                    qsa_type_id: this.model.qsa_type_id,
                    description : this.model.description
		        }

		        this.populateDefault(cloneDeep(this.model.translations))

		        if (this.model.business_qsa) {
                    _forEach(this.model.business_qsa, (fm, fmInd) =>{
                        this.businessQsaForm[fmInd] = fm
                    })
                }
                else if (this.businessData) {
                    this.businessQsaForm.business_id = this.businessData.id
                }
			} else {
				if (this.businessData) {
                    this.businessQsaForm.business_id = this.businessData.id
                }
			}
		},
		methods: {
			getRemoteSelect(query){
	            this.selectLoading = true
	            this.selectedSelectQsa = null

	            let postData = {search : query, not_in_business_id : this.businessData ? this.businessData.id : null}

	            this.$API.QsaList.getQsaList(postData)
	            .then(res => {
	                let result = res.data
	                console.log('res', result)
	                if (result.qsa_list) {
	                    this.qsaSelectList = result.qsa_list.data
	                }
	            })
	            .catch(err => {
	                console.log(err)
	            })
	            .finally(_ => {
	                this.selectLoading = false
	            })
	        },
			changeSelectQsa(val){
	            this.selectedSelectQsa = this.qsaSelectList.find(fn => fn.id == val)
	            if(this.selectedSelectQsa){
	                this.modelForm.name = this.selectedSelectQsa.name
	                this.modelForm.description = this.selectedSelectQsa.description
	                this.modelForm.qsa_type_id = this.selectedSelectQsa.qsa_type_id
	            }
	        },
            validateForm() {
            	if (this.modelForm.qsa_name && !this.selectedSelectQsa) {
	                this.modelForm.name = this.modelForm.qsa_name
	            }

                this.$refs['modelForm'].validate((valid) => {
                    if(valid) {
                    	if (this.hasModel) {
                    		this.update();
                    	}
                        else {
                            this.store();
                        }
                    }
                });
            },
            store() {
                this.loading = true;
                let postData = cloneDeep(this.modelForm)
                this.setCurrrentLangDefaultValue(postData)
                this.$API.QsaList.store(postData)
                    .then(res => {
                        this.$notify({
	                        title: this.__("Success"),
	                        message: this.$msg.notif.success_add,
	                        type: "success"
	                    });
                        this.$EventDispatcher.fire('QSALIST_NEW_ITEM_CREATED', res.data)
                        this.closeFormDialog();
                    })
                    .catch(err => {
                        console.log('Err: ', err)
	                    this.showValidationError(err);
                    });

            },
            // async store() {
            //     this.loading = true;
            //     this.formDialogVisible = false;

            //     if (!this.selectedSelectQsa) {
            //     	let postData = cloneDeep(this.modelForm)
            //     	this.setCurrrentLangDefaultValue(postData)

	        //         await this.$API.QsaList.store(postData)
	        //         .then(res => {

	        //             this.$notify({
	        //                 title: this.__("Success"),
	        //                 message: this.$msg.notif.success_add,
	        //                 type: "success"
	        //             });
            //             console.log('nisuold diri');
            //             this.$EventDispatcher.fire('QSALIST_NEW_ITEM_CREATED', res.data)

	        //         })
	        //         .catch(err => {
	        //             console.log('Err: ', err)
	        //             this.showValidationError(err);
	        //         })
	        //         .finally(_ => {
	        //             this.loading = false
	        //         })
	        //     } else {
	        //     	savedQsa = this.selectedSelectQsa
	        //     }

            //     if (savedQsa) {
	        //         //save business qsa
	        //         if (this.businessData) {
	        //             let bpForm = cloneDeep(this.businessQsaForm)
	        //             bpForm.qsa_detail_id = savedQsa.id
	        //             let bpData = await this.saveBusinessQsa(bpForm)
	        //             if (bpData) {
	        //                 savedQsa.business_qsa = bpData
	        //             }
	        //         }

            //     	this.$EventDispatcher.fire('QSALIST_NEW_ITEM_CREATED', savedQsa)
            //         this.closeFormDialog()
	        //     }
            // },
            update() {
                let postData = cloneDeep(this.modelForm)
                this.setCurrrentLangDefaultValue(postData)
                this.$API.QsaList.update(postData)
                    .then(res => {
                        this.$notify({
                            title: "Success",
                            message: this.$msg.notif.success_update,
                            type: "success"
                        });
                        this.$EventDispatcher.fire('QSALIST_ITEM_UPDATED', res.data)
                        this.closeFormDialog();
                        this.loading = false
                    })
                    .catch(err => {
                        console.log('Err: ', err)
                        this.showValidationError(err);
                    })
            },
            // async update() {
            //     this.loading = true;
            //     this.formDialogVisible = false;
            //     let savedQsa = null

            //     let postData = cloneDeep(this.modelForm)
            //     this.setCurrrentLangDefaultValue(postData)

            //     await this.$API.QsaList.update(postData)
            //     .then(res => {
            //     	savedQsa = res.data.data
            //         this.$notify({
            //             title: "Success",
            //             message: this.$msg.notif.success_update,
            //             type: "success"
            //         });
            //     })
            //     .catch(err => {
            //         console.log('Err: ', err)
            //         this.showValidationError(err);
            //     })
            //     .finally(_ => {
            //         this.loading = false
            //     })

            //     if (savedQsa) {
	        //         //save business qsa
	        //         if(this.businessData && this.businessQsaForm && this.businessQsaForm.id){
	        //         	savedQsa.business_qsa = cloneDeep(this.businessQsaForm)
	        //             /*let bpForm = cloneDeep(this.businessQsaForm)
	        //             bpForm.qsa_detail_id = savedQsa.id
	        //             let bpData = this.saveBusinessQsa(bpForm)
	        //             if(bpData) {
	        //                 savedProduct.business_qsa = bpData
	        //             }*/
	        //         }

            //     	this.$EventDispatcher.fire('QSALIST_ITEM_UPDATED', savedQsa)
            //         this.closeFormDialog()
	        //     }
            // },
            async saveBusinessQsa(bpForm){
	            let bpData = null
	            //Update
	            if(bpForm.id){
	                await this.$API.BusinessQsa.update(bpForm)
	                .then(result => {
	                    let res = result.data
	                    if(res.data){
	                        bpData = res.data
	                    }
	                })
	                .catch(err => {
	                    console.log('err', err)
	                })
	                .finally(_ => {
	                })
	            } else { //Create
	                await this.$API.BusinessQsa.store(bpForm)
	                .then(result => {
	                    let res = result.data
	                    if(res.data){
	                        bpData = res.data
	                    }
	                })
	                .catch(err => {
	                    console.log('err', err)
	                })
	                .finally(_ => {
	                })
	            }
	            return bpData
	        },
			closeFormDialog() {
				this.resetForm()

				setTimeout(_ => {
					this.$refs.modelForm.clearValidate()
					this.closeModal()
				}, 200)
			},
			resetForm() {
				this.selectedSelectQsa = null

				this.modelForm = {
		            id: null,
		            name: null,
		            description: null,
		            qsa_type_id: null,
		        }

		        this.businessQsaForm = {
		        	business_id : null,
                	qsa_detail_id : null
		        }
			}
		},
		computed: {
			hasModel() {
				return this.model && this.model.id ? true : false
			},
			isDisable(){
	            if(this.selectedSelectQsa){
	                return true
	            }
	            return false
	        },
	        //Allow to select existing qsa if add mode and has business data
	        enableSelect(){
	            if(!this.hasModel && this.businessData){
	                return true
	            }
	            return false
        	}
		},
		watch:{
	        model(newVal){
	            this.setData(newVal)
	            if (newVal == null) {
	                this.resetFields();
	            }
	        },
	        'pageData.business'(newValue){
	        	this.businessData = newValue && newValue.id ? newValue : null
	        }
	    }
	}
</script>

<style lang="scss">
	.el-form-item.el-form-checkbox{
		margin-bottom: 0px !important;
	}

</style>
