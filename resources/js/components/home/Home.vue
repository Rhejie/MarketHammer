<template>
  <div>
    <!-- <el-header>
      <home-header :headertitle="title" :showback="showBack"></home-header>
    </el-header>
 -->
    <el-main>
        <!-- <el-image
          style="width: 50px; height: 50px;overflow: unset !important;"
          src="/image/no_image.png"
          fit="fill">
        </el-image> -->
        <div class="hero-section">
          <h4 class="title">Lorem Ipsum</h4><br>
          <span class="subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
          <el-autocomplete
            class="inline-input search-input"
            v-model="inputLocation"
            :fetch-suggestions="querySearch"
            placeholder="Type your keywords for matching"
            @select="handleSelect"
          >
            <el-button slot="append" icon="el-icon-search" class="search-button"> Search </el-button> 
          </el-autocomplete>
        </div>
        <img style="width: 100%;" src="/image/homepage_section_images/section1_img.png">
        <img style="width: 100%;" src="/image/homepage_section_images/section2_img.png">
        <img style="width: 100%;" src="/image/homepage_section_images/section3_img.png">

      <!-- <div class="pd-50">
        <div class="mg-t-30">
          <div class="row">
            <div class="col-5">
              <categories></categories>
            </div>
            <div class="col-7">
              <el-container>
                <home-events :img="img"></home-events>
              </el-container>
            </div>
          </div>
        </div>

        <div class="mg-t-30">
          <h4>Featured Businesses</h4>
          <featured-stores :img="featuredStore"></featured-stores>
        </div>

        <div class="mg-t-30">
          <center>
            <h4>Recent Activity</h4>
          </center>

          <el-tabs type="card" v-model = "tabModel">
            <el-tab-pane label="Nearby" name="Nearby">
              <div class="row">
                <div class="col-12">
                  <div class="info-container">
                    <nearest-stores></nearest-stores>
                  </div>
                </div>
              </div>
            </el-tab-pane>
            <el-tab-pane label="Following" name="Following">
            </el-tab-pane>
          </el-tabs>
        </div>

      </div> -->
    </el-main>

 <!--    <div class="footer-nav" style="padding: 10px 100px;background-color: #ececec;">
      <div class="row">
        <div class="col-3">
          <span class="clickable">About Durio</span><br>
          <span class="clickable">Privacy Policy</span><br>
          <span class="clickable">Terms & Conditions</span><br>
        </div>
        <div class="col-3">
          <h4>Follow us</h4>

          <el-image
            style="width: 20px; height: 20px;overflow: unset !important;"
            src="/image/fblogo.png"
            fit="fill">
          </el-image>
          <span>Facebook</span><br><br>

          <el-image
            style="width: 20px; height: 20px;overflow: unset !important;"
            src="/image/ig.png"
            fit="fill">
          </el-image>
          <span>Instagram</span><br><br>

          <el-image
            style="width: 20px; height: 20px;overflow: unset !important;"
            src="/image/twitter.png"
            fit="fill">
          </el-image>
          <span>Twitter</span><br><br>

          <el-image
            style="width: 20px; height: 20px;overflow: unset !important;"
            src="/image/link.png"
            fit="fill">
          </el-image>
          <span>Linkedin</span><br><br>

        </div>
        <div class="col-4">
          <h4>Durio Download</h4>
          <a rel='nofollow' href='http://davao.durio.info' border='0' style='cursor:default'><img src='https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2Fdavao.durio.info%2F&chs=180x180&choe=UTF-8&chld=L|2' alt=''></a>
        </div>
        <div class="col-2">
          <span class="clickable">Customer Service</span><br>
          <span class="clickable">Help Center</span><br>
          <span class="clickable">Contact Us</span><br>
        </div>
      </div>
    </div>
 -->

        <!-- <el-main>
          <el-container>
            <home-events :img="img"></home-events>
          </el-container> 

          <categories></categories>

          <el-input 
            :disabled="currentLocationIsActive"
            class="home-location-input"
            placeholder="Type location"
            v-model="inputLocation">
            <i slot="prefix" class="el-input__icon el-icon-location" :class="{ 'location-active': currentLocationIsActive}" @click="currentLocationIsActive = !currentLocationIsActive"></i>
          </el-input>
          <featured-stores :img="featuredStore"></featured-stores>
          <nearest-stores></nearest-stores>
      
        </el-main> -->
    <!-- <footer-nav :selectedNav="selectedNav" :coordinates="coordinates" :searchTags="searchTags"></footer-nav> -->
  </div>
</template>

<style>
  .icon {
    color: #EC3434;
  }

  .el-autocomplete {
    width: 400px !important;
  }
</style>

<script>
  export default {
    props:['img', 'searchTags'],
    data() {
      return {
        tabModel: 'Nearby',
        mostSearched: [],
        title: 'Market Hammer',
        selectedNav: 'home',
        showHeader: false,
        showBack: false,
        inputLocation: '' ,
        currentLocationIsActive: true,
        featuredStore: `${window.location.origin}/image/featured-stores.png`,
        events: [
          {
            id: 1,
            image: this.img
          },
          {
            id: 2,
            image: this.img
          },
          {
            id: 3,
            image: this.img
          }
        ],
        coordinates: {
          lat: this.$userData.coords.latitude,
          lng: this.$userData.coords.longitude
        }
      };
    },
    created(){
      this.getMostSearched();
    },
    computed: {
      showFooter() {
        return this.selectedNav == 'home' || this.selectedNav == 'My Page';
      }
    },
    watch:{
      currentLocationIsActive: function(){
        if(this.currentLocationIsActive == true){
          this.locatorButtonPressed()
        }
      }
    },
    methods: {
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
      handleSelect(item) {
        console.log(item);
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
      // getLiveVideos(){

      //     this.pageLoading = true;
      //     this.$API.LiveVideo.getAllLiveVideos()
      //     .then(result => {        
      //       let res = result.data
      //       // console.log(res.businessData)
      //       this.liveVideos = res.streams
      //     })
      //     .catch(err => {
      //         console.log('Error!', err)
      //     })
      //     .finally(_ => {
      //       this.pageLoading = false
      //     })
      //   },
      locatorButtonPressed() {
        navigator.geolocation.getCurrentPosition(
          position => {
            console.log(position.coords.latitude);
            console.log(position.coords.longitude);
            this.$userData.coords.latitude = position.coords.latitude
            this.$userData.coords.longitude = position.coords.longitude

            this.getStreetAddressFrom(position.coords.latitude, position.coords.longitude)
            this.$EventDispatcher.fire('GEOLOCATION_ENABLED', position.coords)
            
          },
          error => {
            console.log(error.message);
          },
        )   
      },
      async getStreetAddressFrom(lat, long) {
        try {
          var { data } = await axios.get(
            "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +
              lat +
              "," +
              long +
              "&key=AIzaSyAqfFi_oIedzfI8WZ2SVnY9FPfpBYHpvxs");
          if(data.error_message) {
            console.log(data.error_message)
          } else {
            this.inputLocation = data.results[0].formatted_address;
          }
        } catch (error) {
          console.log(error.message);
        } 
      },
      handleRowClick(selectedLinkFromMyPage) {
        // console.log(selectedLinkFromMyPage)
        if (selectedLinkFromMyPage.label == 'Logout') {
          this.logout();
        } else {
          this.selectedNav = selectedLinkFromMyPage.label;
          this.$EventDispatcher.fire('MY_PAGE_NAVIGATION', selectedLinkFromMyPage.label)
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
    },
    mounted(){
      
      this.locatorButtonPressed()
    }
  }
</script>
