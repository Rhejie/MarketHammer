import axios from 'axios'

export default {
	getUsersAnnouncementsForUser(params){
		return axios.post(`/home/announcement/get-user-announcements`, params);
	},
	getAnnouncement(id){
		return axios.post(`/home/announcement/get-announcement`, id);
	},
}