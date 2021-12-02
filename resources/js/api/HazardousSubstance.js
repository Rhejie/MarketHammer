import axios from 'axios'

export default {
    showHazardousSubstances(params) {
        return axios.get(`/system-data/hazardous-substance?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },

    /**
     * Create a POST HTTP request to save new hazardous substance data
     *
     * @param postData <object>
     *
     * @return Promise
     */
    store(postData) {
        return axios.post(`/system-data/hazardous-substance`, postData);
    },

    /**
     * API endpoint for updating specific hazardous substance information
     *
     * @param postData <object>
     *
     * @return Promise
     */
    update(postData) {
        return axios.put(`/system-data/hazardous-substance/${postData.id}`, postData);
    },

    /**
     * Retrieve single instance of hazardous substance data
     *
     * @param id <string>
     *
     * @return Promise
     */
    show(id) {
        return axios.get(`/system-data/hazardous-substance/${id}`);
    },

    /**
     * API endpoint for deleting specific hazardous substance
     *
     * @param id <string>
     *
     * @return Promise
     */
    delete(id) {
        return axios.delete(`/system-data/hazardous-substance/${id}`);
    }
}
