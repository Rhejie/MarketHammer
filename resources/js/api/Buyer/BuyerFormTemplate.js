import axios from "axios";

export default {
    /**
     * API endpoint to create new buyer form template
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/buyer/buyer-form-template", postData);
    },

    /**
     * API endpoint to fetch one single instance of buyer form template
     *
     * @param id <int>
     *
     * @return Promise
     */
    show(id) {
        return axios.get(`/buyer/buyer-form-template/${id}`)
    },

    /**
     * API endpoint to update a buyer form template
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/buyer/buyer-form-template/${id}`, postData);
    },

    /**
     * API endpoint to delete a buyer form template
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
	 * API endpoint to fetch list of buyer form templates
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/buyer/buyer-form-template/get-buyer-form-templates`, postData)
	},

    /**
     * API endpoint to get all buyer form template types
     *
     * @return Promise
     */
    getFieldTypeList() {
        return axios.get(`/buyer/buyer-form-template/get-field-type-list`)
    },

    /**
     * API endpoint to update the template's form builder
     * 
     * @param postData <array> - the form builder information
     * 
     * @return Promise
     */
    buildTemplate(postData) {
        return axios.post(`/buyer/buyer-form-template/build-template`, postData)
    }
}