<template>
	<el-dialog
    	:visible.sync="showDialog"
    	@close="closeForm"
    	:title="hasModel ? __('Update User') : __('Add New User')"
    	width="60%"
    	top="4vh"
        custom-class="dialog-custom-class">
    	<el-form
    		v-loading="loading"
    		:rules="rules"
    		:model="userForm"
    		ref="userForm"
    		autocomplete="off"
    		label-position="top">
    		<div class="row">
                <div class="col-md-6">
                    <el-form-item
                        :label="__('First Name')"
                        prop="first_name"
                        :error="hasError('first_name', true)">
                        <el-input
                            class="full-width round-input"
                            :placeholder="__('Enter First Name')"
                            clearable
                            v-model="userForm.first_name">
                        </el-input>
                    </el-form-item>

                    <el-form-item
                        :label="__('Last Name')"
                        prop="last_name"
                        :error="hasError('last_name', true)">
                        <el-input
                            class="full-width round-input"
                            :placeholder="__('Enter Last Name')"
                            clearable
                            v-model="userForm.last_name">
                        </el-input>
                    </el-form-item>

                    <el-form-item
                        :label="__('Email')"
                        prop="email"
                        :error="hasError('email', true)">
                        <el-input
                            class="full-width round-input"
                            :placeholder="__('Enter Email')"
                            clearable
                            v-model="userForm.email">
                        </el-input>
                    </el-form-item>
                </div>

                <div class="col-md-6">
                    <el-form-item
                        :label="__('User Type')"
                        prop="user_type_id"
                        :error="hasError('user_type_id', true)">
                        <el-select
                            class="full-width round-input"
                            :placeholder="__('Select User Type')"
                            filterable
                            clearable
                            @change="changeType"
                            v-model="userForm.user_type_id">
                            <el-option
                                v-for="cert in userTypes"
                                :key="cert.id"
                                :value="cert.id"
                                :label="cert.name">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item
                        v-if="showCompany"
                        :label="__('Company')"
                        prop="supplier_id"
                        :error="hasError('supplier_id', true)">
                        <!--<el-select
                            class="full-width round-input"
                            :placeholder="__('Select Company')"
                            filterable
                            clearable
                            v-model="userForm.supplier_id">
                            <el-option
                                v-for="cert in suppliers"
                                :key="cert.id"
                                :value="cert.id"
                                :label="cert.legal_name">
                            </el-option>
                        </el-select> -->
                        <el-select
                            v-model="userForm.supplier_id"
                            filterable
                            class="full-width round-input"
                            remote
                            placeholder="Please enter a keyword"
                            :remote-method="searchSupplier"
                            :loading="loadingSupplier">
                                <el-option
                                v-for="item in suppliers"
                                :key="item.id"
                                :label="item.legal_name"
                                :value="item.id">
                                </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item
                        :label="__('Phone')"
                        prop="phone"
                        :error="hasError('phone', true)">
                        <el-input
                            type="number"
                            class="full-width round-input"
                            :placeholder="__('Enter Phone')"
                            clearable
                            v-model="userForm.phone">
                        </el-input>
                    </el-form-item>

                    <el-form-item
                        :label="__('Date of Birth')"
                        prop="birth_day"
                        :error="hasError('birth_day', true)">
                        <el-date-picker
                            class="full-width round-input"
                            v-model="userForm.birth_day"
                            type="date"
                            value-format="yyyy-MM-dd"
                            clearable
                            :placeholder="__('Pick a date')">
                        </el-date-picker>
                    </el-form-item>
                </div>
            </div>
        </el-form>

        <span slot="footer" class="dialog-footer">
            <el-button
                type="text"
                class="text-black"
                style="margin-right: 20px;"
                @click="closeForm">
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
    </el-dialog>
</template>

<script>
    import moment from 'moment'
    import cloneDeep from 'lodash/cloneDeep'
    import { formHelper } from '../../../mixins/formHelper'
    import { dialogComponent } from '../../../mixins/dialogComponent'

    export default {
        name: 'UserForm',
        props: {
            userTypes: {
                type: Array,
                required: true
            },
            model: {},
        },
        mixins: [formHelper, dialogComponent],
        data() {
            return {
                loading: false,
                loadingSupplier: false,
                showCompany: false,
                userForm: {
                    id: null,
                    user_type_id: null,
                    user_business : null,
                    first_name: null,
                    last_name: null,
                    email: null,
                    phone: null,
                    birth_day: null
                },
                suppliers: [],
                rules: {
                    first_name: {required: true, message: this.__('This field is required.'), trigger: 'blur'},
                    last_name: {required: true, message: this.__('This field is required.'), trigger: 'blur'},
                    email: [
                        {required: true, message: this.__('This field is required.'), trigger: 'blur'},
                        {type: 'email', message: this.__('Invalid email.'), trigger: 'blur'}
                    ],
                    user_type_id: {required: true, message: this.__('This field is required.'), trigger: 'change'},
                    supplier_id: {required: true, message: this.__('This field is required.'), trigger: 'change'},
                }
            }
        },
        created() {
            if (this.model && this.model.id) {
                if(this.model.user_business.length < 1) {
                    this.userForm = {
                        id: this.model.id,
                        user_type_id: this.model.user_type_id,
                        first_name: this.model.first_name,
                        last_name: this.model.last_name,
                        email: this.model.email,
                        phone: this.model.phone,
                        birth_day: this.model.birth_day
                    }
                    this.showCompany = false;
                }
                else {
                    this.userForm = {
                        id: this.model.id,
                        user_type_id: this.model.user_type_id,
                        supplier_id: this.model.user_business[0].id,
                        first_name: this.model.first_name,
                        last_name: this.model.last_name,
                        email: this.model.email,
                        phone: this.model.phone,
                        birth_day: this.model.birth_day
                    }
                    this.showCompany = true;
                }
            }
            // this.getSuppliers();
        },
        methods: {
            validateForm() {
                this.$refs.userForm.validate(valid => {
                    if (valid) {
                        this.resetErrors()

                        if (this.hasModel) {
                            this.updateUser()

                            return
                        }

                        this.createUser()
                    }
                })
            },
            searchSupplier(query) {
                if(query != null) {
                    this.loadingSupplier = true
                    this.$API.User.getSuppliers(query).then(res => {
                        this.suppliers = res.data.suppliers;
                        console.log(res);
                        this.loadingSupplier = false;
                    });
                }
            },
            // getSuppliers() {
            //     this.$API.User.getSuppliers().then(res => {
            //         console.log(res.data.suppliers);
            //         this.suppliers = res.data.suppliers;
            //     });
            // },
            createUser() {
                this.loading = true

                let postData = cloneDeep(this.userForm)

                this.$API.User.createUser(postData)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('USER_MODULE_ITEM_CREATED', res.data.data)
                        this.$emit('update_total', 1);

                        this.closeForm()

                        return
                    }

                    this.$notify({
                        title: "Failed",
                        message: this.$msg.notif.failed_add,
                        type: "error"
                    })
                })
                .catch(err => {
                    console.log(err)
                    console.log(err.status)
                    this.showValidationError(err)
                })
                .finally(_ => {
                    this.loading = false
                })
            },
            updateUser() {
                this.loading = true

                let postData = cloneDeep(this.userForm)

                this.$API.User.updateUser(postData, postData.id)
                .then(res => {
                    if (res.data.data) {
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_update,
                            type: "success"
                        })

                        this.$EventDispatcher.fire('USER_MODULE_ITEM_UPDATED', res.data.data)

                        this.closeForm()

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
            closeForm() {
                this.$refs.userForm.clearValidate()
                this.resetForm()

                setTimeout(_ => {
                    this.closeModal()
                })
            },
            resetForm() {
                this.userForm = {
                    id: null,
                    user_type_id: null,
                    first_name: null,
                    last_name: null,
                    email: null,
                    phone: null,
                    birth_day: null
                }
            },
            changeType(){
                this.$API.User.checkUserType(this.userForm.user_type_id).then((res) => {
                    if(res.data.user_type == 'supplier') {
                        this.showCompany = true;
                    }
                    else {
                        this.userForm.supplier_id = null;
                        this.showCompany = false;
                    }
                });

                // this.getSuppliers();
            }
        },
        computed: {
            hasModel() {
                return this.model && this.model.id ? true : false
            }
        },
    }
</script>
