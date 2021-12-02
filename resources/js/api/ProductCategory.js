import axios from 'axios'

export default {
    /**
     * Create a POST HTTP request to save new product category data
     *
     * @param postData <object>
     *
     * @return Promise
     */
    store(postData) {
        return axios.post(`/setting/product-category`, postData);
    },

    /**
     * API endpoint for updating specific product category information
     *
     * @param postData <object>
     *
     * @return Promise
     */
    update(postData) {
        return axios.put(`/setting/product-category/${postData.id}`, postData);
    },

    /**
     * API endpoint for deleting specific product category
     *
     * @param id <string>
     *
     * @return Promise
     */
    delete(id) {
        return axios.delete(`/setting/product-category/${id}`);
    },

    showProductCategorys(params) {
        return axios.get(`/setting/product-category?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },

    showProductCategory(id) {
        return axios.get(`/setting/product-category/${id}`);
    },

    getCategoryList(data) {
        return axios.post(`/setting/product-category/get-category-list`, data);
    }
}