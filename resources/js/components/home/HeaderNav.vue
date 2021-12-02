<template>
	<div>
        <el-header>
          <i class="el-icon-back"  v-if="showBack" @click="handleBack"></i>
          <span>
            {{ headerTitle }}
          </span>
		    </el-header>
	</div>
</template>


<script>
  export default {
    props: ['headertitle', 'showback', 'prev'],
    data() {
      return {
        isCollapse: true,
        selectedNav: 'home',
        fromAnnouncements: false,
        showBack: this.showback,
      };
    },
    created(){
      // console.log(this.headertitle);
      this.$EventDispatcher.listen('FOOTER_NAVIGATION', nav => {
          this.selectedNav = nav
      });

      this.$EventDispatcher.listen('MY_PAGE_NAVIGATION', nav => {
          this.selectedNav = nav
      });

      this.$EventDispatcher.listen('ANNOUNCEMENT_NAVIGATION', nav => {
          this.fromAnnouncements = true;
      })
    },
    methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleBack() {
        if (!this.fromAnnouncements) {
          // console.log(this.prev, typeof(this.prev))
          if (this.prev == 'home') {
            window.location.href = '/home';
          } else if (this.prev == 'announcements') {
            window.location.href= `/my-page/${this.prev}`;
          } else {
            window.location.href = `/${this.prev}`;
          }
          
        } else {
          window.location.href= `/my-page/${this.prev}`;
        }
        
      },
      showSearch() {
      	this.$EventDispatcher.fire('SHOW_SEARCH')
      }
    },
    computed: {
      headerTitle() {
        return  this.headertitle.toUpperCase();
      }
    },
  }
</script>