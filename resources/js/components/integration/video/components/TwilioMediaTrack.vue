<template>
    <div class="video_track_item">
		<div class="video_track" ref="tw-media-track"></div>
        <!-- <el-button @click="setPublication">Publish</el-button> -->
        <div class="participant">
            {{ name.first_name }} {{ name.last_name }}
        </div>
    </div>
</template>

<script>

import cloneDeep from 'lodash/cloneDeep'

export default {
    props: ['mediaTracks', 'sid', 'flipVideo', 'shareScreen', 'identity'],

    data() {
        return {
            localVideo: null,
            name: []
        }
    },

    created() {
        this.$EventDispatcher.listen("TW_PARTICIPANT_TRACK_UPDATED", data => {
            console.log("$EventDispatcher 'Listen' | TW_PARTICIPANT_TRACK_UPDATED | data", data, this.sid)

            if(this.sid == data || !this.sid) {
                this.setPublication()
            }
            
        });

        this.getParticipantName();
    },

    watch: {
        mediaTracks(newVal) {
            if(newVal) {
                console.log("watch mediatracks")
                this.setPublication()
            }
        },

        flipVideo(newVal) {
            if(newVal === true) {
                this.localVideo.style.transform = 'scale(-1, 1)';  
            } else {
                this.localVideo.style.transform = 'scale(1, 1)';  
            }
        },
    },

    mounted() {
        if(this.mediaTracks) {
            let vm = this
            setTimeout(() => {
                console.log("media track mounted", this.sid)
                this.setPublication()
            }, 300)
            
        }
    },

    methods: {
        setPublication(){

  			if(!this.mediaTracks || !this.$refs['tw-media-track']) {
                return false
            }

  			let vm = this
  			let mediaDisplay = this.$refs['tw-media-track']

  			mediaDisplay.innerHTML = ''
            
  			this.mediaTracks.forEach(track => {
	    		if(mediaDisplay && track){
	  				if(track){
                        if(track.value && track.value.trackSid) {
                            track = track.value
                        }

                        if(track.track) {
                            track = track.track
                        }

                        if(track.track) {
                            track = track.track
                        }

                        console.log("setPublication4", cloneDeep(track))

                        if(track && track.isEnabled && track.attach) {
                            let trackAttachment = track.attach()
                            console.log("track type", track.kind, track)

                            if(track.kind == 'video') {
                                this.localVideo = trackAttachment
                                if(this.flipVideo) {
                                    trackAttachment.style.transform = 'scale(-1, 1)';
                                }
                                if(this.shareScreen) {
                                    trackAttachment.mediaStreamTrack.onended = () => { shareScreen() };
                                }
                            }

                            
                            
                            mediaDisplay.appendChild(trackAttachment)
                        }
	  				}
	  				
	  			}
			});
  		},

        getParticipantName() {
			let id = this.identity
			id = id.slice(10);
			console.log('user id', id)
			this.$API.Utils.getParticipantName(id).then(response => {
				this.name = response.data
            });
			
		},
    }
}
</script>

<style lang="scss">
    .video_track {
        width: 100%;
    }
</style>