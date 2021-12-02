import axios from 'axios'

export default {
    storeEmployeeCount(data) {
        return axios.post(`/system-data/employee-count`, data);
    },
    showEmployeeCounts(params) {
        return axios.get(`/system-data/employee-count?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showEmployeeCount(id) {
        return axios.get(`/system-data/employee-count/${id}`);
    },
    updateEmployeeCount(data) {
        return axios.put(`/system-data/employee-count/${data.id}`, data);
    },
    destroyEmployeeCount(id) {
        return axios.delete(`/system-data/employee-count/${id}`);
    }
}
