<template>
	<div class="mg-t-50">
		<header-nav headertitle="매장 정보" :showback="showBack" prev="my-page"></header-nav>
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

    	this.$API.BusinessList.getuserSearchHistory({userId: this.$userData.activeUserId})
        .then(result => {
            console.log('result', result)
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