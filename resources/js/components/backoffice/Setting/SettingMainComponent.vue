<template>
	<div class="setting-main-component">
		<template v-if="!isSettingsNavigation">
			<el-button
				type="text"
				class="mh-btn-back"
				@click="backToIndex">
				<i class="fas fa-arrow-left ml-2"></i> {{ __('Back') }}
			</el-button>
		</template>

		<router-view :page-data="pageData"></router-view>
	</div>
</template>

<script>
	export default {
		name: 'SettingMainComponent',
		props: {
			pageData: {
				type: Object,
				required: true
			}
		},
		data() {
			return {}
		},
		methods: {
			backToIndex() {
				this.$router.push({name: 'Settings Navigation'})
			}
		},
		computed: {
			isSettingsNavigation() {
				return this.$route.name === 'Settings Navigation' ? true : false
			},
			title() {
				let name = this.$route.name.replace('Settings ', '')

				return name
			}
		}
	}
</script>
