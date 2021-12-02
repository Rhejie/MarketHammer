<template>
	<div class="app">
		<router-view :page-data="pageData"></router-view>
	</div>
</template>

<script>
	export default {
		name: 'App',
		props: {
			pageData: {}
		},
		data() {
			return {}
		}
	}
</script>
