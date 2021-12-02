<template>
    <div class="form-grid-view" v-loading="loading">
        <div class="row">
            <div class="col-md-12 button-form-field">
                <div class="text-right mt-3" v-if="buttonEdit">
                    <el-button
                        type="primary"
                        round
                        size="mini"
                        class="btn btn-black"
                        @click="showFormGroup = true">
                        <i class="fas fa-plus"></i> {{__('Add Group')}}
                    </el-button>

                    <el-button
                        type="primary"
                        round
                        size="mini"
                        class="btn btn-black"
                        @click="showFormField = true">
                        <i class="fas fa-plus"></i> {{__('Add Field')}}
                    </el-button>

                    <el-button
                        v-if="buttonEdit"
                        round
                        size="mini"
                        type="primary"
                        @click="saveTemplate"
                        class="btn btn-orange">
                        {{ __("Save") }}
                    </el-button>
                </div>
            </div>
        </div>
        <table class="table table-borderless table-sm" style="width: 100%">
            <thead>
                <th>{{__('Form Group')}}</th>
                <th>{{__('Form Field')}}</th>
                <th>{{__('Value')}}</th>
                <th>{{__('Required')}}</th>
                <th v-if="buttonEdit">{{__('Action')}}</th>
            </thead>
            <tbody v-for="(form, index) in formBuilder.filter(fb => !fb.is_deleted)" :key="index">
                <tr>
                    <td>
                        <el-select
                            v-model="form.form_submission_group_id"
                            :placeholder="__('Select')"
                            :disabled="!buttonEdit"
                            @change="categorySelected(form)">
                            <el-option
                                v-for="(item, index) in formFieldGroups"
                                :key="index"
                                :label="__dt(item.translations, 'name', $sf.ucwords(item.name)) || item.name"
                                :value="item.id">
                            </el-option>
                        </el-select>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td v-if="buttonEdit">
                        <el-button
                            v-if="buttonEdit"
                            type="text text-red"
                            @click="removeCategory(form, form.$index)">
                            <i class="fas fa-trash" style="font-size: 14px"></i>
                        </el-button>
                        <!--el-button
                            v-else-if="form.position == largestPosition && !submittedToSupplier && buttonEdit"
                            type="text"
                            @click="addNewFormGroup(form.position)">
                            <i class="fas fa-plus-circle" style="font-size: 14px"></i>
                        </!--el-button -->
                    </td>
                </tr>
                <template v-if="loadedFromTemplate || form.form_submission_id">
                    <tr v-for="(field, index) in form.form_fields.filter(fft => !fft.is_deleted)" :key="index">
                        <td></td>
                        <td>
                            <span v-if = "field.field_type != 'Single Checkbox'">{{ __(field.field_label) }}</span>
                        </td>
                        <td v-if="field.field_type == 'Matrix'" style="width: 100px">
                            <element-matrix  :options-list = "field.field_options"
                                :value-data = "field.field_answer_value"
                                :allow-to-add = "submittedToSupplier ? false : true" >
                            </element-matrix>
                        </td>
                        <td v-else style="width: 100px">
                            <element-field
                                :field-type = "field.field_type"
                                :field-label = "field.field_label"
                                :field-value.sync = "field.field_answer_value"
                                :field-options = "field.field_options"
                                :form-field-data = "field"
                                :form-fields-list = "form.form_fields">
                            </element-field>
                        </td>
                        <td>
                            <el-switch v-model="field.is_required" :disabled="submittedToSupplier"></el-switch>
                                <el-tooltip
                                    class="item"
                                    effect="dark"
                                    placement="top"
                                    content="Toggle this to make this field required when supplier fill-in this form.">
                                        <i class="el-icon-info"></i>
                                </el-tooltip>
                        </td>
                        <td v-if="buttonEdit">
                            <el-button
                                type="text text-red"
                                v-if="buttonEdit"
                                @click="removeField(form.form_field_template, field, field.$index)">
                                    <i class="fas fa-trash"></i>
                            </el-button>
                        </td>
                    </tr>
                    <tr v-if="!submittedToSupplier && buttonEdit">
                        <td></td>
                        <td>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <el-select
                                                @change="addNewFormField(form)"
                                                v-model="form.new_field"
                                                filterable
                                                clearable
                                                :placeholder="__('Select Field Type')">
                                                <el-option
                                                    v-for="f in form.selectable_fields.filter(sf => !form.form_fields.find(tff => tff.form_field_id == sf.id))"
                                                    :key="f.id"
                                                    :label="__dt(f.translations, 'field_label', $sf.ucwords(f.field_label)) || f.field_label"
                                                    :value="f.id">
                                                </el-option>
                                            </el-select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </template>
            </tbody>
            <tbody>
                <tr v-if="buttonEdit">
                    <td>
                        <el-button
                            v-if="!submittedToSupplier && buttonEdit"
                            @click="addNewFormGroup()">
                            <i class="fas fa-plus"></i> Add Form Group
                        </el-button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!--
        <el-table
            :data="formBuilder.filter(fb => !fb.is_deleted)"
            show-header
            >
            <el-table-column :label="__('Form Group')">
                <template slot-scope="scope">
                    <el-select
                        v-model="scope.row.form_submission_group_id"
                        :placeholder="__('Select')"
                        :disabled="!buttonEdit"
                        @change="categorySelected(scope.row)">
                        <el-option
                            v-for="(item, index) in formFieldGroups"
                            :key="index"
                            :label="__dt(item.translations, 'name', $sf.ucwords(item.name)) || item.name"
                            :value="item.id">
                        </el-option>
                    </el-select>

                    <el-button
                        v-if="scope.row.position != largestPosition && !submittedToSupplier && buttonEdit"
                        type="text text-red"
                        @click="removeCategory(scope.row, scope.$index)">
                        <i class="fas fa-times-circle" style="font-size: 14px"></i>
                    </el-button>
                    <el-button
                    	v-else-if="scope.row.position == largestPosition && !submittedToSupplier && buttonEdit"
                        type="text"
                        @click="addNewFormGroup(scope.row.position)">
                        <i class="fas fa-plus-circle" style="font-size: 14px"></i>
                    </el-button>
                    <template v-if="loadedFromTemplate || scope.row.form_submission_id">
                        <el-table
                            :data="scope.row.form_fields.filter(fft => !fft.is_deleted)"
                            :show-header="false"
                            style="width: 100%">
                            <el-table-column width="50">
                                <template slot-scope="innerScope">
                                    <span>&nbsp;</span>
                                </template>
                            </el-table-column>
                            <el-table-column width="300 ">
                                <template slot-scope="innerScope">
                                    <span v-if = "innerScope.row.field_type != 'Single Checkbox'">{{ __(innerScope.row.field_label) }}</span>
                                </template>
                            </el-table-column>
                            <el-table-column>
                                <template slot-scope="innerScope">

                                    <template v-if = "innerScope.row.field_type == 'Matrix'">
                                        <element-matrix  :options-list = "innerScope.row.field_options"
                                            :value-data = "innerScope.row.field_answer_value"
                                            :allow-to-add = "submittedToSupplier ? false : true" >
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
									<el-switch v-model="innerScope.row.is_required" :disabled="submittedToSupplier"></el-switch>
										<el-tooltip
											class="item"
											effect="dark"
											placement="top"
											content="Toggle this to make this field required when supplier fill-in this form.">
								    			<i class="el-icon-info"></i>
										</el-tooltip>
								</template>
							</el-table-column>

                            <el-table-column width="50">
                                <template slot-scope="innerScope">
                                    <el-button
                                        type="text text-red"
                                        v-if="buttonEdit"
                                        @click="removeField(scope.row.form_field_template, innerScope.row, innerScope.$index)">
                                        <i class="fas fa-times-circle"></i>
                                    </el-button>
                                </template>
                            </el-table-column>
                        </el-table>

                        <el-table
                            v-if="!submittedToSupplier && buttonEdit"
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
									@change="addNewFormField(scope.row)"
									v-model="scope.row.new_field"
									filterable
									clearable
									:placeholder="__('Select Field Type')">
									<el-option
										v-for="field in scope.row.selectable_fields.filter(sf => !scope.row.form_fields.find(tff => tff.form_field_id == sf.id))"
										:key="field.id"
                                        :label="__dt(field.translations, 'field_label', $sf.ucwords(field.field_label)) || field.field_label"
										:value="field.id">
									</el-option>
								</el-select>
							</el-table-column>
						</el-table>
                    </template>
                </template>
            </el-table-column>
        </el-table>

        -->

        <!-- Form Field Modal -->
        <form-submission-field-form
            v-if="showFormField"
            :submission-id="formSubmission.id"
            :form-groups="formFieldGroups.filter(ffg => !ffg.from_settings)"
            :page-data="formFieldData"
            :visible.sync="showFormField"
            :loaded-from-template="loadedFromTemplate"
            @close="handleClose">
        </form-submission-field-form>
        <!-- End Form Field Modal -->

        <!-- Form Group Form Modal -->
        <form-submission-field-group-form
            v-if="showFormGroup"
            :submission-id="formSubmission.id"
            :loaded-from-template="loadedFromTemplate"
            :visible.sync="showFormGroup"
            @close="handleClose">
        </form-submission-field-group-form>
        <!-- End Form Group Form Modal -->
    </div>
</template>
<script>
    import cloneDeep from 'lodash/cloneDeep'
    import _forEach from 'lodash/forEach'

    export default {
        name: "FormGridView",
        props: {
        	systemFormGroups: {},
        	loadedFromTemplate: {},
            formTemplate: {
                type: Array,
                required: true,
            },
            buttonEdit: {
                type: Boolean,
                required: true,
            },
            formSubmission: {},
            submittedToSupplier: {
                type: Boolean,
                required: true
            }
        },
        data() {
            let formFieldData = {allowToLink : false}

            return {
            	loading: false,
                formBuilder: [],
                formFieldData : formFieldData,
                formFieldGroups: this.loadedFromTemplate ? cloneDeep(this.systemFormGroups) : cloneDeep(this.formTemplate),
                deleteSelectedGroup: [],
                deletedSelectedField: [],
                showFormGroup: false,
                showFormField: false
            };
        },
        created() {
            // Listens to form group component when new form group is added
            this.$EventDispatcher.listen('FORM_SUBMISSION_FIELD_GROUPS_MODULE_ITEM_CREATED', group => {
                group.form_fields = []

                if (this.loadedFromTemplate) {
                	group.is_new_not_saved = true
                }

                this.formFieldGroups.push(cloneDeep(group))
            })

            // Listens to form field component when new form field is added
            this.$EventDispatcher.listen('FORM_SUBMISSION_FIELD_MODULE_ITEM_CREATED', field => {
                let group = this.formFieldGroups.find(ffg => ffg.id == field.form_submission_group_id)

                if (group) {
                	if (this.loadedFromTemplate) {
                		field.is_new_not_saved = true
                	}

                    group.form_fields.push(field)

                    let formGroup = this.formBuilder.find(fb => fb.form_submission_group_id == field.form_submission_group_id)

                    if (formGroup) {
                        formGroup.selectable_fields = cloneDeep(group.form_fields)
                    }
                }
            })

            this.$EventDispatcher.listen('RESET_FORM_SUBMISSION_FIELD', form => {
                this.buildTemplate()
            })
        },
        methods: {
        	buildTemplate() {
        		let template = this.loadedFromTemplate ? cloneDeep(this.formTemplate) : cloneDeep(this.formTemplate).filter(ft => ft.is_added_to_template)
        		// sanitize the data
        		try {
                this.loading = true;
	            this.formBuilder = template.map(ft => {
	            	let formFieldCategory = this.formFieldGroups.find(ffg => ffg.id == ft.form_field_group_id)

	            	ft.is_deleted = false
	            	ft.is_new = false
	            	ft.is_updated = false

	            	if (this.loadedFromTemplate) {
		            	ft.form_submission_group_id = ft.form_field_group_id
	            		ft.is_new = true
	            		ft.id = null
	            		ft.name = formFieldCategory ? (formFieldCategory.translations ? this.__dt(formFieldCategory.translations, 'name', formFieldCategory.name) : formFieldCategory.name) : null
	            		ft.description = formFieldCategory ? formFieldCategory.description : null
	            		ft.form_submission_id = this.formSubmission.id
	            		ft.is_added_to_template = true
	            		ft.form_fields = ft.form_fields.map(ff => {
	            			let formField = ft.selectable_fields.find(sf => sf.id == ff.form_field_id)

	            			ff = {...ff, ...cloneDeep(formField)}
	            			ff.is_new = true
	            			ff.form_field_id = ff.id
	            			ff.id = null
	            			ff.form_submission_id = this.formSubmission.id
	            			ff.is_added_to_template = true
                            ff.field_answer_value = null

                            if(formField.field_label){
                                ff.field_label = formField.translations ? this.__dt(formField.translations, 'field_label', formField.field_label) : formField.field_label
                            }

                            let value_type = this.$ffh.getPropertyFieldType(ff.field_type, 'value_type')
                            if(value_type == 'multiple' || value_type == 'matrix'){
                                ff.field_answer_value = []
                            }

	            			return ff
	            		})
	            	} else {
	            		ft.selectable_fields = cloneDeep(ft.form_fields)
	            		ft.form_fields = ft.form_fields.filter(ff => ff.is_added_to_template).map(ff => {
	            			ff.is_new = false
	            			ff.is_deleted = false
	            			ff.form_field_id = ff.id

                            if(ff.field_answer_value == undefined){
                                ff.field_answer_value = null

                                let value_type = this.$ffh.getPropertyFieldType(ff.field_type, 'value_type')
                                if(value_type == 'multiple' || value_type == 'matrix'){
                                    ff.field_answer_value = []
                                }
                            }

	            			return ff
	            		})
	            		ft.form_submission_group_id = ft.id
	            	}

	            	return ft
            	})

                this.loading = false
	         	} catch (er) {
	         		console.log(er)
	         	}
        	},
            handleClose() {
                this.showFormField = false
                this.showFormGroup = false
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
            saveTemplate() {
            	let postData = []
                let fBuilder = cloneDeep(this.formBuilder)
				for (let x of fBuilder) {
					if (x.id || (x.form_submission_group_id && !x.is_deleted)) {
						let item = cloneDeep(x)
						delete item.selectable_fields

                        _forEach(x.form_fields, fn =>{
                            fn.field_settings = null
                            if(fn.field_answer_value && (!Array.isArray(fn.field_answer_value) || (Array.isArray(fn.field_answer_value) && fn.field_answer_value.length > 0))){

                                let valueType = this.$ffh.getPropertyFieldType(fn.field_type, 'value_type')
                                if(valueType == 'multiple'){
                                    fn.field_settings = {defaultValue : {values : fn.field_answer_value}}
                                }
                                else{
                                    fn.field_settings = {defaultValue : fn.field_answer_value}
                                }

                            }
                            fn.field_options = fn.field_original_options !== undefined ? fn.field_original_options : fn.field_options
                        })

                        item.form_fields = x.form_fields
						postData.push(item)
					}
				}

				for (let x of this.formFieldGroups.filter(ffg => ffg.is_new_not_saved)) {
					let newCategory = this.addNewFormGroup(0, true)
					newCategory.is_added_to_template = false
					newCategory.name = x.name
					newCategory.description = x.description
					newCategory.selectable_fields = cloneDeep(x.form_fields)
					newCategory.form_fields = x.form_fields.map(ff => {
						newCategory.new_field = ff.id
						let newField = this.addNewFormField(newCategory, 0, true)
						newField.is_added_to_template = false

						return newField
					})

					delete newCategory.selectable_fields

					postData.push(newCategory)
				}
                console.log(postData, this.formSubmission.id, this.loadedFromTemplate)

				// this.loading = true

            	this.$API.BuyerFormList.updateFormTemplate(postData, this.formSubmission.id, this.loadedFromTemplate)
            	.then(res => {
                    console.log('===========template response=========================');
                    console.log(res);
                    console.log('====================================');
                	this.$emit("saveFormTemplate");
            	})
            	.catch(err => {
            		console.log(err)
            	})
            	.finally(_ => {
            		// this.loading = false
            	})
            },
            categorySelected(category) {
				let formFieldCategory = this.formFieldGroups.find(ffg => ffg.id == category.form_submission_group_id)

				if (category.position == this.largestPosition) {
					this.addNewFormGroup(category.position)
				}

				category.id ? category.is_updated = true : null


				category.form_fields = category.form_fields.map(ff => {
					ff.is_deleted = true

					return ff
				})

				category.selectable_fields = cloneDeep(formFieldCategory ? formFieldCategory.form_fields : [])
				category.name = formFieldCategory ? (formFieldCategory.translations ? this.__dt(formFieldCategory.translations, 'name', formFieldCategory.name) : formFieldCategory.name) : null
				category.description = formFieldCategory ? formFieldCategory.description : null
			},
			addNewFormGroup(position, isReturn = false) {
                let newCategory = {
					id: null,
					name: null,
					description: null,
					type: 'group',
					is_deleted: false,
					is_updated: false,
					is_new: true,
					level: 0,
					position: position + 1,
					form_submission_id: this.formSubmission.id,
					form_fields: [],
					selectable_fields: [],
					is_added_to_template: true
				}

				if (isReturn) {
					return newCategory
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
					category.is_deleted = true
				})
				.catch(err => {
					console.log(err)
				})

				return
			},
            addNewFormField(category, position = 0, isReturn = false) {
            	let itemOne = category.form_fields[0]
				let field = cloneDeep(category.selectable_fields.find(sf => sf.id == category.new_field))

				field.model = null
				field.arrayModel = []
				field.is_deleted = false
				field.is_updated = false
				field.is_new = true
				field.is_required = false
				field.level = 1
				field.position = position + 1
				field.form_submission_id = this.formSubmission.id
				field.form_submission_group_id = itemOne ? itemOne.form_submission_group_id : null
				field.form_field_id = field.id
				field.id = null
				field.is_added_to_template = true
				category.new_field = null

                if(field.field_label){
                    field.field_label = field.translations ? this.__dt(field.translations, 'field_label', field.field_label) : field.field_label
                }

				if (isReturn) {
					return field
				}

				category.form_fields.push(field)
			},
        },
        computed: {
            largestPosition() {
                return this.formBuilder[this.formBuilder.length - 1].position
            },
        },
        watch: {
        	formTemplate: {
        		handler() {
    				this.formFieldGroups = this.loadedFromTemplate ? cloneDeep(this.systemFormGroups) : cloneDeep(this.formTemplate)

        			this.buildTemplate()
        		},
        		immediate: true,
        		deep: true
        	}
        }
    }
</script>
<style lang="scss">
	html,
	body,
	#app,
	.content-wrapper,
	.main-container,
	.content-div,
	.app {
		height: 100% !important;
	}

    .button-form-field {
        margin-bottom: 10px;
    }

	.form-grid-view {
		max-height: 600px;
		overflow-y: scroll;
	}
    .form-grid-view {
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }
    .form-grid-view::-webkit-scrollbar {
        width: 5px;
        height: 5px;
    }

    .form-grid-view::-webkit-scrollbar-thumb {
        background: #a1a1a1;
        border-radius: 25px;
    }
</style>
