<template>
    <section class = "element-field-layout">
        <el-input
            v-model = "value"
            v-if="fieldType === 'Single Text'"
            :placeholder="__('Please Enter')"
            @blur = "changeValue"
            @input = "changeValue"
            :disabled = "disabled">
        </el-input>

        <el-input
            v-model = "value"
            v-else-if="fieldType === 'Multiline Text'"
            type="textarea"
            :placeholder="__('Please Enter')"
            @blur = "changeValue"
            @change = "changeValue"
            :disabled = "disabled">
        </el-input>

        <el-checkbox
            v-model = "value"
            v-else-if="fieldType === 'Single Checkbox'"
             @change = "changeValue"
            :disabled = "disabled">
            {{fieldLabel}}
        </el-checkbox>

        <el-checkbox-group
            v-model = "value"
            v-else-if="fieldType === 'Multiple Checkboxes'"
            @change = "changeValue"
            :disabled = "disabled">
            <el-checkbox
                v-for="option in optionList"
                :key="option.key"
                :label="option.value">
                {{ __(option.label) }}
            </el-checkbox>
        </el-checkbox-group>

        <el-radio-group
            v-else-if="fieldType === 'Radio Select'"
            v-model = "value"
            @change = "changeValue"
            :disabled = "disabled">
            <el-radio
                v-for="option in optionList"
                :key="option.key"
                :label="option.value">
                {{ __(option.label) }}
            </el-radio>
        </el-radio-group>

        <el-select
            v-else-if="['Dropdown Select', 'Currency'].some(o => o === fieldType)"
            v-model = "value"
            @change = "changeValue"
            :placeholder="__('Select')"
            filterable
            class="full-width"
            :disabled = "disabled">
                <el-option
                    v-for="option in optionList"
                    :key="option.key"
                    :value="String(option.value)"
                    :label="option.label">
                </el-option>
        </el-select>

        <el-input-number
            v-else-if="['Unformatted Number', 'Formatted Number'].some(o => o === fieldType)"
            v-model = "value"
            @change = "changeValue"
            controls-position="right"
            class="full-width"
            :disabled = "disabled">
        </el-input-number>

        <el-upload
            v-model = "value"
            v-else-if="fieldType === 'File'"
            class="upload-demo"
            drag
            action=""
            :disabled = "disabled">
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">{{ __('Drop file here or') }}<em>{{ __('click to upload') }}</em></div>
        </el-upload>

        <template v-else-if = "fieldType === 'Instruction'">
            <el-input
                v-model = "value"
                v-if="pageType === 'FormBuilder'"
                type="textarea"
                :placeholder="__('Please Enter')"
                @blur = "changeValue">
            </el-input>

            <div v-else>
                <p>{{ value }}</p>
            </div>
        </template>


    </section>
</template>
<script>
import cloneDeep from "lodash/cloneDeep";
export default {
    name: "ElementField",
    props: {
        fieldType: {
            type: String,
            required: true
        },
        fieldLabel: {
            type: String,
            required: false,
            default: ''
        },
        fieldOptions: {
            type: Array,
            required: false,
            default(){
                return []
            }
        },
        fieldValue: {
            required: true
        },
        pageType:{
            type: String,
            required: false,
            default: 'FormBuilder'
        },
        formFieldsList: {
            type: Array,
            required: false,
            default(){
                return []
            }
        },
        formFieldData: {
            type: Object,
            required: false,
            default(){
                return {}
            }
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false
        }

    },
    data() {
        return {
            value : this.fieldValue,
            optionList : this.fieldOptions
        }
    },
    mounted(){
        if(this.getCountryData && this.formFieldData.source_table == 'state'){
            this.setOptionsList()
        }
    },
    methods:{
        changeValue(val){
            setTimeout(_ => {
                this.$emit('update:fieldValue', this.value)
            }, 500)

        },
        setOptionsList(){
            let list = cloneDeep(this.fieldOptions)
            list = list.filter(fn => { return this.getCountryData && Number(fn.country_id) == Number(this.getCountryData)})

            if(this.value){
                let findState = list.find(fn => Number(fn.value) == Number(this.value))
                if(!findState){
                    this.value = null
                    this.changeValue(this.value)
                }
            }

            this.optionList = list
        }
    },
    computed:{
        /*
        * Special occurence for country and state.
        * State list will be base from selected coutry
        * Need to get selected country data from the fields list
        */
        getCountryData(){
            if(this.formFieldData && this.formFieldData.source_table == 'state'){
                let find = this.formFieldsList.find(fn => {
                    let fieldType = fn.type !== undefined ? fn.type : fn.field_type
                    let type = this.$ffh.getPropertyFieldType(fieldType, 'type')
                    if(type == 'option'){
                        return fn.source_table == 'country'
                    }
                    return false
                })

                return find ? find.field_answer_value : null
            }

            return null

        },
    },
    watch:{
        'getCountryData': function(newVal){
            if(newVal && this.formFieldData.source_table == 'state'){
                this.setOptionsList()
            }
        }
    }
}

</script>
