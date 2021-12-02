import axios from "axios";

export default {
    /**
     * API endpoint to create new business partner
     *
     * @param postData <object> - the data to be saved
     *
     * @return Promise
     */
    storeBusinessPartner(postData) {
        return axios.post(`/business-partner`, postData);
    },

    /**
     * API endpoint to update new business partner
     *
     * @param postData <object> - the data to be saved
     * @param id <string> - the business partner data that will be updated
     *
     * @return Promise
     */
    updateBusinessPartner(postData, id) {
        return axios.put(`/business-partner/${id}`, postData);
    },

    /**
     * Handle delete business partner request
     *
     * @param id <string> - id
     *
     * @return <Promise>
     */
    destroyBusinessPartner(id) {
        return axios.delete(`/business-partner/${id}`);
    },

    /**
     * Retrieve list of business partner
     *
     * @param postData <object> - this will be used to filter the response data
     *
     * @return Promise
     */
    getBusinessPartners(postData) {
        return axios.post(`/business-partner/get-partner-list`, postData);
    }
};
