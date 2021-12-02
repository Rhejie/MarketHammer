import axios from 'axios'

export default {
    showUnitMeasures(params) {
        return axios.get(`/system-data/unit-measure?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },

    /**
     * Create a POST HTTP request to save new unit of measure data
     *
     * @param postData <object>
     *
     * @return Promise
     */
    store(postData) {
        return axios.post(`/system-data/unit-measure`, postData);
    },

    /**
     * API endpoint for updating specific unit of measure information
     *
     * @param postData <object>
     *
     * @return Promise
     */
    update(data) {
        return axios.put(`/system-data/unit-measure/${data.id}`, data);
    },

    /**
     * Retrieve single instance of unit of measure data
     *
     * @param id <string>
     *
     * @return Promise
     */
    show(id) {
        return axios.get(`/system-data/unit-measure/${id}`);
    },

    /**
     * API endpoint for deleting unit of measure type
     *
     * @param id <string>
     *
     * @return Promise
     */
    delete(id) {
        return axios.delete(`/system-data/unit-measure/${id}`);
    }
}