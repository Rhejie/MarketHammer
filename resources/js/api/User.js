import axios from "axios";

export default {
    /**
     * Load needed data for a component. This is useful in components that are loaded using Vue-router
     *
     * @param toLoad - the list of keys to determine what data to load
     *
     * @return Promise
     */
    getUsers(postData) {
        return axios.post(`/user/get-users`, postData);
    },

    /**
     * Create new user endpoint
     *
     * @param postData <object> - user form information
     *
     * @return <Promise>
     */
    createUser(postData) {
        return axios.post(`/user`, postData);
    },

    /**
     * Updates user ajax enpoint
     *
     * @param postData <object> - user form information
     *
     * @return <Promise>
     */
    updateUser(postData, id) {
        return axios.put(`/user/${id}`, postData);
    },

    /**
     * Handle delete user request
     *
     * @param id <user> id
     *
     * @return <Promise>
     */
    deleteUser(id) {
        return axios.delete(`/user/${id}`);
    },

    /**
     * Handle HTTP reuqest to set/change the user's locale
     *
     * @param locale <string> - the locale
     *
     * @return Promise
     */
    setUserLocale(locale) {
        return axios.get(`/user/set-user-locale?locale=${locale}`);
    },

    getSuppliers(query) {
        return axios.get(`/user/get-suppliers/${query}`);
    },

    checkUserType(id) {
        return axios.get(`/user/check-user-type/${id}`);
    },
    getUser(id) {
        return axios.get(`/user/get-user/${id}`);
    }
};
