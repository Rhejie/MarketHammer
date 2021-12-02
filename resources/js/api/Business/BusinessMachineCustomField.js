import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/machine-custom-field`, data);
    },
    show(id) {
        return axios.get(`/machine-custom-field/${id}`);
    },
    update(data) {
        return axios.put(`/machine-custom-field/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/machine-custom-field/${id}`);
    },
    get(data) {
        return axios.post(`/machine-custom-field`, data);
    },

}