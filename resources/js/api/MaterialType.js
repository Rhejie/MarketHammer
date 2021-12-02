import axios from 'axios'

export default {
    storeMaterialType(data) {
        return axios.post(`/system-data/material-type`, data);
    },
    showMaterialTypes(params) {
        return axios.get(`/system-data/material-type?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showMaterialType(id) {
        return axios.get(`/system-data/material-type/${id}`);
    },
    updateMaterialType(data) {
        return axios.put(`/system-data/material-type/${data.id}`, data);
    },
    destroyMaterialType(id) {
        return axios.delete(`/system-data/material-type/${id}`);
    },
    getMaterialTypeList(postData) {
        return axios.post(`/system-data/material-type/get-material-type-list`, postData)
    }
}