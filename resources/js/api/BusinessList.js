import axios from "axios";

export default {
    getBusinesses(params, concatParams = null) {
        let url = `/business-list?
		user_id=${params.user_id}
		&search=${params.search}
		&count=${params.count}
		&current_page=${params.current_page}
		&country_id=${params.country_id ? params.country_id : "All"}
		&category_id=${params.category_id ? params.category_id : "All"}
		&city=${params.city ? params.city : "All"}
		&industry_type_id=${
            params.industry_type_id ? params.industry_type_id : "All"
        }&registered_start=${params.registered_start}&registered_end=${
            params.registered_end
        }`;
        if (concatParams) {
            url += concatParams;
        }

        return axios.get(url);
    },

    /**
     * Retrieve list of companies. If page and size attribute is present it will fetch paginated data
     * else it will fetch all active companies
     *
     * @param postData <object> - used to filter the response data
     *
     * @return Promise
     */
    getBusinessList(postData) {
        if (postData.page && postData.size) {
            return axios.post(
                `/business-list/get-business-list?page=${postData.page}&size=${postData.size}`,
                postData
            );
        }

        return axios.post(`/business-list/get-business-list`, postData);
    },

    /**
     * Endpoint to update the specified company.
     *
     * @param postData <object> - data that will be used to update the company
     * @param id <string> - the id of the company
     *
     * @return Promise
     */
    updateBusiness(postData, id) {
        let form = new FormData();

        for (let x in postData) {
            if (!postData[x]) continue;

            if (x === "files" && postData[x].length > 0) {
                for (let file of postData[x]) {
                    file.raw ? form.append("fileList[]", file.raw) : null;
                    file.id
                        ? form.append("savedFiles[]", JSON.stringify(file))
                        : null;
                }

                continue;
            }

            form.append(x, postData[x]);
        }

        return axios.post(`/business-list/${id}`, form);
    },

    /**
     * Endpoint to delete the specified company.
     *
     * @param id <string> - the company ID to delete
     *
     * @return Promise
     */
    deleteBusiness(id) {
        return axios.delete(`/business-list/${id}`);
    },

    saveBusinessList(params) {
        return axios.post(`/business-list`, params);
    },
    saveBusinessListFromStoreDetails(params) {
        return axios.post(
            `/business-list/save-business-list-from-store-details`,
            params
        );
    },

    saveLiveStream(params) {
        return axios.post(`/live-videos`, params);
    },

    saveBusinessListFromExcel(params) {
        return axios.post(`/business-list/import-business-list`, params);
    },

    searchFilterData(searchQuery, filterType) {
        return axios.get(
            `/business-list/search-filter-data?searchQuery=${searchQuery}&filterType=${filterType}`
        );
    },

    getFormInitialData(params) {
        return axios.post(`/business-list/get-form-initial-data`, params);
    },

    getCategories(params) {
        return axios.post(`/business-list/get-categories`, params);
    },
    getReviews(params) {
        return axios.post(`/business-list/get-reviews`, params);
    },

    getBusiness(params) {
        return axios.post(`/business-list/get-business`, params);
    },
    getNearestStores(params) {
        return axios.post(`/business-list/get-nearest-stores`, params);
    },
    getFeaturedStores(params) {
        return axios.post(`/business-list/get-featured-stores`, params);
    },
    getuserSearchHistory(params) {
        return axios.post(`/business-list/get-user-search-history`, params);
    },
    getBookmarkedStores(params) {
        return axios.post(`/business-list/get-bookmarked-stores`, params);
    },
    getFeaturedBusinessList(params) {
        return axios.post(`/business-list/get-featured-business-list`, params);
    },
    saveBusinessBanners(id, data) {
        return axios.post(`/business-list/save-business-banners/${id}`, data);
    },
    markBookmark(params) {
        return axios.post(`/business-list/mark-bookmark`, params);
    },
    setBannerPrimary(params) {
        return axios.post(`/business-list/set-banner-primary`, params);
    },
    removeBanner(params) {
        return axios.post(`/business-list/remove-banner`, params);
    },
    getBusinessPlans() {
        return axios.post(`/business-list/get-plans`);
    },
    getBusinessTypes() {
        return axios.post(`/business-list/get-types`);
    },
    uploadBusinessBanner(params) {
        return axios.post(`/business-list/upload-business-banners`, params);
    },
    deleteBusinessBanner(params) {
        return axios.post(`/business-list/delete-business-banner`, params);
    },
    saveBusinessClaim(data) {
        return axios.post(`/business-list/save-business-claims`, data);
    },

    downloadCompanyImage(id) {
        return axios.get(`/business-list/downloadimage/${id}`);
    },

    importBusinessFromExcel(data) {
        return axios.post("/business-list/import-business-from-excel", data, {
            headers: { "content-type": "multipart/form-data" }
        });
    },

    importBusinessKeywordFromExcel(data) {
        return axios.post(
            "/business-list/import-business-keyword-from-excel",
            data,
            {
                headers: { "content-type": "multipart/form-data" }
            }
        );
    },

    customUploadDataExcel(data) {
        return axios.post("/business-list/customImportExcel", data, {
            headers: { "content-type": "multipart/form-data" }
        });
    },

    eidFileList(id) {
        return axios.get(`/business-list/eid-certificate-list/${id}`);
    },
    eidFileDelete(fileURL) {
        return axios.post(`/business-list/eid-attachment-delete/${fileURL}`);
    },
    checkBusinessCategories(busCat) {
        return axios.post(`/business-list/business-category/${busCat}`);
    },
    previewExcelKeyword(data) {
        return axios.post("/business-list/preview-excel-keyword", data, {
            headers: { "content-type": "multipart/form-data" }
        });
    },
    getBusinessKeywordsData() {
        return axios.get("/business-keyword/get-business-keywords");
    }
};
