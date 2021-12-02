import axios from "axios";

export default {
    fetch(business_id) {
        return axios.get(
            `business-processes/get-business-processes/${business_id}`
        );
    },
    getProcessesData(query, postData) {
        return axios.get(
            `business-processes/get-processes-data?query=${query}&business_id=${postData}`
        );
    },
    storeBusinessProcesses(postData) {
        return axios.post(
            `business-processes/store-business-processes`,
            postData
        );
    },
    deleteProcesses(id) {
        return axios.post(`business-processes/delete-processes/${id}`);
    },
    deleteProcessesByName(postData) {
        return axios.post('business-processes/delete-processes-by-name', postData);
    }
};
