import axios from "axios";

export default {
    store(data) {
        return axios.post(`/product-media`, data);
    },
    show(id) {
        return axios.get(`/product-media/${id}`);
    },

    update(data) {
        return axios.put(`/product-media/${data.id}`, data);
    },

    destroy(id) {
        return axios.delete(`/product-media/${id}`);
    },
    get(data) {
        return axios.post(`/product-media`, data);
    },
};
