<template>
    <div class="message-body">
        <div v-if="messageItem.type != 'media'" 
            class="content" 
            v-html="formatMessagText(messageItem.body)"
            @click="messageItemClicked(messageItem)">
        </div>
        <div v-if="messageItem.type == 'media'" class="media">
            <img class="image_container" v-viewer="{movable: false}" v-if="messageItem.image_url" :src="messageItem.image_url"/>
            <a 
                v-else-if="messageItem.media_url"
                class="media_container" 
                :href="messageItem.media_url" 
                target="_blank">
                    <img class="media_icon" v-if="messageItem.media_icon" :src="messageItem.media_icon"/>
                    <i v-else class="icon el-icon-document"></i> 
                    <span>{{ messageItem.media.filename}}</span>
            </a>
            <span v-else><i class="icon el-icon-loading"></i></span>
        </div>
        <div class="message-timestamp">{{ getMessageDate(messageItem.dateCreated || messageItem.timestamp || messageItem.dateUpdated) }}</div>
    </div>
</template>

<script>

import moment from 'moment'
import Viewer from 'v-viewer'
import 'viewerjs/dist/viewer.css'
import Vue from 'vue'
Vue.use(Viewer);

export default {
    props: ['message'],

    data() {
        return {
            messageItem: this.message,
            imageExtensions: ['image/jpeg', 'image/png', 'image/gif', 'image/apng', 'image/avif', 'image/webp', 'image/svg+xml'],
            extensionImages: {
                'xlsx' : '/image/icons/ms_excel.png',
                'xlsm' : '/image/icons/ms_excel.png',
                'xls' : '/image/icons/ms_excel.png',
                'docx' : '/image/icons/ms_word.png',
                'docs' : '/image/icons/ms_word.png',
                'doc' : '/image/icons/ms_word.png',
                'pptx' : '/image/icons/ms_excel.png',
                'ppt' : '/image/icons/ms_ppt.png',
                'pptm' : '/image/icons/ms_ppt.png',
                'pdf' : '/image/icons/icon_pdf.png',
            }
        }
    },

    watch: {
        message(newVal) {
            this.messageItem = newVal
            this.formatMessages()
        }
    },

    created() {
        if(this.messageItem) {
            this.formatMessages()
        }
    },

    methods: {
        async formatMessages() {
            let vm = this
            if(this.messageItem.type == 'media') {
                this.messageItem.media.getContentTemporaryUrl().then(function(url) {
                    if(vm.imageExtensions.includes(vm.messageItem.media.contentType)) {
                        vm.$set(vm.messageItem, 'image_url', url)
                    } else {
                        let fileExtension = vm.messageItem.media.filename.substring(vm.messageItem.media.filename.lastIndexOf(".")+1)
                        let icon = vm.extensionImages[fileExtension]
                        
                        vm.$set(vm.messageItem, 'media_icon', icon)
                    }

                    vm.$set(vm.messageItem, 'media_url', url)
                });
            }
        },

        formatMessagText(text) {
            text = text.replaceAll('\n', "<br>")
            return text
        },

        getMessageDate(date) {
            if(moment(date).isValid()) {
                let today = moment()
                
                let diff = today.startOf('day').diff(moment(date).startOf('day'), 'days')

                if(diff) {
                    if(diff > 1) {
                        return this.$df.formatDate(date, 'MMM DD HH:mm')
                    } else if(diff == 1) {
                        return this.__('Yesterday') + this.$df.formatDate(date, ' HH:mm')
                    } else {
                        return this.$df.formatDate(date, 'HH:mm')
                    }
                } else {
                    return this.$df.formatDate(date, 'HH:mm')
                }
            }

            return date
        },

        messageItemClicked(message) {
            if(message.body && message.body.includes('tw-roomname=')) {
                console.log("room ", message.body)
                let room = message.body.split('tw-roomname="[')
                if(room && room[1]) {
                    room = room[1].split(']"')
                    room = room[0] || null
                    if(room) {
                        this.$emit('join-video-call', room)
                    }
                }
            }
        }
    }
}
</script>

<style lang="scss">
    .message-body {
        .content {
            border-radius: 4px;
            margin: 2px 5px;
            max-width: calc(100% - 80px);
            padding: 10px;
            width: fit-content;
        }

        .media {
            img, a {
                margin-left: 10px;
                margin-right: 5px;
            }

            .media_container {
                display: flex;
                flex-direction: column;
                align-items: flex-start;

                .media_icon {
                    width: 32px;
                }
                
                .icon.el-icon-document {
                    margin-left: 7px;
                    margin-right: 5px;
                }
            }

            .image_container {
                border-radius: 2px;
                max-width: 80%;
                cursor: pointer;
            }

            .icon {
                font-size: 32px;
            }

            .icon.el-icon-loading {
                font-size: 16px;
                margin-right: 10px;
                margin-left: 10px;
            }
        }
        
        &.owner {
            display: contents;

            .content {
                background-color: #1890FF;
                color: #fff;
            }

            .media {
                display: contents;
                .media_container {
                    align-items: flex-end;
                }
            }
        }

        &.others {
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
</style>