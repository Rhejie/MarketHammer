<template>
	<el-dropdown
		@command="changeLocale"
		trigger="click"
		class="language-picker">
	  	<span class="el-dropdown-link" v-loading="loading">
	    	{{ currentLanguage }} <i class="el-icon-arrow-down el-icon--right"></i>
	  	</span>
		<el-dropdown-menu slot="dropdown">
			<el-dropdown-item
				v-for="(lang, index) in languages"
				:disabled="locale == index"
				:key="index"
				:title="lang.english"
				:command="index">
				{{ lang.original }}
			</el-dropdown-item>
		</el-dropdown-menu>
	</el-dropdown>
</template>

<script>
	export default {
		name: 'LanguageSwitcher',
		props: {
			languages: {
				type: Object,
				required: true
			}
		},
		data() {
			return {
				loading: false,
				locale: window.Laravel.locale
			}
		},
		methods: {
			changeLocale(locale) {
				this.loading = true

				this.$API.User.setUserLocale(locale)
				.then(res => {
					if (res.data) {
						window.location.reload()
					}
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loading = false
				})
			}
		},
		computed: {
			currentLanguage() {
				let lang = this.languages[this.locale]

				return lang ? lang.original : 'English'
			}
		}
	}
</script>

<style lang="scss">
	.language-picker {
		.el-dropdown-link {
			font-size: 12px;
		}
	}
</style>
