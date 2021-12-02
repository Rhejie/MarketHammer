import axios from 'axios'

export default {
	/**
	 * API endpoint to fetch list of business levels
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/business-level/get-business-levels`, postData)
	},

	store(postData) {
		return axios.post('/business-level', postData)
	},

	update(postData, id) {
        return axios.put(`/business-level/${id}`, postData);
    },

	delete(id) {
		return axios.delete(`/business-level/${id}`)
	},
}