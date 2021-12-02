<template>
	<section>
		<div class="notice field-value-translation ">
	        <a href='javascript:void(0)' @click = "setTranslationForm" class = 'text-black underline'> 
	            <i class="fa fa-plus" aria-hidden="true"></i> {{ this.__('Set Translation') }} 
	        </a>
	    </div>
	</section>
</template>

<script>
	export default {
		methods : {
			setTranslationForm(){
				this.$emit('showTranslationForm');
			}
		}
	}
</script>