import axios from "axios";

export default {
    /**
     * API endpoint to create new global keyword
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/global-keyword", postData);
    },

    /**
     * API endpoint to update a global keyword
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/global-keyword/${id}`, postData);
    },

    /**
     * API endpoint to delete a global keyword
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id, from = "global") {
        console.log("sfdsdf");
        return axios.delete(`/global-keyword/${id}?from=${from}`);
    },

    /**
     * API endpoint to fetch list of global keyword
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    fetch(postData) {
        return axios.post(`/global-keyword/get-keyword-list`, postData);
    },

    /**
     * Will call an API to search for keywords
     *
     * @param query <string> - query string
     *
     * @return <Promise>
     */
    searchKeywords(query, postData) {
        return axios.post(
            `/global-keyword/search-keywords?query=${query}`,
            postData
        );
    },

    getBusinessKeywordsData(query, postData) {
        return axios.get(
            `global-keyword/get-keywords?query=${query}&business_id=${postData}`
        );
    },

    getGlobalKeywords(postData) {
        return axios.get(
            `global-keyword/get-all-keywords?business_id=${postData}`
        );
    }
};
