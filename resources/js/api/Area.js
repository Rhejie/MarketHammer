import axios from "axios";

export default {
    storeArea(data) {
        return axios.post("/area/addNewArea", data);
    },
    showAreas(params) {
        return axios.get(
            `/area/getAreas?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
    },
    deleteArea(id) {
        return axios.post(`/area/deleteArea/${id}`);
    },
    updateArea(id, data) {
        return axios.post(`/area/updateArea/${id}`, data);
    }
};
