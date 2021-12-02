<template>
    <div class="search-result-container">
        <el-drawer
            title="Market Hammer"
            :visible.sync="showSearchResults"
            :modal="modal"
            :modal-append-to-body="modal"
            direction="rtl"
            v-loading="loading">

            <el-input
            class="input-search"
            v-model="search"
            placeholder="Type to search"
            @keyup.enter.native="globalSearch">
            <i slot="suffix" class="el-input__icon el-icon-search"></i>
            </el-input>

            <div class="search-tags">
                <el-tag
                v-for="tag in tags"
                :key="tag.keyword"
                closable
                size="mini"
                @close="handleClose(tag)"
                :type="tagType"
                @click="searchFromTags(tag.keyword)">
                {{tag.keyword}}
                </el-tag>
            </div>
        <div class="results-section">
                <div class="results-header">
                    <span> {{ searchResults.length + ' results found' }} </span>
                    <span> {{ searchDisplay }} </span>
                </div>
                <div class="row justify-content-center" style="padding: 10px;">
                    <el-card class="box-card result-container" v-for="result in searchResults" :key="result.id">
                        <a @click="showStoreDetail(result.id)">
                            <!-- <i class="el-icon-collection-tag"></i> -->
                            <div class="image-container">
                                <!-- <img v-if="result.primary_banner" :src="'../storage/'+ result.primary_banner" alt="" class="business-image"> -->
                                <!-- <img v-else :src="'image/no_image.png'" alt="" class="business-image"> -->
                                <img :src="result.business_banner.mediaPath" alt="" class="business-image">
                            </div>
                            <div class="result-details">
                                <span class="business-name"> {{ result.businessName }} </span>
                                <div class="row result-detail-row">
                                    <div class="col-6">
                                        <span> {{ getDistanceFromLatLonInKm(coordinates.lat, coordinates.lng, result.business_address.latitude, result.business_address.longitude) + "km" }} </span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span>검색: <span v-html="result.numberOfSearch ? result.numberOfSearch:0"></span></span>
                                    </div>
                                    <div class="col-6">
                                        <span>{{result.address}}</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span><span v-html="result.reviews.length"></span> Reviews</span>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn btn-sm btn-outline-red">견적요청</button>
                                </div>
                            </div>
                        </a>
                    </el-card>
                </div>
            </div>
        </el-drawer>
    </div>
</template>
<script>
export default {
    props: {
        coordinates: {
            type: Object
        },
        searchTags: {
            type: Object
        }
    },
    data: function() {
        return {
            search: '',
            searchResults: [],
            loading: false,
            showSearchResults: false,
            modal: false,
            tags: this.searchTags.data,
            searchDisplay: '',
            tagType: 'info'
        }
    },
    mounted() {
        // EVENT DISPATCHERS
        this.$EventDispatcher.listen('SHOW_SEARCH_RESULTS', results => {
            this.showSearchResults = true;
            this.loading = true;
        });
        this.$EventDispatcher.listen('SEARCH_RESULTS_FETCHED', results => {
            this.loading = false;
            this.searchResults = results.searchResults;
            this.search = results.search;
            this.searchDisplay = this.search;
            this.pushTag(results.search);
        });
    },
    methods: {
        globalSearch() {
            this.pushTag(this.search);
            this.loading = true;
            this.searchDisplay = this.search;
            this.$API.GlobalSearch.searchBusiness(this.search).then(res => {
				this.searchResults = res.data.searchResults;
                this.loading = false;
                this.$EventDispatcher.fire('UPDATE_SEARCH_TAGS', this.tags);
			}).catch(err => {
				
			});
        },
        handleClose(tag) {
	        this.tags.splice(this.tags.indexOf(tag), 1);
        },

        pushTag(search) {
            if(search != '') {
                if(!this.tags.some(t => t.keyword.toLowerCase() === search.toLowerCase())) {
                    this.tags.push({keyword:search});
                }
            }
        },
        // HAVERSINE ALGORITHM
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
        showStoreDetail(id) {
            this.loading = true;
            this.$API.GlobalSearch.storeSearchHistory({
                results: this.searchResults,
                keyword: this.search,
                businessListId: id
            }).then(res => {
                window.location.href = `/store/details/${id}`;
            }).catch(_ => {

            });
        },
        searchFromTags(tag) {
            this.search = tag;
            this.globalSearch();
        }
    }
}
</script>