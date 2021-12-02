<template>
	<div class="setting-main-component">
		<div class="row">
			<div class="col-md-6">
				<el-input
					v-model="filters.searchString"
					class="full-width mb-3"
					clearable
					:placeholder="__('Find function quickly by searching here...')"
					suffix-icon="fas fa-search">
				</el-input>
			</div>
		</div>

		<section class="mh">
			<el-collapse
				v-model="activeNames"
				@change="handleChange"
				class="custom-collapse">
				<el-collapse-item
					v-if="filteredNavigation.settings.length"
					:title="__('Settings')"
					name="settings"
					class="mb-3">
					<div
						class="row"
						v-for="(setting, index) in filteredNavigation.settings"
						:key="index">
						<div
							class="col-md-3"
							v-for="set in setting">
							<el-link
								class="navigation-item"
								:disabled="set.routeName ? false : true"
								:underline="false">
								<router-link
									v-if="set.routeName"
									:to="{name: set.routeName, params: set.props}">
									<i :class="set.icon" :style="`color:${set.iconColor}`"></i>
									<span class="ml-2">{{ __(set.label) }}</span>
								</router-link>

								<template v-else>
									<i :class="set.icon" :style="`color:${set.iconColor}`"></i>
									<span class="ml-2">{{ __(set.label) }}</span>
								</template>
							</el-link>
						</div>
					</div>
				</el-collapse-item>

				<el-collapse-item
					v-if="filteredNavigation.systemData.length"
					:title="__('System Data')"
					name="system-data">
					<div
						class="row"
						v-for="(setting, index) in filteredNavigation.systemData"
						:key="index">
						<div
							class="col-md-3"
							v-for="set in setting">
							<el-link
								class="navigation-item"
								:disabled="set.routeName ? false : true"
								:underline="false">
								<router-link
									v-if="set.routeName"
									:to="{name: set.routeName, params: set.props}">
									<i :class="set.icon" :style="`color:${set.iconColor}`"></i>
									<span class="ml-2">{{ __(set.label) }}</span>
								</router-link>

								<template v-else>
									<i :class="set.icon" :style="`color:${set.iconColor}`"></i>
									<span class="ml-2">{{ __(set.label) }}</span>
								</template>
							</el-link>
						</div>
					</div>
				</el-collapse-item>
			</el-collapse>
		</section>
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'

	export default {
		name: 'SettingNavigation',
		props: {
			pageData: {
				type: Object,
				required: true
			}
		},
		data() {
			let navigations = {
				settings: [
					[
						{label: 'Industries', key: 'industries', icon: 'fas fa-city', iconColor: '#65D160', link: '/system-data/industry-type', routeName: 'Settings Industry Type'},
						{label: 'Business Categories', key: 'business_categories', icon: 'fas fa-briefcase', iconColor: '#EC8823', link: '/system-data/business-category', routeName: 'Settings Business Category'},
						{label: 'Hazardous Substances', key: 'hazardous_substances', icon: 'fas fa-biohazard', iconColor: '#E22D2C', link: '/system-data/hazardous-substance', routeName: 'Settings Hazardous Substances'},
						{label: 'QSA List', key: 'qsa_list', icon: 'fas fa-clipboard', iconColor: '#929292', link: '/system-data/qsa-list', routeName: 'Settings QSA List'}
					],
					[
						{label: 'Certification', key: 'certifications', icon: 'fas fa-certificate', iconColor: '#4791BB', link: '/system-data/certifications', routeName: 'Settings Certificates', props: {
							certificationTypes: this.pageData.certificationTypes,
							certificationHolders: this.pageData.certificationHolders
						}},
						{label: 'Processes', key: 'processes', icon: 'fas fa-retweet', iconColor: '#333333', link: '/system-data/processes', routeName: 'Settings Processes'},
						{label: 'Material', key: 'material', icon: 'fas fa-cubes', iconColor: '#91C4DB', link: '/system-data/material', routeName: 'Settings Material'},
						{label: 'Form Field Management', key: 'form_field_management', icon: 'fab fa-wpforms', iconColor: '#dba718', link: '/system-data/form-field-management', routeName: 'Form Field Management'}
					],
					[
						{label: 'Countries', key: 'countries', icon: 'fas fa-flag', iconColor: '#929292', link: '/system-data/country', routeName: 'Settings Country'},
						{label: 'Product Categories', key: 'product_categories', icon: 'fas fa-clipboard-list', iconColor: '#E63659', link: '/system-data/product-category', routeName: 'Settings Product Category'},
						{label: 'Translations', key: 'translations', icon: 'fas fa-globe-europe', iconColor: '#65D060', link: '/system-data/translations', routeName: 'Settings Translations'}
					]
				],
				systemData: [
					[
						{label: 'Unit Of Measure', key: 'unit_of_measure', icon: 'fas fa-weight-hanging', iconColor: '#91C4DB', link: '/system-data/unit-measure', routeName: 'Settings Unit Of Measure'},
						{label: 'Operation Condition', key: 'operation_condition', icon: 'fas fa-cogs', iconColor: '#E67777', link: '/system-data/operation-condition', routeName: 'Settings Operation Condition'},
						{label: 'Machine Type', key: 'machine_type', icon: 'fas fa-screwdriver', iconColor: '#4791BB', link: '/system-data/machine-type', routeName: 'Settings Machine Type'},
						{label: 'Address Type', key: 'address_type', icon: 'fas fa-map-marker', iconColor: '#3E525D', link: '/system-data/factory-types', routeName: 'Settings Address Types'}
					],
					[
						{label: 'Certification Holder', key: 'certification_holder', icon: 'fas fa-award', iconColor: '#56A70F', link: '/system-data/certification-holder', routeName: 'Settings Certification Holder'},
						{label: 'QSA Criteria', key: 'qsa_criteria', icon: 'fas fa-book', iconColor: '#32638E', link: '/system-data/qsa-criteria', routeName: 'Settings QSA Criteria'},
						{label: 'QSA Type', key: 'qsa_type', icon: 'fas fa-clipboard', iconColor: '#32638E', link: '/system-data/qsa-type', routeName: 'Settings QSA Type'},
						{label: 'Area Type', key: 'area', icon: 'fas fa-warehouse', iconColor: '#6E5A5A', link: '/system-data/area', routeName: 'Settings Area'}
					],
					[
						{label: 'Material Type', key: 'material_type', icon: 'fas fa-layer-group', iconColor: '#881C1C', link: '/system-data/material-type', routeName: 'Settings Material Type'},
						{label: 'Product Type', key: 'product_type', icon: 'fas fa-box-open', iconColor: '#EB87B9', link: '#'},
						{label: 'Certification Type', key: 'certification_type', icon: 'fas fa-medal', iconColor: '#56A70F', link: '/system-data/certification-types', routeName: 'Settings Certification Types'},
						{label: 'Machine Manufacturers', key: 'machine_manufacturers', icon: 'fas fa-tools', iconColor: '#995F5F', link: '/system-data/machine-manufacturer', routeName: 'Settings Machine Manufacturers'}
					],
					[
						{label: 'SNS Type', key: 'sns_type', icon: 'fas fa-share-alt', iconColor: '#53AC96', link: '/system-data/sns-list', routeName: 'Settings SNS List'},
						{label: 'Employee Count', key: 'employee_count', icon: 'fas fa-user-plus', iconColor: '#375A60', link: '/system-data/employee-count', routeName: 'Settings Employee Count'},
						{label: 'Process Type', key: 'process_type', icon: 'fas fa-bezier-curve', iconColor: '#995F5F', link: '/system-data/machine-process-type', routeName: 'Settings Process Type'},
						{label: 'Complex Type', key: 'complex_type', icon: 'fas fa-link', iconColor: '#995F5F', link: '/system-data/complex-type', routeName: 'Settings Complex Type'}
					],
					[
						{label: 'Factory Type', key: 'factory_type', icon: 'fas fa-industry', iconColor: '#333333', link: '/system-data/factory-types', routeName: 'Settings Factory Types'},
						{label: 'Role', key: 'role', icon: 'fas fa-user-tag', iconColor: '#333333', link: '/system-data/contact-role', routeName: 'Settings Role'},
						{label: 'Business Level', key: 'supplier_level', icon: 'fas fa-level-up-alt', iconColor: '#91C4DB', link: '/system-data/business-levels', routeName: 'Settings Business Levels'},
						{label: 'Complex Location', key: 'complex_location', icon: 'fas fa-plane-arrival', iconColor: '#995F5F', link: '/system-data/complex-location', routeName: 'Settings Complex Location'}
					],
					[
						{label: 'Keywords', key: 'global_keywords', icon: 'fas fa-book', iconColor: '#929292', link: '/system-data/keywords', routeName: 'Settings Global Keywords'},
						{label: 'Form Status', key: 'form-status', icon: 'far fa-sticky-note', iconColor: '#65D060', link: '/system-data/form-status', routeName: 'Settings Form Status'},
						{label: 'Form Type', key: 'form-type', icon: 'far fa-sticky-note', iconColor: '#65D060', link: '/system-data/form-type', routeName: 'Settings Form Type'},
						{label: 'Supplier Status', key: 'supplier-status', icon: 'fas fa-briefcase', iconColor: '#a86f32', link: '/system-data/supplier-status', routeName: 'Settings Supplier Status'}
					]
				]
			}

			return {
				filters: {
					searchString: null
				},
				activeNames: ['settings', 'system-data'],
				navigations: navigations
			}
		},
		methods: {
			handleChange(val) {
				console.log(val)
			}
		},
		computed: {
			filteredNavigation() {
				let navigations = cloneDeep(this.navigations)
				let query = cloneDeep(this.filters.searchString)

				if (query) {
					query = query.toLowerCase()

					navigations.settings = navigations.settings.map((set, index) => {
						return set.filter(s => s.label.toLowerCase().indexOf(query) > -1)
					})
					.filter(set => !!set.length)

					navigations.systemData = navigations.systemData.map(set => {
						return set.filter(s => s.label.toLowerCase().indexOf(query) > -1)
					})
					.filter(set => !!set.length)
				}

				return navigations
			}
		}
	}
</script>

<style lang="scss">
	.el-collapse-item__header {
		background: #645da9;
	    color: #fff;
	    height: 30px !important;
	    padding: 10px;
	}

	.el-collapse-item__content {
		padding: 10px;
	}

	.navigation-item {
		font-size: 12px;
		padding: 5px;
	}
	.navigation-item  a{
		color: #484848 !important;
	}
</style>
