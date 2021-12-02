<template>
	<section class="business-machine-custom" v-loading = "loading">
		<table class = "table no-border">
			<tr v-for="(field, fKey) in customFieldsList"
				:key="fKey">
				<td>
					<el-input
                        class="full-width round-input"
                        :placeholder="__('Label')"
                        clearable
                        v-model="field.label">
                    </el-input>
				</td>
				<td>
					<el-input
                        class="full-width round-input"
                        :placeholder="__('Value')"
                        clearable
                        v-model="field.value">
                    </el-input>
				</td>
				<td>
					<template v-if = "field.id">
						<el-button @click="updateModel(field)" type="primary" class="btn btn-black"> {{ __("Update") }} </el-button>
						<button class="btn btn-default" @click="deleteModel(field)"> {{ __("Delete") }} </button>
					</template>

					<template v-else>
						<!-- <button class="btn btn-default" @click="createModel(field)"> Add </button> -->
						<el-button @click="createModel(field)" type="primary" class="btn btn-black"> {{ __("Add") }} </el-button>
					</template>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<el-button 
						v-show = "showAddBtn"
			            round
			            @click="addNewField"
			            type="primary"
			            class="btn btn-black">
			            {{ __('Add New Field') }}
			        </el-button>
				</td>
			</tr>
		</table>
		
		
	</section>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import _forEach from 'lodash/forEach'

	export default {
		props: {
			pageData: {
				type: Object,
				required: false
			},
			customFields: {},
			businessMachine: {}
		},
		data() {
			
			return {
	            customFieldsList 	: [],
	            businessMachineData : this.businessMachine,
	            showAddBtn 			: true,
	            loading 			: false
			}
		},
		created() {
			this.initializeList(this.customFields)
		},
		methods: {
			initializeList(list){
				this.customFieldsList = list
			},
			addNewField(){
				let arr = {
					temp_id : this.customFieldsList.length+1,
					label : null,
					value : null,
					type : 'text',
					business_machine_id : this.businessMachineData.id
				}
				this.customFieldsList.push(arr)
				this.showAddBtn = false
			},
			
			async createModel(data) {
				console.log('data', data)
				if(!data.label || !data.value){
					this.$notify({
	                    title: this.__("Failed"),
	                    message: this.__("Enter label and value"),
	                    type: "error"
	                })
					return 
				}

	            this.loading = true;

	           	await this.$API.BusinessMachineCustomField.store(data)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		console.log('res.data', res.data)
	            		this.spliceData(res.data, 'create')
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
	            })
	            .finally(_ => { })
	            this.loading = false

			},
			async updateModel(data) {
				if(!data.label || !data.value){
					this.$notify({
	                    title: this.__("Failed"),
	                    message: this.__("Enter label and value"),
	                    type: "error"
	                })
					return 
				}

	            this.loading = true

	            await this.$API.BusinessMachineCustomField.update(data)
	            .then(result => {
	            	let res = result.data
	            	if (res.data) {
	            		this.spliceData(res.data, 'update')
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
	            })
	            .finally(_ => {
	            	this.loading = false
	            })

	            this.loading = false
			},
			spliceData(data, mode){
				let findKey = -1;
				if(mode == 'create'){
					findKey = this.customFieldsList.findIndex(fn =>{ return fn.temp_id })
				}
				else if(mode == 'update'){
					findKey = this.customFieldsList.findIndex(fn =>{ return fn.id == data.id })
				}
				console.log('findKey', findKey)

				if(findKey >= 0){
					this.customFieldsList.splice(findKey, 1, data)
				}
				
				this.showAddBtn = true
			},
			deleteModel(machine) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Delete Custom Field'), {
	                confirmButtonText: this.__('Delete'),
	                cancelButtonText: this.__('Cancel'),
	                type: 'warning',
	                confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true;
                    
                    this.$API.BusinessMachineCustomField.destroy(machine.id)
                    .then(res => {
                    	if (res.data) {
                    		let index = this.customFieldsList.findIndex(co => co.id == machine.id)
                    		if (index > -1) {
                    			this.customFieldsList.splice(index, 1)
                    		}
                    		return
                    	}

	                    this.$notify({
	                        title: this.__("Delete Failed"),
	                        message: this.$msg.notif.failed_delete,
	                        type: "error"
	                    });
                    })
                    .catch(err => {
                    	console.log(err)
                    })
                    .finally(_ => {
                    	this.loading = false
                    })
                })
                .catch(() => {});
            },
		},
		watch: {
			'businessMachine.id'(newValue) {
				this.businessMachineData = newValue
			},
			'customFields'(newValue) {
				this.initializeList(newValue)
			}
		}
	}
</script>

<style lang="scss">
	.business-machine-custom {
		table{
			td{
				padding: 6px 0px;
				vertical-align: middle;
			}
		}

		.btn-default{
			width: auto;
		}
	}
</style>