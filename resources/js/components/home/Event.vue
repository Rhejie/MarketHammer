<template>
	<div>	
		<el-header>
		  	<header-nav headertitle="이벤트" :showback="showBack" prev="my-page"></header-nav>
		</el-header>

		<el-card el-card shadow="never" class="mg-t-50 pd-5">
			<el-card shadow="never" class="coupon-card bg-green" >
		    	<span>리헛소리헛소리 2.2 - 8.32, 소리헛소리</span><br>
		    	<span>리헛소리리헛소리....</span><br>
		    	<i class="el-icon-scissors event-icon pull-right"></i>
		    </el-card>
		    <el-card shadow="never" class="coupon-card bg-blue">
		    	<span>리헛소리헛소리</span><br>
		    	<span>리헛소리: 25,000 리</span><br>
		    	<i class="el-icon-pie-chart event-icon pull-right"></i>
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
      }
    },
	computed: {
  	},
    methods: {
    }
  }
</script>