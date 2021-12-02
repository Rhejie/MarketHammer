import axios from 'axios'

export default {
	/**
	 * API endpoint to create new Certification Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	create(postData) {
		return axios.post('/certification-type', postData)
	},

	/**
	 * API endpoint to update a Certification Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	update(postData, id) {
		return axios.put(`/certification-type/${id}`, postData);
	},

	/**
	 * API endpoint to delete a Certification Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	delete(id) {
		return axios.delete(`/certification-type/${id}`)
	},

	/**
	 * API endpoint to fetch list of Certification Typess
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/certification-type/get-certification-types`, postData)
	}
}
