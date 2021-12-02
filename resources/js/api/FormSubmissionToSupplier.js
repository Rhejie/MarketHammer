import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/form-submission-to-supplier`, data);
    },
    update(data) {
        return axios.put(`/form-submission-to-supplier/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/form-submission-to-supplier/${id}`);
    },

}