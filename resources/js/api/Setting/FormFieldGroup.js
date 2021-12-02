import axios from "axios";

export default {
    /**
     * API endpoint to create new form field group
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/form-field-group", postData);
    },

    /**
     * API endpoint to update a form field group
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/form-field-group/${id}`, postData);
    },

    /**
     * API endpoint to delete a form field group
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id, from = 'global') {
        console.log("sfdsdf");
        return axios.delete(`/form-field-group/${id}?from=${from}`);
    },

	/**
	 * API endpoint to fetch list of form field groups
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/form-field-group/get-form-field-groups`, postData)
	}
}