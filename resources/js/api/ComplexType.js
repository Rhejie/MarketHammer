import axios from "axios";

export default {
     /**
     * API endpoint to create new complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("/complex-type", postData);
    },

    /**
     * API endpoint to update a complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.put(`/complex-type/${id}`, postData);
    },

    /**
     * API endpoint to delete a complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id) {
        return axios.delete(`/complex-type/${id}`);
    },

    /**
     * Retrieve single instance of complext type
     *
     * @param id <string>
     *
     * @return Promise
     */
    show(id) {
        return axios.get(`/complex-type/${id}`);
    },

    /**
     * API endpoint to fetch list of complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    fetch(params) {
        return axios.get(
            `/complex-type/get-complex-types?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
    },

    /**
     * Get all list of complex types
     *
     * @return <Promise>
     */
    getComplexTypes() {
        return axios.get("/complex-type/get-complex");
    },
};
