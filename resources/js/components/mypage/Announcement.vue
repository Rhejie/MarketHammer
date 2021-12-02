<template>
	<div class="mg-t-50 pd-5">	
		<el-header>
		  	<header-nav headertitle="공지사항" :showback="showBack" prev="my-page"></header-nav>
		</el-header>

		<el-card el-card shadow="never" class="announcement-card" :key="announcement.id" v-for="announcement in announcements">
			<el-row :gutter="24" class="pd-10">
				<!-- <el-col :span="1">
					<i class="el-icon-remove-outline active-icon"  v-if="announcement.id"></i>
				</el-col> -->
				<el-col :span="20">
					<span class="normal">
						{{ announcement.title }}
					</span><br>
					<span>{{ formatDate(announcement.from) }}</span>
				</el-col>
				<el-col :span="2">
					<div class="outer">
					  <div class="middle">
					    <div class="inner">
					      <i class="el-icon-arrow-right view-announcement-icon" @click="viewAnnouncement(announcement)"></i>
					    </div>
					  </div>
					</div>
				</el-col>
			</el-row>
		</el-card>
	</div>
</template>

<script>
  export default {
  	props:['img'],
    data() {
      return {
      	mode: 'list',
      	plain: true,
      	selectedNav: 'home',
      	showHeader: false,
      	showBack: true,
        imgSrc: this.img,
        selectedAnnouncement : null,
        announcements : []
      }
    },
	computed: {
	
	},
    methods: {
    	formatDate(date) {
			return new Date(date).toLocaleDateString()
		},
    	getClass(highlighted) {
			if (highlighted) {
				return 'highlighted';
			} else {
				return 'normal';
			}
		},
		viewAnnouncement(announcement) {
			window.location.href = `announcement/${announcement.id}/show`;
		}
    },
    created(){
      this.$EventDispatcher.listen('CHANGE_ANNOUNCEMENT_MODE', mode => {
          this.mode = mode
      });
    },
    mounted(){

      this.$API.Announcement.getUsersAnnouncementsForUser({userId: this.$userData.activeUserId})
        .then(result => {
            // console.log('ann', result.data.announcements)
            this.announcements = result.data.announcements

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

<style>
	.highlighted {
		color: red;
	}

	.normal {
		color: black;
	}

	.outer {
	  display: table;
	  position: absolute;
	  top: 0;
	  left: 0;
	  height: 100%;
	  width: 100%;
	}

	.middle {
	  display: table-cell;
	  vertical-align: middle;
	}

	.inner {
	  margin-left: auto;
	  margin-right: auto;
	  float: right;
	  padding-right: 10px;
	}
</style>