import axios from 'axios'

export default {
    storeCertificationHolder(data) {
        return axios.post(`/system-data/certification-holder`, data);
    },
    showCertificationHolders(params) {
        return axios.get(`/system-data/certification-holder?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showCertificationHolder(id) {
        return axios.get(`/system-data/certification-holder/${id}`);
    },
    updateCertificationHolder(data) {
        return axios.put(`/system-data/certification-holder/${data.id}`, data);
    },
    destroyCertificationHolder(id) {
        return axios.delete(`/system-data/certification-holder/${id}`);
    }
}