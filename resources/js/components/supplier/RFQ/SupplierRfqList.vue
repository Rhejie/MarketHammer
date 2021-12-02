<template>
    <div class="main-container" v-loading="loading">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>RFQ List </h5>
                    </div>
                    <div class="search-container">
                        <el-input
                        class="input-search"
                        v-model="search"
                        :placeholder="__('Type to search')"
                        @keyup.enter.native="getRfqList">
                        <i slot="suffix" class="el-input__icon el-icon-search"></i>
                        </el-input>
                    </div>
                </div>
            </div>

            <div class="content-div">
                <el-table
                class="table-list-container"
                :data="rfqListTable"
                style="overflow-y: scroll;"
                v-loading="loading"
                :row-class-name="tableRowClassName"
                @row-click="checkExpired">
                    <!-- <el-table-column prop="id" label="Keyword ID">
                    </el-table-column> -->
                    <el-table-column :label="__('Form ID')" show-overflow-tooltip: showTooltip: true>
                        <template slot-scope="scope">
                            <template v-if = "scope.row.form_submission">
                                <!--span v-if = "scope.row.expired">
                                    {{ scope.row.form_submission.form_id }}
                                </span>
                                <el-button @click="viewForm(scope.row)" type="text" v-else>
                                    {{ scope.row.form_submission.form_id }}
                                </el-button-->
                                {{ scope.row.form_submission.form_id }}
                            </template>
                        </template>
                    </el-table-column>
                    <el-table-column :label="__('Type')" show-overflow-tooltip: showTooltip: true>
                        <template slot-scope="scope">
                            {{ scope.row.form_submission.form_type ? scope.row.form_submission.form_type.name : "" }}
                        </template>
                    </el-table-column>
                    <el-table-column prop="form_submission.refrence_id" :label="__('Ref ID')" show-overflow-tooltip: showTooltip: true>
                    </el-table-column>
                    <el-table-column prop="form_submission.form_title" :label="__('Title')">
                    </el-table-column>
                    <!--el-table-column prop="status" :label="__('Company')">
                        <template slot-scope="scope">
                            {{ scope.row.buyer.business[0] && scope.row.buyer.business[0].length > 0 ? scope.row.buyer.business[0].legal_name : '' }}
                        </template>
                    </el-table-column-->
                    <el-table-column prop="form_submission.expiration_date" :label="__('Expiration Date')" show-overflow-tooltip: showTooltip: true>
                        <template slot-scope="scope">
                            {{ scope.row.form_submission.expiration_date ? $df.formatDate(scope.row.form_submission.expiration_date, 'll') : ''}}
                        </template>
                    </el-table-column>
                    <el-table-column prop="status" :label="__('Status')" show-overflow-tooltip: showTooltip: true>
                        <template slot-scope="scope">
                            {{ __($sf.ucfirst(scope.row.status)) }} {{  scope.row.expired ? '('+__('Expired')+')' : '' }}
                        </template>
                    </el-table-column>
                </el-table>
                <div class="text-right mb-3">
                    <global-pagination
                    :current_page="current_page"
                    :current_size="current_size"
                    :pagination="rqfListPagination"
                    @handleSizeChange="handleSizeChange"
                    @handleCurrentChange="handleCurrentChange"></global-pagination>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import cloneDeep from 'lodash/cloneDeep' 
    import _forEach from 'lodash/forEach' 

    export default {
        props: {
            pageData: {
                type: Object,
                required: true
            }
        },
        data() {
            let pageDataForm = {
                machineType : [],
                machineManufacturer : [],
                machineProcessType : []
            }
            return {
                rqfList: [],
                rqfListPagination: {},
                search: '',
                current_page: 1, 
                current_size: 25,
                loading: false,
                business: this.pageData.business,
                dateNow : this.$df.formatDate(new Date(), 'YYYY-MM-DD')
            }
        },
        created() {
            this.getRfqList()
        },
        computed:{
            rfqListTable(){
                let list = cloneDeep(this.rqfList)
                _forEach(list, lt =>{
                    lt.expired = false
                    if(lt.form_submission && lt.form_submission.expiration_date
                        && this.$df.formatDate(lt.form_submission.expiration_date, 'X') < this.$df.formatDate(this.dateNow, 'X')){
                        lt.expired = true
                    }
                })
                return list
            }
        },
        methods: {
            tableRowClassName({row}) {
                if (row.expired) {
                    return 'expired-row'
                } 
                return ''
            },
            checkExpired(data){
                if(!data.expired){
                    this.viewForm(data)
                }
            },
            getRfqList() {
                if (!this.business || !this.business.id) return

                this.loading = true

                let postData = {
                    current_size: this.current_size,
                    current_page: this.current_page,
                    search: this.search,
                    supplier_id: this.business.id
                }

                this.$API.BusinessRfq.getRfq(postData)
                .then(res => {
                    this.rqfList = res.data.rfqList.data;
                    this.rqfListPagination = res.data.rfqList;
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {
                    this.loading = false
                })
            }, 
            handleAction(info) {
                if (info.action === 'delete') {
                    this.deleteMachine(info.data)
                }
                else if (info.action === 'update') {
                    this.updateMachine(info.data)
                }
                else if (info.action === 'custom_field') {
                    this.showCustomField(info.data)
                }

            },
            viewForm(data){
                this.$router.push({
                    name: 'Supplier RFQ Details',
                    params: {id : data.id }
                })
            },
            handleSizeChange(val) {
                this.current_size = val;
                this.getRfqList();
            },
            handleCurrentChange(val) {
                this.current_page = val;
                this.getRfqList();
            },
        },
        watch: {
            /*'business.id'() {
                this.getRfqList()
            }*/
        }
    }
</script>

<style lang="scss">
    .company-machinees-component {
        .machine-item {
            .el-card__body {
                display: flex;
                align-items: center;
            }
        }
    }
    .content-div {
        margin-top: 10px;
    }
    .el-table th > .cell {
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .el-table .expired-row {
        background: #f9f9f9 !important;
        cursor: not-allowed;
    }
</style>