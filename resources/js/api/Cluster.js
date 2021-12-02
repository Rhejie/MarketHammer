import axios from 'axios'

export default {
    getThemesData(searchQuery) {
        return axios.get(`/cluster/get-themes-data?searchQuery=${searchQuery}`);
    },
    getCategoriesData(params) {
        return axios.post(`/cluster/get-categories-data?searchQuery`, params);
    },
    getAllCategoriesData(params) {
        return axios.post(`/cluster/get-all-categories-data`, params);
    },
    getCategoriesDataById(id) {
        return axios.get(`/cluster/get-categories-data-by-id?id=${id}`);
    },
    getOnlyCheckedCategories(id) {
        return axios.get(`/cluster/get-checked-categories-data?id=${id}`);
    },
    getCountriesData(searchQuery) {
        return axios.get(`/cluster/get-countries-data?searchQuery=${searchQuery}`);
    },
    storeCluster(data) {
        return axios.post('/cluster', data);
    },
    showClusters(params) {
        return axios.get(`/cluster?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showCluster(id) {
        return axios.get(`/cluster/${id}`);
    },
    updateCluster(id, data) {
        return axios.put(`/cluster/${id}`, data);
    },
    destroyCluster(id) {
        return axios.delete(`/cluster/${id}`);
    }
}