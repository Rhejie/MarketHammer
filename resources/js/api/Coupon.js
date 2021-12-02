import axios from 'axios'

export default {
	getUserCoupons(params){
		return axios.post(`/home/coupon/get-user-coupons`, params);
	},
}