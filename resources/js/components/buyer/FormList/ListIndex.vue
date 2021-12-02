<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions"  v-if="viewData != 'details'">
                    <div class="header-title" v-if="viewData != 'details'">
                        <h5>{{ __("Request for Quotation List") }}</h5>
                    </div>
                    <div class="search-container" v-if="viewData != 'details'">
                         <el-input
                            suffix-icon="fas fa-search"
                            class="search-box round-input"
                            v-model="search"
                            ref="searchInput"
                            type="text"
                            @keyup.enter.native="applyFilter"
                            clearable
                            :placeholder="__('Type to search')">
                        </el-input>
                    </div>
                    <div class="secondary-action-buttons">
                            <el-select
                                    v-model="viewData"
                                    style="width: 120px; margin-right:20px"
                                    class="round-input"
                                    placeholder="Select"
                                >
                                    <el-option
                                        v-for="item in view"
                                        :key="item"
                                        :label="__(item)"
                                        :value="item"
                                    >
                                    </el-option>
                            </el-select>
                                <!--<el-button>
                                    <i class="fas fa-filter"></i>
                                </el-button> -->
                            <el-popover
                                    placement="bottom"
                                    width="450"
                                    trigger="click"
                                >
                                    <div class="form_list_filter">
                                        <el-form
                                            :model="filterData"
                                            :rules="rulesFilter"
                                            ref="addNewForm"
                                            class="demo-ruleForm"
                                        >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <el-form-item
                                                        :label="__('Form Type')"
                                                        prop="form_type_id"
                                                    >
                                                        <el-select
                                                            class="full-width"
                                                            filterable
                                                            v-model="
                                                                filterData.form_type_id
                                                            "
                                                            :placeholder="
                                                                __('Select form type')
                                                            "
                                                        >
                                                            <el-option value="All"
                                                                >All</el-option
                                                            >
                                                            <el-option
                                                                v-for="item in pagedata.form_types"
                                                                :key="item.id"
                                                                :label="item.name"
                                                                :value="item.id"
                                                            >
                                                            </el-option>
                                                        </el-select>
                                                    </el-form-item>
                                                </div>
                                                <div class="col-md-12">
                                                    <el-form-item
                                                        :label="__('Form Status')"
                                                        prop="form_submission_status_id"
                                                    >
                                                        <el-select
                                                            class="full-width"
                                                            filterable
                                                            v-model="
                                                                filterData.form_submission_status_id
                                                            "
                                                            :placeholder="
                                                                __('Select form status')
                                                            "
                                                        >
                                                            <el-option value="All"
                                                                >All</el-option
                                                            >
                                                            <el-option
                                                                v-for="item in pagedata.form_status"
                                                                :key="item.id"
                                                                :label="item.name"
                                                                :value="item.id"
                                                            >
                                                            </el-option>
                                                        </el-select>
                                                    </el-form-item>
                                                </div>
                                                <div class="col-md-12">
                                                    <div
                                                        class="filter_footer_button"
                                                        style="float:right"
                                                    >
                                                        <button
                                                            type="button"
                                                            class="btn btn-default"
                                                            @click="ResetFilterButton"
                                                        >
                                                            {{ __("Reset") }}
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-primary btn-black"
                                                            @click="filterButton"
                                                        >
                                                            {{ __("Filter") }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </el-form>
                                    </div>
                                    <el-button
                                    class="mh-btn"
                                    slot="reference"
                                        ><i class="fas fa-filter"></i
                                    ></el-button>
                                </el-popover>
                    </div>
                    <div class="add-new-button">
                        <el-button
                            round
                            icon="el-icon-plus"
                            @click="addNew"
                            class="btn btn-black">
                            {{ __("Add New Form") }}
                        </el-button>
                    </div>
                </div>

                    <div class="content-div">
                        <!-- grid view -->
                        <form-grid-list
                            v-if="viewData === 'Grid View'"
                            :formList="formList"
                            :tableLoading="tableLoading"
                            @formListDetailsData="formListDetailData"
                        >
                        </form-grid-list>

                        <!-- list view -->
                        <form-list-view
                            v-else-if="viewData === 'List View'"
                            :formList="formList"
                            :tableLoading="tableLoading"
                            @deleteFormList="deleteFormListData"
                            @editFormList="editFormList"
                            @formListDetailsData="formListDetailData"
                        >
                        </form-list-view>

                        <!-- details -->
                        <form-details-view
                            v-else-if="viewData === 'details'"
                            :form-groups="pagedata.form_field_groups"
                            :pageData="pagedata"
                            :detailsData="detailsData"
                            :pastView="pastView"
                            @clickReturn="clickReturn"
                            @updateFormStatus="updateFormStatus"
                            @reloadList="reloadList"
                        >
                        </form-details-view>

                        <div class="text-right mb-3" v-if="viewData != 'details'">
                            <global-pagination
                                :current_page="current_page"
                                :current_size="current_size"
                                :pagination="formListPagination"
                                :total="filters.total"
                                @handleSizeChange="handleSizeChange"
                                @handleCurrentChange="handleCurrentChange"
                            >
                            </global-pagination>
                        </div>
                    </div>

                    <!-- form -->

                    <el-dialog
                        :title="mode == 'create' ? __('Add New Form') : __('Update Form')"
                        :visible.sync="dialogVisible"
                        width="600px"
                    >
                        <el-form
                            :model="formData"
                            :rules="rules"
                            ref="addNewForm"
                            class="demo-ruleForm"
                        >
                            <div class="row">
                                <div class="col-md-12">
                                    <el-form-item :label="__('Form ID')" prop="form_id">
                                        <el-input
                                            :disabled="true"
                                            v-model="formData.form_id"
                                            class="full-width"
                                            :placeholder="__('Form ID')"
                                        ></el-input>
                                    </el-form-item>
                                </div>
                                <div class="col-md-12">
                                    <el-form-item
                                        :label="__('Form Type')"
                                        prop="form_type_id"
                                    >
                                        <el-select
                                            class="full-width"
                                            filterable
                                            v-model="formData.form_type_id"
                                            :placeholder="__('Select form type')"
                                        >
                                            <el-option
                                                v-for="item in pagedata.form_types"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item.id"
                                            >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <el-form-item
                                                :label="__('Reference ID')"
                                                prop="refrence_id"
                                            >
                                                <template slot="label">
                                                    {{ __("Reference ID") }}
                                                    <el-tooltip
                                                        effect="dark"
                                                        :content="
                                                            __(
                                                                'If you create sequencial forms, please assign same ref ID on each creation'
                                                            )
                                                        "
                                                        placement="right"
                                                    >
                                                        <i class="fas fa-info-circle"></i>
                                                    </el-tooltip>
                                                </template>
                                                <!--  <el-tooltip style="margin-left:5px; font-size: 14px" effect="dark" :content="__('If you create sequencial forms, Please assign same ref ID on each creation')" placement="right">
                                                <i class="fas fa-info-circle"></i>
                                            </el-tooltip> -->
                                                <el-input
                                                    v-model="formData.refrence_id"
                                                    class="full-width"
                                                    :placeholder="__('Reference ID')"
                                                ></el-input>
                                            </el-form-item>
                                        </div>
                                        <!--div class="col-sm-1 form_tooltip">
                                        <div class="form_info_tooltip">

                                        </div>
                                    </-div -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <el-form-item
                                        :label="__('Form Title')"
                                        prop="form_title"
                                    >
                                        <el-input
                                            v-model="formData.form_title"
                                            class="full-width"
                                            :placeholder="__('Title')"
                                        ></el-input>

                                        <value-translator-btn
                                            @showTranslationForm="
                                                setTranslationForm(
                                                    'form_title',
                                                    formData.form_title,
                                                    'text'
                                                )
                                            "
                                        >
                                        </value-translator-btn>
                                    </el-form-item>
                                </div>
                                <div class="col-md-12">
                                    <el-form-item
                                        :label="__('Expiration Date')"
                                        prop="expiration_date"
                                    >
                                        <el-date-picker
                                            v-model="formData.expiration_date"
                                            type="date"
                                            class="full-width"
                                            :placeholder="__('Expiration Date')"
                                        >
                                        </el-date-picker>
                                    </el-form-item>
                                </div>
                                <div class="col-md-12">
                                    <el-form-item
                                        :label="__('Form Status')"
                                        prop="form_submission_status_id"
                                    >
                                        <el-select
                                            class="full-width"
                                            filterable
                                            v-model="formData.form_submission_status_id"
                                            :placeholder="__('Select form status')"
                                            :disabled="subsmissionSelect"
                                        >
                                            <el-option
                                                v-for="item in pagedata.form_status"
                                                :key="item.id"
                                                :label="__(item.name)"
                                                :value="item.id"
                                            >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </div>
                                <div class="col-md-12">
                                    <el-form-item
                                        :label="__('Instruction')"
                                        prop="instruction"
                                    >
                                        <el-input
                                            v-model="formData.instruction"
                                            class="full-width"
                                            type="textarea"
                                            :placeholder="__('Instruction')"
                                        ></el-input>

                                        <value-translator-btn
                                            @showTranslationForm="
                                                setTranslationForm(
                                                    'instruction',
                                                    formData.instruction,
                                                    'textarea'
                                                )
                                            "
                                        >
                                        </value-translator-btn>
                                    </el-form-item>
                                </div>
                            </div>
                            <el-form-item>
                                <div style="float: right">
                                    <button
                                        type="button"
                                        class="btn btn-default"
                                        @click="dialog"
                                    >
                                        {{ __("Cancel") }}
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-black"
                                        @click="submitForm"
                                    >
                                        {{ mode == "create" ? __("Save") : __("Save") }}
                                    </button>
                                </div>
                            </el-form-item>
                        </el-form>
                    </el-dialog>

                    <value-translator-form
                        ref="translationForm"
                        :translation-form="translationModel"
                        v-if="showTranslationForm"
                        :visible.sync="showTranslationForm"
                        @close="handleCloseTranslation"
                        @settranslationdata="setTranslationData"
                    >
                    </value-translator-form>
            </div>
        </div>
    </div>
</template>
<script>
import pagination from "../../../mixins/pagination";
import translationForm from "../../../mixins/translationForm.js";
import cloneDeep from "lodash/cloneDeep";
export default {
    name: "ListIndex",
    props: {
        pagedata: {
            type: Object,
            required: true
        }
    },
    mixins: [pagination, translationForm],
    data() {
        return {
            dialogVisible: false,
            mode: "create",
            formData: {
                form_id: null,
                form_type_id: null,
                refrence_id: null,
                form_title: null,
                expiration_date: null,
                form_submission_status_id: null,
                instruction: null,
                buyer_id: this.$userData.activeUserId
            },
            filterData: {
                form_type_id: "All",
                form_submission_status_id: "All"
            },
            rulesFilter: {
                form_type_id: [
                    {
                        required: true,
                        message: this.__("Please input Type"),
                        trigger: "blur"
                    }
                ],
                form_submission_status_id: [
                    {
                        required: true,
                        message: this.__("Please select status"),
                        trigger: "blur"
                    }
                ]
            },
            pastView: "List View",
            tableLoading: false,
            formListPagination: [],
            selectIDSubmission: null,
            subsmissionSelect: true,
            editFormData: [],
            formList: [],
            view: ["List View", "Grid View"],
            viewData: "List View",
            rules: {
                form_id: [
                    {
                        required: true,
                        message: this.__("Please input form id"),
                        trigger: "blur"
                    }
                ],
                form_type_id: [
                    {
                        required: true,
                        message: this.__("Please input Type"),
                        trigger: "blur"
                    }
                ],
                refrence_id: [
                    {
                        required: true,
                        message: this.__("Please input reference id"),
                        trigger: "blur"
                    }
                ],
                form_title: [
                    {
                        required: true,
                        message: this.__("Please input title"),
                        trigger: "blur"
                    }
                ],
                expiration_date: [
                    {
                        required: true,
                        message: this.__("Please input expiration date"),
                        trigger: "blur"
                    }
                ],
                form_submission_status_id: [
                    {
                        required: true,
                        message: this.__("Please select status"),
                        trigger: "blur"
                    }
                ]
            },
            search: "",
            current_page: 1,
            current_size: 25,
            disabledButton: false,
            detailsData: [],
            formDataID: null,
            dateData: new Date(),
            todayDate: new Date()
        };
    },
    created() {
        this.formFields = ["form_title", "instruction"];
        this.fromTable = "form_submissions";

        this.getFormList();
        this.getSelectOpen();
        this.getGeneratedFormIDData();
    },
    mounted(){
        this.$refs.searchInput.$el.getElementsByTagName('input')[0].focus();
    },
    watch: {
        search(newSearch, oldSearch) {
            if (newSearch != oldSearch) {
                this.getFormList();
                return;
            }
        }
    },
    methods: {
        initialize() {
            this.formData = {
                form_id: null,
                form_type_id: null,
                refrence_id: null,
                form_title: null,
                instruction: null,
                expiration_date: this.$df.formatDate(
                    this.todayDate.setDate(this.dateData.getDate() + 30),
                    "YYYY-MM-DD"
                ),
                form_submission_status_id: this.selectIDSubmission,
                buyer_id: this.$userData.activeUserId
            };

            this.subsmissionSelect = true;
        },

        getGeneratedFormIDData() {
            this.$API.BuyerFormList.getGeneratedFormID().then(res => {
                this.formDataID = res.data;
                this.formData.form_id = this.formDataID;
            });
        },
        addNew() {
            this.mode = "create";
            this.dialogVisible = true;
            this.disabledButton = false;
            this.initialize();
            this.getGeneratedFormIDData();
        },
        applyFilter() {
            this.getFormList();
        },
        getFormList() {
            this.tableLoading = true;
            let params = {
                current_size: this.current_size,
                current_page: this.current_page,
                search: this.search,
                form_type_id: this.filterData.form_type_id,
                form_submission_status_id: this.filterData
                    .form_submission_status_id
            };
            this.$API.BuyerFormList.getFormList(params).then(res => {
                this.formList = res.data.data;
                this.formListPagination = res.data;
                this.tableLoading = false;
            });
        },
        submitForm() {
            this.$refs["addNewForm"].validate(valid => {
                if (valid) {
                    if (this.mode == "create") {
                        this.create();
                    } else {
                        this.update();
                    }
                }
            });
        },
        create() {
            let postData = cloneDeep(this.formData);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.BuyerFormList.addFormData(postData).then(res => {
                this.formList.unshift(res.data);
                this.filters.total++;
                this.resetFields();
                this.dialogVisible = false;
                this.$notify({
                    title: "Successful",
                    message: this.$msg.notif.success_add,
                    type: "success"
                });
            });
        },
        dialog() {
            this.dialogVisible = false;
            this.resetFields();
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.getFormList();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.getFormList();
        },
        formListDetailData(data) {
            this.pastView = this.viewData;
            this.viewData = "details";
            this.detailsData = data;
        },
        deleteFormListData(id, index) {
            this.askToDelete(id, index);
        },
        askToDelete(id, index) {
            this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("Delete"),
                cancelButtonText: this.__("Cancel"),
                type: "warning",
                confirmButtonClass: 'el-button--danger'
            })
                .then(() => {
                    this.delete(id, index);
                })
                .catch(() => {});
        },
        delete(id, index) {
            this.$API.BuyerFormList.deleteFormData(id).then(res => {
                this.formList.splice(index, 1);
                this.$notify({
                    title: this.__("Successful"),
                    message: this.$msg.notif.success_delete,
                    type: "success"
                });
            });
        },
        editFormList(data) {
            this.editFormData = { ...data };
            this.mode = "edit";
            this.formData = { ...data };
            this.disabledButton = true;
            this.dialogVisible = true;
            this.subsmissionSelect = false;
        },
        update() {
            let postData = cloneDeep(this.formData);
            this.setCurrrentLangDefaultValue(postData);

            this.$API.BuyerFormList.updateFormData(
                postData.id,
                postData
            ).then(res => {
                this.$notify({
                    title: this.__("Successful"),
                    message: this.$msg.notif.success_update,
                    type: "success"
                });
                let data = res.data;
                this.formList.map(form => {
                    if (form.id == data.id) {
                        for (let key in data) {
                            form[key] = data[key];
                        }
                    }
                });
                this.dialogVisible = false;
                this.resetFields();
                this.subsmissionSelect = true;
            });
        },
        resetFields() {
            this.$refs["addNewForm"].resetFields();
            this.formData.form_id = null;
            this.formData.form_type_id = null;
            this.formData.refrence_id = null;
            this.formData.form_title = null;
            this.formData.form_submission_status_id = null;
            this.formData.expiration_date = this.$df.formatDate(
                this.todayDate.setDate(this.dateData.getDate() + 30),
                "YYYY-MM-DD"
            );
            this.formData.buyer_id = this.$userData.activeUserId;
        },
        clickReturn(data) {
            this.viewData = data;
        },

        getSelectOpen() {
            this.$API.BuyerFormList.getSeletcSubmissiom().then(res => {
                this.selectIDSubmission = res.data.id;
            });
        },
        reloadList(is_reload) {
            if (is_reload) {
                this.getFormList();
            }
        },
        filterButton() {
            this.getFormList();
        },
        ResetFilterButton() {
            this.filterData.form_type_id = "All";
            this.filterData.form_submission_status_id = "All";
            this.getFormList();
        },
        updateFormStatus() {
            this.getFormList();
        }
    }
};
</script>

<style lang="scss">
.form-list-header {
    padding: 10px;
    font-size: 22px;
    display: flex;
    h3 {
        margin-top: 10px;
    }
}
.content-div {
    margin-top: 10px;
}
.buttonAdd {
    padding: 10px;
    .buttonRequest {
        float: right;
        margin-top: 10px;
    }
}
.header-form-list {
    margin-bottom: 20px;
}

.form-list-data {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    .list-data {
        margin-right: 20px;
        margin-bottom: 20px;
    }
}
.form_tooltip {
    padding: 0;
}
.form_info_tooltip {
    font-size: 40px;

    .item {
        margin-left: auto;
        margin-right: auto;
    }
}
.form_list_filter {
    padding: 10px;
}
</style>
