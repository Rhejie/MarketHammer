<template>
	<div>

	  <el-header>
	  	<header-nav :headertitle="selectedNav" :showback="showBack"></header-nav>
	  </el-header>

	  <el-main class="mg-b-0">
      <div class="pd-10">
        <div class="row">
          <div class="col-3 pd-r-0">
            <el-card shadow="never" style="height:100vh;" class="pd-10">
              <div class="row mg-l-0 mg-r-0">
                <el-image
                  style="width: 50px; height: 50px;"
                  class="pull-left"
                  :src="getUserImgPath"
                  fit="fill">
                </el-image>
                <h4 class="pull-left mg-l-5 mg-t-10">{{ user.firstName }}</h4>

              </div>

              <div class="mg-t-10">
                <el-table
                    :data="sideNavOptions"
                    :show-header="showHeader"
                    @row-click="handleRowClick"
                    class="full-width mg-t-5">
                    <el-table-column>
                      <template slot-scope="scope">
                        <i :class="scope.row.icon"> </i>
                        <span> {{ scope.row.val }} </span>
                    </template>
                    </el-table-column>
                </el-table>
              </div>

            </el-card>  
              
          </div>
          <div class="col-9">
            <el-card shadow="never">
              <div class="row pd-10" v-if="activeNav == 'My Account'">
                <div class="col-9">
                  <h4 class="mg-b-10">My Account</h4>
                  <el-form ref="form" :model="form" label-width="120px" label-position="left" size="mini" class="user-form" v-loading="formLoading">
                    <el-form-item label="Name">
                      <el-input v-model="user.firstName"></el-input>
                    </el-form-item>
                    <el-form-item label="Email">
                      <el-input v-model="user.email"></el-input>
                    </el-form-item>
                    <el-form-item label="Password">
                      <el-input v-model="dummyPassword" type="password" :readonly="true" @focus="handleChangePassword"></el-input>
                    </el-form-item>
                    <el-form-item label="Phone Number">
                      <el-input v-model="user.phone"></el-input>
                    </el-form-item>
                    <el-form-item label="Birthday">
                      <el-date-picker type="date" placeholder="Birthday" v-model="user.birthDay" style="width: 100%;"></el-date-picker>
                    </el-form-item>
                    <el-form-item label="Country">
                      <!-- <el-input v-model="formUserAddress.countryID"></el-input> -->
                      <el-select v-model="formUserAddress.countryID" filterable placeholder="Select country" class="full-width">
                        <el-option
                          v-for="item in countries"
                          :key="item.id"
                          :label="item.name"
                          :value="item.id">
                        </el-option>
                      </el-select>
                    </el-form-item>
                    <el-form-item label="State">
                      <el-input v-model="formUserAddress.state"></el-input>
                    </el-form-item>
                    <el-form-item label="Region">
                      <el-input v-model="formUserAddress.region"></el-input>
                    </el-form-item>
                    <el-form-item label="City">
                      <el-input v-model="formUserAddress.city"></el-input>
                    </el-form-item>
                    <el-form-item label="Barangay">
                      <el-input v-model="formUserAddress.brgy"></el-input>
                    </el-form-item>
                    <el-form-item label="Bldg, street, etc.">
                      <el-input v-model="formUserAddress.street"></el-input>
                    </el-form-item>
                    <el-form-item>
                      <el-button type="primary" @click="saveProfile">Save</el-button>
                    </el-form-item>
                  </el-form>
                </div>
                <div class="col-3 pd-10">
                  <center>
                    <el-image
                      class="mg-t-10"
                      style="width: 100px; height: 100px;overflow: unset !important;"
                      :src="getUserImgPath"
                      fit="fill">
                    </el-image>

                    <el-upload
                      class="upload-demo mg-t-10"
                      ref="upload"
                      v-loading="importLoading"
                      :show-file-list="false"
                      :on-change="handleChange"
                      action="https://jsonplaceholder.typicode.com/posts/"
                      :auto-upload="false">
                      <el-button slot="trigger" size="small" type="primary">Select image</el-button>
                    </el-upload>
                  </center>
                </div>
              </div>

              <div class="row pd-10" v-if="activeNav == 'Event'">
                <div class="col-12 pd-r-l-50">
                  <h4 class="mg-b-10">My Event</h4>
                  <el-card shadow="never" v-for="event in user.events" class="pd-10 mg-b-10" :key="event.id">
                    {{ event.event.name }}
                  </el-card>
                </div>
              </div>

              <div class="row pd-10" v-if="activeNav == 'My Coupon'">
                <div class="col-12 pd-r-l-50">
                  <h4 class="mg-b-10">My Coupon</h4>

                  <el-tabs type="card" @tab-click="handleClick" v-model = "tabModel">
                    <el-tab-pane label="All" name="All">
                      <div class="row">
                        <div class="col-12">
                          <el-card shadow="never" v-for="coupon in user.coupons" class="pd-10 mg-b-10" :key="coupon.id">
                            <div class="row">
                              <div class="col-9">
                                <b>P{{ coupon.coupon.amount }}</b><br>
                                <span>{{ coupon.coupon.name }}</span><br>
                                <span>Code: {{ coupon.coupon.code }}</span><br>
                                <span>Valid Until: {{ coupon.coupon.expiry }}</span><br>
                              </div>
                              <div class="col-3 pull-right pd-r-5">
                                <el-button size="medium">Claim now <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                              </div>
                            </div>
                          </el-card>
                        </div>
                      </div>
                    </el-tab-pane>
                    <el-tab-pane label="Platform" name="Platform">
                    </el-tab-pane>
                    <el-tab-pane label="Store" name="Store">
                    </el-tab-pane>
                  </el-tabs>

                </div>
              </div>

            </el-card>
          </div>
        </div>
      </div>

      <el-dialog
          title="Change Password"
          :visible.sync="showChangePassDialog"
          width="45%"
          :close-on-click-modal="false"
          :close-on-press-escape="false"
          :before-close="handleCloseChangePass">

          <el-form label-position="top" label-width="100px" :model="changePassform" size="small" ref="changePassform" :rules="rules">
            <el-form-item label="Old Password" prop="oldPassword">
              <el-input v-model="changePassform.oldPassword" type="password" :show-password="true"></el-input>
            </el-form-item>
            <el-form-item label="New Password" prop="password">
              <el-input v-model="changePassform.password" type="password" :show-password="true"></el-input>
            </el-form-item>
            <el-form-item label="Confirm Password" prop="confirmPassword">
              <el-input v-model="changePassform.confirmPassword" type="password" :show-password="true"></el-input>
            </el-form-item>
          </el-form>

          <span slot="footer" class="dialog-footer">
            <el-button @click="handleCloseChangePass"size="mini">Cancel</el-button>
            <el-button type="primary" size="mini" @click="submitForm('changePassform')">Confirm</el-button>
          </span>
        </el-dialog>

<!--   		<el-card shadow="never" class="my-page">
  	  		<el-row :gutter="24">
  		  		<el-col :span="24">
  			    	<el-image
                      @click = "showProfileUpload()"
  				      class="profile-pic"
  				      :src="imgSrc"
  				      fit="fit">
  			    	</el-image>
  			    	<div class="profile-details">
                        <span>{{ userFullName }}</span><br>
                        <span class="text-disabled" v-if="loggedinuser.userAddressID != null">{{ userAddress }}</span>
                    </div>
  				</el-col>
  			</el-row>
  		</el-card>
  		<el-table
  	      :data="tableData"
  	      :show-header="showHeader"
  	      @row-click="handleRowClick"
  	      class="full-width mg-t-5">
  	      <el-table-column>
  	        <template slot-scope="scope">
  		        <i :class="scope.row.icon"> </i>
  		        <span> {{ scope.row.val }} </span>
  		    </template>
  	      </el-table-column>
	    </el-table> -->

	  </el-main>

	  
	<!-- 	<footer-nav
			:selectedNav="selectedNav"
		>
		</footer-nav> -->

	</div>	
</template>

<style>

</style>

<script>
  import Compressor from 'compressorjs';

  export default {
    props:['img', 'loggedinuser', 'storageRoute'],
    data() {
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          // callback(new Error('Please input the password again'));
        } else if (value !== this.changePassform.password) {
          callback(new Error('Doesn\'t match password field'));
        } else {
          callback();
        }
      };
      return {
        tabModel: 'All',
        // change pass
        showChangePassDialog: false,
        changePassLoading: false,
        changePassform: {
          oldPassword: '',
          password: '',
          confirmPassword: ''
        },
        rules: {
          oldPassword: [
            { required: true, message: 'Please input old password ', trigger: 'blur' }
          ],
          password: [
            { required: true, message: 'Please input Password ', trigger: 'blur' },
            { min: 5, message: 'Password length should be less than 5 characters', trigger: 'blur' }
            // { validator: validatePass, trigger: 'blur' }
          ],
          confirmPassword: [
            { required: true, message: 'Please input confirm password ', trigger: 'blur' },
            { validator: validatePass2, trigger: 'blur' }
          ]
        },

        // change pass
        countries: [],
        formUserAddress: {
          countryID: null,
          state: null,
          city: null,
          zip: null,
          region: null,
          brgy: null,
          street: null
        },
        formLoading: false,
        importLoading: false,
        dummyPassword: 'dummy text',
        user: this.loggedinuser,
        file: {
          url: this.loggedinuser.imagePath != null ? this.storageRoute +'storage'+ this.loggedinuser.imagePath : '/image/no_image.png'
        },
        dialogImageUrl: '',
        dialogVisible: false,
        disabled: false,
        form: {
          name: null,
        },
        selectedNav: 'My Page',
      	activeNav: 'My Account',
      	showHeader: false,
        showBack: false,
        userFullName: this.getUserFullName,
        imgSrc: this.loggedinuser.imagePath != null ? this.storageRoute + this.loggedinuser.imagePath : '/image/no_image.png',
        userAddress: this.getUserAddress,
        sideNavOptions: [{
          icon: 'el-icon-user icon',
          label: 'My Account',
          val: 'My Account'
        },{
          icon: 'el-icon-discount icon',
          label: 'My Coupon',
          val: 'My Coupon'
        },{
          icon: 'el-icon-date icon',
          label: 'Event',
          val: 'Event'
        },{
          icon: 'el-icon-chat-dot-round icon',
          label: 'Messages',
          val: 'Messages'
        },],

        backofficeData: [{
          icon: 'el-icon-setting icon',
          label: 'Backoffice',
          val: 'Backoffice',
          href: '/backoffice/business-list'
        }],
        tableData: [{
          icon: 'el-icon-search icon',
          label: 'Search History',
          val: '검색기록',
          href: '/my-page/search-history'
        },{
          icon: 'el-icon-discount icon',
          label: 'My Coupon',
          val: '내 쿠폰',
          href: '/my-page/my-coupon'
        },{
          icon: 'el-icon-date icon',
          label: 'Event',
          val: '이벤트',
          href: '/my-page/event'
        },{
          icon: 'el-icon-chat-dot-square icon',
          label: 'Announcement',
          val: '공지사항',
          href: '/my-page/announcements'
        },{
          icon: 'el-icon-headset icon',
          label: 'Help',
          val: '도움요청',
          href: '/my-page/help'
        },{
          icon: 'el-icon-question icon',
          label: 'Q & A',
          val: 'Q & A',
          href: '/my-page/qna'
        },{
          icon: 'el-icon-chat-dot-round icon',
          label: 'Support Chat',
          val: '채팅문의',
          href: '/my-page/support-chat'
        },{
          icon: 'el-icon-remove-outline icon',
          label: 'Logout',
          val: '로그아웃',
        }]
      };
    },
    created(){
      console.log(this.$userData);
	    this.$EventDispatcher.listen('FOOTER_NAVIGATION', nav => {
	        this.selectedNav = nav
        });
        this.getLoggedInUser();
        this.getCountries();
        if(this.loggedinuser.user_type.is_admin == 1 || this.loggedinuser.user_type.is_encoder == 1) {
            // return this.tableData = this.tableData.concat(this.backofficeData)
            return this.sideNavOptions = this.sideNavOptions.concat(this.backofficeData)
        } else {
            return this.sideNavOptions = this.sideNavOptions
            // return this.tableData = this.tableData
        }


	},
	computed: {
    getUserImgPath() {
      return this.user.imagePath != null ? this.storageRoute +'storage'+ this.user.imagePath : '/image/no_image.png'
    },
    showFooter() {
      return this.selectedNav == 'home' || this.selectedNav == 'My Page';
    },
    getUserFullName() {
      if (this.loggedinuser.user_address.country) {
        return this.loggedinuser.user_address.country.id == 113 ? this.loggedinuser.lastName + ' ' + this.loggedinuser.firstName : this.loggedinuser.firstName + ' ' + this.loggedinuser.lastName
      } else {
        return '';
      }
    },
    getUserAddress() {
      if (this.loggedinuser.user_address.country) {
        return this.loggedinuser.user_address.street + ', ' + this.loggedinuser.user_address.city + ', ' + this.loggedinuser.user_address.state + ' ' + this.loggedinuser.user_address.zip + ', ' + this.loggedinuser.user_address.country.code ?? null
      } else {
        return '';
      }
    },
	},
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.changePassLoading = true;
          this.$API.Home.changePassword(this.changePassform)
            .then(result => {
                // console.log('result', result)
              if(result.data.success) {
                this.$notify({
                  title: "Success",
                  message: "Password has been changed!",
                  type: "success"
                });
                this.handleCloseChangePass()
              } else {
                if (result.data.msg != null) {
                  this.$notify({
                    title: "Error",
                    message: result.data.msg,
                    type: "error"
                  }); 
                } else {
                  this.$notify({
                    title: "Error",
                    message: "Change password failed!",
                    type: "error"
                  });
                }
                
              }


              this.changePassLoading = false;

            })
            .catch(err => {
              this.$notify({
                title: "Error",
                message: "Change password failed!",
                type: "error"
              });
              this.changePassLoading = false;
              console.log('Error!', err)
            })

        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    handleCloseChangePass() {
      this.showChangePassDialog = false;
      this.changePassform.password = '';
      this.changePassform.oldPassword = '';
      this.changePassform.confirmPassword = '';
    },
    handleChangePassword() {
      this.showChangePassDialog = true;
    },
    convert(str) {
      var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
      return [date.getFullYear(), mnth, day].join("-");
    },
    saveProfile() {
      if (this.user.firstName == null || this.user.firstName == '') {
        this.$notify({
            title: "Error",
            message: "Name is required!",
            type: "error"
        });

        return;
      }
      if (this.user.email == null || this.user.email == '') {
        this.$notify({
            title: "Error",
            message: "Email is required!",
            type: "error"
        });

        return;
      }

      if (this.formUserAddress.countryID == null || this.formUserAddress.state == null || this.formUserAddress.city == null || this.formUserAddress.street == null) {
        this.$notify({
            title: "Error",
            message: "Please complete address information!",
            type: "error"
        });

        return;
      }

      this.formLoading = true;
      this.user["user_address"] = this.formUserAddress;
      if (this.user.birthDay != null) {
        this.user["birthDay"] = this.convert(this.user.birthDay)
      }
      // console.log(this.user);
      this.$API.Home.saveProfile(this.user)
      .then(result => {
        console.log(result)
        if(result.data.success){
          this.$notify({
              title: "Success",
              message: "Profile has been saved.",
              type: "success"
          });
        } else {
          this.$notify({
              title: "Error",
              message: "Save profile failed.",
              type: "error"
          });
        }
        
        this.formLoading = false;
      }).catch(err => {
          this.$notify({
              title: "Error",
              message: "Save profile failed.",
              type: "error"
          });
          this.formLoading = false;
      })

    },
    getLoggedInUser() {
      console.log('a')
      let params = {
        id: this.$userData.activeUserId
      };
      
      this.$API.Home.getLoggedUser(params)
      .then(result => {
        this.user = result.data.user;
        if (result.data.user.user_address != null) {
          this.formUserAddress = result.data.user.user_address
        }
          // console.log('result', result)
      })
      .catch(err => {
          console.log('Error!', err)
      })
    },
    getCountries() {

      this.$API.Home.getCountries()
      .then(result => {
        this.countries = result.data.countries;
          // console.log('result', result)
      })
      .catch(err => {
          console.log('Error!', err)
      })
    },
    handleChange(file) {
      // console.log(file)
      
      var self = this;
      self.importLoading = true;
      // console.log(file, file.__ob__.value.raw)
      let mime_type = file.raw.type
      // var mime_type = "image/jpeg";        
      if (mime_type !== "image/jpeg" && mime_type !== "image/png" && mime_type !== "image/jpg") {
        self.$notify({
            title: "Error",
            message: "Invalid file type",
            type: "error"
        });

        return false;
      } else {
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
            axios.post('/home/user/upload-profile-picture', formData).then((res) => {
              console.log('Upload success', res);
              self.getLoggedInUser();
              self.importLoading = false;
              self.file.url = URL.createObjectURL(file.raw);
            });
          },error(err) {
              self.importLoading = false;
              self.$message.warning(`Error uploading image.`);
              console.log(err.message);
            },
        });
      }

    },
    handleRemove(file) {
      console.log(file);
    },
    showProfileUpload(){
  	},
  	handleRowClick(selectedLinkFromMyPage) {
  		if (selectedLinkFromMyPage.label == 'Logout') {
  			this.logout();
  		} else if(selectedLinkFromMyPage.label == 'Backoffice') {
        window.location.href = selectedLinkFromMyPage.href;
      }
      else {
  			this.activeNav = selectedLinkFromMyPage.label
  		}
  	},
  	logout(){
         axios.post('logout').then(response => {
            if (response.status === 302 || 401) {
              window.location.href = "/login";
            }
            else {
              console.log('logout error')
            }
          }).catch(error => {
          	console.log('logout error')
        	});
      },
    }
  }
</script>