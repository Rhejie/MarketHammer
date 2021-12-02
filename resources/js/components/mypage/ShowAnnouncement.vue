<template>
	<div class="mg-t-50 pd-5">	
		<el-header>
		  	<header-nav headertitle="Announcement" :showback="showBack" prev="announcements"></header-nav>
		</el-header>

		<el-card>
			<el-row :gutter="24" class="pd-10">
				<el-col :span="24">
					<b>
						{{ announcement.title }}
					</b><br>
					<span>{{ formatDate(announcement.from) }}</span>
				</el-col>
			</el-row>
			<el-card class="mg-t-10">
				<el-row :gutter="24" class="pd-10">
					<el-col :span="24">
						<span>{{store.businessName}}</span><br>
						<span>{{store.address}} {{store.address_city}} </span><br>
						<span>Join Date {{store.joinDate}}</span><br>
						<span>Phone:</span><br>
						<span>{{store.phone}}</span><br>
					</el-col>
				</el-row>
			</el-card>

		</el-card>
	</div>
</template>

<script>
  export default {
  	props:['img', 'id'],
    data() {
      return {
      	mode: 'list',
      	plain: true,
      	selectedNav: 'home',
      	showHeader: false,
      	showBack: true,
        imgSrc: this.img,
        announcement: [],
        store: []
      }
    },
    methods: {
    	getClass(highlighted) {
			if (highlighted) {
				return 'highlighted';
			} else {
				return 'normal';
			}
		},
		formatDate(date) {
			return new Date(date).toLocaleDateString()
		}
    },
    mounted(){

      this.$API.Announcement.getAnnouncement({id: this.id})
        .then(result => {
            // console.log('ann', result.data.announcement.businesslists)
            this.announcement = result.data.announcement
            this.store = result.data.store

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
