import axios from 'axios'

export default {
	/**
	 * API endpoint to create new business social networking
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	createNewSns(postData) {
		return axios.post(`/business-sns`, postData);
	},

	/**
	 * Handle delete business social networking request
	 *
	 * @param id <string> - id
	 *
	 * @return <Promise>
	 */
	deleteSns(id) {
		return axios.delete(`/business-sns/${id}`)
	},

	/**
	 * Retrieve list of business social networking
	 *
	 * @param postData <object> - this will be used to filter the response data
	 *
	 * @return Promise
	 */
	getSnsList(postData) {
		return axios.post(`/business-sns/get-business-list`, postData)
	}
}