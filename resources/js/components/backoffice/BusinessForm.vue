<template>
    <div class="business-form" v-loading="pageLoading">
        <div class="container mt-3">
            <el-form
                :model="businessForm"
                :rules="rulesForm"
                label-position="top"
                ref="businessForm"
                class="demo-ruleForm"
            >
                <el-row :gutter="20">
                    <el-col :span="8">
                        <el-form-item
                            :label="__('Industry Type')"
                            prop="industry_type_id"
                        >
                            <el-select
                                v-model="businessForm.industry_type_id"
                                filterable
                                :placeholder="__('Select')"
                                class="full-width"
                                @change="changeType"
                            >
                                <el-option
                                    v-for="item in pageData.industryTypes"
                                    :key="item.id"
                                    :label="
                                        __dt(
                                            item.translations,
                                            'name',
                                            item.name
                                        )
                                    "
                                    :value="item.id"
                                >
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item
                            :label="__('Business Category')"
                            prop="business_category_id">
                            <el-select
                                v-model="businessForm.business_category_id"
                                filterable
                                v-loading="busCatLoading"
                                :placeholder="__('Select')"
                                class="full-width">
                                <el-option
                                    v-for="item in categoryList"
                                    :key="item.id"
                                    :label="__dt(item.translations,'name',item.name)"
                                    :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item :label="__('Business Code')" prop="bus_code">
                            <el-input
                                :disabled="true"
                                ref="bus_code"
                                :placeholder="__('Enter Business Code')"
                                v-model="business_cat_code"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>

                        <el-form-item
                            :label="__('Legal Name')"
                            prop="legal_name"
                        >
                            <el-input
                                ref="legal_name"
                                :placeholder="__('Enter Legal Name')"
                                v-model="businessForm.legal_name"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>

                        <el-form-item :label="__('DBA')" prop="dba">
                            <el-input
                                ref="dba"
                                v-model="businessForm.dba"
                                :placeholder="__('Enter DBA')"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>

                        <el-form-item
                            :label="__('English Name')"
                            prop="english_name"
                        >
                            <el-input
                                ref="english_name"
                                :placeholder="__('Enter English Name')"
                                v-model="businessForm.english_name"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="8">

                        <el-form-item
                            :label="__('Date of Establishment')"
                            prop="date_established"
                        >
                            <el-date-picker
                                v-model="businessForm.date_established"
                                type="date"
                                placeholder="Pick a day"
                                format="yyyy-MM-dd"
                                value-format="yyyy-MM-dd"
                                class="full-width"
                            >
                            </el-date-picker>
                        </el-form-item>

                        <el-form-item
                            :label="__('Company Status')"
                            prop="status"
                        >
                            <el-select
                                v-model="businessForm.status"
                                :placeholder="__('Select')"
                                class="full-width"
                            >
                                <el-option
                                    v-for="item in companyStatus"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.value"
                                >
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item :label="__('Website')" prop="website">
                            <el-input
                                ref="website"
                                v-model="businessForm.website"
                                :placeholder="__('Enter Website')"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>
                        <el-form-item :label="__('Email')" prop="email">
                            <el-input
                                ref="email"
                                :placeholder="__('Enter Email')"
                                v-model="businessForm.email"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>
                        <el-form-item :label="__('Phone')" prop="phone">
                            <el-input
                                ref="phone"
                                v-model="businessForm.phone"
                                :placeholder="__('Enter Phone')"
                                class="full-width"
                                @keypress.native="isNumber($event)"
                            >
                            </el-input>
                        </el-form-item>
                        <el-form-item :label="__('Fax')" prop="fax">
                            <el-input
                                ref="fax"
                                v-model="businessForm.fax"
                                :placeholder="__('Enter Fax')"
                                class="full-width"
                                @keypress.native="isNumber($event)"
                            >
                            </el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="8">

                        <el-form-item :label="__('EID')" prop="eid">
                            <el-input
                                ref="eid"
                                v-model="businessForm.eid"
                                :placeholder="__('Enter EID')"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>
                        <el-form-item :label="__('Corp SSN')" prop="corp_ssn">
                            <el-input
                                ref="corp_ssn"
                                :placeholder="__('Enter Corp SSN')"
                                v-model="businessForm.corp_ssn"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>
                        <el-form-item :label="__('About Us')" prop="about_us">
                            <el-input
                                ref="about_us"
                                :placeholder="__('Enter About Us')"
                                v-model="businessForm.about_us"
                                class="full-width"
                            >
                            </el-input>
                        </el-form-item>


                        <el-form-item
                            :label="__('No. of Employees')"
                            prop="employee_count_id"
                        >
                            <el-select
                                v-model="businessForm.employee_count_id"
                                :placeholder="__('Select')"
                                class="full-width"
                            >
                                <el-option
                                    v-for="item in pageData.employeeCounts"
                                    :key="item.id"
                                    :label="
                                        __dt(
                                            item.translations,
                                            'name',
                                            item.name
                                        )
                                    "
                                    :value="item.id"
                                >
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item
                            :label="__('R&D Staff')"
                            prop="rnd_staff_count_id"
                        >
                            <el-select
                                v-model="businessForm.rnd_staff_count_id"
                                :placeholder="__('Select')"
                                class="full-width"
                            >
                                <el-option
                                    v-for="item in pageData.employeeCounts"
                                    :key="item.id"
                                    :label="
                                        __dt(
                                            item.translations,
                                            'name',
                                            item.name
                                        )
                                    "
                                    :value="item.id"
                                >
                                </el-option>
                            </el-select>
                        </el-form-item>

                    </el-col>
                    <!-- <template v-if = "showMore">
                        <el-col :span = "24" class = "business-address">
                            <el-form-item :label="'Address'" prop="street">
                                <el-row :gutter = "20">
                                    <el-col :span = "8">
                                        <el-input v-model="businessForm.street" placeholder = "Street" class="full-width"></el-input>
                                    </el-col>
                                    <el-col :span = "8">
                                        <el-input v-model="businessForm.city" placeholder = "City" class="full-width"></el-input>
                                    </el-col>
                                    <el-col :span = "8">
                                        <el-input v-model="businessForm.state" placeholder = "State" class="full-width"></el-input>
                                    </el-col>
                                    <el-col :span = "8">
                                        <el-input v-model="businessForm.zip" placeholder = "Zip Code" class="full-width"></el-input>
                                    </el-col>
                                    <el-col :span = "8">
                                        <el-select v-model="businessForm.countryID"
                                            filterable
                                            placeholder = "Country"
                                            class="full-width">
                                            <el-option
                                              v-for="item in countryList"
                                              :key="item.id"
                                              :label="item.name"
                                              :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </el-col>
                                    <el-col :span = "8">
                                        <el-input v-model="businessForm.buildingNo" placeholder = "Building #" class="full-width"></el-input>
                                    </el-col>
                                    <el-col :span = "8">
                                        <el-input v-model="businessForm.unitNo" placeholder = "Unit #" class="full-width"></el-input>
                                    </el-col>
                                </el-row>
                                <el-row :gutter = "20">
                                    <el-col :span = "4" class="view-map-col">
                                        <span @click = "dialogMap = true" class = "ml-2 underline pointer"> View Map </span>
                                    </el-col>
                                    <el-col :span = "10" class="address-coordinates-input">
                                        <el-input v-model="businessForm.latitude" placeholder = "Latitude" class="full-width" disabled ></el-input>
                                    </el-col>
                                    <el-col :span = "10" class="address-coordinates-input">
                                        <el-input v-model="businessForm.longitude" placeholder = "Longitude" class="full-width" disabled ></el-input>
                                    </el-col>
                                </el-row>
                            </el-form-item>
                        </el-col>

                        <el-col :span = "24" class = "operation-hours">
                            <div class = "">
                                <label>{{ ('Business Hours') }}</label>
                                <span class="ml-3">
                                    <i  @click="addOperationHour()" class="el-icon-circle-plus"></i>
                                </span>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in businessOpHours">
                                            <td>
                                                <el-select v-model="item.day"
                                                    placeholder="Select"
                                                    class="full-width"
                                                    >
                                                    <el-option
                                                        v-for="dd in dayList"
                                                        :key="dd"
                                                        :label="dd"
                                                        :value="dd">
                                                    </el-option>
                                                </el-select>
                                            </td>
                                            <td>
                                                <el-time-select
                                                    v-model="item.from"
                                                    :picker-options="{
                                                        start: '00:00',
                                                        step: '00:30',
                                                        end: '23:30'
                                                    }"
                                                    placeholder="Select time">
                                                </el-time-select>
                                            </td>
                                            <td>
                                                <el-time-select
                                                    v-model="item.to"
                                                    :picker-options="{
                                                        start: '00:00',
                                                        step: '00:30',
                                                        end: '23:30'
                                                    }"
                                                    placeholder="Select time">
                                                </el-time-select>
                                            </td>
                                            <td class = "action">
                                                <span>
                                                    <i  @click="removeOperationHour(item)" class="el-icon-error"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </el-col>
                    </template> -->
                </el-row>
                <el-row :gutter="20" class="mt-4">
                    <el-col :span="24">
                        <!--  <div class="text-left">
                            <span @click = "showMore = showMore ? false : true" class = "ml-2 underline pointer"> {{ showMore ? "Show Less" : "Show More"}} </span>
                        </div> -->
                        <div class="text-right">
                            <button
                                type="button"
                                class="btn btn-default"
                                @click="cancelForm"
                            >
                                {{ __("Cancel") }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary btn-black"
                                @click="saveForm"
                            >
                                {{ hasModel ? __('Save') : __('Save') }}
                            </button>
                        </div>
                    </el-col>
                </el-row>
            </el-form>
        </div>
        <el-dialog
            :title="__('View Map')"
            :visible.sync="dialogMap"
            class="view-map-dialog"
            width="70%"
            top="40px"
            append-to-body
        >
            <google-map :page-data="googleData"> </google-map>
        </el-dialog>
    </div>
</template>

<script>
window.noty = require("noty");
// import Noty from "noty";

import _forEach from "lodash/forEach";
import cloneDeep from "lodash/cloneDeep";
import __message from "../../mixins/messageAlert.js";

export default {
    props: {
        businessData: {
            required: false
        },
        pageData: {}
    },
    data() {
        let businessForm = {
            legal_name: null,
            dba: null,
            english_name: null,
            industry_type_id: null,
            business_category_id: null,
            status: "private",
            email: null,
            phone: null,
            fax: null,
            about_us: null,
            corp_ssn: null,
            website: null,
            eid: null,
            eid_certificate: null,
            //date_established: this.$df.formatDate(new Date(), "YYYY-MM-DD"),
            date_established: null,
            rnd_staff_count_id: null,
            employee_count_id: null
        };

        let gData = {
            markers: [],
            height: "500px",
            mapClickable: true,
            showAction: true
        };

        return {
            businessForm: businessForm,
            rulesForm: {},
            businessOpHours: [],
            categoryList: [],
            countryList: [],
            industryList: [],
            employeeCountList: [],
            userCluster: {},
            dayList: [],
            pageLoading: false,
            busCatLoading: false,
            formError: { businessName: ["This is sample error"] },
            googleData: gData,
            dialogMap: false,
            showMore: false,
            companyStatus: [
                { value: "public", name: this.__("Public") },
                { value: "private", name: this.__("Private") }
            ],
            complexType: [],
            complexLocation: []
        };
    },
    mixins: [__message],
    created() {
        console.log(this.model)
        this.firstLoadData()

        this.rulesForm = {
            businessName: [
                {
                    required: true,
                    message: this.__("The business name field is required."),
                    trigger: "blur"
                }
            ],
            industry_type_id: [
                {
                    required: true,
                    message: this.__("Please select industry."),
                    trigger: "change"
                }
            ],
            business_category_id: [
                {
                    required: true,
                    message: this.__("Please select category."),
                    trigger: "change"
                }
            ],
            legal_name: [
                {
                    required: true,
                    message: this.__("The legal name field is required."),
                    trigger: "change"
                }
            ]
        };

        this.$EventDispatcher.listen("GOOGLEMAP_PROCEED", data => {
            this.businessForm.latitude = data.lat;
            this.businessForm.longitude = data.lng;
            this.dialogMap = false;
        });
    },
    mounted() {
        console.log("Component mounted.");
        /*this.getComplexTypes();
        this.getComplexLocations();*/
    },
    computed: {
        business_cat_code() {
            let code = null;
            let findCat = this.categoryList.find(
                fn => fn.id == this.businessForm.business_category_id
            );
            if (findCat) {
                code = findCat.ko_stat_code;
            }
            return code;
        },
        hasModel() {
            return this.businessData && this.businessData.id ? true : false
        }
    },
    methods: {
        setData(data) {
            this.googleData.markers = [];
            if (data && data.id) {
                if (data.business_address) {
                    let addr = data.business_address;
                    let lat = addr.latitude ? addr.latitude : 0;
                    let long = addr.longitude ? addr.longitude : 0;
                    let pos = {
                        position: { lat: lat, lng: long },
                        draggable: false,
                        clickable: false,
                        icon: "/image/map_pin.png"
                    };

                    this.googleData.markers.push(pos);

                    this.businessForm.street = addr.street;
                    this.businessForm.city = addr.city;
                    this.businessForm.state = addr.state;
                    this.businessForm.zip = addr.zip;
                    this.businessForm.countryID = addr.countryID;
                    this.businessForm.latitude = addr.latitude;
                    this.businessForm.longitude = addr.longitude;
                    this.businessForm.buildingNo = addr.buildingNo;
                    this.businessForm.unitNo = addr.unitNo;
                }

                _forEach(data, (fm, fmInd) => {
                    if (fmInd != "categories") {
                        this.businessForm[fmInd] = fm;
                    }
                });

                if (data.categories) {
                    let mapCategory = data.categories.map(item => {
                        return item.id;
                    });
                    this.businessForm.categories = mapCategory;
                }

                if (data.business_operations) {
                    this.businessOpHours = data.business_operations;
                }
                console.log("date_established", this.businessForm.date_established, data)

                if(this.businessForm.date_established){
                    this.businessForm.date_established = this.$df.formatDate(this.businessForm.date_established, "YYYY-MM-DD")
                }

            }
        },
        async firstLoadData(){
            await this.getInitialData();
            //await this.getCategory(null);
            this.dayList = await this.$df.getDays();
            await this.addOperationHour();

            await this.setData(this.businessData);
        },
        async getInitialData() {
            // this.pageLoading = true;
            let params = {
                type: ["industry", "country", "employee_count"]
            };

            await this.$API.BusinessList.getFormInitialData(params)
            .then(result => {
                let res = result.data;
                this.industryList = res.industryList;
                this.countryList = res.countries;
                this.employeeCountList = res.employeeCountList;
            })
            .catch(err => {
                console.log("Error!", err);
            })
            .finally(_ => {
                this.pageLoading = false;
            });

            if (this.businessData && this.businessData.id) {
                await this.getCategory(this.businessData.industry_type_id);
            }
        },
        addOperationHour() {
            let ind = this.businessOpHours.length + 1;
            let arr = {
                day: "Sunday",
                from: null,
                to: null,
                index: "d" + ind
            };

            this.businessOpHours.push(arr);
        },
        removeOperationHour(item) {
            let fndindex = this.businessOpHours.findIndex(pd => {
                return pd.index == item.index;
            });
            if (fndindex >= 0) {
                this.businessOpHours.splice(fndindex, 1);
            }
        },
        changeType() {
            this.getCategory(this.businessForm.industry_type_id);
        },
        async getCategory(industry_type_id) {
            // this.pageLoading = true;
            this.busCatLoading = true;
            this.businessForm.business_category_id = null;

            let params = {
                filterData: {
                    industry_type_id: industry_type_id
                }
            };
            await this.$API.BusinessList.getCategories(params)
            .then(result => {
                let res = result.data;
                this.categoryList = res.filterData;

                if (this.businessData && this.businessData.categories) {
                    let mapCategory = this.businessData.categories.map(
                        item => {
                            return item.id;
                        }
                    );
                    this.businessForm.business_category_id = mapCategory;
                }
            })
            .catch(err => {
                console.log("Error!", err);
            })
            .finally(_ => {
                this.busCatLoading = false;
            });
        },
        cancelForm() {
            this.$EventDispatcher.fire("CLOSE_BUSINESSFORM");
        },
        saveForm() {
            this.$refs.businessForm.validate(valid => {
                if (valid) {
                    this.pageLoading = true;
                    let bForm = cloneDeep(this.businessForm);
                    bForm.operationHours = this.businessOpHours;
                    bForm.joinDate = this.$df.formatDate(
                        bForm.joinDate,
                        "YYYY-MM-DD"
                    );

                    this.$API.BusinessList.saveBusinessList(bForm)
                        .then(result => {
                            let res = result.data;

                            if (!res.success) {
                                if (res.data) {
                                    this.alertMessage(res.data);
                                    this.$notify({
                                        title: 'Success',
                                        message: this.__(res.data),
                                        type: 'success'
                                        });
                                } else {
                                    this.showMessage(
                                        "error",
                                        this.$msg.notif.failed_add
                                    );
                                }
                            } else {
                                this.$EventDispatcher.fire(
                                    "BUSINESSDATA_GET",
                                    res.data
                                );
                                console.log('================add new company====================');
                                console.log(res.data);
                                console.log('====================================');
                                this.$EventDispatcher.fire(
                                    "CLOSE_BUSINESSFORM"
                                );
                                if(res.is_updated) {

                                    this.$notify({
                                        title: 'Success',
                                        message: this.$msg.notif.success_update,
                                        type: 'success'
                                        });
                                }
                                else {
                                    this.$notify({
                                        title: 'Success',
                                        message: this.$msg.notif.success_add,
                                        type: 'success'
                                        });
                                }
                                this.resetFields();
                            }
                        })
                        .catch(err => {
                            console.log("Error!", err);
                        })
                        .finally(_ => {
                            this.pageLoading = false;
                        });
                } else {
                    console.log("Test");
                }
            });
        },
        resetFields() {
            this.$refs.businessForm.resetFields();
            /*  this.businessForm.clusterName = this.userCluster ? this.userCluster.name : null
            this.businessForm.clusterID = this.userCluster ? this.userCluster.id : null
            this.businessForm.categories = []
            this.businessOpHours = []
            this.addOperationHour() */

            /* if (this.businessData == null) { // add business
                this.businessForm.street = null
                this.businessForm.city = null
                this.businessForm.state = null
                this.businessForm.zip = null
                this.businessForm.latitude = null
                this.businessForm.longitude = null
                this.businessForm.buildingNo = null
                this.businessForm.unitNo = null
                this.businessForm.countryID = this.userCluster.country_id ? this.userCluster.country_id : null
            } */
        },
        alertMessage(errs) {
            _forEach(errs, err => {
                this.showMessage("error", err[0]);
            });
        },
        isNumber(evt) {
            evt = evt ? evt : window.event;
            var charCode = evt.which ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
        getComplexTypes() {
            this.$API.ComplexType.getComplexTypes().then(res => {
                console.log(" complex type data = " + res.data);
                this.complexType = res.data;
            });
        },
        getComplexLocations() {
            this.$API.ComplexLocation.getComplexLocations().then(res => {
                console.log(" complex location data = " + res.data);
                this.complexLocation = res.data;
            });
        }
    },
    watch: {
        businessData(newVal) {
            this.setData(newVal);
            if (newVal == null) {
                this.resetFields();
            }
        }
    }
};
</script>

<style lang="scss">
.business-form {
    table {
        td,
        th {
            padding: 5px 10px;
        }
    }

    .operation-hours i {
        cursor: pointer;
        font-size: 20px;
    }
}
</style>
