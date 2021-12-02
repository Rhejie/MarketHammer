<template>
	<div>
		<div class="return_detail" @click="returnFromDetailView">
			<div>
				<i class="fas fa-arrow-left" style="font-size: 20px"></i>
			</div>
			<div>
				<p>{{ __("Return") }}</p>
			</div>
    	</div>
    	<el-card class="box-card full-width">
    		<div class="content-header detail-hearder">
    			<div class="header-details-wrapper">
    				<div class="header-title-details">
    					{{ detailsData.form_title }}
    				</div>
    				<div class="header-subtitle-details">
    					<div class="subs">
    						<div class="subs-title-details">{{ __("Form ID") }}:</div>
    						<div class="subs-content-details">
    							{{ detailsData.form_id }}
    						</div>
    					</div>
    					<div class="subs">
    						<div class="subs-title-details">{{ __("Form Type") }}:</div>
    						<div class="subs-content-details">
    							{{ detailsData.form_type.name }}
    						</div>
    					</div>
    					<div class="subs">
    						<div class="subs-title-details">{{ __("Reference ID") }}:</div>
    						<div class="subs-content-details">
    							{{ detailsData.refrence_id }}
    						</div>
    					</div>
    					<div class="subs">
    						<div class="subs-title-details">{{ __("Last Modified By") }}:</div>
    						<div class="subs-content-details">
    							{{ detailsData.user.first_name }}
    						</div>
    					</div>
    				</div>
    			</div>

    			<div class="ml-auto" style="padding-right: 20px;" >
    				{{ __("Status") }}
    				<el-select
	    				v-model="detailsData.form_submission_status_id"
	    				style="width: 160px; margin-right: 20px;margin-left: 10px;"
	    				class="round-input"
	    				placeholder="Select"
                        @change="selectSubmissionStatus">
    					<el-option
    						v-for="item in pageData.form_status"
    						:key="item.id"
    						:label="__(item.name)"
    						:value="item.id">
    					</el-option>
    				</el-select>

    				<el-dropdown @command="handleAction">
    					<el-button type="primary">
    						{{ __('Action') }}<i class="el-icon-arrow-down el-icon--right"></i>
    					</el-button>
    					<el-dropdown-menu slot="dropdown">
    						<el-dropdown-item command="submitSupplier" v-if="!submittedToSupplier">{{ __('Submit to suppliers') }}</el-dropdown-item>
    						<el-dropdown-item command="postAgain" v-if="submittedToSupplier">{{ __('Post Again') }}</el-dropdown-item>
    						<el-dropdown-item>{{ __('Continue') }}</el-dropdown-item>
    					</el-dropdown-menu>
    				</el-dropdown>
       			 </div>
      		</div>
    	</el-card>
    	<el-card class="box-card full-width second_details-wrapper">
    		<el-card class="box-card full-width" shadow="never">
    			<div class="second-header-details">
    				<div>
    					<el-menu
	    					:default-active="activeIndex"
	    					class="el-menu-demo"
	    					mode="horizontal"
	    					@select="handleSelect"
	    					background-color="#fff"
	    					text-color="#000"
	    					active-text-color="#ffd04b">
	    					<el-menu-item index="form">{{ __("Form") }}</el-menu-item>
	    					<el-menu-item index="submissions">{{ __("Submissions") }}</el-menu-item>
	    				</el-menu>
    				</div>
	    			<div class="second-detail-search" style="width: 300px">
	    				<el-input
		    				v-if="activeIndex === 'submissions'"
		    				suffix-icon="fas fa-search"
		    				class="search-box round-input full-width"
                            v-model="searchAnswer"
                            @keyup.enter.native="applyFilter"
		    				clearable
		    				:placeholder="__('Type to search')">
		    			</el-input>
		    		</div>
		    		<div class="ml-auto">
		    			<div class="submission-details-download">
                            <el-popover
                                placement="bottom"
                                style="margin-right:20px"
                                v-if="activeIndex === 'submissions'"
                                width="250"
                                trigger="click">
                                    <div class="form_list_filter">
                                        <el-form :model="filterData" ref="addNewForm" class="demo-ruleForm">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <el-form-item :label="__('Filter')" prop="selected_at">
                                                        <el-select
                                                            class="full-width"
                                                            filterable
                                                            v-model="filterData.selected_at"
                                                            :placeholder="__('Select form type')">
                                                                <el-option value="All">{{__('All')}}</el-option>
                                                                <el-option
                                                                    v-for="item in filterDataItem"
                                                                    :key="item"
                                                                    :value="item">
                                                                    {{__(item)}}
                                                                </el-option>
                                                            </el-select>
                                                    </el-form-item>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="filter_footer_button" style="float:right">
                                                        <button type="button" class="btn btn-default" @click="ResetFilterButton">
                                                            {{ __("Reset") }}
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-black" @click="filterButton">
                                                            {{ __('Filter') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </el-form>
                                    </div>
                                <el-button slot="reference"><i class="fas fa-filter"></i></el-button>
                            </el-popover>
			    			<el-button v-if="activeIndex === 'submissions'" @click="exportSubmission" round type="primary" class="btn btn-black">
			    				{{ __("Download") }}
			    			</el-button>
		    			</div>
		    		</div>
    			</div>
			</el-card>

			<DetailItem
				v-if="activeIndex === 'submissions'"
				:detailsData="detailsData"
                :submittedToSupplier="submittedToSupplier"
                :filterAnswer="filterAnswer"
                @selectSubmit="selectSubmit"
                :searchValue="searchValue"
                :pageData="pageData"
				:formData="formData">
			</DetailItem>

		  	<form-form-build
		        v-if="activeIndex === 'form'"
		        :detailsData="detailsData"
		        :form-groups="formGroups"
                :submittedToSupplier="submittedToSupplier"
                :pageData="pageData"
		        @templateUI="templateUI">
		    </form-form-build>
   		</el-card>
   		<el-dialog
	   		:title="__('Send to suppliers')"
	   		:visible.sync="supplierDialog"
	   		width="50%">
	   		<div class="row" v-if="!isSelectManual">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form_submission_form_id">
                                {{__('FORM')}}
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form_submission_form_id_content">
                                <el-input placeholder="Form ID" style="text-align:center" v-model="detailsData.form_id" :disabled="true"></el-input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="send_to_suppliers">
                                {{__('Send To')}}:
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="send_to_supplier_button">
                                <div class="click_suppliers" @click="favoritesSupplier">
                                    {{__('To Favorite List')}}
                                </div>
                                <div class="click_suppliers">
                                    {{__('To All Suppliers')}}
                                </div>
                                <div class="click_suppliers" @click="manualSupplier">
                                    {{__('Select Manually')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	   		</div>
            <div class="row" v-if="isSelectManual">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form_submission_form_id">
                                {{__('FORM')}}
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form_submission_form_id_content">
                                <el-input placeholder="Form ID" style="text-align:center" v-model="detailsData.form_id" :disabled="true"></el-input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{__('Select Suppliers')}}:
                        </div>
                        <div class="col-md-12">
                            <el-input v-model="searchSuppliers" @keypress.enter.native="searchSuppliersData" :placeholder="__('Search')"></el-input>
                        </div>
                        <div class="col-md-12">
                            <div class="suppliers_data">
                                <div class="selected_suppliers">
                                    {{select_supplierId.length}} {{__('Selected')}}
                                </div>
                                <el-table
                                    ref="multipleTable"
                                    v-loading="loadingSuppliers"
                                    :data="suppliers"
                                    height="300"
                                    fit
                                    :stripe="true"
                                    :border='true'
                                    :row-key="getRowKeys"
                                    highlight-current-row
                                    @selection-change="handleSelectionChange">
                                        <el-table-column
                                            type="selection"
                                            :reserve-selection="true"
                                            width="55">
                                        </el-table-column>
                                        <el-table-column
                                            property="legal_name"
                                            prop="legal_name"
                                            :label="__('Suppliers')">
                                        </el-table-column>
                                </el-table>
                            </div>
                        </div>
                        <div class="supplier_footer_button">
                            <div style="float: right; padding-right: 10px">
                                <el-button @click="returnToSelectSubmit">{{__('Cancel')}}</el-button>
                                <el-button type="primary" class="btn btn-black" @click="saveSuppliers">{{__('Send')}}</el-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   		</el-dialog>

	    <el-dialog
		    :title="__('Upload NDA Request')"
		    :visible.sync="showNdaDialog"
		    width="420px"
		    top = "20px"
		    @close="showNdaDialog = false"
		    :close-on-click-modal="false">
		    <docusign-request-form @cancel-request="showNdaDialog = false"></docusign-request-form>
		</el-dialog>
  	</div>
</template>
<script>
import DetailItem from "./DisplayItem";
import fileExporter from '../../../../mixins/fileExporter'
export default {
  name: "FormDetailsView",
  mixins: [fileExporter],
  props: {
  	formGroups: {},
    detailsData: {
      type: Object,
      required: true,
    },
    pastView: {
      type: String,
      required: true,
    },
    pageData: {
        type: Object,
        required: true
    }
  },
  components: {
    DetailItem,
  },
  data() {
    return {
      view: ["Open", "In Progress"],
      actionFormSubmission: [
        "Submit to Supplier",
        "Post Again",
        "Continue",
        "NDA Request",
      ],
      showNdaDialog: false,
      viewData: "Open",
      actionValue: null,
      activeIndex: "form",
      formData: [],
      supplierDialog: false,
      isSelectManual: false,
      suppliers: [],
      multipleSelection: [],
      searchSuppliers: '',
      loadingSuppliers: false,
      selectedData: [],
      select_supplierId: [],
      select_supplier_number: null,
      submittedToSupplier: false,
      searchAnswer: '',
      searchValue: '',
      filterAnswer: '',
      filterData: {
          selected_at : 'All'
      },
      filterDataItem: [
          'Selected',
          'Rejected'
      ],
    };
  },
  created() {
    this.templateUI();
    this.getSuppliers();
    this.checkIfFOrmSubmittedToSuppliers();

  },
  methods: {
      handleAction(command) {
          if(command == 'nda') {
              this.showNdaDialog = true
          }
          if(command == 'submitSupplier') {
              this.supplierDialog = true;
          }
          if(command == 'postAgain') {
              this.supplierDialog = true;
              this.isSelectManual = true;
          }
      },

    handleSelect(key, keyPath) {
      this.activeIndex = key;
    },
    returnFromDetailView() {
      this.$emit("clickReturn", this.pastView);
    },
    templateUI(data) {
      this.formData = data;
    },
    actionFormSubmissionClick(item) {
      if (item === "Submit to Supplier") {
        this.supplierDialog = true;
      }
    },
    favoritesSupplier() {
      this.$API.BuyerFormList.sendToFavoritesSUpplier(this.detailsData).then((res) => {
        if (res.data === "no favorites") {
          this.$message({
            message: this.__("Warning, No favorites found."),
            type: "warning",
          });
        } else if (res.data === "no template") {
          this.$notify({
            title: this.__("Failed"),
            message: this.__("No Selected Template"),
            type: "error",
          });
        } else {
          this.$notify({
            title: this.__("Success"),
            message: this.__("Send Successfully"),
            type: "success",
          });
          this.$emit("reloadList", true);
        }
        this.supplierDialog = false;
      });
    },
    manualSupplier() {
        this.isSelectManual = true;
    },
    getSuppliers() {
        this.loadingSuppliers = true;
        let params = {
            search: this.searchSuppliers,
            form_submission_id : this.detailsData.id
        }
        this.$API.BuyerFormList.getSuppliers(params).then(res => {
            this.suppliers = res.data;
            this.loadingSuppliers = false;
        });
    },
    handleSelectionChange(val) {
        this.multipleSelection = val;
        this.select_supplier_number = this.multipleSelection.length;
        this.select_supplierId = [];
            if (val) {
                val.forEach(row => {
                    if (row) {
                        this.select_supplierId.push(row.id);
                    }
                });
            }
      },
    saveSuppliers() {
        let params = {
            'selectedSuppliers' : this.select_supplierId,
            'form_submission_data' : this.detailsData
        }
        this.$API.BuyerFormList.sendFormToSupplierManually(params).then(res => {
            if(res.data == 'send successfully') {
                this.$emit("reloadList", true);
                this.$notify({
                    title: this.__("Success"),
                    message: this.__("Send Successfully"),
                    type: "success",
                });

                this.searchSuppliers = '';
                this.multipleSelection = []
                this.select_supplierId = []
                this.isSelectManual = false;
                this.submittedToSupplier = true;
                this.getSuppliers();
            }
            else if(res.data == 'no supplier selected') {
                this.$notify({
                    title: this.__("Failed"),
                    message: this.__("No Supplier Selected"),
                    type: "error",
                });
            }
            else {
                this.$notify({
                    title: this.__("Failed"),
                    message: this.__("No Selected Template"),
                    type: "error",
                });
            }
        });
    },
    returnToSelectSubmit() {
        this.multipleSelection = []
        this.select_supplierId = []
        this.isSelectManual = false;
    },
    searchSuppliersData() {
        this.getSuppliers();
    },
    getRowKeys(row) {
        return row.id;
    },
    selectSubmissionStatus(item){
        console.log('===============selectststaus=====================');
        let params = {
            form_id : this.detailsData.id
        };
            this.$API.BuyerFormList.updateStatusSubmissionForm(params, item)
                .then(res => {
                    this.$emit('updateFormStatus');
                });

            console.log(params, item);
        console.log('====================================');
    },
    checkIfFOrmSubmittedToSuppliers() {
        this.$API.BuyerFormList.checkSendToSupplier(this.detailsData.id)
            .then(res => {
                console.log('================CheckIfSUbmittedORnot====================');
                console.log(res.data);
                if(res.data == 'yes') {
                    this.submittedToSupplier = true;
                }
                console.log('====================================');
            });
    },
    selectSubmit() {
        this.supplierDialog = true;
    },
    applyFilter() {
        this.searchValue = this.searchAnswer;
    },
    filterButton() {
        this.filterAnswer = this.filterData.selected_at;
    },
    ResetFilterButton() {
        this.filterData.selected_at = "All";
    },
    exportSubmission() {
        let fileName = 'Form Submissions';
        let url = `/areas/get-export-form-submission/${this.detailsData.id}`;
        const link = document.createElement('a');
		link.href = url;
        link.setAttribute('download', fileName);
		document.body.appendChild(link);
		link.click();
    }
  },
  watch: {
      multipleSelection(val) {

      },
      searchSuppliers(val) {
          if(val == '') {
              this.getSuppliers();
          }
      },
      searchAnswer(val) {
          if(val == '') {
              this.searchValue = '';
          }
      },
  }
};
</script>
<style lang="scss">
.detail-hearder {
  padding-top: 2px;
  padding-bottom: 2px;
}
.return_detail {
  margin-bottom: 10px;
  display: flex;
  padding: 0;
  flex-wrap: wrap;
  height: 23px;
  cursor: pointer;
  div {
    margin-right: 10px;
  }
  p {
    font-size: 15px;
  }
}
.submission-details-download {
  padding: 10px;
  display: flex;
  flex-wrap: wrap;
}
.header-details-wrapper {
  padding: 12px;
}
.header-title-details {
  font-size: 16px;
}
.header-subtitle-details {
  display: flex;
  flex-wrap: wrap;
  font-size: 12px;

  .subs-title-details {
    margin-right: 70px;
    color: #929292;
  }

  .subs-content-details {
    color: #333333;
  }
}

.second_details-wrapper {
  margin-top: 3px;

  .second-header-details {
    display: flex;
    flex-wrap: wrap;

    .second-detail-search {
      padding: 10px;
    }
  }
}
.form_submission_button_send {
  padding: 10px;
}
.form_submission_form_id{
    text-align: center;
    padding-top: 10px;
}
.suppliers_data{
    width: 100%;
    height: 350px;
    padding: 5px;

    .selected_suppliers{
        padding: 5px;
        font-size: 15px;
        float: right;
    }
}
.supplier_footer_button{
    width: 100%;
}
.send_to_suppliers{
    font-weight: bold;
    font-size: 13px;
    padding: 10px;
}
.send_to_supplier_button {
    padding: 10px;
    .click_suppliers{
        padding: 15px;
        text-align: center;
        border-style: solid;
        border-width: 1px;
        margin-bottom: 10px;
        cursor: pointer;
        border-color: #b7b7b7;
    }

    .click_suppliers:hover {
        background-color: #000;
        color: #fff;
    }
}
input.el-input__inner {
    font-size: 12px;
}
main.content-wrapper {
    overflow-y: scroll;
}
</style>
