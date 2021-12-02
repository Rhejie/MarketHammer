import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/supplier/user-follower`, data);
    },
    show(id) {
        return axios.get(`/supplier/user-follower/${id}`);
    },
    update(data) {
        return axios.put(`/supplier/user-follower/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/supplier/user-follower/${id}`);
    },
    get(data) {
        return axios.post(`/supplier/user-follower`, data);
    },
    getList(data) {
        return axios.post(`/supplier/user-follower/get-list`, data)
    },
    follow(data){
        return axios.post(`/supplier/user-follower/follow`, data)
    },

}