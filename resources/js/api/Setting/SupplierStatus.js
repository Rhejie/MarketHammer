import axios from "axios";
export default {
    
    fetch(params) {
        return axios.get(
            `/supplier-status/get-supplier-status?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
	},

    create(postData) {
        return axios.post(`supplier-status/store-supplier-status`, postData);
    },

    update(postData, id) {
        return axios.post(`supplier-status/update-supplier-status/${id}`, postData);
    },

    delete(id) {
        return axios.post(`supplier-status/delete-supplier-status/${id}`);
    },

   
};
