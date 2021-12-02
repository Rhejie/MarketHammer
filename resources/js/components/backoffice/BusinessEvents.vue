<template>
	<div class = "events-container" v-loading = "pageLoading">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card borderless">
                    <!-- <div class="card-header">
                        <div class="card-title">Events Lists</div>
                    </div> -->
                    <div class="card-body">
                        <!-- <div class="card-actions">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="input-search-container">
                                        <el-input
                                            class="input-search"
                                            v-model="search"
                                            placeholder="Type to search">
                                            <i slot="suffix" class="el-input__icon el-icon-search"></i>
                                        </el-input>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="filter-container">
                                        <el-popover
                                            v-model="filterVisible"
                                            placement="bottom"
                                            width="300"
                                            trigger="manual"
                                            class="filter-container">

                                            <div class="businessListFilterContainer">
                                                <div class="header-container">
                                                <span class="header"> {{ 'Filter Options' }} </span>
                                                    <i class="el-icon-close" @click="filterVisible = false"></i>
                                                </div>
                                                

                                                <el-form :model="filterForm" ref="filterForm" :label-position="'top'" class="filterForm">
                                                </el-form>

                                                <button type="button" class="btn btn-primary btn-red filter-button">Filter</button>
                                                <button type="button" class="btn btn-default filter-button">Reset</button>
                                            </div>

                                            <button class="btn btn-outline-gray" slot="reference" @click="filterVisible = !filterVisible">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-funnel" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                                                </svg>
                                            </button>
                                        </el-popover>
                                        <button type="button" class="btn btn-outline-gray">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cloud-upload" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"></path>
                                                <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="add-button-container" style="padding-top: 5px !important;">
                                        <button type="button" class="btn btn-primary btn-red" @click="addEvent()">Add Event</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <el-table
                        class="table-business-list"
                        :data="businessData.business_events"
                        style="width: 100%">
                            <el-table-column
                                prop="name"
                                label="Event Name">
                            </el-table-column>
                            <el-table-column
                                prop="startDate"
                                label="Start">
                            </el-table-column>
                            <el-table-column
                                prop="endDate"
                                label="End">
                            </el-table-column>
                            <el-table-column
                                prop="link"
                                label="Redirect URL">
                            </el-table-column>
                            <el-table-column
                                prop="is_active"
                                label="Status">
                                <template slot-scope="scope">
                                  <el-tag
                                    :type="scope.row.is_active == 1 ? 'success' : 'primary'">
                                    {{ scope.row.is_active == 1 ? 'Active' : 'Inactive'}}
                                  </el-tag>
                                </template>
                            </el-table-column>
                            <el-table-column
                                label="View">
                                <template slot-scope="scope">
                                    <el-button type = "text" @click = "editEvent(scope.row)" icon="el-icon-view" class="text-blue action-button"></el-button>
                                    <!-- <el-button type = "danger" class = "btn-red" @click = "deleteEvent(scope.row)">Delete</el-button> -->
                                </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
            </div>
        </div>
    
        
    <el-dialog
    :title="formTitle"
    :visible.sync="formDialogVisible"
    width="70%"
    top = "20px"
    class="add-business-dialog">
        <event-form
            :event-data = "selectedEvent">
        </event-form>
    </el-dialog>
	</div>
</template>
<script>
import Vue from 'vue'
import Noty from 'noty'

import _forEach from 'lodash/forEach'
import cloneDeep from 'lodash/cloneDeep'

export default {
	props: {
        businessData : {
            required: false
        },
    },
	data(){
        return {
            formDialogVisible: false,
            search: '',
            businessData: this.businessData,
            filterVisible: false,
            filterForm: {
                status: 'All',
            },
            selectedEvent : null,
            status: this.businessData.business_events.is_active = true ? 'Active' : 'Inactive'
        }
	},
	created() {
	},
	computed:{

	},
	methods: {
        addEvent(){
            this.selectedEvent = null
            this.formDialogVisible = true
            this.formTitle = "Add New Event"
        },
        editEvent(data){
            this.selectedEvent = data
            this.formDialogVisible = true
            this.formTitle = "View Event"
        },
	},
	watch:{
    }
}
</script>
<style lang="scss">
.events-container{
	background-color: #fff;
	border: 1px solid #E9E9E9;
	padding: 0px 16px;
}
.business-list{
    .el-dialog__body{
        padding: 10px 20px 30px;
    }

    .action-edit{
        text-decoration: underline;
        cursor: pointer;
    }

    .btn-import-image {
      background-color: green !important;
      border-color: green !important;
      color: white !important;
      font-size: 11px;
      padding: 10px 15px;
      border-radius: 2px;
    }
}
.el-loading-spinner .path {
  stroke: #EC3434;
}

.filter-container {
  padding-bottom: 15px;
  padding-top: 5px;
}

.el-upload-list__item {
  line-height: unset !important;
  border: 1px solid #E4E7ED !important;
  padding: 10px;
}

.image-caption {
  margin-top: 10px !important;
  padding-bottom: 10px !important;
  .el-upload-list__image-caption {
    display: inline !important;
  }

  .el-upload-list__image-caption-input {
    display: inline !important;
    font-size: 10px;
    .el-input__inner {
      height: 20px !important;
      width: 200px !important;
      border-radius: 2px;
      padding: 10px 15px;
    }
  }
}

.el-upload-list-image {
  float: left !important;
}

</style>