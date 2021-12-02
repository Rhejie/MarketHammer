<template>
    <div class="form-details" v-loading = "pageLoading">
            <el-button
                 type="text"
                 style="font-size: 14px;color: #000;"
                 @click="backToIndex">
                <i class="fas fa-arrow-left ml-2"></i> {{ __('Back To List')}}
            </el-button>
        <el-card  class="box-card full-width">
            <div class="content-header detail-hearder">
                <div class="header-details-wrapper">
                    <div class="header-title-details">
                        {{ formSupplier.form_submission ? formSupplier.form_submission.form_title : "" }}
                    </div>
                    <div class="header-subtitle-details">
                        <div class="subs">
                            <div class="subs-title-details">{{ __("Form ID") }}:</div>
                            <div class="subs-content-details">
                                {{ formSupplier.form_submission ? formSupplier.form_submission.form_id : "" }}
                            </div>
                        </div>
                        <div class="subs">   
                            <div class="subs-title-details">{{ __("Form Type") }}:</div>
                            <div class="subs-content-details">
                                {{ formSupplier.form_submission && formSupplier.form_submission.form_type ? formSupplier.form_submission.form_type.name : "" }}
                            </div>
                        </div>
                        <div class="subs">
                            <div class="subs-title-details">{{ __("Ref ID") }}:</div>
                            <div class="subs-content-details">
                                {{ formSupplier.form_submission ? formSupplier.form_submission.form_id : null }}
                            </div>
                        </div>
                        <div class="subs">
                            <div class="subs-title-details">{{ __("Sent From") }}</div>
                            <div class="subs-content-details">
                                {{ formSupplier.buyer ? formSupplier.buyer.first_name + " " + formSupplier.buyer.last_name : "" }}
                            </div>
                        </div>
                        <div class="subs">
                            <div class="subs-title-details">{{ __("Status") }}</div>
                            <div class="subs-content-details">
                                {{ formSupplier.status ? __($sf.ucfirst(formSupplier.status)) : "" }}
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="ml-auto" style="padding-right: 20px;" >
                         {{ __("Action") }}
                        <el-select
                            v-model="formSupplier.status"
                            style="width: 150px;margin-left: 20px;"
                            class="round-input"
                            :placeholder="__('Select')"
                            @change = "changeStatus">
                            <el-option :label="__('Open')"  :value="'open'"></el-option>
                            <el-option :label="__('Accept')"  :value="'accepted'"></el-option>
                            <el-option :label="__('Decline')"  :value="'rejected'"></el-option>
                            <el-option style="display: none" :label="__('Submitted')"  :value="'submitted'"></el-option>
                        </el-select>
                    </div>
            </div>
            <!-- <div slot="header" class="clearfix"> -->
                <!-- <div class="pull-left">
                    
                    <h4>{{ formSupplier.form_submission ? formSupplier.form_submission.form_title : "" }}</h4>
                </div> -->

                <!-- <div class="ml-auto pull-right mg-t-5" v-if = "formSupplier.status != 'submitted'">
                    {{ __("Action") }}
                    <el-select
                        v-model="formSupplier.status"
                        style="width: 120px"
                        class="round-input"
                        :placeholder="__('Select')"
                        @change = "changeStatus">
                        <el-option :label="__('Open')"  :value="'open'"></el-option>
                        <el-option :label="__('Accept')"  :value="'accepted'"></el-option>
                        <el-option :label="__('Decline')"  :value="'rejected'"></el-option>
                    </el-select>
                </div> -->
                <!-- <div class = "pd-20">
                <el-row :gutter = "20" class = "">
                    <el-col :span = "3">
                        <div class="mg-b-10">
                            <label>{{ __("Form ID") }}:</label> <br>
                            <span>{{ formSupplier.form_submission ? formSupplier.form_submission.form_id : "" }}</span>
                        </div>

                    </el-col>
                    <el-col :span = "3">
                        <div class="mg-b-10">
                            <label>{{ __("Form Type") }}:</label> <br>
                            <span>{{ formSupplier.form_submission && formSupplier.form_submission.form_type ? formSupplier.form_submission.form_type.name : "" }}</span>
                        </div>

                    </el-col>
                    <el-col :span = "3">
                        <div class="mg-b-10">
                            <label>{{ __("Ref ID") }}:</label> <br>
                            <span>{{ formSupplier.form_submission ? formSupplier.form_submission.form_id : null }}</span>
                        </div>
                    </el-col>
                    <el-col :span = "3">
                        <div class="mg-b-10">
                            <label>{{ __("Sent From") }}</label> <br>
                            <span>{{ formSupplier.buyer ? formSupplier.buyer.first_name + " " + formSupplier.buyer.last_name : "" }}</span>
                        </div>
                    </el-col>
                    <el-col :span = "3">
                        <div class="mg-b-10">
                            <label>{{ __("Status") }}</label> <br>
                            <span>{{ formSupplier.status ? __($sf.ucfirst(formSupplier.status)) : "" }}</span>
                        </div>
                    </el-col>
                </el-row>
                </div> -->
            <!-- </div> -->

        </el-card>
        <el-card class="mg-t-10 form-display">
            <!-- <div class = "confidential"><img src="/image/confidential.png"></div> -->
            <div class = "container-conf" v-if = "watermarkText">
                <p class = "confidential"> {{ watermarkText }} </p>
            </div>

            <div class = "field-list-display pd-20">
                <div v-for="(group, index) in formFieldGroups"
                    :key="index" class = "mg-b-10">
                    <label class = "group-title">{{ group.name }}</label>
                    <form-field-display :fields-list = "group.form_fields" v-if = "group.form_fields" :form-disabled = "canUpdate ? false : true">
                    </form-field-display>
                </div>

            </div>
            <div class = "pull-right mg-t-20 pd-20" v-if = "canUpdate">
                <el-button @click="saveFormAnswer()" type="primary"> {{ __('Save') }} </el-button>
                <el-button @click="submitForm()" class="btn-black" type="primary"> {{ __('Submit') }} </el-button>
            </div>
        </el-card>
    </div>
</template>

<script>
    import _forEach from 'lodash/forEach'
    import cloneDeep from 'lodash/cloneDeep'
    export default {
        props: {
            pageData: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                pageLoading : false,
                viewData : 'open',
                formDetails : {},
                formId : null,
                formSupplier : {status : null},
                formFields : [],
                originFormGroup : [],
                formFieldGroups : [],
            }
        },
        created() {
            this.formId = this.$route && this.$route.params && this.$route.params.id ? this.$route.params.id : null
            this.formSupplier = this.$route && this.$route.params && this.$route.params.data ? this.$route.params.data : {}
            this.getFormDetails()
        },
        computed:{
            watermarkText(){
                if(this.formSupplier.status == "open"){
                    return this.__('Confidential')
                }
                /*else if(this.formSupplier.status == "submitted"){
                    return this.__('Submitted')
                }*/
                else if(this.formSupplier.status == "rejected"){
                    return this.__('Rejected')
                }
                return null

            },
            canUpdate(){
                //If expire can't update
                let dateNow = this.$df.formatDate(new Date(), 'YYYY-MM-DD')
                if(this.formSupplier && this.formSupplier.form_submission && this.formSupplier.form_submission.expiration_date
                    && this.$df.formatDate(this.formSupplier.form_submission.expiration_date, 'X') < this.$df.formatDate(dateNow, 'X')){
                    return false
                }
                if(this.formSupplier && this.formSupplier.status == "accepted"){
                    return true
                }

                return false
            }
        },
        methods: {
            async getFormDetails(){
                if (!this.formId) return

                this.pageLoading = true

                let postData = {
                    id: this.formId
                }
                await this.$API.BusinessRfq.getFormDetails(postData)
                .then(res => {
                    let result = res.data
                    this.formSupplier = result.formSupplier
                    this.formFields = result.formFields
                    this.originFormGroup = result.formFieldGroups
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {

                })

                await this.setFormFieldGroup()
                this.pageLoading = false
            },
            async getFormFields(){
                if (!this.formSupplier || !this.formSupplier.id) return

                this.pageLoading = true

                let postData = {
                    form_submission_id: this.formSupplier.form_submission_id,
                    supplier_id : this.formSupplier.supplier_id
                }
                await this.$API.BusinessRfq.getFields(postData)
                .then(res => {
                    let result = res.data
                    this.formFields = result.formFields
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {

                })

                await this.setFormFieldGroup()
                this.pageLoading = false
            },
            setFormFieldGroup(){
                let fieldGroup = cloneDeep(this.originFormGroup)
                _forEach(fieldGroup, group =>{
                    let getFields = cloneDeep(this.formFields).filter( fn => { return fn.form_submission_group_id == group.id})
                    group.form_fields = getFields
                })
                this.formFieldGroups = fieldGroup
            },
            backToIndex() {
                this.$router.push({name: 'Supplier RFQ List'})
            },
            async saveFormAnswer(submit = false){
                //Get answer
                let answerData = this.getAnswer()
                let postData = {
                    field_answer_list : answerData,
                    to_submit : submit
                }
                console.log("postData", postData)
                this.pageLoading = true
                await this.$API.FormFieldAnswer.saveAnswer(postData)
                .then(res => {
                    let result = res.data

                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {
                    this.pageLoading = false
                })

                this.getFormFields()
            },
            changeStatus(val){
                this.updateStatusForm(val)
            },
            async submitForm(){
                let submit = false
                await this.$confirm(this.__('Are you sure you want to submit your answer?'), this.__('Submit Answer'), {
                    confirmButtonText: this.__('Submit'),
                    cancelButtonText: this.__('Cancel'),
                    type: 'warning',
                    confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    submit = true
                })
                .catch(() => {});
                if(submit){
                    await this.saveFormAnswer(true)
                    await this.updateStatusForm('submitted')
                }

            },
            updateStatusForm(status){
                //Get answer
                let postData = {
                    id : this.formSupplier.id,
                    status : status
                }

                this.pageLoading = true
                this.$API.FormSubmissionToSupplier.update(postData)
                .then(res => {
                    let result = res.data
                    this.formSupplier.status = result.data.status
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {
                    this.pageLoading = false
                })
            },

            getAnswer(){
                let list = []

                _forEach(this.formFieldGroups, group =>{

                    _forEach(group.form_fields, fn =>{
                        let arr = {
                            form_submission_to_supplier_id : this.formSupplier.id,
                            form_submission_form_field_id : fn.id,
                            supplier_id : this.formSupplier.supplier_id,
                            buyer_id : this.formSupplier.buyer_id,
                            value : fn.field_answer_value
                        }
                        if(fn.field_answer_value){
                            let val = fn.field_answer_value

                            let valueType = this.$ffh.getPropertyFieldType(fn.field_type, 'value_type')
                            if(valueType == 'multiple'){
                                val = {values : fn.field_answer_value}
                                val = JSON.stringify(val);
                            }
                            else if(valueType == 'matrix'){
                                val = JSON.stringify(fn.field_answer_value);
                            }
                            arr.value = val
                        }

                        if(fn.field_answer_id){
                            arr.id = fn.field_answer_id
                        }

                        list.push(arr)

                    })
                })

                return list
            }
        },
    }
</script>
<style lang="scss">
.form-details{
    margin-top: 5px;

    .form-display{
        position: relative;
    }

    .container-conf {
        position: absolute;
        bottom: 0;
        top: 0;
        background: rgb(0, 0, 0); /* Fallback color */
        background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
        color: #f1f1f1;
        width: 100%;
        padding: 20px;
        z-index: 99;

        .confidential{
            color: #d3d3d3;
            font-size: 120px;
            transform: rotate(300deg);
            -webkit-transform: rotate(340deg);
            position: fixed;
            margin-left: 16%;
            margin-top: 5%;
        }
    }

    .field-list-display{
        min-height: 360px;
        overflow-y: scroll;

        label.group-title{
            font-size: 16px;
            margin-bottom: 0pc;
        }
    }
}
</style>
