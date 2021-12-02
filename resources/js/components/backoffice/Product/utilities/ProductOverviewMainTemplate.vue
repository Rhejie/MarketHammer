<template>
	<el-card>
		<el-tabs 
			type="border-card"
			@tab-click="handleClickInner" 
			class="market-hammer-tabs"
			v-model="currentTab">
			<el-tab-pane :label="__('General')" name="general" lazy>
				<product-general
					:product="product"
					:page-data="pageData">
				</product-general>
			</el-tab-pane>
			<el-tab-pane :label="__('Keywords')" name="keyword" lazy>
				<product-keyword-list
					:product="product"
					:page-data="pageData">
				</product-keyword-list> 
			</el-tab-pane>
		</el-tabs>
	</el-card>
</template>

<script>
	export default {
		name: 'ProductOverviewMainTemplate',
		props: {
			pageData: {
				type: Object,
				required: true
			},
			product: {},
			products: {}
		},
		data() {
			return {
				currentTab: 'general'
			}
		},
		methods: {
			handleClickInner() {},
		},
		computed: {
		}
	}
</script>