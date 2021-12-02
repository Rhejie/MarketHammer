<template>
	<div class="home-nav">
    <el-header>
      <el-popover
        placement="bottom-start"
        width="200"
        trigger="hover">
        <a rel='nofollow' href='http://davao.durio.info/' border='0' style='cursor:default'><img src='https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2Fdavao.durio.info%2F&chs=180x180&choe=UTF-8&chld=L|2' alt=''></a>
        <span class = "clickable" slot="reference">{{ 'Download' }}</span>
      </el-popover>
      
      <el-divider direction="vertical"></el-divider>
      <span class = "clickable">
        {{ 'Follow us on' }}
        <el-image
          style="width: 20px; height: 20px;overflow: unset !important;"
          src="/image/fb.png"
          fit="fill">
        </el-image>
        <el-image
        style="width: 20px; height: 20px;overflow: unset !important;"
        src="/image/ig.png"
        fit="fill">
        </el-image>
        <el-image
        style="width: 20px; height: 20px;overflow: unset !important;"
        src="/image/link.png"
        fit="fill">
        </el-image>
      </span>

      <!-- <span class="pull-right clickable" @click="logout" v-if="this.$userData.activeUserId > 0">
        {{ 'Logout' }}
      </span> -->
      <el-popover
        placement="bottom-start"
        width="200"
        v-if="this.$userData.activeUserId > 0"
        trigger="hover">

        <el-table
          style="margin:0px !important;"
          :data="tableData"
          :show-header="false"
          @row-click="handleRowClick"
          class="full-width mg-t-5">
          <el-table-column>
            <template slot-scope="scope">
              <div class="clickable">
                <span> {{ scope.row.val }} </span>
              </div>
          </template>
          </el-table-column>
        </el-table>

        <span class="pull-right clickable" slot="reference">
          <i class="el-icon-user"></i>
        </span>
      </el-popover>

      <span class="pull-right clickable" @click="handleLogin" v-if="this.$userData.activeUserId == 0">
        {{ 'Login' }}
      </span>
      <span class="pull-right" v-if="this.$userData.activeUserId == 0">
        <el-divider direction="vertical"></el-divider>
      </span>
      <span class="pull-right clickable" @click="handleSignup" v-if="this.$userData.activeUserId == 0">
        {{ 'Sign up' }}
      </span>

      <el-popover
        placement="bottom-start"
        width="300"
        trigger="hover">

        <div style="padding: 20px;padding-bottom:0px !important;">
          <center>
            <span>
              {{ this.$userData.activeUserId == 0 ? 'Login to view notifications' : 'No notifications yet' }}
            </span>
          </center>
          <div style="margin-top:50px;">
            <span class="clickable" @click="handleSignup" v-if="this.$userData.activeUserId == 0">
              {{ 'Sign up' }}
            </span>
            <span class="pull-right clickable" @click="handleLogin" v-if="this.$userData.activeUserId == 0">
              {{ 'Login' }}
            </span>
          </div>
        </div>

        <span class="pull-right clickable mg-r-25" slot="reference">
          <i class="el-icon-bell"></i>
        </span>
      </el-popover>
      

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
        tableData: [{
          label: 'My Account',
          val: 'My Account',
          href: '/my-page'
        },{
          label: 'Bookmarked',
          val: 'Bookmarked',
          href: '/home/bookmarked'
        },{
          label: 'Search History',
          val: 'Search History',
          href: '/my-page/search-history'
        },{
          label: 'Logout',
          val: 'Logout',
        }]
      };
    },
    created(){
    },
    methods: {
      handleRowClick(selectedLinkFromMyPage) {
        console.log(selectedLinkFromMyPage.label)
        if (selectedLinkFromMyPage.label == 'Logout') {
          this.logout();
        } else {
          window.location.href = selectedLinkFromMyPage.href;
        }
      },
      logout(){
         axios.post('/logout').then(response => {
            if (response.status === 302 || 401) {
              window.location.href = "/home";
            }
            else {
              console.log('logout error')
            }
          }).catch(error => {
            console.log('logout error')
          });
      },
      handleLogin() {
        window.location.href = '/login';
      },
      handleSignup() {
        window.location.href = '/register';
      },
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
<style>
  .el-popper {
    padding: 0px;
  }
</style>