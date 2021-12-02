<template>
    <div class="main-container">
            <div class="main-content-section mt-3">
                <el-tabs 
                    style="margin: 10px;"
                    type="border-card" 
                    @tab-click="handleClick" 
                    class="market-hammer-tabs"
                    v-model="tabModels.outerTabs">
                    <el-tab-pane :label="__('Contacts')" name="contacts" lazy>
                        <supplier-contact-list
                            :business="businessData"
                            :page-data="overviewPageData">
                        </supplier-contact-list>
                    </el-tab-pane>
                    <el-tab-pane :label="__('Recent View')" name="recent_view" lazy>
                        <supplier-recent-view
                            :business="businessData"
                            :page-data="overviewPageData">
                        </supplier-recent-view>
                    </el-tab-pane>
                    
                </el-tabs>
            </div>
    </div>
</template>

<script>
    export default {
        props: {
            pageData: {
                type: Object,
                required: true
            }
        },
        data() {
            let pdata = this.pageData
            return {
                tabModels: {
                    outerTabs: 'contacts',
                    innerTab : 'general'
                },
                businessData    : this.pageData.business,
                overviewPageData : this.pageData

            }
        },
        created() {
            
        },
        methods: {
            handleClick() {},
            getBusinessFollower(){

            },
            getUserFollower(){

            }
        },
    }
</script>