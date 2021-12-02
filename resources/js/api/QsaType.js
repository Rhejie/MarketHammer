import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/system-data/qsa-type`, data);
    },
    show(id) {
        return axios.get(`/system-data/qsa-type/${id}`);
    },
    update(data) {
        return axios.put(`/system-data/qsa-type/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/system-data/qsa-type/${id}`);
    },
    get(data) {
        return axios.post(`/system-data/qsa-type`, data);
    },
    getList(data) {
        return axios.post(`/system-data/qsa-type/get-list`, data);
    },

}