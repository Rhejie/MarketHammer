<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeForm"
    	title="Add New Token"
    	width="30%"
    	top="4vh">
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="tokenForm"
    		ref="tokenForm"
    		autocomplete="off"
    		label-position="top">
    			<template v-if="!isSuccessful">
		    		<el-form-item
		    			label="Name"
		    			prop="name">
		    			<el-input
		    				class="full-width round-input"
		    				placeholder="Enter Name"
		    				clearable
		    				v-model="tokenForm.name">
		    			</el-input>
		    		</el-form-item>
	    		</template>

	    		<template v-else>
	    			<el-form-item
		    			label="Token"
		    			prop="token">
		    			<el-input
		    				class="full-width round-input"
		    				clearable
		    				:rows="6"
		    				type="textarea"
		    				v-model="tokenForm.token">
		    			</el-input>
		    		</el-form-item>

		    		<el-form-item
		    			v-if="tokenForm.refresh_token"
		    			label="Refresh Token"
		    			prop="refresh_token">
		    			<el-input
		    				class="full-width round-input"
		    				clearable
		    				:rows="6"
		    				type="textarea"
		    				v-model="tokenForm.refresh_token">
		    			</el-input>
		    		</el-form-item>
	    		</template>
    	</el-form>

    	<span slot="footer" class="dialog-footer">
		    <el-button 
		    	type="text"
		    	class="text-black"
		    	@click="closeForm">
		    	<u>{{ isSuccessful ? 'Close' : 'Cancel' }}</u>
		    </el-button>
		    <el-button 
		    	v-if="!isSuccessful"
		    	round
		    	@click="validateForm"
		    	type="primary"
		    	class="btn btn-black">
		    	Submit
		    </el-button>
		</span>
    </el-dialog>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../mixins/formHelper'
	import { dialogComponent } from '../../../mixins/dialogComponent' 

	export default {
		name: 'PersonalGrantForm',
		mixins: [formHelper, dialogComponent],
		data() {
			return {
				tokenForm: {
					name: null,
					token: null,
					refresh_token: null
					
				},
				rules: {
					name: {required: true, message: 'This field is required.', trigger: 'blur'}
				},
				loading: false,
				isSuccessful: false
			}
		},
		methods: {
			validateForm() {
				this.$refs.tokenForm.validate(valid => {
                    if (valid) {
                        this.resetErrors()

                        this.create()
                    }
                })
			},
			create() {
				this.loading = true

				this.$API.OAuthentication.createNewPersonalAccessToken(this.tokenForm.name, [])
				.then(res => {
					if (res.data) {
						this.isSuccessful = true
                        this.$notify({
                            title: "Successful",
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.tokenForm.token = res.data.accessToken
                        this.tokenForm.refresh_token = res.data.refreshToken ? res.data.refreshToken : null 

                        this.$EventDispatcher.fire('TOKEN_MODULE_ITEM_CREATED', res.data)

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
			closeForm() {
				this.$refs.tokenForm.clearValidate()
                
                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
			},
			resetForm() {
                this.tokenForm = {
					name: null
				}
            }
		}
	}
</script>