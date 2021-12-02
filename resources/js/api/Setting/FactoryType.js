import axios from 'axios'

export default {
	/**
	 * API endpoint to create new Factory Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	create(postData) {
		return axios.post('/factory-type', postData)
	},

	/**
	 * API endpoint to update a Factory Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	update(postData, id) {
		return axios.put(`/factory-type/${id}`, postData);
	},

	/**
	 * API endpoint to delete a Factory Types
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	delete(id) {
		return axios.delete(`/factory-type/${id}`)
	},

	/**
	 * API endpoint to fetch list of Factory Typess
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/factory-type/get-factory-types`, postData)
	},

    getFactoryType() {
        return axios.get('/factory-type/getFactoryTypeForAddress');
    }
}
