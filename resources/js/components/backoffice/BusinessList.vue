<!-- Probably Unused -->

<template>
    <div class="main-container">
        <div class="table-container">
            <div class="card borderless">
                <div class="card-actions">
                    <div class="header-title">
                        <h5>Company List </h5>
                    </div>
                    <div class="search-container">
                        <el-input
                            class="input-search"
                            v-model="search"
                            placeholder="Type to search"
                            @keypress.enter.native="searchBusinessListing"
                        >
                            <i
                                slot="suffix"
                                class="el-input__icon el-icon-search"
                            ></i>
                        </el-input>
                    </div>
                    <div class="secondary-action-buttons">
                        <base-business-filter
                            ref="baseBusinessFilter"
                            :filter-list="filterList"
                            :filter-data.sync = "filterData"
                            @change = "changeFilter" >
                        </base-business-filter>
                        <!-- <el-button @click="openBusinessImportModal()">
                            <i class="el-icon-upload2"></i>
                        </el-button> -->
                        <el-button
                        class="mh-btn"
                        @click="openImportModal()" >
                            <i class="fas fa-upload"></i>
                        </el-button>
                        <el-button
                        class="mh-btn"
                        @click="openImportKeywordModal()" >
                            <i class="fas fa-upload"></i>
                        </el-button>
                        <el-button
                        class="mh-btn"
                        @click="showColumnEditor = true" >
                            <i class="fas fa-columns"></i>
                        </el-button>
                    </div>
                    <div class="add-new-button">
                        <button
                            type="button"
                            class="btn btn-primary btn-black"
                            @click="addBusiness()"
                        >
                            <i class="fas fa-plus"></i
                            >  {{ __("Add New Company") }}
                        </button>
                    </div>
                </div>
            </div>
            <base-business-filter-tags
                :filter-data = "filterData"
                :filter-list="filterList"
                :include-label = "true">
            </base-business-filter-tags>
            <el-table
                class="table-list-container"
                :data="tableDataList"
                style="width: 100%"
                v-loading="tableLoading"
                @row-click="viewBusinessDetail">
                <el-table-column
                    v-for="col in selectedColumns"
                    :key="col.value"
                    :label="col.label"
                    :prop="col.prop"
                    :sortable = "col.sortable ? col.sortable : false"
                    :width = "col.value === 'legal_name' ? '200px' : ''"
                    show-overflow-tooltip
                    >
                    <template slot-scope="scope">
                        <template v-if="col.value === 'legal_name'">
                            {{ scope.row.legal_name }}
                        </template>
                        <template v-else-if="col.value === 'website'">
                            <a :href = "scope.row.website" v-if = "scope.row.website">{{ scope.row.website }}</a>
                        </template>
                        <template v-else-if="col.value === 'city'">
                            {{ __(scope.row.city) }}
                        </template>
                        <template v-else>
                            <span v-html="scope.row[col.prop]"></span>
                        </template>
                    </template>
                </el-table-column>

                <el-table-column :label="__('Action')" width="80px">
                    <!--<template slot-scope="scope">
                        <el-button
                            @click="viewBusinessDetail(scope.row)"
                            type="text"
                        >
                            <u>{{ __("View") }}</u>
                        </el-button>
                        <span
                            @click="editBusiness(scope.row)"
                            class="action-edit"
                            >{{ __("Edit") }}</span
                        >
                        <span
                            @click="deleteBusiness(scope.row)"
                            class="action-edit mr-2"
                            >{{ __("Delete") }}</span
                        > -->
                        <!-- <el-button class="btn-import-image" @click="openImportImageDialog(scope.row.id)">
                                        {{ 'Import Image' }}
                                    </el-button> -->
                    <!--</template> -->
                    <template slot-scope="scope">
                        <el-dropdown
                            trigger="click"
                            @command="handleAction">
                            <el-button
                                class="text-black"
                                type="text"
                                icon="fas fa-ellipsis-v"
                                @click.stop>
                            </el-button>
                            <el-dropdown-menu slot="dropdown">
                                <!--el-dropdown-item :command="{action: 'view', data: scope.row}">
                                    <span class="">
                                        <i class="fas fa-eye"></i> {{ __('View') }}
                                    </span>
                                </el-dropdown-item-->
                                <el-dropdown-item :command="{action: 'update', data: scope.row}">
                                    <span class="btn-update">
                                        <i class="fas fa-edit"></i> {{ __('Update') }}
                                    </span>
                                </el-dropdown-item>
                                <el-dropdown-item divided :command="{action: 'delete', data: scope.row, index: scope.$index}">
                                    <span class="btn-delete">
                                        <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                    </span>
                                </el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>
                    </template>
                </el-table-column>
            </el-table>
            <div class="text-right">
                <global-pagination
                    :current_page="current_page"
                    :current_size="current_size"
                    :pagination="businessListPagination"
                    @handleSizeChange="handleSizeChange"
                    @handleCurrentChange="handleCurrentChange"
                ></global-pagination>
            </div>
        </div>

        <!--  <businesslists-form
                :business = "selectedBusiness" :upload-image-route="uploadImageRoute" :upload-video-route="uploadVideoRoute" @businessSaved="getBusinessList">
        </businesslists-form>
 -->

        <!-- import modal -->
        <business-import-modal></business-import-modal>
        <el-dialog
            :title="formTitle"
            :visible.sync="formDialogVisible"
            width="70%"
            top="20px"
            :before-close="handleClose"
            class="add-business-dialog"
        >
            <business-form :business-data="selectedBusiness" :pageData="pageData"> </business-form>
        </el-dialog>
        <!-- EL DIALOG FOR IMPORT IMAGE -->
        <!-- <el-dialog
          title="Import Images"
          :visible.sync="formDialogVisibleImport"
          width="45%"
          top = "20px"
          :before-close="handleCloseImport"
          :close-on-click-modal="false">
          <div class="text-center" v-loading="importLoading">
            <el-upload
              class="upload-demo"
              drag
              :action="uploadImageRoute"
              :on-success="handleSuccess"

              ref="upload"
              :before-upload="handleBeforeUpload"
              :on-progress="handleOnProgress"
              :auto-upload="false"
              :on-change="handleChange"
              :file-list="fileList"
              :show-file-list="false">
              <i class="el-icon-upload"></i>
              <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
              <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 2MB</div>
            </el-upload>
            <ul class="el-upload-list el-upload-list --picture">
              <li class="el-upload-list__item is-success" v-for="file in fileList" :key="file.uid">
                <img v-if="file.show" :src="'../storage'+file.filePath" :alt="file.name" width="100px" height="70px" class="el-upload-list-image">
                <a class="el-upload-list__item-name">
                  {{ file.name }}
                </a>
                <div class="image-caption">
                  <span class="el-upload-list__image-caption"> {{ 'Image Caption' }} </span>
                  <el-input class="el-upload-list__image-caption-input" placeholder="(optional)" v-model="file.caption"></el-input>
                </div>
                <label class="el-upload-list__item-status-label">
                  <i class="el-icon-upload-success el-icon-check"></i>
                </label>
                <i class="el-icon-close" @click="removeImageFromList(file.uid)"></i>
                <i class="el-icon-close-tip">클릭시 삭제됩니다</i>
              </li>
            </ul>
          </div>
          <span slot="footer">
              <button type="button" class="btn btn-default" @click="closeImportDialog">Cancel</button>
              <button type="button" class="btn btn-primary btn-red" @click="uploadImages" :disabled="fileList.length == 0"> {{ 'Save Images' }} </button>
          </span>
        </el-dialog> -->

        <el-dialog title="Import Supplier" width="95%" :visible.sync="dialogFormVisible">
            <div style="padding-bottom:20px">
            <ol class="break-word">
                <li v-html="downloadText" @click="downloadTemplate('business')"></li>
				<li v-html="noteLinkText" style="worb-break: normal"></li>
				<li>{{__('Upload the file below')}}
					<strong><i class='icon pb-arrow-down'></i></strong> {{__('and wait for the preview of uploaded order list. 1 file is only allowed')}}.
				</li>
				<li>{{__('Click the import button to save')}}.</li>

			</ol>
            <el-upload
                class="upload-demo"
                ref="uploadExcel"
                name="uploadExcel"
                :auto-upload="true"
                :on-exceed="handleFileExceed"
                action=""
                accept=".xlsx,.xls"
                :on-remove="removeExcelImport"
                :on-change="onFileChange"
                :on-preview="handlePreviewSupplier"
                :file-list="fileList"
                :http-request="importExcelBusiness"
                :limit="1"
            >
                <el-button slot="trigger" size="small" type="primary"
                    >{{__('Select Excel File')}}</el-button
                >
                <div class="el-upload__tip" slot="tip">
                    <div v-if="errors.message" style="color: red">
                        {{errors.errors.import_file[0]}}
                    </div>
                    <div v-else>
                        {{__('Select single file for .xls or .xlsx format only.')}}
                    </div>
                </div>
            </el-upload>
            <div class="dialog-footer " style="float:right; padding-top: 10px; padding-bottom: 10px">
                <el-button
                    class="btn btn-primary"
                    @click="cancelImportExcel"
                    >{{__('Close')}}</el-button
                >
                <el-button
                    ttype="button"
                    class="btn btn-primary btn-black"
                    :loading="buttonImportLoading"
                    :disabled="buttonImport"
                    @click="importSupplierFromExcel"
                    >{{__(import_title)}}</el-button
                >
            </div>
            <div style="margin-top:20px; margin-bottom:20px">
                <div class="warningInfo">
                    <div class="bus_info">
                        <div class="bus_info_color"></div>
                        <p>{{__('No business category found')}}.</p>
                    </div>
                    <div class="duplicate_info">
                        <div class="duplicate_info_color"></div>
                        <p>{{__('Duplicate business')}}.</p>
                    </div>
                    <div class="missing_info">
                        <div class="missing_info_color"></div>
                        <p>{{__('Missing fields (Legal Name, EID, Phone, Business Category, Address Type, and Factory Type)')}}.</p>
                    </div>
                    <div class="ready_info" >
                        <div class="ready_info_color"></div>
                        <p>{{__('No errors found')}}.</p>
                    </div>
                    <el-button class="but" v-show="showError" type="danger" @click="dialogImportingErrorVisible = true" size="mini"><small>{{__('Show Errors')}}</small></el-button>
                </div>
                <el-table
                    :data="importExcelData"
                    :row-class-name="errorExcelFound"
                    border
                    size="mini"
                    style="width: 100%; word-break:normal">
                    <el-table-column :label="__('Company Information')">
                        <el-table-column :label="__('Row')" width="80px" prop="row" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Legal Name')" prop="legal_name"  :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Phone')" prop="phone" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Fax')" prop="fax"  :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Email')" prop="email"  :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('EID')" prop="eid" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Corp SSN')" prop="corp_ssn" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Bus. Category')" prop="business_category" :sortable="true">
                        </el-table-column>
                        <el-table-column
                            :label="__('About Us')">
                            <template slot-scope="scope">
                                <el-popover trigger="click"  placement="top" width="500">
                                    <div style="padding:15px; word-break:normal">
                                        <p>{{ scope.row.about_us }}</p>
                                    </div>
                                    <div slot="reference" class="name-wrapper">
                                        <el-tag type="text" style="cursor:pointer" size="mini">{{ __('show') }}</el-tag>
                                    </div>
                                </el-popover>
                            </template>
                        </el-table-column>
                        <el-table-column :label="__('Website')" prop="website" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Date Established')" prop="date_established" :sortable="true">
                        </el-table-column>
                    </el-table-column>
                    <el-table-column :label="__('Company Address')">
                        <el-table-column type="expand">
                            <template slot-scope="props">
                                <div class="address_data" style="padding:10px">
                                    <p>{{__('Street1')}}: {{ props.row.street1 }}</p>
                                    <p>{{__('City')}}: {{ props.row.city }}</p>
                                    <p>{{__('State')}}: {{ props.row.state }}</p>
                                    <p>{{__('Country')}}: {{ props.row.country }}</p>
                                    <p>{{__('Postal Code')}}: {{ props.row.postal_code }}</p>
                                </div>
                            </template>
                        </el-table-column>
                        <el-table-column :label="__('Address Type')" prop="address_type" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Factory Type')" prop="factory_type" :sortable="true">
                        </el-table-column>
                    </el-table-column>
                    <el-table-column :label="__('Company Contact')">
                        <el-table-column :label="__('Name')" prop="name" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Title')" prop="title" :sortable="true">
                        </el-table-column>
                    </el-table-column>
                </el-table>
            </div>

            <!--<span slot="footer" class="dialog-footer">
                <el-button
                    class="btn btn-primary"
                    @click="dialogFormVisible = false"
                    >Cancel</el-button
                >
                <el-button
                    ttype="button"
                    class="btn btn-primary btn-black"
                    :loading="buttonImport"
                    :disabled="buttonImport"
                    @click="importSupplierFromExcel"
                    >{{__(import_title)}}</el-button
                >
            </span> -->
            </div>
        </el-dialog>

        <el-dialog title="Import Supplier Keyword" width="80%" :visible.sync="dialogImportKeywordVisible">
            <div style="padding-bottom:20px">
            <ol class="break-word">
                <li v-html="downloadText" @click="downloadTemplate('keywords')"></li>
				<li v-html="noteLinkText" style="worb-break: normal"></li>
				<li>{{__('Upload the file below')}}
					<strong><i class='icon pb-arrow-down'></i></strong> {{__('and wait for the preview of uploaded order list. 1 file is only allowed')}}.
				</li>
				<li>{{__('Click the import button to save')}}.</li>

			</ol>
            <el-upload
                class="upload-demo"
                ref="uploadKeywordExcel"
                name="uploadKeywordExcel"
                action=""
                accept=".xlsx,.xls"
                :auto-upload="true"
                :on-remove="removeExcelkeywordImport"
                :http-request="previewBusinessKeywords"
                :on-change="onFileKeywordChange"
                :file-list="fileList"
                :limit="1"
            >
                <el-button slot="trigger" size="small" type="primary"
                    >{{__('Select Excel File')}}</el-button
                >
                <div class="el-upload__tip" slot="tip">
                    <div v-if="errors.message" style="color: red">
                        {{errors.errors.import_file[0]}}
                    </div>
                    <div v-else>
                        {{__('Select single file for .xls or .xlsx format only.')}}
                    </div>
                </div>
            </el-upload>
            <div class="dialog-footer " style="float:right; padding-top: 10px; padding-bottom: 20px">
                <el-button
                    class="btn btn-primary"
                    @click="cancelImportExcel"
                    >{{__('Close')}}</el-button
                >
                <el-button
                    ttype="button"
                    class="btn btn-primary btn-black"
                    :loading="buttonImportLoading"
                    :disabled="buttonImport"
                    @click="importSupplierKeyFromExcel"
                    >{{__(import_title)}}</el-button
                >
            </div>
            <div style="margin-top:20px; margin-bottom:20px">
                <div class="warningInfo">
                    <div class="bus_info">
                        <div class="bus_info_color"></div>
                        <p>{{__('No business found')}}.</p>
                    </div>
                    <div class="missing_info">
                        <div class="missing_info_color"></div>
                        <p>{{__('Missing fields (Legal Name, EID, Phone, Keywords)')}}.</p>
                    </div>
                    <div class="ready_info">
                        <div class="ready_info_color"></div>
                        <p>{{__('No errors found')}}.</p>
                    </div>
                    <el-button class="but" v-show="showErrorKeyword" type="danger" @click="dialogImportingKeywordErrorVisible = true" size="mini"><small>{{__('Show Errors')}}</small></el-button>
                </div>
                <el-table
                    :data="importExcelKeywordData"
                    :row-class-name="errorExcelKeywordFound"
                    size="mini"
                    style="width: 100%">
                    <el-table-column :label="__('Company Information')">
                        <el-table-column :label="__('Row')" width="80px" prop="row" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Legal Name')" prop="legal_name"  :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Phone')" prop="phone" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('EID')" prop="eid" :sortable="true">
                        </el-table-column>
                        <el-table-column :label="__('Keywords')" prop="keywords" :sortable="true">
                        </el-table-column>
                    </el-table-column>
                </el-table>
            </div>

            <!--<span slot="footer" class="dialog-footer">
                <el-button
                    class="btn btn-primary"
                    @click="dialogFormVisible = false"
                    >Cancel</el-button
                >
                <el-button
                    ttype="button"
                    class="btn btn-primary btn-black"
                    :loading="buttonImport"
                    :disabled="buttonImport"
                    @click="importSupplierKeyFromExcel"
                    >{{__(import_title)}}</el-button
                >
            </span>
            -->
            </div>
        </el-dialog>

        <el-dialog title="Errors found in importing business" :visible.sync="dialogImportingErrorVisible" width="80%" size="small">
            <div class="warningInfo">
                <div class="bus_info">
                    <div class="bus_info_color"></div>
                    <p>{{__('No business category found')}}.</p>
                </div>
                <div class="duplicate_info">
                    <div class="duplicate_info_color"></div>
                    <p>{{__('Duplicate business')}}.</p>
                </div>
                <div class="missing_info">
                    <div class="missing_info_color"></div>
                    <p>{{__('Missing fields (Legal Name, EID, Phone, Business Category, Address Type, and Factory Type)')}}.</p>
                </div>
            </div>

            <el-table
                :data="errorValues"
                :row-class-name="popErrorImport"
                style="width: 100%">
                <el-table-column :label="__('Error')" prop="errorMessage">
                </el-table-column>
                <el-table-column :label="__('Row')" prop="row" width="80px">
                </el-table-column>
                <el-table-column :label="__('Legal Name')" prop="legal_name">
                </el-table-column>
                <el-table-column :label="__('EID')" prop="eid">
                </el-table-column>
                <el-table-column :label="__('Phone')" prop="phone">
                </el-table-column>
                <el-table-column :label="__('Business Category')" prop="business_category">
                </el-table-column>
                <el-table-column :label="__('Address type')" prop="address_type">
                </el-table-column>
                <el-table-column :label="__('Factory type')" prop="factory_type">
                </el-table-column>
            </el-table>
        </el-dialog>

        <el-dialog title="Errors found in importing business keywords" :visible.sync="dialogImportingKeywordErrorVisible" width="70%" size="small">
            <div class="warningInfo">
                <div class="bus_info">
                    <div class="bus_info_color"></div>
                    <p>{{__('No business found')}}.</p>
                </div>
                <div class="missing_info">
                    <div class="missing_info_color"></div>
                    <p>{{__('Missing fields (Legal Name, EID, Phone, Keywords)')}}.</p>
                </div>
            </div>
            <el-table
                :data="errorKeywordValues"
                :row-class-name="popErrorKeywordImport"
                style="width: 100%">
                <el-table-column :label="__('Error')" prop="errorMessage">
                </el-table-column>
                <el-table-column :label="__('Row')" prop="row" width="80px">
                </el-table-column>
                <el-table-column :label="__('Legal Name')" prop="legal_name">
                </el-table-column>
                <el-table-column :label="__('EID')" prop="eid">
                </el-table-column>
                <el-table-column :label="__('Phone')" prop="phone">
                </el-table-column>
                <el-table-column :label="__('Keywords')" prop="keywords">
                </el-table-column>
            </el-table>
        </el-dialog>

        <base-column-editor
            width="40%"
            local-storage-key="businessListColumnManager"
            :columns-selected.sync="checkedColumns"
            :selectable-options="columns"
            :default-columns="defaultColumns"
            :visible.sync="showColumnEditor"
            :span-column = "12"
            @close="showColumnEditor = false">
        </base-column-editor>

    </div>
</template>

<script>
import Compressor from "compressorjs";
import cloneDeep from "lodash/cloneDeep";
import _forEach from "lodash/forEach";

export default {
    props: {
        uploadImageRoute: {
            required: false,
        },
        uploadVideoRoute: {
            required: false,
        },
        pageData: {
            type: Object,
            required: true
        },
    },
    data() {
        let noteLink = `<p style="word-break:normal">Fill the import template with valid values.<b> Refrain from renaming or removing header columns, this will cause an error during upload evaluation</b>. Remove the first entry before importing it is an example. Also, take note that values for Supplier must be equivalent to their respective codes.</p>`
        let durations = [
            {value : '1_5_years', label : "1-5 Years"},
            {value : '6_10_years', label : "6-10 Years"},
            {value : '11_20_years', label : "11-20 Years"},
            {value : '21_years_more', label : "21 Years More"},
        ]

        let filterList = {countries : this.pageData.countries,
            industries : this.pageData.industryTypes,
            businessCategories : this.pageData.businessCategories,
            durations : durations}


        return {
            downloadText: "<a href='javascript:undefined' @click.stop>Download<i class='el-icon-download'></i></a> order excel template. Make sure you have the latest template every upload to avoid errors.",
			noteLinkText: this.__(noteLink),
            errors: [],
            errorValues: [],
            errorKeywordValues: [],
            dialogImportKeywordVisible: false,
            dialogImportingKeywordErrorVisible: false,
            import_file: "",
            import_file_keyword: "",
            totalRows: 0,
            import_file_custom: "",
            import_title: 'Import',
            importExcelData: [],
            showError: false,
            showErrorKeyword: false,
            buttonImportLoading: false,
            importExcelKeywordData: [],
            showImportTable: false,
            buttonImport: true,
            search: "",
            formDialogVisible: false,
            tableData: [],
            tableLoading: false,
            pagesize: 25,
            filterVisible: false,
            // Filter data
            clustersData: [],
            categoryData: [],
            industryTypeData: [],
            filterDropdownLoading: false,
            coordinates: {
                lat: null,
                lng: null,
            },

            // Filter radius
            marks: {
                0: "0 KM",
                1000: "1000 KM",
            },
            selectedBusiness: null,
            formTitle: this.__("Add New Company"),

            // Import images modal
            formDialogVisibleImport: false,
            fileList: [],
            selectedBusinessID: null,
            showImages: false,
            importLoading: false,
            current_page: 1,
            current_size: 25,
            businessListPagination: {},
            dialogFormVisible: false,

            importBusiness: {},
            dialogImportingErrorVisible: false,
            errorResponse: false,
            columns: [
                {
                    label: this.__("Company Name"),
                    prop: "legal_name",
                    value: "legal_name",
                    showTooltip: true,
                    sortable: true
                },
                {
                    label: this.__("English Name"),
                    prop: "english_name",
                    value: "english_name",
                    showTooltip: true,
                    sortable: true
                },
                {
                    label: this.__("Email"),
                    prop: "email",
                    value: "email",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Website"),
                    prop: "website",
                    value: "website",
                    showTooltip: true,
                    sortable: true
                },
                {
                    label: this.__("Phone"),
                    prop: "phone",
                    value: "phone",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Country"),
                    prop: "country",
                    value: "country",
                    showTooltip: true,
                    sortable: true
                },
                {
                    label: this.__("City"),
                    prop: "address_city",
                    value: "address_city",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Industry"),
                    prop: "industry_type",
                    value: "industry_type",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Business Category"),
                    prop: "category",
                    value: "category",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Business Code"),
                    prop: "bus_code",
                    value: "bus_code",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Contact"),
                    prop: "primary_contact",
                    value: "primary_contact",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Date of Establishment"),
                    prop: "date_established",
                    value: "date_established",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Registration Date"),
                    prop: "registered_at",
                    value: "registered_at",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Keywords"),
                    prop: "keywords",
                    value: "keywords",
                    showTooltip: true,
                    sortable: true,
                },
                {
                    label: this.__("Revenue"),
                    prop: "", //latest_revenue
                    value: "", //latest_revenue
                    showTooltip: true,
                    sortable: true,
                },
            ],

            showColumnEditor : false,
            checkedColumns   : [],
            defaultColumns   : ['legal_name', 'email', 'phone', 'city', 'industry_type', 'primary_contact', 'registered_at'],
            filterList       : filterList,
            filterData       : {country_id : "All", city: "All", industry_type_id : "All", category_id : "All", daterange : null, established_duration : "All", est_max : null, est_min : null, rangeType : 5}
        };
    },
    created() {
        this.$EventDispatcher.listen("CLOSE_BUSINESSFORM", (data) => {
            this.formDialogVisible = false;
        });

        this.$EventDispatcher.listen("IMPORT_DONE", (data) => {
            this.getBusinessList();
            this.$notify({
                title: this.__("Success"),
                message: this.__(
                    "Successfully imported business from excel file."
                ),
                type: "success",
            });
        });

        this.$EventDispatcher.listen("BUSINESSDATA_GET", (data) => {
            // this.getBusinessList();
            this.tableDataList.unshift(data);
            this.formDialogVisible = false;
        });

    },
    /*watch: {
        search(newSearch, oldSearch) {
            if(newSearch != oldSearch) {
                this.getBusinessList();
            }
        }
    },*/
    mounted() {
        this.getUsersCoordinates();
        this.firstLoad();
    },
    methods: {
        async firstLoad(){
            //Set filter from query

            let query = this.$route && this.$route.query ? this.$route.query : null
            console.log('firstLoad', query)
            if(query && Object.keys(query).length > 0){
                this.filterData.country_id = query.country_id && query.country_id != "All"  ? Number(query.country_id) : query.country_id
                this.filterData.city = query.city
                this.filterData.industry_type_id = query.industry_type_id
                this.filterData.category_id = query.category_id
                this.filterData.established_duration = query.established_duration
                this.filterData.daterange = [query.registered_start, query.registered_end]
                this.filterData.established_duration = query.established_duration
                this.filterData.est_min = query.est_min ? query.est_min : null
                this.filterData.est_min = query.est_max ? query.est_max : null
                this.filterData.rangeType = query.rangeType

                this.search = query.search ? query.search : this.search
                this.current_page = query.current_page ? parseInt(query.current_page) : this.current_page
                this.current_size = query.count ? parseInt(query.count) : this.current_size

            }

            this.getBusinessList();
        },
        viewBusinessDetail(business) {
            /*window.history.replaceState(
                "",
                `Market Happer | Companies`,
                `#${business.id}`
            );

            let paramData = { businessList: this.tableData, business: business };
            console.log(paramData)
            this.$EventDispatcher.fire(
                "BUSINESS_MODULE_VIEW_DETAILS",
                paramData
            );*/
            let params = this.filterData
            params.user_id =  this.$userData.activeUserId
            params.search = this.search ? this.search : ""
            params.count = this.current_size
            params.current_page = this.current_page
            params.registered_start = this.filterData.daterange && this.filterData.daterange[0] ? this.$df.formatDate(this.filterData.daterange[0], "YYYY-MM-DD") : "All"
            params.registered_end = this.filterData.daterange && this.filterData.daterange[1] ? this.$df.formatDate(this.filterData.daterange[1], "YYYY-MM-DD") : "All"

            this.$router.push({
                name: 'Business Detail',
                params: { config: {reloadData: false, businessList: this.tableData, business: business}, id : business.id },
                query: params
            })
        },
        handleSizeChange(val) {
            this.current_size = val;
            this.getBusinessList();
        },
        handleCurrentChange(val) {
            this.current_page = val;
            this.getBusinessList();
        },
        handleClose(done) {
            this.formDialogVisible = false;
            // this.getBusinessList();
        },
        downloadTemplate(type){
            if(type == 'keywords') {
                let fileName = 'Business list';
                let url = `/business-export/business-export-excel`;
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', fileName);
                document.body.appendChild(link);
                link.click();
            }
            else {
                let fileName = 'Business';
                let url = `/business-export/business-list-export-excel`;
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', fileName);
                document.body.appendChild(link);
                link.click();
            }
        },
        changeFilter(){

            setTimeout(_ => {
                this.getBusinessList()
            }, 500)
        },
        getBusinessList() {
            let params = this.filterData
            params.user_id =  this.$userData.activeUserId
            params.search = this.search ? this.search : ""
            params.count = this.current_size
            params.current_page = this.current_page
            params.registered_start = this.filterData.daterange && this.filterData.daterange[0] ? this.$df.formatDate(this.filterData.daterange[0], "YYYY-MM-DD") : "All"
            params.registered_end = this.filterData.daterange && this.filterData.daterange[1] ? this.$df.formatDate(this.filterData.daterange[1], "YYYY-MM-DD") : "All"

            let concatParams = ""
            if(this.filterData.est_min) {
                concatParams += `&est_min=${this.filterData.est_min}`
            }
            if(this.filterData.est_max) {
                concatParams += `&est_max=${this.filterData.est_max}`
            }

            this.tableLoading = true;

            this.$API.BusinessList.getBusinesses(params, concatParams)
                .then((result) => {
                    this.tableData = result.data.businessList.data;
                    this.businessListPagination = result.data.businessList;
                })
                .catch((err) => {
                    console.log("Error!", err);
                })
                .finally((_) => {
                    this.tableLoading = false;
                });
        },
        errorExcelFound({row, rowIndex}) {

            let b = row.errorStatusBus;
            if(b === 'hasError') {
                return 'warning-row'
            }

            if(row.errorStatusDup == 'duplicate') {
                return 'danger-row'
            }

            if(row.errorMissing == 'hasMissing') {
                return '';
            }



            return 'success-row';
        },
        errorExcelKeywordFound({row, rowIndex}) {

            if(row.status === 'undefined') {
                return 'warning-row'
            }
            else if(row.hasMissing === 'hasMissing'){
                return '';
            }
            return 'success-row';
        },
        popErrorImport({row, rowIndex}){
            if(row.status == 'duplicate') {
                return 'danger-row'
            }
            else if(row.status == 'noBusiness') {
                return 'warning-row'
            }
            else if(row.status == 'missing') {
                return '';
            }
        },
        popErrorKeywordImport({row,rowIndex}) {
            if(row.status == 'noBusiness') {
                return 'warning-row'
            }
            else if(row.status == 'missing') {
                return '';
            }
        },
        removeExcelImport(file, fileList) {
            this.importExcelData = [];
            this.showImportTable = false;
            this.totalRows = 0;
            this.showError = false;
        },
        removeExcelkeywordImport(file, fileList) {
            this.importExcelKeywordData = [];
            this.showImportTable = false;
        },
        handleAction(info) {
			if (info.action === 'delete') {
				this.deleteBusiness(info.data, info.index)
			}
			else if (info.action === 'update') {
				this.editBusiness(info.data)
			}
            else if(info.action === 'view') {
                this.viewBusinessDetail(info.data);
            }
		},
        searchBusinessListing() {
            this.current_size = 10;
            this.current_page = 1;
            this.getBusinessList();
        },
        resetFilters() {

            //this.getBusinessList();
        },
        getUsersCoordinates() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        this.coordinates.lat = pos.coords.latitude;
                        this.coordinates.lng = pos.coords.longitude;
                    },
                    (err) => {
                        console.log(
                            "error in fetching current location",
                            err.message
                        );
                    }
                );
            }
        },
        filterBusinessList() {
            this.filterVisible = false;
            this.getBusinessList();
        },
        addBusiness() {
            this.selectedBusiness = null;
            this.formDialogVisible = true;
            this.formTitle = this.__("Add New Company");

            this.$EventDispatcher.fire("SHOW_ADD_BUSINESS_DIALOG");
        },
        openBusinessImportModal() {
            this.$EventDispatcher.fire("SHOW_IMPORT_DIALOG");
        },
        viewBusiness(data) {
            this.selectedBusiness = data;
            //this.formDialogVisible = true
        },
        editBusiness(data) {
            this.$EventDispatcher.fire("SHOW_EDIT_BUSINESS_DIALOG", data);

            this.selectedBusiness = cloneDeep(data);
            this.formDialogVisible = true;
            this.formTitle = this.__(data.legal_name);
        },
        cancelImportExcel() {
            this.importExcelData = [];
            this.showImportTable = false;
            this.dialogFormVisible = false;
            this.importExcelKeywordData = [];
            this.showErrorKeyword = false;
            this.dialogImportKeywordVisible = false;
            this.fileList = [];
            this.showError = false;
        },
        deleteBusiness(business) {
            this.$confirm(this.$msg.notif.confirm_delete, "Warning", {
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
	            confirmButtonClass: 'el-button--danger',
                type: "warning",
            })
                .then(() => {
                    this.tableLoading = true;

                    this.$API.BusinessList.deleteBusiness(business.id)
                        .then((res) => {
                            if (res.data.success) {
                                this.$notify({
                                    title: this.__("Success"),
                                    message: this.$msg.notif.success_delete,
                                    type: "success",
                                });
                            } else {
                                this.$notify({
                                    title: "Error",
                                    message: this.$msg.notif.failed_delete,
                                    type: "error",
                                });
                            }

                            this.getBusinessList();
                        })
                        .catch((err) => {
                            this.$notify({
                                title: "Error",
                                message: this.$msg.notif.service_error,
                                type: "error",
                            });

                            this.getBusinessList();
                        })
                        .finally((_) => {
                            this.tableLoading = false;
                        });
                })
                .catch((err) => {});
        },

        // IMPORT IMAGES
        openImportImageDialog(id) {
            this.selectedBusinessID = id;
            this.formDialogVisibleImport = true;
        },
        handleCloseImport(done) {
            this.$confirm(this.__("Are you sure to close this dialog?"))
                .then((_) => {
                    this.fileList = [];
                    done();
                })
                .catch((_) => {});
        },
        handleCloseImportSupplier() {
            this.$confirm(this.__('Are you sure to close')+'?', 'Warning', {
                confirmButtonText: this.__('OK'),
                cancelButtonText: this.__('Cancel'),
                type: 'warning'
            })
                .then(_ => {
                this.importExcelData = [];
                this.showImportTable = false;
                this.showError = false;
                this.fileList = [];
                this.dialogFormVisible = false;
                this.importExcelKeywordData = [];
                this.showErrorKeyword = false;
                this.dialogImportKeywordVisible = false;
                    done();
                })
                .catch(_ => {});
        },
        handleSuccess(res, file) {
            this.fileList.forEach((file) => {
                if (file.name == res.imageFile.fileName) {
                    file.filePath = res.imageFile.filePath;
                    file.show = true;
                }
            });

            this.importLoading = false;
            this.$forceUpdate();
        },
        closeImportDialog() {
            this.formDialogVisibleImport = false;
            this.selectedBusinessID = null;
            this.fileList = [];
            this.$refs.upload.clearFiles();
        },
        uploadImages() {
            // this.$refs.upload.submit();
            this.tableLoading = true;
            this.formDialogVisibleImport = false;
            let data = {
                fileList: this.fileList,
            };
            this.$API.BusinessList.saveBusinessBanners(
                this.selectedBusinessID,
                data
            )
                .then((res) => {
                    this.$notify({
                        title: this.__("Success"),
                        message: this.__("Successfully imported images."),
                        type: "success",
                    });
                    this.tableLoading = false;
                    this.closeImportDialog();
                })
                .catch((_) => {
                    this.formDialogVisibleImport = true;
                    this.tableLoading = false;
                });
        },
        handleChange(file) {
            // const isLt2M = file.size / 1024 / 1024 < 2;
            var self = this;
            self.importLoading = true;
            var mime_type = "image/jpeg";
            if (
                typeof output_format !== "undefined" &&
                output_format == "png"
            ) {
                mime_type = "image/png";
            }
            new Compressor(file.__ob__.value.raw, {
                quality: 0.3,
                beforeDraw(context, canvas) {
                    self.importLoading = true;
                },
                success(result) {
                    const formData = new FormData();
                    formData.append("file", result, result.name);

                    // Send the compressed image file to server with XMLHttpRequest.
                    axios
                        .post(
                            "/backoffice/business-list/upload-business-banners",
                            formData
                        )
                        .then((res) => {
                            self.importLoading = false;
                            self.fileList.push({
                                name: result.name,
                                uid: file.uid,
                                size: result.size,
                                type: file.type,
                                fileContents: result,
                                show: false,
                                filePath: res.data.imageFile.filePath,
                                show: true,
                                caption: null,
                            });
                        });
                },
                error(err) {
                    self.importLoading = false;
                    self.$message.warning(this.__(`Error uploading image.`));
                    console.log(err.message);
                },
            });
        },
        handleBeforeUpload(file) {
            // const isLt2M = file.size / 1024 / 1024 < 2;
            // console.log('adw')
            // if(this.fileList.some(f => f.name === file.name && f.size === file.size)) {
            //   this.$message.warning(`Image ${file.name} is already on the list.`);
            //   return false;
            // }
            // if(!isLt2M) {
            //   // this.$message.warning(`Image can not exceed 2MB!`);
            //   // return false;
            //   // let compressed = this.compressFile(file)
            //   // console.log(compressed);
            //   var mime_type = "image/jpeg";
            //   if (typeof output_format !== "undefined" && output_format == "png") {
            //     mime_type = "image/png";
            //   }
            //     new Compressor(file, {
            //       quality: 0.1,
            //       success(result) {
            //         const formData = new FormData();
            //         console.log(result)
            //         // // The third parameter is required for server
            //         // formData.append('file', result, result.name);
            //         // // Send the compressed image file to server with XMLHttpRequest.
            //         // axios.post('/path/to/upload', formData).then(() => {
            //         //   console.log('Upload success');
            //         // });
            //         self.fileList.push({
            //           name: result.name,
            //           uid: file.uid,
            //           size: size.size,
            //           type: file.type,
            //           fileContents: result,
            //           show: false,
            //           caption: null
            //         });
            //       },
            //       error(err) {
            //         console.log(err.message);
            //       },
            //     });
            // }
            // // console.log('size', file.size, newfile)
            // this.fileList.push({
            //   name: file.name,
            //   uid: file.uid,
            //   size: file.size,
            //   type: file.type,
            //   fileContents: file,
            //   show: false,
            //   caption: null
            // });
        },
        removeImageFromList(uid) {
            this.fileList.splice(
                this.fileList.findIndex((f) => f.uid == uid),
                1
            );
            this.$forceUpdate();
        },
        handleOnProgress() {
            this.importLoading = true;
        },
        openImportModal() {
            this.dialogFormVisible = true;
        },
        onFileChange(file, fileList) {
            let type = file.name.split('.');
            type = type[type.length - 1]
            if(!['xls', 'xlsx', 'csv'].includes(type)){
                this.$notify.error({
                    title: this.__("Invalid File"),
                    message: this.__("Unsupported file format. Upload only files with .xls, xlsx, and .csv format")
                });
                return fileList.pop()
            }else {this.import_file = file}
        },
        onFileKeywordChange(file, fileList) {
            let type = file.name.split('.');
            type = type[type.length - 1]
            if(!['xls', 'xlsx', 'csv'].includes(type)){
                this.$notify.error({
                    title: this.__("Invalid File"),
                    message: this.__("Unsupported file format. Upload only files with .xls, xlsx, and .csv format")
                });
                return fileList.pop()
            }else {this.import_file_keyword = file}
        },
        importSupplierFromExcel() {
            this.import_title = "Importing...."
            this.buttonImport = true;
            this.buttonImportLoading = true;
            const loading = this.$loading({
                lock: true,
                text: 'Importing...... Please Wait....',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
            });

            this.import_file = this.$refs.uploadExcel.uploadFiles[0].raw;

            let formData = new FormData();
            formData.append("import_file", this.import_file);
            formData.append('totalRows', this.totalRows);

            this.$API.BusinessList.importBusinessFromExcel(formData)
                .then((response) => {
                    this.getBusinessList();
                    this.errorValues = response.data.errors;
                    console.log(response);
                    console.log(this.errorValues);
                    this.dialogImportingErrorVisible = true;
                    this.buttonImportLoading = false;
                    this.buttonImport = false;
                    loading.close();
                    if(response.data.totalImported != 0) {
                        this.$notify({
                            title: this.__("Success"),
                            message: this.__("Successfully imported."),
                            type: "success",
                        });
                    }else {
                        this.$notify({
                            title: this.__("Failed"),
                            message: this.__("Failed to import."),
                            type: "error",
                        });
                    }
                    this.import_title = 'Import'
                    this.showError = true;
                    this.importExcelData = [];
                    this.fileList = []
                    this.import_file = null;
                    this.buttonImport = true;
                })
                .catch((error) => {
                    // code here when an upload is not valid
                    this.uploading = false;
                    this.errors = error.response.data;
                    console.log("check error: ", this.errors);
                    this.buttonImport = false;
                    loading.close();
                });
        },
        openImportKeywordModal() {
            this.dialogImportKeywordVisible = true;
        },
        importSupplierKeyFromExcel() {
            this.import_title = "Importing...."
            this.buttonImport = true;
            this.buttonImportLoading = true;
            const loading = this.$loading({
                lock: true,
                text: 'Importing...... Please Wait....',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
            });

            this.import_file_keyword = this.$refs.uploadKeywordExcel.uploadFiles[0].raw;

            let formData = new FormData();
            formData.append("import_file", this.import_file_keyword);
            this.$API.BusinessList.importBusinessKeywordFromExcel(formData)
                .then((response) => {
                    this.getBusinessList();
                    this.dialogFormVisible = false;
                    this.errorKeywordValues = response.data.errors;
                    console.log(this.errorKeywordValues);
                    this.dialogImportingKeywordErrorVisible = true;
                    loading.close();
                    if(response.data.totalImported != 0) {
                        this.$notify({
                            title: this.__("Success"),
                            message: this.__("Successfully imported."),
                            type: "success",
                        });
                    }else {
                        this.$notify({
                            title: this.__("Failed"),
                            message: this.__("Failed to import."),
                            type: "error",
                        });
                    }
                    this.import_title = 'Import'
                    this.import_file = null;
                    this.showErrorKeyword = true;
                    this.importExcelKeywordData = [];
                    this.fileList = []
                    this.buttonImport = false;
                    this.buttonImportLoading = false;
                })
                .catch((error) => {
                    // code here when an upload is not valid
                    this.uploading = false;
                    this.errors = error.response.data;
                    console.log("check error: ", this.errors);
                    this.buttonImport = false;
                    loading.close();
                });
        },
        customUploadBusiness(file, fileList) {
            // this.import_file_custom.push = file;

            // let formData = new FormData();
            // formData.append("import_file", this.import_file_custom);
            // this.$API.BusinessList.customUploadDataExcel().then((res) => {
            //     console.log(res);
            // });
        },
        handlePreviewSupplier(file) {
            console.log(file);
        },
		handleFileExceed(file, fileList) {
			this.$notify.error({
		      	title: 'File Limit',
		      	message: 'Failed to add new file. You can only upload one file at a time.'
		    });
		},
        importExcelBusiness() {
            this.import_title = "Generating.."
            this.buttonImport = true;
            this.buttonImportLoading = true;
            let formData = new FormData();
            formData.append('import_file', this.$refs.uploadExcel.uploadFiles[0].raw);
            this.$API.BusinessList.customUploadDataExcel(formData).then((res) => {
                this.importExcelData = res.data.excelData;
                this.showImportTable = true;
                this.buttonImport = false;
                this.buttonImportLoading = false;
                this.totalRows = res.data.totalRows;
                this.import_title = 'Import'
                console.log(res.data.excelData);
            });
        },
        previewBusinessKeywords() {
            this.import_title = 'Generating..';
            this.buttonImport = true;
            this.buttonImportLoading = true;
            let formData = new FormData();
            formData.append('import_file', this.$refs.uploadKeywordExcel.uploadFiles[0].raw);
            this.$API.BusinessList.previewExcelKeyword(formData).then((res) => {
                this.importExcelKeywordData = res.data.excelData;
                this.buttonImport = false;
                this.buttonImportLoading = false;
                this.import_title = 'Import';
                this.showImportTable = true;
                console.log(res.data.excelData);
            });
        },
    },
    computed:{
        selectedColumns(){
            let cols = this.checkedColumns
            let colList = cloneDeep(this.columns)

            colList = colList.filter(cl => { return cols.indexOf(cl.value) >= 0 })

            return colList
        },
        tableDataList(){
            let list = cloneDeep(this.tableData)

            _forEach(list, lt =>{
                lt.keywords = ""
                let keywords = lt.business_keyword.length > 0 ? lt.business_keyword.map(bk => { return bk.name}) : []
                lt.keywords = keywords.length > 0 ? keywords.join(",") : ''
                lt.bus_code = lt.business_category ? lt.business_category.ko_stat_code : ""

                lt.latest_revenue = lt.latest_revenue ? this.$nf.monetoryDefault(lt.latest_revenue) : ""
            })

            return list

        }
    }
};
</script>

<style lang="scss">
.main-container{
    padding-bottom: 30px;
}

.business-list {
    .el-dialog__body {
        padding: 10px 20px 30px;
    }

    .action-edit {
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
    stroke: #ec3434;
}

.filter-container {
    padding-bottom: 15px;
}

.el-upload-list__item {
    line-height: unset !important;
    border: 1px solid #e4e7ed !important;
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

.wit_dialog{
    .el-checkbox-group{
        >.el-row{
            .el-col{
                margin-top: 20px;
            }
        }
    }
}
.el-table .warning-row {
    background: #ffc266;
  }

  .el-table .success-row {
    background: #c2f0c2;
  }
.el-table .danger-row {
    background: #ff8566;
}

.warningInfo {
    display: flex;

    .bus_info {
        display: flex;
        margin-right: 20px;
        text-align: center;
        vertical-align: middle;

        .bus_info_color {
            background-color:#ffc266;
            padding: 5px;
            height: 20px;
            width: 20px;
            margin-right: 5px;
        }

        p{
            font-size: 10px;
        }
    }

    .duplicate_info {
        display: flex;
        margin-right: 20px;
        text-align: center;
        vertical-align: middle;

        .duplicate_info_color {
            background-color:#ff8566;
            padding: 5px;
            height: 20px;
            width: 20px;
            margin-right: 5px;
        }

        p{
            font-size: 10px;
        }
    }
    .ready_info {
        display: flex;
        margin-right: 20px;
        text-align: center;
        vertical-align: middle;

        .ready_info_color {
            background: #c2f0c2;
            padding: 5px;
            height: 20px;
            width: 20px;
            margin-right: 5px;
        }

        p{
            font-size: 10px;
        }
    }
    .missing_info {
        display: flex;
        margin-right: 20px;
        text-align: center;
        vertical-align: middle;

        .missing_info_color {
            border-style: solid;
            border-width: 1px;
            padding: 5px;
            height: 20px;
            width: 20px;
            margin-right: 5px;
        }

        p{
            font-size: 10px;
        }
    }

    .but{
        height: 20px;
        padding: 0;
        padding-left: 10px;
        padding-right: 10px;
    }
    .address_data {
        padding: 10px;
    }
}
</style>
