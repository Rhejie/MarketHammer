<template>
	<div class="access-token-list-component" v-loading="loading">
		<el-card class="box-card full-width">
			<div class="content-header">
				<div>
					<el-input
						suffix-icon="fas fa-search"
					 	class="search-box round-input"
						clearable
						@keyup.enter.native="applyFilter"
						v-model="filters.searchString"
						placeholder="Search Tokens">
					</el-input>
				</div>

				<div class="ml-auto">
					<base-filter-dropdown-box
						:width="400"
						:disabled="true">
						<el-form
							slot="body">
							<div class="row">
								<div class="col-md-12">
									<el-form-item
										label="Date Added">
										<el-date-picker
											class="full-width"
				                            v-model="filters.daterange"
				                            type="daterange"
				                            value-format="yyyy-MM-dd"
				                            clearable
				                            placeholder="Pick a date">
										</el-date-picker>
									</el-form-item>
								</div>
							</div>

							<el-button
								@click="applyFilter"
								class="full-width mb-3"
								type="primary">
								Apply
							</el-button>
						</el-form>
					</base-filter-dropdown-box>
					<el-button
						disabled>
						<i class="fas fa-table"></i>
					</el-button>
					<el-button
						disabled>
						<i class="fas fa-file-alt"></i>
					</el-button>

					<el-button
						v-if="activeTab === 'password'"
						round
						:disabled="!pageData.passwordClient"
						class="btn btn-black"
						@click="showPasswordForm = true">
						<i class="fas fa-plus"></i> Add New Password Token
					</el-button>

					<el-button
						v-if="activeTab === 'personal'"
						round
						class="btn btn-black"
						@click="showPersonalForm = true">
						<i class="fas fa-plus"></i> Add New Personal Token
					</el-button>
				</div>
			</div>
		</el-card>

		<el-card class="box-card full-width mt-2">
			<el-tabs 
				type="card" 
				@tab-click="handleClick"
				v-model="activeTab">
				<el-tab-pane label="Personal Tokens" name="personal">
					<el-table
						fit
						:data="personalTokens">
						<el-table-column
							v-for="column in columns"
							:key="column.prop"
							:label="column.label"
							:show-overflow-tooltip="column.showTooltip"
							:sortable="column.sortable"
							:prop="column.prop">
						</el-table-column>

						<el-table-column label="Actions">
							<template slot-scope="scope">
								<el-dropdown
									trigger="click"
									@command="handleAction">
									<el-button
										class="text-black"
										type="text"
										icon="fas fa-ellipsis-v">
									</el-button>
									<el-dropdown-menu slot="dropdown">
										<el-dropdown-item divided :command="{action: 'delete', data: scope.row}">
											<span class="text-red">
												<i class="fas fa-trash-alt"></i> Delete
											</span>
										</el-dropdown-item>
									</el-dropdown-menu>
								</el-dropdown>
							</template>
						</el-table-column>
					</el-table>

					<div class="text-right mb-3">
						<global-pagination
			                :current_page="filters.page"
			                :current_size="filters.size"
			                :pagination="filters"
			                @handleSizeChange="handleSize"
			                @handleCurrentChange="handlePage">
			            </global-pagination>
		            </div>
				</el-tab-pane>

				<el-tab-pane label="Password Tokens"  name="password">
					<el-table
						fit
						:data="passwordTokens">
						<el-table-column
							v-for="column in columns"
							:key="column.prop"
							:label="column.label"
							:show-overflow-tooltip="column.showTooltip"
							:sortable="column.sortable"
							:prop="column.prop">
						</el-table-column>

						<el-table-column label="Actions">
							<template slot-scope="scope">
								<el-dropdown
									trigger="click"
									@command="handleAction">
									<el-button
										class="text-black"
										type="text"
										icon="fas fa-ellipsis-v">
									</el-button>
									<el-dropdown-menu slot="dropdown">
										<el-dropdown-item :command="{action: 'update', data: scope.row}">
											<span class="text-blue">
												<i class="fas fa-edit"></i> Update
											</span>
										</el-dropdown-item>
										<el-dropdown-item divided :command="{action: 'delete', data: scope.row}">
											<span class="text-red">
												<i class="fas fa-trash-alt"></i> Delete
											</span>
										</el-dropdown-item>
									</el-dropdown-menu>
								</el-dropdown>
							</template>
						</el-table-column>
					</el-table>

					<div class="text-right mb-3">
						<global-pagination
			                :current_page="filters.page"
			                :current_size="filters.size"
			                :pagination="filters"
			                @handleSizeChange="handleSize"
			                @handleCurrentChange="handlePage">
			            </global-pagination>
		            </div>
				</el-tab-pane>
			</el-tabs>
        </el-card>

        <password-grant-form
        	:client="pageData.passwordClient"
        	v-if="showPasswordForm"
        	:visible.sync="showPasswordForm"
			@close="showPasswordForm = false">
        </password-grant-form>

        <personal-grant-form
        	v-if="showPersonalForm"
        	:visible.sync="showPersonalForm"
			@close="showPersonalForm = false">
        </personal-grant-form>

	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import pagination from '../../mixins/pagination'

	export default {
		name: 'AccessTokenList',
		mixins: [pagination],
		props: {
			pageData: {}
		},
		data() {
			let columns = [
				{label: 'Token Name', prop: 'token_name', showTooltip: true, sortable: true},
				{label: 'Client Name', prop: 'client_name', showTooltip: true, sortable: true},
				{label: 'User Name', prop: 'user_name', showTooltip: true, sortable: true},
				{label: 'Date Created', prop: 'created_at', showTooltip: true, sortable: true},
				{label: 'Expiry Date', prop: 'expires_at', showTooltip: true, sortable: true}
			]

			return {
				loading: false,
				showPasswordForm: false,
				showPersonalForm: false,
				personalTokens: [],
				passwordTokens: [],
				columns: columns,
				filters: {
					searchString: null
				},
				loaded: {
					personal: false,
					password: false,
				},
				activeTab: 'password'
			}
		},
		created() {
			this.activeTab === 'personal' ? this.getPersonalTokens() : this.getPasswordTokens()

			this.$EventDispatcher.listen('TOKEN_MODULE_ITEM_CREATED', _ => {
				this.activeTab === 'personal' ? this.getPersonalTokens() : this.getPasswordTokens()
			})
		},
		methods: {
			applyFilter() {
				if (this.activeTab === 'personal') {
					this.getPersonalTokens()
				}
				else if (this.activeTab === 'password') {
					this.getPasswordTokens()
				}
			},
			handleClick(tab) {
				if (tab.name === 'personal' && !this.loaded.personal) {
					this.getPersonalTokens()
				}
				else if (tab.name === 'password' && !this.loaded.password) {
					this.getPasswordTokens()
				}
			},
			getPasswordTokens() {
				this.loading = true

				this.$API.OAuthentication.getPasswordTokens()
				.then(res => {
					this.loaded.password = true

					if (Array.isArray(res.data)) {
						this.passwordTokens = this.formatData(res.data)
					}
				})
				.catch(err => {

				})
				.finally(_ => {
					this.loading = false
				})
			},
			getPersonalTokens() {
				this.loading = true

				this.$API.OAuthentication.getPersonalTokens()
				.then(res => {
					this.loaded.personal = true

					if (Array.isArray(res.data)) {
						this.personalTokens = this.formatData(res.data)
					}
				})
				.catch(err => {
					
				})
				.finally(_ => {
					this.loading = false
				})
			},
			revokeToken(token) {
				this.$confirm(this.$msg.notif.confirm_delete, 'Confirmation', {
                  	confirmButtonText: 'Delete',
                  	cancelButtonText: 'Cancel',
                  	type: 'warning',
                  	confirmButtonClass: 'el-button--danger'
                })
                .then(_ => {
                	this.loading = true

					this.$API.OAuthentication.revokeToken(token.id)
					.then(res => {
						let index = this.activeTab === 'personal' ? 
						this.personalTokens.findIndex(pt => pt.id == token.id) : 
						this.passwordTokens.findIndex(pt => pt.id == token.id)

						if (index > -1) {
							this.activeTab === 'personal' ? 
							this.personalTokens.splice(index, 1) :
							this.passwordTokens.splice(index, 1)					
						}
					})
					.catch(err => {
						console.log(err)
					})
					.finally(_ => {
						this.loading = false
					})
                })
			},
			handleAction(info) {
				if (info.action === 'delete') {
					this.revokeToken(info.data)
				}
				else if (info.action === 'update') {

				}
			},
			formatData(tokens) {
				return tokens.map(token => {
					token.token_name = this.$sf.ucwords(token.name)
					token.client_name = this.$sf.ucwords(token.client.name)
					token.user_name = this.$sf.ucwords(token.user.displayName)
					token.created_at = this.$df.formatDate(token.created_at, 'YYYY-MM-DD')
					token.expires_at = this.$df.formatDate(token.expires_at, 'YYYY-MM-DD')

					return token
				})
			}
		}
	}
</script>

<style lang="scss">
	.access-token-list-component {

	}
</style>