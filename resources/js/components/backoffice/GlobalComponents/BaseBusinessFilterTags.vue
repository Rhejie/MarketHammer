<template>
	<div class="filter-tags" v-if="filterTags && filterTags.length > 0">
		<label> {{__('Filter') }}:</label>

        <!--template v-for="[item, value] in filterKey.filter(([key, value]) => value != 'All')">
            <el-tag :key="item" class="default">{{ itemValue(item) }} : {{arrayValue(item, value) }}</el-tag> &nbsp;
            <el-tag :key="item+'.'" v-if="item === 'country_id' && filterData.city != 'All'">{{__('City')}} : {{filterData.city}}</el-tag> &nbsp;
        </template-->

		<!--<template v-for="(item, index) in filterTags">
			<el-tag :key="index" class="default">{{ item }}</el-tag>
		</template> -->
	</div>
</template>

<script type="text/javascript">

import cloneDeep from 'lodash/cloneDeep'

export default{
	/*
		@props
			filterList 		=> Filter List (Country, City, Category)
							=> [{..}, {..}]
			filterData		=> filters used in components
							=> {}
			disable			=> list of filter tags to hide
							=> ['string', 'string']
	*/
	props: [
		'filterList',
		'filterData',
		'disable',
		'includeLabel'
	],

	data(){
		return {

		}
	},

    methods: {
        itemValue(item) {
            let newItemKey = item;
            if(item === 'country_id') {
                newItemKey = 'Country'
            }
            else if(item === 'industry_type_id') {
                newItemKey = 'Industry Type'
            }
            else if(item === 'category_id') {
                newItemKey = 'Bus. Category'
            }
            else if(item === 'daterange') {
                newItemKey = 'Registered'
            }
            else if(item === 'established_duration') {
                newItemKey = 'Established'
            }

            return newItemKey;
        },
        arrayValue(item, value) {
            let newValue = value;
            if(item === 'country_id' && value != 'All') {
                let country = this.filterList.countries.filter(c => c.id === value);
                newValue = country[0].name;
            }
            else if(item === 'industry_type_id' && value != 'All') {
                let country = this.filterList.industries.filter(c => c.id === value);
                newValue = country[0].name;
            }
            else if(item === 'category_id' && value != 'All') {
                let country = this.filterList.businessCategories.filter(c => c.id === value);
                newValue = country[0].name;
            }
            else if(item === 'daterange' && value != 'All') {
                newValue = value.toString().replaceAll("[", "");
                newValue = newValue.toString().replaceAll("]", "");
                newValue = newValue.toString().replaceAll("-", "/");
                newValue = newValue.toString().replaceAll(",", " - ");
            }
            else if(item === 'established_duration' && value != 'All') {
                if(value === '1_5_years') {
                    newValue = '1 - 5 Years';
                }
                else if(value === '6_10_years') {
                    newValue = '6 - 10 Years';
                }
                else if(value === '11_20_years') {
                    newValue = '11 - 20 Years';
                }
                else if(value === '21_years_more') {
                    newValue = '20 Years More';
                }
            }
            return newValue;
        }
    },
	computed: {

        filterKey() {
            return Object.entries(this.filterData).filter(([key, value]) => key === 'country_id' || key === 'industry_type_id' || key === 'category_id' || key === 'daterange' || key === 'established_duration');
        },
		/*
			separate teams, shifts, departments for faster array.find
		*/

		/*
			end team, shift, depts
		*/


		/*
			format filterList
			make filter naming uniform
			for easier filterTags sorting
		*/
		formattedTags () {
			let filters = cloneDeep(this.filterData)

			return filters
		},

		/*
			end formattedTags
		*/

		filterTags(){
			let vm = this
			let tags = []

			if(this.formattedTags.country_id && Number(this.formattedTags.country_id)
				&& this.filterList.countries && this.filterList.countries.length > 0
				&& (!this.disable || !this.disable.includes('country')))
			{
				let result = this.filterList.countries.find(item => {
					return Number(item.value) == Number(this.formattedTags.country_id) || Number(item.id) == Number(this.formattedTags.country_id)
				})
				console.log("result", result)

				if(result && result.name){
					let label = (this.includeLabel ? this.__('Country')+': ' : "") + this.__dt( result.translations, 'name', result.name )
					tags.push(label)
				}
			}

			if(this.formattedTags.city && this.formattedTags.city !== "All"
				&& (!this.disable || !this.disable.includes('city')))
			{
				let label = (this.includeLabel ? this.__('City')+': ' : "") + this.__(this.formattedTags.city)
				tags.push(label)
			}

			if(this.formattedTags.industry_type_id && Number(this.formattedTags.industry_type_id)
				&& this.filterList.industries && this.filterList.industries.length > 0
				&& (!this.disable || !this.disable.includes('industry_type')))
			{
				let result = this.filterList.industries.find(item => {
					return Number(item.value) == Number(this.formattedTags.industry_type_id) || Number(item.id) == Number(this.formattedTags.industry_type_id)
				})

				if(result && (result.label || result.name)){
					let label = (this.includeLabel ? this.__('Industry')+': ' : "") + this.__dt( result.translations, 'name', result.name )
					tags.push(label)
				}
			}

			if(this.formattedTags.category_id && Number(this.formattedTags.category_id)
				&& this.filterList.businessCategories && this.filterList.businessCategories.length > 0
				&& (!this.disable || !this.disable.includes('category')))
			{
				let result = this.filterList.businessCategories.find(item => {
					return Number(item.value) == Number(this.formattedTags.category_id) || Number(item.id) == Number(this.formattedTags.category_id)
				})

				if(result && (result.label || result.name)){
					let label = (this.includeLabel ? this.__('Category')+': ' : "") + this.__dt( result.translations, 'name', result.name )
					tags.push(label)
				}
			}

			if(this.formattedTags.daterange && (!this.disable || !this.disable.includes('daterange'))){
				let dateTag = (this.formattedTags.daterange[0] ? this.$df.formatDate(this.formattedTags.daterange[0], 'YYYY-MM-DD') + ' ~ ' : '')  + (this.formattedTags.daterange[1] ? this.$df.formatDate(this.formattedTags.daterange[1], 'YYYY-MM-DD') : '')
				if(dateTag != ''){
					tags.push(dateTag)
				}
			}

			if(this.formattedTags.established_duration && this.formattedTags.established_duration !== "All"
				&& this.filterList.durations && this.filterList.durations.length > 0
				&& (!this.disable || !this.disable.includes('established')))
			{
				let result = this.filterList.durations.find(item => {
					return item.value == this.formattedTags.established_duration
				})

				if(result && (result.label || result.name)){
					let label = (this.includeLabel ? this.__('Established')+': ' : "") + this.__( result.label)
					tags.push(label)
				}
			}

			return tags

		}
	}

}

</script>
