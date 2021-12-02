import axios from 'axios'

export default {
    storeType(data) {
        return axios.post(`/system-data/machine-type`, data);
    },
    showTypes(params) {
        return axios.get(`/system-data/machine-type?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showType(id) {
        return axios.get(`/system-data/machine-type/${id}`);
    },
    updateType(data) {
        return axios.put(`/system-data/machine-type/${data.id}`, data);
    },
    destroyType(id) {
        return axios.delete(`/system-data/machine-type/${id}`);
    }
}
