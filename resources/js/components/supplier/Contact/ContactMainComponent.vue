<template>
		<router-view :page-data="pageData"></router-view>
</template>

<script>
	export default {
		name: 'ContactMainComponent',
		props: {
			pageData: {
				type: Object,
				required: true
			}
		},
		data() {
			return {}
		},
		mounted(){
			
		},
		methods: {
			backToIndex() {
				this.$router.push({name: 'Contact List'})
			}
		},
		computed: {
		}
	}
</script>
