import axios from "axios";

export default {
    fetch(id, params) {
        return axios.get(
            `/esg-list/get-esg/${id}?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
	},

    create(postData) {
        return axios.post("esg-list/store", postData);
    },

    update(postData, id) {
        return axios.post(`esg-list/update/${id}`, postData);
    },

    delete(id) {
        return axios.post(`esg-list/delete/${id}`);
    },
};
