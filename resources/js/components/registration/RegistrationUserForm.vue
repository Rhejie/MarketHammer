<template>
	<div class="registration-user-form">
		<el-form
			:model="form"
			:rules="rules"
			ref="form">
			<div class="row">
				<div class="col-md-6">
					<el-form-item
                        label="First Name"
                        prop="first_name"
                        :error="hasError('first_name', true)">
                        <el-input
                            class="full-width round-input"
                            placeholder="Enter First Name"
                            clearable
                            v-model="form.first_name">
                        </el-input>
                    </el-form-item>

                    <el-form-item
                        label="Last Name"
                        prop="last_name"
                        :error="hasError('last_name', true)">
                        <el-input
                            class="full-width round-input"
                            placeholder="Enter Last Name"
                            clearable
                            v-model="form.last_name">
                        </el-input>
                    </el-form-item>

                    <el-form-item
                        label="Email"
                        prop="email"
                        :error="hasError('email', true)">
                        <el-input
                            class="full-width round-input"
                            placeholder="Enter Email"
                            clearable
                            v-model="form.email">
                        </el-input>
                    </el-form-item>
				</div>

				<div class="col-md-6">
					<el-form-item
                        label="User Type"
                        prop="user_type_id"
                        :error="hasError('user_type_id', true)">
                        <el-select
                            class="full-width round-input"
                            placeholder="Select User Type"
                            filterable
                            clearable
                            v-model="form.user_type_id">
                            <el-option
                                v-for="cert in pageData.userTypes"
                                :key="cert.id"
                                :value="cert.id"
                                :label="cert.name">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item
                        label="Phone"
                        prop="phone"
                        :error="hasError('phone', true)">
                        <el-input
                            type="number"
                            class="full-width round-input"
                            placeholder="Enter Phone"
                            clearable
                            v-model="form.phone">
                        </el-input>
                    </el-form-item>

                    <el-form-item
                        label="Date of Birth"
                        prop="birth_day"
                        :error="hasError('birth_day', true)">
                        <el-date-picker
                            class="full-width round-input"
                            v-model="form.birth_day"
                            type="date"
                            value-format="yyyy-MM-dd"
                            clearable
                            placeholder="Pick a date">
                        </el-date-picker>
                    </el-form-item>
				</div>
			</div>
		</el-form>
	</div>
</template>

<script>
	import { formHelper } from '../../mixins/formHelper'
	export default {
		name: 'RegistrationUserForm',
		mixins: [formHelper],
		props: {
			pageData: {},
			nextStep: {}
		},
		data() {
			return {
				form: {
                    user_type_id: null,
                    first_name: null,
                    last_name: null,
                    email: null,
                    phone: null,
                    birth_day: null
				},
				rules: {
                    first_name: {required: true, message: 'This field is required.', trigger: 'blur'},
                    last_name: {required: true, message: 'This field is required.', trigger: 'blur'},
                    email: [
                        {required: true, message: 'This field is required.', trigger: 'blur'},
                        {type: 'email', message: 'Invalid email.', trigger: 'blur'}
                    ],
                    user_type_id: {required: true, message: 'This field is required.', trigger: 'change'},
                }
			}
		},
		methods: {
			async validateForm() {
				let item = await this.$refs.form.validate(valid => {
					if (valid) {
						this.nextStep()

						return true
					}

					this.$notify({
            			title: "Error",
            			message: 'Please verify the data.',
            			type: "error"
            		})

					return false
				})

				console.log(item)
			},
		}
	}
</script>

<style lang="scss">
	.registration-user-form {

	}
</style>