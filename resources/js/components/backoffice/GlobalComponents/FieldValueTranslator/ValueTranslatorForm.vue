<template>
    <el-dialog
        :title="__('Set Translation')"
        :visible.sync="showDialog"
        width="40%"
        :before-close="closeFormDialog"
        class="translation-form-dialog"
        :close-on-press-escape="false"
        :close-on-click-modal="false"
        top="5vh"
        append-to-body>
        <el-form :model="form" label-position = "top" ref="form" class="demo-ruleForm">
            <el-row :gutter = "20">
                <el-col :span = "24">

                    <el-form-item 
                        :label="__('Default (English)')" 
                        prop="name">
                        <el-input
                            :type="type"
                            :row="type === 'textarea' ? 3 : 0"
                            v-model="form.lang_en" 
                            class="full-width">
                        </el-input>
                    </el-form-item>

                    <el-form-item 
                        :label="__('Korean')" 
                        prop="name">
                        <el-input 
                            :type="type"
                            :row="type === 'textarea' ? 3 : 0"
                            v-model="form.lang_ko" 
                            class="full-width">
                        </el-input>
                    </el-form-item>

                    <el-form-item 
                        :label="__('Japanese')" 
                        prop="name">
                        <el-input 
                            :type="type"
                            :row="type === 'textarea' ? 3 : 0"
                            v-model="form.lang_jap" 
                            class="full-width">
                        </el-input>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
        <span slot="footer">
            <el-button
                class="btn btn-default"
                @click="closeFormDialog">
                {{ __('Cancel') }}
            </el-button>
            <el-button
                class="btn btn-primary btn-black"
                @click="addTranslation">
                {{ __('Submit') }}
            </el-button>
        </span>
    </el-dialog>
</template>

<script>
window.noty = require('noty')
import Noty from 'noty'

import cloneDeep from 'lodash/cloneDeep'
import { dialogComponent } from '../../../../mixins/dialogComponent'

export default {
    name: 'ValueTranslatorForm',
    mixins: [dialogComponent],
    props: {
        translationForm : {},
        pageData : {
            required: false
        },
    },
    data() {
        return {
            language: window.Laravel.locale,
            form : {
                lang_en : null,
                lang_ko : null,
                lang_jap : null
            },
            type: 'text'
        }
    },
    created() {
        if (this.translationForm) {
            this.type = this.translationForm.type

            for (let x in this.translationForm) {
                if (x.indexOf('lang') > -1) {
                    let lang = x.split('_')

                    // if (lang[1] === this.language) {
                    //     this.form[x] = this.translationForm.value

                    //     continue
                    // }

                    this.form[x] = this.translationForm[x]
                }
            }
        }
    },
    methods:{
        addTranslation() {
            this.$emit('settranslationdata', this.form);
            this.closeModal()
        },
        closeFormDialog() {
            this.form.lang_en = null
            this.form.lang_ko = null
            this.form.lang_jap = null

            setTimeout(_ => {
                this.$refs.form.clearValidate()
                this.closeModal()
            }, 200)
        },
    },

}

</script>
