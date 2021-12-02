<template>
    <div>
        <el-select v-model="id" class="full-width" placeholder="Select"
            disabled v-loading="loading">
            <el-option
            v-for="item in options"
            :key="item.id"
            :label="item.name"
            :value="item.id">
            </el-option>
        </el-select>
    </div>
</template>
<script>
export default {
    props : {
        ans : {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            options: [],
            id: parseInt(this.ans.value),
            loading: false
        }
    },
    created() {
        this.getOptions();
    },
    methods: {
        getOptions() {
            this.loading = true;
            let params = {
                source_table: this.ans.form_submission_fields.source_table
            }
            this.$API.BuyerFormList.getOptionsData(params)
                .then(res => {
                    this.options = res.data;
                    this.loading = false;
                });
        }
    }
}
</script>
