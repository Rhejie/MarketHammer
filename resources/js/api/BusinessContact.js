import axios from 'axios'

export default {
    storeBusinessContact(data) {
        return axios.post(`/business-contact`, data);
    },
    showBusinessContact(id) {
        return axios.get(`/business-contact/${id}`);
    },
    updateBusinessContact(data) {
        return axios.put(`/business-contact/${data.id}`, data);
    },
    destroyBusinessContact(id) {
        return axios.delete(`/business-contact/${id}`);
    },
    getBusinessContactList(params) {
        //return axios.post(`/business-contact/get-contact-list`, data);
        let query = `page=${params.current_page}&count=${params.current_size}&search=${params.search}`;
        if(params.business_id){
           query += `&business_id=${params.business_id}` 
        }
        return axios.post(`/business-contact/get-contact-list?${query}`);
    },
    /**
     * Export business contacts 
     *
     * @return Promise
     */
    exportContacts(postData) {
        return axios({
            method: 'post',
            url: `/business-contact/export-contacts`,
            responseType: 'blob',
            data: postData
        })
    },
}