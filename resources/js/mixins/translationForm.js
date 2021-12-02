window.noty = require('noty')
import Noty from 'noty'
import _forEach from 'lodash/forEach'
import cloneDeep from 'lodash/cloneDeep'
import isEmpty from 'lodash/isEmpty'

export default {
    data() {
        return {
            language: window.Laravel.locale,
            field: null,
            fromTable: null,
            formFields: [],
            fieldTranslationValues: {},
            showTranslationForm: false,
            translationModel: null,
            translationModelCopy: null,
            hasToSave : false
        }
    },
    mounted() {
        if(isEmpty(this.fieldTranslationValues)){
            this.populateDefault()
        }
        
    },
    methods: {
        setTranslationForm(field, value, type) {
            this.translationModel = cloneDeep(this.fieldTranslationValues[field])
            this.translationModel.value = cloneDeep(value)
            this.translationModel.type = cloneDeep(type)

            this.field = cloneDeep(field)

            this.showTranslationForm = true
        },
        handleCloseTranslation() {
            this.showTranslationForm = false
        },
        setTranslationData(data) {
            this.hasToSave = true

            this.fieldTranslationValues[this.field].lang_en = data.lang_en
            this.fieldTranslationValues[this.field].lang_ko = data.lang_ko
            this.fieldTranslationValues[this.field].lang_jap = data.lang_jap
            this.fieldTranslationValues[this.field].value = data.value

            return 
        },
        async saveFieldValueTranslator(data) {
            //Need to update in case value was changed
            if (!this.hasToSave && !this.translationModel.id) {
                return false
            }

            let formData = cloneDeep(this.translationModel)
            formData.value = data[this.translationModel.field]

            let translator = null
            if (this.translationModel.id) {
                translator = await this.updateFieldValueTranslator(formData)
            } else {
                translator = await this.addFieldValueTranslator(formData)
            }

            return translator
        },
        async addFieldValueTranslator(formData) {
            let translated = null
            await this.$API.FieldValueTranslator.storeTranslator(formData)
            .then(res => {
                if (res.data) {
                    translated = res.data.data
                    this.$EventDispatcher.fire('VALUE_TRANSLATOR_SAVED', res.data)
                }
            })
            .catch(err => {
                console.log("Error: ", err)

                this.$notify({
                    title: "Server Error",
                    message: this.$msg.notif.service_error,
                    type: "error"
                })
            })
            .finally(_ => {
                //this.loading = false
            })
            return translated
        },
        async updateFieldValueTranslator(formData) {
            let translated = null
            await this.$API.FieldValueTranslator.updateTranslator(formData)
            .then(res => {
                if (res.data) {
                    translated = res.data.data
                    this.$EventDispatcher.fire('VALUE_TRANSLATOR_SAVED', res.data)
                }
            })
            .catch(err => {
                console.log(err)
                this.$notify({
                    title: "Server Error",
                    message: this.$msg.notif.service_error,
                    type: "error"
                })
            })
            .finally(_ => {
                //this.loading = false
            })
            return translated
        },
        populateDefault(translations) {
            let model = {
                id : null,
                table_id: null,
                table : this.fromTable,
                field : null,
                value : null,
                lang_en : null,
                lang_ko : null,
                lang_jap : null
            }

            translations = translations ? translations : []

            for (let x of this.formFields) {
                let translation = translations.find(tr => tr.field === x && tr.id)
                if (translation) {
                    this.fieldTranslationValues[x] = cloneDeep(translation)

                    continue
                }

                this.fieldTranslationValues[x] = cloneDeep(model)
                this.fieldTranslationValues[x].field = x
            }
        },
        setCurrrentLangDefaultValue(form) {
            // for (let x of this.formFields) {
            //     let lang = `lang_${this.language}`
            //     this.fieldTranslationValues[x][lang] = form[x]
            // }

            form.translations = cloneDeep(this.fieldTranslationValues)
        },
        resetData() {
            this.populateDefault()
            this.hasToSave = false
            this.translationModel = null
            this.translationModelCopy = null
        }
    },

}