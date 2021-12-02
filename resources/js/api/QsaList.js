import axios from 'axios'

export default {
    getList(data) {
        return axios.post(`/setting/qsa-list/get-list`, data);
    },
    getQsaList(data) {
        return axios.post(`/setting/get-qsa-list`, data);
    },
     /**
     * Create a POST HTTP request to save new QSA data
     *
     * @param postData <object>
     *
     * @return Promise
     */
    store(postData) {
        return axios.post(`/setting/qsa-list`, postData);
    },

    /**
     * API endpoint for updating specific qsa list information
     *
     * @param postData <object>
     *
     * @return Promise
     */
    update(postData) {
        return axios.put(`/setting/qsa-list/${postData.id}`, postData);
    },

     /**
     * Retrieve single instance of qsa_list data
     *
     * @param id <string>
     *
     * @return Promise
     */
    show(id) {
        return axios.get(`/setting/qsa-list/${id}`);
    },
    
    /**
     * API endpoint for deleting specific qsa list data
     *
     * @param id <string>
     *
     * @return Promise
     */
    destroy(id) {
        return axios.delete(`/setting/qsa-list/${id}`);
    },

    /**
     * API endpoint for retrieving a qsa list item
     *
     * @param id <string>
     *
     * @return Promise
     */
    get(data) {
        return axios.post(`/setting/qsa-list`, data);
    }
}