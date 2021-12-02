import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/business-qsa`, data);
    },
    show(id) {
        return axios.get(`/business-qsa/${id}`);
    },
    update(data) {
        return axios.put(`/business-qsa/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/business-qsa/${id}`);
    },
    get(data) {
        return axios.post(`/business-qsa`, data);
    },
    getList(data) {
        return axios.post(`/business-qsa/get-list`, data);
    },

}