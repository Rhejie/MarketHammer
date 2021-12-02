<template>
	<el-dialog
        :visible.sync="showDialog"
        @close="closeForm"
        :title="hasModel ? __('Update Buyer Form Template') : __('Add New Form Template')"
        width="40%"
        top="4vh">
         <el-form
            v-loading="loading"
            :rules="rules"
            :model="buyerFormTemplateForm"
            ref="buyerFormTemplateForm"
            autocomplete="off"
            label-position="top">
            <div class="row">
            	<div class="col-md-12">
            		<el-form-item
	                    :label="__('Name')"
	                    prop="name">
	                    <el-input
	                    	clearable
	                    	class="full-width round-input"
	                    	:placeholder="__('Enter Template Name')"
	                    	v-model="buyerFormTemplateForm.name">
	                    </el-input>

	                    <value-translator-btn
		                    @showTranslationForm="setTranslationForm('name', buyerFormTemplateForm.name, 'text')">
		                </value-translator-btn>
	                </el-form-item>

	                <el-form-item
	                    :label="__('Status')"
	                    prop="form_template_status_id">
	                    <el-select
	                    	clearable
	                    	filterable
	                    	class="full-width round-input"
	                    	:placeholder="__('Select Status')"
	                    	v-model="buyerFormTemplateForm.form_template_status_id">
	                    	<el-option
	                    		v-for="status in formTemplateStatusList"
	                    		:key="status.id"
	                    		:value="status.id"
	                    		:label="__(status.name)">
	                    	</el-option>
	                    </el-select>
	                </el-form-item>
            	</div>
            </div>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button
            	type="text"
            	class="text-black"
            	@click="closeForm">
                <u>{{ __("Cancel") }}</u>
            </el-button>
            <el-button
                round
                @click="validateForm"
                type="primary"
                class="btn btn-black">
                {{ __('Save') }}
            </el-button>
        </span>

        <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData">
        </value-translator-form>
    </el-dialog>
</template>

<script>
	import cloneDeep from "lodash/cloneDeep";
	import { formHelper } from "../../../mixins/formHelper";
	import { dialogComponent } from "../../../mixins/dialogComponent";
	import translationForm from "../../../mixins/translationForm";

	export default {
		name: "BuyerFormTemplateForm",
    	mixins: [formHelper, dialogComponent, translationForm],
    	props: {
    		model: {},
    		formTemplateStatusList: {
    			required: true,
    			type: Array
    		}
    	},
    	data() {
    		return {
    			loading: false,
    			rules: {
    				name: {required: true, message: this.__('This field is required'), trigger: 'blur'},
    				form_template_status_id: {required: true, message: this.__('This field is required'), trigger: ['change', 'blur']}
    			},
    			buyerFormTemplateForm: {
    				id: null,
    				name: null,
    				form_template_status_id: 1,
    				buyer_id: this.$userData.activeUserId
    			}
    		}
    	},
    	created() {
    		this.formFields = ["name"]
        	this.fromTable = "buyer_form_templates"

        	if (this.model && this.model.id) {
	            this.buyerFormTemplateForm = {
	                id: this.model.id,
	                name: this.model.name,
	                form_template_status_id: this.model.form_template_status_id,
	                buyer_id: this.model.buyer_id
	            }

				this.populateDefault(cloneDeep(this.model.translations))
	        }
        },
    	methods: {
    		validateForm() {
    			this.$refs.buyerFormTemplateForm.validate(valid => {
    				if (valid) {
    					if (!this.hasModel) {
    						this.create()

    						return
    					}

    					this.update()
    				}
    			})
    		},
    		create() {
    			this.loading = true;

	            let postData = cloneDeep(this.buyerFormTemplateForm)
				this.setCurrrentLangDefaultValue(postData)

            	this.$API.BuyerFormTemplate.create(postData)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        });

                        this.$EventDispatcher.fire("BUYER_FORM_TEMPLATE_MODULE_ITEM_CREATED", res.data.data);

                        this.closeForm();

                        return;
                    }

                    this.$notify({
                        title: "Failed",
                        message: this.$msg.notif.failed_add,
                        type: "error"
                    });
                })
                .catch(err => {
                    console.log(err);

                    this.showValidationError(err);
                })
                .finally(_ => {
                    this.loading = false;
                });
    		},
    		update() {
    			this.loading = true;

	            let postData = cloneDeep(this.buyerFormTemplateForm)
				this.setCurrrentLangDefaultValue(postData)

	            this.$API.BuyerFormTemplate.update(postData, postData.id)
	            .then(res => {
	                if (res.data.data) {
	                    this.$notify({
	                        title: this.__("Successful"),
	                        message: this.$msg.notif.success_update,
	                        type: "success"
	                    });

	                    this.$EventDispatcher.fire("BUYER_FORM_TEMPLATE_MODULE_ITEM_UPDATED", res.data.data);

	                    this.closeForm();

	                    return;
	                }

	                this.$notify({
	                    title: this.__("Failed"),
	                    message: this.$msg.notif.failed_update,
	                    type: "error"
	                });
	            })
	            .catch(err => {
	                console.log(err);

	                this.$notify({
	                    title: this.__("Server Error"),
	                    message: this.$msg.notif.service_error,
	                    type: "error"
	                });
	            })
	            .finally(_ => {
	                this.loading = false;
	            })
    		},
    		closeForm() {
	        	this.$refs.buyerFormTemplateForm.clearValidate();

	            this.resetForm();

	            setTimeout(_ => {
	                this.closeModal();
	            });
	        },
	        resetForm() {
	        	this.buyerFormTemplateForm = {
    				id: null,
    				name: null,
    				form_template_status_id: null
    			}
	        }
    	},
    	computed: {
    		hasModel() {
	            return this.model && this.model.id ? true : false;
	        }
    	}
	}
</script>
