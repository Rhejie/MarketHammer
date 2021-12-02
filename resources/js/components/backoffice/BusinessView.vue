<template>
	<div class="business-view container" v-loading = "pageLoading">
		<el-row :gutter = "20">
	        <el-col :span = "24" class = "header-details">
	        	<div style = "width: 50px;" @click = "showProfileUpload()">
	        		<div class="circle-avatar" :style="{'background-image': 'url('+businessImg+')', 'cursor': 'pointer'}"></div>
	        	</div>
	        	<div class = "mt-2 ml-3">
	        		<span>{{ bData.businessName }}</span>
	        	</div>
	        </el-col>
	        <el-col :span = "24" class = "mt-2">
	        	<el-tabs type="card" v-model = "tabModel">
				  	<el-tab-pane name = "business_info" label="Business Info">
				  		<el-row :gutter = "20">
	        				<el-col :span = "15">
	        					<div class = "info-container">
	        						<h4>Business Details</h4>
	        						<div class = "btn-cont">
	        							<el-button @click = "editBusiness()" type = "danger" class = "btn-red" > {{ 'Update Details' }} </el-button>
	        						</div>
		        					<hr>
		        					<table class = "business_info">
		        						<tr>
		        							<td>
		        								<div class = "title">Industry Type</div>
		        								<span>{{ bData.industry_type ? bData.industry_type.name : "" }}</span>
		        							</td> 
		        							<td>
		        								<div class = "title">Cluster ID</div>
		        								<span>{{ bData.cluster ? bData.cluster.name : "" }}</span>
		        							</td>
		        							<td>
		        								<div class = "title">Categories</div>
		        								<span>{{ categoryList }}</span>
		        							</td>
		        						</tr>
		        						<tr>
		        							<td>
		        								<div class = "title">Email Address</div>
		        								<span>{{ bData.email }}</span>
		        							</td>
		        							<td>
		        								<div class = "title">Phone Number</div>
		        								<span>{{ bData.phone }}</span>
		        							</td>
		        							<td>
		        								<div class = "title">Website</div>
		        								<span>{{ bData.webAddress }}</span>
		        							</td> 
		        						</tr>
		        						<tr>
		        							<td>
		        								<div class = "title">Join Date</div>
		        								<span>{{ bData.joinDate }}</span>
		        							</td>
		        							<td>
		        								<div class = "title">License</div>
		        								<span>{{ bData.businessLicense }}</span>
		        							</td> 
		        							<td>
		        								<div class = "title">Description</div>
		        								<span>{{ bData.description }}</span>
		        							</td> 
		        						</tr>
		        					</table>
		        					<hr>
		        					<h4>Business Hours</h4>
		        					<table class = "business_hours">
		                                <thead>
		                                    <tr>
		                                        <th>Day</th>
		                                        <th>From</th>
		                                        <th>To</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    <tr v-for="item in bData.business_operations">
		                                        <td>
		                                            {{item.day}}
		                                        </td>
		                                        <td>
		                                            {{item.from}}
		                                        </td>
		                                        <td>
		                                            {{item.to}}
		                                        </td>
		                                    </tr>
		                                </tbody>
		                            </table>
	        					</div>

	        				</el-col>
	        				<el-col :span = "9" style = "padding-left: 0px;">
	        					<div class = "info-container">
	        						<h4>Business Address</h4>
		        					<hr>
		        					<table class = "business_address">
		        						<tr>
		        							<td>
		        								<div class = "title">Street</div>
		        								<span>{{ businessAddress ? businessAddress.street : "" }}</span>
		        							</td> 
		        							<td>
		        								<div class = "title">City</div>
		        								<span>{{ businessAddress ? __(businessAddress.city) : "" }}</span>
		        							</td>
		        							<td>
		        								<div class = "title">State</div>
		        								<span>{{ businessAddress ? businessAddress.state : "" }}</span>
		        							</td>
		        						</tr>
		        						<tr>
		        							<td>
		        								<div class = "title">Zip</div>
		        								<span>{{ businessAddress ? businessAddress.zip : "" }}</span>
		        							</td>
		        							<td>
		        								<div class = "title">Country</div>
		        								<span>{{ businessAddress && businessAddress.country ? businessAddress.country.name : "" }}</span>
		        							</td>
		        						</tr>
		        						<tr>
		        						</tr>
		        					</table>
		        					<div style = "height: 100%;">
		        						<google-map :page-data = "googleData"></google-map>
		        					</div>
		        					
	        					</div>
	        				</el-col>
	        			</el-row>	
				  	</el-tab-pane>
				  	<el-tab-pane name = "business_owner" label="Business Owner's Account">Business Owner's Account</el-tab-pane>
				  	<el-tab-pane name = "business_gallery" label="Gallery">
				  		<el-row :gutter = "20">
	        				<el-col :span = "24">
				  				<business-gallery :business-banner = "bannerImages"></business-gallery>
				  			</el-col>
				  		</el-row>
				  	</el-tab-pane>
				  	<el-tab-pane name = "business_videos" label="Videos">
				  		<el-row :gutter = "20">
	        				<el-col :span = "24">
				  				<business-videos :business-banner = "bannerImages"></business-videos>
				  			</el-col>
				  		</el-row>
				  	</el-tab-pane>
					<el-tab-pane name = "business_events" label="Events">
				  		<el-row :gutter = "20">
	        				<el-col :span = "24">
				  				<business-events :businessData="bData"></business-events>
				  			</el-col>
				  		</el-row>
				  	</el-tab-pane>
				  	<el-tab-pane name = "list_videos" label="Live Videos" v-if="bData.planID > 0">
				  		<el-row :gutter = "20">
	        				<el-col :span = "24">
				  				<live-video-list :businessData="bData" :uploadRoute="uploadImageRoute" :storageRoute="pageData.storageRoute"></live-video-list>
				  			</el-col>
				  		</el-row>
				  	</el-tab-pane>
				</el-tabs>
	        </el-col>
	    </el-row>
	    <el-dialog
          title="Edit Business"
          :visible.sync="formDialogVisible"
          width="70%"
          top = "20px">
            <business-form
                :business-data = "bData">
            </business-form>
        </el-dialog>

        <business-banner-upload
            :business-data = "bData"
            :page-data = "bannerData"
            :visible.sync = "bannerDialog"
            @close="bannerDialog = false">
        </business-banner-upload >

	</div>
</template>

<script>
import _forEach from 'lodash/forEach'
import cloneDeep from 'lodash/cloneDeep'
export default {
    props: {
        businessData : {
            required: false
        },
        pageData : {
            required: false
        }
    },
    data(){

    	let gData = {markers : [], height : '250px', mapClickable : true}
    	let bannerData = { uploadImageRoute : this.pageData.uploadImageRoute, isPrimary : false, multiple : false, title : "Upload Profile Image"}
    	return {
    		tabModel 		: "business_info",
    		bData 			: this.businessData,
    		businessImg		: "",
    		categoryList 	: "",
    		businessAddress : null,
    		googleData 		: gData,
    		formDialogVisible 	: false,
    		pageLoading 	: false,
    		uploadImageRoute : this.pageData.uploadImageRoute,
    		uploadVideoRoute : this.pageData.uploadVideoRoute,
    		bannerDialog 	: false,
    		bannerData 		: bannerData,
			bannerImages 	: []
    	}
    },
    created(){
    	this.setBusiness(this.businessData)
    	if(this.pageData.businessImage){
    		this.setBanners(this.pageData.businessImage)
    	}
    	this.$EventDispatcher.listen('BUSINESSDATA_GET', data => {
            this.getBusiness()
            this.formDialogVisible = false
        })

        this.$EventDispatcher.listen('BUSINESS_BANNER_SAVED', data => {
            this.setBanners(data.files, true)
        })

        this.$EventDispatcher.listen('BUSINESS_BANNER_SPLICE', data => {
        	let bannerID = data.id
        	let banner = cloneDeep(data.banner)
            //this.businessImg = data.bannerImage
            let fndIndex = this.bannerImages.findIndex(fn => { return fn.details && Number(fn.details.id) == bannerID})

    		if(fndIndex >= 0){
    			if(banner){
    				if(banner.details && Number(banner.details.is_primary) == 1){
						_forEach(this.bannerImages, ban => {
							ban.details.is_primary = 0
						})
					}

    				this.bannerImages.splice(fndIndex, 1, banner)
    			}
    			else{
    				this.bannerImages.splice(fndIndex, 1)
    			}
    		}

    		this.bannerPrimary()
        })

        this.$EventDispatcher.listen('BUSINEESS_BANNER_SHOW', data => {
        	this.bannerData.multiple = true
    		this.bannerData.title = 'Import Images'
    		this.bannerData.isPrimary = false
            this.bannerDialog = true
        })

    },
    methods:{
    	showProfileUpload(){
    		this.bannerData.multiple = false
    		this.bannerData.title = 'Upload Profile Image'
    		this.bannerData.isPrimary = true
            this.bannerDialog = true
    	},
    	setBusiness(data){
    		this.bData = data
    		this.businessAddress = data.business_address ? data.business_address : null

    		let cat = ""
	    	if(data && data.categories){
	    		_forEach(data.categories, ct =>{
	    			cat += ct.name + ", "
	    		})

	    		if(cat != ""){
	    			cat = this.$sf.removeLastChar(cat, 2)
	    		}
	    	}

	    	this.googleData.markers = []
	    	if(data.business_address){
	    		console.log('data.business_address', data.business_address)
                let addr = data.business_address
                let lat = addr.latitude ?  addr.latitude : 0
                let long = addr.longitude ?  addr.longitude : 0
                let pos = { position: {lat: lat, lng: long}, 
                	draggable : false,
                	clickable : false,
                	icon : "/image/map_pin.png"}

	    		console.log('pos', pos)
                this.googleData.markers.push(pos)
            }

	    	this.categoryList = cat

	    	
    	},
    	setBanners(images, isConcat = false, $isPrimary = false){

    		// if($isPrimary){
				_forEach(this.bannerImages, ban => {
					ban.details.is_primary = 0
				})
			// }

			//Get image
			if(isConcat){
				this.bannerImages = this.bannerImages.concat(images)
			}
			else{
				this.bannerImages = images
			}
	    	
	    	this.bannerPrimary($isPrimary)
    	},
    	bannerPrimary(){

    		let findPrimary = this.bannerImages.find(fn => {
	    		return fn.details && fn.details.is_primary
	    	}) 
	    	if(findPrimary){
	    		this.businessImg = findPrimary.filePath
	    	}
    	},
    	editBusiness(){
    		this.formDialogVisible = true
    	},
    	getBusiness(){

            let params = {
                id : this.businessData.id,
            }
            this.pageLoading = true;
            this.$API.BusinessList.getBusiness(params)
            .then(result => {
            	console.log('')
            	let res = result.data
            	console.log('res.businessData', res.businessData)
            	this.setBusiness(res.businessData)
            })
            .catch(err => {
                console.log('Error!', err)
            })
            .finally(_ => {
            	this.pageLoading = false
            })
        },
    }
}
</script>
<style lang="scss">
.business-view
{
	.header-details{

		>div{
			float : left;
		}
		
	}

	.el-tabs--card{
		>.el-tabs__header{
			border-bottom: none;
			margin: 0 0 2px;

			.el-tabs__item{

				&.is-active{
					background-color: #fff;
				}
			}
		}
	} 

	.el-tabs__content{
		//background-color: #fff;
		table{
			width : 100%;

			td{
				padding : 10px 0px;
				text-align: left;
				vertical-align: top;
			}
		}

		.business_info{
			.title{
				color : #ACACAC;
				text-transform: uppercase;
			}

			
		}

		.business_hours{
			text-transform: uppercase;

			th{
				color : #ACACAC;
			}

			td{
				font-weight: bold;
				padding : 0px 0px;
			}
		}

		.business_address{
			.title{
				color : #ACACAC;
				text-transform: uppercase;
			}
		}

		.info-container{
			padding : 20px;
			background-color: #fff;
			border: 1px solid #E9E9E9;
			position: relative;

			.btn-cont{
				position: absolute;
				top: 7px;
    			left: 200px;
			}
		}
	}
}
</style>