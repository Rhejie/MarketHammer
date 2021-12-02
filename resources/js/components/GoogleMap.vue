<template>
	<div class="row">
		<div class = "col-md-12">
			<gmap-map :center="center" :zoom="16"  :style="{'width': '100%', 'height': minHeight}" id = "mapTimeclock" @click='clickMap' >
				
			    <gmap-marker v-for="(m, index) in markers" :key="index"  
			    	:position="m.position" 
			    	:clickable="markers.clickable ? markers.clickable : true" 
			    	:draggable="markers.draggable ? markers.draggable : true" 
			    	:icon="m.icon"
			    	@click="center=m.position; clickMarker()" >
			    </gmap-marker>
			</gmap-map>
		</div>
		<div class = "col-md-12 mt-3" v-if = "showAction">
			<el-form status-icon ref="mapDataForm" id="mapDataForm" v-model="mapData" class="demo-ruleForm">
				<el-row>
					<el-col :span="12">
						<div class="col-sm-12">
							<el-form-item :label="('Location Latitude')" prop="lat">
								<el-input v-model="mapData.lat" type="number" data-label="lat" disabled></el-input>
							</el-form-item>
						</div>
					</el-col>
					<el-col :span="12">
						<div class="col-sm-12">
							<el-form-item :label="('Location Longitude')" prop="lng">
								<el-input v-model="mapData.lng" type="number" data-label="lng" disabled></el-input>
							</el-form-item>
						</div>
					</el-col>
				</el-row>
			</el-form>
			<div class="text-right">
				<el-button @click = "proceedMap()" type = "danger" class = "btn-red" > {{ 'Okay' }} </el-button>
			</div>
		</div>
	</div>
</template>
<script>
import Vue from 'vue'
import Noty from 'noty'

import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
	installComponents: true,
	load: {
		key: 'AIzaSyBDnVI0ZD7ZOgERSGxF8LKPLceUJDe4t8A',
		//key: process.env.MIX_GOOGLE_API_KEY,
		libraries: 'places'
	}
});

import _forEach from 'lodash/forEach'
import cloneDeep from 'lodash/cloneDeep'


export default {
	props: {
        pageData : {
            required: false
        }
    },
	data(){
		let markers = []
		_forEach(this.pageData.markers, mk => {
			mk.position.lat = Number(mk.position.lat)
			mk.position.lng = Number(mk.position.lng)
			markers.push(mk)
		})
		return {
			center				: {lat: 0.0, lng: 0.0},
			markers				: markers,
          	infoOptions			: { pixelOffset: { width: 0, height: -35 } },
          	minHeight 			: this.pageData && this.pageData.height ? this.pageData.height : "500px",
          	mapClickable 		: this.pageData.mapClickable != undefined ? this.pageData.mapClickable : false,
          	mapData 			: {lat: 0.0, lng: 0.0},
          	showAction 			: this.pageData.showAction != undefined ? this.pageData.showAction : false,
		}
	},
	created() {
		this.setMap()
	},
	mounted(){
		/*marker.addListener("click", () => {
		    map.setZoom(8);
		    map.setCenter(marker.getPosition() as google.maps.LatLng);
		});*/

	},
	methods: {	
		setMap(){
			let markCenter = {lat: 0.0, lng: 0.0}
			if(this.markers && this.markers.length > 0){
				_forEach(this.markers, mk => {
					markCenter = {lat: mk.position.lat, lng: mk.position.lng}
				})
			}
			else{
				let pos = { position: markCenter, icon : "/image/map_pin.png"}
				this.markers.push(pos)
			}
			this.mapData.lat = markCenter.lat
			this.mapData.lng = markCenter.lat
			
			this.center = markCenter
		},
		clickMarker(){
			console.log('clickMarker')
		},
		clickMap(event){

			if(this.mapClickable){
				let lat = event.latLng.lat()
				let lng = event.latLng.lng()
				if(this.markers.length > 0){
					let pos = {lat: lat, lng: lng}
					this.markers[0].position = pos
				}
				else{
					let pos = { position: {lat: lat, lng: lng}, icon : "/image/map_pin.png"}
					this.markers.push(pos)
				}

				this.mapData.lat = lat
				this.mapData.lng = lng
			}
		},
		proceedMap(){
			console.log('proceedMap')
			let data = {
				lat : this.mapData.lat,
				lng : this.mapData.lng
			}
			this.$EventDispatcher.fire('GOOGLEMAP_PROCEED', data)
		}
	},
	watch:{
        'pageData.markers': function(newVal){
        	console.log('newVal', newVal)
        	let markers = []
			_forEach(newVal, mk => {
				mk.position.lat = Number(mk.position.lat)
				mk.position.lng = Number(mk.position.lng)
				markers.push(mk)
			})
        	this.markers = markers
            this.setMap()
        }
    }
}
</script>