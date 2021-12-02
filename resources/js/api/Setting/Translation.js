import axios from "axios";

export default {
    /**
     * API endpoint to create new translation
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/translation", postData);
    },

    /**
     * API endpoint to update a translation
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/translation/${id}`, postData);
    },

    /**
     * API endpoint to delete a translation
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id) {
        console.log("sfdsdf");
        return axios.delete(`/translation/${id}`);
    },

	/**
	 * API endpoint to fetch list of translations
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	fetch(postData) {
		return axios.post(`/translation/get-translations`, postData)
	},

	/**
	 * HTTP request for syncing translaion data to the translation files
	 *
	 * @return Promise
	 */
	syncTranslations() {
		return axios.get(`/translation/sync-translations`)
	}
}