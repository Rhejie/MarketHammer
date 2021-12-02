import axios from "axios";

export default {
    createCategory(data) {
        return axios.post("/business-category", data);
    },

    importCategory(data) {
        return axios.post(
            "/business-category/import-category",
            data
        );
    },

    updateImportCategory(data) {
        return axios.post(
            "/business-category/update-import-category",
            data
        );
    },

    getBusinessCategories(params) {
        return axios.get(
            `/business-category/get-business-categories?page=${params.current_page}&search=${params.search}&count=${params.count}`
        );
    },

    getCategoryList(data) {
        return axios.post(
            `/business-category/get-category-list`,
            data
        );
    },

    showCategory(id) {
        return axios.get(`/business-category/${id}`);
    },

    updateCategory(id, data) {
        return axios.put(`/business-category/${id}`, data);
    },

    destroyCategory(id) {
        return axios.delete(`/business-category/${id}`);
    },

    getIndustryTypesData(searchQuery) {
        return axios.get(
            `/business-category/get-industry-types-data?searchQuery=${searchQuery}`
        );
    },

    showCategoryTranslation(id) {
        return axios.get(
            `/business-category/getCategoryTranslation/${id}`
        );
    }
};
