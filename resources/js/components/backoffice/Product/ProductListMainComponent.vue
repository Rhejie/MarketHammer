<template>
	<div class="main-component">
		<product-list
			:page-data="pageData"
			v-if="viewMode === 'list'">
		</product-list>


		<product-detail-view
			v-else
			:page-data="pageData"
			:config="detailsCompConfig">
		</product-detail-view>

        <el-dialog
            :title="formTitle"
            :visible.sync="formDialogVisible"
            width="70%"
            top = "20px"
            :before-close="handleClose"
            class="create-category-dialog">
                <product-form
                    :page-data="pageData">
                </product-form>
        </el-dialog>
	</div>
</template>

<script>
	export default {
		name: 'ProductListMainComponent',
		props: {
			pageData: {
				type: Object,
				required: true
			}
		},
		data() {
			let hasHash = location.hash.substr(1, location.hash.length)[0]
			let viewMode = hasHash ? 'details' : 'list'

			return {
				viewMode: viewMode,
				detailsCompConfig: {
					reloadData: true,
					productList: []
				},
				formTitle : "Add New Product",
            	formDialogVisible: false,
			}
		},
		created() {
			this.$EventDispatcher.listen('PRODUCT_MODULE_VIEW_DETAILS', data => {
				this.viewMode = 'details'
				this.detailsCompConfig.reloadData = false
				this.detailsCompConfig.productList = data.productList
			})

			this.$EventDispatcher.listen('PRODUCT_MODULE_CHANGE_TO_LIST_VIEW', product => {
				this.viewMode = 'list'
			})

			this.$EventDispatcher.listen('PRODUCT_SHOW_ADD_FORM', product => {
				this.formDialogVisible = true
			})

		    this.$EventDispatcher.listen('PRODUCT_CLOSE_FORM', data => {
		        this.formDialogVisible = false;
		    })
		},
		methods:{
			handleClose() {
	            this.formDialogVisible = false
	        },
		}
	}
</script>

<style lang="scss">
	.business-list-main-component {

	}
</style>
