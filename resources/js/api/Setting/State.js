import axios from 'axios'

export default {
	fetch(postData) {
		return axios.post(`/state/get-state`, postData)
	},

	update(data) {
        return axios.put(`/state/${data.id}`, data);
    },
}