<template>
	<div>

	  <el-header>
	  	<header-nav headertitle="Help" :showback="showBack" :prev="prev"></header-nav>
	  </el-header>

	  <el-main>

  		

	  </el-main>


	</div>	
</template>

<style>

</style>

<script>
  export default {
    data() {
      return {
      	showHeader: true,
      	showBack: true,
        showFooter: false,
        prev: 'my-page'
      }
    },
  }
</script>