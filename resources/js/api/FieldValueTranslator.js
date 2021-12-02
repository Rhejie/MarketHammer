import axios from "axios";

export default {
    storeTranslator(data) {
        return axios.post(`/field-value-translator`, data);
    },
    showTranslator(id) {
        return axios.get(`/field-value-translator/${id}`);
    },
    updateTranslator(data) {
        return axios.put(`/field-value-translator/${data.id}`, data);
    },
    destroyTranslator(id) {
        return axios.delete(`/field-value-translator/${id}`);
    },
    showTranslatorData(table) {
        return axios.get(
            `/field-value-translator/showTrans/${table}`
        );
    }
};
