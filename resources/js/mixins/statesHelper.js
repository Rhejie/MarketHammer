import axios from 'axios'

export default {
	data() {
		return {
			states: [],
			gettingStates: false
		}
	},
	methods: {
		getStates(countryId) {
			this.gettingStates = true

			let postData = {
				country_id: countryId
			}

			axios.post(`/utils/get-states`, postData)
			.then(res => {
				if (Array.isArray(res.data)) {
					this.states = res.data
				}
			})
			.catch(err => {
				console.log(err)
			})
			.finally(_ => {
				this.gettingStates = false
			})
		}
	}
}