import axios from "axios";

export default {
    /**
     * API endpoint to create new Business keyword
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/business-keyword", postData);
    },

    /**
     * API endpoint to update a Business keyword
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/business-keyword/${id}`, postData);
    },

    /**
     * API endpoint to delete a Business keyword
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id) {
        return axios.delete(`/business-keyword/${id}`);
    },

    /**
     * API endpoint to fetch list of Business keywords
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    fetch(postData) {
        return axios.post(`/business-keyword/get-business-keywords`, postData);
    },

    getFactoryType() {
        return axios.get("/business-keyword/getFactoryTypeForAddress");
    },

    getBusinessKeywords(id) {
        return axios.get(`/business-keyword/get-business-keywords-data/${id}`);
    },

    addNewBusinessKeywords(postData) {
        return axios.post("/business-keyword/add-new-keyword", postData);
    },

    createBusinessKeyword(data) {
        return axios.post("/business-keyword/add-selected-keyword", data);
    },
    deleteKeywordData(id) {
        return axios.post(`/business-keyword/delete-keyword/${id}`);
    },
    deleteKeywordByName(postData) {
        return axios.post("/business-keyword/deleteKeywordByName/", postData);
    },
    delKeyByName(postData) {
        return axios.post('business-keyword/delete-keyword-by-name', postData);
    }

};
