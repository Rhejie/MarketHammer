import axios from 'axios'

export default {
	/**
	 * Create new API endpoint to register new supplier
	 *
	 * @param postData <object> - post information for new supplier to be saved
	 *
	 * @return <Promise>
	 */
	createNewSupplier(postData) {
		return axios.post(`/register/register-supplier`, postData);
	},
}