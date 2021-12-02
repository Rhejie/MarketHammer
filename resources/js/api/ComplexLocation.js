import axios from "axios";

export default {
     /**
     * API endpoint to create new complex location
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/complex-location", postData);
    },

    /**
     * API endpoint to update a complex location
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/complex-location/${id}`, postData);
    },

    /**
     * API endpoint to delete a complex location
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id) {
        return axios.delete(`/complex-location/${id}`);
    },

    /**
     * Retrieve single instance of complext type
     *
     * @param id <string>
     *
     * @return Promise
     */
    show(id) {
        return axios.get(`/complex-location/${id}`);
    },

    /**
     * API endpoint to fetch list of complex location
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    fetch(params) {
        return axios.get(
            `/complex-location/get-complex-locations?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
    },

    /**
     * Get all list of complex locations
     *
     * @return <Promise>
     */
    getComplexLocations() {
        return axios.get("/complex-location/get-complex");
    }
};
