import axios from "axios";

export default {
    storeMaterial(data) {
        return axios.post(`/system-data/material`, data);
    },
    showMaterials(params) {
        return axios.get(
            `/system-data/material?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
    },
    showMaterial(id) {
        return axios.get(`/system-data/material/${id}`);
    },
    updateMaterial(data) {
        return axios.put(`/system-data/material/${data.id}`, data);
    },
    destroyMaterial(id) {
        return axios.delete(`/system-data/material/${id}`);
    },
    getMaterialList(postData) {
        return axios.post(
            `/system-data/material/get-material-list`,
            postData
        );
    }
};
