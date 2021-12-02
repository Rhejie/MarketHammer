<template>
	<div class="supplier-general-form">
		<el-form
			:model="form"
			:rules="rules"
			ref="supplierGeneralForm">
			<div class="row">
				<div class="col-md-6">
					<el-form-item
						label="Legal Name"
						prop="legal_name">
						<el-input
							v-model="form.legal_name"
							clearable
							class="full-width round-input"
							placeholder="Enter Legal Name">
						</el-input>
					</el-form-item>

					<el-form-item
						label="English Name"
						prop="english_name">
						<el-input
							v-model="form.english_name"
							clearable
							class="full-width round-input"
							placeholder="Enter English Name">
						</el-input>
					</el-form-item>

					<el-form-item
						label="Industry Type"
						prop="industry_type_id">
						<el-select
							v-model="form.industry_type_id"
							class="full-width round-input"
							clreable
							filterable
							@change="industryTypeChanged"
							placeholder="Select Industry Type">
							<el-option
								v-for="item in pageData.industryTypes"
								:key="item.id"
								:value="item.id"
								:label="item.name">
							</el-option>
						</el-select>
					</el-form-item>

					<el-form-item
						label="Basic Category"
						prop="business_category_id">
						<el-select
							v-model="form.business_category_id"
							class="full-width round-input"
							clreable
							filterable
							placeholder="Select Basic Category">
							<el-option
								v-for="item in selectableBusinessCategories"
								:key="item.id"
								:value="item.id"
								:label="item.name">
							</el-option>
						</el-select>
					</el-form-item>

					<el-form-item
						label="Bus. Category Code"
						prop="business_category_id">
						<el-select
							v-model="form.business_category_id"
							class="full-width round-input"
							clreable
							disabled
							filterable
							placeholder="Select Bus. Category Code">
							<el-option
								v-for="item in selectableBusinessCategories"
								:key="item.id"
								:value="item.id"
								:label="item.name">
							</el-option>
						</el-select>
					</el-form-item>
				</div>

				<div class="col-md-6">
					<el-form-item
						label="R & D Staffs"
						prop="rnd_staff_count_id">
						<el-select
							v-model="form.rnd_staff_count_id"
							class="full-width round-input"
							clreable
							filterable
							placeholder="Select R & D Staffs">
							<el-option
								v-for="item in pageData.employeeCounts"
								:key="item.id"
								:value="item.id"
								:label="item.name">
							</el-option>
						</el-select>
					</el-form-item>

					<el-form-item
						label="Date Established"
						prop="rnd_staff_count_id">
						<el-date-picker
							v-model="form.date_established"
							class="full-width round-input"
							type="date"
							placeholder="Pick a date">
						</el-date-picker>
					</el-form-item>

					<el-form-item
						label="Company Status"
						prop="status">
						<el-select
							v-model="form.status"
							class="full-width round-input"
							filterable
							clearable
							placeholder="Select Status">
							<el-option label="Public" value="public"></el-option>
							<el-option label="Private" value="private"></el-option>
						</el-select>
					</el-form-item>

					<el-form-item
						label="Website"
						prop="website">
						<el-input
							v-model="form.website"
							clearable
							class="full-width round-input"
							placeholder="Enter Website">
						</el-input>
					</el-form-item>

					<el-form-item
						label="EID Certificate"
						prop="eid_certificate">
						<el-input
							v-model="form.eid_certificate"
							clearable
							class="full-width round-input"
							placeholder="Enter EID Certificate">
						</el-input>
					</el-form-item>
				</div>
			</div>
		</el-form>
	</div>
</template>

<script>
	export default {
		name: 'SupplierGeneralForm',
		props: {
			pageData: {
				type: Object,
				required: true
			},
			nextStep: {}
		},
		data() {
			return {
				form: {
					legal_name: null,
					english_name: null,
					industry_type_id: null,
					business_category_id: null,
					rnd_staff_count_id: null,
					date_established: null,
					website: null,
					eid_certificate: null
				},
				rules: {
					legal_name: {required: true, message: 'This field is required.', trigger: 'blur'},
					industry_type_id: {required: true, message: 'This field is required.', trigger: 'change'},
					business_category_id: {required: true, message: 'This field is required.', trigger: 'change'}
				}
			}
		},
		methods: {
			async validateForm() {
				let item = await this.$refs.supplierGeneralForm.validate(valid => {
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
			industryTypeChanged() {
				this.form.business_category_id = null
			},
		},
		computed: {
			selectableBusinessCategories() {
				return this.form.industry_type_id ? 
					this.pageData.businessCategories.filter(bc => bc.industry_type_id == this.form.industry_type_id) :
					this.pageData.businessCategories
			},
		}
	}
</script>

<style lang="scss">
	.supplier-general-form {

	}
</style>