<template>
	<div class="featured-business pd-20" v-loading="">	
		<el-card el-card class="el-card-store" shadow="never" v-for="featured in businessList" :key="featured.id">
			<a :href="'/store/details/'+featured.id">
			<div class="featured-table-display">
				<div class="featured-img">
					<img :src="featured.business_banner.mediaPath" width="100" height="100">
				</div>
				<div class="featured-info">
			    	<div class="bold business-name">
			    		<div class="row">
			    			<div class="col-9">
			    				{{featured.businessName}}<br>{{featured.industry_type}}
			    			</div>
			    			<div class="col-3">
			    				<el-image
	            					v-if = "featured.user_bookmark == null"
							        style="width: 30px; height: 30px;"
							        class="clickable pull-right"
							        src="/image/bookmark_unpressed.png"
							        fit="fill">
	    						</el-image>
	    						<el-image
	            					v-else
							        style="width: 30px; height: 30px;"
							        class="clickable pull-right"
							        src="/image/bookmark_pressed.png"
							        fit="fill">
	    						</el-image>
			    			</div>
			    		</div>
			    	</div>
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
			    		<button class="btn btn-sm btn-outline-red">견적요청</button>
			    		<el-rate
							class="rate-no-pad pull-right"
							v-model="+Number(featured.rating).toFixed(2)"
							disabled
							:allow-half="true"
							show-score
							score-template="{value}"
							text-color="#ff9900">
						</el-rate>
			    	</div>
				</div>

			</div>
			</a>
		</el-card>
	</div>
</template>

<script>
export default {
  	props:['businessList', 'coords'],
    data() {
      return {
      	plain: true,
      	showHeader: false,
      	pageLoading: false,
      	lists: this.businessList
      }
    },
	computed: {
  	},
    methods: {
		getPrimaryPhoto(imageList){
			if (imageList) {
				let banner = imageList.filter(image => image.is_primary == 1)
				if(banner.length >0){
					return banner[0].mediaPath;
				}
				return ''
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
	created() {
		console.log(this.businessList);
	},
	mounted(){
		
		let params = {
			'user_lat' : this.$userData.coords.latitude,
			'user_long' : this.$userData.coords.longitude
		}
    }
    
}
</script>