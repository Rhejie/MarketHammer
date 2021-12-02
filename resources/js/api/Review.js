import axios from 'axios'

export default {
	saveReview(params){
		return axios.post(`/home/review/save-review`, params);
	},
}