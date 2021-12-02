import axios from 'axios'

export default {
    searchBusiness(search) {
        return axios.get(`/my-page/global-search?search=${search}`);
    },
    storeSearchHistory(data) {
        return axios.post(`/my-page/global-search`, data);
    }
}