<template>
	<div 
		class="dump_shortcuts call_integration_container"
		:class="{ 'in_dialog' : inDialog }">
		<div v-if="serviceUnavailable">
			<!-- <empty-state
				:mainHeading="__('Something went wrong') + '. '"
				:subHeading="ringcentralError">
			</empty-state> -->
            <h3 class="full-width text-center">
                {{ __('Something went wrong') }}
            </h3>
            <p class="full-width text-center">
                {{ __(ringcentralError) }}
            </p>
		</div>

		<div v-else-if="ringCredentials.IS_TRIAL && ringCredentials.TRIAL_DURATION <= 0">
			<!-- <empty-state
				:mainHeading="__('Oops... Trial Ended.')"
				:subHeading="__('You have already consumed trial.')">
			</empty-state> -->
            <h3 class="full-width text-center">
                {{ __('Oops... Trial Ended.') }}
            </h3>
            <p class="full-width text-center">
                {{ __('You have already consumed trial.') }}
            </p>
		</div>

		<section class="call_integration_inner" v-else v-loading="loadingRingCentral">
			<div class="left" v-if="!ringCallStatus.active">
				<div class="caller_container">
					<label>{{ __('Call as') }}</label>
					<el-select 
						v-model="ringCredentials.FROM"
						class="wit_input_select full-width"
						filterable
						:disabled="ringCallStatus.active"
						default-first-option
						popper-append-to-body
						allow-create>
						<el-option v-for="(item, index) in  availableSourceNumbers"
							:value="item.value"
							:label="item.value"
							:key="index">
							<span>{{ item.label }}</span>
							<span class="minor">{{ item.value }}</span>
						</el-option>
					</el-select>
				</div>

				<div class="callee_container">
					<el-select 
						v-model="ringCredentials.RECIPIENT"
						class="wit_input_select"
						:placeholder="__('Enter a name or number')"
						:disabled="ringCallStatus.active"
						filterable
                        allow-create
						popper-append-to-body>
						<!-- default-first-option
						allow-create -->
						<el-option 
							v-for="(item, index) in  availableDestinationumbers"
							:value="item.value"
							:label="item.value"
							:key="index"
							:disabled="item.disabled">
							<span class="pull-left">{{ item.label }}</span>
							<span v-if="!item.disabled" class="pl-15 pull-right">{{ item.value }}</span>
							<el-tooltip 
								:content="__('Phone Number Format') + ':   + [ ' + __('Country Code') +' ] [ ' + __('Area Code')+ ' ] [ ' + __('Phone Number')+ ' ]'" 
								placement="top">
								<span class="pl-5 pull-right text_error" v-if="item.error">
									({{ __('Invalid format') }})
								</span>
							</el-tooltip>
						</el-option>
					</el-select>

					<div class="call_container">
						<el-button 
							v-if="!ringCallStatus.active"
							icon="fas fa-phone"
							:disabled="serviceUnavailable || loadingRingCentral"
							:title="(serviceUnavailable ? ringcentralError : '')"
							@click="callStart">
						</el-button>
					</div>
				</div>

				<call-dial-pad 
					v-model="dialPadDigits" 
					@change="dtmfDial" 
					@dial-complete="addContactNumber"
					:show-input-field="false">
				</call-dial-pad>
			</div>

			<div class="mid" v-if="ringCallStatus.active">
				<div class="header">
					<label :class="{ 'on_hold' : ringCallStatus.status.includes('On hold') }">
						{{ __('Ongoing Call') }}
						<template v-for="(item, index) in ringCallStatus.status">
							<template v-if="item != 'Progress'" class="item">
								(<span class="status_container" :key="index">{{ __(item) }}</span>)
							</template>
						</template>
					</label>

					<div class="image_container">
						<el-avatar
							:src="formattedActiveContact && formattedActiveContact.image_path ? formattedActiveContact.image_path : '../image/no-image-user.png'"
							:alt="__('contact img')">
							<img src="/image/no-image-user.png" :alt="__('alternative image')" />
						</el-avatar>
					</div>

					<h1>{{ ringCredentials.RECIPIENT }}</h1>

					<small style="color: #6F7070;" v-if="ringCallStatus.callDuration">{{ formattedElapsedCallTime }}</small>
				</div>

				<div class="body">
					<el-row :gutter='20' class="action_row">
						<el-col :span='8' align="center">
							<el-button 
								v-if="!ringCallStatus.status.includes('Mute')"
								class="action_btn_circle c_layout_v2"
								:disabled="loadingRingCentral"
								icon="fas fa-volume-up"
								@click="ringWebphoneMuteCall">
							</el-button>

							<el-button 
								v-if="ringCallStatus.status.includes('Mute')"
								class="action_btn_circle c_layout_v2 active"
								:disabled="loadingRingCentral"
								icon="fas fa-volume-mute"
								@click="ringWebphoneUnmuteCall">
							</el-button>
						</el-col>

						<el-col :span='8' align="center">
							<el-button 
								v-if="!ringCallStatus.status.includes('On hold')"
								class="action_btn_circle c_layout_v2"
								icon="fas fa-pause"
								:disabled="loadingRingCentral"
								@click="ringWebphoneHoldCall">
							</el-button>

							<el-button 
								v-if="ringCallStatus.status.includes('On hold')"
								class="action_btn_circle c_layout_v2 active"
								icon="fas fa-play"
								:disabled="loadingRingCentral"
								@click="ringWebphoneUnholdCall">
							</el-button>
						</el-col>

						<el-col :span='8' align="center">
							<el-button 
								v-if="!ringCallStatus.status.includes('Recording')"
								class="action_btn_circle c_layout_v2"
								:disabled="loadingRingCentral"
								icon="fas fa-record-vinyl"
								@click="ringWebphoneRecordCall">
							</el-button>

							<el-button 
								v-if="ringCallStatus.status.includes('Recording')"
								class="action_btn_circle c_layout_v2 active"
								icon="fas fa-stop"
								:disabled="loadingRingCentral"
								@click="ringWebphoneStopRecordCall">
							</el-button>
						</el-col>
					</el-row>

					<el-row :gutter='20' class="action_row">
						<el-col :span='8' align="center">
							<el-button 
								@click="isKeypadVisible = true"
								:class="{ 'active' : isKeypadVisible }"
								class="action_btn_circle c_layout_v2"
								:disabled="loadingRingCentral">
								123
							</el-button>
						</el-col>

						<!-- <el-col :span='8' align="center">
							<el-button 
								class="action_btn_circle c_layout_v2"
								:disabled="loadingRingCentral"
								:class="{ 'active' : isNotesVisible }"
								@click="isNotesVisible ? isNotesVisible = false : isNotesVisible = true"
								icon="fas fa-edit">
							</el-button>
						</el-col> -->
					</el-row>

					<el-row :gutter='20' class="action_row">
						<el-col :span='24' align="center">
							<el-button 
								v-if="ringCallStatus.active"
								class="action_btn_circle salmon-red c_layout_v3"
								icon="fas fa-phone-slash"
								@click="callEnd">
							</el-button>
						</el-col>
					</el-row>
				</div>

				<call-dial-pad
					class="floating"
					:class="{ 'deactivated' : !isKeypadVisible }"
					v-model="dialPadDigits" 
					@change="dtmfDial" 
					@dial-complete="addContactNumber"
					:show-input-field="false">

					<div class="action_container" @click="isKeypadVisible = false" slot="action">
						<i class="el-icon-close"></i>
					</div>
				</call-dial-pad>
			</div>
		</section>

		<!-- 
			Do Not Remove ↓↓↓↓↓
			Used for audio output  ↓↓↓↓

			Sa tinood lang wala pud ko kabalo ngano video ang gamit na element
			mao man sa example mao na video nalang pud akong gi gamit 
		 -->
		<video id="remoteVideo_rc_integ" hidden="true"></video>
		<video id="localVideo_rc_integ" hidden="true" muted="muted"></video>
		<!-- 
			END Do Not Remove
		 -->
	</div>
</template>

<script>
import ringCentralIntegrator from '../../../mixins/ringCentralHelper'
import WebPhone from 'ringcentral-web-phone'
import SDK from '@ringcentral/sdk'
import axios from 'axios'

export default {
  	props : ['selectedUsers', 'users', 'inDialog'],

  	mixins: [ringCentralIntegrator],

  	data () {
    	return {
			isKeypadVisible: false,
			isNotesVisible: false,
    		companyDetails: null,
    		loading: false,
    		form: {
    			notes: null,
    		},
    		customContentToolbar: [
				[{ 'font': [] }],
				['bold', 'italic', 'underline', 'strike'],
				//[{ 'header': [false, 1, 2, 3, 4, 5, 6, ] }],
				[{ 'size': ['small', false, 'large', 'huge'] }],
				[{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
				//[{ 'header': 1 }, { 'header': 2 }],
				//['blockquote', 'code-block'],
				[{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
				//[{ 'script': 'sub'}, { 'script': 'super' }],
				[{ 'indent': '-1'}, { 'indent': '+1' }],
				[{ 'color': [] }, { 'background': [] }],
				['link', /*'image', 'video', */'formula'],
				[{ 'direction': 'rtl' }],
				//['clean'],
		    ],
		    dialPadDigits: null,
		    loggedUserDetails: null,
		    activeCallsTab: 'notes',
		    ringCentralSettings: {
		    	accept_call: false,
		    },
		    savingCallNotes: false,
            ringCredentials: {
                RECIPIENT: null,
                FROM: null,
            },
    	}
  	},

  	created(){
  		let vm = this

  		this.setupRingCentral()

  		this.$EventDispatcher.listen('TERMINATE_INTEGRATION_EVENTS', data => {
  			if(vm.ringCallStatus.active){
  				vm.callEnd()
  			}
  		})
  	},

  	watch:{
  		activeContact(){
  			this.ringCredentials.RECIPIENT = this.activeContact.mobile_no || this.activeContact.tel_no || this.activeContact.mobile_phone || this.activeContact.phone || this.activeContact.phone2 || ''
  			this.form.notes = null
  		},

  		'ringCallStatus.active':function(newVal){
  			if(!newVal){
  				this.activeCallsTab = this.enableNotes ? 'notes' : 'dial'
  			}

  			if(newVal){
  				this.activeCallsTab = this.enableNotes ? 'notes' : 'dial'
  			}
  		}
  	},

  	computed: {
  		formattedActiveContact(){
  			let selectedNumber = this.availableDestinationumbers && this.availableDestinationumbers.find(li => li.value == this.ringCredentials.RECIPIENT) || null
			let selectedUser = selectedNumber && this.users && this.users.find(li => Number(li.id) == Number(selectedNumber && selectedNumber.user_id || null))

			console.log('formattedActiveContact', selectedUser, selectedNumber)

  			if(!selectedNumber || !selectedUser) return null

			return selectedUser
  			if(contact.displayName) {
  				contact.displayName = contact.fullName || (contact.first_name + ' ' + contact.last_name)
  			}

  			if(!contact.image_path) {
  				contact.image_path = contact.user && contact.user.image_path ? contact.user.image_path : null
  			}

  			return contact
  		},

  		availableDestinationumbers(){
  			let list = []

  			if(this.selectedUsers && this.selectedUsers.length){
				this.selectedUsers.forEach((li, index) => {
					let data = {
						label: (li.first_name || '') + ' ' + (li.last_name || ''),
						value : li.phone || index,
						disabled : li.phone && li.phone != '' ? false : true,
						user_id : li.id
					}

					list.push(data)
				})
  			}

			return list
  		},

  		availableSourceNumbers(){
  			let list = []
  			if(this.ringCredentials && this.ringCredentials.RINGCENTRAL_USERNAME){
  				list.push({label: this.__('RingCentral'), value: this.ringCredentials.RINGCENTRAL_USERNAME })
  			}

  			if(this.companyDetails && this.companyDetails.phone){
  				list.push({label: this.__('Company Phone'), value: this.companyDetails.phone})
  			}

  			if(this.loggedUserDetails){
  				if(this.loggedUserDetails.mobile_phone){
  					list.push({label: this.__('Employee Mobile Number'), value: this.loggedUserDetails.mobile_phone})
  				}


	  			if(this.loggedUserDetails.contact){
	  				if(this.loggedUserDetails.contact.tel_no){
	  					list.push({label: this.__('Contact Phone Number'), value: this.$sf.formatPhoneNumber(this.loggedUserDetails.contact.tel_no)})
	  				}
	  				if(this.loggedUserDetails.contact.mobile_no){
	  					list.push({label: this.__('Contact Mobile Number'), value: this.$sf.formatPhoneNumber(this.loggedUserDetails.contact.mobile_no) })
	  				}
	  			}
	  		}

			return list
  		}
  	},

  	methods : {
  		/* getCompanyDetails(){
  			let vm = this
  			this.loading = true

  			axios.get( vm.$root.baseUrl+'/settings/get-company-data?includeUserData=1', )
  			.then(result =>{
  				let res = result.data
  				vm.companyDetails = res.company_details || null
  				vm.loggedUserDetails = res.employee_details || null
  			}).catch(err => {
  				console.error("Error!", err)
  			}).then(() => {
  				this.loading = false
  			})
  			
  		}, */

  		callStart(){
  			if(this.ringCredentials.RECIPIENT == '' || !this.ringCredentials.RECIPIENT){
  				//this.showMessage('error', this.t('Please input a contact number'))
                this.$notify({
                    title: "Error",
                    message: this.__('Please input a contact number'),
                    type: "error"
                });
  				return false
  			}

  			if(this.ringCredentials.RECIPIENT.length < 4) {
                this.$notify({
                    title: "Error",
                    message: this.__('Invalid contact number'),
                    type: "error"
                });
  				//this.showMessage('error', this.t('Invalid contact number'))
  				return false
  			}

  			this.dialPadDigits = null

  			this.ringWebphoneStartCall(this.$sf.formatPhoneNumberForCalls(this.ringCredentials.RECIPIENT))
  		},

  		callEnd(){
  			this.$emit('call-end')
  			this.ringWebphoneEndCall()
  		},

  		addContactNumber(number = null){
  			if(number){
  				this.ringCredentials.RECIPIENT = number
  			}
  		},

  		dtmfDial(){
  			if(this.dialPadDigits && this.dialPadDigits != '' && this.ringCallStatus.active){
  				this.ringWebphoneDtmf(this.dialPadDigits)
  				this.dialPadDigits = ''
  			}
  		},
  	}
}
</script>

