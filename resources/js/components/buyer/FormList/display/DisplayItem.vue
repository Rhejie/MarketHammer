<template>
<div>
  <div v-if="submittedToSupplier">
    <!-- <docusign-buyer-submission-demo>
    </docusign-buyer-submission-demo> -->

    <div class="submission-content">
        <div class="submission-wrapper form_submission_label" style="height: calc(100vh - 105px); overflow-y: scroll;">
            <div
            class="submission-general-info"
            v-for="(ui, index) in formData"
            :key="index"
            >
            <div class="submission-general-header">
                {{ui.name}}
            </div>
            <div class="submission-general-content">
                <el-table
                    :show-header="false"
                    :stripe="true"
                size="medium"
                fit
                style="width:100%"
                :data="ui.form_fields">
                <el-table-column prop="field_label" show-overflow-tooltip> </el-table-column>
                </el-table>
            </div>
            </div>
        </div>


        <div class="detail-item-content-data" style="height: calc(100vh - 105px); overflow-y: scroll;">
            <div v-loading="loadingAnswer" v-for="(answer, index) in answerDataSubmission" :key="index">
                <div class="submission-wrapper-detail">
                    <div class="submission-general-info-detail" >
                        <div class="submission-general-detail-item">
                            <div class="submission-general-detail-image">
                                <img
                                    :src="'/storage/'+answer.supplier_data.image_url"
                                    v-if="answer.supplier_data.image_url != null"
                                    class="detail-image"/>
                                <img v-else src="/image/no-image-user.png" class="detail-image" :alt="__('Company Image')">
                            </div>
                            <div class="submission-general-detail-name">
                                <div class="supplier_name_answer">
                                    {{answer.supplier_data.legal_name}}
                                </div>
                                <el-button type="text" @click="viewResponse(answer.supplier_data.id)">{{__('View Response')}}</el-button>
                                <el-popover
                                    placement="bottom"
                                    :disabled="!answer.request_nda"
                                    width="320"
                                    trigger="click"
                                    @show="handleUpdateDocumentStatus(index, answer.request_nda)">
                                        <div v-if="answer.request_nda" class="supplier_request_nda_thumbnail">
                                            <div class="thumbnail">
                                                <img @click="handleNdaPreview(answer)" src="/image/icons/icon_pdf.png"/>
                                            </div>
                                            <div class="body">
                                                <a @click="handleNdaPreview(answer)" href="#">
                                                    <span>{{ answer.request_nda.file_name }}</span>
                                                </a>
                                                <span>
                                                    <span
                                                    @click="handleUpdateDocumentStatus(index, answer.request_nda)"
                                                    class="nda_title" v-if="answer.request_nda.docusign_status">
                                                        {{ answer.request_nda.docusign_status && __(answer.request_nda.docusign_status) }}
                                                        <i
                                                        class="icon"
                                                        :class="loadingNdaStatus.includes(index) ? 'el-icon-loading' : 'el-icon-refresh'"
                                                        />
                                                    </span>
                                                    <span @click="handleNdaPreview(answer)" class="nda_status" v-else>
                                                        {{ __('Not sent') }}
                                                    </span>
                                                    <span class="nda_date">{{ $df.formatDate(answer.request_nda.updated_at, 'MM/D/YYYY h:mm A') }}</span>
                                                </span>
                                            </div>
                                        </div>

                                        <el-button
                                        slot="reference"
                                        type="text"
                                        :disabled="!answer.request_nda">
                                            {{__('View NDA')}}
                                        </el-button>
                                </el-popover>
                            </div>
                            <div class="submissiom-general-detail-buttom">
                                <el-dropdown trigger="click" @command="data => handleActionKeywords(data, answer)">
                                    <el-button class="text-black" type="text" icon="fas fa-ellipsis-v">
                                    </el-button>
                                    <el-dropdown-menu slot="dropdown">
                                        <el-dropdown-item
                                            divided
                                            :command="{
                                            action: 'select',
                                            row: answer}">
                                                {{ __("Select") }}
                                        </el-dropdown-item>
                                        <el-dropdown-item
                                            divided
                                            :command="{
                                            action: 'reject',
                                            row: answer}">
                                                {{ __("Reject") }}
                                        </el-dropdown-item>
                                        <el-dropdown-item
                                            divided
                                            v-if="!answer.request_nda"
                                            :disabled="!answer.supplier_data.email || answer.supplier_data.email == ''"
                                            :command="{
                                            action: 'nda',
                                            row: answer}">
                                                {{ __("NDA Request") }}
                                        </el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </div>
                        </div>
                        <div class="submission-general-detail-content">
                            <div v-for="(formGroup, index) in answer.from_group" :key="index">
                                <span class="answer_form_group"></span>
                                    <div v-for="(fieldgroup, index) in answer.answer_submission.filter(ans => ans.form_submission_fields.form_builder_field_group.id == formGroup.id)" :key="index">
                                            <div class="answer_data">
                                                <div v-if="fieldgroup.form_submission_fields.field_type == 'Multiple Checkboxes'" class="answer_content">
                                                    <div class="null_answer mc" v-if="fieldgroup.value == null"></div>
                                                    <div class="null_answer mc" v-if="JSON.parse(fieldgroup.value).values.length == 0"></div>
                                                    <span v-else v-for="(val, index) in JSON.parse(fieldgroup.value)" :key="index">
                                                        <!--div class="null_answer" v-if="val.length != 0"></!--div -->

                                                        <span v-for="value in val" :key="value">
                                                            {{__(value)}} &nbsp;
                                                        </span>
                                                    </span>
                                                </div>
                                                <div v-else-if="fieldgroup.form_submission_fields.field_type == 'Single Checkbox'" class="answer_content">
                                                    <div v-if="fieldgroup.value == true">{{__('Yes')}}</div>
                                                    <div v-else>{{__('No')}}</div>
                                                </div>
                                                <div v-else-if="fieldgroup.form_submission_fields.field_type == 'Matrix'" class="answer_content">
                                                    <a href="#" class="answer_matrix" v-if="fieldgroup.value != null" @click="viewMatrix(fieldgroup.value, fieldgroup.form_submission_fields.field_label, fieldgroup.form_submission_fields.field_options)">{{ __('View') }}</a>
                                                        <div class="null_answer m" v-if="fieldgroup.value == null"></div>
                                                </div>
                                                <div v-else class="answer_content">
                                                    <div v-if="fieldgroup.form_submission_fields.source_table != ''">
                                                        <!--{{fetchDataFromSourceTable(fieldgroup)}} -->

                                                        <div class="null_answer" v-if="fieldgroup.value == null"></div>
                                                        <div v-else>
                                                            {{__(fieldgroup.value)}}
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        {{__(fieldgroup.value)}}
                                                        <div class="null_answer" v-if="fieldgroup.value == null"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--div v-else>
                <div class="no_answer_data">
                    <i class="fas fa-exclamation-circle no_answer_icon"></i>
                    <p class="no_answer_content">{{__('No Answers yet, Please wait.')}}</p>
                </div>
            </!--div -->
        </div>
    </div>
    <div v-else>
        <div class="not_form_send_yet_wrapper">
            <div class="not_form_content">
                <i class="fas fa-file-upload icon_not_form"></i>
                <p class="not_form_title">{{__('Form Not Yet Submitted')}}.</p>
                <p class="not_form_click">{{__('Click Submit button to send this form to suppliers')}}.</p>
                <el-button round size="mini" @click="submitToSupplier" type="primary" class="btn btn-black">
			    	{{ __("Submit") }}
			    </el-button>
            </div>
        </div>
    </div>
    <el-dialog
        :title="__('Response')"
        :visible.sync="dialogResponse"
        width="60%">
            <response-submission-from-supplier
                v-loading="answerLoading"
                :formData="formData"
                :answerFromSupplier="answerFromSupplier">
            </response-submission-from-supplier>
    </el-dialog>

    <el-dialog
        :title="__(matrixLabel)"
        :visible.sync="dialogMatrix"
        width="50%">
            <el-table
                :data="matrixData"
                style="width: 100%">
                   <el-table-column v-for="(options, index) in matrixOptions" :key="index"
                        :label="__(options.label)">
                        <template slot-scope="scope">
                            <div>
                                {{ scope.row[options.value] }}
                            </div>
                        </template>
                    </el-table-column>
            </el-table>
    </el-dialog>

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
                :prop-nda="requestNdaDetails && requestNdaDetails.request_nda || null"
                :prop-form-data="requestNdaDetails"
                :hide-details="true"
                @uploaded-nda-file="data => updateFormNdaData(data, false)"
                @sent-signature-request="data => updateFormNdaData(data, true)"
                @cancel-request="showNdaDialog = false">

                <!--
                @uploaded-nda-file="data => updateUserNda(data, false)"
                @sent-signature-request="data => updateUserNda(data, true)"
                @removed-business-nda="removeUserNda"
                -->
            </docusign-request-form>
    </el-dialog>

</div>
</template>
<script>
import ResponseSubmissionFromSupplier from './formSubmission/ResponseSubmissionFromSupplier.vue';
export default {
    components: { ResponseSubmissionFromSupplier },
  //name: "DetailsItem", //eh same lang guro nato ang name sa component sa file name para dali lang trace 😁
  props: {
    formData: {
      type: Array,
      required: true,
    },
    detailsData: {
        type: Object,
        required: true
    },
    pageData: {
        type: Object,
        required: true
    },
    submittedToSupplier: {
        type: Boolean,
        required: true
    },
    searchValue: {
        type: String,
        required: true,
        default: null
    },
    filterAnswer: {
        type: String,
        required: true,
        default: null
    }
  },
  data() {
    return {
        answerDataSubmission: [],
        loadingAnswer: false,
        dialogResponse: false,
        answerFromSupplier: [],
        answerLoading: false,
        dialogMatrix: false,
        matrixLabel: 'Data',
        matrixData: [],
        matrixOptions: [],
        dataFromSourceTable: '',
        showNdaDialog: false,
        requestNdaDetails: null,
        loadingNdaStatus : [],
        fetchDataFromSourceTableValue : null
    };
  },
  created() {
    this.getAnswerSubmissionForm();
  },
  methods: {
    handleActionKeywords(info, answer) {
        if(info.action == 'select') {
            this.$confirm('Are you sure you want to select this?', 'Warning', {
                confirmButtonText: 'Select',
                cancelButtonText: 'Cancel',
                type: 'warning'
                }).then(() => {
                    this.selectedAnswer(info.row)
                })
        }
        if(info.action == 'reject') {
            this.$confirm('Are you sure you want to reject this?', 'Warning', {
                confirmButtonText: 'Reject',
                cancelButtonText: 'Cancel',
                type: 'warning'
                }).then(() => {
                    this.rejectAnswer(info.row)
                })
        }
        if(info.action == 'nda') {
            this.requestNdaDetails = answer
            this.showNdaDialog = true
        }
    },

    updateFormNdaData(data, closeDialog) {
        if(data && data.business_id) {
            this.answerDataSubmission.find(li => {
                if(li.supplier_id && li.supplier_id == data.supplier_id) {
                    li['request_nda'] = data
                }
            })
        }

        if(closeDialog) {
            this.showNdaDialog = false
        }
    },

    handleNdaPreview(data) {
        if(data && data.request_nda && (!data.request_nda.docusign_uri || data.request_nda.docusign_uri == '')) {
            this.handleActionKeywords({action : 'nda'}, data)
            return false
        }

        window.open("/docu-sign/get-nda-document/"+data.request_nda.id || '');
    },

    handleUpdateDocumentStatus(item_index, nda) {
        this.loadingNdaStatus.push(item_index)

        axios.get('/docu-sign/get-nda-envelope-status/'+nda.id)
        .then(result => {
            let res = result.data
            if(res.status) {
                nda.docusign_status = res.status
                this.updateFormNdaData(nda, false)
            }
        }).catch(err => {
            console.error('Error!', err)
        }).finally(() => {
            this.loadingNdaStatus = this.loadingNdaStatus.filter(li => li != item_index)
        })
    },

    selectedAnswer(row) {
        this.$API.BuyerFormList.selectAsAnswer(row.id).then(res => {
            console.log(res.data);
            this.$message({
                    type: 'success',
                    message: 'Selected Successfully'
                });
        });
    },
    rejectAnswer(row) {
        this.$API.BuyerFormList.rejectAsAnswerSubmission(row.id).then(res => {
            console.log(res.data);
            this.$message({
                    type: 'success',
                    message: 'Rejected Successfully'
                });
        });
    },
    getAnswerSubmissionForm(){
        this.loadingAnswer = true;
        let params = {
            search: this.searchValue,
            selected_at: this.filterAnswer
        }
        this.$API.BuyerFormList.getAnswerSubmissionForm(this.detailsData.id, params)
            .then(res => {
                this.answerDataSubmission = res.data
                this.loadingAnswer = false;
            });
    },
    submitToSupplier() {
        this.$emit('selectSubmit');
    },
    viewResponse(id) {
        this.answerLoading = true;
        let params = {
            form_submission_id : this.detailsData.id,
            supplier_id : id
        }
        this.$API.BuyerFormList.viewReponseSupplierAnswer(params)
            .then(res => {
                this.answerFromSupplier = res.data;
                this.answerLoading = false;
            });
        this.dialogResponse = true;
    },
    viewMatrix(data, label, options) {
        console.log('===============matrix value=====================');
        this.dialogMatrix = true;
        this.matrixData = JSON.parse(data);
        console.log(JSON.parse(data));
        this.matrixLabel = label;
        this.matrixOptions = options;
        console.log('====================================');
    },
    fetchDataFromSourceTable(data) {
        if(data.value != null && data.form_submission_fields.source_table != null) {
          let params = {
              id : data.value,
              source_table : data.form_submission_fields.source_table
          }
          console.log('================id, source====================');
          console.log(params);
          console.log('====================================');
          this.fetchDataFromSourceTableValue = params.id
        this.fetchDataFromSourceTableValue != null? params.id : null
        }
        else {
            this.fetchDataFromSourceTableValue = null
        }
        //   let value = '';
        //   this.$API.BuyerFormList.withSourceTableValue(params)
        //         .then(res => {
        //             console.log('================data from source table====================');
        //             console.log(res.data);
        //             console.log('====================================');
        //             this.dataFromSourceTable = res.data;
        //         });

      }
  },
  computed: {

  },
  filters: {
      valueOptions(val) {
          return val.values[0];
      },

  },
  watch: {
      searchValue(newVal, oldVal) {
          if(newVal != oldVal) {
              this.getAnswerSubmissionForm()
          }
      },
      filterAnswer(newVal, oldVal) {
          if(newVal != oldVal) {
              this.getAnswerSubmissionForm();
          }
      }
  }
};
</script>

<style lang="scss">
.submission-content {
  display: flex;
  flex-wrap: nowrap;
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
  margin-bottom: 40px;
}

.submission-content{


    .submission-wrapper{
        width: 300px;
    }

    .detail-item-content-data{
        height: 100%;

    }
}

.submission-content::-webkit-scrollbar-thumb {
  background: #ffd25a;
  border-radius: 25px;
}

.detail-item-content-data {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}


.detail-item-content-data::-webkit-scrollbar-track {
}

.detail-item-content-data::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}

.detail-item-content-data::-webkit-scrollbar-thumb {
  background: #ffd25a;
  border-radius: 25px;
}

.submission-general-info-detail {
  width: 300px;
}

.submission-general-info {
  .submission-general-content {
    font-size: 15px;
  }

  .submission-general-header {
    padding-left: 10px;
    font-weight: bold;
    font-size: 18px;
  }

  .submission-general-footer {
    padding-top: 30px;
    border-right-style: solid;
    padding-left: 10px;
    border-width: 1px;
    border-color: #bfbfbf;
    width: 200px;
    font-weight: bold;
    font-size: 18px;
  }
}

.submission-general-footer {
  .submission-general-footer-header {
    padding-top: 30px;
    border-right-style: solid;
    padding-left: 10px;
    border-width: 1px;
    border-color: #bfbfbf;
    width: 200px;
    font-weight: bold;
    font-size: 18px;
  }

  .submission-general-footer-content {
    border-right-style: solid;
    border-width: 1px;
    border-color: #bfbfbf;
    width: 200px;
  }
}

.submission-general-info-detail {
  border-right-style: solid;
  border-bottom-style: solid;
  border-width: 1px;
  border-color: #bfbfbf;
  height: 100%;
  .submission-general-detail-item {
    padding: 10px;
    padding-bottom: 0px;
    display: flex;
    flex-wrap: wrap;
    .submission-general-detail-image {
      padding-right: 10px;
      .detail-image {
        width: 50px;
        height: 50px;
        border-radius: 23px 23px 23px 23px;
      }
    }

    .submission-general-detail-name {
      font-weight: bold;
      font-size: 14px;
      display: flex;
      margin-right: auto;
      padding-left: 10px;
      flex-direction: column;
      .el-button {
        text-decoration: underline;
        text-align: left;
        padding: 4px 0px !important;
      }
    }

    .submissiom-general-detail-buttom {
      padding-right: 5px;
      float: right;
    }
  }

  .submission-general-detail-content {
    .answer_header{
        font-weight: bold;
        font-size: 18px;
        padding-left: 10px;
    }
  }
}

.submission-general-detail-footer {
  .submission-general-footer-header {
    padding-top: 30px;
    border-right-style: solid;
    padding-left: 10px;
    border-width: 1px;
    border-color: #bfbfbf;
    width: 200px;
    font-weight: bold;
    font-size: 18px;
  }

  .submission-general-footer-content {
    border-right-style: solid;
    border-width: 1px;
    border-color: #bfbfbf;
    width: 200px;
  }

}
.not_form_send_yet_wrapper{
    padding: 10px;
    height: 350px;

    .not_form_content{
        text-align: center;
        margin-top: 70px;
        line-height: 0.8;
        .not_form_title{
            font-size: 20px;
        }

        .not_form_click{
            font-size: 20px;
            color: #b7b7b7;
        }

        .icon_not_form{
            font-size: 40px;
            margin-bottom: 20px;
        }
    }
}
.form_submission_label{
    padding-top: 74px;
    border-right-style: solid;
    border-right-width: 1px;
    border-right-color: #b7b7b7;
    height: 100%;

        border-bottom-style: solid;
        border-bottom-width: 1px;
        border-right-color: #b7b7b7;
}

.null_answer{
    padding: 9.5px;
}
.answer_data{
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-bottom-color: #efefef;
    padding: 2px;
    padding-left: 10px;
    padding-right: 10px;
    color: #757575;
}
.answer_content{
    width: 100%;
    white-space: nowrap;
     overflow-x: hidden;
     text-overflow: ellipsis;
}
.answer_content::-webkit-scrollbar {
  width: 10px;
  height: 1px;
}

.answer_content::-webkit-scrollbar-thumb {
  background: #ffd25a;
  border-radius: 25px;
}
.answer_form_group{
    font-weight: bold;
    font-size: 18px;
    padding-left: 5px;
}

.supplier_name_answer{
    font-size: 12px;
    width: 197px;
    white-space: nowrap;
    overflow-x: hidden;
    text-overflow: ellipsis;
}

.no_answer_data{
    text-align: center;
    width: 250%;
    padding-top: 50%;

    .no_answer_icon {
        font-size: 40px;
    }

    .no_answer_content {
        font-size: 20px;
        color: #b7b7b7;
    }

}
.submission-wrapper-detail{
    height: 100%;
}

.supplier_request_nda_thumbnail {
    padding: 20px;
}
</style>
