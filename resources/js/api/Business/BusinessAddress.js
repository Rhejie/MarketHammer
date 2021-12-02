import axios from 'axios'

export default {
	/**
	 * API endpoint to create new business address
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	createNewAddress(postData) {
		return axios.post(`/business-address`, postData);
	},
	/**
	 * API endpoint to update new business address
	 *
	 * @param postData <object> - the data to be saved
	 * @param id <string> - the business address data that will be updated
	 *
	 * @return Promise
	 */
	updateAddress(postData, id) {
		return axios.put(`/business-address/${id}`, postData);
	},

	/**
	 * Handle delete business address request
	 *
	 * @param id <string> - id
	 *
	 * @return <Promise>
	 */
	deleteBusinessAddress(id) {
		return axios.delete(`/business-address/${id}`)
	},

	/**
	 * Retrieve list of business address
	 *
	 * @param postData <object> - this will be used to filter the response data
	 *
	 * @return Promise
	 */
	getBusinessAddresses(postData) {
		return axios.post(`/business-address/get-business-addresses`, postData)
	}
}
