<template>
    <div v-loading="loadingRequest">
        <el-form :model="formData" :rules="rules" ref="businessNdaForm">
            <el-form-item v-if="!hideDetails" :label="__('Supplier')" prop="business_id">
                <el-select
                    v-model="formData.business_id"
                    filterable
                    remote
                    class="full-width"
                    reserve-keyword
                    @change="businessChanged"
                    :placeholder="__('Please enter a keyword')"
                    :remote-method="getBusinessList"
                    :loading="loadingBusinessList">
                        <el-option
                            v-for="item in businessListPagination.data"
                            :key="item.id"
                            :label="item.legal_name"
                            :value="item.id"
                            :disabled="!item.email || item.email == ''">
                        </el-option>
                </el-select>
            </el-form-item>

            <el-form-item  
                v-if="!hideDetails"
                :label="__('Email')"
                prop="email">
                    <el-input
                        v-model="formData.email"
                        clearable>
                    </el-input>
            </el-form-item>

            <el-upload
                class="upload-demo full-width"
                drag
                action=""
                v-loading="importLoading"
                :file-list="fileList"
                :on-change="handleChange"
                :on-preview="handlePreview"
                :on-remove="removeNda"
                :auto-upload="false"
                :limit="1"
                :disabled="businessNda && businessNda.docusign_uri && businessNda.docusign_uri != ''"
                multiple
                ref="docusignFormUploader">
                    <i class="el-icon-upload"></i>
                    <div v-if="fileList && fileList.length" class="el-upload__text">{{ __('Only 1 file is allowed.') }}</em></div>
                    <div v-else class="el-upload__text" v-html="__('Drop of Upload PDF documents here to get started')"></div>
            </el-upload>
            
            <div class="text-right" style="margin-top: 10px;">
                <el-button 
                    @click="cancelRequest"
                    size="medium"
                    type="text">
                        {{ __('Cancel') }}
                </el-button>

                <el-button 
                v-if="businessNda && businessNda.docusign_uri && businessNda.docusign_uri != ''" 
                icon="el-icon-delete" type="danger" @click="removeNda()">
                    {{ __('Remove NDA File') }}
                </el-button>

                <el-button 
                    @click="requestSignature" 
                    class="btn btn-orange"
                    size="medium"
                    :disabled="!fileList || (!fileList.length ? true : false) || importLoading || 
                        (businessNda && businessNda.docusign_uri && businessNda.docusign_uri != '' ? true : false)"
                    type="primary">
                        {{ __('Continue') }}
                </el-button>
            </div>
        </el-form>
    </div>
</template>

<script>
export default {
    /* @params 
        propNda => data from business_nda table // optional
        propBusiness => selected business // optional (if not set propFormData is needed)
        hideDetails => show or hide selection for business // optional (if not set propBusiness is needed)
        propFormData => data from form_submissions_to_supplier // (required if in Form > List > View) (if not set propBusiness is needed)
    */
    props : ['propNda', 'propBusiness', 'hideDetails', 'propFormData'],

    data() {
        return {
            fileList: [],
            formData: {
                business_id: (this.propBusiness && this.propBusiness.id) || (this.propFormData && this.propFormData.supplier_data && this.propFormData.supplier_data.id) || null,
                email: (this.propBusiness && this.propBusiness.email) || (this.propFormData && this.propFormData.supplier_data && this.propFormData.supplier_data.email) ||  null,
                supplier_id: this.propFormData && this.propFormData.supplier_id || null,
                form_submission_to_supplier_id: this.propFormData && this.propFormData.id || null,
                form_submission_id: this.propFormData && this.propFormData.form_submission_id || null
            },
            filterData: {
                user_id: this.$userData.activeUserId,
                search: '',
                count: 50,
                current_page: 1,
                registered_start: 'All',
                registered_end: 'All'
            },
            rules: {
                business_id: [
                    { required: true, message: this.__('Required'), trigger: 'blur' },
                ],
                email: [
                    { required: true, message: this.__('Required'), trigger: 'blur' },
                ],
            },
            businessListPagination: {data: null},
            loadingBusinessList: false,
            loadingRequest: false,
            importLoading: false,
            businessNda: this.propNda || null,
        }
    },

    watch: {
        propNda(newVal) {
            this.businessNda = newVal
            if(newVal) {
                this.fileList = [{
                    name: newVal.file_name || newVal.name.replaceAll('/uploads/businessfiles/', ''),
                    raw: null,
                    size: 200,
                    url: newVal.name
                }]
            } else {
                this.fileList = []
            }
            
        },
        'propBusiness.id'(newVal) {
            if(newVal) {
                this.formData.business_id = newVal
                this.businessChanged()
            }
        },
        'propBusiness.email'(newVal) {
            if(newVal) {
                this.formData.email = newVal
            }
        },
        propFormData(newVal) {
            if(newVal) {
                this.formData.email = newVal.supplier_data && newVal.supplier_data.email
                this.formData.business_id = newVal.supplier_data && newVal.supplier_data.id
                this.formData.supplier_id = newVal.supplier_id
                this.formData.form_submission_to_supplier_id = newVal.id
                this.formData.form_submission_id = newVal.form_submission_id
            }
        }
    },

    computed: {
        formattedUsers() {
            let list = this.users && this.users.length ? this.users : []
            
            list = list.filter(li => Number(li.user_type_id) == Number(this.$userData.userTypeId))

            return list
        }
    },

    created() {
        this.getBusinessList()
    },

    mounted() {
        if(this.businessNda) {
            this.fileList = [{
                name: this.businessNda.file_name || this.businessNda.name.replaceAll('/uploads/businessfiles/', ''),
                raw: null,
                size: 200,
                url: this.businessNda.name
            }]
        }

        if(this.$refs.docusignFormUploader) {
            this.$refs.docusignFormUploader.uploadFiles = this.fileList
        }
    },

    methods: {
        getBusinessList(searchText = '') {
            this.filterData.search = searchText
            
            let params = this.filterData

            let concatParams = ""

            this.loadingBusinessList = true;

            this.$API.BusinessList.getBusinesses(params, concatParams)
            .then((result) => {
                this.tableData = result.data.businessList.data;
                this.businessListPagination = result.data.businessList;
            })
            .catch((err) => {
                console.log("Error!", err);
            })
            .finally((_) => {
                this.loadingBusinessList = false;
            });
        },

        businessChanged() {
            let business = this.formData.business_id && this.businessListPagination.data.find(li => Number(li.id) == Number(this.formData.business_id))

            if(business) {
                this.getNda()
                this.formData.email = business.email
            }
        },

        handlePreview(file) {
            console.log('file', file);
            if(!this.businessNda.id) {
                window.open("/storage"+file.url);
                return 
            }
            window.open("/docu-sign/get-nda-document/"+this.businessNda.id || '');
        },
        
        handleChange(file) {
            const validTypes = [
                'application/pdf', 
                /* 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'change application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-excel',
                'application/msword' */
            ] // include types to be accepted

            if (!validTypes.includes(file.raw.type) || !this.formData.business_id) {
                this.$message.warning(!validTypes.includes(file.raw.type) ? `Invalid file type!` : `Select a supplier`);

                this.fileList = []

                if(this.$refs.docusignFormUploader) {
                    this.$refs.docusignFormUploader.uploadFiles = this.fileList
                }

                return false;
            } else {
                this.importLoading = true;

                const formData = new FormData();
                formData.append('file', file.raw, file.name);
                formData.append('business_id', this.formData.business_id);
                formData.append('supplier_id', this.formData.supplier_id);
                formData.append('form_submission_id', this.formData.form_submission_id);
                formData.append('form_submission_to_supplier_id', this.formData.form_submission_to_supplier_id);

                axios.post('/business-list/upload-business-nda?id=' + this.formData.business_id, formData)
                .then((res) => {
                    if (res.data.success == true && res.data.imageFile) {
                        let newFile = res.data.imageFile
                        this.fileList = [{
                            name: newFile.fileName,
                            raw: file.raw,
                            size: file.size,
                            type: file.type,
                            fileContents: file.raw,
                            url: newFile.filePath,
                            show:  true,
                            caption: null
                        }]

                        this.businessNda = res.data.nda || null
                        this.$emit('uploaded-nda-file', this.businessNda)

                        if(this.$refs.docusignFormUploader) {
                            this.$refs.docusignFormUploader.uploadFiles = this.fileList
                        }
                    } else if(!res.data.success) {
                        this.fileList = []
                        if(this.$refs.docusignFormUploader) {
                            this.$refs.docusignFormUploader.uploadFiles = this.fileList
                        }
                        this.$message.error(this.__('File upload failed. Please try again.'));
                    }
                    this.importLoading = false;
                }).catch(err => {
                    console.log('Error!', err)
                    this.fileList = []
                    if(this.$refs.docusignFormUploader) {
                        this.$refs.docusignFormUploader.uploadFiles = this.fileList
                    }
                }); 
            }
        },

        requestSignature() {
            if(!this.businessNda || !this.businessNda.id) {
                this.$message.error(this.__('NDA file is required.'));

                return false
            }

            this.$refs['businessNdaForm'].validate((valid) => {
                if (valid) {
                    console.log('submit')

                    this.loadingRequest = true

                    let form = this.formData
                    form['business_nda_id'] = this.businessNda.id
                    form['name'] = this.businessNda.name.replaceAll('/uploads/businessfiles/', '')
                    form['file_url'] = 'storage'+this.businessNda.name

                    axios.post('/docu-sign/request-signature', form)
                    .then(res => {
                        console.log('res', res.data)
                        if(res.data.success && res.data.uri) {
                            this.businessNda.docusign_uri = res.data.uri
                            this.businessNda.docusign_status = 'sent'
                            this.showDialog = false
                            this.$emit('sent-signature-request', this.businessNda)
                        }
                    }).catch(err => {
                        console.error('Error!', err)
                    }).finally(() => {
                        this.loadingRequest = false
                    })
                } 
            });
        },

        cancelRequest() {
            this.$emit('cancel-request')
        },

        handleSuccess(res, file) {
            this.fileList.forEach(file => {
            if(file.name == res.imageFile.fileName) {
                file.filePath = res.imageFile.filePath;
                file.show = true;
            }
            });
            this.importLoading = false;
            this.$forceUpdate();
        },
        getNda() {
            console.log('getNda')
            this.importLoading = true 
            axios.get('/business-list/get-business-nda/' + this.formData.business_id).then((res) => {
                let result = res.data
                if (result.success == true && result.data) {
                    
                    this.businessNda = result.data

                    this.fileList = [{
                        name: this.businessNda.name.replaceAll('/uploads/businessfiles/', ''),
                        raw: null,
                        size: 200,
                        url: this.businessNda.name
                    }]
                } else {
                    this.businessNda = null
                    this.fileList = []
                    
                    if(this.$refs.docusignFormUploader) {
                        this.$refs.docusignFormUploader.uploadFiles = this.fileList
                    }
                }
                this.importLoading = false;
            }).catch(err => {
                console.error('Error!', err)
            })
        },
        removeNda() {
            this.importLoading = true 

            if(!this.formData.business_id) return false

            axios.post('/business-list/remove-nda?id=' + this.formData.business_id).then((res) => {
                let result = res.data
                if (result.success == true) {
                    this.businessNda = null

                    if(this.$refs.docusignFormUploader) {
                        this.$refs.docusignFormUploader.uploadFiles = []
                    }

                    this.$emit('removed-business-nda', this.formData.business_id)

                    this.fileList = []
                } else {
                    this.$message.warning(this.__('Unable to remove file.'));
                }
                this.importLoading = false;
            }).catch(err => {
                console.error('Error!', err)
                this.importLoading = false;
            });
        }
    }
}
</script>

<style lang="scss">
.upload-demo {
    width: 100%;

    .el-upload {
        margin-left: 0 !important;
        width: 100%;

        .el-upload-dragger {
            width: 100%;
        }
    }
}
</style>