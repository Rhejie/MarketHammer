import axios from 'axios'

export default {
	/**
	 * API endpoint to create new SNS
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	create(postData) {
		return axios.post('/sns', postData)
	},

	/**
	 * API endpoint to update a SNS
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	update(postData, id) {
		return axios.put(`/sns/${id}`, postData);
	},

	/**
	 * API endpoint to delete a SNS
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	delete(id) {
		return axios.delete(`/sns/${id}`)
	},

	/**
	 * API endpoint to fetch list of SNSs
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/sns/get-sns-list`, postData)
	}
}