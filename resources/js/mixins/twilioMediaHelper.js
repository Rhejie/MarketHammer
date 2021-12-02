export default {
    data() {
        return {
            videoInputList: null,
            audioInputList: null,
            selectedVideoInput: null,
            selectedAudioInput: null,
        }
    },

    methods: {
        setupLocalMediaTracks(callBack = null) {
            navigator.mediaDevices.enumerateDevices().then(devices => {
                console.log("setupLocalMediaTracks", devices)

                if (devices && devices.length) {
                    let videoInputs = devices.filter(device => device.kind === 'videoinput')
                    let audioInputs = devices.filter(device => device.kind === 'audioinput')
                    let defaultVideo = videoInputs.find(li => li.deviceId == 'default') || videoInputs[0]
                    let defaultAudio = audioInputs.find(li => li.deviceId == 'default') || audioInputs[0]

                    this.videoInputList = videoInputs// && videoInputs.length && videoInputs.map(li => li.InputDeviceInfo)
                    this.audioInputList = audioInputs

                    this.selectedVideoInput = defaultVideo && defaultVideo.deviceId || null
                    this.selectedAudioInput = defaultAudio && defaultAudio.deviceId || null

                    if (this.selectedVideoInput && this.selectedAudioInput) {
                        if (callBack) {
                            callBack()
                        }
                        //this.createLocalMediaTracks()
                    }
                } else {
                    this.meetingStatus.status = 'Failed to Access Media Device'
                }
            })
        },
    }
}