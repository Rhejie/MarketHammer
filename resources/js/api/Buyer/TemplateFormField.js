import axios from "axios";

export default {
    /**
     * API endpoint to create new template form field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/buyer/buyer-form-template", postData);
    },

    /**
     * API endpoint to update a template form field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/buyer/buyer-form-template/${id}`, postData);
    },

    /**
     * API endpoint to delete a template form field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id, from = 'global') {
        console.log("sfdsdf");
        return axios.delete(`/buyer/buyer-form-template/${id}?from=${from}`);
    },

	/**
	 * API endpoint to fetch list of template form fields
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/buyer/buyer-form-template/get-buyer-form-templates`, postData)
	},

    /**
     * API endpoint to get all template form field types
     *
     * @return Promise
     */
    getFieldTypeList() {
        return axios.get(`/buyer/buyer-form-template/get-field-type-list`)
    }
}