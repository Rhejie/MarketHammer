import axios from 'axios'

export default {
    store(data) {
        return axios.post(`/product-keyword`, data);
    },
    show(id) {
        return axios.get(`/product-keyword/${id}`);
    },

    update(data) {
        return axios.put(`/product-keyword/${data.id}`, data);
    },
    
    destroy(id) {
        return axios.delete(`/product-keyword/${id}`);
    },
    get(data) {
        return axios.post(`/product-keyword`, data);
    },
    getKeywordList(data) {
        return axios.post(`/product-keyword/get-product-keywords`, data)
    }

}