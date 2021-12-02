import axios from 'axios'

export default {
	getEvents(postData) {
		return axios.post(`/event/get-events?page=${postData.page}&size=${postData.size}`, postData)
	},

	saveEvent(postData) {
		return axios.post(`/event`, postData)
	},

	updateEvent(postData, id) {
		return axios.post(`/event/${id}`, postData)
	},

	deleteEvent(id) {
		return axios.delete(`/event/${id}`)
	}
}