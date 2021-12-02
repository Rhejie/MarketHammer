import axios from 'axios'

export default {
	/**
	 * Create new user token item
	 *
	 * @param postData - the token information to be saved
	 *
	 * @return Promise
	 */
	create(postData) {
		return axios.post(`/user-token`, postData)
	},

	/**
	 * Delete user token entry
	 *
	 * @param id - the token id
	 *
	 * @return Promise
	 */
	delete(id) {
		return axios.delete(`/user-token/${id}`)
	},
}