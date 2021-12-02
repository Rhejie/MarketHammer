<template>
    <el-dialog
        :title="__('Template')"
        :visible.sync="dialog"
        width="90%"
        @close="dialogVisibleCancel"
        top="4vh">
        <buyer-form-template-builder
        	ref="formFormTemplate"
        	:page-data="pageData"
        	:is-page="false"
            :hiddenButton="hiddenButton"
        	:id="buyerFromTemplateData.id">
        </buyer-form-template-builder>

        <span slot="footer" class="dialog-footer">
            <el-button @click="dialogVisibleCancel">{{__('Cancel')}}</el-button>
            <el-button type="primary" class="btn btn-black" @click="setAsTemplate">{{__('Apply Template')}}</el-button>
        </span>
    </el-dialog>
</template>
<script>
import cloneDeep from 'lodash/cloneDeep'
export default {
    name: 'FormBuilderTemplateView',
    props: {
        dialogVisibleTemplateData: {
            type: Boolean,
            required: true
        },
        pageData : {
            type: Object,
            required: true
        },
        buyerFromTemplateData:{
            type: Object,
            required: true
        }
    },
    data() {
        let formFieldData = {allowToLink : false}
        return {
            dialog: false,

			showFormField: false,
			showFormGroup: false,
			loading: false,
			formFieldGroups: this.pageData.form_field_groups,
			formFieldData : formFieldData,
            hiddenButton : true,
        }
    },
    created() {
        if (this.dialogVisibleTemplateData) {
            this.dialog = this.dialogVisibleTemplateData;
        }
    },
    methods: {
        handleCloseFormTemplate(done) {
            this.$confirm('Are you sure to close this dialog?')
            .then(_ => {
                this.dialog = false;
                this.$emit('closeTemplate');
            })
            .catch(_ => {});
        },
		handleClose() {
			this.showFormField = false
			this.showFormGroup = false
		},
        setAsTemplate() {
        	this.$confirm('Are you sure you want to apply this template? This will only stage the template for saving.', 'Confirm', {
				confirmButtonText: 'Confirm',
				cancelButtonText: 'Cancel',
				type: 'warning'
			})
			.then(_ => {
				let data = {
	            	template: this.buyerFromTemplateData,
	            	from_groups: this.$refs.formFormTemplate.formFieldGroups,
	            	form_template: this.$refs.formFormTemplate.formBuilder
	            }

	            this.$emit('setAsTemplate', data)
	            this.dialog = false;
			})
			.catch(_ => {})
        },
        dialogVisibleCancel() {
            this.dialog = false
            this.$emit('closeTemplate')
        }
    },
	computed: {
		largestPosition() {
			return this.formBuilder[this.formBuilder.length - 1].position
		},
		selectableCategories() {
			return this.formFieldGroups
		}
	}
}
</script>


<style lang="scss">
	html,
	body,
	#app,
	.content-wrapper,
	.app {
		height: 100% !important;
	}

	.backoffice-container .el-table {
		height: 85% !important;
	}

	.buyer-form-builder {
		height: 95%;
		.container {
			height: 95%;

			.inner-container {
				height: 100%;

				.form-container {
					width: 100%;
					background-color: #fff;
					max-height: 100%;

					.el-table,
					.el-table--small {
						overflow-y: scroll;
						td, th {
							padding: 0px 0 !important;
						}
					}
				}
			}
		}
	}
</style>
