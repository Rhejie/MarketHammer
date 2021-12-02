import axios from "axios";

export default {
    /**
     * API endpoint to create new form builder field group
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/buyer/form-builder-field-group", postData);
    },

    /**
     * API endpoint to update a form builder field group
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/buyer/form-builder-field-group/${id}`, postData);
    },

    /**
     * API endpoint to delete a form builder field group
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id, from = 'global') {
        console.log("sfdsdf");
        return axios.delete(`/buyer/form-builder-field-group/${id}?from=${from}`);
    },

	/**
	 * API endpoint to fetch list of form builder field groups
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/buyer/form-builder-field-group/get-form-builder-field-groups`, postData)
	}
}