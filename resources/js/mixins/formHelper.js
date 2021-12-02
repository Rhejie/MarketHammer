export const formHelper = {
    data() {
        return {
            form : {
                errors : []
            },
        }
    },
    methods : {
        hasError(field, returnMessage = false) {
            if (!this.form.errors || !this.form.errors[field]) return null 

            if (this.form.errors[field]){
                return returnMessage ? this.form.errors[field][0] : true 
            } else {
                return returnMessage ? null : false 
            }
        },
        setErrors(errors) {
            if (typeof errors !== 'object') return

            this.resetErrors()
            this.form.errors = errors
        },

        resetErrors(){
            this.form.errors = []
        },

        /**
         * Add new custom error message to the field
         * param field - field name - bases for the call for hasError()
         * message - error message to display
         */
        addError(field, message) {
            this.form.errors[field] = message
        },

        /**
         * Removes errors based on given field name(s)
         * param fields array - the field to be removed
         */
        removeErrors(fields) {
            let errors = []
            for (let x in this.form.errors) {
                if (fields.includes(x)) continue
                errors[x] = this.form.errors[x]
            }
            this.form.errors = errors
        },
       
        /**
         * Set the form item validation state manually.
         * Work around for validation comming from the server 
         * combined with validation from rules in EL form.
         * param refsNames array
         */
        setErrorStateAndMessage(refsNames) {
            // Check if the refs has object var
            for (let name of refsNames) {
                if (!this.$refs[name]) continue
                if (('validateState' in this.$refs[name]) && 
                    ('validateMessage' in this.$refs[name])) {
                    this.$refs[name].validateState = this.hasError(name) ? 'error' : ''
                    this.$refs[name].validateMessage = this.hasError(name, true)
                }
            }
        },
        
        /**
         * Show validation error from the back end
         *
         * @param err - the validation errors
         */
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
    }
}
