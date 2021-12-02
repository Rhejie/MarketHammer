<template>
	<el-popover
		ref="filterBox"
		:placement="placement"
	    :width="width"
	    trigger="click"
	    :popper-class="customClassName+' filter-box-class'">
		
    	<header class="filter-box-header">
	    	<span>{{ customTitle }}</span>
	    	<el-button 
	    		class="pull-right filter-close-button"
	    		type="text" 
	    		icon="el-icon-close"
	    		@click="closeFilterBox">
	    	</el-button>
	    </header>

	    <section class="filter-box-body">
	   		<slot name="body" ></slot>
	    </section>

	    <slot v-if="hasRefSlot" name="reference" slot="reference"></slot>

	    <el-button 
	    	:disabled="disabled"
	    	v-else
			class="mh-btn"
			slot="reference" 
			title="Filter"
			icon="fas fa-filter">
		</el-button>
  </el-popover>
</template>

<script>
	export default {
		name: 'BaseFilterDropdownBox',
		props: {
			customTitle: {
				type: String,
				required: false,
				default: 'Filter'
			},
			customClassName: { // Custome Popover class
				type: String,
				required: false,
				default: ''
			},
			width: {
				type: [String, Number],
				required: false,
				default: 300
			},
			placement: {
				type: String,
				default: 'bottom'
			},
			disabled: {
				type: Boolean,
				default: false
			}
		},
		data() {
			return {}
		},
		methods: {
			closeFilterBox() {
				this.$refs.filterBox.showPopper = false
			},
		},
		computed: {
			hasRefSlot () {
				return !!this.$slots['reference']
			},
		}
	}
</script>

<style lang="scss">
	.filter-box-class {
		padding: 10px;

	    .filter-box-header {
	      	font-size: 14px !important;
			display: flex;
			align-items: baseline;
			margin-bottom: 0px;
			padding: 10px;
			background-color: #524da7;
			color: #ffffff;
	    }

	    .filter-box-body {
	    	padding: 0 10px;
	    }

	    .filter-close-button {
    	    position: absolute;
		    right: 8px;
		    top: 0px;
		    color: #ffffff;
	    }
		label:not(.form-check-label):not(.custom-file-label) {
			font-weight: 100;
		}
	}
	.el-popper[x-placement^=bottom] .popper__arrow{
			display: none !important;
		}
</style>