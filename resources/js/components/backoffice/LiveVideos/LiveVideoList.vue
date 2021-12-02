<template>
	<div class = "events-container" v-loading = "pageLoading">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card borderless">
                    <div class="card-body">
                        
                        <div class="card-actions">
                          <div class="row">
                            <div class="col-8">
                              <el-input
                                  class="input-search"
                                  v-model="search"
                                  placeholder="Type to search"
                                  @keypress.enter.native="searchBusinessListing">
                                  <i slot="suffix" class="el-input__icon el-icon-search"></i>
                              </el-input>
                            </div>
                            <div class="col-4">
                              <div class="add-button-container" style="padding-top: 5px !important;">
                                  <button type="button" class="btn btn-primary btn-red" @click="addLiveStream" style="float:right;">Add new</button>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <el-table
                        class="table-business-list"
                        :data="liveVideos.filter(data => !search || data.caption.toLowerCase().includes(search.toLowerCase()))"
                        style="width: 100%">
                            <el-table-column
                                prop="caption"
                                label="Caption">
                            </el-table-column>
                            <el-table-column
                                prop="type"
                                label="Type">
                            </el-table-column>
                            <el-table-column
                                prop="url"
                                label="Live Stream URL">
                            </el-table-column>
                            <el-table-column
                                label="">
                                <template slot-scope="scope">
                                    <span @click = "editLiveStream(scope.row)" class = "action-edit mr-2">{{ 'Edit' }}</span>
                                    <span @click = "deleVideo(scope.row)" class = "action-edit mr-2">{{ 'Delete' }}</span>
                                </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
            </div>
        </div>
      
        <live-stream-form :streams="businessData.business_streams" :uploadRoute="uploadRoute" :business="businessData" @streamSaved="handleStreamSaved" :storageRoute="storageRoute"></live-stream-form>
	</div>
</template>
<script>

  export default {
    data(){

    return {
      pageLoading   : false,
      liveVideos:this.businessData.business_streams,
      formDialogVisible: false,
      search: '',
      business: this.businessData,
      filterVisible: false,
      filterForm: {
          status: 'All',
      },
      selectedEvent : null
    }
  },
  	props: {
        businessData : {
            required: false
        },
        uploadRoute : {
            required: false
        },
        storageRoute : {
            required: false
        },
    },
  	created() {
      this.getLiveVideos(this.business.id);
  	},
  	methods: {
      handleStreamSaved(data){
        this.getLiveVideos(data.businessListID);
      },
      addLiveStream() {
        console.log('d')
        this.$EventDispatcher.fire('SHOW_ADD_LIVESTREAM_DIALOG');
      },
      editLiveStream(video){
        console.log('d')
        this.$EventDispatcher.fire('SHOW_EDIT_LIVESTREAM_DIALOG', video);
      },
      deleVideo(video){
        // console.log(video)
        let params = {
              id : video.id,
        }

        this.pageLoading = true;
        this.$API.LiveVideo.deleteLiveVideo(params)
        .then(result => {   
          this.$notify({
              title: "Success",
              message: "Successfully deleted live stream.",
              type: "success"
          });
        })
        .catch(err => {
            console.log('Error!', err)
        })
        .finally(_ => {
          this.getLiveVideos(video.businessListID)
          this.pageLoading = false
        })
      },
      getLiveVideos(id){
        let params = {
              id : this.businessData.id,
        }

        this.pageLoading = true;
        this.$API.LiveVideo.getLiveVideos(params)
        .then(result => {        
          let res = result.data
          // console.log(res.businessData)
          this.liveVideos = res.streams
        })
        .catch(err => {
            console.log('Error!', err)
        })
        .finally(_ => {
          this.pageLoading = false
        })
      }
  	},
  }
</script>
<style lang="scss">
.events-container{
	background-color: #fff;
	border: 1px solid #E9E9E9;
	padding: 0px 16px;
}
.business-list{
    .el-dialog__body{
        padding: 10px 20px 30px;
    }

    .action-edit{
        text-decoration: underline;
        cursor: pointer;
    }

    .btn-import-image {
      background-color: green !important;
      border-color: green !important;
      color: white !important;
      font-size: 11px;
      padding: 10px 15px;
      border-radius: 2px;
    }
}
.el-loading-spinner .path {
  stroke: #EC3434;
}

.filter-container {
  padding-bottom: 15px;
  padding-top: 5px;
}

.el-upload-list__item {
  line-height: unset !important;
  border: 1px solid #E4E7ED !important;
  padding: 10px;
}

.image-caption {
  margin-top: 10px !important;
  padding-bottom: 10px !important;
  .el-upload-list__image-caption {
    display: inline !important;
  }

  .el-upload-list__image-caption-input {
    display: inline !important;
    font-size: 10px;
    .el-input__inner {
      height: 20px !important;
      width: 200px !important;
      border-radius: 2px;
      padding: 10px 15px;
    }
  }
}

.el-upload-list-image {
  float: left !important;
}


  .action-edit{
        text-decoration: underline;
        cursor: pointer;
    }
</style>