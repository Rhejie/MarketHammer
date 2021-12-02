<template>
    <el-dialog
        :title="title"
        :visible.sync="showDialog"
        width="45%"
        top = "20px"
        @close="closeImportDialog"
        :close-on-click-modal="false">
        <div class="text-center" v-loading="importLoading">
            <el-upload
                class="upload-demo"
                drag
                :action="uploadImageRoute"
                :on-success="handleSuccess"
                ref="upload"
                :before-upload="handleBeforeUpload"
                :on-progress="handleOnProgress"
                :file-list="fileList"
                :multiple = "multiple"
                :show-file-list="false">
                <i class="el-icon-upload"></i>
                <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 2MB</div>
            </el-upload>
            <ul class="el-upload-list el-upload-list --picture">
                <li class="el-upload-list__item is-success" v-for="file in fileList" :key="file.uid">
                    <img v-if="file.show" :src="'/storage'+file.filePath" :alt="file.name" width="100px" height="70px" class="el-upload-list-image">
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
        </div>
        <span slot="footer">
              <button type="button" class="btn btn-default" @click="closeImportDialog">Cancel</button>
              <button type="button" class="btn btn-primary btn-red" @click="uploadImages" :disabled="fileList.length == 0"> {{ 'Save Images' }} </button>
        </span>
    </el-dialog>
</template>

<script>
    
import { dialogComponent } from '../../mixins/dialogComponent'

export default {
    mixins:[ dialogComponent],
    props: {
        businessData    : {
            required: true
        },
        pageData : {
            required: true
        },
    },
    data(){
        return {
            dataBusiness        : this.businessData,
            uploadImageRoute    : this.pageData.uploadImageRoute,
            importLoading       : false,
            fileList            : [],
            title               : this.pageData.title !== undefined ? this.pageData.title : "Import Images",
            multiple            : this.pageData.multiple !== undefined ? this.pageData.multiple : true,
            isPrimary           : this.pageData.isPrimary
        }
    },
    methods:{
        handleCloseImport(done) {
          this.$confirm('Are you sure to close this dialog?')
            .then(_ => {
              this.fileList = [];
              done();
            })
            .catch(_ => {});
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
            this.fileList = [];
            this.$refs.upload.clearFiles();
            this.closeModal()
        },
        uploadImages() {
            // this.$refs.upload.submit();
            this.tableLoading = true;
            let data = {
                fileList : this.fileList,
                isPrimary : true
            }
            this.$API.BusinessList.saveBusinessBanners(this.dataBusiness.id, data).then(result => {
                let res = result.data
                this.$notify({
                    title: "Success",
                    message: "Successfully imported images.",
                    type: "success"
                });

                let data = {
                    files : res.files
                }
                this.$EventDispatcher.fire('BUSINESS_BANNER_SAVED', data)
                this.tableLoading = false;
                this.closeImportDialog();
            }).catch(_ => {
                this.tableLoading = false;
            });
        },
        getBannerImage(){

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
        removeImageFromList(uid) {
            this.fileList.splice(this.fileList.findIndex(f => f.uid == uid), 1);
            this.$forceUpdate();
        },
        handleOnProgress() {
            this.importLoading = true;
        }
    },
    watch:{
        businessData(newVal){
            this.dataBusiness = newValue
        },
        'pageData.multiple' : function(newVal){
            this.multiple = newVal
        },
        'pageData.title' : function(newVal){
            this.title = newVal
        },
        'pageData.title' : function(newVal){
            this.isPrimary = newVal
        }
    }
}
</script>