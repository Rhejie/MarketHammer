<template>
	<section class = "business-product" v-loading = "pageLoading">
		<qsa-list-index
			:business="business"
			:page-data="pageMetaData">
		</qsa-list-index>

	</section>
</template>

<script>
import cloneDeep from 'lodash/cloneDeep'

export default {
	name: 'BusinessQsa',
	props: {
		pageData: {
			type: Object,
			required: true
		},
		business: {}
	},
	data() {
		return {
        	pageMetaData : {categories : [], measurements : [], business : this.business},
        	pageLoading : false,
        	selectedProduct : null
		}
	},
	created(){

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

<style>
#pane-qsa .input-search {
	display: none;
}
</style>