<template>
	<div class="main-container">
		<div class="table-container">
			<div class="card borderless">
				<div class="card-actions">
					<div class="header-title">
                    	<h5>RFQ List </h5>
                    </div>
					<div class="secondary-action-buttons">
						<div class="add-new-button" v-loading="loading">
							<el-button
								round
								class="btn btn-black"
								@click="showForm = true">
								<i class="fas fa-plus"> </i>
								{{ __('Add Form Template') }}
							</el-button>
						</div>
					</div>
				</div>
					<el-card class="p-3" >
						<div class="text-right">
							
						</div>

						<div class="mt-2">
							<template v-if="!buyerFormTemplateList.length">
								<div class="text-center mt-5 text-black-50">
									{{ __('No template to show. You can create a new template by clicking the Add Form Template button.') }}
								</div>
							</template>
							<template v-else>
								<transition-group
									name="slide-fade"
									mode="in-out"
									tag="div"
									class="row">
									<div
										class="col-md-3 mt-3"
										v-for="template in buyerFormTemplateList"
										:key="template.id"
										:data-id="template.id">
										<el-card
											class="template-container">

											<div class="status">{{ __(template.status.name) }}</div>
											
											<div class="img-placeholder" @click="openTemplate(template)">
												<i class="fas fa-file-contract"></i>
											</div>

											<div
											class="template-footer"
											@click="openTemplate(template)">
												<div class="title">{{ __dt(template.translations, 'name', $sf.ucwords(template.name)) }}</div>
												<div class="modified">{{ template.updated_by ? `${__('Last modified by')} ${$sf.ucwords(template.updated_by_user.displayName)}` : '' }}</div>
												<div class="modified">{{ template.updated_at ? `${__('Last modified at')} ${template.updated_at}` : '' }}</div>
											</div>
											<div class="template-actions">
												<el-button
													type="text"
													class="text-blue"
													@click="update(template)">
													<i class="fas fa-edit"></i>
												</el-button>

												<el-button
													type="text"
													class="text-red"
													@click="deleteTemplate(template)">
													<i class="fas fa-trash-alt"></i>
												</el-button>
											</div>
										</el-card>
									</div>
								</transition-group>
							</template>
						</div>

						<div class="mt-5 text-center">
							<el-button
								type="text"
								@click="loadMore"
								v-if="showLoadMore">
								{{ __('Load More...') }}
							</el-button>
						</div>
					</el-card>

					<buyer-form-template-form
						:model="model"
						v-if="showForm"
						:form-template-status-list="pageData.formTemplateStatusList"
						:visible.sync="showForm"
						@close="handleClose">
					</buyer-form-template-form>
			</div>
		</div>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../../mixins/pagination'

	export default {
		name: 'BuyerFormTemplateIndex',
		mixins: [pagination],
		props: {
			pageData: {}
		},
		data() {
			return {
				filters: {
					offset: 0
				},
				showForm: false,
				loading: false,
				showLoadMore: true,
				model: null,
				buyerFormTemplateList: []
			}
		},
		created() {
			this.fetch()

            this.$EventDispatcher.listen('BUYER_FORM_TEMPLATE_MODULE_ITEM_CREATED', template => {
                this.buyerFormTemplateList.push(template)
                this.filters.total++
            })

            this.$EventDispatcher.listen('BUYER_FORM_TEMPLATE_MODULE_ITEM_UPDATED', template => {
                let index = this.buyerFormTemplateList.findIndex(fg => fg.id == template.id)

                if (index > -1) {
                    this.buyerFormTemplateList.splice(index, 1, template)
                }
            })
		},
		methods: {
			loadMore() {
				this.filters.offset = this.filters.offset + this.filters.size

				this.fetch(true)
			},
			fetch(loadMore = false) {
				console.log('this.$userData', this.$userData)
				let postData = cloneDeep(this.filters)
				postData.buyer_id = this.pageData.user_id ? this.pageData.user_id : this.$userData.activeUserId

                this.loading = true

                this.$API.BuyerFormTemplate.fetch(postData)
                .then(res => {
                	if (loadMore) {
                		this.buyerFormTemplateList = [...this.buyerFormTemplateList, ...res.data.data]
                	} else {
                		this.buyerFormTemplateList = cloneDeep(res.data.data)
                	}

                    this.filters.total = res.data.total

                    if (this.buyerFormTemplateList.length < this.filters.offset + this.filters.size) {
                    	this.showLoadMore = false
                    }
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {
                    this.loading = false
                })
			},
			deleteTemplate(template) {
				this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    type: 'warning',
                    confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                	this.delete(template)
                })
            	.catch(() => {})
			},
			delete(template) {
                this.loading = true

                this.$API.BuyerFormTemplate.delete(template.id)
                .then(res => {
                    if (res.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_delete,
                            type: "success"
                        })

                        let index = this.buyerFormTemplateList.findIndex(bft => bft.id == template.id)

                        if (index > -1) {
                            this.buyerFormTemplateList.splice(index, 1)
                            this.model = null
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

                    this.$notify({
                        title: this.__("Error"),
                        message: this.$msg.notif.service_error,
                        type: "error"
                    });
                })
                .finally(_ => {
                    this.loading = false
                })
			},
			update(template) {
                this.showForm = true
                this.model = cloneDeep(template)
            },
			handleClose() {
                this.showForm = false
                this.model = null
			},
			openTemplate(template) {
				this.$router.push({name: 'Buyer Form Template Builder', params: {
					pageData: {
						template: template,
						formFieldGroups: cloneDeep(this.pageData.formFieldGroups)
					},
					id: template.id
				}})
			}
		}
	}
</script>

<style lang="scss">
	.buyer-form-template-index {
		.template-container {
			height: 250px;
			cursor: pointer;
			border: 1px solid #EBEEF5 !important;

			.template-actions {
				position: absolute;
			    right: 25px;
				top: 0;

			    button {
			    	font-size: 13px;
					margin: 0 2px;

					i.fas {
						color:#1d1d1d;
					}
			    }
			}


		}
	}
	.template-footer {
		position: absolute;
		padding: 10px;
	}
	.img-placeholder {
		padding: 35px;
    	height: 125px;
		text-align: center;
		background: #f9f9f9;
		border-bottom: 1px solid #f5f5f5;
		
		i.fas.fa-file-contract {
			font-size: 60px;
    		color: #6692c3;
		}
	}
	.modified {
		font-size: 11px;
    	color: #a1a1a1;
	}
	.status {
		background: #eaf4ff;
		border-radius: 20px;
		display: block;
		max-width: 100px;
		/* padding-left: 10px; */
		margin: 10px;
		text-align: center;
	}
</style>
