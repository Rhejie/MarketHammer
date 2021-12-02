import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/business-user-type-permission`, data);
    },
    destroy(id) {
        return axios.delete(`/business-user-type-permission/${id}`);
    },
    getPermission(data) {
        return axios.post(`/business-user-type-permission/get-permission`, data);
    },

}