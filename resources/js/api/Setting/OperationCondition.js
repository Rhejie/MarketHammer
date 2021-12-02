import axios from "axios";
export default {
    
    fetch(params) {
        return axios.get(
            `/operation-condition/get-operation-condition?page=${params.current_page}&count=${params.current_size}&search=${params.search}`
        );
	},
    
    create(postData) {
        return axios.post("operation-condition/store-operation-condition", postData);
    },

    
    update(postData, id) {
        return axios.post(`operation-condition/update-operation-condition/${id}`, postData);
    },

    
    delete(id) {
        return axios.post(`operation-condition/delete-operation-condition/${id}`);
    },

   
};
