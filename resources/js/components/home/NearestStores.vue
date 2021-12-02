<template>
<!-- 	<div class="featured-business scrollable" v-loading="pageLoading">	
		<div class="row" style="flex-wrap: nowrap !important;padding:5px;">
			<div class="col-3" v-for="featured in featuredBusinessList" :key="featured.id" style="margin:5px;padding:5px 0px;max-width:250px;">
				<el-card el-card class="el-card-store" shadow="never" style="padding:5px;height: 260px;">
					<a :href="'/store/details/'+featured.id">
						<span class="bold business-name">{{featured.businessName}}</span><div class = "nearest-business-bookmark" :style="{'background-image': 'url(/image/bookmark_pressed.png)'}"></div><br>
						<img :src="getPath(featured.business_banner)" style="width:100%;" height="100"><br>
						<div class="row">
							<div class="col-6">
								<span><span v-html="getDistanceFromLatLonInKm(coords.lat,coords.lng,featured.business_address.latitude,featured.business_address.longitude)"></span>km</span><br>
								<span>{{featured.address}}</span>
							</div>
							<div class="col-6">
								<span class="pull-right">{{ +Number(featured.business_rating).toFixed(2) }}/5 ( {{featured.reviews.length}} Reviews)</span>
								<br>
								<el-rate
									style="float: right !important;"
								  v-model="featured.business_rating"
								  disabled
								  :allow-half="true"
								  text-color="#ff9900">
							</el-rate>
							</div>
							
						</div>
					</a>
				</el-card>
			</div>
		</div>
	</div> -->

	<div class="featured-store" v-loading="pageLoading">
		<!-- mobile view -->
      	<div class="hidden-sm-and-up carousel-container-mobile">
	        <el-carousel indicator-position="outside" :interval="0" height="180">
	          <el-carousel-item v-for="featured in featuredBusinessList" :key="featured.id">
	            <el-card class="el-card-store" shadow="never">
					<a :href="'/store/details/'+featured.id">
						<span class="bold business-name">{{featured.businessName}}</span><div class = "nearest-business-bookmark" :style="{'background-image': 'url(/image/bookmark_pressed.png)'}"></div><br>
						<img :src="getPath(featured.business_banner)" style="width:100%;" height="100"><br>
						<div class="row">
							<div class="col-6">
								<span><span v-html="getDistanceFromLatLonInKm(coords.lat,coords.lng,featured.business_address.latitude,featured.business_address.longitude)"></span>km</span><br>
								<span>{{featured.address}}</span>
							</div>
							<div class="col-6">
								<span class="pull-right">{{ +Number(featured.business_rating).toFixed(2) }}/5 ( {{featured.reviews.length}} Reviews)</span>
								<br>
								<el-rate
									style="float: right !important;"
								  v-model="featured.business_rating"
								  disabled
								  :allow-half="true"
								  text-color="#ff9900">
							</el-rate>
							</div>
							
						</div>
					</a>
				</el-card>
	          </el-carousel-item>
	        </el-carousel>
	    </div>

	    <!-- web view -->
      	<div class="hidden-xs-only carousel-container">
	        <el-carousel indicator-position="outside" :interval="0" height="180">
	          <el-carousel-item v-for="i in Math.ceil(featuredBusinessList.length / 4)" :key="i">
	          	<el-row>
              		<el-col :sm="6" class="hidden-xs-only" :key="featured.id" v-for="featured in featuredBusinessList.slice((i - 1) * 4, i * 4)"> 
			            <el-card class="el-card-store" shadow="never">
							<a :href="'/store/details/'+featured.id">
								<span class="bold business-name">{{featured.businessName}}</span><div class = "nearest-business-bookmark" :style="{'background-image': 'url(/image/bookmark_pressed.png)'}"></div><br>
								<img :src="getPath(featured.business_banner)" style="width:100%;" height="100"><br>
								<div class="row">
									<div class="col-6">
										<span><span v-html="getDistanceFromLatLonInKm(coords.lat,coords.lng,featured.business_address.latitude,featured.business_address.longitude)"></span>km</span><br>
										<span>{{featured.address}}</span>
									</div>
									<div class="col-6">
										<span class="pull-right">{{ +Number(featured.business_rating).toFixed(2) }}/5 ( {{featured.reviews.length}} Reviews)</span>
										<br>
										<el-rate
											style="float: right !important;"
										  v-model="featured.business_rating"
										  disabled
										  :allow-half="true"
										  text-color="#ff9900">
									</el-rate>
									</div>
									
								</div>
							</a>
						</el-card>
					</el-col>
				</el-row>
	          </el-carousel-item>
	        </el-carousel>
	    </div>
	</div>
		<!-- <store-card :businessList="featuredBusinessList" :coords="coords"></store-card> -->
</template>

<script>
  export default {
  	props:['img'],
    data() {
      return {
      	plain: true,
      	showHeader: false,
      	featuredBusinessList: [],
		coords: [],
		selectedCategory: null,
      	pageLoading: false,
      }
    },
	computed: {
  	},
    methods: {
    	getPath(imageList) {
    		return imageList ? imageList.mediaPath : '';
    	},
    	score(rate) {
    		return +Number(rate).toFixed(2);
    	},
    	getPrimaryPhoto(imageList){
    		let banner = imageList.filter(image => image.is_primary == 1)
    		if(banner){
    			return banner[0].mediaPath;
    		}
    	},
    	getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
		  	var R = 6371; // Radius of the earth in km
		  	var dLat = this.deg2rad(lat2-lat1);  // deg2rad below
		  	var dLon = this.deg2rad(lon2-lon1); 
		  	var a = 
		    Math.sin(dLat/2) * Math.sin(dLat/2) +
		    Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) * 
		    Math.sin(dLon/2) * Math.sin(dLon/2)
		    ; 
		  	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		  	var d = R * c; // Distance in km
		  	return d.toFixed(2);
		},
		deg2rad(deg) {
		  return deg * (Math.PI/180)
		},
		getStoresByCategory(category) {
	        let params = { 
	        	'category' : category,
	        	'user_lat' : this.$userData.coords.latitude,
    			'user_long' : this.$userData.coords.longitude
	        };
	        this.pageLoading = true;
	        this.$API.BusinessList.getNearestStores(params)
		        .then(result => {
		            // console.log('result', result)
		            this.featuredBusinessList = result.data.businessList.data
		            this.coords = result.data.coords
		            this.pageLoading = false;
		        })
		        .catch(err => {
		            console.log('Error!', err)
		            this.pageLoading = false
		        })
		        .finally(_ => {
		            this.pageLoading = false
		        })
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
	        			featured.user_bookmark = null
	        		}
	        		else{
	        			featured.user_bookmark = res.data
	        		}
	        		let fndIndex = this.featuredBusinessList.findIndex( fn => { return Number(fn.id) == Number(featured.id)})
	        		if(fndIndex >= 0){
	        			this.featuredBusinessList.splice(fndIndex, 1, featured)
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
    },
    created() {
      this.$EventDispatcher.listen('CATEGORY_SELECTED', category => {
		   console.log(`from cat: ${category}`)
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