<template>
	<div class="event-component-index container">
		<div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card borderless">
                    <div class="card-header">
                        <div class="card-title">Business Claims List</div>
                    </div>

                    <div class="card-body">
                        <div class="card-actions">
                        	<div class="input-search-container">
                                <el-input
                                	style="width: 100% !important;"
                                    class="input-search"
                                    v-model="filters.searchString"
                                    placeholder="Type to search"
                                    suffix-icon="el-icon-search"
                                    @keypress.enter.native="getEvents"
                                    :disabled="gettingEvents">
                                </el-input>
                            </div>

                            <!-- <div class="action-button-container text-center custom-container">
                          		<base-filter-dropdown-box 
									width="360"
									class="base-filter-box">
									<el-form
										label-position="top"
										slot="body">
										<el-form-item
											label="Date">
											<el-date-picker
												class="full-width"
												v-model="filters.daterange"
												type="daterange"
												clearable
												start-placeholder="Start"
												end-placeholder="End"
												size="small">
											</el-date-picker>
										</el-form-item>
										<el-form-item
											label="Business">
											<el-select
												v-model="filters.business"
												filterable
												clearable
												size="small"
												class="full-width"
												placeholder="Select business">
												<el-option
													v-for="business in businessClaims.businessList"
													:key="business.value"
													:label="business.label"
													:value="business.value">
												</el-option>
											</el-select>
										</el-form-item>
										<el-form-item
											label="Status">
											<el-select
												v-model="filters.isActive"
												size="small"
												placeholder="Select status"
												class="full-width">
												<el-option label="Active" :value="true"></el-option>
												<el-option label="Inactive" :value="false"></el-option>
												<el-option label="All" :value="null"></el-option>
											</el-select>
										</el-form-item>
										<el-button
											type = "primary"
											size="small"
							  				class="full-width"
										  	@click="getEvents">
							                Apply
						              	</el-button> 
									</el-form>
								</base-filter-dropdown-box>

								<div class="cloud-container">
                                  	<button type="button" class="btn btn-outline-gray">
	                                    <svg 
	                                    	width="1em" 
	                                    	height="1em" 
	                                    	viewBox="0 0 16 16" 
	                                    	class="bi bi-cloud-upload" 
	                                    	fill="currentColor" 
	                                    	xmlns="http://www.w3.org/2000/svg">
	                                        	<path 
	                                        		fill-rule="evenodd" 
	                                        		d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z">
                                        		</path>
	                                        	<path 
	                                        		fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z">
                                        		</path>
                                  		</svg>
                                  	</button>
                             	</div>
	                            <div class="add-button-container">
	                                <button type="button" class="btn btn-primary btn-red" @click="openEventForm">Add Event</button>
	                            </div>
                          </div> -->
                        </div>

                        <!-- Table Section -->
                        <section class="table-content" v-loading="gettingEvents">
				        	<el-table
				        		fit
				        		:data="claimsData">
				        		<el-table-column label="Business Name">
				        			<template slot-scope="scope">
				        				{{ scope.row.business.businessName }}
				        			</template>
				        		</el-table-column>

				        		<el-table-column label="Contact Name" prop="name">
				        		</el-table-column>

				        		<el-table-column label="Contact Number" prop="number">
				        		</el-table-column>

				        		<el-table-column label="Designation" prop="designation">
				        		</el-table-column>

				        		<el-table-column label="Email" prop="email">
				        		</el-table-column>

				        		<el-table-column label="Actions" >
				        			<template slot-scope="scope">
				        				<el-button
		        							@click="handleUpdateClick(scope.row)"
		        							type="text"
		        							icon="el-icon-view"
		        							class="text-blue action-button">
		        						</el-button>
		        						<span>|</span>
		        						<el-button
		        							@click="deleteEvent(scope.row)"
		        							type="text"
		        							icon="el-icon-delete-solid"
		        							class="text-danger action-button">
		        						</el-button>
				        			</template>
				        		</el-table-column>

				        		<!-- <el-table-column
				        			v-for="col in columns"
				        			:key="col.key"
				        			:label="col.label"
				        			:prop="col.prop">
				        			<template slot-scope="scope">
				        				<template v-if="col.key !== 'actions'">
				        					<span>{{ scope.row[col.key] }}</span>
				        				</template>
				        				<template v-else-if="col.key == 'business'">
				        					<span>{{ scope.row.business.businessName }}</span>
				        				</template>
				        				<template v-else>
				        					<div>
				        						<el-button
				        							@click="handleUpdateClick(scope.row)"
				        							type="text"
				        							icon="el-icon-edit"
				        							class="text-blue action-button">
				        						</el-button>
				        						<span>|</span>
				        						<el-button
				        							@click="deleteEvent(scope.row)"
				        							type="text"
				        							icon="el-icon-delete-solid"
				        							class="text-danger action-button">
				        						</el-button>
				        					</div>
			        					</template>
				        			</template>
				        		</el-table-column> -->
				        	</el-table>

				        	<div class="text-right">
	                            <global-pagination
		                            :current_page="filters.page"
		                            :current_size="filters.size"
		                            :pagination="filters"
		                            @handleSizeChange="handleSizeChange"
		                            @handleCurrentChange="handleCurrentChange">
	                            </global-pagination>
	                        </div>
				        </section>
				        <!-- End of Table Section -->
                    </div>
                </div>
            </div>
        </div>

        <el-dialog
        	:visible.sync="showEventForm"
        	@close="closeEventForm"
        	title="Business claim details"
        	width="60%"
        	top="4vh">
        	<el-form
        		v-loading="saving"
        		:rules="rules"
        		:model="eventForm"
        		ref="eventForm"
        		label-position="top">
        		<el-row
        			:gutter="50">
        			<el-col :xl="12" :lg="12" :md="24" :sm="24">
        				<el-form-item
		        			label="Business Name">
		        			<el-input
		        				v-model="getBusinessName"
		        				clearable
		        				disabled
		        				class="full-width">
		        			</el-input>
		        		</el-form-item>
		        		<el-form-item
		        			label="Contact Name">
		        			<el-input
		        				v-model="selectedClaim.name"
		        				disabled
		        				class="full-width">
		        			</el-input>
		        		</el-form-item>
		        		<el-form-item
		        			label="Contact Number">
		        			<el-input
		        				v-model="selectedClaim.number"
		        				disabled
		        				class="full-width">
		        			</el-input>
		        		</el-form-item>
		        		<el-form-item
		        			label="Designation">
		        			<el-input
		        				v-model="selectedClaim.designation"
		        				disabled
		        				class="full-width">
		        			</el-input>
		        		</el-form-item>
		        		<el-form-item
		        			label="Email">
		        			<el-input
		        				v-model="selectedClaim.email"
		        				disabled
		        				class="full-width">
		        			</el-input>
		        		</el-form-item>
        			</el-col>
        			<el-col :xl="12" :lg="12" :md="24" :sm="24">
		        		<label>Files Uploaded</label>
	        			<div v-if="getClaimFiles.length > 0">
        					<a class="el-upload-list__item-name" :href="`/storage${file.mediaPath}`" v-for="file in getClaimFiles" target="_blank">
    							<i class="el-icon-document"></i>{{ file.mediaPath.substring(28) }}
							</a>	
	        			</div>
        			</el-col>
        		</el-row>
        	</el-form>

        	<span slot="footer" class="dialog-footer">
			    <el-button 
			    	@click="closeEventForm">
			    	Close
			    </el-button>
			    <el-button 
			    	@click="eventForm.id ? updateEvent() : saveEvent()"
			    	type="primary"
			    	class="btn-primary">
			    	{{ eventForm.id ? 'Update' : 'Save'}}
			    </el-button>
			</span>
        </el-dialog>
    </div>
</template>

<script>
	import axios from 'axios'
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../mixins/formHelper.js'
	import __message from '../../../mixins/messageAlert.js'
	export default {
		name: 'EventIndex',
		props: {
			businessClaims: {
				required: true
			}
		},
		mixins: [formHelper, __message],
		data() {
			let columns = [
				{label: 'Contact Name', key: 'name'},
				{label: 'Business Name', key: 'business'},
				{label: 'Contact Number', key: 'number'},
				{label: 'Designation', key: 'designation'},
				{label: 'Email', key: 'email'},
				{label: 'Actions', key: 'actions'}
			]
			return {
				selectedClaim: [],
				claimsData: this.businessClaims,
				showEventForm: false,
				saving: false,
				gettingEvents: false,
				filters: {
					daterage: [],
					business: null,
					isActive: null,
					searchString: null,
					total: 0,
					size: 10,
					page: 1
				},
				eventForm: {
					name: null,
					businessListID: null,
					startDate: null,
					endDate: null,
					is_active: 0,
					medias: [],
					link: null
				},
				columns: columns,
				events: [],
				rules: {
					name: {type: 'string', required: true, trigger: 'blur', message: 'Name is required.'},
					businessListID: {required: true, trigger: 'change', message: 'Business is required'},
					startDate: {required: true, validator: this.validateStartDate, trigger: 'blur'},
					endDate: {required: true, validator: this.validateEndDate, trigger: 'blur'}
				} 
			} 
		}, 
		created() {
			this.getEvents()
		}, 
		methods: {
			openEventForm() { 
				if (this.eventForm.id) {
					this.resetForm()
				}

				this.showEventForm = true 
			}, 
			closeEventForm(clearForm = false) { 
				this.showEventForm = false

				if (clearForm) {
					this.resetForm()
				}
			}, 
			resetForm() {
				this.eventForm = {
					name: null,
					businessListID: null,
					startDate: null,
					endDate: null,
					is_active: 0,
					medias: [],
					link: null
				}

				setTimeout(_ => {
					if (this.$refs.eventForm) this.$refs.eventForm.clearValidate()
				}, 200)
			},
			saveEvent() {
				this.$refs.eventForm.validate(valid => {
					if (valid) {
						this.saving = true
						this.form.errors = []
						let postData = new FormData()
						postData.append('name', this.eventForm.name)
						postData.append('businessListID', this.eventForm.businessListID)
						postData.append('startDate', `${this.eventForm.startDate} 00:00:00`)
						postData.append('endDate', `${this.eventForm.endDate} 23:59:59`)
						postData.append('is_active', this.eventForm.is_active ? 1 : 0)
						this.eventForm.link ? postData.append('link', this.eventForm.link) : null
						this.eventForm.medias.forEach(item => {
							postData.append('medias[]', item.raw)	
						})

						this.$API.Event.saveEvent(postData)
						.then(res => {
							if (res.data.success) {
								this.events.unshift(res.data.data)
								this.filters.total++
								this.showMessage('success', this.$msg.notif.success_add)
								this.closeEventForm(true)
								return
							}

							this.form.errors = res.data.errors
							this.showMessage('error', this.$msg.notif.failed_add)
						})
						.catch(err => { console.log(err) })
						.finally(_ => { this.saving = false })
					} else return false
				})
			},
			updateEvent() {
				this.$refs.eventForm.validate(valid => {
					if (valid) {
						this.saving = true
						this.form.errors = []
						let postData = new FormData()
						postData.append('id', this.eventForm.id)
						postData.append('name', this.eventForm.name)
						postData.append('businessListID', this.eventForm.businessListID)
						postData.append('startDate', `${this.$moment(this.eventForm.startDate).format('YYYY-MM-DD')} 00:00:00`)
						postData.append('endDate', `${this.$moment(this.eventForm.endDate).format('YYYY-MM-DD')} 23:59:59`)
						postData.append('is_active', this.eventForm.is_active ? 1 : 0)
						this.eventForm.link ? postData.append('link', this.eventForm.link) : null
						let key = 0
						this.eventForm.medias.forEach(me => {
							if (me.id) {
								postData.append(`eventMedia[${key}][id]`, me.id)
								postData.append(`eventMedia[${key}][is_deleted]`, me.is_deleted)
								key++
							} else {
								postData.append('medias[]', me.raw)
							}
						})

						this.$API.Event.updateEvent(postData, this.eventForm.id)
						.then(res => {
							if (res.data.success) {
								let index = this.events.findIndex(eve => eve.id == res.data.data.id)
								if (index > -1) {
									this.events.splice(index, 1, res.data.data)
									this.showMessage('success', this.$msg.notif.success_update)
									this.closeEventForm(true)

									return
								}
							}

							this.form.errors = res.data.errors ? res.data.errors : []
							this.showMessage('error', this.$msg.notif.failed_update)
						})
						.catch(err => { console.log(err) })
						.finally(_ => { this.saving = false })
					} else return false
				})
			},
			deleteEvent(row) {
				this.$confirm(this.$msg.notif.confirm_delete, 'Warning', {
	                confirmButtonText: 'Delete',
	                cancelButtonText: 'Cancel',
	                type: 'warning'
	            })
	            .then(() => {
	            	this.gettingEvents = true

	      //           this.$API.Event.deleteEvent(row.id)
	      //           .then(res => {
	      //           	if (res.data.success) {
	      //           		let index = this.events.findIndex(eve => eve.id == row.id)
	      //           		if (index > -1) {
							// 	this.events.splice(index, 1)
							// 	this.showMessage('success', this.$msg.notif.success_delete)

							// 	return
							// }
	      //           	}

	      //           	this.showMessage('error', this.$msg.notif.failed_delete)
	      //           })
	      //           .catch(err => { console.log(err) })
	      //           .finally(_ => { this.gettingEvents = false })
	            })
			},
			getEvents() {
				this.gettingEvents = true

				this.$API.Event.getEvents(this.filters)
				.then(res => {
					if (res.data.success) {
						let data = res.data.data
						this.events = data.data
						this.filters.total = data.total
					}
				})
				.catch(err => { console.log(err) })
				.finally(_ => { this.gettingEvents = false })
			},
			handleUpdateClick(row) {
				// let event = this.events.find(eve => eve.id == row.id)
				this.selectedClaim = row;
				this.showEventForm = true;
				// if (event) {
				// 	this.eventForm = cloneDeep(event)
				// 	this.eventForm.is_active = this.eventForm.is_active == 1 ? true : false   
				// 	this.eventForm.medias = event.event_medias.map(me => {
				// 		let index = me.mediaPath.lastIndexOf('/')
				// 		me.name = me.mediaPath.substring(index + 1)
				// 		me.url = me.mediaPath

				// 		return me
				// 	})
				// 	this.showEventForm = true
				// }
			},
			handleSizeChange(size) {
				this.filters.size = size
				this.filters.page = 1
				this.getEvents()
			},
			handleCurrentChange(page) {
				this.filters.page = page
				this.getEvents()
			},
			uploadChange(file, fileList) {
				if (this.eventForm.medias.some(me => me.name == file.name)) {
					if (this.eventForm.id) {
						let media = this.eventForm.medias.find(me => me.name == file.name)
						media.is_deleted = 0
						return
					}

					fileList.pop()
					this.showMessage('error', 'Cannot upload the same file.')
					return
				}

				if (this.eventForm.id) {
					console.log(file)
					this.eventForm.medias.push(file)
					return
				}
				this.eventForm.medias = cloneDeep(fileList)
			},
			removeFile(file) {
				if (this.eventForm.id) {
					let media = this.eventForm.medias.find(me => me.id == file.id || me.name == file.name)
					media.is_deleted = 1
				} else {
					let index = this.eventForm.medias.findIndex(me => me.name == file.name)
					if (index > -1) this.eventForm.medias.splice(index, 1)
				}

				let idx = this.$refs.uploader.uploadFiles.findIndex(me => me.name == file.name)
				if (idx > -1) {
					this.$refs.uploader.uploadFiles.splice(idx, 1)
				}
			},
			validateStartDate(rule, value, callback) {
				if (!value || !this.eventForm.endDate) callback()

				// let index = this.form.errors.findIndex(er => )
				if (this.$moment(value).format('X') >= this.$moment(this.eventForm.endDate).format('X')) {
					callback(new Error('Start date should be greater than end date.'))
				}

				callback()
			},
			validateEndDate(rule, value, callback) {
				if (!this.eventForm.startDate || !value) callback()

				// let index = this.form.errors.findIndex(er => )
				if (this.$moment(this.eventForm.startDate).format('X') >= this.$moment(value).format('X')) {
					callback(new Error('End date should be less than the end date.'))
				}

				callback()
			}
		},
		computed: {
			getClaimFiles() {
				return this.selectedClaim && this.selectedClaim.files ? this.selectedClaim.files : [];
			},
			getBusinessName() {
				return this.selectedClaim.business ? this.selectedClaim.business.businessName : '';
			},
			tableData() {
				let events = cloneDeep(this.events)

				events = events.map(eve => {
					let newEve = {}
					newEve.event_name = eve.name
					newEve.business_name = eve.business ? eve.business.businessName : '' 
					newEve.start = this.$moment(eve.startDate).format('YYYY-MM-DD')
					newEve.end = this.$moment(eve.endDate).format('YYYY-MM-DD')
					newEve.redirect_url = eve.link ? eve.link : ''
					newEve.id = eve.id

					return newEve
				})

				return events
			}
		}
	}
</script>

<style lang="scss">
	.event-component-index {
		.custom-container {
			display: flex;

			.cloud-container,
			.add-button-container,
			.base-filter-box {
				margin-left: 5px;
			}
		}

		.table-content {
			margin-top: 40px;
		}

		.duration-content {
			display: flex;
		}

		.action-button {
			font-size: 20px;
		}

		.upload-demo {
			.el-upload-dragger {
				height: 100px;
			}

			.el-upload-dragger .el-icon-upload {
				line-height: 0px;
				font-size: 50px;
				margin: 28px 0 16px;
			}

			.el-upload-list__item {
				padding: 0px;
			}
		}
	}
</style>	