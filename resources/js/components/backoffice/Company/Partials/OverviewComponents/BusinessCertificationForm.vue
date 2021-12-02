<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeCertificationForm"
    	:title="hasModel ? __('Update Certification') : __('Add New Certification')"
    	width="60%"
    	top="4vh"
        custom-class="dialog-custom-class">
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="certificationForm"
    		ref="certificationForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
                <div class="col-md-6">
                    <el-form-item
                        :label="__('Name')"
                        prop="name"
                        :error="hasError('name', true)">
                        <el-input
                            class="full-width round-input"
                            :placeholder="__('Enter Certification Name')"
                            clearable
                            v-model="certificationForm.name">
                        </el-input>
                    </el-form-item>

                    <el-form-item
                        :label="__('Certification')"
                        prop="certification_id"
                        :error="hasError('certification_id', true)">
                        <el-select
                            class="full-width round-input"
                            :placeholder="__('Select Certification')"
                            filterable
                            clearable
                            v-model="certificationForm.certification_id">
                            <el-option
                                v-for="cert in certifications"
                                :key="cert.id"
                                :value="cert.id"
                                :label="cert.name">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item
                        :label="__('Certification No')"
                        prop="certification_no"
                        :error="hasError('certification_no', true)">
                        <el-input
                            class="full-width round-input"
                            :placeholder="__('Enter Certification No')"
                            clearable
                            v-model="certificationForm.certification_no">
                        </el-input>
                    </el-form-item>

                     <el-form-item
                        :label="__('Description')"
                        prop="description"
                        :error="hasError('description', true)">
                        <el-input
                            type="textarea"
                            :row="2"
                            class="full-width round-input"
                            :placeholder="__('Enter Description')"
                            v-model="certificationForm.description">
                        </el-input>
                    </el-form-item>
                </div>

                <div class="col-md-6">
                    <el-form-item
                        :label="__('Issued Date')"
                        prop="issued_date"
                        :error="hasError('issued_date', true)">
                        <el-date-picker
                            class="full-width round-input"
                            v-model="certificationForm.issued_date"
                            type="date"
                            value-format="yyyy-MM-dd"
                            :picker-options="issuedDateOption"
                            clearable
                            :placeholder="__('Pick a date')">
                        </el-date-picker>
                    </el-form-item>

                     <el-form-item
                        :label="__('Expiry Date')"
                        prop="expiry_date"
                        :error="hasError('expiry_date', true)">
                        <el-date-picker
                            class="full-width round-input"
                            v-model="certificationForm.expiry_date"
                            type="date"
                            value-format="yyyy-MM-dd"
                            :picker-options="expiryDateOption"
                            clearable
                            :placeholder="__('Pick a date')">
                        </el-date-picker>
                    </el-form-item>

                    <el-form-item
                        prop="is_verified"
                        :error="hasError('is_verified', true)">
                        <el-switch
                            v-model="certificationForm.is_verified"
                            active-text="Is Verified"
                            :active-value="1"
                            :inactive-value="0"
                            class="float-left">
                        </el-switch>
                    </el-form-item>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <el-form-item
                        :label="__('Certification Files')"
                        prop="image_url">
                        <el-upload
                            class="upload-demo"
                            ref="uploader"
                            action=""
                            :auto-upload="false"
                            :show-file-list="true"
                            :file-list="certificationForm.files.filter(f => !f.is_deleted)"
                            :limit="5"
                            :on-exceed="handleExceed"
                            :on-change="handleChange"
                            :on-remove="handleRemove"
                            :before-remove="beforeRemove"
                            multiple
                            name="certificationFiles">
                            <el-button size="small" type="primary">{{ __('Click to upload certificates') }}</el-button>
                        </el-upload>
                    </el-form-item>
                </div>
            </div>
        </el-form>

        <span slot="footer" class="dialog-footer">
            <el-button
                type="text"
                class="text-black"
                @click="closeCertificationForm">
                <u>{{ __('Cancel') }}</u>
            </el-button>
            <el-button
                round
                @click="validateForm"
                type="primary"
                class="btn btn-black">
                {{ __("Save") }}
            </el-button>
        </span>
    </el-dialog>
</template>

<script>
    import moment from 'moment'
    import cloneDeep from 'lodash/cloneDeep'
    import { formHelper } from '../../../../../mixins/formHelper'
    import { dialogComponent } from '../../../../../mixins/dialogComponent'

    export default {
        name: 'BusinessCertificationForm',
        mixins: [dialogComponent, formHelper],
        props: {
            model: {},
            isCreate: {
                type: Boolean,
                default: false
            },
            business: {},
            certifications: {}
        },
        data() {
            return {
                loading: false,
                certificationForm: {
                    id: null,
                    certification_id: null,
                    certification_no: null,
                    name: null,
                    description: null,
                    is_verified: false,
                    issued_date: null,
                    expiry_date: null,
                    files: [],
                    business_id: this.business ? this.business.id : null
                },
                rules: {
                    certification_id: {required: true, message: this.__('Certification is required.'), trigger: 'change'},
                    certification_no: {required: true, message: this.__('Certification No. is required.'), trigger: 'blur'},
                    issued_date: {required: true, validator: this.validateIssuedDate, trigger: 'change'},
                    expiry_date: {required: true, validator: this.validateExpiryDate, trigger: 'change'}
                },
                issuedDateOption: {
                    disabledDate: date => {
                        return moment(date).diff(this.certificationForm.expiry_date, 'days') > 0
                    }
                },
                expiryDateOption: {
                    disabledDate: date => {
                        return moment(date).diff(this.certificationForm.issued_date, 'days') < 0
                    }
                }
            }
        },
        created() {
            if (this.model && this.model.id) {
                this.certificationForm = {
                    id: this.model.id,
                    certification_id: this.model.certification_id,
                    certification_no: this.model.certification_no,
                    name: this.$sf.ucwords(this.model.name),
                    description: this.model.description,
                    is_verified: this.model.is_verified,
                    issued_date: this.model.issued_date,
                    expiry_date: this.model.expiry_date,
                    business_id: this.business.id,
                    files: this.model.medias.map(med => {
                        let exploded = med.media_url.split('/')

                        return {
                            name: exploded[exploded.length - 1],
                            url: `/storage/${med.media_url}`,
                            id: med.id,
                            is_deleted: false
                        }
                    })
                }
            }
        },
        methods: {
            validateForm() {
                this.$refs.certificationForm.validate(valid => {
                    if (valid) {
                        this.resetErrors()

                        if (this.isCreate) {
                            this.addToSaveList()
                        } else {
                             if (this.hasModel) {
                                this.updateCertification()

                                return
                            }

                            this.saveNewCertification()
                        }
                    }
                })
            },
            addToSaveList() {
                this.$EventDispatcher.fire('BUSINESS_CERTIFICATION_MODULE_ITEM_CREATED', cloneDeep(this.certificationForm))

                this.closeCertificationForm()
            },
            saveNewCertification() {
                this.loading = true

                let postData = cloneDeep(this.certificationForm)

                this.$API.BusinessCertification.createNewCertification(postData)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('BUSINESS_CERTIFICATION_MODULE_ITEM_CREATED', res.data.data)

                        this.closeCertificationForm()

                        return
                    }

                    this.$notify({
                        title: this.__("Failed"),
                        message: this.$msg.notif.failed_add,
                        type: "error"
                    })
                })
                .catch(err => {
                    console.log(err)

                    this.showValidationError(err)
                })
                .finally(_ => {
                    this.loading = false
                })
            },
            updateCertification() {
                this.loading = true

                let postData = cloneDeep(this.certificationForm)

                this.$API.BusinessCertification.updateCertification(postData, postData.id)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_update,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('BUSINESS_CERTIFICATION_MODULE_ITEM_UPDATED', res.data.data)

                        this.closeCertificationForm()

                        return
                    }

                    this.$notify({
                        title: this.__("Failed"),
                        message: this.$msg.notif.failed_update,
                        type: "error"
                    })
                })
                .catch(err => {
                    console.log(err)

                    this.showValidationError(err)
                })
                .finally(_ => {
                    this.loading = false
                })
            },
            closeCertificationForm() {
                this.$refs.certificationForm.clearValidate()
                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
            },
            resetForm() {
                this.certificationForm = {
                    id: null,
                    certification_id: null,
                    certification_no: null,
                    name: null,
                    description: null,
                    is_verified: false,
                    issued_date: null,
                    expiry_date: null,
                    business_id: this.business ? this.business.id : null,
                    files: []
                }
            },
            validateIssuedDate(rule, value, callback) {
                if (!value) {
                    callback(new Error(this.__('Issued Date is required.')))
                }

                let issuedDate = moment(value)
                let expiryDate = moment(this.certificationForm.expiry_date)

                if (issuedDate.isAfter(expiryDate)) {
                    callback(new Error(this.__('Issued Date should be lesser than the expiry date.')))
                }

                callback()
            },
            validateExpiryDate(rule, value, callback) {
                if (!value) {
                    callback(new Error(this.__('Expiry Date is required.')))
                }

                let issuedDate = moment(this.certificationForm.issued_date)
                let expiryDate = moment(value)

                if (issuedDate.isAfter(expiryDate)) {
                    callback(new Error(this.__('Expiry Date should be greater than the issued date.')))
                }

                callback()
            },
            // file handlers
            handleExceed(files, fileList) {
                this.$notify({
                    title: this.__("File Limit Exceed"),
                    message: this.__('The limit is 5, you cannot select files more than 5.'),
                    type: "warning"
                })
            },
            handleChange(file, fileList) {
                this.certificationForm.files.push(file)
            },
            beforeRemove(file, fileList) {
                return this.$confirm(`Are you sure you want to remove ${ file.name } ?`);
            },
            handleRemove(file, fileList) {
                if (file.hasOwnProperty('id')) {
                    file.is_deleted = true
                } else {
                    let index = this.certificationForm.files.findIndex(f => f.uid == file.uid)

                    if (index > -1) {
                        this.certificationForm.files.splice(index, 1)
                    }
                }
                /*this.$notify({
                    title: this.__("Successful"),
                    message: this.__("Certificate file has been removed."),
                    type: "success"
                });*/
            },
            showValidationError(err) {
                let errors = [];
                const h = this.$createElement;
                if(err.response && err.response.status == 422) {
                    if(err.response.data.errors) {
                        for (var key in err.response.data.errors) {
                            errors.push(err.response.data.errors[key][0]);
                        }

                        this.$notify({
                            title: "Error",
                            message: h('div', { style: 'list-style-type: none' }, errors.map(errmsg => {
                            return h('div', { style: 'list-style-type: none' }, errmsg);
                            })),
                            type: "error"
                        });
                    }
                }
            }
        },
        computed: {
            hasModel() {
                return this.model && this.model.id ? true : false
            }
        }
    }
</script>

<style lang="scss">
    .dialog-custom-class {
        .upload-demo {
            .el-upload-list__item {
                line-height: 24px !important;
                border: none !important;
                padding: 0 !important;
                font-size: 12px;
                text-align: left !important;
            }
        }
    }
</style>
