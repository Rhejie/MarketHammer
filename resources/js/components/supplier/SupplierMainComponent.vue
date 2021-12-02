<template>
	<div class="main-detail-view">
		<div>
			<el-card shadow="never" class="header-section">
				<div class="supplier-header-inner">
					<div class="row">
						<div class="col-md-12">
							<h6>{{ businessData ? businessData.legal_name : 'N/A' }}</h6>
						</div>
						<div class="col-md-12">
							<i class="fas fa-map-marker-alt"></i><span>  {{ businessData ? businessData.address : 'N/A' }}</span>
						</div>
						<div class="col-md-2">
							<i class="fas fa-phone-alt"></i><span>  {{ businessData ? businessData.phone : 'N/A' }}</span>
						</div>
						<div class="col-md-4">
							<i class="fas fa-envelope"></i><span>  {{ businessData ? businessData.email : 'N/A' }}</span>
						</div>
					</div>
				</div>
			</el-card>
			<div class="main-content-section">
				<el-tabs 
					@tab-click="handleClick" 
					class="market-hammer-tabs"
					v-model="tabModels.outerTabs">
					<el-tab-pane label="Activities" name="activities">
						<activities-main-template></activities-main-template>
					</el-tab-pane>
					<el-tab-pane label="Overview" name="overview">
						<overview-main-template
							:business="businessData"
							:page-data="overviewPageData"
							:tab = "tabModels.innerTab">
						</overview-main-template>
					</el-tab-pane>
				</el-tabs>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			pageData: {
				type: Object,
				required: true
			},
			business: {},
		},
		data() {
			let pdata = this.pageData
			pdata['tabs'] = ['general', 'addresses', 'product', 'finance', 'partner', 'qsa']
			return {
				tabModels: {
					outerTabs: 'overview',
					innerTab : 'general'
				},
				businessData 	: this.business,
				overviewPageData : this.pageData

			}
		},
		created() {
			
		},
		methods: {
			handleClick() {},
		},
	}
</script>