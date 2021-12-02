import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/business-product`, data);
    },
    show(id) {
        return axios.get(`/business-product/${id}`);
    },
    update(data) {
        return axios.put(`/business-product/${data.id}`, data);
    },

    destroy(id) {
        return axios.delete(`/business-product/${id}`);
    },
    get(data) {
        return axios.post(`/business-product`, data);
    },

}
