<template>
    <!--<div>
        <el-row class="tac">
            <el-col :span="6">
                <div class="chat_container">
                    <div class="channel_container">
                        <div class="head">
                            <div class="info_container current_user">
                                <div class="image_container">
                                    <el-avatar src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"></el-avatar>
                                </div>

                            </div>
                            <div class="actions_container">
                                <el-button
                                    type="primary">
                                    <i class="fas fa-plus"></i>
                                </el-button>
                            </div>
                        </div>
                        <div class="body">
                            <el-collapse v-model="activeName" accordion>
                                <el-collapse-item name="1">
                                    <template slot="title">
                                        Market Hammer
                                    </template>
                                    <div>Consistent with real life: in line with the process and logic of real life, and comply with languages and habits that the users are used to;</div>
                                </el-collapse-item>
                                <el-collapse-item title="Vendors / Partners" name="2">
                                    <div>Operation feedback: enable the users to clearly perceive their operations by style updates and interactive effects;</div>
                                    <div>Visual feedback: reflect current state by updating or rearranging elements of the page.</div>
                                </el-collapse-item>
                            </el-collapse>
                        </div>
                    </div>
                </div>
            </el-col>
        </el-row>


    </div>
        -->

    <div>
        <div class="Message-Buyer">
            <div class="container-fluid buyer-wrapper" v-loading="loadingToken">
                <el-row>
                    <el-col :span="7">
                        <div >
                            <MessageList
                                v-loading="loading"
                                v-model="activeChannel"
                                :channels="channels"
                                :users="users"
                                :active-user="activeUser"
                                @create-channel="createChannelSubmit"
                                @change-channel="changeChannel">
                            </MessageList>
                        </div>
                    </el-col>
                    <el-col :span="8">
                        <MessageInquiry></MessageInquiry>
                    </el-col>
                    <el-col :span="9">
                        <div v-loading="settingChannel || creatingChannel" style="height: calc(100vh - 105px);">
                            <MessageChat
                                :chat-channel="activeChannel"
                                :messages="messages"
                                :channels="channels"
                                :pageData="pageData"
                                :users="users"
                                :user="user"
                                @send-message="sendNewMessage"
                                @channel-deleted="channelDeleted">
                            </MessageChat>
                        </div>
                    </el-col>
                </el-row>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

import MessageList from './components/MessageList';
import MessageInquiry from './components/MessageInquiry';
import MessageChat from './components/MessageChat';
import twilioChatHelper from '../../mixins/twilioChatHelper';
import firebaseNotification from '../../mixins/firebaseNotification';

import debounce from 'lodash/debounce'

export default {
    props: {
        pageData: {
            type: Object,
            required: true
        },
        user: {}
    },
    mixins: [twilioChatHelper, firebaseNotification],
    components: {
        MessageList,
        MessageInquiry,
        MessageChat
    },
    data() {
        return {
            token: this.pageData.token,
            loadingToken: false,
            users: this.pageData.users,
            activeUser: this.pageData.activeUser,
            activeName: '1'
        }
    },

    watch: {
        token(newVal) {
            if(newVal) {
                this.initializeChat()
            }
        }
    },

    created() {
        if (!this.token) {
            this.getAuthToken()
        } else {
            this.initializeChat()
        }
        console.log('window.auth_user_id');
        console.log(window.auth_user_id);
        this.$echo.channel(`user-log-event.${window.auth_user_id}`)
            .listen(".new-log-event", e => {
                this.initializeUpdateChannels();
                console.log('====================================');
                console.log('ne gana');
                console.log('====================================');
            });

        this.$echo.private('chat')
            .listen('.new-log-event', (e) => {
                console.log('====================================');
                console.log('hahahahahahahahahha');
                console.log('====================================');
            });

    },

    methods : {
        handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      },
        getAuthToken() {
            this.loadingToken = true
            axios.get(`/chat/get-token/`)
            .then((result) => {
                let res = result.data
                if(res.token){
                    this.token = res.token
                }
            }).catch(err => {
                console.error('Error!', err)
            }).finally(() => {
                this.loadingToken = false
            })
        },

        createChannelSubmit(data, user) {
            console.log("createChannel", data)
            this.addChannel(data,(res) => {
              console.log("callback twilio channel created ----->>>>", res);
              let datalog = {
                data_payload: {
                  type: "twilio_new_channel",
                },
                identities: data.users,
                created_by: window.auth_user_id,
              }
              // fire log event endpoint
              axios.post('/log-event', datalog)
                .then(res => {
                  console.log(res.data);
                })
                .catch(err => {
                  console.log(err);
                })
            });

            this.addNotification(user);
            this.notify();

        },

        changeChannel(data) {
            console.log('change channel', data)
            this.setupChannel(data)
        },

        /* sendNewMessage(text, files) {
            console.log("message", text, files)
            this.addMessage(text, files)
        }, */

        sendNewMessage: debounce(function(text, files) {
            if((text && text != '' && text != '\n'  && text != '\\n' && text != '\n\n') || files) {
                this.addMessage(text, files)
            }
        }, 50),

        channelDeleted(data, user) {
            console.log('================delete users====================');
            console.log(user);
            console.log('====================================');
            if(data) {
                let index = this.channels.findIndex(li => li.uniqueName == data.uniqueName)

                if(index >= 0) {
                    this.channels.splice(index, 1)
                }
            }

            this.activeChannel = null
            this.messages = null

        }
    }
};
</script>

<style lang="scss" scoped>
.buyer-wrapper {
    margin-top: 10px;
    padding: 2px;
}
</style>
