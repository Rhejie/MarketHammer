<template>
	<div class="p-3 company-general-component">
		<div class="d-flex align-items-center">
			<h4 class="text-black">{{ __('BASIC INFO') }}</h4>
			<el-button
				v-if="!isUpdating"
				type="text"
				class="ml-3 text-yellow"
				@click="enableUpdating">
				<u>{{ __('Update Profile') }}</u>
			</el-button>

			<div class="ml-auto" v-if="isUpdating">
				<el-button
					type="text"
					class="text-black"
					@click="cancelUpdate">
					<u>{{ __('Cancel') }}</u>
				</el-button>

				<el-button
					:disabled="loading"
					round
					class="btn btn-orange"
					@click="updateBusiness">
					{{ __('Save') }}
				</el-button>
			</div>
		</div>

		<el-form
			v-loading="loadings.updateLoading"
			:model="businessForm"
			:rules="rules"
			lable-position="top"
			ref="businessForm">
			<div class="row">
				<div class="col-md-4">
					<el-form-item
						:label="__('Industry Type')"
						prop="industry_type_id"
						:error="hasError('industry_type_id', true)">
						<el-select
							:disabled="!isUpdating"
							v-model="businessForm.industry_type_id"
							class="full-width"
							filterable
							clearable
							@change="industryTypeChanged"
							:placeholder="__('Select Industry Type')">
							<el-option
								v-for="type in pageData.industryTypes"
								:key="type.id"
								:value="type.id"
								:label="type.name">
							</el-option>
						</el-select>
					</el-form-item>

					<el-form-item
						:label="__('Basic Category')"
						prop="business_category_id"
						:error="hasError('business_category_id', true)">
						<el-select
							:disabled="!isUpdating"
							v-model="businessForm.business_category_id"
							class="full-width"
							filterable
							clearable
							:placeholder="__('Select Basic Category')">
							<el-option
								v-for="category in selectableBusinessCategories"
								:key="category.id"
								:value="category.id"
								:label="category.name">
							</el-option>
						</el-select>
					</el-form-item>

					<el-form-item
						:label="__('Bus. Category Code')"
						prop="business_category_id"
						:error="hasError('business_category_id', true)">
						<el-select
							disabled
							v-model="businessForm.business_category_id"
							class="full-width">
							<el-option
								v-for="category in selectableBusinessCategories"
								:key="category.id"
								:value="category.id"
								:label="category.ko_stat_code || category.name">
							</el-option>
						</el-select>
					</el-form-item>

					<el-form-item
						:label="__('Legal Name')"
						prop="legal_name"
						:error="hasError('legal_name', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.legal_name"
							clearable
							class="full-width"
							:placeholder="__('Enter Legal Name')">
						</el-input>
					</el-form-item>

					<el-form-item
						:label="__('English Name')"
						prop="english_name"
						:error="hasError('english_name', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.english_name"
							clearable
							class="full-width"
							:placeholder="__('Enter English Name')">
						</el-input>
					</el-form-item>

				</div>

				<div class="col-md-4">
					<el-form-item
						:label="__('Date of Establishment')"
						prop="date_established"
						:error="hasError('date_established', true)">
						<el-date-picker
							:disabled="!isUpdating"
							v-model="businessForm.date_established"
							class="full-width"
							type="date"
							:placeholder="__('Pick a date')">
						</el-date-picker>
					</el-form-item>

					<el-form-item
						:label="__('Company Status')"
						prop="status"
						:error="hasError('status', true)">
						<el-select
							:disabled="!isUpdating"
							v-model="businessForm.status"
							class="full-width"
							filterable
							clearable
							:placeholder="__('Select Status')">
							<el-option :label="__('Public')" value="public"></el-option>
							<el-option :label="__('Private')" value="private"></el-option>
						</el-select>
					</el-form-item>

					<el-form-item
						:label="__('Website')"
						prop="website"
						:error="hasError('website', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.website"
							clearable
							class="full-width"
							:placeholder="__('Enter Website')">
						</el-input>
					</el-form-item>

					<el-form-item
						:label="__('Email')"
						prop="email"
						:error="hasError('email', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.email"
							clearable
							class="full-width"
							:placeholder="__('Enter Email')">
						</el-input>
					</el-form-item>

					<el-form-item
						:label="__('No. of Employee')"
						prop="employee_count_id"
						:error="hasError('employee_count_id', true)">
						<el-select
							:disabled="!isUpdating"
							v-model="businessForm.employee_count_id"
							class="full-width"
							filterable
							clearable
							:placeholder="__('Select Employee Count')">
							<el-option
								v-for="empCount in pageData.employeeCounts"
								:key="empCount.id"
								:value="empCount.id"
								:label="empCount.name">
							</el-option>
						</el-select>
					</el-form-item>
				</div>

				<div class="col-md-4">
					<el-form-item
						:label="__('R & D Staffs')"
						prop="rnd_staff_count_id"
						:error="hasError('rnd_staff_count_id', true)">
						<el-select
							:disabled="!isUpdating"
							v-model="businessForm.rnd_staff_count_id"
							class="full-width"
							filterable
							clearable
							:placeholder="__('Select R & D')">
							<el-option
								v-for="empCount in pageData.employeeCounts"
								:key="empCount.id"
								:value="empCount.id"
								:label="empCount.name">
							</el-option>
						</el-select>
					</el-form-item>

					<!-- <el-form-item
						:label="__('EID Certificate')"
						prop="eid_certificate"
						:error="hasError('eid_certificate', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.eid_certificate"
							clearable
							class="full-width"
							:placeholder="__('Enter EID Certificate')">
						</el-input>
					</el-form-item> -->

					<el-form-item
						:label="__('Phone')"
						prop="phone"
						:error="hasError('phone', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.phone"
                            @keypress.native="isNumber($event)"
							clearable
							class="full-width"
							:placeholder="__('Enter Phone')">
						<!-- <el-input
							type="number"
							:disabled="!isUpdating"
							v-model="businessForm.phone"
                            @keypress.native="isNumber($event)"
							clearable
							class="full-width"
							:placeholder="__('Enter Phone')"> -->
						</el-input>
					</el-form-item>

					<el-form-item
						:label="__('Fax')"
						prop="fax"
						:error="hasError('fax', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.fax"
                            @keypress.native="isNumber($event)"
							clearable
							class="full-width"
							:placeholder="__('Enter Fax')">
						</el-input>
					</el-form-item>


                    <el-form-item
						:label="__('Corp SSN')"
						prop="corp_ssn"
						:error="hasError('corp_ssn', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.corp_ssn"
							clearable
							class="full-width"
							:placeholder="__('Enter Corp SSN')">
						</el-input>
					</el-form-item>

                    <el-form-item
						:label="__('Registration Date')"
						prop="created_at"
						:error="hasError('date_established', true)">
						<el-date-picker
							:disabled="true"
							v-model="businessForm.created_at"
							class="full-width"
							type="date"
							:placeholder="__('Pick a date')">
						</el-date-picker>
					</el-form-item>
				</div>
			</div>
            <div class="row">
                <div class="col-lg-4">
                    <el-form-item
						:label="__('EID ')"
						prop="eid"
						:error="hasError('eid', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.eid"
							clearable
							class="full-width"
							:placeholder="__('Enter EID ')">
						</el-input>
					</el-form-item>
                </div>

                <div class="col-md-8">
                    <el-form-item
						:label="__('About Us')"
						prop="about_us"
						:error="hasError('about_us', true)">
						<el-input
							:disabled="!isUpdating"
							v-model="businessForm.about_us"
                            type="textarea"
							clearable
                            :autosize="{ minRows: 2, maxRows: 12}"
							class="full-width"
							:placeholder="__('Enter About Us')">
						</el-input>
					</el-form-item>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <!--<el-upload
                        ref="uploadIEDCertificate"
                        class="upload-demo"
                        action=""
                        :disabled="!isUpdating"
					    :auto-upload="false"
                        :on-change="eidCertificateChange"
                        :before-remove="eidCertificateRemove"
                        :file-list="fileList"
                        :on-exceed="handleEIDAttachmentExceed"
                        :list-type="list_type"
					    :limit="1">
                        <el-button slot="trigger" class="full-width" size="small" type="default"><i class="fas fa-paperclip"></i> EID Certificate</el-button>
                    </el-upload> -->
                    <el-upload
                        class="eid-certificate-style"
                        action=""
                        :drag="true"
                        :disabled="!isUpdating"
					    :auto-upload="false"
                        :on-change="eidCertificateChange"
                        :before-remove="eidCertificateRemove"
                        :on-remove="eidCertificateRemove"
                        :file-list="fileList"
                        :on-exceed="handleEIDAttachmentExceed"
                        :list-type="list_type"
					    :limit="1">
                        <div class="el-upload__text"><i class="fas fa-paperclip"></i> {{ __("Attach EID Certificate here.") }}</div>
                    </el-upload>
                </div>
            </div>
			<div class="row">
				<div class="col-md-3">
					<el-form-item
						prop="image_url">
						<span slot="label">{{ __('Company Logo') }}</span><br>
						<el-upload
                            :drag="true"
							ref="uploader"
							class="avatar-uploader avatar-round"
							action=""
							:disabled="businessForm.image_url && !isUpdating ? true : false"
							:auto-upload="false"
							:show-file-list="false"
							name="companyImage"
							accept=".jpeg,.png,.svg,.jpg"
							:on-change="changeAvatar">
							<template v-if="businessForm.image_url">
								<!-- <img src="/storage/uploads/images/businesses/1_310ed230f37db8ffb785cd80cf8c01cb7b00705f.png" class="avatar"> -->
								<img :src="businessForm.image_url" class="avatar">
								<span class="el-upload-list__item-actions">
									<el-button
										v-if="isUpdating"
										type="text"
										@click="removeImage">
										<i class="el-icon-delete"></i>
									</el-button>
								</span>
							</template>

							<span v-else >
								<i class="fas fa-camera avatar-uploader-icon"></i>
								<span class="upload-text">{{ __('Upload/Drag a Photo') }}</span>
							</span>
						</el-upload>
					</el-form-item>
				</div>

				<div class="col-md-8">
					<el-form-item
						prop="company_pictures">
						<div slot="label">
							<span>{{ __('Company Pictures') }}</span>
							<!-- <el-button
								class="text-yellow"
								style="position: absolute; right: 20px; z-index: 100;"
								type="text">
								<u>View All</u>
							</el-button> -->
						</div><br>

						<div class="d-flex align-items-center">
							<el-upload
								ref="businessMedias"
								name="businessMedias"
								action=""
								:limit="5"
								:disabled="!isUpdating"
								:file-list="businessForm.files.filter(f => !f.is_deleted)"
	                            :on-exceed="handleExceed"
	                            :on-change="handleChange"
	                            accept=".jpeg,.png,.svg,.jpg"
								multiple
								list-type="picture-card"
								class="avatar-uploader-2"
								:auto-upload="false">
								<i slot='default' class="fas fa-camera avatar-uploader-icon"></i>
								<div slot="file" slot-scope="{file}">
									<img class="el-upload-list__item-thumbnail" :src="file.url" alt="">
									<span class="el-upload-list__item-actions">
										<span
											class="el-upload-list__item-preview"
											@click="handlePictureCardPreview(file, file.id )">
											<i class="el-icon-zoom-in"></i>
										</span>
										<!-- <span v-show="updateButtonClick"
											v-if="file.id"
											class="el-upload-list__item-delete"
											@click="handleDownload(file)">
											<i class="el-icon-download"></i>
										</span> -->
										<span
											class="el-upload-list__item-delete"
											@click="handleRemove(file)">
											<i class="el-icon-delete"></i>
										</span>
									</span>
								</div>
							</el-upload>
						</div>

						<!-- <div class="d-flex">
							<el-upload
								disabled
	  							class="avatar-uploader-2"
								action=""
								:show-file-list="false">
								<img v-if="businessForm.company_pictures" :src="businessForm.company_pictures" class="avatar">
								<i v-else class="fas fa-camera avatar-uploader-icon-2"></i>
							</el-upload>

							<el-upload
								disabled
	  							class="avatar-uploader-2"
								action=""
								:show-file-list="false">
								<img v-if="businessForm.company_pictures" :src="businessForm.company_pictures" class="avatar">
								<i v-else class="fas fa-camera avatar-uploader-icon-2"></i>
							</el-upload>

							<el-upload
								disabled
	  							class="avatar-uploader-2"
								action=""
								:show-file-list="false">
								<img v-if="businessForm.company_pictures" :src="businessForm.company_pictures" class="avatar">
								<i v-else class="fas fa-camera avatar-uploader-icon-2"></i>
							</el-upload>

							<el-upload
								disabled
	  							class="avatar-uploader-2"
								action=""
								:show-file-list="false">
								<img v-if="businessForm.company_pictures" :src="businessForm.company_pictures" class="avatar">
								<i v-else class="fas fa-camera avatar-uploader-icon-2"></i>
							</el-upload>

							<el-upload
								disabled
	  							class="avatar-uploader-2"
								action=""
								:show-file-list="false">
								<img v-if="businessForm.company_pictures" :src="businessForm.company_pictures" class="avatar">
								<i v-else class="fas fa-camera avatar-uploader-icon-2"></i>
						</el-upload> -->
					</el-form-item>
				</div>
			</div>

			<div>
                <el-form-item v-loading="loadings.gettingKeyword">
                    <div slot="label" class="keywords_add">
                        <span>{{__('Keywords')}}</span>

                    </div><br>
                    <el-card class="p-3 box-card full-width">
                        <div class="">
                            <!-- <el-autocomplete
                                v-model="searchKeywords"
                                value-key="name"
                                :fetch-suggestions="querySearchKeywords"
                                @keyup.enter.native="addNewKeyword"
                                :placeholder="__('Add new keyword')"
                                suffix-icon="fas fa-search"
                                class="search-box round-input full-width"
                                style="width: 300px; margin-bottom:10px"
                                @select="handleSelectKeywords"
                            ></el-autocomplete> -->
                            <el-select
                                v-model="businessKeywordsValue"
                                multiple
                                filterable
                                remote
                                @keyup.enter.native="addNewKeyword"
                                @change="addKeywords"
                                reserve-keyword
                                :placeholder="__('Add new keywords')"
                                :remote-method="remoteMethodKeywords"
                                allow-create
                                @remove-tag="removeKeywords"
                                name="asasdasd"
                                class="search-box round-input full-width"
                                size="small"
                                style="margin-bottom:10px"
                                :loading="loadingKeywords">
                                <el-option
                                v-for="item in optionsKeywords"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id">
                                </el-option>
                            </el-select>
                        </div>
                    </el-card>
                </el-form-item>
			</div>

			<div>
			<el-form-item v-loading="loadings.gettingProcesses">
					<div slot="label" class="keywords_add">
						<span>{{__('Processes')}}</span>
					</div><br>
					<el-card class="p-3 box-card full-width">
						<div>
                            <el-select
                                v-model="businessProcessesValue"
                                multiple
                                filterable
                                remote
                                reserve-keyword
                                @keyup.enter.native="addNewBusinessProcess"
                                :placeholder="__('Add new processes')"
                                :remote-method="remoteMethodProcesses"
                                @change="addProcesses"
                                @remove-tag="removeProcesses"
                                class="full-width search-box round-input"
                                size="small"
                                style=" margin-bottom:10px"
                                :loading="loadingProcesses">
                                <el-option
                                v-for="item in optionsProcesses"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id">
                                </el-option>
                            </el-select>
                        </div>
					</el-card>
				</el-form-item>
			</div>

			<!-- SNS Section -->
			<div :class="`col-sm-12 ${!snsList.length ? 'col-md-12' : 'col-md-12'}`">
				<el-form-item v-loading="loadings.gettingSns">
					<div slot="label">
						<span>{{ __('SNS') }}</span>
						<el-button
							class="ml-3 text-yellow"
							type="text"
							@click="showSnsForm = true"
							style="position: absolute; z-index: 100;">
							<u><i class="el-icon-plus"></i> {{ __('Add') }}</u>
						</el-button>
					</div><br>

					<div
						v-if="snsList.length"
						class="mb-3"
						v-for="sns in snsList"
						:key="sns.id">
						<el-form-item>
							<div class="d-flex">
								<div slot="label" class="sns-label" :style="`background: ${sns.sns.color}`">
									{{ sns.sns.name }}
								</div>
								<el-input
									class="full-width"
									:disabled="!isUpdating"
									:placeholder="__('Enter Account Info')"
									v-model="sns.account_info"
									>
								</el-input>

								<el-button
									@click="deleteSns(sns)"
									type="text"
									class="text-black ml-3">
									<i class="far fa-times-circle"></i>
								</el-button>
							</div>
						</el-form-item>
					</div>

					<div
						v-if="!snsList.length"
						class="d-flex justify-content-center">
						{{ __('No SNS for this business.') }}
					</div>
				</el-form-item>
			</div>
			<!-- End of SNS Section -->
		</el-form>

		<!-- SNS Form -->
		<el-dialog
    		:visible.sync="showSnsForm"
	    	@close="closeSnsForm"
	    	:title="__('Add SNS')"
	    	width="30%">
	    	<el-form
	    		v-loading="snsForm.snsSaveLoading"
	    		:model="snsForm"
	    		ref="snsForm"
	    		label-position="top">
	    		<el-form-item
	    			:label="__('SNS')"
	    			prop="sns_id"
	    			:rules="{required: true, message: __('Please select a social networking site.'), trigger: 'blur'}">
	    			<el-select
	    				class="full-width"
	    				filterable
	    				clearable
	    				v-model="snsForm.sns_id">
	    				<el-option
	    					v-for="sns in selectableSns"
	    					:key="sns.id"
	    					:label="sns.name"
	    					:value="sns.id">
	    					<span>
	    						<i :class="`fab fa-${sns.name.toLowerCase()} mr-2`"></i> <span>{{ sns.name }}</span>
	    					</span>
	    				</el-option>
	    			</el-select>
	    		</el-form-item>

	    		<el-form-item
	    			:label="__('Account Info')"
	    			prop="account_info"
	    			:rules="{required: true, message: __('Please enter the account info.'), trigger: 'blur'}">
	    			<el-input
	    				class="full-width"
	    				clearable
	    				v-model="snsForm.account_info">
	    			</el-input>
	    		</el-form-item>
	    	</el-form>

	    	<span slot="footer" class="dialog-footer">
			    <el-button
			    	type="text"
			    	class="text-black"
			    	@click="closeSnsForm">
			    	<u>{{ __('Cancel') }}</u>
			    </el-button>
			    <el-button
			    	round
			    	@click="createNewSns('snsForm')"
			    	type="primary"
			    	class="btn btn-black">
			    	{{ __('Submit') }}
			    </el-button>
			</span>
	    </el-dialog>
	    <!-- End of SNS Form -->

	    <!-- Image Preview -->
	    <el-dialog
	    	:visible.sync="showImage"
	    	@close="closeImagePreview"
	    	top="5vh">
            <img width="100%" :src="dialogImageUrl" alt="">
		</el-dialog>
		<!-- End of Image Preview -->
	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'
	import { formHelper } from '../../../../../mixins/formHelper'

	export default {
		name: 'BusinessGeneral',
		mixins: [formHelper],
		props: {
			pageData: {
				type: Object,
				required: true
			},
			business: {}
		},
		data() {
			return {
				loadings: {
					updateLoading: false,
					snsSaveLoading: false,
					gettingSns: false,
					gettingKeyword: false,
                    gettingProcesses: false,
				},
                loadingProcesses: false,
                loadingKeywords: false,
                optionsProcesses: [],
                optionsKeywords: [],
				loading: false,
				isUpdating: false,
                businessProcessesValue: [],
                businessKeywordsValue: [],
				showImage: false,
                fileList: [],
                list_type: '',
				showSnsForm: false,
                file_data: '',
                file_path: '',
				businessForm: {},
				businessFormCopy: {},
                businessProcesses: [],
                processes: [],
				rules: {
					industry_type_id: {required: true, message: this.__('Industry Type is required.'), trigger: 'change'},
					business_category_id: {required: true, message: this.__('This field is required.'), trigger: 'change'},
					email: {type: 'email', message: this.__('Enter a valid email'), trigger: 'blur'}
				},
				snsList: [],
				dialogImageUrl: null,
				snsForm: {
					business_id: null,
					sns_id: null,
					account_info: null
				},
                updateButtonClick: true,
                fileID: '',
                imageFileName: '',
                businessData : this.business,
                deleteAttachment: false,
                businessKeywords: [],
                searchKeywords: '',
                dataArray: [],
                dataBusinessArray: [],
                statusAdd : 'remove'
			}
		},
		created() {
			this.initialize();
            this.getProcesses();

        },
		methods: {

            isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },
            showBusinessProcesses() {
                if (!this.business) return
                this.loadings.gettingProcesses = true;
                this.$API.BusinessProcesses.fetch(this.business.id)
                    .then(res => {
                        this.businessProcesses = res.data;
                        console.log(res.data)
                        this.loadings.gettingProcesses = false;
                        this.dataBusinessArray = this.businessProcesses.map(bp => {return bp.processes.name})

                        this.businessProcessesValue = this.dataBusinessArray;
                    });
            },
            getProcesses(){
                this.$API.BusinessProcesses.getProcessesData()
                    .then((res) => {
                        this.processes = res.data;
                        console.log(res.data);
                    });
            },
            remoteMethodProcesses(query) {
                if(!this.business) return
                this.loadingProcesses = true
                if(query !== '') {
                    this.$API.BusinessProcesses.getProcessesData(query, this.business.id)
                    .then((res) => {
                        this.processes = res.data;
                        this.optionsProcesses = res.data;
                        this.loadingProcesses = false;
                        console.log(res.data);
                    });
                } else {
                    this.optionsProcesses = [];
                }
            },

            addProcesses() {
                this.addNewBusinessProcess();
            },

            removeProcesses(item) {
                this.$confirm(this.$msg.notif.confirm_delete, 'Warning', {
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    confirmButtonClass: "el-button--danger",
                    type: 'warning'
                    }).then(() => {
                        let postData = {
                            business_id : this.business.id,
                            name : item
                        }
                        this.$API.BusinessProcesses.deleteProcessesByName(postData)
                            .then(res => {
                                this.$notify({
                                        title: 'Success',
                                        message: this.$msg.notif.success_delete,
                                        type: 'success'
                                        });
                            });

                    }).catch(() => {
                        this.businessProcessesValue.push(item);

                });
            },

            remoteMethodKeywords(query) {
                if(!this.business) return
                this.loadingKeywords = true;
                if(query !== '') {
                    this.$API.GlobalKeyword.getBusinessKeywordsData(query, this.business.id)
                    .then((res) => {
                        this.optionsKeywords = res.data;
                        this.loadingKeywords = false;
                        console.log(res.data);
                    });
                } else {
                    this.optionsKeywords = [];
                }
            },

            addKeywords(item) {
                this.statusAdd = 'add';
                this.addNewKeyword();
            },

            removeKeywords(item) {
                this.status = 'remove';
                this.$confirm(this.$msg.notif.confirm_delete, 'Warning', {
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    confirmButtonClass: "el-button--danger",
                    type: 'warning'
                    }).then(() => {
                        let postData = {
                            business_id : this.business.id,
                            name : item
                        }
                        this.$API.BusinessKeyword.delKeyByName(postData).then(res => {
                            this.$notify({
                                        title: 'Success',
                                        message: this.$msg.notif.success_delete,
                                        type: 'success'
                                        });
                        });
                        // this.$API.BusinessKeyword.deleteKeyByName(postData)
                        //     .then(res => {
                        //         this.$message({
                        //             type: 'success',
                        //             message: this.__('Delete completed')
                        //         });
                        //     });

                    }).catch(() => {
                        this.businessKeywordsValue.push(item);

                });
            },
            setStoreInput(item) {
                if(item == 59) {
                    return 'adadasdasdasds'
                }
            },

            addNewBusinessProcess() {
                if(!this.business) return;
                let postData = {
                    business_id : this.business.id,
                    businessProcess : this.businessProcessesValue
                }
                this.$API.BusinessProcesses.storeBusinessProcesses(postData)
                    .then(res => {
                        let data = res.data;
                        for(let key in data) {
                            this.businessProcesses.unshift(data[key]);
                        }
                        // this.$notify({
                        //     title: this.__("Successful"),
                        //     message: this.$msg.notif.success_add,
                        //     type: "success"
                        // })
                        if(res.data != 'Nope') {
                            this.$notify({
                                        title: 'Success',
                                        message: this.$msg.notif.success_add,
                                        type: 'success'
                                        });
                            // this.businessProcessesValue = null;
                        }
                    }).catch(error => {
                        this.$notify({
                            title: this.__("Failed"),
                            message: this.__('Invalid Input'),
                            type: "error"
                        })
                    });
            },
            handleAction(info) {
                if(info.action === 'delete') {
                    this.askToDeleteProcesses(info.data, info.index);
                }
            },
            askToDeleteProcesses(id, index) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("OK"),
                cancelButtonText: this.__("Cancel"),
                type: "warning"
            })
                .then(() => {
                    this.deleteProcesses(id, index);
                })
                .catch(() => {});
            },

            deleteProcesses(id, index) {
                this.$API.BusinessProcesses.deleteProcesses(id)
                    .then(res => {
                        this.businessProcesses.splice(index, 1);
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_delete,
                            type: "success"
                        });
                        console.log(res.data);
                    });
            },

            fileData() {
                this.$API.BusinessList.eidFileList(this.businessForm.id)
                    .then(res => {
                        if(res.data.length != 0) {
                            this.fileList = res.data;
                            for(let key in this.fileList) {
                                let fileExtension = null;
                                fileExtension = this.fileList[key].name.split('.').pop();
                                if(fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png'){
                                    this.list_type = 'picture'
                                }
                                else {
                                    this.list_type = "";
                                }
                            }
                        }
                        else {
                            this.fileList = []
                        }
                    });
            },
            querySearchKeywords(query, cb) {
                if (!query) {
					cb([])

					return
				}

				this.$API.GlobalKeyword.getBusinessKeywordsData(query, this.business.id)
				.then(res => {

                    console.log(res.data);
					if (res.data) {
						cb(res.data)

						return
					}

					cb([])
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {})
            },
            handleSelectKeywords(item) {

				console.log(item)

				let postData = {
					business_id: this.business.id,
					global_keyword_id: item.id
				}

				this.createKeywords(postData)
			},
            createKeywords(postData) {

				this.$API.BusinessKeyword.createBusinessKeyword(postData)
				.then(res => {
					if (res.data.data) {
						this.searchKeywords = null
                        console.log(res.data.data);
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_add,
                            type: "success"
                        })
                        this.businessKeywords.unshift(res.data.data);
                        return
                    }

                    this.$notify({
                        title: this.__("Failed"),
                        message: this.$msg.notif.failed_add,
                        type: "error"
                    })
				})
				.catch(err => {
					console.log(err)

					this.showValidationError(err)
				})
				.finally(_ => {
					this.loading = false
				})
			},
            addNewKeyword() {
                // let postData = {
                //     value: this.searchKeywords,
                //     business_id : this.business.id
                // }

                let postData = {
                    business_id : this.business.id,
                    businessKeywords : this.businessKeywordsValue
                }

                this.$API.BusinessKeyword.addNewBusinessKeywords(postData).then(res => {

                        let data = res.data;
                        for(let key in data) {
                            console.log('res.data');
                            this.businessKeywords.unshift(data[key]);
                        }
                        this.loadings.gettingKeyword = false;
                        if(res.data != 'Nope') {
                            // this.$notify({
                            //     title: this.__("Successful"),
                            //     message: this.$msg.notif.success_add,
                            //     type: "success"
                            // })
                            this.$notify({
                                        title: 'Success',
                                        message: this.$msg.notif.success_add,
                                        type: 'success'
                                        });
                            // this.businessKeywordsValue = [];
                        }
                });
            },
            handleActionKeywords(info) {
                if(info.action === 'delete') {
                    this.askToDeleteKeywords(info.data, info.index);
                }
            },
            askToDeleteKeywords(id, index) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
                confirmButtonText: this.__("OK"),
                cancelButtonText: this.__("Cancel"),
                type: "warning"
                })
                    .then(() => {
                        this.deleteKeywords(id, index);
                    })
                    .catch(() => {});
            },
            deleteKeywords(id, index) {
                this.$API.BusinessKeyword.deleteKeywordData(id)
                    .then(res => {
                        this.businessKeywords.splice(index, 1);
                        this.$notify({
                            title: this.__("Successful"),
                            message: this.$msg.notif.success_delete,
                            type: "success"
                        });
                        console.log(res.data);
                    });
            },
            handleEIDAttachmentExceed(files, fileList) {
                this.$message.warning(`The limit is 1, you selected ${files.length} files this time, add up to ${files.length + fileList.length} totally`);
            },

			updateBusiness() {

				this.$refs.businessForm.validate(valid => {
					if (valid) {
						this.resetErrors()
						this.loadings.updateLoading = true

						let postData = cloneDeep(this.businessForm)
						postData.snsList = JSON.stringify(cloneDeep(this.snsList))
						postData.with_image = false

						let imageFile = document.getElementsByName("companyImage")
						let imgFile = null
						if (postData.image_url !== this.businessFormCopy.image_url) {
							postData.with_image = true

							if (imageFile) {
								imgFile = imageFile[0].files[0]
							}
						}

						postData.date_established = this.$df.formatDate(postData.date_established, "YYYY-MM-DD")

						postData.imageFile = imgFile

						this.$API.BusinessList.updateBusiness(postData, postData.id)
						.then(res => {
							if (res.data.success) {
								this.$EventDispatcher.fire('BUSINESS_MODULE_ITEM_UPDATED', cloneDeep(res.data.data))

								this.businessForm.image_url = this.businessForm.image_url ? `/storage/${this.businessForm.image_url}` : null
								this.businessFormCopy = cloneDeep(this.businessForm)
								this.emitBusiness()

								this.$notify.success({
						          	title: 'Success',
						          	message: this.$msg.notif.success_update
						        })
                                this.isUpdating = false
								this.businessForm.eid_delete = false;
								return
							}

							this.setErrors(res.data.errors)

							this.$notify.error({
					          	title: this.__('Failed'),
					          	message: this.__('Failed to update the business.')
					        })
						})
						.catch(err => {
							console.log(err)

							this.$notify.error({
					          	title: this.__('Server Error'),
					          	message: this.__('An error occured while updating a business. Please report this to your administrator.')
					        })
						})
						.finally(_ => {
							this.loadings.updateLoading = false
						})
					}
				})
			},
			emitBusiness(){
				console.log("emitBusiness")

				let bForm = cloneDeep(this.businessForm)
				let data = this.businessData
				data.business_category_id = bForm.business_category_id
				data.industry_type_id = bForm.industry_type_id
				data.legal_name = bForm.legal_name
				data.english_name = bForm.english_name
				data.date_established = bForm.date_established
				data.status = bForm.status
				data.website = bForm.website
				data.email = bForm.email
				data.employee_count_id = bForm.employee_count_id
				data.rnd_staff_count_id = bForm.rnd_staff_count_id
				data.eid = bForm.eid
				data.eid_certificate = bForm.eid_certificate
				data.eid_attachment_url = bForm.eid_attachment_url
                data.eid_file_name_attachment = bForm.eid_file_name_attachment
				data.phone = bForm.phone
				data.fax = bForm.fax
				data.image_url = bForm.image_url
                data.corp_ssn = bForm.corp_ssn
                data.about_us = bForm.about_us

				this.businessData = data
			},
			removeImage() {
				this.$confirm('Are you sure you want to remove the company image?', 'Remove Image', {
	                confirmButtonText: 'Remove',
	                cancelButtonText: 'Cancel',
	                type: 'error',
	                confirmButtonClass: 'el-button--danger'
	            })
	            .then(_ => {
	            	this.businessForm.image_url = null
	            })
			},
			changeAvatar(file, filelist){
				const fileSize = file.size / 1024 / 1024 < 2;
				const fileType = ['image/jpeg', 'image/png', 'image/jpg', 'image/svg'].includes(file.raw.type)

				if (!fileType) {
					this.$notify.error({
						title: 'Invalid File',
						message: 'Not a supported file type (JPEG, JPG, PNG, SVG)'
					})
					return
				}

				if (!fileSize) {
					this.$notify.error({
						title: 'Max Size',
						message: 'File size should not exceed 2MB'
					});
					return
				}

                this.businessForm.image_url = URL.createObjectURL(file.raw);
            },
            eidCertificateChange(file, fileList) {
                this.businessForm.eid_certificate = file.raw;
                this.businessForm.eid_file_name_attachment = file.name;
                this.businessForm.eid_attachment_url = URL.createObjectURL(file.raw);
                if(file.type != 'jpg' || file.type != 'jpeg' || file.type != 'png') {
                    this.list_type = '';
                }
                else {
                    this.list_type = 'picture';
                }
            },
            eidCertificateRemove(file, fileList){
                this.$confirm('This will permanently delete the file. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                    }).then(() => {
                       return this.businessForm.eid_delete = true;
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Delete canceled'
                        });
                        this.fileData();
                    });
            },
            handlePictureCardPreview(file, id) {
		        this.dialogImageUrl = file.url;
		        this.showImage = true;
                this.fileID = id;
		    },
		    closeImagePreview() {
		    	this.dialogImageUrl = null
		    	this.showImage = false
		    },
		    handleDownload(file) {
				window.open(file.url, "_blank");
			},
            handleExceed(file, fileList) {
            	this.$notify({
                    title: "File Limit Exceed",
                    message: 'The limit is 5, you cannot select files more than 5.',
                    type: "warning"
                })
            },
            handleChange(file, fileList) {
            	const fileSize = file.size / 1024 / 1024 < 2;
				const fileType = ['image/jpeg', 'image/png', 'image/jpg', 'image/svg'].includes(file.raw.type)

				if (!fileType) {
					fileList.pop()
					this.$notify.error({
						title: 'Invalid File',
						message: 'Not a supported file type (JPEG, JPG, PNG, SVG)'
					})
					return
				}

				if (!fileSize) {
					fileList.pop()
					this.$notify.error({
						title: 'Max Size',
						message: 'File size should not exceed 2MB'
					});
					return
				}

            	this.businessForm.files.push(file)
            },
            handleRemove(file) {
            	console.log('consolidate', file)
            	if (file.hasOwnProperty('id')) {
                    file.is_deleted = true
                } else {
                    let index = this.businessForm.files.findIndex(f => f.uid == file.uid)

                    if (index > -1) {
                        this.businessForm.files.splice(index, 1)
                    }
                }
            },
			getSnsList() {
				if (!this.business) return

				this.loadings.gettingSns = true

				let postData = {
					business_id: this.business.id
				}

				this.$API.BusinessSns.getSnsList(postData)
				.then(res => {
					if (Array.isArray(res.data)) {
						this.snsList = res.data
					}
				})
				.catch(err => {
					console.log(err)
				})
				.finally(_ => {
					this.loadings.gettingSns = false
				})
			},
            getBusKeywords() {
                if (!this.business) return
                this.loadings.gettingKeyword = true;
                this.$API.BusinessKeyword.getBusinessKeywords(this.business.id).then(res => {
                    this.loadings.gettingKeyword = false;
                    console.log('keywords');
                    console.log(res.data);
                    this.businessKeywords = res.data
                    this.dataArray = this.businessKeywords.map(bk => {return bk.name});
                    this.businessKeywordsValue = this.dataArray;
                });
            },
			createNewSns(formName) {
				this.$refs[formName].validate(valid => {
					if (valid) {
						this.loadings.snsSaveLoading = true

						let postData = cloneDeep(this.snsForm)

						this.$API.BusinessSns.createNewSns(postData)
						.then(res => {
							if (res.data.success) {
								this.snsList.push(res.data.data)

								this.closeSnsForm()

								return
							}

							this.$notify.error({
					          	title: 'Failed',
					          	message: 'Failed to add new social networking site for the business.'
					        })
						})
						.catch(err => {
							console.log(err)

					        this.$notify.error({
					          	title: 'Server Error',
					          	message: 'An error occured while adding new social networking site for the business. Please report this to your administrator.'
					        })
						})
						.finally(_ => {
							this.loadings.snsSaveLoading = false
						})
					}
				})
			},
			deleteSns(sns) {
				this.$confirm('This action will delete the social networking site. Continue?', 'Delete SNS', {
	                confirmButtonText: 'Delete',
	                cancelButtonText: 'Cancel',
	                type: 'error',
	                confirmButtonClass: 'el-button--danger'
	            })
	            .then(() => {
	            	this.loadings.gettingSns = true

					this.$API.BusinessSns.deleteSns(sns.id)
					.then(res => {
						if (res.data.success) {
							let index = this.snsList.findIndex(sl => sl.id == sns.id)

							if (index > -1) {
								this.snsList.splice(index, 1)
							}
						}
					})
					.catch(err => {
						this.$notify.error({
				          	title: 'Server Error',
				          	message: 'Error occured while deleting an SNS. Please contact your administrator.'
				        });
						console.log(err)
					})
					.finally(_ => {
						this.loadings.gettingSns = false
					})
	            })
			},
			closeSnsForm() {
				this.showSnsForm = false
				this.snsForm.sns_id = null
				this.snsForm.account_info = null
			},
			enableUpdating() {
				this.isUpdating = true
                this.updateButtonClick = false;
			},
			cancelUpdate() {
				this.isUpdating = false
                this.updateButtonClick = true;
				if (this.businessFormCopy) {
					this.businessForm = cloneDeep(this.businessFormCopy)
				}
				this.fileData();
			},
			initialize() {
				let business = cloneDeep(this.business)

				if (business && business.id) {
					this.businessForm = {
						id: business.id,
						business_category_id: business.business_category_id,
						industry_type_id: business.industry_type_id,
						legal_name: this.$sf.ucwords(business.legal_name),
						english_name: this.$sf.ucwords(business.english_name),
						date_established: business.date_established,
						status: business.status,
						website: business.website,
						email: business.email,
						employee_count_id: business.employee_count_id,
						rnd_staff_count_id: business.rnd_staff_count_id,
						eid: business.eid,
						eid_certificate: business.eid_certificate,
						eid_file_name_attachment: business.eid_file_name_attachment,
						corp_ssn: business.corp_ssn,
						about_us: business.about_us,
						eid_delete: false,
						created_at: business.created_at,
						phone: business.phone,
						fax: business.fax,
                        /*complex_type_id : business.complex_type_id,
                        complex_location_id : business.complex_location_id,*/
						image_url: business.image_url ? `/storage/${business.image_url}` : null,
						files: business.business_medias.map(med => {
	                        let exploded = med.media_url.split('/')

	                        return {
	                            name: exploded[exploded.length - 1],
	                            url: `/storage/${med.media_url}`,
	                            id: med.id,
	                            is_deleted: false
	                        }
	                    })
					}
				} else {
					this.businessForm = {
						id: null,
						industry_type_id: null,
						business_category_id: null,
						legal_name: null,
						english_name: null,
						date_established: null,
						status: null,
						website: null,
						email: null,
						employee_count_id: null,
						rnd_staff_count_id: null,
						eid: null,
						eid_certificate: null,
						eid_attachment_url: null,
						phone: null,
						fax: null,
						image_url: null,
						created_at: null,
						corp_ssn: null,
                        eid_delete: null,
						about_us: null,
						files: [],
                        /*complex_type_id: null,
                        complex_location_id: null,*/
                        eid_file_name_attachment: null
					}
				}

				this.businessFormCopy = cloneDeep(this.businessForm)

				this.snsForm.business_id = this.business ? this.business.id : null
				this.getSnsList()
                this.showBusinessProcesses();
                this.getBusKeywords();
			},
			industryTypeChanged() {
				this.businessForm.business_category_id = null
			},
			validatePhone(rule, value, callback) {
				let isnum = /^\d+$/.test(value)

				if (value && !isnum) {
					callback(new Error('This field only accepts numbers.'))
				}

				callback()
			},
            saveIEDCertificate() {
                this.file_data = this.$refs.uploadIEDCertificate.uploadFiles[0].raw;

                console.log('file data: '+this.file_data);

                // let formData = new FormData;
                // formData.append('eid_attachment', this.file_data);
                // formData.append('business_id', this.businessForm.id);

                // this.$API.BusinessList.eidAttachment(formData).then(res => {
                //     this.file_path = res.data.path_attachment
                // }).catch(error => {
                //     console.log(error);
                // });
            },

		},
		computed: {
			selectableBusinessCategories() {
				return this.pageData.businessCategories.filter(bc => bc.industry_type_id == this.businessForm.industry_type_id)
			},
			selectableSns() {
				return this.pageData.snsList.filter(sl => !this.snsList.some(s => sl.id == s.sns.id))
			}
		},
		watch: {
			business(val) {
				this.initialize()
                this.fileData();
				this.businessData = val
			}
		}
	}
</script>

<style lang="scss">
	.company-general-component {
		.avatar-uploader .el-upload {
			border: 1px dashed #d9d9d9;
			border-radius: 6px;
			cursor: pointer;
			position: relative;
			overflow: hidden;
			width: 100%;
			height: 150px;
			margin-top: 0px !important;
		}
		.avatar-uploader .el-upload:hover {
			border-color: #409EFF;
		}
		.avatar-uploader-icon {
			font-size: 24px;
			color: #8c939d;
			height: 10px;
			line-height: 150px;
			text-align: center;
		}
		.upload-text {
			font-size: 14px;
            margin: auto;
			font-weight: 600;
		}
		.avatar {

			height: 150px;
			display: block;
		}

		.avatar-uploader-2 .el-upload {
			border: 1px dashed #d9d9d9;
			border-radius: 6px;
			cursor: pointer;
			position: relative;
			overflow: hidden;
			height: 150px;
			margin-top: 0px !important;
		}

		.avatar-uploader-icon-2 {
			font-size: 36px;
			color: #8c939d;
			width: 100px;
			height: 100px;
			line-height: 150px;
			text-align: center;
		}

		.products-container {
			.el-card__body {
				display: flex;
				flex-wrap: wrap;
				width: 100%;
			}

			.product-item {
				border: 1px solid #ccc;
    			border-radius: 3px;
				margin-left: 5px;
				margin-bottom: 5px;
				padding: 0 10px;
				height: 30px;
    			line-height: 26px;
			}
		}

		.sns-label {
			border: 1px solid #C0C4CC;
		    width: 200px;
		    justify-content: center;
		    align-items: center;
		    display: flex;
		    height: 32px;
		    color: #fff;
		}

		.el-upload-list__item-actions {
			position: absolute;
		    width: 100%;
		    height: 100%;
		    left: 0;
		    top: 0;
		    cursor: default;
		    text-align: center;
		    color: #fff;
		    opacity: 0;
		    font-size: 20px;
		    background-color: rgba(0,0,0,.5);
		    transition: opacity .3s;
		    display: flex;
    		justify-content: center;
    		align-items: center;

		    &:hover {
		    	opacity: 1;
		    }

		    button {
		    	font-size: 20px;
		    }
		}
	}
    .el-upload-dragger-cert {
    width: 800px !important;
    height: 90px !important;
}
    .el-icon-upload-cert {
        font-size: 50px !important;
        line-height: 0  !important;
        margin: 20px 0 16px !important;
    }

    .eid-certificate-style  {
        .el-upload-dragger {
            height: 40px !important;
            width: 100%  !important;
        }
        .el-upload__text {
            margin-top: 10px;
            margin: 10px;
        }
    }

    .keywords_add{
        display: flex;

        span {
            margin-right: 10px;
        }
    }

</style>
