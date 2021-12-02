import axios from 'axios'

export default {
    saveBusinessType(data) {
        return axios.post(`/business-type`, data);
    },
    showBusinessTypes(params) {
        return axios.get(`/business-type?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showBusinessType(id) {
        return axios.get(`/business-type/${id}`);
    },
    updateBusinessType(data) {
        return axios.put(`/business-type/${data.id}`, data);
    },
    deleteBusinessType(id) {
        return axios.post(`/business-type/delete`, id);
    },
    destroyBusinessType(id) {
        return axios.delete(`/business-type/${id}`);
    }
}