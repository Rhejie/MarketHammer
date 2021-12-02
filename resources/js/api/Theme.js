import axios from 'axios'

export default {
    storeTheme(data) {
        return axios.post('/theme', data);
    },
    showThemes(params) {
        return axios.get(`/theme?page=${params.current_page}&count=${params.current_size}&search=${params.search}`);
    },
    showTheme(id) {
        return axios.get(`/theme/${id}`);
    },
    updateTheme(data) {
        return axios.put(`/theme/${data.id}`, data);
    },
    destroyTheme(id) {
        return axios.delete(`/theme/${id}`);
    }
}