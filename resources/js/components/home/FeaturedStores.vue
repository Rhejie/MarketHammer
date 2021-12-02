<template>
  <div class="featured-store m-bt-10" v-loading="loading">
      <!-- mobile view -->
      <div class="hidden-sm-and-up carousel-container-mobile">
        <el-carousel indicator-position="outside" :interval="interval" height="180">
          <el-carousel-item v-for="item in featuredStores" :key="item.id">
            <el-card class="box-card">
              <img :src="getPath(item.business_banners)" class="carousel-image">
                <div class="mg-t-10">
                  <el-row :gutter="10">
                    <el-col :span="12">
                      <button class="btn btn-sm br-0 btn-flat btn-danger btn-block pull-left">전화연결</button>
                    </el-col>
                    <el-col :span="12">
                      <button class="btn btn-sm br-0 btn-outline-red btn-block pull-right">도움요청</button>
                    </el-col>
                  </el-row>
                </div>
            </el-card>
          </el-carousel-item>
        </el-carousel>
      </div>

      <!-- web view -->
      <div class="hidden-xs-only carousel-container">
        <el-carousel indicator-position="outside" :interval="interval" height="180">
          <el-carousel-item v-for="i in Math.ceil(featuredStores.length / 4)" :key="i"> <!-- loop items by 4 -->
            <el-row>
              <el-col :sm="6" class="hidden-xs-only" :key="item.id" v-for="item in featuredStores.slice((i - 1) * 4, i * 4)"> 
                <el-card class="box-card">
                  <img :src="getPath(item.business_banners)" class="carousel-image">
                    <div class="mg-t-10">
                      <el-row>
                        <el-col :span="12" class="pd-r-5">
                          <button class="btn btn-sm br-0 btn-flat btn-danger btn-block pull-left">전화연결</button>
                        </el-col>
                        <el-col :span="12" class="pd-l-5">
                          <button class="btn btn-sm br-0 btn-outline-red btn-block pull-right">도움요청</button>
                        </el-col>
                      </el-row>
                    </div>
                </el-card>
              </el-col>
            </el-row>
          </el-carousel-item>
        </el-carousel>
      </div>

  </div>
</template>

<script>
  export default {
    props:['img'],
    data() {
      return {
        interval: 0,
      	plain: true,
        featuredStores: [],
        selectedCategory: null,
        loading : false
      };
    },
    methods: {
      getPath(imageList) {
        return imageList[0] ? imageList[0].mediaPath : '';
      },
      handleClick() {
        window.location.href = '/home/store-details';
      },
      getStoresByCategory(category) {
        let params = { 
          'category' : category, 
          'user_lat' : this.$userData.coords.latitude,
          'user_long' : this.$userData.coords.longitude
          };
        this.loading = true;
        this.$API.BusinessList.getFeaturedStores(params)
          .then(result => {
              // console.log('result', result)
              this.featuredStores = result.data.businessList.data
              this.coords = result.data.coords
              this.loading = false;
          })  
          .catch(err => {
              console.log('Error!', err)
              this.loading = false;
          })
          .finally(_ => {
              this.loading = false

          })
      }
    },
    computed:{
      featuredStoresChunks(){    
        return _lodash.chunk(Object.values(this.featuredStores), 4);
        // return Math.ceil(this.featuredStores.length / this.itemsPerRow);
      }
    },
    created() {
      this.$EventDispatcher.listen('CATEGORY_SELECTED', category => {
          this.selectedCategory = category
          this.getStoresByCategory(category)
      })

      this.$EventDispatcher.listen('GEOLOCATION_ENABLED', coords => {
          this.getStoresByCategory(this.selectedCategory)
      })
    },
    mounted(){

    }
  }
</script>

