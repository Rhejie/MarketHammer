import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/business-machine`, data);
    },
    show(id) {
        return axios.get(`/business-machine/${id}`);
    },
    update(data) {
        return axios.put(`/business-machine/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/business-machine/${id}`);
    },
    get(data) {
        return axios.post(`/business-machine`, data);
    },
    getMachines(data) {
        return axios.post(`/business-machine/get-business-machines`, data)
    }


}