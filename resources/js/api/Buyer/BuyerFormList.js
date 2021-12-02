import axios from "axios";

export default {
    addFormData(data) {
        return axios.post("/areas/create-form-data", data);
    },
    getFormList(params) {
        return axios.get(
            `/areas/get-form-list?page=${params.current_page}&count=${params.current_size}&search=${params.search}
            &form_type_id=${params.form_type_id}
            &form_submission_status_id=${params.form_submission_status_id}`
        );
    },
    deleteFormData(id) {
        return axios.post(`/areas/delete-form-list/${id}`);
    },
    updateFormData(id, data) {
        return axios.post(`/areas/update-form-data/${id}`, data);
    },
    getSeletcSubmissiom() {
        return axios.get("/areas/get-select-submissiom");
    },
    addFormBuildTemplate(id, submission_id) {
        return axios.post(
            `/areas/add-form-builder-template/${id}`,
            submission_id
        );
    },
    checkTemplete(id) {
        return axios.get(`/areas/check-template/${id}`);
    },
    formFieldsData() {
        return axios.get(`/areas/get-form-fields`);
    },
    formGroupsData() {
        return axios.get("/areas/get-form-gorups");
    },
    addFormGroup(data) {
        return axios.post("/areas/add-form-bulder-group", data);
    },
    addFormField(data) {
        return axios.post("/areas/add-form-builder-field", data);
    },
    sendToFavoritesSUpplier(data) {
        return axios.post("/areas/send-to-favorite-suppliers", data);
    },

    /**
     * Updates the form submission form template.
     *
     * @param postData <array> - the form structure
     * @param submissionId <int> - form submission id
     * @param loadedFromTemplate <bool> - whether to save structure fresh from form template
     *
     * @return Promise
     */
    updateFormTemplate(postData, submissionId, loadedFromTemplate = false) {
    	return axios.post(`/areas/update-form-template?submission_id=${submissionId}&loaded-from-template=${loadedFromTemplate}`, postData)
    },

    getSelectedTemplate(id) {
        return axios.get(`/areas/get-selected-template-ui/${id}`);
    },
    getGeneratedFormID() {
        return axios.get('/areas/get-form-id-generated');
    },
    getSuppliers(params) {
        return axios.get(`/areas/get-suppliers?search=${params.search}&form_submission_id=${params.form_submission_id}`);
    },
    sendFormToSupplierManually(data) {
        return axios.post('/areas/send-to-suppliers-manually', data);
    },
    getAnswerSubmissionForm(id, params) {
        return axios.get(`/areas/answer-submision-form/${id}?&search=${params.search}&filterData=${params.selected_at}`);
    },
    selectAsAnswer(id) {
        return axios.post(`/areas/select-as-answer/${id}`);
    },
    rejectAsAnswerSubmission(id) {
        return axios.post(`/areas/reject-as-answer/${id}`);
    },
    updateStatusSubmissionForm(params, id){
        return axios.post(`/areas/update-form-submission-status/${id}?&form_id=${params.form_id}`);
    },
    checkSendToSupplier(id) {
        return axios.get(`/areas/check-send-to-supplier/${id}`);
    },
    viewReponseSupplierAnswer(params) {
        return axios.get(`/areas/get-response-answer-supplier?form_submission_id=${params.form_submission_id}&supplier_id=${params.supplier_id}`);
    },
    withSourceTableValue(params) {
        return axios.get(`/areas/get-value-form-table?id=${params.id}&source_table=${params.source_table}`);
    },
    getOptionsData(params) {
        return axios.get(`/areas/get-option-form-source-table?source_table=${params.source_table}`);
    },
    exportSubmission(id) {
        return axios.get(`/areas/get-export-form-submission/${id}`);
    }
};
