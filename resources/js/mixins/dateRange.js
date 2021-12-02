import moment from 'moment';

export default {
	data() {
        let datePeriods = [
            {value: 0,    label: this.__('Custom')},
            {value: 1,    label: this.__('This Month')},
            {value: 2,    label: this.__('This Week')},
            {value: 4,    label: this.__('This & Next 2 Months')},
            {value: 5,    label: this.__('This Year')},
            {value: 6,    label: this.__('Last Week')},
            {value: 7,    label: this.__('Last Month')},
            {value: 8,    label: this.__('Last Year')},
        ]
        if (this.isPro !== undefined && !!!this.isPro) {
            datePeriods.splice(6, 1)
        }

		return {
			rangeType        : null,
			datePeriods      : datePeriods,
            filterToday      : false,
            filterYesterday  : false
	   }
	},
    created(){

        if(this.filterYesterday){
            let filDate = {value: 10, label: this.__('Yesterday')}
            this.datePeriods.splice(1, 0, filDate)
        }

        if(this.filterToday){
            let filDate = {value: 9, label: this.__('Today')}
            this.datePeriods.splice(1, 0, filDate)
        }

        if(this.dateRangeLimitToPro){
            this.rangeType = 0
            this.datePeriods = [ {value: 0,    label: this.__('Custom')} ]
        }
    },
	methods: {
		periodChange() {
            let date = null
            if (this.rangeType === 0) {
                return
            } 
            if (this.rangeType === 1) {
                date = [this.$df.formatDate(moment().startOf('month'), 'YYYY-MM-DD'),
            			  this.$df.formatDate(moment().endOf('month'), 'YYYY-MM-DD')]
            }
            else if (this.rangeType === 2) {
                date = [this.$df.formatDate(moment().startOf('isoweek'), 'YYYY-MM-DD'),
                    this.$df.formatDate(moment().endOf('isoweek'), 'YYYY-MM-DD')]
            }
            else if (this.rangeType === 3) {
                date = [this.$df.formatDate(moment().startOf('month'), 'YYYY-MM-DD'),
            			  this.$df.formatDate(moment(), 'YYYY-MM-DD')]
            }
            else if (this.rangeType === 4) {
                date = [this.$df.formatDate(moment().startOf('month'), 'YYYY-MM-DD'),
                    this.$df.formatDate(moment().add(2, 'months').endOf('month'), 'YYYY-MM-DD')]
            }
            else if (this.rangeType === 5) {
                date = [this.$df.formatDate(moment().startOf('year'), 'YYYY-MM-DD'),
                    this.$df.formatDate(moment().endOf('year').endOf('month'), 'YYYY-MM-DD')]
            }
            else if (this.rangeType === 6) {
                date = [
                this.$df.formatDate(moment().subtract(1, 'week').startOf('week'), 'YYYY-MM-DD'),
                this.$df.formatDate(moment().subtract(1, 'week').endOf('week'), 'YYYY-MM-DD')
                ]
            }
            else if (this.rangeType === 7) {
                date = [
                    this.$df.formatDate(moment().subtract(1, 'months').startOf('month'), 'YYYY-MM-DD'),
                    this.$df.formatDate(moment().subtract(1, 'months').endOf('month'), 'YYYY-MM-DD')
                ]
            }
            else if (this.rangeType === 8) {
                date = [
                    this.$df.formatDate(moment().subtract(1, 'year').startOf('year'), 'YYYY-MM-DD'),
                    this.$df.formatDate(moment().subtract(1, 'year').endOf('year'), 'YYYY-MM-DD')
                ]
            }
            //Today
            else if (this.rangeType === 9) {
                let rangeDate = this.$df.formatDate(moment(), 'YYYY-MM-DD')
                date = [
                    rangeDate,
                    rangeDate
                ]
            }
            //Yesterday
            else if (this.rangeType === 10) {
                let rangeDate = this.$df.formatDate(moment().subtract(1, 'day'), 'YYYY-MM-DD')
                date = [
                    rangeDate,
                    rangeDate
                ]
            }
            //Select month
            if (this.rangeType === 12) {
                return
            }

            if (this.rangeType === -1) {
                date = null
            }

            if(this.filters && this.filters.daterange !== undefined)
                this.filters.daterange = date
          
            if(this.daterange !== undefined)
                this.daterange = date
        }
	}
}