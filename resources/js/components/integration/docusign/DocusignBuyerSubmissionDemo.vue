<template>
    <div class="docusign-buyer-demo" v-loading="loadingData">
        <el-row :gutter="20">
            <el-col :span="columnWidth" v-for="(item, index) in filteredUsers" :key="'users_'+item.id">
                
                <div style="margin-left: 5px;"><label>{{ (item.first_name) }} {{ item.last_name }}</label></div>

                <div>
                    <el-button @click="openNdaDialog(item)" v-if="!item.businessNda" type="primary">{{ __('Request NDA') }}</el-button>
                    <template v-else>
                        <div style="display: flex; align-items: center;">
                            <div>
                                <img @click="handlePreview(item)" src="/image/icons/icon_pdf.png"/>
                            </div>
                            <div style="display: flex; flex-direction: column;">
                                <a @click="handlePreview(item)"  href="#">
                                    <span>{{ item.businessNda.file_name }}</span>
                                </a>
                                <span>
                                    <span v-if="item.businessNda.docusign_status" style="text-transform: capitalize; margin-right: 10px;">
                                        {{ item.businessNda.docusign_status && __(item.businessNda.docusign_status) }}
                                        <i 
                                        class="icon" 
                                        @click="handleUpdateDocumentStatus(index, item.businessNda)"
                                        :class="loadingStatus.includes(index) ? 'el-icon-loading' : 'el-icon-refresh'"
                                        />
                                    </span>
                                    <span @click="handlePreview(item)" v-else style="text-transform: capitalize; margin-right: 10px;">
                                        {{ __('Not sent') }}
                                    </span>
                                    <span>{{ $df.formatDate(item.businessNda.updated_at, 'MM/D/YYYY hh:mm A') }}</span>
                                </span>
                            </div>
                        </div>
                    </template>
                </div>

            </el-col>
        </el-row>

        <el-dialog
        :title="__('Upload NDA Request')"
        :visible.sync="showNdaDialog"
        width="50%"
        top="10vh"
        custom-class="docusign-uploader-dialog"
        @close="showNdaDialog = false"
        :close-on-click-modal="false">
            <div class="el-dialog__title" slot="title">
                <div class="header-title-container">
                    {{__('Upload NDA Request')}}
                </div>

                <div class="header-img-container">
                    <span>{{__('Powered by:')}}</span>
                    <img class="docusign-logo" src="/image/icons/docusign-logo.png"/>
                </div>
            </div>
            <docusign-request-form
                :prop-nda="activeNda"
                :prop-business="activeBusiness"
                :hide-details="true"
                @uploaded-nda-file="data => updateUserNda(data, false)"
                @removed-business-nda="removeUserNda"
                @sent-signature-request="data => updateUserNda(data, true)"
                @cancel-request="showNdaDialog = false">
            </docusign-request-form>
        </el-dialog>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showNdaDialog: false,
            loadingData: false,
            users: null,
            nda: null,
            activeBusiness: null,
            activeNda: null,
            loadingStatus: [],
        }
    },

    created() {
        this.getData()
    },

    watch: {
        filteredUsers(newVal) {
            if(newVal && newVal.length) {
                if(newVal && newVal.length) {
                    newVal.forEach((li, index) => {
                        if(li.businessNda) {
                            this.handleUpdateDocumentStatus(index, li.businessNda)
                        }
                    })
                }
            }
        }
    },

    computed: {
        filteredUsers() {
            let list = this.users && this.users.length ? this.users : []
            let allowedList = [/* 'mhbuyer1@gmail.com', */ 'mhsupplier2@gmail.com', 'mhsupplier3@gmail.com']
            
            list = list.filter(li => {
                li['businessNda'] = li.business && li.business[0] && li.business[0].nda

                return li.email && allowedList.includes(li.email)
            })

            return list
        },

        columnWidth() {
            if(this.filteredUsers && this.filteredUsers.length) {
                return 24 / this.filteredUsers.length
            }

            return 7
        }
    },

    methods: {
        updateUserNda(data, closeDialog) {
            if(data && data.business_id) {
                this.users.find(user => {
                    if(user.business) {
                        user.business.find(bi => {
                            if(Number(bi.id) == Number(data.business_id)) {
                                bi['nda'] = data
                            }
                        })
                    }
                })
            }

            if(closeDialog) {
                this.showNdaDialog = false
            }
        },

        removeUserNda(business_id){
            if(business_id) {
                this.users.find(user => {
                    if(user.business) {
                        user.business.find(bi => {
                            if(Number(bi.id) == Number(business_id)) {
                                bi['nda'] = null
                            }
                        })
                    }
                })
            }
        },

        handlePreview(data) {
            if(data && data.businessNda && (!data.businessNda.docusign_uri || data.businessNda.docusign_uri == '')) {
                this.openNdaDialog(data)
                return false
            }

            data = data.businessNda

            window.open("/docu-sign/get-nda-document/"+data.id || '');
        },

        handleUpdateDocumentStatus(item_index, nda) {
            this.loadingStatus.push(item_index)

            axios.get('/docu-sign/get-nda-envelope-status/'+nda.id)
            .then(result => {
                let res = result.data 
                if(res.status) {
                    nda.docusign_status = res.status
                    this.updateUserNda(nda, false)
                }
            }).catch(err => {
                console.error('Error!', err)
            }).finally(() => {
                this.loadingStatus = this.loadingStatus.filter(li => li != item_index)
            })
        },

        openNdaDialog(data) {
            this.activeBusiness = data.business && data.business[0] || null
            this.activeNda = data.businessNda
            this.showNdaDialog = true
        },

        getData() {
            this.loadingData = true
            axios.get('/docu-sign/get-test-data')
            .then(result => {
                let res = result.data
                if(res.users) {
                    this.users = res.users
                    this.nda = res.business_nda
                }
            }).catch(err => {
                console.error("Error!", err)
            }).finally(() => {
                this.loadingData = false
            })
        }
    }
}
</script>

<style lang="scss">
.docusign-buyer-demo {
    padding: 10px 20px; 
    min-height: 70px; 
    border: 1px solid #dedede; 
    margin: 10px 10px; 
    border-radius: 4px;
}
</style>