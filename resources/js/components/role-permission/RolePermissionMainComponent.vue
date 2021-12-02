<template>
	<div class="product-list-main-component">
		<div class="main-content-section mt-3">
			<!-- <el-tabs 
				type="card" 
				@tab-click="handleClick" 
				class="market-hammer-tabs"
				v-model="tabModels.outerTabs">
				<el-tab-pane label="System Ad" name="overview">
					<role-permission-index :page-data = "rolePermissionData">
					</role-permission-index>
				</el-tab-pane>
			</el-tabs> -->

			<role-permission-index :page-data = "rolePermissionData">
			</role-permission-index>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			pageData: {
				type: Object,
				required: true
			}
		},
		data() {
			let rolePermission = {
				permissions : this.pageData.permissions
			}

			return {
				tabModels			: {
					outerTabs: 'overview'
				},
				permissions 		: this.pageData.permissions,
				rolePermissionData 	: rolePermission
			}
		},
		created() {
		},
		methods:{
			handleClose() {
	            this.formDialogVisible = false
	        },
	        handleClick(){

	        }
		}
	}
</script>

<style lang="scss">
	.business-list-main-component {

	}
</style>