import axios from "axios";

export default {
    /**
     * Load needed data for a component. This is useful in components that are loaded using Vue-router
     *
     * @param toLoad - the list of keys to determine what data to load
     *
     * @return Promise
     */
    getMetaData(toLoad) {
        let postData = {
            toLoad
        };

        return axios.post(`/utils/get-meta-data`, postData);
    },

    getStates(country_id) {
        return axios.get(`/utils/get-states/${country_id}`);
    },

    getParticipantName(user_id) {
        return axios.get(`/video-call/get-participant-name/${user_id}`)
    }
};
