export default {
    methods: {
        /**
         * Translate the given key.
         */
        __(key, replace) {
            let translation, translationNotFound = true
            let locale = window.Laravel.locale

            try {
                translation = key.split('.').reduce((t, i) => t[i] || null, window.Laravel.translations[locale].php)

                if (translation) {
                    translationNotFound = false
                }
            } catch (e) {
                translation = key
            }

            if (translationNotFound) {
                translation = window.Laravel.translations[locale]['json'][key]
                    ? window.Laravel.translations[locale]['json'][key]
                    : key
            }

            _.forEach(replace, (value, key) => {
                translation = translation.replace(':' + key, value)
            })

            return translation
        },
        /**
         * Translate the given field data. The translation value should be provided.
         *
         * @param translations <array | object> - the translation data
         * @param field <string> - the field to be translated
         * @param defaultText <mixed> - the default value to display if no translation found
         * 
         * @return <mixed>
         */
        __dt(translations, field, defaultText = null) {
            let lang = `lang_${window.Laravel.locale}`
            let translation = defaultText ? defaultText : this.__('No Translation')

            if (!field) {
                console.error(`Error: Error in translation. No field is given.`)

                return
            }

            if (!defaultText) {
                if (!translations) {
                    console.error(`Error: Failed to translate given field ${field}. Translation data is not provided. Please pass the translation data of the given field`)
                }
            }

            if (Array.isArray(translations)) {
                let transEntry = translations.find(tr => tr.field == field)

                if (transEntry) {
                    translation = transEntry[lang] || transEntry['value']
                }
            } else {
                translation = translations ? translations[lang] || translations['value']: translation
            }

            return translation
        }
    }
}