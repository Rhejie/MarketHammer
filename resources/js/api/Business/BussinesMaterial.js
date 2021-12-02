import axios from "axios";

export default {
    getBusinessMaterials(id, params) {
        return axios.get(
            `/business-material/getBusinessMaterials/${id}?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
    },
    storeBusinessMaterial(data) {
        return axios.post(`/business-material/storeMaterial`, data);
    },
    getMaterials() {
        return axios.get("/business-material/getMaterials");
    },
    deleteBusinessMaterial(id) {
        return axios.post(
            `/business-material/deleteBusinessMaterial/${id}`
        );
    },
    updateBusinessMaterial(id, data) {
        return axios.post(
            `/business-material/updateBusinessMaterial/${id}`,
            data
        );
    }
};
