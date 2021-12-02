<template>
    <div v-loading="loading">
        <el-form>
            <el-row>
                <el-col>
                    <twilio-media-track
                        :media-tracks="localTracks">
                    </twilio-media-track>
                </el-col>
            </el-row>

            <el-row>
                <el-col>
                    <el-form-item :label="__('Video Devices')">
                        <el-select
                            class="full-width"
                            @change="createLocalMediaTracks"
                            v-model="selectedVideoInput">
                                <template v-for="(item, index) in videoInputList">
                                    <el-option
                                        v-if="item"
                                        :key="'audio_input_'+item.deviceId"
                                        :label="item.label"
                                        :value="item.deviceId">
                                    </el-option>
                                </template>
                                
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col>
                    <el-button @click="getMicAudioLevel">
                        <i :class="showAudioLevels ? 'fas fa-microphone' : 'fas fa-microphone-slash '"></i>
                        <!-- 'fas fa-volume-mute' -->
                    </el-button>
                    <div style="position: absolute; display: inline-block; margin-left: 10px; margin-top: 5px;">
                        <canvas 
                        id="audioCanvas" 
                        width="200px" height="20px" 
                        style="border:1px solid #c3c3c3; border-radius: 4px;"
                        ref="audioCanvas"/>
                    </div>
                </el-col>
            </el-row>

            <el-row>
                <el-col>
                    <el-form-item :label="__('Audio Devices')">
                        <el-select
                            class="full-width"
                            @change="createLocalMediaTracks"
                            v-model="selectedAudioInput">
                                <template v-for="(item, index) in audioInputList">
                                    <el-option
                                        v-if="item"
                                        :key="'audio_input_'+item.deviceId"
                                        :label="item.label"
                                        :value="item.deviceId">
                                    </el-option>
                                </template>
                                
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
    </div>
</template>

<script>

import cloneDeep from 'lodash/cloneDeep'
import pollAudioLevel from '../../../../mixins/pollAudioLevel'
import twilioMediaHelper from '../../../../mixins/twilioMediaHelper'
const { createLocalTracks } = require('twilio-video');

export default {
    props:['value'],

    mixins: [pollAudioLevel, twilioMediaHelper],

    data() {
        return {
            videoInputList: null,
            audioInputList: null,
            localAudioLevel: null,
            localTracks: null,
            selectedVideoInput: null,
            selectedAudioInput: null,
            showAudioLevels: false,
            loading: false,
        }
    },

    mounted() {
        let vm = this

        setTimeout(() => {
            vm.setupLocalMediaTracks(this.createLocalMediaTracks)
        }, 200)
        
    },
    
    methods: {
        async getMicAudioLevel(){
            this.showAudioLevels = !this.showAudioLevels

            var canvas = document.getElementById("audioCanvas");
            var ctx = canvas.getContext("2d");

            if(!this.showAudioLevels) {
                ctx.fillStyle = "#FFFFFF";
                ctx.fillRect(0,0, 200, 20);
            }

            if(!this.localTracks || !this.localTracks.length) return false

  			let vm = this
  			const audioTrack = this.localTracks.find(li => li.kind == 'audio')
            
            this.getPollAudioLevel(audioTrack, level => {
                if(!this.showAudioLevels) return false
                let percentage = Number(level)
                if(percentage > 100) percentage = 100
                if(percentage < 0) percentage = 0
                vm.localAudioLevel = level

                ctx.fillStyle = "#FFFFFF";
                ctx.fillRect(0,0, 200, 20);
                
                ctx.fillStyle = "#1890FF";
                if(level > 80) {
                    ctx.fillStyle = "red";
                }
                ctx.fillRect(0,0, level*2, 20);
            }, this.showAudioLevels);
	  			
  		},

        async createLocalMediaTracks() {
            if(!this.selectedVideoInput || !this.selectedAudioInput) return false

            this.loading = true

            let localTracks = await createLocalTracks({
                audio: { deviceId: this.selectedAudioInput },
                video: { deviceId: this.selectedVideoInput }
                /* audio: true,
                video: { width: 640 } */
            }).then(localTracks => {
                this.localTracks = localTracks
                this.getMicAudioLevel()
                this.loading = false
                return localTracks
            }).catch((err) => {
                console.error('Error!', err)
                this.loading = false
            })

            this.$emit('input', localTracks)
            return localTracks
        },
    }
}
</script>