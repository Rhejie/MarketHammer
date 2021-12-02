<template>
	<div v-loading = "pageLoading">
		<el-header>
		  	<home-header headertitle="Store Details" :showback="showBack" prev="home"></home-header>
		</el-header>
		<el-main class="store-information">
			<div class="pd-50" style="padding-top:10px !important;">
				<el-image
		          style="width: 50px; height: 50px;overflow: unset !important;"
		          src="/image/no_image.png"
		          fit="fill">
		        </el-image>

		        <el-button class="pull-right" @click="showAddBusinessFormDialog">Add business</el-button> 

		        <center>
		          <el-autocomplete
		            class="inline-input"
		            v-model="inputLocation"
		            :fetch-suggestions="querySearch"
		            placeholder="Search"
		            @select="handleSelect"
		          >
		            <el-button slot="prepend" icon="el-icon-search"></el-button> 
		          </el-autocomplete>
		        </center>

		        <div class="scroll">
	        		<div v-for="(photo, photoIndex) in business.business_banners" style="display: inline-block;padding: 20px;" v-if="photo.type == 'image'">
	        			<el-image
					      style="width: 200px; height: 200px"
					      :src="storageRoute+photo.mediaPath"
					      fit="cover">
					      	
					    </el-image>
	        		</div>
	            </div>


	            <div class="row" style="margin-top: 20px;">
	            	<div class="col-6">
	            		<div class="row">
	            			<div class="col-8" style="padding-right: 0px !important;">
	            				<div class="row">
	            					<div class="col-3">
	            						<el-image
								    		style="width:100%;height:50px;"
									      	:src="getPrimaryPhoto(dataBusiness.business_banners)">
								    	</el-image>
	            					</div>
	            					<div class="col-9">
	            						<h4>{{ dataBusiness.businessName }} <i class="el-icon-question clickable" @click="openClamBusinessDialog"></i></h4>
	            						<h4>{{dataBusiness.industry_type ? dataBusiness.industry_type.code : ''}}</h4>

	            						<el-rate
	            							class="rate-no-pad"
											v-model="+Number(business.rating).toFixed(2)"
											disabled
											:allow-half="true"
											show-score
											score-template="{value}"
											text-color="#ff9900">
										</el-rate>
	            						<span>({{ business.reviews.length }} reviews)</span>
	            					</div>
	            				</div>
	            			</div>
	            			<div class="col-4" style="padding-left: 0px !important;">
	            				<div class="row">
			            			<div class="col-6">
			            				<div class="row">
			            					<div class="col-12">
			            						<el-image
											        style="width: 30px; height: 30px;"
											        class="clickable"
											        src="/image/call.png"
											        fit="fill">
				        						</el-image><br>
					            				<span>Call</span>
			            					</div>
			            				</div>
			            				<div class="row">
			            					<div class="col-12" @click="handleShowRateDialog">
			            						<el-image
											        style="width: 30px; height: 30px;"
											        class="clickable"
											        src="/image/star.png"
											        fit="fill">
				        						</el-image><br>
					            				<span>Write Review</span>
			            					</div>
			            				</div>
			            			</div>
			            			<div class="col-6">
			            				<div class="row">
			            					<div class="col-12" @click = "markBookmark(dataBusiness)">
					            				<el-image
					            					v-if = "dataBusiness.user_bookmark == null"
											        style="width: 30px; height: 30px;"
											        class="clickable"
											        src="/image/bookmark_unpressed.png"
											        fit="fill">
				        						</el-image>
				        						<el-image
					            					v-else
											        style="width: 30px; height: 30px;"
											        class="clickable"
											        src="/image/bookmark_pressed.png"
											        fit="fill">
				        						</el-image>
				        						<br>
					            				<span>Bookmark</span>
					            			</div>
					            		</div>
					            		<div class="row">
			            					<div class="col-12">
			            						<el-image
											        style="width: 30px; height: 30px;"
											        class="clickable"
											        src="/image/share.png"
											        fit="fill">
				        						</el-image><br>
					            				<span>Share</span>
			            					</div>
			            				</div>
			            			</div>
			            		</div>
	            			</div>
	            		</div>

	            		<div class="row" style="margin-top: 10px;">
	            			<div class="col-4">
	            				<span>Address</span><br>
	            				<i class="el-icon-location-information"></i>
	            				<span>{{dataBusiness.address}}</span>
	            			</div>
	            			<div class="col-4">
	            				<span>Contact number</span><br>
	            				<span>{{dataBusiness.phone}}</span><br>
	            				<span>{{dataBusiness.contact}}</span><br>
	            			</div>
	            			<div class="col-4">
	            				<div class="col-4">
		            				<span>Email</span><br>
		            				<span>{{dataBusiness.email}}</span>		            			
		            			</div>
	            			</div>
	            		</div>
	            		<div class="row" style="margin-top: 10px;">
	            			<div class="col-4">
	            				<span>Website</span><br>
	            				<span>{{dataBusiness.website}}</span>
	            			</div>
	            			<div class="col-8">
	            				<el-image
							          style="width: 40px; height: 40px;overflow: unset !important;"
							          src="/image/chat.png"
							          fit="fill">
						        </el-image><br>
						        <span>Request for quote Chat with Business</span>
	            			</div>
	            		</div>


	            		<div class="row">
	            			<div class="col-12">
	            				<el-tabs type="card" v-model="tabModel">
								    <el-tab-pane name = "announcements" label="Announcements">
							    		<el-card v-for="(item,index) in business.announcements" style="margin-bottom:10px;padding:10px;" shadow="never" :key="item.id">
										  	<b>{{ item.title }}</b><br>
							    			<span>{{ item.description }}</span>
										</el-card>
								    </el-tab-pane>
								    <el-tab-pane label="Review" name="review">
								    	<div style="overflow:auto;height:400px;">
									    	<el-card v-for="(item,index) in business.reviews" style="margin-bottom:10px;padding:5px;" shadow="never" :key="item.id">
											  	<div class="row">
											  		<div class="col-2" style="padding-right:0px !important;">
											  			<el-image
													          style="width: 100%; height: 40px;"
													          src="/image/no_image.png"
													          fit="fill">
												        </el-image>
											  		</div>
											  		<div class="col-10">
											  			<div>
												  			<span>{{ item.user.firstName }}</span>
												  			<el-image
												  				class="pull-right"
														          style="width: 20px; height: 20px;"
														          src="/image/like.png"
														          fit="fill">
													        </el-image><br><br>
												  			<span class="pull-right">Useful/Not useful</span>
												  			<el-rate
						            							class="rate-no-pad"
																v-model="+Number(item.rating).toFixed(2)"
																disabled
																:allow-half="true"
																show-score
																score-template="{value}"
																text-color="#ff9900">
															</el-rate>
														</div>
														<div class="row" style="margin-top:15px;">
															<div class="col-12">
																<p>{{ item.reviewContent }}</p>
															</div>
														</div>
											  		</div>
											  		<div class="col-12" style="padding:0px 25px!important">
											  			<div v-for="banner in item.images">
			                                                <el-image
			                                                    
			                                                    style="width:100%;height:150px;margin: 5px;"
			                                                    :src="banner.mediaPath">
			                                                </el-image><br>
			                                            </div>
											  		</div>
											  		<div class="col-12" v-for="video in item.videos" style="padding:0px 25px!important">
														<video

		                                                    id="my-video"
		                                                    class="video-js"
		                                                    controls
		                                                    preload="auto"
		                                                    width="100%"
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
													</div>
											  	</div>
											</el-card>
										</div>
								    </el-tab-pane>
								    <el-tab-pane label="Product & Services" name="productAndServices">

								    </el-tab-pane>

								    <el-tab-pane label="Photos" name="photos">
								    	<div class="scroll">
						            		<div v-for="(photo, photoIndex) in business.business_banners" style="display: inline-block;padding: 20px;" v-if="photo.type == 'image'">
						            			<el-image
											      style="width: 200px; height: 200px"
											      :src="storageRoute+photo.mediaPath"
											      fit="cover">
											      	
											    </el-image>
						            		</div>
						                </div>
								    </el-tab-pane>

								    <el-tab-pane label="Videos" name="videos">
								    	<div class="scroll">
						            		<div v-for="(video, videoIndex) in business.business_banners" style="display: inline-block;padding: 20px;" v-if="video.type == 'video'">
						                    	<video
												    id="my-video"
												    class="video-js"
												    controls
												    preload="auto"
												    width="400"
												    height="264"
												    data-setup="{}"
									    			:key="videoIndex"
									    							  
									    			>
												    <source :src="storageRoute+video.mediaPath" type="video/mp4" />

												    

												    <p class="vjs-no-js">
												      To view this video please enable JavaScript, and consider upgrading to a
												      web browser that
												      <a href="https://videojs.com/html5-video-support/" target="_blank"
												        >supports HTML5 video</a
												      >
												    </p>
												</video>
						            		</div>
						                </div>
								    </el-tab-pane>

								    <el-tab-pane label="Durio Live" name="durioLive">
								    	<div class="scroll">
						            		<div v-for="(image, imageIndex) in liveVideos" style="display: inline-block;padding: 20px;">
						                    	<video
												    id="my-video"
												    class="video-js"
												    controls
												    preload="auto"
												    width="400"
												    height="264"
												    data-setup="{}"
									    			:key="imageIndex"		
									    							  
									    			>
												    <source :src="storageRoute+image.mediaPath" type="video/mp4" />

												    

												    <p class="vjs-no-js">
												      To view this video please enable JavaScript, and consider upgrading to a
												      web browser that
												      <a href="https://videojs.com/html5-video-support/" target="_blank"
												        >supports HTML5 video</a
												      >
												    </p>
												</video>
						                		<h4>{{ image.caption }}</h4>
						            		</div>
						                </div>
								    </el-tab-pane>

								  </el-tabs>
	            			</div>	
	            		</div>
	            	</div>

	            	<div class="col-6">
	            		<h4>Business Hours</h4>
	            		<el-table
						    :data="business.business_operations"
						    border
						    style="width: 100%">
						    <el-table-column
						      prop="day"
						      label="Day">
						    </el-table-column>
						    <el-table-column
						      prop="from"
						      label="Open">
						    </el-table-column>
						    <el-table-column
						      prop="to"
						      label="Close">
						    </el-table-column>
					  </el-table>
	            	</div>
	            </div>

			</div>

			<el-dialog
		        width="50%"
		        :visible.sync="showRateDialog"
		        :title="`Please rate us.`"
				:close-on-click-modal="false"
				:close-on-press-escape="false"
				v-loading="pageLoading"
				:show-close="false"
		        append-to-body>

		        
			    <el-input type="textarea" v-model="reviewForm.reviewContent" placeholder="Comments"></el-input>
			    <br>
			    <center>
		        <el-rate v-model="reviewForm.rating" style="width: 100%;" :texts="['Bad', 'Disappointed', 'Normal', 'Good', 'Great']" id="rateForm"></el-rate>
		        </center>

		        <br>
                <h4>Images</h4>
                <el-upload
                  class="upload-demo"
                  :file-list="reviewForm.imageFile"
                  v-loading="importLoading"
                  :on-change="handleChange"
                  :auto-upload="false"
                  list-type="picture"
                  action="https://jsonplaceholder.typicode.com/posts/">
                 <el-button size="small" type="primary">Upload Image</el-button>
                </el-upload>
                <br><br>

                <h4>Videos</h4>
                <el-upload
                  class="upload-demo"
                  :file-list="reviewForm.videoFile"
                  v-loading="importVideoLoading"
                  :auto-upload="false"
                  :on-change="handleChangeVideo"
                  list-type="picture"
                  action="https://jsonplaceholder.typicode.com/posts/">
                 <el-button size="small" type="primary">Upload Video</el-button>
                </el-upload>

		        <span slot="footer" class="dialog-footer">
				    <el-button @click="showRateDialog = false">Cancel</el-button>
				    <el-button type="danger" @click="saveReview">Continue</el-button>
				  </span>
	    	</el-dialog>

	    	<el-dialog
		        width="60%"
		        :visible.sync="showClaimBusinessDialog"
		        :title="`Claim Business`"
				:close-on-click-modal="false"
				:close-on-press-escape="false"
				:show-close="false"
		        append-to-body>

		        <el-form v-loading="claimBusinessLoading" :model="claimBusinessForm" :rules="claimBusinessRules" ref="claimBusinessForm" class="demo-ruleForm" size="small" label-position="left" label-width="150px" id="claimForm">

		        	<el-form-item label="Contact name" prop="name">
					    <el-input v-model="claimBusinessForm.name"></el-input>
					</el-form-item>

					<el-form-item label="Contact number" prop="number">
					    <el-input v-model="claimBusinessForm.number"></el-input>
					</el-form-item>

					<el-form-item label="Designation" prop="designation">
					    <el-input v-model="claimBusinessForm.designation"></el-input>
					</el-form-item>

					<el-form-item label="Email" prop="email">
					    <el-input v-model="claimBusinessForm.email"></el-input>
					</el-form-item>

					<el-form-item label="Business Document">
					    <el-upload
 						  :on-change="handleChangeClaimFile"
						  class="upload-demo"
						  ref="upload"
						  action="https://jsonplaceholder.typicode.com/posts/"
						  :auto-upload="false">
						  <el-button slot="trigger" size="small" type="primary">Browse files</el-button>
						</el-upload>
					</el-form-item>

					<el-form-item label="Valid ID">
					    <el-upload
					      v-loading="idFileLoading"
						  class="upload-demo"
						  ref="upload"
						  action="https://jsonplaceholder.typicode.com/posts/"
						  :on-change="handleChangeClaimID"
						  :auto-upload="false">
						  <el-button slot="trigger" size="small" type="primary">Browse files</el-button>
						</el-upload>
					</el-form-item>

		        </el-form>

		        <span slot="footer" class="dialog-footer">
				    <el-button @click="showClaimBusinessDialog = false">Cancel</el-button>
				    <el-button type="danger"  @click="submitClaimBusinessForm('claimBusinessForm')">Continue</el-button>
				  </span>
	    	</el-dialog>

	    	<store-details-add-business-form
	    		:business="business"
	    	>
	    		
	    	</store-details-add-business-form>

	  	</el-main>
  	</div>
</template>

<script>
import Compressor from 'compressorjs';

  export default {
    props:['img','businessData', 'storageRoute'],
    data() {
      	return {
      		// claim business
      		showClaimBusinessDialog: false,
      		claimBusinessLoading: false,
      		importClaimFileLoading: false,
      		idFileLoading: false,
      		claimBusinessForm: {
      			name: '',
      			number: '',
      			designation: '',
      			email: '',
      			documentFiles: [],
      			idFiles: [],
      			businessListID: this.businessData.id
      		},
      		claimBusinessRules: {
	          name: [
	            { required: true, message: 'Please input Contact name', trigger: 'blur' },	
	          ],
	          number: [
	            { required: true, message: 'Please input Contact number', trigger: 'blur' }
	          ],
	          designation: [
	            { required: true, message: 'Please input designation', trigger: 'blur' },	
	          ],
	          email: [
	            { required: true, message: 'Please input email', trigger: 'blur' },	
	            { type: 'email', message: 'Please input valid email address', trigger: ['blur', 'change'] }
	          ],
	        },

      		// claim business
      		// upload imgage & videos business review
      		importLoading: false,
      		importVideoLoading: false,
      		// upload imgage & videos business review
      		// add business
      		// showAddBusinessFormDialog: false,
      		addBusinessFormLoading: false,
      		// add business
      		tabModel 		: "announcements",
      		inputLocation: '' ,
      		business: this.businessData,
      		reviews: this.businessData.reviews,
      		reviewForm: {
      			imageFile: [],
      			videoFile: [],
      			reviewContent: '',
      			rating: 0,
      			businessListID: this.businessData.id,
      			userID: this.$userData.activeUserId,
      		},
      		
      		sendType: 'SMS',
      		contact: '',
      		userForm: {
      			email: '',
      			fname: '',
      			lname: ''
      		},
      		showRateDialog: false,
      		dialogVisible: false,
      		showOtp: false,
      		otp: null,
      		showLiveVideos: false,
      		dataBusiness : this.businessData,
	      	selectedNav: 'home',
	      	showHeader: false,
	        imgSrc: this.img,
	        showBack: true,
	        pageLoading : false,
	        liveVideos: [],
	        active: 0,
	        mostSearched: [],
     	}
    },
    created() {
      this.getLiveVideos();
      this.getMostSearched();
      // this.getStore();
      // console.log(this.$userData);
  	},
  	computed: {
  		score(){
  			return Number(this.business.business_rating);
  		},
  	},
    methods:{
    	handleChangeClaimID(file) {
    		console.log('claim')
    		var self = this;
	        self.idFileLoading = true;
	          // console.log(file, file.__ob__.value.raw)
	        var mime_type = file.raw.type;
	        console.log(mime_type)
	        if (mime_type == "image/png" || mime_type == "image/jpeg" || mime_type == "image/jpg") {
	            new Compressor(file.__ob__.value.raw, {
	                  quality: 0.3,
	                  beforeDraw(context, canvas){
	                    self.idFileLoading = true;
	                  },
	                  success(result) {
	                    const formData = new FormData();
	                    // console.log(self.fileList, 'res', result)
	                    formData.append('file', result, result.name);

	                    // Send the compressed image file to server with XMLHttpRequest.
	                    axios.post('/business-list/upload-business-claim-files', formData).then((res) => {
	                      console.log('Upload success', res);
	                      // self.businessLogo = '/storage'+res.data.imageFile.filePath
	                      self.idFileLoading = false;
	                      self.claimBusinessForm.idFiles.push({
	                        name: result.name,
	                        uid: file.uid,
	                        size: result.size,
	                        type: file.type,
	                        fileContents: result,
	                        show: false,
	                        filePath: res.data.file.filePath,
	                        url: res.data.file.filePath,
	                        show:  true,
	                        caption: null
	                      });
	                    });
	                  },
	                  error(err) {
	                    self.idFileLoading = false;
	                    self.$message.warning(`Error uploading image.`);
	                    console.log(err.message);
	                  },
	            });
	        } else {
	            this.$message.warning(`Please select valid file type.`);
	        }	
    	},
    	handleChangeClaimFile(file)
        {
          const isLt2M = file.size / 1024 / 1024 < 2;
          // const validTypes = ['video/mp4', 'video/webm', 'video/avi', 'video/mov', ] // include types to be accepted
          
          console.log(file);
          // this.progressPercentage = 0;
          this.importClaimFileLoading = true;

          const formData = new FormData();
            // console.log(self.fileList, 'res', result)
            formData.append('file', file.raw, file.name);

          axios.post('/business-list/upload-business-claim-files', formData).then((res) => {
	          console.log('Upload success', res);
	          // self.businessLogo = '/storage'+res.data.imageFile.filePath
	          this.importClaimFileLoading = false;
	          this.claimBusinessForm.documentFiles.push({
	            name: file.name,
	            uid: file.uid,
	            size: file.size,
	            type: 'file',
	            fileContents: file.raw,
	            show: false,
	            filePath: res.data.file.filePath,
	            url: res.data.file.filePath,
	            show:  true,
	            caption: null
	          });
	        });                      

        },
    	submitClaimBusinessForm(formName) {
    		this.$refs[formName].validate((valid) => {
	          if (valid) {
	            if (this.claimBusinessForm.documentFiles.length < 1) {
	            	this.$message.warning(`Please upload business document.`);
	            	return false;
	            }

				if (this.claimBusinessForm.idFiles.length < 1) {
	            	this.$message.warning(`Please upload valid ID.`);
	            	return false;
	            }

	            this.claimBusinessLoading = true;
	            this.$API.BusinessList.saveBusinessClaim(this.claimBusinessForm)
			    .then(result => {
			          console.log(result)

			          if (res.data.success) {
			          	this.showClaimBusinessDialog = false;
				        this.resetClaimBusinessForm();

				        this.$notify({
		                    title: "Success",
		                    message: "Claim request has been saved.",
		                    type: "success"
		                });
			          } else {
			          	this.$notify({
		                    title: "Error",
		                    message: "Claim request failed.",
		                    type: "error"
		                });
			          }

			        
			        this.claimBusinessLoading = false;
			          
			    })
		        .catch(err => {
		        	this.claimBusinessLoading = false;
		            console.log('Error!', err)
		        })


	          } else {
	            console.log('error submit!!');
	            return false;
	          }
	        });
    	},
    	resetClaimBusinessForm() {
    		this.claimBusinessForm = {
      			name: '',
      			number: '',
      			designation: '',
      			email: '',
      			documentFiles: [],
      			idFiles: [],
      			businessListID: this.businessData.id
      		}
    	},
    	openClamBusinessDialog() {
    		this.showClaimBusinessDialog = true;
    	},
        handleChangeVideo(file)
        {
          const isLt2M = file.size / 1024 / 1024 < 2;
          const validTypes = ['video/mp4', 'video/webm', 'video/avi', 'video/mov', ] // include types to be accepted
          
          console.log(file);
          if(this.reviewForm.videoFile.some(f => f.name === file.name && f.size === file.size)) {
            this.$message.warning(`Video ${file.name} is already on the list.`);
            return false;
          }

          if (!validTypes.includes(file.raw.type)) {
            this.$message.warning(`Invalid file type!`);
            return false;
          }
          // this.progressPercentage = 0;
          this.importVideoLoading = true;

          const formData = new FormData();
            // console.log(self.fileList, 'res', result)
            formData.append('file', file.raw, file.name);

          axios.post('/business-list/upload-business-banners', formData).then((res) => {
	          console.log('Upload success', res);
	          // self.businessLogo = '/storage'+res.data.imageFile.filePath
	          this.importVideoLoading = false;
	          this.reviewForm.videoFile.push({
	            name: file.name,
	            uid: file.uid,
	            size: file.size,
	            type: 'video',
	            fileContents: file.raw,
	            show: false,
	            filePath: res.data.imageFile.filePath,
	            url: res.data.imageFile.filePath,
	            show:  true,
	            caption: null
	          });
	        });                      

        },
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
                      // self.businessLogo = '/storage'+res.data.imageFile.filePath
                      self.importLoading = false;
                      self.reviewForm.imageFile.push({
                        name: result.name,
                        uid: file.uid,
                        size: result.size,
                        type: file.type,
                        fileContents: result,
                        show: false,
                        filePath: res.data.imageFile.filePath,
                        url: res.data.imageFile.filePath,
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
    	showAddBusinessFormDialog() {
    		this.$EventDispatcher.fire('SHOW_ADD_BUSINESS_DIALOG');
    	},
    	handleSelect(item) {
        	console.log(item);
      	},
   		querySearch(queryString, cb) {
        	// console.log(cb);
        	var results = queryString ? this.mostSearched.filter(this.createFilter(queryString)) : this.mostSearched;
        	// call callback function to return suggestions
	        cb(results);
	    },
	    createFilter(queryString) {
	        return (link) => {
	          return (link.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
	        };
	    },
	    getMostSearched() {
        this.$API.Home.getMostSearchedList()
        .then(result => {
          console.log(result)
          this.mostSearched = result.data.mostSearched
        })
        .catch(err => {
            console.log('Error!', err)
        })
      },
    	handleClickNav(nav){
    		this.selectedNav = nav
    		if (nav == 'livevideos') {
    			this.showLiveVideos = true
    		} else {
    			this.showLiveVideos = false
    		}
    	},
    	getStore() {
    		let params = {
    			id: this.businessData.id
    		};

    		this.$API.BusinessList.getBusiness(params)
	        .then(result => {     
	        	// console.log(result.data);   
	          this.business = result.data.businessData
	          this.reviews = result.data.businessData.reviews
	        })
	        .catch(err => {
	            console.log('Error!', err)
	        })
    	},
    	saveReview() {
    		this.pageLoading = true;
			this.$API.Review.saveReview(this.reviewForm)
		        .then(result => {        
		          this.$notify({
	                    title: "Success",
	                    message: "Review has been saved.",
	                    type: "success"
	                });
		          this.getStore()
		          this.resetReviewForm()
		          // this.reviews.push(result.data.review);
		        })
		        .catch(err => {
		            console.log('Error!', err)
		        })
		        .finally(_ => {
		          this.resetReviewForm();
		          this.pageLoading = false
		        })
    	},
    	resetReviewForm() {
    		this.reviewForm = {
    			imageFile: [],
    			videoFile: [],
    			reviewContent: '',
      			rating: 0,
      			businessListID: this.businessData.id,
      			userID: this.$userData.activeUserId,
    		},

    		this.showRateDialog = false;
    	},
    	handleShowRateDialog() {
    		if (!this.$userData.activeUserId > 0) {
    			this.$notify({
                    title: "Error",
                    message: "You must be logged in to continue.",
                    type: "error"
                });

                return;
    		}

    		this.showRateDialog = true;
    	},
    	handleClose() {
    		this.dialogVisible = false;
    		this.active = 0;
    		this.userForm.email = '';
    		this.userForm.fname = '';
    		this.userForm.lname = '';
    		this.contact = '';
    		this.otp = null;
    		this.showOtp = false;
    	},
    	handleContinue() {
    		if (this.active < 3) {

    			if (this.active == 1) {
	    			if (this.userForm.email == '' || this.userForm.fname == '' || this.userForm.lname == '') {
		                this.$notify({
		                    title: "Error",
		                    message: "Please complete the form.",
		                    type: "error"
		                });

		                return;
	    			}
	    		}

	    		if (this.active == 2) {
	    			if (this.contact == '') {
		                this.$notify({
		                    title: "Error",
		                    message: "Please provide contact number.",
		                    type: "error"
		                });

		                return;
	    			} else {
	    				// this.$notify({
		       //              title: "Success",
		       //              message: "Success.",
		       //              type: "success"
		       //          });
		       			this.showOtp = true;
		                return;
	    			}
	    		}



    			this.active += 1
    		}

    		 else {

    		}
    	},
    	handleBack() {
    		if (this.active > 0) {
    			this.active -= 1
    		}
    	},
    	getLiveVideos(){
	        let params = {
	              id : this.dataBusiness.id,
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
	      },

    	getPrimaryPhoto(imageList){
    		let banner = imageList.filter(image => image.is_primary == 1)
    		if(banner){
    			return banner[0].mediaPath;
    		}
    	},
    	timeToDecimal(t) {
		    var arr = t.split(':');
		    var dec = parseInt((arr[1]/6)*10, 10);

		    return parseFloat(parseInt(arr[0], 10) + '.' + (dec<10?'0':'') + dec);
		},
    	checkIfStoreIsOpen(){
    		var now = new Date();
			var dayOfWeek = now.getDay();
    		var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

 			var dayname = days[dayOfWeek];
 			var currentOperation = this.businessData.business_operations.filter( operation => operation.day == dayname)[0];
 			if(currentOperation) {
 				console.log(currentOperation)
 				if (now.getHours() > this.timeToDecimal(currentOperation.from) && now.getHours() <  this.timeToDecimal(currentOperation.to) ) {
			      //it's in schedule
 					return "Open"
			   }
 			}
			return "Closed"

    	},
    	markBookmark(featured){
	    	let params = { 
	        	'businessListID' : featured.id
	        };

	        this.pageLoading = true;
	        this.$API.BusinessList.markBookmark(params)
	        .then(result => {
	        	let res = result.data
	        	if(res.success && res.data){
	        		let bookmark = res.data
	        		if(bookmark.deleted_at){
	        			this.dataBusiness.user_bookmark = null
	        		}
	        		else{
	        			this.dataBusiness.user_bookmark = res.data
	        		}
	        	}
	        })
	        .catch(err => {
	            console.log('Error!', err)
	            this.pageLoading = false
	        })
	        .finally(_ => {
	            this.pageLoading = false
	        })
	    }
    }
  }
</script>

<style>
	.el-card__body {
	    padding:0px !important;
	}

	#rateForm .el-rate__item {
		padding: 10px 15px;
	}

	#announcementCard .el-divider--horizontal {
		margin: 0px !important;
	}

	#claimForm .el-form-item__label {
		margin-top: 25px;
	}
</style>