<template>
    <div class="media-container">
        <div class="body">
            <el-col :span="showMessage ? 18 : showScreen ? 10 : 24">
                <!---->
                <el-row class="tbl_view" :gutter="20">
                    <template v-for="participant in participants">
                        <el-col
                            class="tbl_cell"
                            :key="
                                'participant_track_' +
                                    participant.sid +
                                    (participant.localParticipant
                                        ? tracksUpdatedCount
                                        : '')
                            "
                            :span="getColumnSize"
                            :xs="getSmColumnSize"
                        >
                            <twilio-media-track
                                :class="
                                    participant.localParticipant ? 'is_me' : ''
                                "
                                :media-tracks="
                                    (participant &&
                                        participant.participant &&
                                        participant.participant.tracks) ||
                                        participant.tracks
                                "
                                :sid="participant.sid"
                                :flip-video="
                                    participant.localParticipant
                                        ? flipVideo
                                        : false
                                "
                                :identity="participant.identity"
                                :share-screen="
                                    participant.localParticipant
                                        ? shareScreen
                                        : false
                                "
                            >
                            </twilio-media-track>
                            <!--button @click="getParticipantName(participant.identity)"> show name </button-->
                            <!--div class="participant">
                                {{ name.first_name }} {{ participant.sid }}
                            </div-->
                        </el-col>
                    </template>
                </el-row>
            </el-col>
            <transition name="fade">
                <el-col :span="6" v-if="showMessage">
                    <embeb-chat
                        :chat-channel="chatChannel"
                        :messages="messages"
                        :channels="channels"
                        :users="pageData.users"
                        @send-message="sendNewMessage"
                        :user="user"
                    >
                    </embeb-chat>
                </el-col>

                <el-col :span="10" v-if="showScreen"> </el-col>
            </transition>
        </div>

        <div class="foot">
            <el-row :gutter="20">
                <!-- <el-col :span='8'>
					<span></span>
				</el-col> -->
                <el-col :span="24" align="center">
                    <div class="actions_container">
                        <el-popover placement="top" width="400" trigger="hover">
                            <div class="el-scrollbar">
                                <div
                                    class="el-select-dropdown__wrap el-scrollbar__wrap"
                                    style="margin-bottom: -7px; margin-right: -7px;"
                                >
                                    <ul
                                        class="el-scrollbar__view el-select-dropdown__list"
                                    >
                                        <!-- selected -->
                                        <li
                                            v-for="item in audioInputList"
                                            :key="'mic_device_' + item.deviceId"
                                            @click="
                                                changeAudioTrack(item.deviceId)
                                            "
                                            class="el-select-dropdown__item"
                                            :class="
                                                activeLocalAudioTrack ==
                                                item.label
                                                    ? 'selected'
                                                    : ''
                                            "
                                        >
                                            <span>{{ item.label }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <el-button
                                slot="reference"
                                class="action_btn secondary_v1 c_layout_v4"
                                :class="{ inactive: isMuted }"
                                @click="toggleMicrophone"
                                :icon="
                                    isMuted
                                        ? 'fas fa-microphone-slash'
                                        : 'fas fa-microphone'
                                "
                            >
                            </el-button>
                        </el-popover>

                        <el-popover placement="top" width="400" trigger="hover">
                            <div
                                class="el-select-dropdown__wrap el-scrollbar__wrap"
                                style="margin-bottom: -7px; margin-right: -7px;"
                            >
                                <ul
                                    class="el-scrollbar__view el-select-dropdown__list"
                                >
                                    <li
                                        v-for="item in videoInputList"
                                        :key="'vid_device_' + item.deviceId"
                                        @click="changeVideoTrack(item.deviceId)"
                                        class="el-select-dropdown__item"
                                        :class="
                                            activeLocalVideoTrack == item.label
                                                ? 'selected'
                                                : ''
                                        "
                                    >
                                        <span>{{ item.label }}</span>
                                    </li>
                                </ul>
                            </div>

                            <el-button
                                slot="reference"
                                class="action_btn secondary_v1 c_layout_v4"
                                :class="{ inactive: isCameraDisabled }"
                                @click="toggleCamera"
                                :icon="
                                    isCameraDisabled
                                        ? 'fas fa-video-slash'
                                        : 'fas fa-video'
                                "
                            >
                            </el-button>
                        </el-popover>

                        <el-button
                            slot="reference"
                            class="action_btn secondary_v1 c_layout_v4"
                            @click="embedScreen"
                            icon="fas fa-share-square"
                        >
                        </el-button>
                        <!--@click="shareScreen = !shareScreen"-->

                        <el-button
                            slot="reference"
                            class="action_btn secondary_v1 c_layout_v4"
                            @click="flipVideo = !flipVideo"
                            icon="fas fa-redo"
                        >
                        </el-button>

                        <el-button
                            @click="leaveRoom"
                            class="action_btn c_layout_v5"
                            type="danger"
                            icon="fas fa-phone"
                        >
                        </el-button>

                        <el-button
                            @click="embebChat"
                            class="action_btn c_layout_v5"
                            type="primary"
                            icon="fas fa-comment-dots"
                        >
                        </el-button>
                    </div>
                </el-col>
            </el-row>
        </div>
    </div>
</template>

<script>
import twilioMediaHelper from "../../../../mixins/twilioMediaHelper";
import cloneDeep from "lodash/cloneDeep";
const {
    connect,
    createLocalTracks,
    createLocalVideoTrack,
    screenTrack,
    Video,
    createLocalAudioTrack,
    isSupported
} = require("twilio-video");
import twilioChatHelper from "../../../../mixins/twilioChatHelper";

import debounce from "lodash/debounce";
import EmbebChat from "../../../buyer/components/chat/EmbebChat.vue";
import TwilioVideo from "twilio-video";
import { LocalVideoTrack } from "twilio-video";

export default {
    components: { EmbebChat },
    props: [
        "room",
        "participants",
        "user",
        "messages",
        "chatChannel",
        "pageData"
    ],

    mixins: [twilioMediaHelper, twilioChatHelper],

    data() {
        return {
            updatedCount: 0,
            tracksUpdatedCount: 0,
            flipVideo: false,
            showMessage: false,
            messageList:
                (this.messages && this.messages.length && this.messages) ||
                null,
            fileList: null,
            isImageOnly: false,
            shareScreen: false,
            showScreen: false,
			name: [],
        };
    },

    computed: {
		//get participants name
		/**/
        getColumnSize() {
            console.log("want name of participant", this.participants[0].identity);
            let size = 24;
            let count = (this.participants && this.participants.length) || 1;

            if (count) {
                if (count > 5) {
                    size = size / 4;
                } else if (count == 5) {
                    size = 6;
                } else if (count == 4) {
                    size = 12;
                } else if (count <= 3) {
                    size = size / count;
                }
            }

            if (size < 1) {
                size = 4;
            }

            if (size > 24) {
                size = 24;
            }

            return size;
        },

        getSmColumnSize() {
            let size = 24;
            let count = (this.participants && this.participants.length) || 1;

            if (count > 1) {
                size = 12;
            }

            return size;
        },

        isAlone() {
            let list =
                this.participants && this.participants.length
                    ? cloneDeep(this.participants)
                    : [];

            if (list.find(li => !li.localTrack)) {
                return false;
            } else if (list.find(li => li.localTrack)) {
                return true;
            }

            return false;
        },

        localParticipant() {
            return (this.room && this.room.localParticipant) || null;
        },

        activeLocalAudioTrack() {
            let trackLabel = null;

            if (!this.room || !this.room.localParticipant) {
                return trackLabel;
            }

            this.updatedCount;

            console.log("activeLocalAudioTrack", this.updatedCount);

            this.room.localParticipant.audioTracks.forEach(publication => {
                if (
                    publication.track &&
                    publication.track.mediaStreamTrack &&
                    publication.track.mediaStreamTrack.label
                ) {
                    trackLabel = publication.track.mediaStreamTrack.label;
                }
                console.log("publications mic", publication);
            });

            return trackLabel;
        },

        activeLocalVideoTrack() {
            let trackLabel = null;

            if (!this.room || !this.room.localParticipant) {
                return trackLabel;
            }

            this.updatedCount;

            console.log("activeLocalVideoTrack", this.updatedCount);

            this.room.localParticipant.videoTracks.forEach(publication => {
                if (
                    publication.track &&
                    publication.track.mediaStreamTrack &&
                    publication.track.mediaStreamTrack.label
                ) {
                    trackLabel = publication.track.mediaStreamTrack.label;
                }
            });

            return trackLabel;
        },

        isMuted() {
            let muted = false;
            this.updatedCount;
            if (this.localParticipant && this.localParticipant.audioTracks) {
                this.localParticipant.audioTracks.forEach(li => {
                    if (!li.isTrackEnabled) {
                        muted = true;
                    }
                });
            }

            return muted ? true : false;
        },

        isCameraDisabled() {
            let muted = false;
            this.updatedCount;

            if (this.localParticipant && this.localParticipant.videoTracks) {
                this.localParticipant.videoTracks.forEach(li => {
                    if (!li.isTrackEnabled) {
                        muted = true;
                    }
                });
            }

            return muted ? true : false;
        },
    },

    created() {
        let vm = this;

        this.$EventDispatcher.listen("TW_MEDIA_DISABLE_TRACK", trackid => {
            vm.updatedCount++;
        });

        this.$EventDispatcher.listen("TW_MEDIA_ENABLE_TRACK", trackid => {
            vm.updatedCount++;
        });

		//this.getParticipantName();
		this.getUser();
    },

    mounted() {
        this.setupLocalMediaTracks();
    },

    methods: {
        sendNewMessage: debounce(function(text, files) {
            if (
                (text &&
                    text != "" &&
                    text != "\n" &&
                    text != "\\n" &&
                    text != "\n\n") ||
                files
            ) {
                this.addMessage(text, files);
                // this.$emit('addNewMessageFromVideoCAll', text, files);
            }
        }, 50),
        getUser() {
            $http.get("api/user").then(response => {
                console.log('getUser', response.body);
            });
        },
		/*getParticipantName(id) {
			//let id = this.participants[0].identity
			id = id.slice(10);
			console.log('user id', id)
			this.$API.Utils.getParticipantName(id).then(response => {
				this.name = response.data
            });
			
		},*/
        toggleMicrophone() {
            let vm = this;
            this.$emit("mute-audio", !this.isMuted);
            setTimeout(() => {
                vm.updatedCount++;
            }, 500);
        },

        toggleCamera() {
            let vm = this;
            this.$emit("disable-video", !this.isCameraDisabled);
            setTimeout(() => {
                vm.updatedCount++;
            }, 700);
        },

        leaveRoom() {
            this.$emit("leave-room", true);
        },

        async changeVideoTrack(id) {
            if (!id) return false;

            let vm = this;
            this.selectedVideoInput = id;

            //return

            await createLocalVideoTrack({
                deviceId: { exact: id }
            })
                .then(localVideoTracks => {
                    let oldTracks = Array.from(
                        vm.localParticipant.videoTracks.values()
                    );

                    if (oldTracks && oldTracks.length) {
                        oldTracks.forEach(publication => {
                            publication.track.stop();
                            publication.unpublish();
                        });
                    }

                    vm.localParticipant
                        .publishTrack(localVideoTracks)
                        .then(res => {
                            vm.tracksUpdatedCount++;
                        });

                    setTimeout(() => {
                        vm.updatedCount++;
                    }, 700);
                })
                .catch(err => {
                    console.error("Error!", err);
                    this.loading = false;
                });
        },

        async changeAudioTrack(id) {
            if (!id) return false;

            let vm = this;
            this.selectedAudioInput = id;

            await createLocalAudioTrack({
                deviceId: { exact: id }
            })
                .then(localAudioTracks => {
                    let oldTracks = Array.from(
                        vm.localParticipant.audioTracks.values()
                    );

                    if (oldTracks && oldTracks.length) {
                        oldTracks.forEach(publication => {
                            publication.track.stop();
                            publication.unpublish();
                        });
                    }

                    vm.localParticipant
                        .publishTrack(localAudioTracks)
                        .then(res => {
                            vm.tracksUpdatedCount++;
                        });

                    setTimeout(() => {
                        vm.updatedCount++;
                    }, 700);
                })
                .catch(err => {
                    console.error("Error!", err);
                    this.loading = false;
                });
        },
        embebChat() {
            this.showMessage = !this.showMessage;
        },

        async embedScreen() {
            console.log("before", this.showScreen);
            event.preventDefault();
            let vm = this;
            let oldTracks = Array.from(
                vm.localParticipant.videoTracks.values()
            );

            try {
                if (!this.showScreen) {
                    const stream = await navigator.mediaDevices.getDisplayMedia(
                        {
                            video: true
                        }
                    );
                    const newScreenTrack = stream.getTracks()[0];
                    if (oldTracks && oldTracks.length) {
                        oldTracks.forEach(publication => {
                            publication.track.stop();
                            publication.unpublish();
                        });
                    }
                    vm.localParticipant
                        .publishTrack(newScreenTrack)
                        .then(res => {
                            vm.tracksUpdatedCount++;
                        });

                    setTimeout(() => {
                        vm.updatedCount++;
                    }, 700);
                    this.showScreen = new TwilioVideo.LocalVideoTrack(
                        newScreenTrack
                    );
                    // await this.room.localParticipant.publishTrack(this.showScreen);
                    this.showScreen.mediaSteamTrack.onended = () => {
                        this.embedScreen();
                    };
                    // this.$emit('share-screen', this.showScreen);
                } else {
                    this.room.localParticipant.unpublishTrack(this.showScreen);
                    this.showScreen.stop();
                    this.showScreen = false;
                }
            } catch (err) {
                this.showScreen = false;
            }
        }
    }
};
</script>
