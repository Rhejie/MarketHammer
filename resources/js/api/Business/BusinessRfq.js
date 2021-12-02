import axios from 'axios'

export default {
    getRfq(data) {
        console.log("Here")
        return axios.post(`/supplier/rfq-form/get-list`, data);
    },

    getFormDetails(data) {
        return axios.post(`/supplier/rfq-form/get-form-details`, data);
    },

    getFields(data) {
        return axios.post(`/supplier/rfq-form/get-fields`, data);
    },
}