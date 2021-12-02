import SDK from '@ringcentral/sdk'
import WebPhone from 'ringcentral-web-phone'
import axios from 'axios'
import cloneDeep from 'lodash/cloneDeep'
import debounce from 'lodash/debounce'
import swal from 'sweetalert2/dist/sweetalert2.all.min.js'
import Noty from 'noty'
import moment from "moment";

/*
    Following Examples from https://github.com/ringcentral/ringcentral-web-phone

    Notes: 
        *   SDK.post().then((response) {
                code here using <response> 
                <response> returns promise here
            })

            *	<response> returns a promise.. not the actual data
                you can use setTimeout but might not work properly when internet is slow

*/

export default {

    data() {
        let rcDefaultTrialDuration = 30

        return {
            rcDefaultTrialDuration: rcDefaultTrialDuration,
            loadingRingCentral: false,
            ringCentralCallInProgress: false,
            ringPlatform: null,
            ringLoginResponse: null,
            ringCredentials: {
                RECIPIENT: null,
                FROM: null,
            },
            rcCallDuration: {
                timer: null,
                remainingTime: null,
                remainingTimeDisplay: '',
                isTrial: false
            },
            ringWebphone: null,
            ringCallSession: null,
            ringCallStatus: {
                status: null,
                active: false,
                errors: null,
                recording: false,
                from: null,
                fromName: null,
                to: null,
                toName: null,
                callDuration: null,
                date: null,
                start: null,
                end: null,
                connected: false,
                logged: false,
            },
            integrationCallTimer: null,
            serviceUnavailable: false,
            ringcentralError: ''
        }
    },

    created() {
        let vm = this
        window.addEventListener('beforeunload', function (e) {
            vm.ringWebphoneEndCall()
            vm.ringCallStatus.end = moment()

            if (vm.ringCallStatus.active) {

                //vm.logRecentCall()
                setTimeout(() => { }, 300)
            }
        });
    },

    computed: {
        formattedElapsedCallTime() {
            const date = new Date(null);
            date.setSeconds(this.ringCallStatus.callDuration / 1000);
            const utc = date.toUTCString();
            return utc.substr(utc.indexOf(":") - 2, 8);
        }
    },

    methods: {
        async setupRingCentral(setupWebphone = true) {
            let vm = this
            let setReceipient = this.ringCredentials.RECIPIENT

            this.loadingRingCentral = true
            this.ringLoginResponse = null

            if (!(!!window.chrome
                || (!!window.chrome.webstore || !!window.chrome.runtime))) {
                this.serviceUnavailable = true
                this.loadingRingCentral = false

                //vm.showMessage('error', 'This Browser is currently not supported for meetings. Stay tuned for updates!', 3000)

                this.$notify({
                    title: "Error",
                    message: this.__('This Browser is currently not supported for meetings. Stay tuned for updates!'),
                    type: "error"
                });

                return false
            }

            this.ringCredentials = await this.getRingCentralCred()

            if (!this.ringCredentials) {
                this.serviceUnavailable = true
                this.loadingRingCentral = false

                return false
            } else if (setReceipient) {
                this.ringCredentials.RECIPIENT = setReceipient
            }

            if (this.$ringCentralAuthToken) {
                this.ringLoginResponse = await this.$ringCentralAuthToken
            } else {
                this.ringLoginResponse = await this.ringCentralGetAuth()
            }


            if (this.ringLoginResponse && setupWebphone) {
                await this.ringWebPhoneSetup(this.ringLoginResponse)

                if (this.ringCentralSettings && this.ringCentralSettings.accept_call) {
                    this.ringWebphoneSetupListener()
                }
            }

            this.loadingRingCentral = false
        },

        async getRingCentralCred() {
            let vm = this
            let credentials = null

            await axios.get('/video-call/get-ringcentral-config')
                .then(result => {
                    let res = result.data
                    
                    console.log("getRingCentralCred", credentials)

                    if (res.credentials) {
                        credentials = res.credentials
                    } else {

                        if (res.errors) {
                            if (res.errors.includes('access_denied')) {
                                //this.showMessage('error', this.t('Access Denied'))
                                this.$notify({
                                    title: "Error",
                                    message: this.__('Access Denied'),
                                    type: "error"
                                });

                                this.ringcentralError = this.__('Access Denied')
                                return false
                            }

                            if (res.errors.includes('trial_ended')) {
                                //this.showMessage('error', this.t('Trial Ended'))
                                this.$notify({
                                    title: "Error",
                                    message: this.__('Trial Ended'),
                                    type: "error"
                                });
                                this.ringcentralError = this.__('Trial Ended')
                                return false
                            }
                        }
                        
                        /* this.$notify({
                            title: "Error",
                            message: this.__('Unable to connect to RingCentral'),
                            type: "error"
                        }); */
                        //vm.showMessage('error', 'Unable to connect to RingCentral', 3000)
                    }
                }).catch(err => {
                    console.error('Error!', err)
                })

            console.log("getRingCentralCred", credentials)

            return credentials
        },

        async ringCentralGetAuth() {
            let vm = this

            this.loadingRingCentral = true

            var rcsdk = new SDK({
                server: this.ringCredentials.RINGCENTRAL_SERVER,
                clientId: this.ringCredentials.RINGCENTRAL_CLIENTID,
                clientSecret: this.ringCredentials.RINGCENTRAL_CLIENTSECRET
            });

            this.ringPlatform = rcsdk.platform();

            let credentials = await this.ringPlatform.login({
                username: this.ringCredentials.RINGCENTRAL_USERNAME,
                password: this.ringCredentials.RINGCENTRAL_PASSWORD,
                extension: this.ringCredentials.RINGCENTRAL_EXTENSION
            }).then(loginResponse => {
                return loginResponse.json()
            }).catch(err => {
                console.error('Error!', err)
                vm.$notify({
                    title: "Error",
                    message: vm.__('Unable to connect to RingCentral'),
                    type: "error"
                });
                //vm.showMessage('error', 'Unable to connect to RingCentral', 3000)
                return false
            })

            this.ringLoginResponse = credentials
            this.$ringCentralAuthToken = cloneDeep(credentials)

            return credentials
        },

        // RING CENTRAL WEBPHONE CALL
        async ringWebPhoneSetup(loginResponse) {
            let vm = this
            let webPhone = null
            var remoteVideoElement = document.getElementById('remoteVideo_rc_integ');
            var localVideoElement = document.getElementById('localVideo_rc_integ');

            let res = await this.ringWebphoneGetProvision()
            console.log("login response", res)
            if (res && loginResponse) {
                webPhone = await new WebPhone(res, {
                    appKey: this.ringCredentials.RINGCENTRAL_CLIENTID,
                    appName: this.ringCredentials.RING_APP_NAME,
                    appVersion: this.ringCredentials.RING_APP_VERSION,
                    uuid: loginResponse.endpoint_id,
                    logLevel: 1, // error 0, warn 1, log: 2, debug: 3
                    audioHelper: {
                        enabled: true, // enables audio feedback when web phone is ringing or making a call
                        incoming: '/audio/incoming.ogg',//'path-to-audio/incoming.ogg', // path to audio file for incoming call
                        outgoing: '/audio/outgoing.ogg'//'path-to-audio/outgoing.ogg' // path to aduotfile for outgoing call
                    },
                    media: {
                        remote: remoteVideoElement,
                        local: localVideoElement
                    },
                    //to enable QoS Analytics Feature
                    enableQos: true
                });

                this.ringWebphone = webPhone

                return webPhone
            } else {
                console.error('Error!', 'Invalid args')
                return false
            }
        },

        ringWebphoneSetupListener() {
            if (!this.ringWebphone) return false

            let vm = this

            this.ringWebphone.userAgent.on('invite', function (session) {
                vm.ringCallSession = session

                vm.ringCallStatus.from = session && session.rcHeaders && session.rcHeaders.from ? session.rcHeaders.from : null
                vm.ringCallStatus.fromName = session && session.rcHeaders && session.rcHeaders.nm ? session.rcHeaders.nm : null

                vm.$swal({
                    title: vm.__('Incomming Call'),
                    text: vm.__('Answer call?'),
                    imageUrl: vm.$root.baseUrl + vm.$swalAttachmentWhiteIcon,//'/images/attachment_icon_white.png',
                    showCancelButton: true,
                    confirmButtonText: vm.__('Accept'),
                    confirmButtonColor: '#4087C5',
                    focusConfirm: false,
                    focusCancel: false,
                    cancelButtonText: vm.__('Decline'),
                    reverseButtons: true,
                    background: '#ff3366',
                    width: '400px',
                    padding: 0
                }).then(_ => {
                    this.ringCallSession = session
                    session.accept().then((res) => {
                        vm.ringCallStatus.status = ['Progress']
                        vm.ringCallStatus.active = true
                        vm.ringCallStatus.date = moment()
                        vm.ringCallStatus.start = moment()

                        vm.ringSetCallSessionListeners()
                        vm.ringCallStatus.connected = true
                        vm.ringCallStatus.logged = false
                        vm.startCallTimer()
                    });
                }, (dismiss) => {
                    session.reject()

                    vm.ringCallStatus.status = ['Rejected']
                    vm.ringCallStatus.active = false
                    vm.ringCallStatus.date = moment()
                    vm.ringCallStatus.start = moment()
                    vm.ringCallStatus.end = moment()
                    vm.ringCallStatus.connected = false
                    vm.ringCallStatus.logged = false
                    vm.stopCallTimer()
                })
            });
        },

        startCallTimer() {
            if (this.integrationCallTimer) {
                return false
            }

            this.ringCallStatus.callDuration = 0

            this.integrationCallTimer = setInterval(() => {
                this.ringCallStatus.callDuration += 1000;
            }, 1000);
        },

        stopCallTimer() {
            clearInterval(this.integrationCallTimer);
            this.integrationCallTimer = null
            this.ringCallStatus.callDuration = cloneDeep(Number(this.ringCallStatus.callDuration))
        },

        async ringWebphoneGetProvision() {
            let vm = this
            let provision = await vm.ringPlatform.post(
                '/restapi/v1.0/client-info/sip-provision',
                { sipInfo: [{ transport: 'WSS' }] }
            ).then(res => {
                console.log("ringWebphoneGetProvision", res)
                return res.json()
            }).catch(err => {
                console.error('Error!', err)
            })

            return provision || null
        },

        ringSetCallSessionListeners() {
            if (!this.ringCallSession) {
                return false
            }

            let vm = this

            this.ringCallSession.on('accepted', function () {
                console.log('RingCentral Event: Accepted');
                vm.ringCallStatus.start = moment()
                vm.ringCallStatus.connected = true

                if (vm.ringCredentials.IS_TRIAL) {
                    vm.ringCentralStartTrialTimer(vm.ringCredentials.TRIAL_DURATION ? vm.ringCredentials.TRIAL_DURATION : vm.rcDefaultTrialDuration)
                }
            });
            this.ringCallSession.on('progress', function () {
                console.log('RingCentral Event: Progress');
                vm.ringCallStatus.status = ['Progress']
                vm.ringCallStatus.active = true
            });
            this.ringCallSession.on('rejected', function () {
                vm.ringCallStatus.connected = false
                console.log('RingCentral Event: Rejected');
                close();
            });
            this.ringCallSession.on('failed', function () {
                console.log('RingCentral Event: Failed', arguments, typeof arguments);
                vm.$emit('call-failed')
                vm.ringCallStatus.status = ['Failed']
                vm.ringCallStatus.active = false
                vm.ringCallStatus.errors = arguments
                vm.ringCallStatus.end = moment()

                if (arguments && arguments[1]) {
                    let validErrors = [
                        { error: 'Not Found', label: vm.__('Unable to connect to contact number') },
                        { error: 'SIP Failure Code', label: vm.__('Invalid contact number') },
                        { error: 'WebRTC Error', label: vm.__('Unable to connect to audio device') }
                    ]

                    let message = validErrors.find(li => li.error == arguments[1])

                    if (message) {
                        //vm.showMessage("error", message.label, 5000)
                        vm.$notify({
                            title: "Error",
                            message: vm.__(message.label),
                            type: "error"
                        });
                    }
                }
            });
            this.ringCallSession.on('terminated', function () {
                console.log('RingCentral Event: Terminated');
                vm.callEnded(vm.clearCallStatus())
            });
            this.ringCallSession.on('cancel', function () {
                console.log('RingCentral Event: Cancel');
                close();
            });
            this.ringCallSession.on('refer', function () {
                console.log('RingCentral Event: Refer');
            });
            this.ringCallSession.on('replaced', function (newSession) {
                console.log('RingCentral Event: Replaced: old session', vm.ringCallSession, 'has been replaced with', newSession);
                vm.ringCallSession = newSession
                vm.ringSetCallSessionListeners()
                close();
                onAccepted(newSession);
            });
            this.ringCallSession.on('dtmf', function () {
                console.log('RingCentral Event: DTMF');
            });
            this.ringCallSession.on('muted', function () {
                console.log('RingCentral Event: Muted');
            });
            this.ringCallSession.on('unmuted', function () {
                console.log('RingCentral Event: Unmuted');
            });
            this.ringCallSession.on('connecting', function () {
                console.log('RingCentral Event: Connecting');
            });
            this.ringCallSession.on('bye', function () {
                console.log('RingCentral Event: Bye');

                if (vm.ringCredentials.IS_TRIAL && !isNaN(vm.rcCallDuration.remainingTime)) {
                    vm.ringCredentials.TRIAL_DURATION = vm.rcCallDuration.remainingTime + 1

                    axios.post(vm.$root.baseUrl + '/conference/update-call-remaining-trial-time', { remaining_time: vm.rcCallDuration.remainingTime + 1 })
                        .then(result => {
                            console.log('Remaining trial time', result.data)
                        }).catch(err => {
                            console.error('Error!', err)
                        })
                }

                vm.callEnded(vm.clearCallStatus())

            });
        },

        callEnded: debounce((clearCallStatus) => {
            clearCallStatus
        }, 700),

        clearCallStatus() {
            this.ringCallStatus.status = ['Call Ended']

            if (this.ringCallStatus.active) {
                //this.showMessage("success", this.t('Call ended'))
                this.$notify({
                    title: "Error",
                    message: this.__('Call ended'),
                    type: "error"
                });
            }

            this.ringCallStatus.active = false
            this.ringCallStatus.end = moment()
            this.stopCallTimer()

            //this.logRecentCall()
        },

        async ringWebphoneStartCall(phoneNumber = null) {
            console.log('ringWebphoneStartCall1', phoneNumber)
            if (!phoneNumber || this.loadingRingCentral) return false

            let vm = this
            console.log('ringWebphoneStartCall2', phoneNumber)
            //try {
                console.log('ringWebphoneStartCall3', phoneNumber)
                this.ringCallSession = await this.ringWebphone.userAgent.invite(
                    phoneNumber,
                    {
                        fromNumber: this.ringCredentials.FROM //optional
                        /*, homeCountryId: '101'*/ //optional
                    } // Optional
                )
                console.log('ringWebphoneStartCall4', phoneNumber)

                this.ringSetCallSessionListeners()
                this.ringCallStatus.date = moment()
                this.ringCallStatus.savedRecords = null
                this.ringCallStatus.start = moment()
                this.ringCallStatus.connected = false
                this.ringCallStatus.logged = false
                this.ringCallStatus.status = ['Starting Call']
                this.startCallTimer()

                //this.logRecentCall()

                return this.ringCallSession

            /* } catch (err) {
                console.error('Error! RingCentral WebPhone', err)
            } */

            return null
        },

        ringCentralStartTrialTimer(duration = 30) { //set duration in seconds
            let vm = this
            let minutes = null, seconds = null;

            this.rcCallDuration.remainingTime = duration

            if (this.rcCallDuration.timer) {
                this.endRingCentralTrialTimer()
            }
            //let minutes = null, seconds = null;
            this.rcCallDuration.timer = setInterval(function () {
                minutes = parseInt(vm.rcCallDuration.remainingTime / 60, 10);
                seconds = parseInt(vm.rcCallDuration.remainingTime % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                //display.textContent 
                vm.rcCallDuration.remainingTimeDisplay = minutes + ":" + seconds;

                if (vm.rcCallDuration.remainingTime <= 60) {
                    vm.rcCallDuration.aboutToEnd = true
                } else {
                    vm.rcCallDuration.aboutToEnd = false
                }

                if (--vm.rcCallDuration.remainingTime < 0) {
                    vm.endRingCentralTrialTimer()

                    swal({
                        title: vm.__('Disconnected'),
                        text: vm.__('Your Trial has ended. You have been automatically disconnected.'),
                        imageUrl: vm.$swalAttachmentWhiteIcon,//'/images/attachment_icon_white.png',
                        //showCancelButton: true,
                        confirmButtonText: vm.__('Ok'),
                        confirmButtonColor: '#4087C5',
                        focusConfirm: false,
                        focusCancel: false,
                        //cancelButtonText: this.t('Cancel'),
                        reverseButtons: true,
                        background: '#ff3366',
                        width: '400px',
                        padding: 0
                    }).then(function () {
                        console.log('Ok')
                    }).catch(function (error) {
                        console.log(error)
                    })

                    vm.ringWebphoneEndCall()
                }
            }, 1000);
        },

        endRingCentralTrialTimer() {
            clearInterval(this.rcCallDuration.timer);
        },

        async ringWebphoneEndCall() {
            if (!this.ringCallSession) return false

            let res = await this.ringCallSession.terminate()

            if (this.rcCallDuration.remainingTime) {
                this.endRingCentralTrialTimer()
            }

            return res || null
        },

        async ringWebphoneDtmf(dtmf_digits) {
            if (!this.ringCallSession) return false

            let res = await this.ringCallSession.dtmf(dtmf_digits)

            return res || null
        },

        async ringWebphoneHoldCall() {
            if (!this.ringCallSession) return false

            try {
                let res = await this.ringCallSession.hold()

                if (!this.ringCallStatus.status.includes('On hold')) {
                    this.ringCallStatus.status.push('On hold')
                }

                return res || null

            } catch (error) {
                console.error('Error!', error)
            }

            return null
        },

        async ringWebphoneUnholdCall() {
            if (!this.ringCallSession) return false
            let res = await this.ringCallSession.unhold()

            this.ringCallStatus.status = this.ringCallStatus.status.filter(li => li != 'On hold')

            return res || null
        },

        async ringWebphoneMuteCall() {
            if (!this.ringCallSession) return false

            try {
                let res = await this.ringCallSession.mute()

                if (!this.ringCallStatus.status.includes('Mute')) {
                    this.ringCallStatus.status.push('Mute')
                }

                return res || null
            } catch (error) {
                console.error('Error!', error)
            }

            return null
        },

        async ringWebphoneUnmuteCall() {
            if (!this.ringCallSession) return false
            let res = await this.ringCallSession.unmute()

            this.ringCallStatus.status = this.ringCallStatus.status.filter(li => li != 'Mute')

            return res || null
        },

        async ringWebphoneRecordCall() {
            if (!this.ringCallSession) return false
            let vm = this

            if (!vm.ringCallStatus.status.includes('Recording')) {
                vm.ringCallStatus.status.push('Recording')
            }

            let res = await this.ringCallSession.startRecord()
                .then(function () {
                    console.log('RingCentral | Recording Call!')
                })
                .catch(function (e) {
                    vm.ringCallStatus.status = vm.ringCallStatus.status.filter(li => li != 'Recording')
                    //vm.showMessage('error', vm.t('Unable to record call'), 4500)
                    vm.$notify({
                        title: "Error",
                        message: vm.__('Unable to record call'),
                        type: "error"
                    });
                });

            return res || null
        },

        async ringWebphoneStopRecordCall() {
            if (!this.ringCallSession) return false
            let vm = this
            let res = await this.ringCallSession.stopRecord()
                .then(function () {
                    vm.ringCallStatus.status = vm.ringCallStatus.status.filter(li => li != 'Recording')
                })
                .catch(function (e) {
                    //vm.showMessage('error', vm.t('Unable to stop recording call', 4500))
                    vm.$notify({
                        title: "Error",
                        message: vm.__('Unable to stop recording call'),
                        type: "error"
                    });
                });

            return res || null
        },

        // END RING CENTRAL WEBPHONE CALL
    }
}