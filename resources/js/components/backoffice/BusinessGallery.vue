<template>
	<div class = "gallery-container" v-loading = "pageLoading">
		<vue-gallery :images="imageList" :index="bannerIndex" @close="bannerIndex = null">
			
		</vue-gallery>
		<el-row :gutter = "20">
        	<el-col :span = "6" class = "mt-5">
        		<div
			      	class="upload-banner"
			      	@click = "showUploadBanner()"
			      	:style="{ backgroundImage: 'url(/image/camera_icon.png)'}"
			    >
			    </div>
			</el-col>
        	<el-col :span = "6" class = "mt-5" 
			    v-for="(image, imageIndex) in filteredBannerImages" 
			    :key="imageIndex">
			    <div
			      	class="gallery-image"
			      	@click="bannerIndex = imageIndex"
			      	:style="{ backgroundImage: 'url(' + getImagePath(image.filePath) + ')'}"
			    >
			    </div>
			    <div class = "mt-1">
				    <el-button v-if = "image.details && !image.details.is_primary" type="primary" size = "mini" @click="setAsPrimary(image)" > {{ 'Set as Primary' }}
                    </el-button>
				    <el-button type="primary" size = "mini" class="btn-red" @click="removeImg(image)" > {{ 'Remove' }}
                    </el-button>
                </div>
			</el-col>
		</el-row>
	</div>
</template>
<script>
import Vue from 'vue'
import Noty from 'noty'
import VueGallery from 'vue-gallery'
Vue.component('VueGallery', VueGallery)

import _forEach from 'lodash/forEach'
import cloneDeep from 'lodash/cloneDeep'

export default {
	props: {
		businessBanner : {
            required: true
        },
        pageData : {
            required: false
        }
    },
	data(){

		return {
			pageLoading 	: false,
			bannerImages 	: this.businessBanner,
			bannerIndex 	: null,
			showUpload 		: false
		}
	},
	created() {
	},
	computed:{
		imageList(){
			let img = []
			_forEach(this.bannerImages, bn => {
				img.push(bn.filePath)
			})

			return img
		},
		filteredBannerImages(){
            if (this.bannerImages != []) {
                return this.bannerImages.filter(banner => banner.details.type == 'image');
            } else {
                return [];
            }
            
        },

	},
	methods: {	
		getImagePath(filePath){
			let http = new XMLHttpRequest();

		    http.open('HEAD', filePath, false);
		    http.send();

		    let exist = http.status != 404;

			if (!exist) {
				return '/image/no_image.png';
			}

			return filePath;
		},
		setAsPrimary(banner){
			console.log('banner', banner)
			let params = {
				bannerID : banner.details.id,
				businessListID : banner.details.businessListID
			}
			this.pageLoading = true
			this.$API.BusinessList.setBannerPrimary(params)
            .then(result => {
            	console.log('')
            	let res = result.data
            	if(res.success){
            		this.primarySet(banner)
            	}
            })
            .catch(err => {
                console.log('Error!', err)
            })
            .finally(_ => {
            	this.pageLoading = false
            })
		},	
		primarySet(banner){
    		banner.details.is_primary = 1
    		this.$EventDispatcher.fire('BUSINESS_BANNER_SPLICE', { id : banner.details.id, banner : banner})
		},
		removeImg(banner){

			this.$swal({
	          	title: "Remove Image?",
	          	text: 'Are you sure you want to delete image?' + ' ' + 'This action cannot be undone.',
	          	showCancelButton: true,
	          	confirmButtonText: "Proceed",
	          	confirmButtonColor: '#4087C5',
	          	focusConfirm: false,
	          	focusCancel: false,
	          	cancelButtonText: "Cancel",
	          	reverseButtons: true,
	          	/*background: '#ff3366',*/
	          	width: '400px',
	          	padding: 0
	      	}).then(_ => {

	      		let params = {
					bannerIDs : [banner.details.id]
				}
				this.pageLoading = true
				this.$API.BusinessList.removeBanner(params)
	            .then(result => {
	            	console.log('')
	            	let res = result.data

	            	if(res.success){
	            		console.log('BUSINEESS_BANNER_SPLICE')
	            		this.$EventDispatcher.fire('BUSINEESS_BANNER_SPLICE', { id : banner.details.id})
	            	}
	            })
	            .catch(err => {
	                console.log('Error!', err)
	            })
	            .finally(_ => {
	            	this.pageLoading = false
	            })

	      	}, (dismiss) => {}) 

			
		},
		showUploadBanner(){
			this.$EventDispatcher.fire('BUSINEESS_BANNER_SHOW')
		}
	},
	watch:{
        'businessBanner': function(newVal){
        	this.bannerImages = newVal
        }
    }
}
</script>
<style lang="scss">
.gallery-container{
	background-color: #fff;
	border: 1px solid #E9E9E9;
	padding: 0px 16px;

	.upload-banner{
		background-repeat: no-repeat;
		background-position: center;
		border: 1px solid #E9E9E9;
		cursor: pointer;
	    width: auto;
    	height: 200px;
	}

	.gallery-image{
		background-size: contain;
	    background-repeat: no-repeat;
	    background-position: center;
	    width: auto;
    	height: 200px;
	}
}
</style>