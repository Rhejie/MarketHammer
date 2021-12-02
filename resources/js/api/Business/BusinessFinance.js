import axios from 'axios'

export default {
	/**
	 * API endpoint to create new business finance
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	create(postData) {
		return axios.post('/business-finance', postData)
	},

	/**
	 * API endpoint to update a business finance
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	update(postData, id) {
		return axios.put(`/business-finance/${id}`, postData);
	},

	/**
	 * API endpoint to delete a business finances
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	delete(id) {
		return axios.delete(`/business-finance/${id}`)
	},

	/**
	 * API endpoint to fetch list of business finances
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/business-finance/get-business-finances`, postData)
	}
}