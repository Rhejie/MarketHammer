import axios from 'axios'
import cloneDeep from 'lodash/cloneDeep'
const { connect, createLocalTracks, createLocalVideoTrack, Video, createLocalAudioTrack, isSupported } = require('twilio-video');

export default {

    data() {
        return {
            twParticipantTracks: [],
            twLocalTracks: null,
            twConferenceRoom: null,
            twActiveRoom: null,
            twParticipants: [],
            isBrowserSupported: isSupported,
            meetingStatus: {
                created: false,
                joined: false,
                joinFailed: false,
                started: false,
                ended: false,
                status: null,
            },
        }
    },

    methods: {
        // will create room if room does not exist
        async checkIfRoomExists() {
            console.log("Video", Video)
            if (!this.twActiveRoom || !this.twActiveRoom.name) {
                return false
            }
            Video.rooms(this.twActiveRoom.name).fetch()
            .then(room => console.log(room.uniqueName));
        },
        
        async joinRoom() {
            //if (!this.twActiveRoom.token) this.twActiveRoom.token = await this.getAuth()

            let vm = this

            this.meetingStatus.status = 'Joining Room'
            this.meetingStatus.ended = false

            if(!this.twLocalTracks) {
                await this.createLocalMediaTracks()
            }

            let localTracks = this.twLocalTracks || await this.createLocalMediaTracks()

            await connect(this.twActiveRoom.token, {
                name: this.twActiveRoom.name,
                tracks: localTracks
                /*audio: true,
            video: { width: 640 } */
            }).then(room => {
                console.log(`Successfully joined a Room: `, room)

                console.log('participants', room.participants.size)

                if (!room.participants.size) {
                    console.log('new room')
                    this.$emit('created-room', this.twActiveRoom.name)
                }

                this.twConferenceRoom = room
                this.meetingStatus.status = 'Joined Room'
                this.meetingStatus.joined = true

                let temp = {
                    identity: room.localParticipant.identity,
                    participant: room.localParticipant,
                    sid: room.localParticipant.sid,
                    tracks: localTracks,
                    localParticipant: true
                }
                this.twParticipants = [temp]

                room.on('participantConnected', participant => {
                    console.log('participantConnected', participant)

                    let tempTracks = []
                    let tempParticipant = {
                        identity: participant.identity,
                        sid: participant.sid,
                        participant: participant
                    }

                    console.log("participantConnected")

                    vm.$EventDispatcher.fire("TW_CONNECTED_PARTICIPANT", participant);

                    participant.tracks.forEach(publication => {

                        if (publication.isSubscribed) {
                            const track = publication.track;
                            track['participant'] = participant

                            tempTracks.push(track)

                            vm.setMediaEventListeners(track)
                        }
                    });

                    tempParticipant['tracks'] = tempTracks
                    vm.twParticipants.push(tempParticipant)

                    participant.on('trackSubscribed', track => {
                        console.log("joined participant track subscribed")
                        vm.twParticipants.find(li => {
                            console.log("find tracks")
                            if (li.sid == participant.sid) {
                                li.tracks.push(track)

                                vm.$EventDispatcher.fire("TW_PARTICIPANT_TRACK_UPDATED", participant.sid);

                                return true
                            }
                        })

                        vm.setMediaEventListeners(track)

                        //document.getElementById('tw-remote-media-view').appendChild(track.attach());
                    });
                });

                room.on('disconnected', room => {
                    // Detach the local media elements
                    console.log('Disconnected from room', room)
                    room.localParticipant.tracks.forEach(publication => {
                        const attachedElements = publication.track.detach();

                        attachedElements.forEach(element => element.remove());
                    });

                    /* if (document.getElementById("activities_dialog")) {
                        document.getElementById("activities_dialog").classList.remove("started");
                    }

                    if (document.getElementsByClassName("intercom-lightweight-app")
                        && document.getElementsByClassName("intercom-lightweight-app")[0]) {
                        document.getElementsByClassName("intercom-lightweight-app")[0].style.display = "block";
                    } */

                    //vm.setEndedStatus()
                    //vm.showMessage('success', vm.t('You have left the room'))
                });

                room.on('participantDisconnected', participant => {
                    if (participant && participant.identity) {
                        //let disconnectMessage = this.t('%VAR% has disconnected')
                        //disconnectMessage = this.$sf.replaceString(disconnectMessage, '%VAR%', participant.identity)
                        //vm.showMessage('success', disconnectMessage)
                    }

                    console.log("participant disconnected", participant)

                    if (participant.sid && vm.twParticipants && vm.twParticipants.length) {
                        let participant_index = vm.twParticipants.findIndex(li => li.sid == participant.sid)
                        console.log("participant_index", participant_index)
                        if (participant_index >= 0) {
                            vm.twParticipants.splice(participant_index, 1)
                        }
                    }

                    //vm.$EventDispatcher.fire("TW_DISCONNECTED_PARTICIPANT", participant);

                    /*participant.tracks.forEach(publication => {
                        console.log('publication', publication.trackSid, publication)
                        console.log('fire TW_DISCONNECTED_TRACK')
                        vm.$EventDispatcher.fire("TW_DISCONNECTED_TRACK", publication.trackSid);

                        if(publication.track){
                            const attachedElements = publication.track.detach();
                        console.log('attachedElements', attachedElements)
                        attachedElements.forEach(element => element.remove());

                        let track = vm.twParticipantTracks.find(li => {
                            if(li.sid != publication.trackSid){
                                li['disconnected'] = true
                            }
                            return li.sid != publication.trackSid
                        })

                        console.log('disconnected track', track)
                        }
                    });*/
                });

                room.participants.forEach(participant => {
                    let tempTracks = []
                    let tempParticipant = {
                        identity: participant.identity,
                        sid: participant.sid,
                        participant: participant
                    }

                    participant.tracks.forEach(publication => {
                        if (publication.track) {
                            track['participant'] = participant
                            tempTracks.push(track)
                        }

                        publication.on('subscribed', (track) => {
                            console.log("existing participant track subscribed", track)
                            
                            vm.$EventDispatcher.fire("TW_PARTICIPANT_TRACK_UPDATED", participant.sid);

                            if (publication.isSubscribed) {

                                vm.setMediaEventListeners(track)
                            }

                            vm.setMediaEventListeners(track)

                            /*track.on('disabled', () => {
                                console.log('Twilio Integrator | subscribed disabled', track)
                                vm.$EventDispatcher.fire("TW_MEDIA_DISABLE_TRACK", track.id); 
                            })

                            track.on('enabled', () => {
                                console.log('Twilio Integrator | subscribed enabled', track)
                                vm.$EventDispatcher.fire("TW_MEDIA_ENABLE_TRACK", track.id); 
                            })*/
                        });

                        publication.on('unsubscribed', () => {
                            console.log('Twilio Integrator | Participant unsubscribed')
                            /* Hide the associated <video> element and show an avatar image. */
                        });
                    });

                    tempParticipant['tracks'] = tempTracks
                    vm.twParticipants.push(tempParticipant)

                    participant.on('trackSubscribed', track => {
                        track['participant'] = participant

                        vm.twParticipants.find(li => {
                            if (li.sid == participant.sid) {
                                li.tracks.push(track)

                                return true
                            }
                        })
                    });
                });

            }, error => {
                console.error(`Unable to connect to Room: ${error.message}`);
                this.meetingStatus.status = 'Failed to Join Room'
                this.meetingStatus.joinFailed = true
                this.meetingStatus.ended = true
                //this.showMessage('error', this.t('Unable to join room'))
                //this.showMessage('error', this.t(error.message))

                this.disconnectRoom()
            }).then(() => {
                if (this.disconnectUponConnection) {
                    this.disconnectRoom()
                }
                return this.twConferenceRoom
            });

            return this.twConferenceRoom
        },

        async createLocalMediaTracks() {
            let localTracks = await createLocalTracks({
                audio: true,
                video: { width: 640 }
            }).then(localTracks => {
                this.twLocalTracks = localTracks

                return localTracks
            }).catch((err) => {
                console.error('Error!', err)
                this.meetingStatus.status = 'Failed to Access Media Device'
                this.meetingStatus.joinFailed = true
                this.meetingStatus.ended = true
            })

            return localTracks
        },

        setMediaEventListeners(track) {
            let vm = this

            track.on('disabled', () => {
                console.log("track disabled", track)
                vm.$EventDispatcher.fire("TW_MEDIA_DISABLE_TRACK", track.id);
            })

            track.on('enabled', () => {
                console.log("track enabled", track)
                vm.$EventDispatcher.fire("TW_MEDIA_ENABLE_TRACK", track.id);
            })
        },

        disconnectRoom(completeRoom = true, callBack = null) {
            let vm = this

            if (this.twConferenceRoom) {
                this.twConferenceRoom.disconnect()

                this.twParticipants.forEach(participant => {
                    if (participant.tracks && participant.tracks.length) {
                        participant.tracks.forEach(track => {
                            try {
                                track.stop()
                                track.detach()
                            } catch (err) {
                                console.warn('Error!', err)
                            }
                        })
                    }
                })

                setTimeout(() => {
                    vm.twParticipants = []
                }, 300)

            }

            //this.setEndedStatus()
            this.$emit('room-disconnected')
            this.meetingStatus.joined = false
            this.meetingStatus.ended = true
            this.meetingStatus.started = false
            this.meetingStatus.status = 'Disconnected'

            if (this.resetRoom) {
                this.resetRoom()
            }

            if (callBack) {
                callBack()
            }

            /*if(completeRoom && this.twActiveRoom && this.twActiveRoom.name){
                Video.rooms(this.twActiveRoom.name)
            .update({status: 'completed'})
            .then(room => console.log(room.uniqueName));
            }*/
        },

        muteLocalAudio(mute = true) {
            let vm = this

            console.log('muteLocalAudio')

            if (mute) {
                this.twConferenceRoom.localParticipant.audioTracks.forEach(publication => {
                    publication.track.disable();
                    vm.$EventDispatcher.fire("TW_MEDIA_DISABLE_TRACK", publication.track.id);
                });
            } else {
                this.twConferenceRoom.localParticipant.audioTracks.forEach(publication => {
                    publication.track.enable();
                    vm.$EventDispatcher.fire("TW_MEDIA_ENABLE_TRACK", publication.track.id);
                });
            }
            
        },

        muteLocalVideo(disable = true) {
            let vm = this

            if (disable) {
                this.twConferenceRoom.localParticipant.videoTracks.forEach(publication => {
                    publication.track.disable();
                    vm.$EventDispatcher.fire("TW_MEDIA_DISABLE_TRACK", publication.track.id);
                });
            } else {
                this.twConferenceRoom.localParticipant.videoTracks.forEach(publication => {
                    publication.track.enable();
                    vm.$EventDispatcher.fire("TW_MEDIA_ENABLE_TRACK", publication.track.id);
                });
            }
        },
    }
}