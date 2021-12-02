import axios from 'axios'

export default {
    storeManufacturer(data) {
        return axios.post(`/system-data/machine-manufacturer`, data);
    },
    showManufacturers(params) {
        return axios.get(`/system-data/machine-manufacturer?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showManufacturer(id) {
        return axios.get(`/system-data/machine-manufacturer/${id}`);
    },
    updateManufacturer(data) {
        return axios.put(`/system-data/machine-manufacturer/${data.id}`, data);
    },
    destroyManufacturer(id) {
        return axios.delete(`/system-data/machine-manufacturer/${id}`);
    }
}