    <template>
        <div class ="product-form" v-loading = "pageLoading">
            <div class="container mt-3">
                <el-form :model="form" :rules="rulesForm" label-position = "top" ref="form" class="demo-ruleForm">
                    <el-row :gutter = "20">
                        <el-col :span = "8">

                            <el-form-item :label="__('Product Name')" prop="name">

                                <el-select
                                    v-if = "enableSelectProduct"
                                    v-model="form.product_name"
                                    remote
                                    filterable
                                    allow-create
                                    @change = "changeSelectProduct"
                                    :placeholder="__('Enter product name')"
                                    :remote-method="getProductSelect"
                                    :loading="selectLoading"
                                    class="cluster-dropdown full-width">
                                    <el-option
                                        v-for="item in productSelectList"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>

                                <el-input
                                    v-else
                                    v-model="form.name"
                                    class="full-width"
                                    :disabled="isDisable">
                                </el-input>

                                <div class="notice" v-if = "!enableSelectProduct">
                                    <value-translator-btn
                                        @showTranslationForm="setTranslationForm('name', form.name, 'text')">
                                    </value-translator-btn>
                                    <!-- <a href='javascript:void(0)' @click = "setTranslationForm" :class = "(isDisable ? 'not-allowed' : '') + ' text-black underline'">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Set Translation
                                    </a> -->
                                </div>
                            </el-form-item>

                        <el-form-item :label="__('Brand Name')" prop="brand_name">
                            <el-input v-model="form.brand_name" class="full-width" :disabled = "isDisable" ></el-input>
                        </el-form-item>

                        <el-form-item :label="__('Bar Code')" prop="bar_code">
                            <el-input v-model="form.bar_code" class="full-width" :disabled = "isDisable" ></el-input>
                        </el-form-item>

                        <el-form-item :label="__('Model No.')" prop="model_no">
                            <el-input v-model="form.model_no" class="full-width" :disabled = "isDisable" ></el-input>
                        </el-form-item>

                        <el-form-item :label="__('Product Details')" prop="details">
                            <el-input type="textarea" v-model="form.details" class="full-width" :rows="3" :disabled = "isDisable"></el-input>
                        </el-form-item>

                    </el-col>
                    <el-col :span = "8">

                        <el-form-item :label="__('Master Category')" prop="master_category_id">
                            <el-select v-model="form.master_category_id"
                                filterable
                                :placeholder="__('Select')"
                                class="full-width"
                                :disabled = "isDisable"
                                @change = "changeCat('master')">
                                <el-option
                                  v-for="item in masterCategories"
                                  :key="item.id"
                                  :label="item.name"
                                  :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item :label="__('Main Category')" prop="main_category_id">
                            <el-select v-model="form.main_category_id"
                                filterable
                                :placeholder="__('Select')"
                                class="full-width"
                                :disabled = "isDisable"
                                @change = "changeCat('main')">
                                <el-option
                                  v-for="item in mainCategories"
                                  :key="item.id"
                                  :label="item.name"
                                  :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item :label="__('Sub Category')" prop="sub_category_id">
                            <el-select v-model="form.sub_category_id"
                                filterable
                                :placeholder="__('Select')"
                                class="full-width"
                                :disabled = "isDisable"
                                @change = "changeCat('sub')">
                                <el-option
                                  v-for="item in subCategories"
                                  :key="item.id"
                                  :label="item.name"
                                  :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item :label="__('Unit of Measure')" prop="unit_of_measure_id">
                            <el-select v-model="form.unit_of_measure_id"
                                filterable
                                :placeholder="__('Select')"
                                class="full-width"
                                :disabled = "isDisable">
                                <el-option
                                  v-for="item in measurements"
                                  :key="item.id"
                                  :label="item.name"
                                  :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item :label="__('Origin')" prop="origin">
                            <el-input type="textarea" v-model="form.origin" class="full-width"  :disabled = "isDisable" :rows="3"></el-input>
                        </el-form-item>

                        <el-form-item
                            :label="__('Private')"
                            prop="is_private">
                            <el-switch
                                style="display: inline-block;"
                                :disabled = "isDisable"
                                v-model="form.is_private"
                                :active-value="1"
                                :inactive-value="0">
                            </el-switch>
                        </el-form-item>


                    </el-col>

                    <el-col :span = "8">

                        <el-form-item :label="__('Introduction')" prop="introduction">
                            <el-input type="textarea" v-model="form.introduction" class="full-width" :disabled = "isDisable" :rows="3"></el-input>
                        </el-form-item>

                        <el-form-item :label="__('Features')" prop="features">
                            <el-input type="textarea" v-model="form.features" class="full-width" :disabled = "isDisable" :rows="3"></el-input>
                        </el-form-item>

                        <el-form-item :label="__('Specification')" prop="specification">
                            <el-input type="textarea" v-model="form.specification" class="full-width" :disabled = "isDisable" :rows="3"></el-input>
                        </el-form-item>

                        <el-form-item :label="__('Warranty')" prop="warranty">
                            <el-input type="textarea" v-model="form.warranty" class="full-width" :disabled = "isDisable" :rows="3"></el-input>
                        </el-form-item>


                    </el-col>

                </el-row>


            </el-form>
            <template v-if = "businessData">
                <h4>{{ __('Business Product') }}</h4>
                <el-form :model="businessProductForm" label-position = "top" ref="businessProductForm">
                    <el-row :gutter = "20">
                        <el-col :span = "8">
                            <el-form-item
                                :label="__('Is Primary')"
                                prop="is_primary">
                                <el-switch
                                    :disabled = "isDisableBusinessProduct"
                                    v-model="businessProductForm.is_primary"
                                    :active-value="1"
                                    :inactive-value="0">
                                </el-switch>
                            </el-form-item>

                            <el-form-item :label="__('MOQ')" prop="moq">
                                <el-input v-model="businessProductForm.moq" class="full-width" :disabled = "isDisableBusinessProduct" ></el-input>
                            </el-form-item>

                            <el-form-item :label="__('Sample Price')" prop="sample_price">
                                <el-input v-model="businessProductForm.sample_price" class="full-width" :disabled = "isDisableBusinessProduct" ></el-input>
                            </el-form-item>

                        </el-col>
                        <el-col :span = "8">

                            <el-form-item
                                :label="__('Ready Made')"
                                prop="is_ready_made">
                                <el-switch
                                    :disabled = "isDisableBusinessProduct"
                                    v-model="businessProductForm.is_ready_made"
                                    :active-value="1"
                                    :inactive-value="0">
                                </el-switch>
                            </el-form-item>

                            <el-form-item :label="__('Port')" prop="port">
                                <el-input v-model="businessProductForm.port" class="full-width" :disabled = "isDisableBusinessProduct" ></el-input>
                            </el-form-item>

                            <el-form-item :label="__('Revenue Last Year')" prop="rev_last_year">
                                <el-input v-model="businessProductForm.rev_last_year" class="full-width" :disabled = "isDisableBusinessProduct" ></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span = "8">

                            <el-form-item :label="__('Monthly Ability')" prop="monthly_ability">
                                <el-input v-model="businessProductForm.monthly_ability" class="full-width" :disabled = "isDisableBusinessProduct" ></el-input>
                            </el-form-item>

                            <el-form-item :label="__('Pack Details')" prop="pack_details">
                                <el-input type="textarea" v-model="form.pack_details" class="full-width" :disabled = "isDisableBusinessProduct" :rows="3"></el-input>
                            </el-form-item>
                        </el-col>

                    </el-row>
                </el-form>
            </template>

            <el-row :gutter = "20" class = "mt-4" v-if = "!hasModel">
                <el-col :span = "24">
                    <div class="text-right">
                        <button type="button" class="btn btn-default" @click="cancelForm"> {{ __('Cancel') }}</button>
                        <button type="button" class="btn btn-primary btn-black" @click="saveForm"> {{ __('Save') }} </button>
                    </div>
                </el-col>
            </el-row>
        </div>
         <!-- EL DIALOG FOR TRANSLATION -->
        <value-translator-form
            ref="translationForm"
            :translation-form="translationModel"
            v-if="showTranslationForm"
            :visible.sync="showTranslationForm"
            @close="handleCloseTranslation"
            @settranslationdata="setTranslationData">
        </value-translator-form>
    </div>
</template>

<script>
window.noty = require('noty')
import Noty from 'noty'

import _forEach from 'lodash/forEach'
import cloneDeep from 'lodash/cloneDeep'
import __message from '../../../mixins/messageAlert.js'
import translationForm from '../../../mixins/translationForm.js'

export default {
    props: {
        isCreate: {
            type: Boolean,
            default: false
        },
        pageData : {
            required: false
        },
        model : {}
    },
    data() {
        let form = {
            bar_code : null,
            name : null,
            model_no : null,
            brand_name : null,
            details : null,
            introduction : null,
            features : null,
            specification : null,
            warranty : null,
            master_category_id: null,
            main_category_id: null,
            sub_category_id: null,
            origin: null,
            unit_of_measure_id: null,
            is_private: 0,
            product_name : null
        }
        let businessProductForm  = {
            id : null,
            business_id : null,
            product_id : null,
            moq : null,
            sample_price : null,
            monthly_ability : null,
            port : null,
            is_ready_made : null,
            is_primary : null,
            pack_details : null,
            rev_last_year : null,
        }


        return {
            form            : form,
            rulesForm       : {},
            categories      : this.pageData.categories,
            measurements      : this.pageData.measurements,
            pageLoading     : false,
            businessProductForm : businessProductForm,
            businessData : this.pageData.business ? this.pageData.business : null,
            selectLoading   : false,
            productSelectList : [],
            selectedSelectProduct : null
        }
    },
    mixins: [__message, translationForm],
    computed: {
        masterCategories: function(){
            return this.categories.filter(cat => cat.master_product_category_id == null)
        },
        mainCategories: function(){
            if (this.form.master_category_id) {
                return this.categories.filter(cat => cat.master_product_category_id == this.form.master_category_id
                    && cat.main_product_category_id == null)
            }

            return []
        },
        subCategories: function() {
            if (this.form.main_category_id) {
                return this.categories.filter(cat => cat.main_product_category_id == this.form.main_category_id)
            }

            return []
        },
        hasModel() {
            return this.model && this.model.id ? true : false
        },
        isDisable(){
            if((this.pageData && this.pageData.forceDisable === true) || this.selectedSelectProduct){
                return true
            }
            return false
        },
        isDisableBusinessProduct(){
            if((this.pageData && this.pageData.forceDisable === true)){
                return true
            }
            return false
        },
        //Allow to select existing product if add mode and has business data
        enableSelectProduct(){
            if(!this.hasModel && this.businessData){
                return true
            }
            return false
        }
    },
    created() {
        this.formFields = ['name']
        this.fromTable = 'product'

        this.rulesForm = {
            name: [
                { required: true, message: this.__('This field is required.'), trigger: 'blur' },
            ],
            master_category_id: [
                { required: true, message: this.__('This field is required.'), trigger: 'change' },
            ],
            main_category_id: [
                { required: true, message: this.__('This field is required.'), trigger: 'change' },
            ],
            sub_category_id: [
                { required: true, message: this.__('This field is required.'), trigger: 'change' },
            ],
            unit_of_measure_id: [
                { required: true, message: this.__('This field is required.'), trigger: 'change' },
            ]
        }
    },
    mounted() {
        this.setData(this.model)
    },
    methods: {
        getProductSelect(query){
            this.selectLoading = true
            this.selectedSelectProduct = null

            let postData = {searchString : query, not_in_business_id : this.businessData ? this.businessData.id : null}

            this.$API.Product.productList(postData)
            .then(res => {
                let result = res.data
                if (result.product) {
                    this.productSelectList = result.product.data
                }
            })
            .catch(err => {
                console.log(err)
            })
            .finally(_ => {
                this.selectLoading = false
            })
        },
        changeSelectProduct(val){
            this.selectedSelectProduct = this.productSelectList.find(fn => fn.id == val)
            if(this.selectedSelectProduct){
                this.form.bar_code = this.selectedSelectProduct .bar_code
                this.form.name = this.selectedSelectProduct.name
                this.form.model_no = this.selectedSelectProduct.model_no
                this.form.brand_name = this.selectedSelectProduct.brand_name
                this.form.details = this.selectedSelectProduct.details
                this.form.introduction = this.selectedSelectProduct.introduction
                this.form.features = this.selectedSelectProduct.features
                this.form.specification = this.selectedSelectProduct.specification
                this.form.warranty = this.selectedSelectProduct.warranty
                this.form.master_category_id = this.selectedSelectProduct.master_category_id
                this.form.main_category_id = this.selectedSelectProduct.main_category_id
                this.form.sub_category_id = this.selectedSelectProduct.sub_category_id
                this.form.origin = this.selectedSelectProduct.origin
                this.form.unit_of_measure_id = this.selectedSelectProduct.unit_of_measure_id
                this.form.is_private = this.selectedSelectProduct.is_private
            }
        },
        /*setTranslationForm(){
            if(this.isDisable) return
            this.showTranslationForm = true
        },*/
        changeCat(type){
            if(type == 'master'){
                this.form.main_category_id = null
                this.form.sub_category_id = null
            }
            if(type == 'main'){
                this.form.sub_category_id = null
            }
        },
        setData(data) {
            if (data && data.id) {
                _forEach(data, (fm, fmInd) =>{
                    if(fmInd != 'categories'){
                        this.form[fmInd] = fm
                    }
                })

                if (data.categories) {
                    let mapCategory = data.categories.map((item) => {
                        return item.id;
                    })
                    this.form.categories = mapCategory
                }

                if (data.business_product) {
                    _forEach(data.business_product, (fm, fmInd) =>{
                        this.businessProductForm[fmInd] = fm
                    })
                }
                else if (this.businessData) {
                    this.businessProductForm.business_id = this.businessData.id
                }

                //Set translation
                this.populateDefault(cloneDeep(data.translations))
            } else {
                this.populateDefault()
                if (this.businessData) {
                    this.businessProductForm.business_id = this.businessData.id
                }
            }
        },
        async getInitialData(){
        },
        cancelForm(){
            this.$EventDispatcher.fire('PRODUCT_CLOSE_FORM')
        },
        async saveForm() {
            if (this.isCreate) {
                let postData = cloneDeep(this.form)
                postData.name = this.enableSelectProduct ? postData.product_name : postData.name
                this.setCurrrentLangDefaultValue(postData)

                this.$EventDispatcher.fire('ADD_NEW_PRODUCT_FROM_CREATE', postData)

                this.$EventDispatcher.fire('PRODUCT_CLOSE_FORM')

                return
            }

            let isValid = false
            if (this.form.product_name && !this.selectedSelectProduct) {
                this.form.name = this.form.product_name
            }

            await this.$refs.form.validate((valid) => {
                if (valid) { isValid = true }
                else{ console.log('Test') }
            })

            if (!isValid) return

            this.pageLoading = true

            let savedProduct = null

            if (!this.selectedSelectProduct) {
                let dataSave = cloneDeep(this.form)
                if(this.form.product_name && !this.selectedSelectProduct){
                    dataSave.name = dataSave.product_name
                }
                this.setCurrrentLangDefaultValue(dataSave)

                console.log('diri ni sulod kuno1')
                await this.$API.Product.store(dataSave)
                .then(result => {
                    let res = result.data
                    console.log(res);
                    if (res.data) {
                        savedProduct = res.data
                    } else {
                        this.showMessage("error", this.$msg.notif.failed_add);
                    }
                })
                .catch(err => {
                    console.log('err', err)
                    this.showValidationError(err);
                })
                .finally(_ => {
                })
            } else {
                savedProduct = this.selectedSelectProduct
            }

            if (savedProduct) {
                //save business product
                if (this.businessData) {
                    console.log('diri ni sulod kuno')
                    let bpForm = cloneDeep(this.businessProductForm)
                    bpForm.product_id = savedProduct.id
                    let bpData = await this.saveBusinessProduct(bpForm)
                    console.log(bpData);
                    if (bpData) {
                        savedProduct.business_product = bpData
                    }
                }

                //save translation
                /*let valueTranslated = await this.saveFieldValueTranslator(savedProduct)
                if (valueTranslated) {
                    savedProduct.translator = valueTranslated
                }*/

                // this.showMessage("success", this.$msg.notif.success_add)
                this.$notify({
                            title: this.__("Success"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })
                this.$EventDispatcher.fire('PRODUCT_NEW_ITEM_CREATED', {data : savedProduct})
                this.$EventDispatcher.fire('PRODUCT_GET_LIST')
                this.$EventDispatcher.fire('PRODUCT_CLOSE_FORM')
                this.resetFields()
            }

            this.pageLoading = false
        },
        async updateForm(){

            let isValid = false
            await this.$refs.form.validate((valid) => {
                if (valid) { isValid = true }
                else{ console.log('Test') }
            })

            if(!isValid) return

            this.pageLoading = true

            let savedProduct = null

            let dataSave = cloneDeep(this.form)
            this.setCurrrentLangDefaultValue(dataSave)
            console.log("dataSave", dataSave)
            await this.$API.Product.update(dataSave)
            .then(result => {
                let res = result.data
                if(res.data){
                    savedProduct = res.data
                    //console.log(savedProduct);
                }
                else{
                    this.showMessage("error", this.$msg.notif.failed_add);
                }
            })
            .catch(err => {
                this.showValidationError(err);
            })
            .finally(_ => {
            })

            if (savedProduct) {
                //save business product
                if (this.businessData) {
                    let bpForm = cloneDeep(this.businessProductForm)
                    bpForm.product_id = savedProduct.id
                    let bpData = await this.saveBusinessProduct(bpForm)
                    if (bpData) {
                        savedProduct.business_product = bpData
                    }
                }

                //save translation
                /*let valueTranslated = await this.saveFieldValueTranslator(savedProduct)
                if (valueTranslated) {
                    savedProduct.translator = valueTranslated
                }*/

                // this.showMessage("success", this.$msg.notif.success_add)
                this.$notify({
                			title: this.__("Success"),
                			message: this.$msg.notif.success_update,
                			type: "success"
                		})
                this.$EventDispatcher.fire('PRODUCT_ITEM_UPDATE', {data : savedProduct})
            }

            this.pageLoading = false
        },
        async saveBusinessProduct(bpForm) {
            let bpData = null
            //Update
            if (bpForm.id) {
                await this.$API.BusinessProduct.update(bpForm)
                .then(result => {
                    let res = result.data
                    if(res.data){
                        bpData = res.data
                    }
                })
                .catch(err => {
                    console.log('err', err)
                })
                .finally(_ => {})
            } else {
                await this.$API.BusinessProduct.store(bpForm)
                .then(result => {
                    let res = result.data
                    console.log(res)
                    if(res.data){
                        bpData = res.data
                    }
                })
                .catch(err => {
                    console.log('err', err)
                })
                .finally(_ => {})
            }

            return bpData
        },
        showValidationError(err) {
            let errors = [];
            const h = this.$createElement;
            if(err.response.status == 422) {
                if(err.response.data.errors) {
                    for (var key in err.response.data.errors) {
                        errors.push(err.response.data.errors[key][0]);
                    }

                    this.$notify({
                        message: h('div', { style: 'list-style-type: none' }, errors.map(errmsg => {
                        return h('div', { style: 'list-style-type: none' }, errmsg);
                        })),
                        type: "error"
                    });
                }
            }
        },
        resetFields(){
            this.$refs.form.resetFields();
            this.form.product_name = null
            this.productSelectList = []
            this.selectedSelectProduct = null

            this.businessProductForm.id = null
            this.businessProductForm.business_id = null
            this.businessProductForm.product_id = null
            this.businessProductForm.moq = null
            this.businessProductForm.sample_price = null
            this.businessProductForm.monthly_ability = null
            this.businessProductForm.port = null
            this.businessProductForm.is_ready_made = null
            this.businessProductForm.is_primary = null
            this.businessProductForm.pack_details = null
            this.businessProductForm.rev_last_year = null
        },
        alertMessage(errs){
            _forEach(errs, err =>{
                this.showMessage("error", err[0])
            })
        },
        isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                evt.preventDefault();;
            } else {
                return true;
            }
        }
    },
    watch:{
        model(newVal){
            this.setData(newVal)
            if (newVal == null) {
                this.resetFields();
            }
        },
        'pageData.categories': function(newVal){
            this.categories = newVal
        },
        'pageData.measurements': function(newVal){
            this.measurements = newVal
        },
    }

}
</script>

<style lang="scss">
    label.el-form-item__label {
        float: left !important;
    }

</style>
