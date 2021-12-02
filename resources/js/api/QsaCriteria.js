import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/system-data/qsa-criteria`, data);
    },
    show(id) {
        return axios.get(`/system-data/qsa-criteria/${id}`);
    },
    update(data) {
        return axios.put(`/system-data/qsa-criteria/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/system-data/qsa-criteria/${id}`);
    },
    get(data) {
        return axios.post(`/system-data/qsa-criteria`, data);
    },
    getList(data) {
        return axios.post(`/system-data/qsa-criteria/get-list`, data);
    },

}