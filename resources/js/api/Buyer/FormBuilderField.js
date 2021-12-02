import axios from "axios";

export default {
    /**
     * API endpoint to create new template form builder field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/buyer/form-builder-field", postData);
    },

    /**
     * API endpoint to update a template form builder field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/buyer/form-builder-field/${id}`, postData);
    },

    /**
     * API endpoint to delete a template form builder field
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id, from = 'global') {
        console.log("sfdsdf");
        return axios.delete(`/buyer/form-builder-field/${id}?from=${from}`);
    },

	/**
	 * API endpoint to fetch list of template form builder field
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/buyer/form-builder-field/get-form-builder-fields`, postData)
	}
}