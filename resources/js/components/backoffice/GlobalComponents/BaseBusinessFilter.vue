<template>
    <base-filter-dropdown-box
        v-model="filterVisible"
        placement="bottom"
        width="300"
        trigger="manual"
        class="filter-container"
        ref="baseFilterPopover">
        <div class="businessListFilterContainer" slot="body">

            <el-form :model="filters" ref="filterForm" :label-position="'top'" class="filterForm">
                <section class="business-list-filter">

                    <el-form-item :label="__('Country')">
                        <el-select
                            v-model="filters.country_id"
                            filterable
                            :placeholder="__('Select Country')"
                            class="filter-form-dropdown"
                            @change="countryChange()">
                                <el-option :label="__('All')" :value="'All'"></el-option>
                                <el-option
                                    v-for="country in countryList"
                                    :key="country.id"
                                    :value="Number(country.id)"
                                    :label="__dt( country.translations, 'name', country.name )">
                                </el-option>
                            </el-select>
                    </el-form-item>

                    <el-form-item :label="__('City')" v-if="filters.country_id != 'All'">
                        <el-select
                            v-loading="gettingCities"
				    		:disabled="!filters.country_id"
                            v-model="filters.city"
                            filterable
                            :placeholder="__('Select City')"
                            class="filter-form-dropdown">
                                <el-option :label="__('All')" :value="'All'"></el-option>
                                <el-option
                                    v-for="city in cities"
                                    :key="city.id"
                                    :value="city.name"
                                    :label="__( $sf.removeDiacritics(city.name) )">
                                </el-option>
                            </el-select>
                    </el-form-item>

                    <!-- <el-form-item :label="__('State')">
                        <el-select
                            v-model="filters.state_id"
                            filterable
                            :placeholder="__('Select State')"
                            class="filter-form-dropdown">
                                <el-option :label="__('All')" value="All"></el-option>
                                <el-option
                                    v-for="state in filterList.states"
                                    :key="state.id"
                                    :value="state.id"
                                    :label="__dt( state.translations, 'name', state.name )">
                                </el-option>
                            </el-select>
                    </el-form-item> -->

                    <el-form-item :label="__('Industry')">
                        <el-select
                            v-model="filters.industry_type_id"
                            filterable
                            :placeholder="__('Select Industry')"
                            class="filter-form-dropdown"
                            @change = "changeIndustry">
                                <el-option :label="__('All')" :value="'All'"></el-option>
                                <el-option
                                    v-for="industry in industryList"
                                    :key="industry.id"
                                    :value="industry.id"
                                    :label="__dt( industry.translations, 'name', industry.name )">
                                </el-option>
                            </el-select>
                    </el-form-item>

                    <el-form-item :label="__('Business Category')">
                        <el-select
                            v-model="filters.category_id"
                            filterable
                            :placeholder="__('Select Business Category')"
                            class="filter-form-dropdown">
                                <el-option :label="__('All')" :value="'All'"></el-option>
                                <el-option
                                    v-for="cat in businessCatList"
                                    :key="cat.id"
                                    :value="cat.id"
                                    :label="__dt( cat.translations, 'name', cat.name )">
                                </el-option>
                            </el-select>
                    </el-form-item>


                    <el-form-item :label="__('Registered Date')">
                        <el-select
                            v-model="rangeType"
                            :placeholder="__('Select period')"
                            class="filter-form-dropdown"
                            filterable
                            @change="periodChange">
                            <el-option
                                v-for="period in datePeriods"
                                :key="period.value"
                                :label="__(period.label)"
                                :value="period.value">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item v-if="rangeType == 0">
                        <el-date-picker
                            v-model="filters.daterange"
                            type="daterange"
                            align="right"
                            style="width: auto"
                            :start-placeholder="__('Start')"
                            :end-placeholder="__('End')">
                        </el-date-picker>
                    </el-form-item>

                    <el-form-item :label="__('Established Duration')">
                        <el-select
                            v-model="filters.established_duration"
                            :placeholder="__('Select duration')"
                            class="filter-form-dropdown"
                            filterable
                            @change="periodChange">
                            <el-option :label="__('All')" :value="'All'"></el-option>
                            <el-option
                                v-for="duration in durationList"
                                :key="duration.value"
                                :label="__(duration.label)"
                                :value="duration.value">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <div class = "pull-right mg-b-10">
                        <el-button
                            type="text"
                            class="btn-reset"
                            @click="resetFilters">
                            {{ __('Reset') }}
                        </el-button>
                        <el-button
                            round
                            size="small"
                            class="btn btn-primary btn-black"
                            @click="filterBusinessList"
                            type="primary"
                               >
                            {{ __('Filter') }}
                        </el-button>
                    </div>

                </section>
            </el-form>
        </div>

        <el-button
            class="mh-btn"
            slot="reference"
            title="Filter"
            icon="fas fa-filter"
            @click="filterVisible = !filterVisible"
        >
        </el-button>
    </base-filter-dropdown-box>
</template>

<script>
import cloneDeep from 'lodash/cloneDeep'
import _forEach from 'lodash/forEach'
import dateRange from '../../../mixins/dateRange'
import csc from 'country-state-city'

export default {
    props: {
        filterList : {
            type: Object,
            required: true,
        },
        filterData : {
            type: Object,
            required: true,
        },

    },
    mixins: [dateRange],
    data(){
        let durations = [
            {value : '1_5_years', label : "1-5 Years"},
            {value : '6_10_years', label : "6-10 Years"},
            {value : '11_20_years', label : "11-20 Years"},
            {value : '21_years_more', label : "21 Years More"},
        ]
        return{
            filters                 : this.filterData,
            filterVisible           : false,
            countryList             : this.filterList.countries ? this.filterList.countries : [],
            industryList            : this.filterList.industries ? this.filterList.industries : [],
            businessCategories      : this.filterList.businessCategories ? this.filterList.businessCategories : [],
            durationList            : this.filterList.durations ? this.filterList.durations : durations,
            businessCatList         : [],
            selectedCountry         : [],
            cities                  : [],
            gettingCities           : false
        }
    },
    created(){
        this.datePeriods = [
            {value: 0,    label: this.__('Custom')},
            {value: 1,    label: this.__('This Month')},
            {value: 5,    label: this.__('This Year')},
        ]

        this.rangeType = this.filterData.rangeType ? this.filterData.rangeType : 5
        this.periodChange()
        this.countryChange(true)
    },
    methods:{
        countryChange(val) {
            console.log(val)
            if (this.filters.country_id && this.filters.country_id != "All") {
                this.gettingCities = true
                let country = this.countryList.find(c => c.id == this.filters.country_id)
                if (country) {
                    this.selectedCountry = country
                    let countryCities = csc.getCitiesOfCountry(this.selectedCountry.country_code)
                    this.cities = countryCities
                    this.gettingCities = false
                } else {
                    this.gettingCities = false
                }
            }
            if(val !== true){
                this.filters.city = "All"
            }

        },
        filterBusinessList(){
            this.setDuration()
            this.$emit('change')

            this.$refs.baseFilterPopover.$refs.filterBox.showPopper = false
        },
        resetFilters(){
            this.filters.country_id = 'All'
            this.filters.city = 'All'
            this.filters.industry_type_id = 'All'
            this.filters.category_id = 'All'
            this.filters.established_duration = 'All'

            this.rangeType = 5
            this.periodChange()

            this.setDuration()
            this.$emit('change')

            this.$refs.baseFilterPopover.$refs.filterBox.showPopper = false
        },
        setDuration(){
            if(this.filters.established_duration == '1_5_years'){
                this.filters.est_min = 1
                this.filters.est_max = 5
            }
            else if(this.filters.established_duration == '6_10_years'){
                this.filters.est_min = 6
                this.filters.est_max = 10
            }
            else if(this.filters.established_duration == '11_20_years'){
                this.filters.est_min = 11
                this.filters.est_max = 20
            }
            else if(this.filters.established_duration == '21_years_more'){
                this.filters.est_min = 21
                this.filters.est_max = null
            }
            else{
                this.filters.est_min = null
                this.filters.est_max = null
            }
        },
        changeIndustry(val){
            let catList = []
            if(val){
                catList = this.businessCategories.filter(fn => fn.industry_type_id = val)
            }
            this.businessCatList = catList
        }
    }
}
</script>
<style lang="scss">
.businessListFilterContainer {
    padding: 10px;
    .header {
        font-weight: bold;
        font-size: 15px !important;
    }

    label {
        display: block;
    }

    .filterForm {
        margin-top: 0px;
        .filter-form-dropdown {
            width: 100%;
            .el-input__inner {
                height: 35px;
                border-radius: 2px;
            }
        }

        .filter-form-input {
            .el-input__inner {
                height: 35px;
                border-radius: 2px;
            }
        }
    }

    .filter-button {
        text-align: right;
    }

    .el-slider__runway {
        margin-right: 80px !important;

        .el-slider__bar {
            background-color: #ec3434;
        }
        .el-slider__button-wrapper {
            .el-slider__button {
                border: 2px solid #ec3434;
            }
        }

        .el-slider__marks-text {
            margin-top: 2px;
        }

        .el-slider__marks-text:last-child {
            margin-right: -25px;
            left: unset !important;
            right: 0;
        }
    }

    .el-slider__input {
        .el-input {
            .el-input__inner {
                width: 65px !important;
                float: right !important;
            }
        }
    }
}
</style>
