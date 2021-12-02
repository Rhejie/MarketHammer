import axios from 'axios'

export default {
    storeCompany(data) {
        return axios.post(`/company`, data);
    },
}