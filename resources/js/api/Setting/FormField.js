import axios from "axios";

export default {
    /**
     * API endpoint to create new form field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/form-field", postData);
    },

    /**
     * API endpoint to update a form field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/form-field/${id}`, postData);
    },

    /**
     * API endpoint to delete a form field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id, from = 'global') {
        console.log("sfdsdf");
        return axios.delete(`/form-field/${id}?from=${from}`);
    },

	/**
	 * API endpoint to fetch list of form fields
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/form-field/get-form-fields`, postData)
	},

    /**
     * API endpoint to get all form field types
     *
     * @return Promise
     */
    fetchComponentServiceData() {
        return axios.get(`/form-field/fetch-component-service-data`)
    },
    
    getFieldTypeList() {
        return axios.get(`/form-field/get-field-type-list`)
    },

    getOptionReferenceList() {
        return axios.get(`/form-field/get-option-reference-list`)
    },

    getFields(name)
    {
        return axios.get(`/form-field/get-fields-list/${name}`)
    }
}