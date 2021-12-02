<template>
	<el-card v-loading="pageLoading">
		<product-list
			ref="productList"
			:is-create="isCreate"
			:business="business"
			:page-data="pageMetaData">
		</product-list>

		<el-dialog
            :title="__('Product Details')"
            :visible.sync="showDetailDialog"
            width="85%"
            top = "20px"
            :before-close="handleCloseDetailDialog"
            class="create-category-dialog">
                <product-detail-view
                	:is-create="isCreate"
					:page-data="pageMetaData"
					:config="detailsCompConfig"
					:product-data = "selectedProduct">
				</product-detail-view>
        </el-dialog>

		<el-dialog
            :title="formTitle"
            :visible.sync="formDialogVisible"
            width="70%"
            top = "20px"
            :before-close="handleClose"
            class="create-category-dialog">
                <product-form
                	:is-create="isCreate"
                    :page-data="pageMetaData">
                </product-form>
        </el-dialog>
	</el-card>
</template>

<script>
import cloneDeep from 'lodash/cloneDeep'

export default {
	name: 'BusinessProducts',
	props: {
		isCreate: {
			type: Boolean,
			default: false
		},
		pageData: {
			type: Object,
			required: true
		},
		business: {}
	},
	data() {
		return {
			detailsCompConfig: {
				reloadData: true,
				productList: [],
				showList : false,
				isModal : true
			},
			formTitle : this.__("Add New Product"),
        	formDialogVisible: false,
        	showDetailDialog : false,
        	pageMetaData : {categories : [], measurements : [], business : this.business},
        	pageLoading : false,
        	selectedProduct : null
		}
	},
	created() {
		this.loadMetaData()

		this.$EventDispatcher.listen('PRODUCT_MODULE_VIEW_DETAILS', data => {
			console.log('PRODUCT_MODULE_VIEW_DETAILS', data)
			this.selectedProduct = data.product
			this.showDetailDialog = true
		})

		this.$EventDispatcher.listen('PRODUCT_SHOW_ADD_FORM', product => {
			this.formDialogVisible = true
		})

	    this.$EventDispatcher.listen('PRODUCT_CLOSE_FORM', data => {
	        this.formDialogVisible = false;
	    })
	},
	methods:{
		loadMetaData() {
            this.pageLoading = true
            let toLoad = [
                'unit_measure',
                'product_category'
            ]

            this.$API.Utils.getMetaData(toLoad)
            .then(res => {
                this.pageMetaData.categories = res.data.product_category
                this.pageMetaData.measurements = res.data.unit_measure
            })
            .catch(err => {
                console.log(err)
            })
            .finally(_ => {
                this.pageLoading = false
            })
        },
		handleClose() {
            this.formDialogVisible = false
        },
		handleCloseDetailDialog() {
            this.showDetailDialog = false
        },
	},
	watch:{
        business(newVal){
        	this.pageMetaData.business = newVal
        },
    }
}
</script>