<template>
	<el-card>
		<div class="p-3 contact-details">
			<div class="info">
				<div>
					<h4 class="text-black">{{ __("CONTACT INFO") }}</h4>
					<hr><br>
					<el-row :gutter = "20" class = "mg-b-30">
	                    <el-col :span = "8">
	                    	<div class="mg-b-10">
	                    		<label>{{ __("Job Title") }}</label> <br>
	                    		<span></span>
	                    	</div>
	                    	
	                    </el-col>

	                    <el-col :span = "8">

	                    	<div class="mg-b-10">
	                    		<label>{{ __("Email") }}</label> <br>
	                    		<span v-if = "isContact">{{ contactData.email }}</span>
	                    		<span v-else class = "italic">( {{ __("Hidden") }} )</span>
	                    	</div>
	                    	
	                    </el-col>

	                    <el-col :span = "8">
	                    	
	                    	<div class="mg-b-10">
	                    		<label>{{ __("Phone") }}</label> <br>
	                    		<span v-if = "isContact">{{ contactData.phone }}</span>
	                    		<span v-else class = "italic">( {{ __("Hidden") }} )</span>
	                    	</div>
	                    	
	                    </el-col>
	                </el-row>
	            </div>

                <div v-if = "pageData.pageType == 'buyer' && contactData.business && isContact">
                	<h4 class="text-black">{{ __("COMPANY INFO") }}</h4>
					<hr>

					<el-row :gutter = "20" class = "mg-b-30">
	                    <el-col :span = "8">
	                    	<div class="mg-b-10">
	                    		<label>{{ __("Company") }}</label> <br>
	                    		<span>{{ contactData.business.legal_name }}</span>
	                    	</div>

	                    	<div class="mg-b-10">
	                    		<label>{{ __("Website") }}</label> <br>
	                    		<span>{{ contactData.business.website }}</span>
	                    	</div>
	                    	
	                    </el-col>

	                    <el-col :span = "8">

	                    	<div class="mg-b-10">
	                    		<label>{{ __("Phone") }}</label> <br>
	                    		<span>{{ contactData.business.phone }}</span>
	                    	</div>

	                    	<div class="mg-b-10">
	                    		<label>{{ __("No. of Employee") }}</label> <br>
	                    		<span>{{ contactData.business.employee_count_id }}</span>
	                    	</div>

	                    </el-col>

	                    <el-col :span = "8">

	                    	<div class="mg-b-10">
	                    		<label>{{ __("Business Category") }}</label> <br>
	                    		<span v-if = "contactData.business.category">{{ contactData.business.category.name }}</span>
	                    	</div>

	                    	<div class="mg-b-10">
	                    		<label>{{ __("Industry Type") }}</label> <br>
	                    		<span v-if = "contactData.business.industry_type">{{ contactData.business.industry_type.name }}</span>
	                    	</div>
	               
	                    </el-col>
	                </el-row>
                </div>
				
			</div>
		</div>
	</el-card>
</template>

<script>
	export default {
		props: {
			pageData: {
				type: Object,
				required: true
			},
			contact: {},
		},
		data() {
			return {
				contactData : this.contact ? this.contact : {}
			}
		},
		methods: {
			handleClickInner() {},
		},
		computed: {
			isContact(){
				return this.contactData && this.contactData.status == 'accepted'
			}
		},
		watch: {
			'contact'(newVal) {
				this.contactData = newVal ? newVal : {}
			},
		}
	}
</script>
<style lang="scss">
.contact-details{
	.info{
		label{
			color: #929292;
			font-weight: normal;

		}
	}
}
</style>