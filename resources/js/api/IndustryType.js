import axios from 'axios'

export default {
    showIndustryTypes(params) {
        return axios.get(`/industry-type?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },

    /**
     * Create a POST HTTP request to save new industry type data
     *
     * @param postData <object>
     *
     * @return Promise
     */
    store(postData) {
        return axios.post(`/industry-type`, postData);
    },

    /**
     * API endpoint for updating specific industry type information
     *
     * @param postData <object>
     *
     * @return Promise
     */
    update(postData) {
        return axios.put(`/industry-type/${postData.id}`, postData);
    },

    /**
     * Retrieve single instance of industry type data
     *
     * @param id <string>
     *
     * @return Promise
     */
    show(id) {
        return axios.get(`/industry-type/${id}`);
    },

    /**
     * API endpoint for deleting specific industry type
     *
     * @param id <string>
     *
     * @return Promise
     */
    delete(id) {
        return axios.delete(`/industry-type/${id}`);
    }
}