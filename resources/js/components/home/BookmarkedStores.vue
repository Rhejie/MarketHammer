<template>
	<div class="mg-t-50">
		<header-nav headertitle="Bookmarked Stores" :showback="showBack" prev="home"></header-nav>
		<store-card :businessList="searchResults" :coords="coordinates"></store-card>
	</div>
</template>

<script>
  export default {
  	props:['img'],
    data() {
      return {
      	showBack: true,
      	searchResults: [],
      	coordinates: null,
      };
    },
	mounted(){

    	this.$API.BusinessList.getBookmarkedStores({userId: this.$userData.activeUserId})
        .then(result => {
            // console.log('Bookmarked', result)
            this.searchResults = result.data.businessList.data
            this.coordinates = result.data.coords

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