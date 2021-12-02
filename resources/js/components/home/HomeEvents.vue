<template>
    <div class="block full-width home-events" @click="handleClick">
      <el-carousel indicator-position="outside" >
        <el-carousel-item v-for="event in eventMedias" :key="event.id"  height="150px">
          <el-card :body-style="{ padding: '0px' }" @click="handleClick">
            <img :src="event.event_medias[0].mediaPath" class="image clickable">
          </el-card>
        </el-carousel-item>
      </el-carousel>
    </div>
    
</template>

<script>
  export default {
    props:['img'],
    data() {
      return {
        events: null,
        eventMedias: []
      };
    },
    methods: {
      handleClick(key, keyPath) {
        window.location.href = 'my-page/event/show';
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    },
    mounted(){
      let params = null
      let tz = Intl.DateTimeFormat().resolvedOptions().timeZone;

      this.$API.Home.getEvents({timezone:tz})
        .then(result => {
          console.log(result.data.events);
            this.events = result.data.events

        })
        .catch(err => {
            console.log('Error!', err)
        })
        .finally(_ => {
            this.pageLoading = false
        })

      
      // console.log(tz)
      this.$API.Home.getEventMedias({timezone:tz})
        .then(result => {
          // console.log(result.data.eventMedias);
            this.eventMedias = result.data.eventMedias
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
