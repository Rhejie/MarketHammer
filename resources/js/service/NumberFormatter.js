import moment from 'moment'

export default class NumberFormatter{

	/**
     * Format given number into a currency string
     *
     * @param input <number | string> - the number pattern
     * @return <string | boolean>
     */
    formatToMonetary(input, noDecimal = false, returnZero = false) {
        let numbers = this.cleanNumber(input)
        if (!numbers){
            if(!returnZero) return false
            else numbers = 0
        }

    	if(noDecimal && this.isWholeNumber(numbers)){
    		return Number(numbers).toFixed().replace(/\d(?=(\d{3})+\.)/g, '$&,')
    	}

        // Match a number if it is followed by a 3 set of number and a dot
        return Number(numbers).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
    }

    /**
     * Remove unwanted characters from given number
     *
     * @param input <number | string> - the number pattern
     * @return <string | boolean>
     */
    cleanNumber(input) {
        if ([undefined, NaN].includes(input) 
            || ['boolean', 'object'].includes(typeof input)) {
            return false
        }
        return input.toString().replace(/[!@#$%^&*a-zA-Z]/g, "")
    }

    monetoryDefault(input){
    	let number = this.formatToMonetary(input, true)

    	return 'US$ ' + number
    }

    isWholeNumber(numDays){
        let numCount = (numDays- Math.floor(numDays)) !== 0
        if(!numCount){
            return true
        }
        return false
    }
}