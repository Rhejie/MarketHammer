<template>
    <div>
        <el-dialog
              :title="mode == 'Add' ? 'Add Business' : 'Edit Business'"
              :visible.sync="formDialogVisible"
              width="80%"
              top = "20px"
              :close-on-click-modal="close"
              :close-on-press-escape="close"
              v-loading="pageLoading"
              class="add-business-dialog">

            <el-tabs type="card" @tab-click="handleTabClick" class="cluster-card" v-model="activeTab">
                <el-tab-pane label="General Info" name="generalInfo">
                    <div class="container mt-3">
                        <el-form :model="businessForm" :rules="rulesForm" label-position = "top" ref="businessForm" class="demo-ruleForm">
                            <el-row :gutter = "20">
                                <el-col :span = "12">
                                    <el-form-item :label="'Business Name'" prop="businessName">
                                        <el-input ref="businessName" v-model="businessForm.businessName" class="full-width" ></el-input>
                                    </el-form-item>

                                    <el-form-item :label="'Business Alias (in English)'" prop="businessAlias">
                                        <el-input ref="businessAlias" v-model="businessForm.businessAlias" class="full-width" ></el-input>
                                    </el-form-item>

                                    <el-form-item :label="'Industry Type'" prop="industryTypeID">
                                        <el-select v-model="businessForm.industryTypeID" 
                                            filterable
                                            placeholder="Select" 
                                            class="full-width"
                                            @change = "changeType"
                                            >
                                            <el-option
                                              v-for="item in industryList"
                                              :key="item.id"
                                              :label="item.name"
                                              :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>

                                    <el-form-item :label="'Business Type Code (Tax Agency)'" prop="businessTypeCode">
                                        <el-select v-model="businessForm.businessTypeId" 
                                            filterable
                                            placeholder="Select" 
                                            class="full-width"
                                            >
                                            <el-option
                                              v-for="item in businessTypeList"
                                              :key="item.id"
                                              :value="item.id"
                                              :label="getTypeLabel(item)">
                                            </el-option>
                                        </el-select>
                                        <!-- <el-input ref="businessTypeCode" v-model="businessForm.businessTypeCode" class="full-width" ></el-input> -->
                                    </el-form-item>

                                    <el-form-item :label="'Website'" prop="webAddress">
                                        <el-input ref="webAddress" v-model="businessForm.webAddress" class="full-width"></el-input>
                                    </el-form-item>

                                    <el-form-item :label="'Kakao Channel URL'" prop="kakaoChannelUrl">
                                        <el-input ref="kakaoChannelUrl" v-model="businessForm.kakaoChannelUrl" class="full-width"></el-input>
                                    </el-form-item>

                                </el-col>

                                <el-col :span = "12">
                                    
                                    <el-form-item :label="'Active'" prop="active">
                                        <el-checkbox v-model="businessForm.active">Active</el-checkbox>
                                    </el-form-item>

                                    <el-form-item :label="'Cluster ID'" prop="clusterName">
                                        <el-input ref="clusterId" v-model="businessForm.clusterName" disabled class="full-width"></el-input>
                                    </el-form-item>

                                    <el-form-item :label="'Join Date'" prop="joinDate">
                                        <el-date-picker
                                            v-model="businessForm.joinDate" type="date" placeholder="Pick a day" class="full-width">
                                        </el-date-picker>
                                    </el-form-item>

                                    <el-form-item :label="'Subscription Type'" prop="planTypeID">
                                        <el-select v-model="businessForm.planTypeID" 
                                            filterable
                                            placeholder="Select" 
                                            class="full-width"
                                            @change = "changeType"
                                            >
                                            <el-option
                                              v-for="item in businessPlans"
                                              :key="item.id"
                                              :label="item.name"
                                              :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>

                                    <el-form-item :label="'Business License'" prop="businessLicense">
                                        <el-input ref="businessLicense" v-model="businessForm.businessLicense" class="full-width"></el-input>
                                    </el-form-item>

                                    <el-form-item :label="'Blog Site'" prop="blogSite">
                                        <el-input ref="blogSite" v-model="businessForm.blogSite" class="full-width"></el-input>
                                    </el-form-item>

                                </el-col>
                            </el-row>
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

                            <el-row :gutter = "20">
                                <el-col :span = "24">
                                    <h4>Business Owner's Account Info</h4><br>
                                    <el-form-item :label="'Account ID'" prop="accountID">
                                        <el-input ref="accountID" v-model="businessForm.accountID" class="full-width" disabled></el-input>
                                    </el-form-item>
                                </el-col>

                                <el-col :span = "12">
                                    <el-form-item :label="'First Name'" prop="firstName">
                                        <el-input ref="firstName" v-model="businessForm.firstName" class="full-width"></el-input>
                                    </el-form-item>

                                </el-col>

                                <el-col :span = "12">
                                    <el-form-item :label="'Last Name'" prop="lastName">
                                        <el-input ref="lastName" v-model="businessForm.lastName" class="full-width"></el-input>
                                    </el-form-item>

                                </el-col>

                                <el-col :span = "12">
                                    <el-form-item :label="'Password'" prop="password">
                                        <el-input ref="password" v-model="businessForm.password" type="password" class="full-width" show-password autocomplete="off"></el-input>
                                    </el-form-item>

                                </el-col>

                                <el-col :span = "12">
                                    <el-form-item :label="'Re enter password'" prop="confirmPassword">
                                        <el-input ref="confirmPassword" v-model="businessForm.confirmPassword" type="password" class="full-width" show-password autocomplete="off"></el-input>
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
                            <!-- <el-row :gutter = "20">
                                <el-col :span = "4" class="view-map-col text-center">
                                    <i class="el-icon-map-location" @click = "dialogMap = true"></i><br>
                                    <span @click = "dialogMap = true" class = "pointer">View Map</span>
                                    <span @click = "dialogMap = true" class = "ml-2 underline pointer"> View Map </span>
                                </el-col>
                            </el-row> -->

                            <el-row :gutter = "20">
                                <el-col :span = "24">
                                    <span @click = "dialogMap = true" class = "ml-2 underline pointer pull-right"> View Map </span>
                                    <el-form-item :label="'Direction Info'" prop="directionDetails">
                                        <el-input ref="directionDetails" v-model="businessForm.directionDetails" type="textarea" class="full-width" ></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="24">
                                        <el-checkbox v-model="businessForm.withParking"  @change="handleWithParking">With Parking</el-checkbox>
                                        <el-checkbox v-model="businessForm.freeParking" @change="handleFreeParking">Free Parking</el-checkbox>
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

                    <el-tab-pane label="Promotion" name="pormotion" v-loading="promotionLoading">
                        <div class="container mt-3">
                            <el-form :model="businessForm" :rules="rulesForm" label-position = "top" ref="businessForm" class="demo-ruleForm">
                                <el-row :gutter = "20">
                                    <el-col :span = "24">
                                        <el-form-item :label="'Promotion'" prop="promotion">
                                            <el-input ref="promotion" v-model="businessForm.promotion" type="textarea" class="full-width" ></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row :gutter = "20" v-loading="importLoading">
                                    <el-col :span = "24" class="address-coordinates-input">
                                        <h4>Images</h4>
                                        <el-upload
                                          class="upload-demo full-width"
                                          drag
                                          :action="uploadImageRoute"
                                          :on-success="handleSuccess"
                                          multiple
                                          ref="upload"
                                          :file-list="fileList"
                                          :auto-upload="false"
                                          :on-change="handleChange"
                                          :show-file-list="false">
                                          <i class="el-icon-upload"></i>
                                          <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                                        </el-upload>
                                        <el-progress :stroke-width="24" :percentage="progressPercentage" status="success" v-if="showImageProgress"></el-progress>
                                        <ul class="el-upload-list el-upload-list --picture">
                                          <li class="el-upload-list__item is-success" v-for="file in fileList" :key="file.uid">
                                            <img v-if="file.show" :src="'../storage'+file.filePath" :alt="file.name" width="100px" height="70px" class="el-upload-list-image">
                                            <a class="el-upload-list__item-name">
                                              {{ file.name }}
                                            </a>
                                            <div class="image-caption">
                                              <span class="el-upload-list__image-caption"> {{ 'Image Caption' }} </span>
                                              <el-input class="el-upload-list__image-caption-input" placeholder="(optional)" v-model="file.caption"></el-input>
                                            </div>
                                            <label class="el-upload-list__item-status-label">
                                              <i class="el-icon-upload-success el-icon-check"></i>
                                            </label>
                                            <i class="el-icon-close" @click="removeImageFromList(file.uid)"></i>
                                            <i class="el-icon-close-tip">클릭시 삭제됩니다</i>
                                          </li>
                                        </ul>
                                        <span>Business images</span><br>
                                        <div class="scrollable" v-if="mode == 'Edit'" style="margin-bottom:10px;">
                                            <div v-for="banner in businessImages" style="display:inline-block;">
                                                <el-image
                                                    
                                                    style="width:150px;height:150px;margin: 5px;"
                                                    :src="banner.mediaPath">
                                                </el-image><br>
                                                <center>
                                                    <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteBanner(banner.id)"></el-button>  
                                                </center>
                                            </div>
                                        </div>
                                    </el-col>
                                </el-row>

                                <el-row :gutter = "20" v-loading="importVideoLoading">
                                    <el-col :span = "24" class="address-coordinates-input">
                                        <h4>Video</h4>
                                        <el-upload
                                          class="upload-demo full-width"
                                          drag
                                          :action="uploadImageRoute"
                                          :on-success="handleVideoSuccess"
                                          multiple
                                          ref="upload"
                                          :before-upload="handleBeforeVideoUpload"
                                          :on-progress="handleOnVideoProgress"
                                          :file-list="fileList"
                                          accept="mp4"
                                          :show-file-list="false">
                                          <i class="el-icon-upload"></i>
                                          <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                                        </el-upload>
                                        <el-progress :stroke-width="24" :percentage="progressPercentage" status="success" v-if="showVideoProgress"></el-progress>
                                        <ul class="el-upload-list el-upload-list --picture">
                                          <li class="el-upload-list__item is-success" v-for="file in videoList" :key="file.uid">
                                            <!-- <img v-if="file.show" :src="'../storage'+file.filePath" :alt="file.name" width="100px" height="70px" class="el-upload-list-image"> -->
                                            <a class="el-upload-list__item-name">
                                              {{ file.name }}
                                            </a>
                                            <!-- <div class="image-caption">
                                              <span class="el-upload-list__image-caption"> {{ 'Image Caption' }} </span>
                                              <el-input class="el-upload-list__image-caption-input" placeholder="(optional)" v-model="file.caption"></el-input>
                                            </div> -->
                                            <label class="el-upload-list__item-status-label">
                                              <i class="el-icon-upload-success el-icon-check"></i>
                                            </label>
                                            <i class="el-icon-close" @click="removeVideoFromList(file.uid)"></i>
                                            <i class="el-icon-close-tip">클릭시 삭제됩니다</i>
                                          </li>
                                        </ul>
                                        <span>Business videos</span><br>
                                        <div class="scrollable" v-if="mode == 'Edit'" style="margin-bottom:10px;">
                                            <div v-for="video in businessVideos" style="display:inline-block;">
                                                <video
                                                    id="my-video"
                                                    class="video-js"
                                                    controls
                                                    preload="auto"
                                                    width="200"
                                                    height="200"
                                                    style="margin: 5px;"
                                                    data-setup="{}"
                                                    :key="video.id"       
                                                                      
                                                    >
                                                    <source :src="video.mediaPath" type="video/mp4" />

                                                    

                                                    <p class="vjs-no-js">
                                                      To view this video please enable JavaScript, and consider upgrading to a
                                                      web browser that
                                                      <a href="https://videojs.com/html5-video-support/" target="_blank"
                                                        >supports HTML5 video</a
                                                      >
                                                    </p>
                                                </video><br>
                                                <center>
                                                    <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteBanner(video.id)"></el-button>  
                                                </center>
                                            </div>
                                        </div>
                                    </el-col>
                                </el-row>

                                <el-row :gutter = "20">
                                    <el-col :span = "24">
                                        <h4><i class="el-icon-price-tag"></i>  Tags</h4>
                                        <el-form-item prop="tags">
                                            <el-select
                                                v-model="tagsLists"
                                                multiple
                                                filterable
                                                allow-create
                                                class="full-width"
                                                placeholder="Type to add">
                                                <el-option
                                                  v-for="item in tagsLists"
                                                  :key="item"
                                                  :label="item"
                                                  :value="item">
                                                </el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                </el-row>

                            </el-form>
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
        uploadImageRoute : {
            required: false
        },
        uploadVideoRoute : {
            required: false
        }
    },
    data() {
        let businessForm = {
            businessName : null, 
            businessAlias : null, 
            industryTypeID : null, 
            clusterName : null, 
            clusterID : null,  
            active : false, 
            businessTypeId : null, 
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
            showImageProgress: false,
            showVideoProgress: false,
            progressPercentage: 0,
            promotionLoading: false,
            importVideoLoading: false,
            importLoading: false,
            close: false,
            businessData: this.business,
            selectedBusinessID: null,
            fileList: [],
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
            businessTypeList: [],
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
        this.getBusinessTypes()

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

        this.$EventDispatcher.listen('SHOW_EDIT_BUSINESS_DIALOG', (business) => {
            this.mode = 'Edit';
            this.businessData = business;
            this.setData(this.businessData)
            this.getTreeCategoryData();
            this.formDialogVisible = true;
        })
    },
    mounted() {
        console.log('Component mounted.')
        this.setData(this.businessData)
    },
    methods: {
        getTypeLabel(item) {
            return item.name+' - '+ item.code;
        },
        onProgress(percent){
            this.progressPercentage = percent
        },
        handleChange(file)
        {
          var self = this;
          // self.importLoading = true;
          self.progressPercentage = 0;
          self.showImageProgress = true;
          // console.log(file, file.__ob__.value.raw)
          var mime_type = "image/jpeg";
          if (typeof output_format !== "undefined" && output_format == "png") {
            mime_type = "image/png";
          }
            new Compressor(file.__ob__.value.raw, {
              quality: 0.3,
              beforeDraw(context, canvas){
                // self.importLoading = true;
              },
              success(result) {
                const formData = new FormData();
                // console.log(self.fileList, 'res', result)
                formData.append('file', result, result.name);

                let config = {
                     onUploadProgress(progressEvent) {
                      var percentCompleted = Math.round((progressEvent.loaded * 100) /
                        progressEvent.total);

                      self.progressPercentage = percentCompleted;
                      // execute the callback
                      if (percentCompleted) self.onProgress(percentCompleted)

                      return percentCompleted;
                    },
                };

                // Send the compressed image file to server with XMLHttpRequest.
                axios.post('/business-list/upload-business-banners', formData, config).then((res) => {
                  console.log('Upload success', res);
                  self.importLoading = false;
                  self.showImageProgress = false;
                  self.progressPercentage = 0;

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
        getBusinessTypes() {
            this.$API.BusinessList.getBusinessTypes()
            .then(result => {
                this.businessTypeList = result.data.types
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
                    let bForm = cloneDeep(this.businessForm)

                    bForm.operationHours = this.businessOpHours
                    bForm.joinDate = this.$df.formatDate(bForm.joinDate, "YYYY-MM-DD")


                    this.$API.BusinessList.saveBusinessList(bForm)
                    .then(result => {
                        let res = result.data

                        if(!res.success){
                            if(res.data){
                                this.alertMessage(res.data)
                                this.pageLoading = true
                            }
                            else{
                                if (this.mode == 'Add') {
                                    this.showMessage("success", this.$msg.notif.failed_add)
                                } else {
                                    this.showMessage("success", this.$msg.notif.failed_update)
                                }
                                this.pageLoading = true
                            }
                        }
                        else{
                            this.pageLoading = true
                            this.formDialogVisible = false;
                            this.$EventDispatcher.fire('BUSINESSDATA_GET')
                            this.$emit('businessSaved');
                            if (this.mode == 'Add') {
                                this.showMessage("success", this.$msg.notif.success_add)
                            } else {
                                this.showMessage("success", this.$msg.notif.success_update)
                            }
                            
                            this.selectedBusinessID = res.data.id;
                            this.resetFields()
                            if (this.fileList.length > 0) {
                                this.uploadImages('image');
                            }
                            if (this.videoList.length > 0) {
                                this.uploadImages('video');
                            }
                            
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
        deleteBanner(id) {
             let params = {
                id: id
            }
            this.promotionLoading = true;
            this.$API.BusinessList.deleteBusinessBanner(params).then(res => {
                // this.categoriesData = res.data.categories;
                if (res.data.success) {
                    this.businessData.business_banners = this.businessData.business_banners.filter(banner => banner.id !== id);
                }                
                this.promotionLoading = false;
            });
        },
        filterNode(value, data) {
            if (!value) return true;
            return data.name.indexOf(value) !== -1;
        },
        handleVideoSuccess(res, file) {
          // console.log('response', res);
          // console.log('file', file);
          this.progressPercentage = 0;
          this.showVideoProgress = false;
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
              this.progressPercentage = 0;
              this.showVideoProgress = true;
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
              // this.importLoading = true;
            },
            handleOnVideoProgress(event) {
                console.log(event)
                this.progressPercentage = event.percent
               // this.showVideoProgress = true;
              // this.importVideoLoading = true;
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
        businessImages() {
            if (this.businessData.business_banners != []) {
                return this.businessData.business_banners.filter(banner => banner.type == 'image');
            } else {
                return [];
            }
        },
        businessVideos() {
            if (this.businessData.business_banners != []) {
                return this.businessData.business_banners.filter(banner => banner.type == 'video');
            } else {
                return [];
            }
        }
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
