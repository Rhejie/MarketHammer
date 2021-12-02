import axios from "axios";
export default {
    
    fetch(params) {
		//return axios.post(`/form-type/get-form-type`, postData)
        return axios.get(
            `/form-type/get-form-type?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
	},
    
    create(postData) {
        return axios.post("form-type/store-form-type", postData);
    },

    
    update(postData, id) {
        return axios.post(`form-type/update-form-type/${id}`, postData);
    },

    
    delete(id) {
        return axios.post(`form-type/delete-form-type/${id}`);
    },

   
};
