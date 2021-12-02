<template>
	<div class="main-container" v-loading="loading">
		<div class="table-container table-container-business-tab">
			<div class="card borderless">
					<div class="card-actions">
						<div class="header-title">
                        </div>
						<div class="search-container">
							<!-- <el-input
							class="input-search"
							v-model="search"
							:placeholder="__('Type to search')"
							@keyup.enter.native="showList">
							<i slot="suffix" class="el-input__icon el-icon-search"></i>
							</el-input> -->
						</div>
						<div class="secondary-action-buttons">
							<base-filter-dropdown-box
							hidden
							disabled>
							</base-filter-dropdown-box>
							<el-button
							disabled
							class="mh-btn"
							:title="__('Import')">
							<i class="fas fa-table"></i>
							</el-button>
							<el-button
							disabled
							class="mh-btn"
							:title="__('Export')">
							<i class="fas fa-file-alt"></i>
							</el-button>
						</div>
						<div class="add-new-button">
							<el-button
								round
								size="small"
								class="btn  btn-primary btn-black ml-auto"
								@click="showMachineForm = true"
								:disabled="!business">
								<i class="fas fa-plus"></i> {{ __('Add New Machine') }}
							</el-button>
						</div>
					</div>

				<section class="content-section">
					<el-table
					class="table-list-container"
					:data="businessMachines"
					@row-click="updateMachine">
						<!-- <el-table-column prop="id" label="Keyword ID">
						</el-table-column> -->
						<el-table-column prop="name" :label="__('Name')">
							<template slot-scope="scope">
								{{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
							</template>
						</el-table-column>
						<el-table-column prop="machine_type.name" :label="__('Type')">
						</el-table-column>
						<el-table-column prop="manufacturer.name" :label="__('Manufacturer')">
						</el-table-column>
						<el-table-column prop="process_type.name" :label="__('Process Type')">
						</el-table-column>
						<el-table-column prop="tonnage" :label="__('Tonnage')">
						</el-table-column>
						<el-table-column prop="age" :label="__('Age')">
						</el-table-column>
						<el-table-column :label="__('Action')" align="center">
							<template slot-scope="scope">
								<el-dropdown
									trigger="click"
									@command="handleAction">
									<el-button
										class="text-black"
										type="text"
										icon="fas fa-ellipsis-v"
										@click.stop>
									</el-button>
									<el-dropdown-menu slot="dropdown">
										<el-dropdown-item divided :command="{action: 'custom_field', data: scope.row}">
											<span class="text-blue">
												<i class="fas fa-list"></i> {{ __('Custom Fields') }}
											</span>
										</el-dropdown-item>
										<el-dropdown-item divided :command="{action: 'delete', data: scope.row}">
											<span class="text-red">
												<i class="fas fa-trash-alt"></i> {{ __('Delete') }}
											</span>
										</el-dropdown-item>
									</el-dropdown-menu>
								</el-dropdown>
							</template>
						</el-table-column>
					</el-table>
					<div class="text-right">
						<global-pagination
						:current_page="current_page"
						:current_size="current_size"
						:pagination="businessMachinesPagination"
						@handleSizeChange="handleSizeChange"
						@handleCurrentChange="handleCurrentChange"></global-pagination>
					</div>
				</section>
			</div>
		</div>
		<business-machine-form
			:business="business"
			:page-data="pageMetaData"
			:model="selectedMachine"
			v-if="showMachineForm"
			:visible.sync="showMachineForm"
			@close="handleClose">
		</business-machine-form>


		<el-dialog
		    title="Custom Fields"
	        :visible.sync="showCustomFieldDialog"
	        width="50%"
	        :before-close="closeCustomDialog"
	        :close-on-press-escape="false"
	        class="industry-type-dialog"
	        :close-on-click-modal="false">
	        	<business-machine-custom-field
					:custom-fields="customFieldsList"
					:business-machine="selectedMachine">
				</business-machine-custom-field>
	           <!--  <span slot="footer">
	                <button type="button" class="btn btn-default" @click="closeCustomDialog">Cancel</button>
	            </span> -->
        </el-dialog>

	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'

	export default {
		name: 'BusinessMachine',
		props: {
			pageData: {
				type: Object,
				required: true
			},
			business: {}
		},
		data() {
			let pageDataForm = {
				machineType : [],
				machineManufacturer : [],
				machineProcessType : []
			}
			return {
	            businessMachines: [],
	            businessMachinesPagination: {},
	            search: '',
	            current_page: 1,
	            current_size: 25,
				loading: false,
				showMachineForm: false,
				selectedMachine: null,
				pageMetaData : pageDataForm,
				showCustomFieldDialog : false,
				customFieldsList : []
			}
		},
		created() {
			this.loadMetaData()
			this.getBusinessMachines()

			this.$EventDispatcher.listen('BUSINESS_MACHINE_MODULE_ITEM_CREATED', machine => {
				this.businessMachines.unshift(machine)
			})

			this.$EventDispatcher.listen('BUSINESS_MACHINE_MODULE_ITEM_UPDATED', machine => {
				let index = this.businessMachines.findIndex(fa => fa.id == machine.id)

				if (index > -1) {
					this.businessMachines.splice(index, 1, machine)
				}
			})
		},
		methods: {
			loadMetaData() {
	            this.loading = true
	            let toLoad = [
	                'machine_type',
	                'machine_manaufacturer',
	                'machine_process_type'
	            ]

	            this.$API.Utils.getMetaData(toLoad)
	            .then(res => {
	                this.pageMetaData.machineType = res.data.machine_type
	                this.pageMetaData.machineManufacturer = res.data.machine_manaufacturer
	                this.pageMetaData.machineProcessType = res.data.machine_process_type
	            })
	            .catch(err => {
	                console.log(err)
	            })
	            .finally(_ => {
	                this.loading = false
	            })
	        },
			getBusinessMachines() {
				if (!this.business || !this.business.id) return

				this.loading = true

				let postData = {
					current_size: this.current_size,
	                current_page: this.current_page,
	                search: this.search,
					business_id: this.business.id
				}

				this.$API.BusinessMachine.getMachines(postData)
				.then(res => {
					this.businessMachines = res.data.business_machine.data;
                	this.businessMachinesPagination = res.data.business_machine;
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
			handleAction(info) {
	            if (info.action === 'delete') {
	                this.deleteMachine(info.data)
	            }
	            else if (info.action === 'custom_field') {
	                this.showCustomField(info.data)
	            }

	        },
	        showCustomField(machine){
				this.selectedMachine = cloneDeep(machine)
	        	this.customFieldsList = machine.custom_fields ? cloneDeep(machine.custom_fields) : []
	        	this.showCustomFieldDialog = true
	        },
			updateMachine(machine) {
				this.selectedMachine = cloneDeep(machine)
				this.showMachineForm = true
			},
			deleteMachine(machine) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
	                confirmButtonText: this.__('Delete'),
	                cancelButtonText: this.__('Cancel'),
	                type: 'warning',
	                confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true;

                    this.$API.BusinessMachine.destroy(machine.id)
                    .then(res => {
                    	if (res.data) {
                    		this.$notify({
                    			title: this.__("Successful"),
                    			message: this.$msg.notif.success_delete,
                    			type: "success"
                    		})

                    		let index = this.businessMachines.findIndex(co => co.id == machine.id)

                    		if (index > -1) {
                    			this.businessMachines.splice(index, 1)
                    			this.selectedMachine = null
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
                })
                .catch(() => {});
            },
			handleClose() {
				this.selectedMachine = null
				this.showMachineForm = false
			},

	        handleSizeChange(val) {
	            this.current_size = val;
	            this.getBusinessMachines();
	        },
	        handleCurrentChange(val) {
	            this.current_page = val;
	            this.getBusinessMachines();
	        },
	        closeCustomDialog() {

				this.showCustomFieldDialog = false
			},
		},
		watch: {
			'business.id'() {
				this.getBusinessMachines()
			}
		}
	}
</script>

<style lang="scss">
	.company-machinees-component {
		.machine-item {
			.el-card__body {
				display: flex;
				align-items: center;
			}
		}
	}
</style>
