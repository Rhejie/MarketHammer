<template>
    <el-dialog
      :title="mode == 'Add' ? 'Add Live Stream' : 'Edit Live Stream'"
      :visible.sync="formDialogVisible"
      width="70%"
      top = "20px"
      :close-on-click-modal="close"
      :close-on-press-escape="close"
      v-loading="pageLoading"
      class="add-business-dialog">

        <el-form :model="liveStreamForm" :rules="rulesForm" label-position = "top" ref="liveStreamForm" class="demo-ruleForm">
            <el-row :gutter = "20">
                <el-col :span = "24">
                    <el-form-item :label="'Caption'" prop="caption">
                        <el-input ref="caption" v-model="liveStreamForm.caption" class="full-width" ></el-input>
                    </el-form-item>

                    <el-form-item :label="'Stream Type'" prop="type">
                        <el-select v-model="liveStreamForm.type" 
                            filterable
                            placeholder="Select" 
                            class="full-width"
                            disabled
                            >
                            <el-option
                              v-for="item in streamType"
                              :key="item.label"
                              :label="item.label"
                              :value="item.label">
                            </el-option>
                        </el-select>
                    </el-form-item>

                </el-col>
            </el-row>

            <el-row :gutter = "20" v-loading="importVideoLoading" v-if="liveStreamForm.type == 'Pre-recorded'">
                <el-col :span = "24" class="address-coordinates-input">
                    <h4>Video</h4>
                    <el-upload
                      class="upload-demo full-width"
                      drag
                      :action="uploadRoute"
                      :on-success="handleVideoSuccess"
                      multiple
                      ref="upload"
                      :before-upload="handleBeforeVideoUpload"
                      :on-progress="handleOnVideoProgress"
                      :file-list="videoList"
                      accept="mp4"
                      :show-file-list="false">
                      <i class="el-icon-upload"></i>
                      <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                    </el-upload>
                      <center>
                        <video
                            id="my-video"
                            class="video-js"
                            controls
                            preload="auto"
                            width="640"
                            height="264"
                            data-setup="{}"
                            style="margin-bottom: 10px;"
                            v-if="liveStreamForm.mediaPath != null"
                          >
                            <source :src="storageRoute+liveStreamForm.mediaPath" type="video/mp4" />
                            <p class="vjs-no-js">
                              To view this video please enable JavaScript, and consider upgrading to a
                              web browser that
                              <a href="https://videojs.com/html5-video-support/" target="_blank"
                                >supports HTML5 video</a
                              >
                            </p>
                        </video>
                    </center>
                    <!-- </ul> -->
                </el-col>
            </el-row>
        </el-form>

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
        streams : {
            required: false
        },
        uploadRoute : {
            required: false
        },
        business : {
            required: false
        },
        storageRoute : {
            required: false
        },
    },
    data() {
        let liveStreamForm = {
            id: null,
            businessListID : this.business.id, 
            caption : null, 
            type : 'Pre-recorded', 
            url : null, 
            mediaPath : null,  
        }

        let gData = {markers : [], height : '500px', mapClickable : true, showAction : true}

        return {
            importVideoLoading: false,
            pageLoading: false,
            close: false,
            businessData: [],
            selectedBusinessID: null,
            videoList: [],
            streamType: [
              { label: 'Pre-recorded' },
              { label: 'Live' },
            ],
            strict: true,
            showCheckedOnly: false,
            showHeader: false,
            categoryLoading: false,
            filterCategoryQuery: '',
            categoriesData  : [],
            modalLoading : false,
            formDialogVisible: false,
            activeTab       : 'generalInfo',
            liveStreamForm    : liveStreamForm,
            mode            : 'Add'
        }
    },
    mixins: [__message],
    created(){

        this.rulesForm = {
            caption: [
                { required: true, message: 'The caption is required.', trigger: 'blur' },
            ]
        }
        this.$EventDispatcher.listen('SHOW_ADD_LIVESTREAM_DIALOG', () => {
            this.mode = 'Add';
            this.formDialogVisible = true;
            this.resetFields();
        })

        this.$EventDispatcher.listen('SHOW_EDIT_LIVESTREAM_DIALOG', (business) => {
            this.mode = 'Edit';
            this.businessData = business;
            this.setData(this.businessData)
            this.formDialogVisible = true;
        })
    },
    mounted() {
        // this.setData(this.businessData)
    },
    methods: {
        // handleChange(file)
        // {
        //   var self = this;
        //   self.importLoading = true;
        //   // console.log(file, file.__ob__.value.raw)
        //   var mime_type = "image/jpeg";
        //   if (typeof output_format !== "undefined" && output_format == "png") {
        //     mime_type = "image/png";
        //   }
        //     new Compressor(file.__ob__.value.raw, {
        //       quality: 0.3,
        //       beforeDraw(context, canvas){
        //         self.importLoading = true;
        //       },
        //       success(result) {
        //         const formData = new FormData();
        //         // console.log(self.fileList, 'res', result)
        //         formData.append('file', result, result.name);

        //         // Send the compressed image file to server with XMLHttpRequest.
        //         axios.post('/business-list/upload-business-banners', formData).then((res) => {
        //           console.log('Upload success', res);
        //           self.importLoading = false;
        //           self.fileList.push({
        //             name: result.name,
        //             uid: file.uid,
        //             size: result.size,
        //             type: file.type,
        //             fileContents: result,
        //             show: false,
        //             filePath: res.data.imageFile.filePath,
        //             show:  true,
        //             caption: null
        //           });
        //         });
        //       },
        //       error(err) {
        //         self.importLoading = false;
        //         self.$message.warning(`Error uploading image.`);
        //         console.log(err.message);
        //       },
        //     });

        // },
        getFilePath(path){
            const [extension, ...nameParts] = path.split('.').reverse();
            return `video/${extension}`;
        },
        cancelForm(){
            this.resetFields();
            this.formDialogVisible = false;
        },
        setData(data){
            if(data && data.id){

                _forEach(data, (fm, fmInd) =>{
                    if(fmInd != 'url'){
                        this.liveStreamForm[fmInd] = fm 
                    }
                })

            }

        },
        saveForm(){
            // console.log(selectedCategories);
            this.$refs.liveStreamForm.validate((valid) => {
                if (valid) {
                    // console.log('valid', valid)
                    this.pageLoading = true
                    this.liveStreamForm.businessListID = this.business.id;

                    this.$API.BusinessList.saveLiveStream(this.liveStreamForm)
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
                            // this.$EventDispatcher.fire('BUSINESSDATA_GET')
                            if (this.mode == 'Add') {
                                this.showMessage("success", this.$msg.notif.success_add)
                            } else {
                                this.showMessage("success", this.$msg.notif.success_update)
                            }
                            
                            this.$emit('streamSaved', res.data);
                            // this.selectedBusinessID = res.data.id;
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
                this.$refs.liveStreamForm.resetFields();
            }
            // this.businessOpHours = []

            let liveStreamFormReset = {
                businessListID : this.business.id, 
                caption : null, 
                type : 'Pre-recorded', 
                url : null, 
                mediaPath : null, 
            };

            this.liveStreamForm = liveStreamFormReset;
        },
        alertMessage(errs){
            _forEach(errs, err =>{
                this.showMessage("error", err[0])
            })
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

          this.liveStreamForm.mediaPath = file.filePath
          this.importVideoLoading = false;
          this.$forceUpdate();
        },
        closeImportDialog() {
          this.formDialogVisibleImport = false;
          this.selectedBusinessID = null;
          this.fileList = [];
          this.$refs.upload.clearFiles();
        },
        handleBeforeVideoUpload(file) {
          const isLt2M = file.size / 1024 / 1024 < 2;
          const validTypes = ['video/mp4', 'video/webm', 'video/avi', 'video/mov', ] // include types to be accepted
          
          // console.log(file);
          if(this.videoList.some(f => f.name === file.name && f.size === file.size)) {
            this.$message.warning(`Video ${file.name} is already on the list.`);
            return false;
          }

          if (!validTypes.includes(file.type)) {
            this.$message.warning(`Invalid file type!`);
            return false;
          }
          
          this.videoList.push({
            businessListID: this.business.id,
            name: file.name,
            uid: file.uid,
            size: file.size,
            type: file.type,
            fileContents: file,
            show: false,
            caption: null
          });
        
        },
        removeVideoFromList(uid) {
          this.videoList.splice(this.videoList.findIndex(f => f.uid == uid), 1);
          this.$forceUpdate();
        },
        handleOnVideoProgress() {
          this.importVideoLoading = true;
        }
    },
    computed: {
    },
    watch:{
        businessData(newVal){
            this.setData(newVal)
            if (newVal == null) {
                this.resetFields();
            }
        },
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
