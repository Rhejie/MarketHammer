<template>
	<div>	
		<el-header>
		  	<header-nav headertitle="Event" :showback="showBack" prev="home"></header-nav>
		</el-header>

		<el-card el-card shadow="never" class="mg-t-50 pd-5">
			<el-card :body-style="{ padding: '0px' }" v-for="image in images" :key="image.id">
        <a :href="redirectLink(image.link)">
				  <img :src="image.mediaPath" class="image clickable" >
        </a>
			</el-card>
		</el-card>

	</div>
</template>

<script>
  export default {
  	props:['img'],
    data() {
      return {
      	plain: true,
      	selectedNav: 'home',
      	showHeader: false,
      	showBack: true,
        imgSrc: this.img,
        events: null,
        images: []
      }
    },
	computed: {
  	},
    methods: {
      redirectLink(link)
      {
        return link != null ? link : '#';
      }
    },
    mounted(){

      let params = null
      let tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
      
      this.$API.Home.getEventMedias({timezone:tz})
        .then(result => {
          console.log(result.data.eventMedias);
            this.images = result.data.eventMedias

        })
        .catch(err => {
            console.log('Error!', err)
        })
        .finally(_ => {
            this.pageLoading = false
        })

      // this.$API.Home.getEventMedias()
      //   .then(result => {
      //     console.log(result.data.eventMedias);
      //       this.images = result.data.eventMedias

      //   })
      //   .catch(err => {
      //       console.log('Error!', err)
      //   })
      //   .finally(_ => {
      //       this.pageLoading = false
      //   })
    }
  }
</script>

<style>
  .time {
    font-size: 13px;
    color: #999;
  }
  
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
  }

  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  
  .clearfix:after {
      clear: both
  }
</style>