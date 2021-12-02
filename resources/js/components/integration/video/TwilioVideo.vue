<template>
    <div
        class="video_call"
        :class="inDialog ? 'in_dialog' + (meetingStatus.joined ? ' on_going' : '') : '' + (meetingStatus.joined ? ' on_going' : '')"
        v-loading="loadingToken || meetingStatus.status == 'Joining Room'">

        <el-row v-if="!isBrowserSupported">
			<el-col>
                <h3 class="full-width text-center">
                    {{ __('Oops... Browser not supported.') }}
                </h3>
                <p class="full-width text-center">
                    {{ __('This Browser is currently not supported for meetings. Stay tuned for updates!') }}
                </p>
			</el-col>
		</el-row>
        <el-row v-else>
            <el-col v-if="!meetingStatus.joined" :span="24">
                <twilio-local-track-selection
                    v-model="twLocalTracks"
                    ref="trackSelectionComp">
                </twilio-local-track-selection>

                <el-button
                type="primary"
                @click="joinRoom">
                    {{ __('Join') }}
                </el-button>

                <!-- <el-button
                type="primary"
                @click="checkIfRoomExists">
                    {{ __('Check Room') }}
                </el-button> -->
            </el-col>
            <el-col v-if="meetingStatus.joined">
                <twilio-media-container
                    :user="user"
                    :room="twConferenceRoom"
                    :participants="twParticipants"
                    @mute-audio="muteLocalAudio"
                    @disable-video="muteLocalVideo"
                    :pageData="pageData"
                    :chat-channel="chatChannel"
                    :messages="messages"
                    :channels="channels"
                    @leave-room="disconnectRoom">
                </twilio-media-container>
                <!-- <el-button @click="disconnectRoom">{{ __('Disconnect')}} </el-button> -->
            </el-col>
        </el-row>
    </div>
</template>

<script>

import twilioVideoCallHelper from '../../../mixins/twilioVideoCallHelper';
const { connect, createLocalTracks, createLocalVideoTrack, Video, createLocalAudioTrack, isSupported } = require('twilio-video');

export default {
    props: ['roomName', 'isVisible', 'inDialog', 'user', 'pageData' , 'channels', 'messages', 'chatChannel'],

    mixins: [twilioVideoCallHelper],

    data() {
        return {
            twActiveRoom: { name: this.roomName || null, token: null},
            loadingToken: false,
            //isBrowserSupported: true,//isSupported,
        }
    },

    watch : {
        roomName(newVal, oldVal) {
            if(newVal && (!oldVal || newVal != oldVal)) {
                console.log("watch room name", newVal)
                this.twActiveRoom.name = newVal
                this.getAuthToken()
            }
        },

        isVisible(newVal, oldVal) {
            if(newVal === true && oldVal === false) {
                this.twActiveRoom.name = this.roomName || null
                this.getAuthToken()
            }
        }
    },

    created() {
        this.getAuthToken()
    },

    methods: {
        formatRoomUsers() {
            if(this.roomName && this.roomName.includes('[user_id]:')) {
                let name = this.roomName.replaceAll('[user_id]:', '')

                if(name.includes('-')) {
                    name = name.split('-')

                    name = name.filter(li => Number(li) != Number(this.$userData.activeUserId))

                    return name
                }
            }

            return null
        },

        getAuthToken() {
            let users = this.formatRoomUsers()

            this.loadingToken = true
            axios.get('/video-call/get-token/'+(this.twActiveRoom.name || '') /*, {users: users || null} */)
            .then((result) => {
                let res = result.data
                if(res.token){
                    this.twActiveRoom.token = res.token
                }
                if(res.room_name) {
                    this.twActiveRoom.name = res.room_name
                }
            }).catch(err => {
                console.error('Error!', err)
            }).finally(() => {
                this.loadingToken = false
            })
        },
    }
}
</script>
