<template>
	<div class="history-form">
		<el-image
	      	style="width: 200px; height: 200px"
	      	src="/image/homepage_section_images/coming_soon_img.png"
	      	fit="fill">
      	</el-image>

      	<div class="break"></div>
      	
      	<div class="text-center">
      		<h3 class="font-weight-bold">Ohh Hello!</h3>	
      		<p class="font-weight-bold">
  				Your UI/UX Designer is still working on this one.<br>
      			Will update you anytime soon.
      		</p>
      	</div>
      	
	</div>
</template>

<script>
	export default {
		name: 'SupplierHistoryForm',
		data() {
			return {

			}
		}
	}
</script>

<style lang="scss">
	.history-form {
		min-height: 300px;
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    flex-wrap: wrap;

	    .break {
		  	flex-basis: 100%;
		  	height: 0;
		}
	}
</style>