import axios from 'axios'

export default {
    saveAnswer(data) {
        return axios.post(`/form-field-answer/save-answer`, data);
    },
    store(data) {
        return axios.post(`/form-field-answer`, data);
    },
    show(id) {
        return axios.get(`/form-field-answer/${id}`);
    },
    update(data) {
        return axios.put(`/form-field-answer/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/form-field-answer/${id}`);
    },

}