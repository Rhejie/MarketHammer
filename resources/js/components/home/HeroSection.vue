<template>
  <div>
		<el-row :gutter="10" style="padding: 0px 10px;">
		  
      <!-- mobile view -->
      <el-col :xs="24" class="hidden-sm-and-up" :key="hero.id" v-for="hero in heroes">
		  	<el-card class="box-card" style="width:100%">
		  		<el-row :gutter="24" style="padding:0px 10px;">
			  		<el-col :span="6">
			  			<el-image
					      style="width:80px;height:100px;border-radius:5px;"
					      :src="hero.image" 
					      fit="fit">
				    	</el-image>
  					</el-col>
  					<el-col :span="10">
  						<b>{{ hero.title }}</b>
  						<br>
  						<span>{{ hero.distance }}</span>
  						<br>
  						<span>{{ hero.address }}</span> 
  						<el-button type="danger" size="mini" :plain="plain" @click="handleClick">Request a Qoute</el-button>
  					</el-col>
  					<el-col :span="8" style="text-align:left;">
  						<i class="el-icon-collection-tag" style="float:right !important;cursor:pointer;"></i>
  						<br>
  						매장888
  						<br>
  						{{ hero.reviews }} Reviews
  					</el-col>
  				</el-row>
  			</el-card>
		  </el-col>

      <!-- web view -->
      <div class="hidden-xs-only" style="padding: 0px 50px;">
        <el-col :sm="8" class="hidden-xs-only" :key="hero.id" v-for="hero in heroes">
          <el-card class="box-card" style="width:100%;margin-top:10px;">
            <el-row :gutter="24" style="padding:0px 10px;">
              <el-col :span="6">
                <el-image
                  style="width:70px;height:100px;border-radius:5px;"
                  :src="hero.image" 
                  fit="fit">
                </el-image>
              </el-col>
              <el-col :span="10">
                <b>{{ hero.title }}</b>
                <br>
                <span>{{ hero.distance }}</span>
                <br>
                <span>{{ hero.address }}</span> 
                <el-button type="danger" size="mini" :plain="plain" @click="handleClick">Request a Qoute</el-button>
              </el-col>
              <el-col :span="8" style="text-align:left;">
                <i class="el-icon-collection-tag" style="float:right !important;cursor:pointer;"></i>
                <br>
                매장888
                <br>
                {{ hero.reviews }} Reviews
              </el-col>
            </el-row>
          </el-card>
        </el-col>
      </div>

		</el-row>
  </div>
</template>

<script>
  export default {
    props:['img'],
    data() {
      return {
      	plain: true,
        heroes: [
          {
            id: 1,
            image: this.img,
            title: 'awddaw',
            distance: '1.2km',
            address: 'zxcxzzcxz',
            reviews: 21
          },
          {
            id: 2,
            image: this.img,
            title: 'awddaw',
            distance: '1.2km',
            address: 'zxcxzzcxz',
            reviews: 21
          },
          {
            id: 3,
            image: this.img,
            title: 'awddaw',
            distance: '1.2km',
            address: 'zxcxzzcxz',
            reviews: 21
          },
          {
            id: 4,
            image: this.img,
            title: 'awddaw',
            distance: '1.2km',
            address: 'zxcxzzcxz',
            reviews: 21
          }
        ]
      };
    },
    methods: {
      handleClick() {
        window.location.href = '/home/store-details';
      }
    }
  }
</script>

<style>
  .text {
    font-size: 14px;
  }

  .item {
    padding: 18px 0;
  }

  .box-card {
    width: 480px;
  }
</style>