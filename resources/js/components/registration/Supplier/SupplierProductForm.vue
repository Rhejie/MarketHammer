<template>
	<div class="product-form">
		<business-products
			ref="supplierProduct"
			:page-data="pageData"
			:is-create="true">
		</business-products>
	</div>
</template>

<script>
	export default {
		name: 'SupplierProductForm',
		props: {
			pageData: {}
		},
		data() {
			let columns = [
				{label: 'Name', key: 'name', sortable: true, showTooltip: true},
				{label: 'Price', key: 'price', sortable: true, showTooltip: true},
				{label: 'Qty', key: 'qty', sortable: true, showTooltip: true},
				{label: 'Status', key: 'status', sortable: true, showTooltip: true}
			]

			return {
				columns: columns,
				products: []
			}
		},
		methods: {
			importProduct() {

			}
		}
	}
</script>

<style lang="scss">
	.product-form {

	}
</style>