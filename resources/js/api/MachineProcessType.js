import axios from 'axios'

export default {
    storeProcessType(data) {
        return axios.post(`/system-data/machine-process-type`, data);
    },
    showProcessTypes(params) {
        return axios.get(`/system-data/machine-process-type?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showProcessType(id) {
        return axios.get(`/system-data/machine-process-type/${id}`);
    },
    updateProcessType(data) {
        return axios.put(`/system-data/machine-process-type/${data.id}`, data);
    },
    destroyProcessType(id) {
        return axios.delete(`/system-data/machine-process-type/${id}`);
    }
}