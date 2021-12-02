<template>
    <el-dialog
        :visible.sync="showDialog"
        @close="closeForm"
        :title="hasModel ? __('Update SNS') : __('Add New SNS')"
        width="60%"
        top="4vh"
    >
        <el-form
            v-loading="loading"
            :rules="rules"
            :model="snsForm"
            ref="snsForm"
            autocomplete="off"
            label-position="top"
        >
            <div class="row">
                <div class="col-md-6">
                    <el-form-item :label="__('SNS Name')" prop="name">
                        <el-input
                            class="full-width round-input"
                            :placeholder="__('Enter SNS Name')"
                            clearable
                            v-model="snsForm.name"
                        >
                        </el-input>
                        <value-translator-btn
                            @showTranslationForm="
                                setTranslationForm('name', snsForm.name, 'text')
                            "
                        >
                        </value-translator-btn>
                    </el-form-item>

                    <el-form-item :label="__('Description')" prop="description">
                        <el-input
                            class="full-width round-input"
                            :placeholder="__('Translation Description')"
                            type="textarea"
                            :rows="8"
                            v-model="snsForm.description"
                        >
                        </el-input>
                        <value-translator-btn
                            @showTranslationForm="
                                setTranslationForm(
                                    'description',
                                    snsForm.description,
                                    'textarea'
                                )
                            "
                        >
                        </value-translator-btn>
                    </el-form-item>
                </div>

                <div class="col-md-6">
                    <el-form-item :label="__('Website')" prop="website">
                        <el-input
                            class="full-width round-input"
                            :placeholder="__('Enter Website')"
                            clearable
                            v-model="snsForm.website"
                        >
                        </el-input>
                    </el-form-item>

                    <el-form-item :label="__('Color')" prop="color">
                        <el-color-picker
                            class="full-width"
                            v-model="snsForm.color"
                            :predefine="predefineColors"
                        >
                        </el-color-picker>
                    </el-form-item>
                </div>
            </div>
        </el-form>

        <span slot="footer" class="dialog-footer">
            <el-button type="text" class="text-black" @click="closeForm">
                <u>{{ __("Cancel") }}</u>
            </el-button>
            <el-button
                round
                @click="validateForm"
                type="primary"
                class="btn btn-black"
            >
                {{ hasModel ? __('Save') : __('Save') }}
            </el-button>
        </span>
        <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData"
        >
        </value-translator-form>
    </el-dialog>
</template>

<script>
import cloneDeep from "lodash/cloneDeep";
import { formHelper } from "../../../mixins/formHelper";
import { dialogComponent } from "../../../mixins/dialogComponent";
import translationForm from "../../../mixins/translationForm.js";

export default {
    name: "SnsForm",
    mixins: [formHelper, dialogComponent, translationForm],
    props: {
        model: {}
    },
    data() {
        return {
            snsForm: {
                id: null,
                name: null,
                description: null,
                website: null,
                color: null
            },
            rules: {
                name: {
                    required: true,
                    message: this.__("This field is required."),
                    trigger: "blur"
                }
            },
            predefineColors: [
                "#3B5998",
                "#60B1EF",
                "#3D7BB7",
                "#DD357D",
                "#62CD42",
                "#2B4662",
                "#FDFC00",
                "#CB2827",
                "#E7412C"
            ],
            loading: false
        };
    },
    created() {
        this.formFields = ["name", "description"];
        this.fromTable = "sns_list";

        if (this.model && this.model.id) {
            this.snsForm = {
                id: this.model.id,
                name: this.model.name,
                description: this.model.description,
                website: this.model.website,
                color: this.model.color
            };
			this.populateDefault(cloneDeep(this.model.translations))
        }
    },
    methods: {
        validateForm() {
            this.$refs.snsForm.validate(valid => {
                if (valid) {
                    this.resetErrors();

                    if (this.hasModel) {
                        this.updateSns();

                        return;
                    }

                    this.saveNewSns();
                }
            });
        },
        saveNewSns() {
            this.loading = true;

            let postData = cloneDeep(this.snsForm);
			this.setCurrrentLangDefaultValue(postData);

            this.$API.Sns.create(postData)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        });

                        this.$EventDispatcher.fire(
                            "SNS_MODULE_ITEM_CREATED",
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
        updateSns() {
            this.loading = true;

            let postData = cloneDeep(this.snsForm);
			this.setCurrrentLangDefaultValue(postData);

            this.$API.Sns.update(postData, postData.id)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_update,
                            type: "success"
                        });

                        this.$EventDispatcher.fire(
                            "SNS_MODULE_ITEM_UPDATED",
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
            this.$refs.snsForm.clearValidate();

            this.resetForm();

            setTimeout(_ => {
                this.closeModal();
            });
        },
        resetForm() {
            this.snsForm = {
                id: null,
                name: null,
                description: null,
                website: null,
                color: null
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
