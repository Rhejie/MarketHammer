<template>
	<el-card>
		<el-tabs
			type="border-card"
			@tab-click="handleClickInner"
			class="market-hammer-tabs"
			v-model="currentTab">
			<el-tab-pane :label="__('General')" name="general" lazy>
				<business-general
					:business.sync="business"
					:page-data="pageData">
				</business-general>
			</el-tab-pane>
			<!-- <el-tab-pane :label="__('Keywords')" name="keywords" lazy>
				<global-keyword-index
					source="business"
					:source-object="business">
				</global-keyword-index>
			</el-tab-pane> -->
			<el-tab-pane :label="__('Contacts')" name="contacts" lazy
				v-if = "tabs.indexOf('contacts') >= 0" >
				<business-contact-list
					:page-data="contactPageData"
					:business="business">
				</business-contact-list>
			</el-tab-pane>
			<el-tab-pane :label="__('Addresses')" name="addresses" lazy>
				<business-addresses
					:business="business"
					:page-data="pageData">
				</business-addresses>
			</el-tab-pane>
			<el-tab-pane :label="__('Product')" name="product" lazy>
				<business-products
					:business="business"
					:page-data="productPageData">
				</business-products>
			</el-tab-pane>
			<el-tab-pane :label="__('Finance')" name="finance" lazy>
				<business-finance
					:business="business">
				</business-finance>
			</el-tab-pane>
			<el-tab-pane :label="__('Certifications')" name="certifications" lazy
				v-if = "tabs.indexOf('certifications') >= 0" >
				<business-certifications
					:business="business"
					:page-data="pageData">
				</business-certifications>
			</el-tab-pane>
			<el-tab-pane :label="__('Partners')" name="partner" lazy>
				<business-partner-list
					:business="business"
					:page-data="pageData">
				</business-partner-list>
			</el-tab-pane>
			<el-tab-pane :label="__('Machines')" name="machine" lazy>
				<business-machine
					:business="business"
					:page-data="pageData">
				</business-machine>
			</el-tab-pane>
			<el-tab-pane :label="__('Quality System')" name="qsa" lazy>
				<business-qsa
					:business="business"
					:page-data="pageData">
				</business-qsa>
			</el-tab-pane>
            <el-tab-pane :label="__('Materials')" name="materials" lazy>
				<business-materials
					:business="business"
					:page-data="pageData">
				</business-materials>
			</el-tab-pane>
			<el-tab-pane :label="__('Upload NDA')" name="nda" lazy>
				<business-nda
					:business="business"
					:page-data="pageData">
				</business-nda>
			</el-tab-pane>
			<el-tab-pane :label="__('ESG')" name="esg" lazy>
				<business-esg
					:business="business"
					:page-data="pageData">
				</business-esg>
			</el-tab-pane>
		</el-tabs>
	</el-card>
</template>

<script>
	export default {
		name: 'OverviewMainTemplate',
		props: {
			pageData: {
				type: Object,
				required: true
			},
			business: {},
			businesses: {},
			tab: {
				type: String,
				required: false,
				default : 'general'
			},
		},
		data() {
			let productPageData = {
				loadMetData : true,
				loadCreateForm : true
			}
			let defaultTabs = ['general', 'contacts', 'addresses', 'product', 'finance', 'certifications', 'partner', 'machine', 'qsa', 'materials']
			if(this.pageData && this.pageData.tabs != undefined && this.pageData.tabs.length > 0){
				defaultTabs = this.pageData.tabs
			}

			return {
				currentTab: this.tab,
				productPageData : productPageData,
				tabs 			: defaultTabs
			}
		},
		methods: {
			handleClickInner() {},
		},
		computed: {
			contactPageData() {
				return {
					businessList: this.businesses,
					data: [],
					isSupplierView: true,
				}
			}
		}
	}
</script>
