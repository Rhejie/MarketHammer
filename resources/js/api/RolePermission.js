import axios from 'axios'

export default {

    save(data) {
        return axios.post(`/role-permission/save`, data);
    },
    remove(data) {
        return axios.post(`/role-permission/remove`, data);
    },
    getRolePermission(postData) {
        return axios.post(`/role-permission/get-role-permission`, postData)
    },
}