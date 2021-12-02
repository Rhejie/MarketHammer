import axios from 'axios'

export default {
    saveToken(data) {
        return axios.post('/save-token', data);
    }
}