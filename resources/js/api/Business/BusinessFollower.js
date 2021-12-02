import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/supplier/business-follower`, data);
    },
    show(id) {
        return axios.get(`/supplier/business-follower/${id}`);
    },
    update(data) {
        return axios.put(`/supplier/business-follower/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/supplier/business-follower/${id}`);
    },
    get(data) {
        return axios.post(`/supplier/business-follower`, data);
    },
    getList(data) {
        return axios.post(`/supplier/business-follower/get-list`, data)
    },
    follow(data){
        return axios.post(`/supplier/business-follower/follow`, data)
    },

}