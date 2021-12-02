<template>
	<div>

		<el-header>
		  	<header-nav headertitle="내 쿠폰" :showback="showBack" prev="my-page"></header-nav>
		</el-header>

		<el-main class="pd-0 mg-t-50">
			<div class="coupon-main-div">
				<span class="coupon-main-div-text">
					헛소리헛소리헛소리헛소리
				</span>
			</div>

		</el-main>	
		<el-card el-card shadow="never" class="my-coupon-container">	
			<span>리헛소리헛소리헛소리</span>
		    <el-card shadow="never" :class="getRandomClass" v-for="coupon in coupons" :key="coupon.id">
		    	<h4>{{ coupon.amount }} 헛</h4>
		    	<span>{{ coupon.name }}</span><br>
		    	<span>Code: {{ coupon.code }}</span><br>
		    	<span>Valid until: {{ formatDate(coupon.validUntil) }}</span>
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
        coupons: [],
        cardClasses: [
        	'coupon-card bg-blue',
        	'coupon-card bg-green',
        	'coupon-card bg-orange'
        ]
      }
    },
	computed: {
		getRandomClass() {
			return this.cardClasses[Math.floor((Math.random()*this.cardClasses.length))];
		}
  	},
    methods: {
    	formatDate(date) {
			return new Date(date).toLocaleDateString()
		},
    },
    mounted(){

      this.$API.Coupon.getUserCoupons({userId: this.$userData.activeUserId})
        .then(result => {
            // console.log('ann', result.data.announcements)
            this.coupons = result.data.coupons

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