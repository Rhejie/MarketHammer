<template>
	<div class="featured-business">	
		<el-card el-card class="el-card-store" shadow="never" v-for="featured in featuredBusinessList" :key="featured.id">
			<a :href="'/store/details/'+featured.id">
			<div class="featured-table-display">
				<div class="featured-img">
					<img :src="getPrimaryPhoto(featured.business_banners)" width="100" height="100">
				</div>
				<div class="featured-info">
			    	<div class="bold business-name">{{featured.businessName}}</div>
			    	<div class="row">
			    		<div class="col-6">
			    			<span><span v-html="getDistanceFromLatLonInKm(coords.lat,coords.lng,featured.business_address.latitude,featured.business_address.longitude)"></span>km</span>
			    		</div>
			    		<div class="col-6 text-right">
			    			<span>검색: <span v-html="featured.numberOfSearch ? featured.numberOfSearch:0"></span></span>
			    		</div>
			    		<div class="col-6">
			    			<span>{{featured.address}}</span>
			    		</div>
			    		<div class="col-6 text-right">
			    			<span><span v-html="featured.reviews.length"></span> Reviews</span>
			    		</div>
			    	</div>
			    	<div class="">
			    		<button class="btn btn-sm btn-outline-red">Request a Quote</button>
			    	</div>
				</div>

			</div>
			</a>
		</el-card>
	</div>
</template>

<script>
  export default {
  	props:['img'],
    data() {
      return {
      	plain: true,
      	showHeader: false,
      	featuredBusinessList: null,
      	coords: []
      }
    },
	computed: {
  	},
    methods: {
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
		}
    },
    mounted(){
    	let params = null
    	this.$API.BusinessList.getFeaturedBusinessList(params)
        .then(result => {
            console.log('result', result)
            this.featuredBusinessList = result.data.businessList.data
            this.coords = result.data.coords

        })
        .catch(err => {
            console.log('Error!', err)
        })
        .finally(_ => {
            this.pageLoading = false
        })
    }
    
   }
</script>