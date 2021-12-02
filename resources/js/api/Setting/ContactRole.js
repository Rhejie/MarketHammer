import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/system-data/contact-role`, data);
    },
    show(id) {
        return axios.get(`/system-data/contact-role/${id}`);
    },
    update(data) {
        return axios.put(`/system-data/contact-role/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/system-data/contact-role/${id}`);
    },
    get(data) {
        return axios.post(`/system-data/contact-role`, data);
    },
    getList(data) {
        return axios.post(`/system-data/contact-role/get-list`, data);
    },

}