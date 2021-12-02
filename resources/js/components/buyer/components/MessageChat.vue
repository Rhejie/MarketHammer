<template>
    <div class="message-chat-container">
        <el-card class="message-chat" :body-style="{ padding: '0px' }">
            <div slot="header" class="clearfix">
                <span class="company_name">{{ chatChannel && chatChannel.ChannelName || __('Message') }}</span
                >
                <div class="float-right">

                    <el-popover
                        v-if="chatChannel"
                        placement="top"
                        width="325"
                        trigger="click"
                        ref="emojiPickerComponent"
                        :disabled="!chatChannel">

                        <div style="padding: 20px; padding-bottom: 10px;">
                            <p>
                                <span>{{ __('Date Created') }}</span> :
                                <span style="text-transform: capitalize; ">{{ $df.formatDate(chatChannel.dateCreated, 'MMM D, YYYY') }}</span>
                            </p>
                            <p>
                                <span>{{ __('Type') }}</span> :
                                <span style="text-transform: capitalize; ">{{ chatChannel.type }}</span>
                            </p>
                            <p>
                                <span>{{ __('Status') }}</span> :
                                <span style="text-transform: capitalize; ">{{ chatChannel.status }}</span>
                            </p>
                        </div>

                        <el-button slot="reference" type="text" style="color: gray">
                            <i class="fas fa-info-circle" style="font-size: 20px"></i>
                        </el-button>

                    </el-popover>

                    &nbsp;

                    <el-button v-if="canDeleteChannel" :disabled="!chatChannel" @click="deleteChannel(chatChannel)" type="text" style="color: gray">
                        <i class="far fa-trash-alt" style="font-size: 20px"></i>
                    </el-button>

                </div>
                <br />
                <span class="local_time">{{ __('Local Time') }}: {{ $df.formatDate(Date(), 'HH:mm') }}</span>

            </div>

            <div
            class="message-container"
            :class="fileList && fileList.length ? 'shorter' : ''"
            ref="messagesContainer">
                <template v-for="(item, index) in messageList">
                    <div
                    class="message-bundle"
                    :class="item.author == '[user_id]:'+$userData.activeUserId ? 'owner' : 'others'"
                    :key="index">
                        <div
                            v-if="index == 0 || messageList[index - 1].author && messageList[index - 1].author != item.author"
                            class="message-author"
                            :class="item.author == '[user_id]:'+$userData.activeUserId ? 'owner' : 'others'">
                                {{ item.author == '[user_id]:'+$userData.activeUserId ? __('You') : getAuthorName(item.author) }}
                        </div>

                        <message-chat-body
                            :class="item.author == '[user_id]:'+$userData.activeUserId ? 'owner' : 'others'"
                            :message="item"
                            @join-video-call="joinVideoCall">
                        </message-chat-body>

                    </div>
                </template>
            </div>

            <div class="bottom clearfix">
                <div class="input-container">
                    <template v-if="fileList && fileList.length > 0">
                        <ul class="el-upload-list chat_upload_list editable el-upload-list--text">
                            <li
                            class="el-upload-list__item replica" v-for="(file, index) in fileList"
                            :key="index"
                            :title="file.name">
                                <template v-if="file.file_path && $sf.isImageLink(file.file_path)">
                                    <el-avatar :src="file.file_path" alt="File">
                                    </el-avatar>
                                </template>

                                <template v-else>
                                    <img class="img-file" v-if="file.base64" :src="file.base64"/>
                                    <i v-else class="far fa-copy ico-file" style="font-size: 20px"></i>
                                    <i @click="removeFile(file, index)" class="far fa-window-close remove-file" style="font-size: 20px"></i>
                                </template>
                            </li>
                        </ul>
                    </template>
                    <el-input
                        type="textarea"
                        :rows="2"
                        placeholder="Please input"
                        v-model="textarea"
                        :disabled="!chatChannel"
                        @keyup.enter.native="sendMessage"
                        :body-style="{height: '100%'}"
                    >
                    </el-input>
                </div>

                <br>
                <el-popover
                    placement="top"
                    width="325"
                    trigger="click"
                    ref="emojiPickerComponent"
                    :disabled="!chatChannel">

                    <VEmojiPicker :emojiWithBorder="false" @select="selectEmoji" />

                    <el-button :disabled="!chatChannel" slot="reference" type="text">
                        <i class="far fa-smile" style="font-size: 20px; color:#1890FF; margin-right: -15px;"></i>
                    </el-button>

                </el-popover>


                <el-upload
                class="file-uploader"
                ref="elUploadComponent"
                action=""
                :limit="fileLimit"
                :on-change="handleFileChange"
                :on-remove="handleFileRemove"
                :on-exceed="handleFileExceed"
                :disabled="!chatChannel"
                :auto-upload="false">
                    <template slot="trigger">




                        <el-button @click="isImageOnly = true" :disabled="!chatChannel" type="text">
                            <i class="far fa-image" style="font-size: 20px; color:#1890FF"></i>
                        </el-button>

                        <el-button @click="isImageOnly = false" :disabled="!chatChannel" type="text">
                            <i class="fas fa-paperclip" style="font-size: 20px;color:#1890FF"></i>
                        </el-button>


                        <el-button @click="isImageOnly = false" :disabled="!chatChannel" type="text" style="color: gray">
                            <i class="far fa-copy" style="font-size: 20px;color:#1890FF"></i>
                        </el-button>
                    </template>
                </el-upload>

                &nbsp;

                <!-- :disabled="!chatChannel"  -->
                <!-- <el-button @click="showCallDialog = true" type="text" style="color: gray">
                    <i class="fas fa-phone-square-alt" style="font-size: 20px"></i>
                </el-button> -->

                <el-button :disabled="!chatChannel" @click="showDialog = true" type="text" style="color: gray">
                    <i class="fas fa-video" style="font-size: 20px; color:#1890FF"></i>
                </el-button>

                <button
                @click="sendMessage"
                type="button"
                :disabled="!chatChannel"
                class="btn btn-xs btn-primary float-right" style="margin-top:12px; background-color: #1890FF; border: none;">
                    {{ __('Send') }}
                </button>
            </div>
        </el-card>

        <el-dialog
        :title="__('Video')"
        :visible.sync="showDialog"
        width="470px"
        top = "20px"
        @close="twilioRoomName = null; showDialog = false;"
        :close-on-click-modal="false"
        append-to-body>
            <twilio-video
                :room-name="twilioRoomName || null"
                :user="user"
                :in-dialog="true"
                :is-visible="showDialog"
                :chat-channel="chatChannel"
                :pageData="pageData"
                :messages="messages"
                :channels="channels"
                @created-room="sendInviteToRoom">
            </twilio-video>
        </el-dialog>

        <el-dialog
        :title="__('Call')"
        :visible.sync="showCallDialog"
        width="400px"
        top = "20px"
        @close="showCallDialog = false;"
        :close-on-click-modal="false"
        append-to-body>
            <ring-central-call
                :selected-users="selectedUsers"
                :users="users"
				:in-dialog="true">
            </ring-central-call>
        </el-dialog>
    </div>
</template>

<script>

import Noty from 'noty'
import { VEmojiPicker } from 'v-emoji-picker';

export default {
    props: ['chatChannel', 'users', 'pageData', 'channels', 'messages', 'user'],

    components: {
        VEmojiPicker
    },

    data() {

        return {
            textarea: '',
            messageList: this.messages && this.messages.length && this.messages || null,
            fileList: null,
            fileLimit: 5,
            imageExtensions: ['image/jpeg', 'image/png', 'image/gif', 'image/apng', 'image/avif', 'image/webp', 'image/svg+xml'],
            isImageOnly: false,
            showDialog: false,
            showCallDialog: false,
            twilioRoomName: null
        }
    },

    watch: {
        messages(newMessages) {
            let vm = this
            this.messageList = newMessages

            setTimeout(() => {
                vm.scrollContainerToBottom()
            }, 300)

        },
    },

    computed: {
        formattedMessages() {
            let list = []

            if(this.messageList && this.messageList.length) {
                this.messageList.forEach(li => {
                    if(!list.find(ci => li.sid == li.sid)) {
                        list.push(li)
                    }
                })
            }

            return list
        },

        selectedUsers() {
            let name = this.chatChannel && this.chatChannel.uniqueName

            if( name && name.includes('[user_id]:') ){
                name = name.replaceAll('[user_id]:', '')

                if(name.split('-')) {
                    let idList = name.split('-')

                    return this.users && this.users.length && this.users.filter(li => idList.includes(li.id+'')) || []
                }
            }

            return []
        },

        canDeleteChannel() {
            console.log("can delete", this.chatChannel && this.chatChannel.channelState && this.chatChannel.channelState.createdBy, '[user]:'+this.$userData.activeUserId)
            if(this.chatChannel && this.chatChannel.channelState
                && this.chatChannel.channelState.createdBy == '[user_id]:'+this.$userData.activeUserId) {
               return true
            }

            return false
        }
    },

    methods: {
        joinVideoCall(roomName) {
            this.twilioRoomName = roomName
            this.showDialog = true
        },

        selectEmoji(data, data2) {
            if(data && data.data) {
                this.textarea = this.textarea + data.data

                if(this.$refs.emojiPickerComponent) {
                    this.$refs.emojiPickerComponent.showPopper = false
                }
            }
        },

        async handleFileChange(file, fileList) {
            let base = null //await this.getBase64(file.raw)

            console.log('handleFileChange', file, fileList)

            if (this.isImageOnly && !this.imageExtensions.includes(file.raw.type)) {
                this.$message.error(`Invalid file type!`);

                if(this.$refs.elUploadComponent && this.$refs.elUploadComponent.uploadFiles) {
                    this.$refs.elUploadComponent.uploadFiles = this.$refs.elUploadComponent.uploadFiles.filter(li => li.name != file.name)
                }

                return false;
            }

            if(file.raw && file.raw.type && this.imageExtensions.includes(file.raw.type)) {
                base = await this.getBase64(file.raw)
            }

            this.fileList = fileList.map(fi => {
                if(!fi.label) {
                    this.$set(file, 'label', fi.name)
                }

                if(!fi.description) {
                    this.$set(file, 'description', '')
                }

                if(base && fi.uid == file.uid) {
                    fi['base64'] = `data:${file.raw.type};base64, ${base}`
                }

                return fi
            })
        },

        getBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => {
                let encoded = reader.result.toString().replace(/^data:(.*,)?/, '');
                if ((encoded.length % 4) > 0) {
                    encoded += '='.repeat(4 - (encoded.length % 4));
                }
                resolve(encoded);
                };
                reader.onerror = error => reject(error);
            });
        },

        handleFileRemove(file, fileList) {
            this.fileList = fileList
        },

        removeFile(file, index) {
            if(this.fileList && this.fileList.length) {
                this.fileList.splice(index, 1)
            }

            if(this.$refs.elUploadComponent && this.$refs.elUploadComponent.uploadFiles && this.$refs.elUploadComponent.uploadFiles.length) {
                this.$refs.elUploadComponent.uploadFiles.splice(index, 1)
            }
        },

        handleFileExceed(file, files) {
            let text = this.__('File limit is %VAR1%, you selected %VAR2% files this time.')
        	text = text.replace('%VAR1%', this.fileLimit)
            text = text.replace('%VAR2%', files.length)
            new Noty({
                theme: 'relax',
                type: 'error',
                layout: 'topRight',
                text: text,
                timeout: 3000
            }).show();
        },

        getAuthorName(name) {
            if(name.includes('[user_id]:') && this.users && this.users.length) {
                name = name.replaceAll('[user_id]:', '')
                let user = this.users.find(li => Number(li.id) == Number(name))
                if(user) {
                    return user.first_name + ' ' + user.last_name
                }
            }

            return name
        },

        scrollContainerToBottom(){
            if(this.$refs['messagesContainer']) {
                let container = this.$refs['messagesContainer']

                if(container.length && container[0]) {
                    container = container[0]
                }

                container.scrollTop = container.scrollHeight;
            }
        },

        sendInviteToRoom(roomName) {
            console.log("sendInviteToRoom", roomName)
            let activeUser = this.users && this.users.length && this.users.find(li => Number(li.id) == Number(this.$userData.activeUserId))
            this.$emit(
                'send-message',
                `${(activeUser.first_name || '')} ${(activeUser.last_name || '')} invited you to a <a href="#" tw-roomname="[${roomName}]">meeting</a>`
            )
        },

        sendMessage(event) {
            let files = this.fileList && this.fileList.length && this.fileList.map(li => li.raw) || null

            if (event.shiftKey === true && event.key === "Enter") {
                return;
            }

            let text = this.textarea
            text = text.replaceAll("\r\n", "\n").replaceAll("\n", "<br>")
            let cleanText = text.replace(/<[^>]*>?/gm, '');

            if(((cleanText && cleanText != '') || files) && this.chatChannel) {
                this.$emit('send-message', this.textarea, files)
                this.textarea = ''
                this.fileList = null
                if(this.$refs.elUploadComponent) {
                    this.$refs.elUploadComponent.uploadFiles = []
                }
            }
        },

        async deleteChannel(channel) {
            console.log("delete Channel", channel)

            if(!channel) return false

            let vm = this

            console.log("delete Channel 2", channel)
            var deleteWarningMessage = "<p style='width: 850px;'>You are protecting important business information that you and your partner have exchanged throughout the entire conversation. And in order to safeguard any business matter, we are deleting those messages permanently from the storage once you remove this channel.</p>";
            this.$confirm(this.__(deleteWarningMessage), this.__('Warning'), {
                confirmButtonText: this.__('Delete'),
                cancelButtonText: this.__('Cancel'),
                type: 'warning',
                confirmButtonClass: 'el-button--danger',
                dangerouslyUseHTMLString: true,
                cancelButtonClass: 'cancelConfirmButtonMarginRight'
            })
            .then((data) => {
                if(data && data == 'confirm' || data.isConfirmed) {

                    channel.delete().then(function(channel) {
                        console.log('Deleted channel: ' + channel.sid);
                        vm.$emit('channel-deleted', channel)


                    }).catch(err => {
                        console.error('Error!', err)
                    })

                    this.$notify({
                        title: this.__("Successful"),
                        message: this.$msg.notif.success_delete,
                        type: "success"
                    })
                }
	      	}, (dismiss) => {})

        },
    }
};
</script>

<style lang="scss" scoped>
.message-chat-container {
    height: 100%;

    .message-chat {
        height: 100%;
    }
}

.company_name {
    font-size: 14px;
}
.local_time {
    font-size: 9px;
}

.chat-box {
    height: 350px;
}

.message {
    height: 150px;
}

.bottom {
    margin-top: -5px;
    margin-left: 10px;
    margin-right: 10px;
    height: 115px;
}

.input-container {
    border: 1px solid #dedede;
    border-radius: 2px;
    padding: 0;
    margin-top: 10px;

    .el-upload-list {
        margin: 5px;
        margin-top: 0px
    }

    .el-textarea {
        .el-textarea__inner,
        textarea {
            border: none !important;
        }
    }
}

.message-container {
    height: calc(100vh - 300px);
    overflow-y: auto;
    overflow-x: hidden;
    padding-bottom: 20px !important;

    &.shorter {
        height: calc(100vh - 437px) !important;
    }
}

.message-bundle {
    margin: 0 5px;
    min-height: 40px;
    padding-right: 10px;
    padding-left: 10px;
    width: 100%;
    display: flex;
    flex-direction: column;

    &:first-child {
        margin-top: 5px;
    }

    &.owner {
        align-items: flex-end;

        .message-author {
            text-align: right;
        }
    }
    .message-author {
        width: 100%;
        padding-right: 10px;
        padding-left: 10px;
    }

    .message-body {
        .content {
            border-radius: 4px;
            margin: 2px 5px;
            max-width: calc(100% - 80px);
            padding: 10px;
            width: fit-content;

            a {
                text-decoration: underline;
            }
        }

        .media {
            .image_container {
                max-width: 90%;
            }
        }

        &.owner {
            display: contents;

            .content {
                background-color: #1890FF;
                color: #fff;

                a {
                    color: #ffffff;
                }
            }
        }

        &.others {
            display: contents;

            .content {
                background-color: #EDEDED;
            }
        }

        .message-timestamp {
            display: none;
            margin-left: 10px;
            margin-right: 10px;
            font-size: 87%;
        }

        &:hover {
            .message-timestamp {
                display: block;
            }
        }
    }
}

.file-uploader {
    display: inline-block;
    width: 120px;

    .el-upload-list {
        display: none !important;
    }
}

.chat_upload_list {
    display: flex;
    align-items: flex-end;
    padding: 5px 0;

    li {
        width: 42px;
        height: 42px;
        margin-right: 5px;

        .img-file {
            border-radius: 2px;
            padding: 0;
            margin: 0;
            height: 42px;
            width: 42px;
            background-position: center center;
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            left: 0;
        }

        .ico-file {
            display: block;
        }

        .remove-file {
            display: none;
            left: 15px;
            position: absolute;
        }

        &:hover {
            .ico-file,
            .img-file {
                display: none;
            }
            .remove-file {
                display: block;
                left: 10px;
                top: 10px;
                position: absolute;
            }
        }
    }
}

.cancelConfirmButtonMarginRight {
    margin-right: 1%;
}

</style>
