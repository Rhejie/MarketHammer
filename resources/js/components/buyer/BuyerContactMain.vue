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
                        <buyer-contact-list
                            :type="'contact'"
                            :page-data="overviewPageData">
                        </buyer-contact-list>
                    </el-tab-pane>
                    <el-tab-pane :label="__('Request')" name="request" lazy>
                        <buyer-contact-list
                            :type="'request'"
                            :page-data="overviewPageData">
                        </buyer-contact-list>
                    </el-tab-pane>
                    <el-tab-pane :label="__('Favorites')" name="favorites" lazy>
                        <buyer-favorite-list
                            :type="'favorites'"
                            :page-data="overviewPageData">
                        </buyer-favorite-list>
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
            },
        },
        data() {
            let pdata = this.pageData
            return {
                tabModels: {
                    outerTabs: 'contacts',
                },
                overviewPageData : this.pageData

            }
        },
        created() {
            
        },
        methods: {
            handleClick() {},
        },
    }
</script>

<style>
    th.is-leaf {
        padding: 5px 0 !important;
    }
</style>