<template>
	<div class="main-container">
		<div class="table-container">
			<div class="card borderless">
				<form-field-management-header
					:current-tab="currentTab">
				</form-field-management-header>
			</div>

			<el-card>
				<el-tabs
					type="border-card"
					@tab-click="handleClickInner"
					class="market-hammer-tabs"
					v-model="currentTab">
					<el-tab-pane 
						:label="__('Form Groups')" 
						name="form-field-group"
						lazy>
						<form-field-group
							ref="formGroup">
						</form-field-group>
					</el-tab-pane>

					<el-tab-pane 
						:label="__('Form Fields')" 
						name="form-field"
						lazy>
						<form-field
							:form-field-groups="formGroups"
							ref="formField">
						</form-field>
					</el-tab-pane>
				</el-tabs>
			</el-card>
		</div>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'

	export default {
		name: 'FormFieldManagementIndex',
		data() {
			return {
				currentTab: 'form-field-group',
				formGroups: []
			}
		},
		created() {
			this.tabOpenFromRoute()

			this.fetch()

			this.$EventDispatcher.listen('FORM_FIELD_MANAGEMENT_CREATE_NEW', _ => {
				let ref = this.currentTab === 'form-field-group' ? 'formGroup' : 'formField'

				this.$refs[ref].showForm = true
			})

			this.$EventDispatcher.listen('FORM_FIELD_MANAGEMENT_SEARCH_APPLIED', data => {
				let ref = this.currentTab === 'form-field-group' ? 'formGroup' : 'formField'
				
				this.$refs[ref].filters.searchString = data.search
				
				if (data.action === 'enter') {
					this.$refs.[ref].fetch()	
				}
			})

			this.$EventDispatcher.listen('FORM_FIELD_GROUPS_MODULE_UPDATE_PARENT', data => {
				if (data.action === 'add') {
					this.formGroups.unshift(data.item)
				}
				else if (data.action === 'update') {
					let index = this.formGroups.findIndex(fg => fg.id == data.item.id)

	                if (index > -1) {
	                    this.formGroups.splice(index, 1, data.item)
	                }
				} else {
					let index = this.formGroups.findIndex(co => co.id == data.item.id)

                    if (index > -1) {
                        this.formGroups.splice(index, 1)
                    }
				}
			})
		},
		methods: {
			tabOpenFromRoute() {
				if (this.$route.path === '/system-data/form-field-management/form-field') {
					this.currentTab = 'form-field'
				}
			},
			handleClickInner(val) {
				this.$router.replace(`/system-data/form-field-management/${val.name}`)
			},
			fetch() {
                this.$API.FormFieldGroup.fetch()
                .then(res => {
                    this.formGroups = cloneDeep(res.data)
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {
                    this.loading = false
                })
            },
		}
	}
</script>

<style lang="scss">
	.form-field-management-index {

	}
</style>