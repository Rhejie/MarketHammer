<template>
	<section>
		<el-form-item
            :label="__('Option Reference')">
            <div class="row">
                <div :class="formOption.source_table ? 'col-md-12' : 'col-md-9'">
		            <el-select
		                class="full-width round-input"
		                :placeholder="__('Define')"
		                filterable
		                clearable
		                :disabled = "disabled"
		                @change = "changeOptionRef"
		                v-model="formOption.source_table">
		                <el-option
		                    v-for="option in optionList"
		                    :label="option.label"
		                    :value="option.value"
		                    :key="option.id">
		                </el-option>
		            </el-select>
		        </div>
		        <div class="col-md-3">
			        <el-button
			        	v-if = "!formOption.source_table"
			            type="text"
			            class = "text-black"
			            @click="addOption">
			            <i class="fas fa-plus"> {{ __('Add Option') }} </i>
			        </el-button>
		        </div>
		    </div>
        </el-form-item>

        <!-- End of Add Option Button -->
        <template v-if = "!formOption.source_table">
            <div class="row pd-r-l-20 option-header" v-if="formOption.field_options.length">
                <div class="col-md-5">
                    <span>{{__('Label')}}</span>
                </div>
                <div class="col-md-5">
                    <span>{{__('Value')}}</span>
                </div>
            </div>
            <transition-group 
                v-if="formOption.field_options.length"
                name="slide-fade" 
                mode="in-out"
                tag="div">
                <div 
                    class="row mg-t-5 pd-r-l-20"
                    v-for="(option, index) in formOption.field_options"
                    :key="option.key">
                    <div class="col-md-5">
                        <el-form-item >
                            <el-input
                                class="full-width round-input"
                                :placeholder="__('Enter Label')"
                                clearable
                                v-model="option.label">
                            </el-input>
                        </el-form-item>
                    </div>
                    <div class="col-md-5">
                        <el-form-item >
                            <el-input
                                class="full-width round-input"
                                :placeholder="__('Enter Value')"
                                clearable
                                v-model="option.value">
                            </el-input>
                        </el-form-item>
                    </div>
                    <div class="col-md-2 d-flex">
                        <el-button
                            type="text"
                            icon="fas fa-trash-alt"
                            class="text-red"
                            @click="removeOption(option, index)">
                        </el-button>
                    </div>
                </div>
            </transition-group>
        </template>
	</section>
</template>
<script type="text/javascript">
export default {
    props: {
    	optionList: {
            required: true,
            type: Array
        },
        type: {
            required: true,
            type: String
        },
    	optionForm: {
            required: true,
            type: Object,
            default: {}
        },
        disabled : {
            required: false,
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
        	formOption : this.optionForm
        }
    },
    methods:{
    	addOption(type = null) {
            let arr = {
                label: null,
                value: null,
                key: Date.now()
            }

            this.formOption.field_options.push(arr)
        },
        removeOption(item, index) {
            if (item.value || item.label) {
                this.$confirm(this.__("Are you sure you want to remove this option?"), this.__('Confirmation'), {
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    type: 'warning',
                    confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.formOption.field_options.splice(index, 1)
                })
                .catch(() => {})
            } else {
                this.formOption.field_options.splice(index, 1)
            }
        },
        changeOptionRef(){
        	this.formOption.field_options = []
        }
    }
}
</script>