import axios from 'axios'

export default {
    getLiveVideos(data) {
        return axios.post(`/live-videos/list`, data);
    },
    getAllLiveVideos(data) {
        return axios.post(`/live-videos/all`,);
    },
    deleteLiveVideo(data) {
        return axios.post(`/live-videos/delete`, data);
    }
}