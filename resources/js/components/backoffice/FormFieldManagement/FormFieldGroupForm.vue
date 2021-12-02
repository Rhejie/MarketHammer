<template>
    <el-dialog
        :visible.sync="showDialog"
        @close="closeForm"
        :title="hasModel ? __('Update Form Group') : __('Add New Form Group')"
        width="40%"
        top="4vh"
        append-to-body>
        <el-form
            v-loading="loading"
            :rules="rules"
            :model="formFieldGroupForm"
            ref="formFieldGroupForm"
            autocomplete="off"
            label-position="top">
            <el-form-item :label="__('Name')" prop="name">
                <el-input
                    class="full-width round-input"
                    :placeholder="__('Enter Name')"
                    clearable
                    v-model="formFieldGroupForm.name">
                </el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('name', formFieldGroupForm.name, 'text')">
                </value-translator-btn>
            </el-form-item>

            <el-form-item
                :label="__('Description')"
                prop="description">
                <el-input
                    class="full-width round-input"
                    :placeholder="__('Translation Description')"
                    type="textarea"
                    :rows="4"
                    v-model="formFieldGroupForm.description">
                </el-input>
                <value-translator-btn
                    @showTranslationForm="setTranslationForm('description', formFieldGroupForm.description, 'textarea')">
                </value-translator-btn>
            </el-form-item>
        </el-form>

        <span slot="footer" class="dialog-footer">
            <el-button type="text" class="text-black" @click="closeForm">
                <u>{{ __("Cancel") }}</u>
            </el-button>
            <el-button
                round
                @click="validateForm"
                type="primary"
                class="btn btn-black">
                {{ hasModel ? __('Save') : __('Save') }}
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
import translationForm from "../../../mixins/translationForm.js";

export default {
    name: "FormFieldGroupForm",
    mixins: [formHelper, dialogComponent, translationForm],
    props: {
        model: {}
    },
    data() {
        return {
            formFieldGroupForm: {
                id: null,
                name: null,
                description: null
            },
            rules: {
                name: {required: true, message: this.__("This field is required."), trigger: "blur"}
            },
            loading: false
        };
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "form_field_groups";

        if (this.model && this.model.id) {
            this.formFieldGroupForm = {
                id: this.model.id,
                name: this.model.name,
                description: this.model.description
            }

			this.populateDefault(cloneDeep(this.model.translations))
        }
    },
    methods: {
        validateForm() {
            this.$refs.formFieldGroupForm.validate(valid => {
                if (valid) {
                    this.resetErrors();

                    if (this.hasModel) {
                        this.update();

                        return;
                    }

                    this.create();
                }
            });
        },
        create() {
            this.loading = true;

            let postData = cloneDeep(this.formFieldGroupForm);
			this.setCurrrentLangDefaultValue(postData);

            this.$API.FormFieldGroup.create(postData)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        });

                        this.$EventDispatcher.fire(
                            "FORM_FIELD_GROUPS_MODULE_ITEM_CREATED",
                            res.data.data
                        );

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

            let postData = cloneDeep(this.formFieldGroupForm);
			this.setCurrrentLangDefaultValue(postData);

            this.$API.FormFieldGroup.update(postData, postData.id)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_update,
                            type: "success"
                        });

                        this.$EventDispatcher.fire(
                            "FORM_FIELD_GROUPS_MODULE_ITEM_UPDATED",
                            res.data.data
                        );

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
                });
        },
        closeForm() {
            this.$refs.formFieldGroupForm.clearValidate();

            this.resetForm();

            setTimeout(_ => {
                this.closeModal();
            });
        },
        resetForm() {
            this.formFieldGroupForm = {
                id: null,
                name: null,
                description: null
            };
        }
    },
    computed: {
        hasModel() {
            return this.model && this.model.id ? true : false;
        }
    }
};
</script>

<style lang="scss">
.el-color-picker__trigger {
    width: 100% !important;
}
</style>
