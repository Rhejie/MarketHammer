<template>
	<div class="certification-form">
		<business-certifications
			ref="supplierCertification"
			:is-create="true"
			:page-data="pageData">
		</business-certifications>
	</div>
</template>

<script>
	export default {
		name: 'SupplierCertificationForm',
		props: {
			pageData: {}
		},
		data() {
			let columns = [
				{label: 'Title', key: 'name', sortable: true, showTooltip: true},
				{label: 'Description', key: 'description', sortable: true, showTooltip: true},
				{label: 'Issued Date', key: 'issued_date', sortable: true, showTooltip: true},
				{label: 'Expiration Date', key: 'expiry_date', sortable: true, showTooltip: true}
			]

			return {
				columns: columns,
				certifications: []
			}
		}
	}
</script>

<style lang="scss">
	.certification-form {

	}
</style>