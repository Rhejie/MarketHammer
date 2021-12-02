import axios from 'axios'

export default {
    getEvents(timezone) {
        return axios.post(`/home/events/get-events-data`,timezone);
    },
    getEventMedias(timezone) {
        return axios.post(`/home/events/get-events-medias`, timezone);
    },
    saveSearchHistory(params) {
        return axios.post(`/home/search/save-search-history`, params);
    },
    getMostSearchedList() {
        return axios.post(`/home/search/most-searched`);
    },
    getLoggedUser(params) {
        return axios.post(`/home/user/get-logged-user`, params);
    },
    saveProfile(params) {
        return axios.post(`/home/user/save-profile`, params);
    },
    changePassword(params) {
        return axios.post(`/home/user/change-password`, params);
    },
    getCountries() {
        return axios.post(`/home/get-countries`);
    },
}