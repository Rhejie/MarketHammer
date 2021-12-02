import axios from "axios";
export default {
    
    fetch(params) {
		//return axios.post(`/form-status/get-form-status`, postData)
        return axios.get(
            `/form-status/get-form-status?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
	},
    /**
     * API endpoint to create new complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    create(postData) {
        return axios.post("form-status/store-form-status", postData);
    },

    /**
     * API endpoint to update a complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    update(postData, id) {
        return axios.post(`form-status/update-form-status/${id}`, postData);
    },

    /**
     * API endpoint to delete a complex type
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    delete(id) {
        return axios.post(`form-status/delete-form-status/${id}`);
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

   
};
