<template>
	<div class="footer-nav">
		<search :searchTags="searchTags"></search>
		<search-results :coordinates="coordinates" :searchTags="searchTags"></search-results>
		<el-footer>
			<el-menu class="el-menu-demo" mode="horizontal">
				<el-menu-item index="home" @click="handleNavigation" v-bind:class="{'selected-nav': activeNav == 'home'}">
					<div>
						<i class="el-icon-s-home"></i>
					</div>
				</el-menu-item>
				<el-menu-item index="book" @click="handleNavigation" v-bind:class="{'selected-nav': activeNav == 'book'}">
					<div>
						<i class="el-icon-notebook-2"></i>
					</div>
				</el-menu-item>
				<el-menu-item index="search" @click="showSearch" v-bind:class="{'selected-nav': activeNav == 'search'}">
					<div>
						<i class="el-icon-search"></i>
					</div>
				</el-menu-item>
				<el-menu-item index="My Page" @click="handleNavigation" v-bind:class="{'selected-nav': activeNav == 'My Page'}"> 
					<div>
						<i class="el-icon-user"></i>
					</div>
				</el-menu-item>
				<el-menu-item index="menu" @click="handleNavigation" v-bind:class="{'selected-nav': activeNav == 'menu'}">
					<div>
								<i class="el-icon-menu"></i>
					</div>
				</el-menu-item>
			</el-menu>
		</el-footer>
	</div>
</template>

<style>
  
</style>

<script>
  export default {
  	props: ['selectedNav', 'coordinates', 'searchTags'],
    data() {
      return {
      	activeNav: this.selectedNav,
        isCollapse: true
      };
    },
    methods: {
      handleNavigation(selected) {
      	// console.log(selected)
      	if (selected.index == 'My Page') {
      		window.location.href = '/my-page';
      	} else if (selected.index == 'book') {
          window.location.href = `/home/bookmarked-stores`;
      		// window.location.href = `/my-page/store-details`;
      	} else if (selected.index == 'menu') {
          window.location.href = `/home`;
      		// window.location.href = `/my-page/store-details`;
      	} else {
      		window.location.href = `/${selected.index}`;
      	}
      	this.$EventDispatcher.fire('FOOTER_NAVIGATION', selected.index)
        // console.log(selected.index);
      },
      showSearch() {
      	this.$EventDispatcher.fire('SHOW_SEARCH')
      }
    }
  }
</script>
