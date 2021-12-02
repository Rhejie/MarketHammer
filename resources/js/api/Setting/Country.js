import axios from 'axios'

export default {
	fetch(postData) {
		return axios.post(`/country/get-countries`, postData)
	},

	update(data) {
        return axios.put(`/country/${data.id}`, data);
    },
}