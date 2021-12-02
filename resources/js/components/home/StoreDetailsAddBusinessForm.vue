<template>
    <div>
        <el-dialog
              title="Add Business"
              :visible.sync="formDialogVisible"
              width="80%"
              top = "20px"
              :close-on-click-modal="close"
              :close-on-press-escape="close"
              v-loading="pageLoading"
              class="add-business-dialog">

            <el-radio-group v-model="cxType">
              <el-radio-button label="worker">I work at the business</el-radio-button>
              <el-radio-button label="customer">I am a customer</el-radio-button>
            </el-radio-group>

            <el-tabs type="card" @tab-click="handleTabClick" class="cluster-card" v-model="activeTab">
                <el-tab-pane label="General Info" name="generalInfo">
                    <div class="container mt-3">
                        <el-form :model="businessForm" :rules="rulesForm" label-position = "top" ref="businessForm" class="demo-ruleForm">
                            <div class="row">
                                <div class="col-12">
                                    <el-form-item :label="'Business Name'" prop="businessName">
                                        <el-input ref="businessName" v-model="businessForm.businessName" class="full-width" ></el-input>
                                    </el-form-item>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <el-image
                                          style="width: 80px; height: 80px;float: left"
                                          :src="businessLogo"
                                          fit="fill">
                                        </el-image>
                                        <el-upload
                                          ref="upload"
                                          v-loading="importLoading"
                                          :show-file-list="false"
                                          :on-change="handleChange"
                                          action="https://jsonplaceholder.typicode.com/posts/"
                                          :auto-upload="false">
                                          <el-button slot="trigger" size="small" type="primary">Browse Photo</el-button>
                                        </el-upload>
                                    </div>
                                </div>  
                                <div class="col-12">
                                    <el-form-item :label="'About Business'" prop="description">
                                        <el-input ref="description" v-model="businessForm.description" type="textarea" class="full-width" ></el-input>
                                    </el-form-item>
                                </div>
                            </div>
                        </el-form>
                    </div>
                </el-tab-pane>

                <el-tab-pane label="Contact Info" name="contactInfo">
                    <div class="container mt-3">
                        <el-form :model="businessForm" :rules="rulesForm" label-position = "top" ref="businessForm" class="demo-ruleForm">
                            <el-row :gutter = "20">
                                <el-col :span = "12">
                                    <el-form-item :label="'Email Address'" prop="email">
                                        <el-input ref="email" v-model="businessForm.email" class="full-width" ></el-input>
                                    </el-form-item>

                                    <el-form-item :label="'Phone Number'" prop="phone">
                                        <el-input ref="phone" v-model="businessForm.phone" class="full-width" ></el-input>
                                    </el-form-item>

                                    <el-form-item :label="'Mobile Number'" prop="mobile">
                                        <el-input ref="mobile" v-model="businessForm.mobile" class="full-width" ></el-input>
                                    </el-form-item>

                                </el-col>

                                <el-col :span = "12">

                                    <el-form-item :label="'Contact Person'" prop="contactPerson">
                                        <el-input ref="contactPerson" v-model="businessForm.contactPerson" class="full-width"></el-input>
                                    </el-form-item>

                                    <el-form-item :label="'Contact Person\'s Position '" prop="contactPersonPosition">
                                        <el-input ref="contactPersonPosition" v-model="businessForm.contactPersonPosition" class="full-width"></el-input>
                                    </el-form-item>

                                </el-col>
                            </el-row>
                        </el-form>
                    </div>
                </el-tab-pane>

                <el-tab-pane label="Address Info" name="addressInfo">
                    <div class="container mt-3">
                        <el-form :model="businessForm" :rules="rulesForm" label-position = "top" ref="businessForm" class="demo-ruleForm">
                            <el-row :gutter = "20">
                                <el-col :span = "12">
                                    <el-form-item :label="'Street Address'" prop="street">
                                        <el-input v-model="businessForm.street" placeholder = "Street" class="full-width" ></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "7" style="padding-right:0px !important;">
                                    <el-form-item :label="'City'" prop="city">
                                        <el-input v-model="businessForm.city" placeholder = "City" class="full-width" style="padding: 5px 0px !important"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "5" style="padding-left:0px !important;">
                                    <el-form-item :label="'State'" prop="state">
                                        <el-input v-model="businessForm.state" placeholder = "State" class="full-width" style="padding: 5px 0px !important"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "12">
                                    <el-form-item :label="'Address 2'" prop="address2">
                                        <el-input v-model="businessForm.address2" placeholder = "Address 2" class="full-width" ></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "12">
                                    <el-form-item :label="'Postal Code'" prop="zip">
                                        <el-input v-model="businessForm.zip" placeholder = "Postal Code" class="full-width"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "5">
                                    <el-form-item :label="'Building #'" prop="buildingNo">
                                        <el-input v-model="businessForm.buildingNo" placeholder = "Building #" class="full-width"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "5" :offset="2">
                                    <el-form-item :label="'Unit #'" prop="unitNo">
                                        <el-input v-model="businessForm.unitNo" placeholder = "Unit #" class="full-width"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "12">
                                    <el-form-item :label="'Country'" prop="countryID">
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
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "12">
                                    <el-form-item :label="'Latitude'" prop="latitude">
                                        <el-input v-model="businessForm.latitude" placeholder = "Latitude" class="full-width" disabled ></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span = "12">
                                    <el-form-item :label="'Longitude'" prop="longitude">
                                        <el-input v-model="businessForm.longitude" placeholder = "Longitude" class="full-width" disabled ></el-input>
                                    </el-form-item>
                                </el-col>
                            </el-row>

                            <el-row :gutter = "20">
                                <el-col :span = "24">
                                    <span @click = "dialogMap = true" class = "ml-2 underline pointer pull-right"> View Map </span>
                                </el-col>
                            </el-row>

                            <el-row :gutter = "20" class="mg-t-10">
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
                                                <tr v-for="(item, index) in businessOpHours">
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
                                                                step: '00:15',
                                                                end: '23:45'
                                                            }"
                                                            placeholder="Select time">
                                                        </el-time-select>
                                                    </td>
                                                    <td>
                                                        <el-time-select
                                                            v-model="item.to"
                                                            :picker-options="{
                                                                start: '00:00',
                                                                step: '00:15',
                                                                end: '23:45'
                                                            }"
                                                            placeholder="Select time">
                                                        </el-time-select>
                                                    </td>
                                                    <td class = "action">
                                                        <span>
                                                            <i  @click="removeOperationHour(item)" class="el-icon-error"></i>
                                                        </span>
                                                    </td>
                                                    <td class = "action" v-if="index == 0">
                                                        <span>
                                                            <i @click="copyOperationHour(item)" class="el-icon-copy-document"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </el-col>
                            </el-row>

                        </el-form>
                    </div>
                </el-tab-pane>

                    <el-tab-pane label="Categories" name="categories">
                        <label> Products / Services Categories </label>      
                        <div class="search-container">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <span>Check the categories applicable</span>
                                    </div>
                                    <div class="col-sm-3 pull-right">
                                        <el-checkbox v-model="showCheckedOnly" @change="handleShowCheckOnly">Show chekced only</el-checkbox>
                                    </div>
                                    <div class="col-sm-4">
                                        <el-input
                                            size="mini"
                                            class="pull-right"
                                            placeholder="Type to search"
                                            v-model="filterCategoryQuery">
                                            <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                        </el-input>
                                    </div>
                                </div>
                                
                            </div>           
                            <el-tree
                              class="filter-tree"
                              :data="filteredCategories"
                              :props="defaultProps"
                              default-expand-all
                              :default-checked-keys="selectedCategoryIds"
                              show-checkbox
                              :check-strictly="strict"
                              node-key="id"
                              :filter-node-method="filterNode"
                              v-loading="categoryLoading"
                              @check="handleCategoryChange"
                              ref="tree">
                            </el-tree>
                    </el-tab-pane>

                    <el-tab-pane label="Identification" name="identification" :disabled="cxType == 'customer'">
                        <div class="container mt-3">
                            <div>
                                <label style="float:left;margin-top: 10px;">Business</label>
                                <el-upload
                                  ref="upload"
                                  v-loading="fileImportLoading"
                                  :on-change="handleChangeFile"
                                  action="https://jsonplaceholder.typicode.com/posts/"
                                  :auto-upload="false">
                                  <el-button slot="trigger" size="small" type="primary">Browse Files</el-button>
                                </el-upload><br>
                                <span>Securities & Exchange Commission, Mayor's/ DTI / Business Permit / Barangay Clearance / Permit</span>
                            </div><br>
                            <div>
                                <label style="float:left;margin-top: 10px;">Valid ID</label>
                                <el-upload
                                  ref="upload"
                                  v-loading="idImportLoading"
                                  :on-change="handleChangeId"
                                  action="https://jsonplaceholder.typicode.com/posts/"
                                  :auto-upload="false">
                                  <el-button slot="trigger" size="small" type="primary">Browse Files</el-button>
                                </el-upload><br>
                                <span>Voter's ID, PRC ID, SSS, UMID, GSIS, Postal ID, Driver's Liscence, Passport ID, OFW ID, Government Office ID</span>
                            </div>
                        </div>
                    </el-tab-pane>

            </el-tabs>

            <el-row :gutter = "20" class = "mt-4">
                <el-col :span = "24">
                    <div class="text-right">
                        <el-button class="btn-text" 
                            @click="cancelForm" >
                            {{ 'Cancel' }}
                        </el-button>
                        <el-button type="primary" class="btn-red btn-save" 
                            @click="saveForm" >
                            {{ 'Save' }}
                        </el-button>
                    </div>
                </el-col>
            </el-row>
        </el-dialog>
        <el-dialog
              title="View Map"
              :visible.sync="dialogMap"
              class="view-map-dialog"
              width="70%"
              top = "40px"
              append-to-body>
                <google-map
                    :page-data = "googleData">
                </google-map>
        </el-dialog>
    </div>
</template>
<script>
window.noty = require('noty')
import Noty from 'noty'

import _forEach from 'lodash/forEach'
import cloneDeep from 'lodash/cloneDeep'
import __message from '../../mixins/messageAlert.js'
import Compressor from 'compressorjs';

export default {
    props: {
        business : {
            required: false
        },
        // uploadImageRoute : {
        //     required: false
        // },
        // uploadVideoRoute : {
        //     required: false
        // }
    },
    data() {
        let businessForm = {
            businessLogo: '/image/image-placeholder.png',
            businessName : null, 
            description : null, 
            businessAlias : null, 
            industryTypeID : null, 
            clusterName : null, 
            clusterID : null,  
            active : false, 
            businessTypeCode : null, 
            webAddress : null, 
            kakaoChannelUrl : null, 
            blogSite : null, 
            businessLicense : null, 
            joinDate : new Date(), 
            latitude : null, 
            longitude : null, 
            buildingNo:null, 
            unitNo:null,
            street : null, 
            address2 : null, 
            city : null, 
            zip : null, 
            state : null, 
            countryID : null,
            directionDetails : null,
            planTypeID : 0, 
            planName : null,
            freeParking : false,
            withParking : false,
            email : null,
            phone : null,
            mobile : null,
            contactPerson : null,
            contactPersonPosition : null,
            accountID : null,
            password : null,
            confirmPassword : null,
            firstName : null,
            lastName : null,
            tags: []
        }

        let gData = {markers : [], height : '500px', mapClickable : true, showAction : true}

        return {
businessLogo: '/image/image-placeholder.png',
            cxType: 'worker',
            uploadImageRoute: '',
            uploadVideoRoute: '',
            importVideoLoading: false,
            importLoading: false,
            close: false,
            businessData: this.business,
            selectedBusinessID: null,
            fileList: [],
            businessFileList: [],
            idList: [],
            videoList: [],
            tagsLists: [],
            selectedCategoryIds: [],
            defaultProps: {
              children: 'children',
              label: 'name'
            },
            strict: true,
            showCheckedOnly: false,
            showHeader: false,
            categoryLoading: false,
            filterCategoryQuery: '',
            categoriesData  : [],
            modalLoading : false,
            formDialogVisible: false,
            activeTab       : 'generalInfo',
            businessForm    : businessForm,
            rulesForm       : {},
            businessPlans   : [],
            businessOpHours : [],
            categoryList    : [],
            countryList     : [],
            industryList    : [],
            userCluster     : {},
            dayList         : [],
            pageLoading     : false,
            formError       : {businessName : ["This is sample error"]},
            googleData      : gData,
            dialogMap       : false,
            showMore        : false,
            mode            : 'Add'
        }
    },
    mixins: [__message],
    created(){
        this.getInitialData()
        this.getCategory(null, null)
        this.dayList = this.$df.getDays()
        // this.addOperationHour()
        this.setDefaultOperationHour()
        this.getBusinessPlans()

        this.rulesForm = {
            businessName: [
                { required: true, message: 'The business name field is required.', trigger: 'blur' },
            ],
            industryTypeID: [
                { required: true, message: 'Please select industry.', trigger: 'change' },
            ],
            categories: [
                { required: true, message: 'Please select cateories.', trigger: 'change' },
            ],
            clusterName: [
                { required: true, message: 'The cluster field is required.', trigger: 'change' },
            ],
            joinDate: [
                { required: true, message: 'The join date field is required.', trigger: 'change' },
            ]

        }
        //this.setOperationHours()

        this.$EventDispatcher.listen('GOOGLEMAP_PROCEED', data => {
            this.businessForm.latitude = data.lat
            this.businessForm.longitude = data.lng
            this.dialogMap = false
        })
        
        this.$EventDispatcher.listen('SHOW_ADD_BUSINESS_DIALOG', () => {
            this.resetFields();
            this.mode = 'Add';
            this.getTreeCategoryData();
            this.formDialogVisible = true;
        })

        // this.$EventDispatcher.listen('SHOW_EDIT_BUSINESS_DIALOG', (business) => {
        //     this.mode = 'Edit';
        //     this.businessData = business;
        //     this.setData(this.businessData)
        //     this.getTreeCategoryData();
        //     this.formDialogVisible = true;
        // })
    },
    mounted() {
        console.log('Component mounted.')
        // this.setData(this.businessData)
    },
    methods: {
        handleChange(file)
        {
          var self = this;
          self.importLoading = true;
          // console.log(file, file.__ob__.value.raw)
          var mime_type = file.raw.type;
          console.log(mime_type)
          if (mime_type == "image/png" || mime_type == "image/jpeg" || mime_type == "image/jpg") {
            new Compressor(file.__ob__.value.raw, {
                  quality: 0.3,
                  beforeDraw(context, canvas){
                    self.importLoading = true;
                  },
                  success(result) {
                    const formData = new FormData();
                    // console.log(self.fileList, 'res', result)
                    formData.append('file', result, result.name);

                    // Send the compressed image file to server with XMLHttpRequest.
                    axios.post('/business-list/upload-business-banners', formData).then((res) => {
                      console.log('Upload success', res);
                      self.businessLogo = '/storage'+res.data.imageFile.filePath
                      self.importLoading = false;
                      self.fileList.push({
                        name: result.name,
                        uid: file.uid,
                        size: result.size,
                        type: file.type,
                        fileContents: result,
                        show: false,
                        filePath: res.data.imageFile.filePath,
                        show:  true,
                        caption: null
                      });
                    });
                  },
                  error(err) {
                    self.importLoading = false;
                    self.$message.warning(`Error uploading image.`);
                    console.log(err.message);
                  },
            });
          } else {
            this.$message.warning(`Please select valid file type.`);
          }
          

        },
        handleChangeFile(file)
        {
          var self = this;
          self.fileImportLoading = true;
          // console.log(file, file.__ob__.value.raw)
          var mime_type = file.raw.type;
          // console.log(mime_type, file)
          if (mime_type == "image/png" || mime_type == "image/jpeg" || mime_type == "image/jpg") {
            new Compressor(file.__ob__.value.raw, {
                  quality: 0.3,
                  beforeDraw(context, canvas){
                    self.fileImportLoading = true;
                  },
                  success(result) {
                    const formData = new FormData();
                    // console.log(self.fileList, 'res', result)
                    formData.append('file', result, result.name);

                    // Send the compressed image file to server with XMLHttpRequest.
                    axios.post('/business-list/upload-business-files', formData).then((res) => {
                      console.log('Upload success', res);
                      // self.businessLogo = '/storage'+res.data.imageFile.filePath
                      self.fileImportLoading = false;
                      self.businessFileList.push({
                        name: result.name,
                        uid: file.uid,
                        size: result.size,
                        type: file.type,
                        fileContents: result,
                        show: false,
                        filePath: res.data.file.filePath,
                        show:  true,
                        caption: null
                      });
                    });
                  },
                  error(err) {
                    self.fileImportLoading = false;
                    self.$message.warning(`Error uploading image.`);
                    console.log(err.message);
                  },
            });
          } else {
            const formData = new FormData();
            // console.log(self.fileList, 'res', result)
            formData.append('file', file.raw, file.name);

            axios.post('/business-list/upload-business-files', formData).then((res) => {
              console.log('Upload success', res);
              // self.businessLogo = '/storage'+res.data.file.filePath
              self.fileImportLoading = false;
              self.businessFileList.push({
                name: file.name,
                uid: file.uid,
                size: file.size,
                type: file.type,
                fileContents: file,
                show: false,
                filePath: res.data.file.filePath,
                show:  true,
                caption: null
              });
            }); 
          }
        },
        handleChangeId(file)
        {
          var self = this;
          self.idImportLoading = true;
          // console.log(file, file.__ob__.value.raw)
          var mime_type = file.raw.type;
          console.log(mime_type)
          if (mime_type == "image/png" || mime_type == "image/jpeg" || mime_type == "image/jpg") {
            new Compressor(file.__ob__.value.raw, {
                  quality: 0.3,
                  beforeDraw(context, canvas){
                    self.idImportLoading = true;
                  },
                  success(result) {
                    const formData = new FormData();
                    // console.log(self.fileList, 'res', result)
                    formData.append('file', result, result.name);

                    // Send the compressed image file to server with XMLHttpRequest.
                    axios.post('/business-list/upload-business-files', formData).then((res) => {
                      console.log('Upload success', res);
                      // self.businessLogo = '/storage'+res.data.imageFile.filePath
                      self.idImportLoading = false;
                      self.idList.push({
                        name: result.name,
                        uid: file.uid,
                        size: result.size,
                        type: file.type,
                        fileContents: result,
                        show: false,
                        filePath: res.data.file.filePath,
                        show:  true,
                        caption: null
                      });
                    });
                  },
                  error(err) {
                    self.idImportLoading = false;
                    self.$message.warning(`Error uploading image.`);
                    console.log(err.message);
                  },
            });
          } else {
            self.$message.warning(`Please select valid file type.`);
            return false;
          }
        },
        handleShowCheckOnly() {
            console.log(this.showCheckedOnly)
        },
        handleCategoryChange(check, node){
            this.selectedCategoryIds = node.checkedKeys
            // console.log(check)
            // console.log(node)
        },
        cancelForm(){
            this.resetFields();
            this.formDialogVisible = false;
        },
        handleTabClick(value) {
            // console.log('val', value)
            if (value.name == 'categories') {
                this.getTreeCategoryData()
            }
        },
        getTreeCategoryData() {
            this.categoryLoading = true;
            let params = {
                searchQuery: this.filterCategoryQuery
            }
            this.$API.Cluster.getAllCategoriesData(params).then(res => {
                this.categoriesData = res.data.categories;
                this.categoryLoading = false;
            });
        },
        handleFreeParking(value) {
            if (value == true) {
                this.businessForm.withParking = false;
            }
        },
        handleWithParking(value) {
            if (value == true) {
                this.businessForm.freeParking = false;
            }
        },
        setData(data){
            this.googleData.markers = []
            if(data && data.id){

                if(data.business_address){

                    let addr = data.business_address
                    let lat = addr.latitude ?  addr.latitude : 0
                    let long = addr.longitude ?  addr.longitude : 0
                    let pos = { position: {lat: lat, lng: long}, 
                        draggable : false,
                        clickable : false,
                        icon : "/image/map_pin.png"}

                    this.googleData.markers.push(pos)

                    this.businessForm.unitNo = addr.unitNo
                    this.businessForm.buildingNo = addr.buildingNo
                    this.businessForm.street = addr.street
                    this.businessForm.address2 = addr.address2
                    this.businessForm.city = addr.city
                    this.businessForm.state = addr.state    
                    this.businessForm.zip = addr.zip  
                    this.businessForm.countryID = addr.countryID
                    this.businessForm.latitude = addr.latitude
                    this.businessForm.longitude = addr.longitude
                    this.businessForm.directionDetails = addr.directionDetails
                }

                _forEach(data, (fm, fmInd) =>{
                    if(fmInd != 'categories' && fmInd != 'is_active' && fmInd != 'planID' && fmInd != 'kakaoUrl' && fmInd != 'owner'){
                        this.businessForm[fmInd] = fm 
                    }
                })

                this.businessForm.active = data.is_active && data.is_active > 0 ? true : false;

                if(data.planID){
                    this.businessForm.planTypeID = data.planID;
                }

                if(data.kakaoUrl){
                    this.businessForm.kakaoChannelUrl = data.kakaoUrl;
                }

                if(data.categories){
                    this.categoriesData = data.categories;
                    let ids = data.categories.map((item) => item.id);
                    this.selectedCategoryIds = ids;
                }

                if(data.owner){
                    this.businessForm.accountID = data.owner.id;
                    this.businessForm.firstName = data.owner.firstName;
                    this.businessForm.lastName = data.owner.lastName;
                }
                if(data.tags){
                    this.businessForm.tags = data.tags;
                    let tags = data.tags.map((item) => item.tag);
                    this.tagsLists = tags;
                }
                // if(data.categories){
                //     let mapCategory = data.categories.map((item) => {
                //         return item.id;
                //     })
                //     this.businessForm.categories = mapCategory
                // }

                if(data.business_operations){
                    this.businessOpHours = data.business_operations
                }
                
            }

        },
        async getInitialData(){
            this.pageLoading = true
            let params = {
                type : ['industry', 'country']
            }

            await this.$API.BusinessList.getFormInitialData(params)
            .then(result => {
                console.log('result', result)
                let res = result.data
                this.industryList = res.industryList
                this.countryList = res.countries
                this.userCluster = res.userCluster

                if (res.userCluster) {
                    this.businessForm.clusterName = res.userCluster.name ? res.userCluster.name : null
                    this.businessForm.clusterID = res.userCluster.id ? res.userCluster.id : null
                    this.businessForm.countryID = res.userCluster.country_id ? res.userCluster.country_id : null
                } else {
                    this.businessForm.clusterName = null
                    this.businessForm.clusterID = null
                    this.businessForm.countryID = null
                }
                
            })
            .catch(err => {
                console.log('Error!', err)
            })
            .finally(_ => {
                this.pageLoading = false
            })

            if(this.businessData && this.businessData.id){
                 this.getCategory(this.businessData.industryTypeID, this.businessData.clusterID)
            }
        },
        addOperationHour(){
            if (this.businessOpHours.length < 7) {
                let ind = this.businessOpHours.length + 1
                let arr = {
                    day : "Sunday",
                    from : null,
                    to : null,
                    index : 'd'+ind
                }

                this.businessOpHours.push(arr)
            }
            
        },
        setDefaultOperationHour(){
                // let ind = this.businessOpHours.length + 1
                let arr = [
                    {
                        day : "Sunday",
                        from : null,
                        to : null,
                        index : 'd1'
                    },
                    {
                        day : "Monday",
                        from : null,
                        to : null,
                        index : 'd2'
                    },
                    {
                        day : "Tuesday",
                        from : null,
                        to : null,
                        index : 'd3'
                    },
                    {
                        day : "Wednesday",
                        from : null,
                        to : null,
                        index : 'd4'
                    },
                    {
                        day : "Thursday",
                        from : null,
                        to : null,
                        index : 'd5'
                    },
                    {
                        day : "Friday",
                        from : null,
                        to : null,
                        index : 'd6'
                    },
                    {
                        day : "Saturday",
                        from : null,
                        to : null,
                        index : 'd7'
                    },
                ];
                this.businessOpHours = arr
                // console.log('ae', this.businessOpHours, arr)
                // this.businessOpHours.push(arr)
            
        },
        removeOperationHour(item){
            console.log('removeOperationHour', item)
            let fndindex = this.businessOpHours.findIndex(pd => { return pd.index == item.index})
            console.log('fndindex', fndindex)
            if(fndindex >= 0){
                this.businessOpHours.splice(fndindex, 1)
            }
        },
        copyOperationHour(item){
            // console.log('copyOperationHour', item)
            this.businessOpHours.map(function(x) { 
              x.from = item.from; 
              x.to = item.to; 
            });
            
        },
        changeType(){
            this.getCategory(this.businessForm.industryTypeID, this.businessForm.clusterID)
        },
        getCategory(industryTypeID, clusterID){
            this.pageLoading = true
            this.businessForm.categories = []

            let params = {
                filterData : {
                    //industryTypeID : industryTypeID
                }
            }
            this.$API.BusinessList.getCategories(params)
            .then(result => {
                console.log('result', result)
                let res = result.data
                this.categoryList = res.filterData

                if(this.businessData.categories){
                    let mapCategory = this.businessData.categories.map((item) => {
                        return item.id;
                    })
                    this.businessForm.categories = mapCategory
                }

            })
            .catch(err => {
                console.log('Error!', err)
            })
            .finally(_ => {
                this.pageLoading = false
            })
        },
        getBusinessPlans() {
            this.$API.BusinessList.getBusinessPlans()
            .then(result => {
                this.businessPlans = result.data.plans
                // console.log(result)
            })
            .catch(err => {
                console.log('Error!', err)
            })
            .finally(_ => {

            })
        },
        saveForm(){
            // console.log(selectedCategories);
            this.$refs.businessForm.validate((valid) => {
                // console.log('valid', valid)
                if (valid) {
                    this.pageLoading = true
                    let selectedCategories = this.mode == 'Add' ? this.$refs.tree.getCheckedKeys() : this.selectedCategoryIds;
                    this.businessForm.categories = selectedCategories;
                    this.businessForm.tags = this.tagsLists;
                    this.businessForm["banners"] = this.fileList;
                    this.businessForm["files"] = this.businessFileList;
                    this.businessForm["ids"] = this.idList;
                    let bForm = cloneDeep(this.businessForm)
                    // console.log(bForm)
                    bForm.operationHours = this.businessOpHours
                    bForm.joinDate = this.$df.formatDate(bForm.joinDate, "YYYY-MM-DD")


                    this.$API.BusinessList.saveBusinessListFromStoreDetails(bForm)
                    .then(result => {
                        let res = result.data

                        if(!res.success){
                            if(res.data){
                                this.alertMessage(res.data)
                                this.pageLoading = true
                            }
                            else{
                                this.showMessage("success", "Business not successfully added. Please try again or contact administrator");
                                this.pageLoading = true
                            }
                        }
                        else{
                            this.pageLoading = true
                            this.formDialogVisible = false;
                            // this.$EventDispatcher.fire('BUSINESSDATA_GET')
                            // this.$emit('businessSaved');
                            // if (this.mode == 'Add') {
                                this.showMessage("success", "Business successfully added.")
                            // } else {
                            //     this.showMessage("success", "Business successfully updated.")
                            // }
                            
                            this.selectedBusinessID = res.data.id;
                            this.resetFields()
                            // if (this.fileList.length > 0) {
                            //     this.uploadImages('image');
                            // }
                            // if (this.videoList.length > 0) {
                            //     this.uploadImages('video');
                            // }
                            
                        }

                        console.log('result', result)
                    })
                    .catch(err => {
                        console.log('Error!', err)
                    })
                    .finally(_ => {
                        this.pageLoading = false
                    })
                }
                else{
                    console.log('Test')
                }
            })
        },
        resetFields(){
            if (this.mode == 'Edit') {
                this.$refs.businessForm.resetFields();
            }
            this.businessForm.clusterName = this.userCluster ? this.userCluster.name : null
            this.businessForm.clusterID = this.userCluster ? this.userCluster.id : null
            this.businessForm.categories = []
            this.businessForm.tags = []
            // this.businessOpHours = []

            let businessFormReset = {
                businessName : null, 
                businessAlias : null, 
                industryTypeID : null, 
                clusterName : this.userCluster ? this.userCluster.name : null, 
                clusterID : this.userCluster ? this.userCluster.id : null,  
                active : false, 
                businessTypeCode : null, 
                webAddress : null, 
                kakaoChannelUrl : null, 
                blogSite : null, 
                businessLicense : null, 
                joinDate : new Date(), 
                latitude : null, 
                longitude : null, 
                buildingNo:null, 
                unitNo:null,
                street : null, 
                address2 : null, 
                city : null, 
                zip : null, 
                state : null, 
                countryID : null,
                directionDetails : null,
                planTypeID : 0, 
                planName : null,
                freeParking : false,
                withParking : false,
                email : null,
                phone : null,
                mobile : null,
                contactPerson : null,
                contactPersonPosition : null,
                accountID : null,
                password : null,
                confirmPassword : null,
            };

            this.businessForm = businessFormReset;

            this.addOperationHour()

            if (this.businessData == null) { // add business
                this.businessForm.street = null
                this.businessForm.city = null
                this.businessForm.state = null    
                this.businessForm.address2 = null    
                this.businessForm.zip = null  
                this.businessForm.latitude = null
                this.businessForm.longitude = null
                this.businessForm.buildingNo = null
                this.businessForm.unitNo = null
                this.businessForm.directionDetails = null
                this.businessForm.countryID = this.userCluster && this.userCluster.country_id ? this.userCluster.country_id : null
            }
        },
        alertMessage(errs){
            _forEach(errs, err =>{
                this.showMessage("error", err[0])
            })
        },
        isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                evt.preventDefault();;
            } else {
                return true;
            }
        },
        searchCategory() {
            let params = {
                searchQuery: this.filterCategoryQuery
            }
            this.categoryLoading = true;
            this.$API.Cluster.getAllCategoriesData(params).then(res => {
                this.categoriesData = res.data.categories;
                this.categoryLoading = false;
            });
        },
        filterNode(value, data) {
            if (!value) return true;
            return data.name.indexOf(value) !== -1;
        },
        handleVideoSuccess(res, file) {
          // console.log('response', res);
          // console.log('file', file);
          
          this.videoList.forEach(file => {
            if(file.name == res.imageFile.fileName) {
              file.filePath = res.imageFile.filePath;
              file.show = true;
            }
          });
          this.importVideoLoading = false;
          this.$forceUpdate();
        },
        handleSuccess(res, file) {
              // console.log('response', res);
              // console.log('file', file);
              
              this.fileList.forEach(file => {
                if(file.name == res.imageFile.fileName) {
                  file.filePath = res.imageFile.filePath;
                  file.show = true;
                }
              });
              this.importLoading = false;
              this.$forceUpdate();
            },
            closeImportDialog() {
              this.formDialogVisibleImport = false;
              this.selectedBusinessID = null;
              this.fileList = [];
              this.$refs.upload.clearFiles();
            },
            uploadImages(type) {
                // console.log('upload')
              // this.$refs.upload.submit();
              this.tableLoading = true;
              this.formDialogVisibleImport = false;
              let data = {
                fileList : type == 'image' ? this.fileList : this.videoList,
                type: type
              }
              this.$API.BusinessList.saveBusinessBanners(this.selectedBusinessID, data).then(res => {
                this.$notify({
                    title: "Success",
                    message: "Successfully imported images.",
                    type: "success"
                });
                this.tableLoading = false;
                this.closeImportDialog();
              }).catch(_ => {
                this.formDialogVisibleImport = true;
                this.tableLoading = false;
              });
            },
            handleBeforeUpload(file) {
              const isLt2M = file.size / 1024 / 1024 < 2;

              if(this.fileList.some(f => f.name === file.name && f.size === file.size)) {
                this.$message.warning(`Image ${file.name} is already on the list.`);
                return false;
              }

              if(!isLt2M) {
                this.$message.warning(`Image can not exceed 2MB!`);
                return false;
              }
              
              this.fileList.push({
                name: file.name,
                uid: file.uid,
                size: file.size,
                type: file.type,
                fileContents: file,
                show: false,
                caption: null
              });
            
            },
            handleBeforeVideoUpload(file) {
              const isLt2M = file.size / 1024 / 1024 < 2;
              const validTypes = ['video/mp4', 'video/webm', 'video/avi', 'video/mov', ] // include types to be accepted
              
              console.log(file);
              if(this.videoList.some(f => f.name === file.name && f.size === file.size)) {
                this.$message.warning(`Video ${file.name} is already on the list.`);
                return false;
              }

              if (!validTypes.includes(file.type)) {
                this.$message.warning(`Invalid file type!`);
                return false;
              }
              
              this.videoList.push({
                name: file.name,
                uid: file.uid,
                size: file.size,
                type: file.type,
                fileContents: file,
                show: false,
                caption: null
              });
            
            },
            removeImageFromList(uid) {
              this.fileList.splice(this.fileList.findIndex(f => f.uid == uid), 1);
              this.$forceUpdate();
            },
            removeVideoFromList(uid) {
              this.videoList.splice(this.videoList.findIndex(f => f.uid == uid), 1);
              this.$forceUpdate();
            },
            handleOnProgress() {
              this.importLoading = true;
            },
            handleOnVideoProgress() {
              this.importVideoLoading = true;
            }
    },
    computed: {
        filteredCategories(){
            if (this.categoriesData != []) {
                return this.categoriesData.filter(category => category.parentCategoryID == null);
            } else {
                return [];
            }
            
        },
    },
    watch:{
        businessData(newVal){
            this.setData(newVal)
            if (newVal == null) {
                this.resetFields();
            }
        },
        filterCategoryQuery(val) {
            this.$refs.tree.filter(val);
        }
    }

}
</script>

<style lang="scss">
.el-upload {
    margin-left: 10px;
    margin-top: 10px;
}
.el-radio-button__orig-radio:checked+.el-radio-button__inner {
    color: #FFF;
    background-color: #f16e6f;
    border-color: #f16e6f;
}

.business-form
{
    
    table{

        td, th{
            padding: 5px 10px;
        }
    }

    .operation-hours i{
        cursor: pointer;
        font-size: 20px
    }
    .el-icon-map-location i{
        cursor: pointer !important;
        font-size: 20px;
    }
}

.cluster-card {
    .el-tabs__item.is-active {
        color: #EC3434;
    }

    .el-tabs__item:hover {
        color: #EC3434;
    }
    
    .el-tab-pane {
        margin-top: 10px;
        padding-left: 15px;
        padding-right: 15px;
    }
    .cluster-dropdown {
        width: 100%;
    }
}
</style>
