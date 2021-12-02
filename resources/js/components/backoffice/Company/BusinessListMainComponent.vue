<template>
	<div class="main-component">
		<router-view :page-data="pageData"></router-view>
		
		<!-- <business-list
			v-if="viewMode === 'list'"
			:page-data="pageData">
		</business-list>


		<business-detail-view
			v-else
			:page-data="pageData"
			:config="detailsCompConfig">
		</business-detail-view> -->
	</div>
</template>

<script>
	export default {
		name: 'BusinessListMainComponent',
		props: {
			pageData: {
				type: Object,
				required: true
			}
		},
		data() {
			let hasHash = location.hash.substr(1, location.hash.length)[0]
			let viewMode = hasHash && location.hash.length > 2 ? 'details' : 'list'

			return {
				viewMode: viewMode,
				detailsCompConfig: {
					reloadData: true,
					businessList: []
				}
			}
		},
		created() {
			this.$EventDispatcher.listen('BUSINESS_MODULE_VIEW_DETAILS', businesses => {
				//console.log(businesses)
				this.detailsCompConfig.reloadData = false
				//this.detailsCompConfig.businessList = businesses
				this.detailsCompConfig.businessList = businesses.businessList
				this.detailsCompConfig.business = businesses.business
				this.viewMode = 'details'
			})

			this.$EventDispatcher.listen('BUSINESS_MODULE_CHANGE_TO_LIST_VIEW', business => {
				this.viewMode = 'list'
			})
		}
	}
</script>

<style lang="scss">
	.business-list-main-component {

	}
</style>
