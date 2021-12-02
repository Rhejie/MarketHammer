<template>
	<div class="buyer-form-builder">
		<el-button
			type="text"
			style="font-size: 14px; font-weight: 700; color: #000;"
			@click="backToList">
			<i class="fas fa-arrow-left ml-2"></i> {{ __('Template List') }}
		</el-button>

		<div class="container" v-loading="loading">
			<div class="row justify-content-md-center inner-container">
				<div class="col-md-auto form-container">
					<div class="text-right mt-3" v-if="!hiddenButton">
						<div class="header-title-details float-left">
							{{ __dt(template.translations, 'name', $sf.ucwords(template.name)) }}
    					</div>
						<el-button
							type="primary"
							round
							class="btn btn-black"
							@click="showFormGroup = true">
							<i class="fas fa-plus"></i> {{ __('Add Group') }}
						</el-button>

						<el-button
							type="primary"
							round
							class="btn btn-black"
							@click="showFormField = true">
							<i class="fas fa-plus"></i> {{ __('Add Field') }}
						</el-button>
					</div>
					<el-table
						:data="formBuilder.filter(fb => !fb.is_deleted)"
						fit>
						<el-table-column>
							<template slot-scope="scope">
								<el-select
									v-model="scope.row.form_field_group_id"
									filterable
									clearable
									@change="categorySelected(scope.row)"
									:placeholder="__('Select Group')">
									<el-option
										v-for="group in selectableCategories.filter(sc => scope.row.form_field_group_id == sc.id || !formBuilder.find(fb => fb.form_field_group_id == sc.id))"
										:key="group.id"
										:label="__dt(group.translations, 'name', $sf.ucwords(group.name))"
										:value="group.id">
									</el-option>
								</el-select>

								<el-button
									v-if="scope.row.position != largestPosition && !hiddenButton"
									type="text text-red"
									@click="removeCategory(scope.row)">
									<i class="fas fa-times-circle"></i>
								</el-button>

								<el-button
									v-else-if="scope.row.position == largestPosition && !hiddenButton"
									type="text"
									@click="addNewCategory(scope.row.position)">
									<i class="fas fa-plus-circle" style="font-size: 14px;"></i>
								</el-button>

								<template
									v-if="scope.row.form_field_group_id">
									<el-table
										style="overflow-y: scroll;"
										v-if="scope.row.form_fields && scope.row.form_fields.filter(ff => !ff.is_deleted).length"
										:data="scope.row.form_fields.filter(ff => !ff.is_deleted)"
										fit>
										<el-table-column width="50">
											<template slot-scope="innerScope">
												<span>&nbsp;</span>
											</template>
										</el-table-column>

										<el-table-column
											width="300">
											<template slot-scope="innerScope">
												<span v-if = "innerScope.row.field_type != 'Single Checkbox'">{{ innerScope.row.field_label }}</span>
											</template>
										</el-table-column>

										<el-table-column>
											<template slot-scope="innerScope">
												<template v-if = "innerScope.row.field_type == 'Matrix'">
			                                        <element-matrix  :options-list = "innerScope.row.field_options" 
			                                            :value-data = "innerScope.row.field_answer_value"
			                                            :allow-to-remove = "false"
			                                            :allow-to-add = "false" >
			                                        </element-matrix>
			                                    </template>
			                                    <template v-else>
			                                        <element-field
			                                            :field-type = "innerScope.row.field_type"
			                                            :field-label = "innerScope.row.field_label"
			                                            :field-value.sync = "innerScope.row.field_answer_value"
			                                            :field-options = "innerScope.row.field_options"
			                                            :form-field-data = "innerScope.row"
			                                            :form-fields-list = "scope.row.form_fields">
			                                        </element-field>
			                                    </template>
											</template>
										</el-table-column>

										<el-table-column width="90">
											<template slot-scope="innerScope">
												<el-switch v-model="innerScope.row.is_required"
                                                    :disabled="hiddenButton"></el-switch>
												<el-tooltip
													class="item"
													effect="dark"
													placement="top"
													:content="__('Toggle this to make this field required when supplier fill-in this form.')">
													<i class="el-icon-info"></i>
												</el-tooltip>
											</template>
										</el-table-column>

										<el-table-column width="50">
											<template slot-scope="innerScope">
												<el-button
													type="text text-red"
                                                    v-if="!hiddenButton"
													@click="removeField(scope.row.form_fields, innerScope.row, innerScope.$index)">
													<i class="fas fa-times-circle"></i>
												</el-button>
											</template>
										</el-table-column>
									</el-table>

									<el-table
										fit
										:show-header="false"
										:data="[1]">
										<el-table-column width="50">
											<template slot-scope="innerScope">
												<span>&nbsp;</span>
											</template>
										</el-table-column>

										<el-table-column>
											<el-select
												@change="addNewField(scope.row)"
                                                v-if="!hiddenButton"
												v-model="scope.row.new_field"
												filterable
												clearable
												:placeholder="__('Select Field Type')">
												<el-option
													v-for="field in scope.row.selectable_fields.filter(sf => !scope.row.form_fields.find(tff => tff.form_field_id == sf.id))"
													:key="field.id"
													:label="__dt(field.translations, 'field_label', $sf.ucwords(field.field_label))"
													:value="field.id">
												</el-option>
											</el-select>
										</el-table-column>
									</el-table>
								</template>
							</template>
						</el-table-column>
					</el-table>

					<div class="text-right mt-3">
						<el-button
							v-if="isPage"
							@click="backToList">
							{{ __('Close') }} 
						</el-button>

						<el-button
							type="primary"
                            v-if="!hiddenButton"
							class="btn btn-black"
							@click="validateTemplate">
							{{ __('Save') }}
						</el-button>
					</div>
				</div>
			</div>
		</div>

		<form-field-form
            v-if="showFormField"
            :form-groups="formFieldGroups"
            :page-data="formFieldData"
            :visible.sync="showFormField"
            @close="handleClose">
        </form-field-form>

     	<form-field-group-form
            v-if="showFormGroup"
            :visible.sync="showFormGroup"
            @close="handleClose">
        </form-field-group-form>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'

	export default {
		name: "BuyerFormTemplateBuilder",
		props: {
			pageData: {
				type: Object,
				required: true
			},
			isPage: {
				default: true
			},
			id: {},
            hiddenButton: {
                default: false,
            }
		},
		data() {
			let formFieldData = {allowToLink : false}
			let id = this.$route.params.id ? this.$route.params.id : this.id

			return {
				showFormField: false,
				showFormGroup: false,
				loading: false,
				formFieldGroups: this.pageData.formFieldGroups,
				template: null,
				formBuilder: [
					{
						id: null,
						type: 'group',
						level: 0,
						position: 0,
						is_deleted: false,
						is_new: true,
						is_updated: false,
						is_required: false,
						form_field_id: null,
						buyer_form_template_id: id,
						form_field_group_id: null,
						new_field: null,
						selectable_fields: [],
						form_fields: []
					}
				],
				optionReferenceList: this.pageData.optionReferenceList,
				formFieldData : formFieldData
			}
		},
		created() {
			this.show()

			this.$EventDispatcher.listen('FORM_FIELD_GROUPS_MODULE_ITEM_CREATED', group => {
				group.form_fields = []
				this.formFieldGroups.push(cloneDeep(group))
			})

			this.$EventDispatcher.listen('FORM_FIELD_MODULE_ITEM_CREATED', field => {
				let group = this.formFieldGroups.find(ffg => ffg.id == field.form_field_group_id)

				if (group) {
					group.form_fields.push(field)

					let formGroup = this.formBuilder.find(fb => fb.form_field_group_id == field.form_field_group_id)

					if (formGroup) {
						formGroup.selectable_fields = cloneDeep(group.form_fields)
					}
				}
			})
		},
		methods: {
			show() {
				this.loading = true

				let id = this.$route.params.id ? this.$route.params.id : this.id

				this.$API.BuyerFormTemplate.show(id)
				.then(res => {
					this.template = cloneDeep(res.data)
					if (res.data && res.data.template_form_groups && res.data.template_form_groups.length) {
						this.formBuilder = res.data.template_form_groups.map(tfg => {
							let formFieldCategory = this.formFieldGroups.find(ffg => ffg.id == tfg.form_field_group_id)
							
							let obj = {
								form_field_group_id: formFieldCategory.id,
								type: 'group',
								level: tfg.level,
								position: tfg.position,
								id: tfg.id,
								is_deleted: false,
								is_new: false,
								is_updated: false,
								buyer_form_template_id: id,
								new_field: null,
								selectable_fields: cloneDeep(formFieldCategory ? formFieldCategory.form_fields : []),
								form_fields: tfg.form_fields.map(ff => {

									let newFf = ff.form_field ? cloneDeep(ff.form_field) : {}
									newFf.id = ff.id
									newFf.is_deleted =  false
									newFf.is_updated =  false
									newFf.is_new =  false
									newFf.is_required =  ff.is_required ? true : false
									newFf.level =  0
									newFf.position = 0
									newFf.form_field_id = ff.form_field.id ? ff.form_field.id : null
									newFf.field_type = ff.form_field.field_type ? ff.form_field.field_type : null

									if(ff.form_field.field_label){
										newFf.field_label = this.__dt(ff.form_field.translations, 'field_label', ff.form_field.field_label)
									}else{
										newFf.field_label = null
									}

		                            newFf.field_answer_value = null
		                            let value_type = this.$ffh.getPropertyFieldType(newFf.field_type, 'value_type')
		                            if(value_type == 'multiple' || value_type == 'matrix'){
		                                newFf.field_answer_value = []
		                            }

									return newFf
								})
							}

							return obj
						})
					}
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			validateTemplate() {
				this.$confirm('Form groups with no fields selected will be neglected during saving process.', 'Confirm', {
					confirmButtonText: 'Confirm',
					cancelButtonText: 'Cancel',
					type: 'info'
				})
				.then(_ => {
					this.buildTemplate()
				})
				.catch(_ => {})
			},
			buildTemplate() {
				let postData = []

				for (let x of this.formBuilder) {
					if (x.id || (x.form_field_group_id && !x.is_deleted)) {
						let item = cloneDeep(x)
						delete item.selectable_fields
						item.form_fields = x.form_fields

						postData.push(item)
					}
				}
				console.log('buildTemplatem', postData)

				this.loading = true

				this.$API.BuyerFormTemplate.buildTemplate(postData)
				.then(res => {
					this.show()
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			backToList() {
				this.$router.push({name: 'Buyer Form Template List'})
			},
			categorySelected(category) {
				let formFieldCategory = this.formFieldGroups.find(ffg => ffg.id == category.form_field_group_id)

				if (category.position == this.largestPosition) {
					this.addNewCategory(category.position)
				}

				category.id ? category.is_updated = true : null

				category.form_fields = category.form_fields.map(ff => {
					ff.is_deleted = true

					return ff
				})

				category.selectable_fields = cloneDeep(formFieldCategory ? formFieldCategory.form_fields : [])
			},
			addNewCategory(position) {
				let id = this.$route.params.id ? this.$route.params.id : this.id

				let newCategory = {
					id: null,
					type: 'group',
					is_deleted: false,
					is_updated: false,
					is_new: true,
					level: 0,
					position: position + 1,
					buyer_form_template_id: id,
					form_field_group_id: null,
					form_fields: []
				}

				this.formBuilder.push(newCategory)
			},
			removeCategory(category) {
				this.$confirm('Are you sure you want to remove this category?', 'Confirm', {
					confirmButtonText: 'Confirm',
					cancelButtonText: 'Cancel',
					type: 'error'
				})
				.then(_ => {
					console.log(category)
					category.is_deleted = true
					category.form_field_group_id = null
					this.formFieldGroups.append(category)
				})
				.catch(err => {
					console.log(err)
				})

				return
			},
			addNewField(category, position = 0) {
				let field = cloneDeep(category.selectable_fields.find(sf => sf.id == category.new_field))
				field.model = null
				field.arrayModel = []
				field.is_deleted = false
				field.is_updated = false
				field.is_new = true
				field.is_required = false
				field.level = 1
				field.position = position + 1
				field.form_field_id = field.id
				field.id = null

				if(field.field_label){
					field.field_label = this.__dt(field.translations, 'field_label', field.field_label)
				}

				category.form_fields.push(field)

				category.new_field = null
			},
			removeField(list, field, index) {
				this.$confirm('Are you sure you want to remove this field?', 'Confirm', {
					confirmButtonText: 'Confirm',
					cancelButtonText: 'Cancel',
					type: 'error'
				})
				.then(res => {
					field.is_deleted = true
					field.form_field_id = null //null first form field id
					this.formFieldGroups.append(field) //append the previously closed field
				})
				.catch(_ => {})

				return
			},
			handleClose() {
				this.showFormField = false
				this.showFormGroup = false
			}
		},
		computed: {
			largestPosition() {
				return this.formBuilder[this.formBuilder.length - 1].position
			},
			selectableCategories() {
				return this.formFieldGroups
			}
		},
		beforeDestroy() {
			this.$EventDispatcher.destroy([
				'FORM_FIELD_GROUPS_MODULE_ITEM_CREATED',
				'FORM_FIELD_MODULE_ITEM_CREATED'
			])
		}
	}
</script>

<style lang="scss">
	html,
	body,
	#app,
	.content-wrapper,
	.app {
		height: 100% !important;
	}

	.backoffice-container .el-table {
		height: 85% !important;
	}

	.buyer-form-builder {
		max-height: 95%;
		overflow-y: scroll;
		.container {
			height: 95%;

			.inner-container {
				height: 100%;

				.form-container {
					width: 80%;
					background-color: #fff;
					height: 100%;
				}
			}
		}
	}

	.el-upload {
		width: 100%;

		.el-upload-dragger {
			width: inherit;
			height: 100%;

			.el-icon-upload {
				margin: 15px 0 16px !important;
				font-size: 40px !important;
				line-height: 20px !important;
			}
		}
	}
</style>
