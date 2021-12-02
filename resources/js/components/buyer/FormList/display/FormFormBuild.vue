<template>
	<div class="form-builder-wrapper">
		<div class="form-builder-header">
			<div class="form-builder-title">
				{{ __(detailsData.form_title) }}
			</div>
			<div class="form-builder-select" style="float: right"></div>
			<div class="ml-auto">
				<div class="submission-details-download">
					<!--el-select
						v-model="viewSelect"
						class="round-input"
						placeholder="Select">
						<el-option
							v-for="item in view"
							:key="item"
							:label="item"
							:value="item">
						</el-option>
					</!--el-select -->
					<el-button
						round
                        v-if="!submittedToSupplier"
						size="mini"
						@click="resetTemplate">
						{{ __("Reset") }}
					</el-button> &nbsp;&nbsp;
					<el-button
						round
                        v-if="!submittedToSupplier"
						size="mini"
						@click="showTemplate"
						type="primary"
						class="btn btn-black">
            			{{ __("Select Template") }}
          			</el-button> &nbsp;&nbsp;
          			<el-button
			            v-if="!buttonEdit && (formTemplate && formTemplate.length) && !submittedToSupplier"
			            round
			            size="mini"
			            type="primary"
			            @click="editTemplate"
			            class="btn btn-orange">
            			{{ __("Edit") }}
          			</el-button>

			        <!--<el-button
			            v-if="buttonEdit"
			            round
			            size="mini"
			            type="primary"
			            class="btn btn-orange">
			            {{ __("Save") }}
			        </el-button>  -->
        		</div>
      		</div>
		</div>
	    <div class="form-builder-content" v-loading="loadingFormUI">
	        <!--<FormView
	        	:formTemplate="formTemplate"
	        	v-if="viewSelect === 'Form View'">
        	</FormView> -->
	        <form-grid-view
            	v-if="viewSelect === 'Grid View'"
	        	:form-submission="detailsData"
	            :formTemplate="formTemplate"
	            :system-form-groups="formattedSystemFormGroups"
                :submittedToSupplier="submittedToSupplier"
	            :loaded-from-template="loadedFromTemplate"
	            @saveFormTemplate="saveFormTemplate"
	            :buttonEdit="buttonEdit">
	        </form-grid-view>
	    </div>

	    <el-dialog
		    :title="__('Form Templates')"
		    :visible.sync="dialogVisibleFormTemplate"
		    width="80%">
	   		<!-- content here-->

	   		<div class="mt-2" v-loading="templateLoading">
	   			<transition-group name="slide-fade" mode="in-out" tag="div" class="row">
	   				<div
		   				class="col-md-3 mt-3"
		   				v-for="template in buyerFormTemplateList"
		   				:key="template.id"
		   				:data-id="template.id"
		   				@click="selectedTemplate(template)">
		   				<el-card class="template-container">

							<div class="status">{{ __(template.status.name) }}</div>


							<div class="img-placeholder">
								<i class="fas fa-file-contract"></i>
							</div>

							 <div class="template-footer">

		   						<div class="title">{{ __($sf.ucwords(template.name)) }}</div>
								<div class="modified">
									{{template.updated_by? `${__("Last modified by")} ${$sf.ucwords(
		   								template.updated_by_user.displayName
		   								)}`
		   							: ""
		   						}}
		   						</div>
		   						<div class="modified">
									{{
										template.updated_at
										? `${__("Last modified at")} ${template.updated_at}`
										: ""
									}}
		   						</div>
								<div class="template-actions">
								</div>
							</div>
		   				</el-card>
	    			</div>
	   			</transition-group>
	   			<div class="mt-5 text-center">
	   				<el-button
	   					type="text"
	   					@click="loadMore"
	   					v-if="showLoadMore">
	   					{{ __("Load More...") }}
	   				</el-button>
	   			</div>
			</div>

			<span slot="footer" class="dialog-footer">
				<el-button
					@click="closeTemplateList">
					{{ __("Close") }}
				</el-button>
			</span>
		</el-dialog>

        <form-builder-template-view
        	:dialogVisibleTemplateData="dialogVisibleTemplateData"
            :pageData="formBuilderTemplateViewPageData"
            :buyerFromTemplateData="buyerFromTemplateData"
            @closeTemplate="closeTemplateData"
            @setAsTemplate="setAsTemplate"
            :visible.sync="dialogVisibleTemplateData"
            v-if="dialogVisibleTemplateData">
        </form-builder-template-view>

  	</div>
</template>
<script>
	import cloneDeep from "lodash/cloneDeep";
	import pagination from "../../../../mixins/pagination";
	import FormView from "./formBuilder/FormView";

	export default {
		name: "FormFormBuild",
		mixins: [pagination],
		props: {
			detailsData: {
				type: Object,
				required: true,
			},
            pageData: {},
            submittedToSupplier: {
                type: Boolean,
                required: true,
                default: true
            }
		},
		components: {
			FormView,
		},
		data() {
			return {
				systemFormGroups: this.pageData.form_field_groups,
				view: ["Form View", "Grid View"], // fix errors here remove translation ready code cause it causes error
				viewSelect: "Grid View", // return korean translation of grid view as value, also not use for choices
				dialogVisibleFormTemplate: false,
				buttonEdit: false,
				buyerFormTemplateList: [],
				showLoadMore: true,
				showForm: false,
				loadingFormUI: false,
				templateLoading: false,
				loadedFromTemplate: false,
                buyerFromTemplateData: [],
				formTemplate: [],
				filters: {
					offset: 0,
				},
                dialogVisibleTemplateData: false,
                formBuilderTemplateViewPageData: {
                	formFieldGroups: this.pageData.form_field_groups,
                	formTemplateStatusList: this.pageData.formTemplateStatusList
                },
                originalFormSubmission: null
			};
	  	},
	  	created() {
	  		this.fetchTemplates();

	  		this.checkTemplete();
	  	},
	  	methods: {
	  		showTemplate() {
	  			this.dialogVisibleFormTemplate = true;
	  		},
	  		closeTemplateList() {
                this.dialogVisibleTemplateData = false;
	  			this.dialogVisibleFormTemplate = false;
	  		},
	  		loadMore() {
	  			this.filters.offset = this.filters.offset + this.filters.size;

	  			this.fetchTemplates(true);
	  		},
	  		fetchTemplates(loadMore = false) {
	  			let postData = cloneDeep(this.filters);
				postData.buyer_id = this.pageData.user_id ? this.pageData.user_id : this.$userData.activeUserId

	  			this.templateLoading = true;

	  			this.$API.BuyerFormTemplate.fetch(postData)
	  			.then((res) => {
	  				if (loadMore) {
	  					this.buyerFormTemplateList = [
	  					...this.buyerFormTemplateList,
	  					...res.data.data,
	  					];
	  				} else {
	  					this.buyerFormTemplateList = cloneDeep(res.data.data);
	  				}

	  				this.filters.total = res.data.total;

	  				if (
	  					this.buyerFormTemplateList.length <
	  					this.filters.offset + this.filters.size
	  					) {
	  					this.showLoadMore = false;
	  			}
	  		})
	  			.catch((err) => {
	  				console.log(err);
	  			})
	  			.finally((_) => {
	  				this.templateLoading = false;
	  			});
	  		},
	  		selectedTemplate(data) {
	  			// this.loadingFormUI = true;

	  			// let params = {
	  			// 	form_submission_id: this.detailsData.id,
	  			// };
	  			// console.log(data);

	  			// this.$API.BuyerFormList.addFormBuildTemplate(data.id, params).then((res) => {
	  			// 	console.log(res.data);
	  				// this.checkTemplete();
	  			// });

	  			// this.dialogVisibleFormTemplate = false;

                this.buyerFromTemplateData = data;
                this.dialogVisibleTemplateData = true;
	  		},
	  		checkTemplete() {
	  			this.loadingFormUI = true;
	  			this.$API.BuyerFormList.checkTemplete(this.detailsData.id)
	  			.then((res) => {
	  				this.formTemplate = res.data;
	  				this.originalFormSubmission = res.data
	  				this.$emit("templateUI", res.data);
	  				this.loadingFormUI = false;

	  				this.loadedFromTemplate = false
	  			});
	  		},
	  		resetTemplate() {
	  			if(this.originalFormSubmission){
	  				this.formTemplate = this.originalFormSubmission;
	  				this.loadedFromTemplate = false
	  				setTimeout(_ => {
	  					this.$EventDispatcher.fire("RESET_FORM_SUBMISSION_FIELD");
	  				}, 200)

	  			}
	  		},
	  		editTemplate() {
	  			this.buttonEdit = true;
	  			this.viewSelect = "Grid View"; //remove also this translation ready code
	  		},
	  		saveFormTemplate() {
	  			this.buttonEdit = false;
                // this.checkTemplete();
	  		},
            closeTemplateData() {
                this.dialogVisibleTemplateData = false;
            },
            setAsTemplate(data) {
            	this.systemFormGroups = cloneDeep(data.from_groups)
            	this.formTemplate = cloneDeep(data.form_template)
            	this.buttonEdit = true
            	this.loadedFromTemplate = true

                this.dialogVisibleTemplateData = false;
	  			this.dialogVisibleFormTemplate = false;
            }
	  	},
	  	computed: {
	  		formattedSystemFormGroups() {
	  			return this.systemFormGroups.map(sfg => {
	  				sfg.from_settings = true

	  				return sfg
	  			})
	  		}
	  	}
	}
</script>

<style lang="scss">
	.form-builder-wrapper {
		padding: 10px;
		.form-builder-header {
			display: flex;
			flex-wrap: wrap;
			background-color: #f9f9f9;
			border: 1px solid #e9e9e9;

			.form-builder-title {
				color: #000;
				font-size: 16px;
				padding: 11px;
			}
		}
	}

	.template-container {
		height: 250px;
		cursor: pointer;


		.template-actions {
			position: absolute;
			bottom: 5px;
			right: 40px;

			button {
				font-size: 16px;
			}
		}
        .title{
                word-break: normal;
				font-weight: 600;
            }
	}
</style>
