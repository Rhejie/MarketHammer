<template>
    <section class = "element-matrix-table">
        <el-table :data="dataVal"
            class="matrix_table"
            :header-cell-class-name="headerStyle"
            border
            style="width: 100%; word-break:normal">
            <el-table-column
                v-for="option in optionData"
                :key="option.key"
                :prop="option.value"
                :label="__(option.label)"
                :empty-text = "__('No Data')">
                <template slot-scope="scope">
                    <element-field
                        :field-type = "option.type"
                        :field-label = "option.label"
                        :field-value.sync = "scope.row[option.value]"
                        :field-options = "option.field_options"
                        :form-field-data = "scope.row"
                        :form-fields-list = "dataVal"
                        :disabled = "disabled">
                    </element-field>
                </template>
            </el-table-column>
            <el-table-column width = "50px" v-if = "allowToRemove" >
                <template slot-scope="scope">
                    <el-button
                        v-if="!allowToRemove"
                        type="text"
                        icon="fas fa-trash-alt"
                        class="text-red"
                        @click="removeRow(scope.row)">
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-button
            v-if = "allowToAdd"
            type = "text"
            @click="addRow">
            <i class="fas fa-plus ml-2"></i> {{ __('Add')}}
        </el-button>
    </section>
</template>
<script>
import _forEach from "lodash/forEach";
import cloneDeep from "lodash/cloneDeep";

export default {
    props: {
        optionsList: {
            type: Array,
            required: true
        },
        valueData: {
            type: Array,
            required: true
        },
        allowToRemove:{
            type: Boolean,
            required: false,
            default: true
        },
        allowToAdd:{
            type: Boolean,
            required: false,
            default: true
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false
        },
    },
    data() {
        return {
            optionData  : this.optionsList,
            dataVal   : this.valueData,
        };
    },
    methods:{
        addRow(){
            let arr = cloneDeep(this.mapDataVal)
            arr._idKey_ = Date.now() + "_" + (this.optionsList.length + 1)
            this.dataVal.push(arr)
        },
        removeRow(row){
            let findRow = this.dataVal.findIndex(fn => row._idKey_ == fn._idKey_)
            if(findRow >= 0){
                this.dataVal.splice(findRow, 1)
            }

        },
        headerStyle({row, rowIndex}) {
            return 'header_style'
        }
    },
    computed: {
        mapDataVal(){
            let arr = {}
            _forEach(this.optionsList, op =>{
                let val = null

                let valueType = this.$ffh.getPropertyFieldType(op.type, 'value_type')
                if(valueType == 'multiple'){
                    val = []
                }
                arr[op.value] = val

            })
            return arr
        }
    },
};
</script>

<style lang="scss">

    .el-table th>.cell {
            word-break: normal !important;
    }

</style>
