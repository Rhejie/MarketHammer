import axios from 'axios'

export default {
    showCertifications(params) {
        return axios.get(`/system-data/certification?page=${params.current_page}&count=${params.current_size}&search=${params.search}&filter=${JSON.stringify(params.filter)}`);
    },
    
     /**
     * Create a POST HTTP request to save new certification data
     *
     * @param postData <object>
     *
     * @return Promise
     */
    store(postData) {
        return axios.post(`/system-data/certification`, postData);
    },
    
    /**
     * Retrieve single instance of certification data
     *
     * @param id <string>
     *
     * @return Promise
     */
    show(id) {
        return axios.get(`/system-data/certification/${id}`);
    },

    /**
     * API endpoint for updating specific certification information
     *
     * @param postData <object>
     * @param id <string>
     *
     * @return Promise
     */
    update(data) {
        return axios.put(`/system-data/certification/${data.id}`, data);
    },

    /**
     * API endpoint for deleting specific certification
     *
     * @param id <string>
     *
     * @return Promise
     */
    delete(id) {
        return axios.delete(`/system-data/certification/${id}`);
    }
}