import axios from "axios";

export default {
    store(data) {
        return axios.post(`/product`, data);
    },
    show(id) {
        return axios.get(`/product/${id}`);
    },

    update(data) {
        return axios.put(`/product/${data.id}`, data);
    },

    destroy(id) {
        return axios.delete(`/product/${id}`);
    },
    get(data) {
        return axios.post(`/product`, data);
    },
    productList(data) {
        return axios.post(`/product/get-product-list`, data);
    }
};
