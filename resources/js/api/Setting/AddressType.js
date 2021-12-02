import axios from 'axios'

export default {
	/**
	 * API endpoint to create new Address Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	create(postData) {
		return axios.post('/address-type', postData)
	},

	/**
	 * API endpoint to update a Address Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	update(postData, id) {
		return axios.put(`/address-type/${id}`, postData);
	},

	/**
	 * API endpoint to delete a Address Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	delete(id) {
		return axios.delete(`/address-type/${id}`)
	},

	/**
	 * API endpoint to fetch list of Address Typess
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/address-type/get-address-types`, postData)
	}
}
