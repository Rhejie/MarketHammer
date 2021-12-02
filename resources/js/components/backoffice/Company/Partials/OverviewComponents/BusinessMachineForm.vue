<template>
	<el-dialog
    :title="hasModel ? __('Update Machine') : __('Add New Machine')"
    :visible.sync="showDialog"
    width="55%"
    :before-close="closeFormDialog"
    :close-on-press-escape="false"
    class="model-dialog"
    :close-on-click-modal="false"
    v-loading = "loading"
    append-to-body>
         <el-form ref="modelForm" :model="modelForm" :rules="rules" class="model-form">
         	<el-row :gutter = "20">
                <el-col :span = "12">

		            <el-form-item :label="__('Name')" prop="name">
		                <el-input v-model="modelForm.name" :placeholder="__('Name')"></el-input>
		            </el-form-item>

		            <el-form-item :label="__('Machine Type')" prop="machine_type_id">
		            	<el-select
			                v-model="modelForm.machine_type_id"
			                :placeholder="__('Select Machine Type')"
			                class="cluster-dropdown full-width"
			                filterable>
		                    <el-option
			                    v-for="type in machineType"
			                    :key="type.id"
			                    :label="type.name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>
				    </el-form-item>

		            <el-form-item :label="__('Machine Manufacturer')" prop="machine_manufacturer_id">
		            	<el-select
			                v-model="modelForm.machine_manufacturer_id"
			                :placeholder="__('Select Manufacturer')"
			                class="cluster-dropdown full-width"
			                filterable>
		                    <el-option
			                    v-for="type in machineManufacturer"
			                    :key="type.id"
			                    :label="type.name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>
				    </el-form-item>

		            <el-form-item :label="__('Machine Process Type')" prop="process_type_id">
		            	<el-select
			                v-model="modelForm.process_type_id"
			                :placeholder="__('Select Process Type')"
			                class="cluster-dropdown full-width"
			                filterable>
		                    <el-option
			                    v-for="type in machineProcessType"
			                    :key="type.id"
			                    :label="type.name"
			                    :value="type.id">
		                    </el-option>
		                </el-select>
				    </el-form-item>

				    <el-form-item :label="__('Description')" prop="description">
		                <el-input type ="textarea" v-model="modelForm.description" :placeholder="__('Description')" :autosize="{ minRows: 4, maxRows: 6}"></el-input>
		            </el-form-item>
		        </el-col>
		        <el-col :span = "12">

				    <el-form-item :label="__('Tonnage')" prop="tonnage">
		                <el-input v-model="modelForm.tonnage" :placeholder="__('Tonnage')"></el-input>
		            </el-form-item>

				    <el-form-item :label="__('Model')" prop="model">
		                <el-input v-model="modelForm.model" :placeholder="__('Model')"></el-input>
		            </el-form-item>

				    <el-form-item :label="__('Age')" prop="age">
		                <el-input type = "number" v-model="modelForm.age" :placeholder="__('Age')"></el-input>
		            </el-form-item>

				    <el-form-item :label="__('Product Number')" prop="product_num">
		                <el-input v-model="modelForm.product_num" :placeholder="__('Product Number')"></el-input>
		            </el-form-item>

				    <el-form-item :label="__('Equipped')" prop="equipped">
		                <el-input v-model="modelForm.equipped" :placeholder="__('Equipped')"></el-input>
		            </el-form-item>

				    <el-form-item :label="__('Electrics')" prop="electrics">
		                <el-input v-model="modelForm.electrics" :placeholder="__('Electrics')"></el-input>
		            </el-form-item>
		        </el-col>
		    </el-row>
        </el-form>
        <span slot="footer">
            <button type="button" class="btn btn-default" @click="closeFormDialog">{{ __("Cancel") }}</button>
            <button type="button" class="btn btn-primary btn-black" @click="validateModelForm"> {{ __('Save') }} </button> <!--{{ !hasModel ? __('Save') : __('Update') }}-->
        </span>
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import _forEach from 'lodash/forEach'
	import statesHelper from '../../../../../mixins/statesHelper'
	import { formHelper } from '../../../../../mixins/formHelper'
	import { dialogComponent } from '../../../../../mixins/dialogComponent'

	export default {
		mixins: [dialogComponent, formHelper, statesHelper],
		props: {
			model: {},
			business:  {
                type: Object,
                required: false
            },
            pageData : {
	            required: false
	        },
		},
		data() {
			return {
				loading: false,
				modelForm: {
	                business_id: null,
	                machine_manufacturer_id: null,
	                machine_type_id: null,
	                process_type_id: null,
	                name: null,
	                description: null,
	                tonnage: null,
	                model: null,
	                age: null,
	                product_num: null,
	                equipped: null,
	                electrics: null
		        },
		        rules: {},
		        selectLoading : false,
		        businessSelected : null,
		        companyList : [],
		        machineType : this.pageData.machineType,
		        machineManufacturer : this.pageData.machineManufacturer,
		        machineProcessType : this.pageData.machineProcessType,


			}
		},
		created() {
			if (this.model && this.model.id) {
				this.initializeForm(this.model)
			}
			else{
				if(this.business && this.business.id){
					this.modelForm.business_id = this.business.id
				}
			}

			this.rules = {
	            name: [
	                { required: true, message: this.__('This field is required.'), trigger: 'blur' },
	            ],
	            machine_type_id: [
	                { required: true, message: this.__('This field is required.'), trigger: 'change' },
	            ],
	            machine_manufacturer_id: [
	                { required: true, message: this.__('This field is required.'), trigger: 'change' },
	            ],
	            process_type_id: [
	                { required: true, message: this.__('This field is required.'), trigger: 'change' },
	            ],
	        }

		},
		methods: {
			initializeForm(data){
				_forEach(data, (fm, fmInd) =>{
                    this.modelForm[fmInd] = fm
                })
			},

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
	            this.loading = true;

	            let data = cloneDeep(this.modelForm)

	       		let savedData = null
	           	await this.$API.BusinessMachine.store(data)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		savedData = res.data
	            	}
	            	else{
	            		res.data.success === false ? this.form.errors = res.data.errors : null

		            	this.$notify({
		                    title: this.__("Failed"),
		                    message: this.$msg.notif.failed_add,
		                    type: "error"
		                })
	            	}
	            })
	            .catch(err => {
	            	console.log(err)
	            	this.showValidationError(err);
	            })
	            .finally(_ => { })

	            await this.dataSaved(savedData, 'create')
			},
			async updateModel() {
	            this.loading = true

	            let savedData = null
	            await this.$API.BusinessMachine.update(this.modelForm, this.modelForm.id)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		savedData = res.data
	            	}
	            	else{

		            	res.data.success === false ? this.form.errors = res.data.errors : null

		            	this.$notify({
		                    title: this.__("Failed"),
		                    message: this.$msg.notif.failed_update,
		                    type: "error"
		                })
		            }
	            })
	            .catch(err => {
	                console.log(err)
	                this.showValidationError(err);
	            })
	            .finally(_ => {
	            	this.loading = false
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
	                	this.$EventDispatcher.fire('BUSINESS_MACHINE_MODULE_ITEM_CREATED', data)
	                	msg = this.$msg.notif.success_add
	                }
	                else if(mode == 'update'){
	                	this.$EventDispatcher.fire('BUSINESS_MACHINE_MODULE_ITEM_UPDATED', data)
	                	msg = this.$msg.notif.success_update
	                }

            		this.$notify({
	                    title: this.__("Success"),
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
		            business_id: null,
	                machine_manufacturer_id: null,
	                machine_type_id: null,
	                process_type_id: null,
	                name: null,
	                description: null,
	                tonnage: null,
	                model: null,
	                age: null,
	                product_num: null,
	                equipped: null,
	                electrics: null
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
