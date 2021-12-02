<template>
    <div class="main-container">
        <div class="col-md-12 table-container-business-tab" style="margin-top: 10px !important;">
            <el-button type="primary" @click="showDialog = true">{{ __('Upload NDA') }}</el-button>
            <el-dialog
                :title="__('Upload')"
                :visible.sync="showDialog"
                width="370px"
                top = "20px"
                @close="showDialog = false"
                :close-on-click-modal="false">
                    <div v-loading="loadingRequest" class="card borderless">
                        <el-form :model="formData" :rules="rules" ref="businessNdaForm">
                            <el-form-item v-if="Business && Business.nda && Business.nda.name" :label="__('File')">
                                <el-input
                                    v-model="Business.nda.name"
                                    readonly>
                                </el-input>
                            </el-form-item>

                            <el-form-item
                                v-if="!(Business && Business.nda && Business.nda.docusign_uri && Business.nda.docusign_uri != '')"
                                :label="__('Email')"
                                prop="email">
                                    <el-input
                                        v-model="formData.email"
                                        clearable>
                                    </el-input>
                            </el-form-item>

                            <template v-else>
                                <el-form-item :label="__('Docusign URI')">
                                    <el-input
                                        v-model="Business.nda.docusign_uri"
                                        readonly>
                                    </el-input>
                                </el-form-item>
                            </template>

                            <el-upload
                                v-if="!Business || Business.nda == null"
                                class="upload-demo"
                                :file-list="fileList"
                                v-loading="importLoading"
                                :on-change="handleChange"
                                :auto-upload="false"
                                list-type="file"
                                action=""
                                :show-file-list="false">

                                <el-button size="small" type="primary">{{ __('Upload NDA') }}</el-button>

                            </el-upload>

                            <div v-if="Business && Business.nda != null">
                                <a :href="'storage'+Business.nda.name" target="_blank">
                                    <el-button type="secondary" icon="el-icon-download" >{{ __('Download') }}</el-button>
                                </a>
                                <el-button icon="el-icon-delete" type="danger" @click="removeNda()">{{ __('Delete') }}</el-button>
                            </div>

                            <div class="text-right full-width mt-10" style="margin-top: 10px">
                                <el-button
                                    v-if="!(Business && Business.nda && Business.nda.docusign_uri && Business.nda.docusign_uri != '')"
                                    @click="requestSignature"
                                    :disabled="importLoading || !Business || !Business.nda"
                                    type="primary">
                                        {{ __('Request Signature') }}
                                </el-button>
                            </div>

                        </el-form>

                    </div>
            </el-dialog>
        </div>
    </div>
</template>
<script>
    import Noty from 'noty'

    export default {
        name: "BusinessNda",
        props: {
            pageData: {
                type: Object,
                required: true,
            },
            business: {},
        },
        data() {
            return {
                import_file: "",
                fileList: [],
                importLoading: false,
                Business: this.business,
                showDialog: false,
                formData: {
                    email: this.business && this.business.email || null,
                },
                rules: {
                    email: [
                        { required: true, message: this.__('Required'), trigger: 'blur' },
                    ],
                },
                loadingRequest: false,
            }
        },
        watch: {
            'business.email':function(newVal) {
                this.formData.email = newVal || null
            },
            business(newVal) {
                this.Business = newVal
                this.formData.email = newVal.email || null
            }
        },
        methods: {
            requestSignature() {
                if(!this.Business || !this.Business.nda || !this.Business.nda.id) {
                    new Noty({
                        theme: 'relax',
                        type: 'error',
                        layout: 'topRight',
                        text: this.__('NDA file is required.'),
                        timeout: 3000
                    }).show();

                    return false
                }
                //

                this.$refs['businessNdaForm'].validate((valid) => {
                    if (valid) {
                        console.log('submit')

                        this.loadingRequest = true

                        let form = this.formData
                        form['business_nda_id'] = this.Business.nda.id
                        form['name'] = this.Business.legal_name
                        form['file_url'] = 'storage'+this.Business.nda.name
                        form['document'] = this.Business.legal_name

                        axios.post('/docu-sign/request-signature', form)
                        .then(res => {
                            console.log('res', res.data)
                            if(res.data.success && res.data.uri) {
                                this.Business.nda.docusign_uri = res.data.uri
                                this.showDialog = false
                            }
                        }).catch(err => {
                            console.error('Error!', err)
                        }).finally(() => {
                            this.loadingRequest = false
                        })
                    }
                });
            },
            handleChange(file) {
                console.log("handle change", file && file.raw && file.raw.type || 'null')
                const validTypes = [
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'change application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-excel',
                    'application/msword'
                ] // include types to be accepted

                if (!validTypes.includes(file.raw.type)) {
                    this.$message.warning(`Invalid file type!`);
                    return false;
                } else {
                    this.importLoading = true;
                    this.import_file = file
                    this.maoNi = file.raw

                    const formData = new FormData();
                    formData.append('file', file.raw, file.name);

                    axios.post('/business-list/upload-business-nda?id=' + this.business.id, formData).then((res) => {
                        console.log('Upload success', res);
                        if (res.data.success == true) {
                            this.fileList.push({
                                name: file.name,
                                uid: file.uid,
                                size: file.size,
                                type: 'pdf',
                                fileContents: file.raw,
                                show: false,
                                filePath: res.data.imageFile.filePath,
                                url: res.data.imageFile.filePath,
                                show:  true,
                                caption: null
                            });

                            this.Business.nda = res.data.nda
                        }
                        this.importLoading = false;
                    });
                }
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
            removeNda() {
                this.importLoading = true
                axios.post('/business-list/remove-nda?id=' + this.business.id).then((res) => {
                    let result = res.data
                    if (result.success == true) {
                        this.Business.nda = null
                    }
                    this.importLoading = false;
                });
            }
        },
    }
</script>
