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
        return axios.post("processes/store-processes", postData);
    },

    /**
     * API endpoint to update a complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.post(`processes/update-process/${id}`, postData);
    },

    /**
     * API endpoint to delete a complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id) {
        return axios.post(`processes/delete-processes/${id}`);
    },

    /**
     * Retrieve single instance of complext type
     *
     * @param id <string>
     *
     * @return Promise
     */
    // show(id) {
    //     return axios.get(`/complex-type/${id}`);
    // },

    /**
     * API endpoint to fetch list of complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    fetch(params) {
        return axios.get(
            `/processes/get-processes?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
    },

    /**
     * Get all list of complex types
     *
     * @return <Promise>
     */
    getProcessesProcess_type() {
        return axios.get("/processes/get-process_type");
    }
};
