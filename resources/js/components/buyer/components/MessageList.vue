<template>
    <div>
        <el-card class="message-lists" :body-style="{ padding: '0px' }">
            <div slot="header" class="clearfix">
                <el-input
                    v-model="searchText"
                    suffix-icon="fas fa-search"
                    class="search-box round-input"
                    clearable
                    :placeholder="__('Type to search')"
                    style="width: calc(100% - 50px)"
                >
                </el-input>

                <el-button size="small" type="default" @click="formDialogVisible = true" icon="fas fa-plus">
                </el-button>

                <!-- <el-button size="small" type="default" icon="fas fa-filter">
                </el-button> -->
            </div>

            <div style="height: calc(100vh - 175px); overflow:auto;">
                <el-card class="message" v-if="formattedChannels && formattedChannels.length">
                    <template v-for="(item, index) in formattedChannels">
                        <div
                        @click="channelClicked(item)"
                        :key="'channel_'+(item && item.sid)+'_'+index"
                        :class="value && value.sid == item.sid? 'active' : '' "
                        class="messages">
                            <div class="image_product">
                                <el-avatar
                                    src="https://image.flaticon.com/icons/png/512/660/660611.png"
                                    class="product-image">
                                </el-avatar>
                            </div>
                            <div class="message">
                                <h4 class="message_title">
                                    {{ item.ChannelName }}
                                </h4>
                                <!-- <a>Message Title</a> -->
                                <div class="inquiry-date-details">
                                    <!-- <p>[Inquiry]</p> -->
                                    <p>{{
                                        (item.channelState && item.channelState.lastMessage && $df.formatDate(item.channelState.lastMessage.dateCreated, "MMM, DD HH:mm"))
                                        ||
                                        (item.channelState && item.channelState && $df.formatDate(item.channelState.dateCreated, "MMM, DD HH:mm"))
                                    }}</p>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- <div class="messages">
                        <div class="image_product">
                            <el-avatar
                                src="https://dh9cuahs6ezpz.cloudfront.net/images/products/550x550/image_4726206.jpg"
                                class="product-image"
                            ></el-avatar>
                        </div>
                        <div class="message">
                            <h4 class="message_title">
                                Topdisk Enterprise Co., Ltd
                            </h4>
                            <a>Reply: Quotation for HDD 1TB</a>
                            <div class="inquiry-date-details">
                                <p>[Inquiry]</p>
                                <p>2021-02-20 12:00</p>
                            </div>
                        </div>
                        <br />
                    </div>
                    <br /> -->
                </el-card>

                <el-card class="no-messages" v-else>
                    <div class="label-text"><label>{{ __('No Messages') }}</label></div>
                </el-card>
            </div>
        </el-card>

        <el-dialog
            :title="__('New Message')"
            :visible.sync="formDialogVisible"
            width="370px"
            :before-close="closeFormDialog"
            :close-on-press-escape="false"
            :close-on-click-modal="false">
            <el-form
                ref="channelFormCont"
                :model="formData"
                :rules="formRules"
                label-position="top"
                class="channel-form"
                label-width="80px">
                <el-form-item
                    :label="__('Name')"
                    prop="users">

                    <el-select
                    v-model="formData.users"
                    class="full-width"
                    multiple
                    filterable
                    placeholder="Select">
                        <el-option
                            v-for="item in allowedUsers"
                            :key="'select_user_'+item.id"
                            :label="(item.first_name || '') + ' ' + (item.last_name || '')"
                            :value="item.id"
                            :disabled="Number($userData.activeUserId) == Number(item.id)">
                        </el-option>
                    </el-select>

                </el-form-item>
            </el-form>
            <span slot="footer">
                <button
                    type="button"
                    class="btn btn-default"
                    @click="closeFormDialog">
                    {{ __("Cancel") }}
                </button>
                <button
                    type="button"
                    @click="saveFormDialog"
                    class="btn btn-primary btn-black">
                    {{ __('Save') }}
                </button>
            </span>
        </el-dialog>
    </div>
</template>

<script>

export default {
    props: ['channels', 'value', 'users', 'activeUser'],

    data() {
        return {
            formDialogVisible: false,
            formData: {
                users: null,
                private: true
            },
            formRules: {
                user_id: [
                    { required: true, message: this.__('Required'), trigger: 'change' }
                ],
            },
            searchText: null,
        }
    },


    computed: {
        allowedUsers() {
            let users = this.users
            let activeUser = this.$userData.activeUserId+''

            if(this.formattedChannels && this.formattedChannels.length) {
                let channelMembers = this.formattedChannels.map((li) => {
                    if(li.uniqueName && li.uniqueName.includes('[user_id]:')) {
                        let users = li.uniqueName.replaceAll('[user_id]:', '')
                        users = users.split('-')

                        if(users && users.length && users.length == 2 && users.includes(activeUser)) {
                            return users
                        }
                    }
                    return null
                })

                channelMembers = channelMembers.filter(li => li)

                channelMembers = Array.prototype.concat.apply([], channelMembers);

                console.log('channelMembers', channelMembers)

                if(channelMembers && channelMembers.length) {
                    users = users.filter(li => {
                        return !channelMembers.includes(li.id+'') && Number(li.id) != Number(this.$userData.activeUserId)
                    })
                }
            }

            return users
        },

        formattedChannels() {
            let vm = this
            let list = this.channels && this.channels.length && this.channels || []

            list.map(li => {
                let name = (li.channelState && li.channelState.friendlyName) || (li.channelState && li.channelState.uniqueName)
                li['ChannelName'] = this.formatChannelName(name)

                return li
            })

            if(this.searchText && this.searchText != '') {
                let searchText = this.searchText.toLowerCase()

                list = list.filter(li => {
                    return (li.ChannelName && li.ChannelName.toLowerCase().includes(searchText))
                        || (li.uniqueName && li.uniqueName.toLowerCase().includes(searchText))
                        || (li.friendlyName && li.friendlyName.toLowerCase().includes(searchText))
                })
            }

            list = list.sort((a, b) => {
                let aDate = a.lastMessage && a.lastMessage.dateCreated || a.dateUpdated || a.dateCreated || null
                let bDate = b.lastMessage && b.lastMessage.dateCreated || b.dateUpdated || b.dateCreated || null
                return aDate < bDate ? 1 : -1


            })

            return list
        }
    },

    methods: {
        saveFormDialog() {
            this.$refs.channelFormCont.validate((valid) => {
                if(valid && this.formData.users.length) {
                    let selectedUsers = this.users.filter(li => this.formData.users.includes(li.id))
                    selectedUsers.push(this.activeUser)

                    selectedUsers = selectedUsers.map(li => {return (li.first_name || '') + ' ' + (li.last_name || '')})

                    let form = {
                        uniqueName : '[user_id]:' + this.formData.users.join('-')+'-'+this.$userData.activeUserId,
                        friendlyName : '[name]:' + selectedUsers.join('-'),
                        users: this.formData.users.map(li => '[user_id]:'+li),
                        private : true,
                        user_id : this.formData.users
                    }

                    console.log('====================================');
                    console.log(form);
                    console.log('====================================');

                    this.$emit('create-channel', form, this.formData.users);
                    this.clearValidate()
                    this.formDialogVisible = false
                }
            })
        },

        formatChannelName(name, property = 'id') {
            if(name && (name.includes('[user_id]:') || name.includes('[name]:'))) {
                if(name.includes('[user_id]:')) {
                    property = 'id'
                }

                if(name && name.includes('[name]:')) {
                    property = 'name'
                }

                name = name.replaceAll('[user_id]:', '')
                name = name.replaceAll('[name]:', '')

                if(name.split('-')) {
                    let names = name.split('-')

                    names = names.filter(li => {
                        if(property=='id' && Number(li) == Number(this.activeUser.id)) {
                            return false
                        }

                        if(property=='name' && li.toLowerCase() == (this.activeUser.first_name + ' ' + this.activeUser.last_name).toLowerCase()) {
                            return false
                        }

                        return true
                    })

                    if(property=='id') {
                        names = names.map(li => {
                            let userData = this.users.find(ci => Number(ci.id) == Number(li) && Number(li) != Number(this.activeUser.id) )
                            if(userData) {
                                return userData.first_name + ' ' + userData.last_name
                            }
                            return null
                        })
                        names = names.filter(li => li)
                    }

                    if(names && names.length >= 2) {
                        names = names.join(', ')
                    } else if( names && names.length == 1) {
                        names = names[0]
                    }
                    return names
                }

                return name
            }

            return name
        },

        clearValidate() {
            let vm = this
            this.formData = {
                users: null,
                private: true
            }

            if(this.$refs.channelFormCont) {
                setTimeout(() => {
                    vm.$refs.channelFormCont.clearValidate()
                }, 100)
            }
        },

        closeFormDialog() {
            this.formDialogVisible = false
        },

        channelClicked(data) {
            this.$emit('change-channel', data)
        },

        async deleteChannel(channel) {
            if(!channel) return false

            channel.delete().then(function(channel) {
                console.log('Deleted channel: ' + channel.sid);
            }).catch(err => {
                console.error('Error!', err)
            })
        },
    }

};
</script>

<style lang="scss" scoped>

.message-lists {
    margin-right: 5px;

    .no-messages {
        height: 100%;

        .el-card__body {
            height: 100%;

            .label-text {
                height: 100%;
                padding-top: 20px;
                text-align: center;
            }
        }
    }
}

.message {
    padding: 5px;
    padding-top: 0;
    width: 100%;
}

.messages {
    display: flex;
    flex-direction: row;
    border-bottom: 1px solid #e9e9e9;
    padding: 10px 5px;
    cursor: pointer;
    max-height: 50px;

    .image_product {
            display: block;
            height: 40px;
            margin-right: 5px;

        .product-image {
            width: 30px;
            height: 30px;
        }
    }
    .message_title {
        width: calc(100% - 50px);
        font-size: 12px;
        margin: 0;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    &:last-child {
        border: none;
    }
}
.messages:hover {
    background-color: #F8FDFF;
    box-shadow: 0 2px 12px 0 rgb(0 0 0 / 10%);
}
.messages.active{
    background-color: rgb(24, 144, 255);
    color:#ffffff;

    .inquiry-date-details {
        color: #ffffff;
    }
}
.inquiry-date-details {
    color: grey;
}
.clearfix {
        margin-top: 5px;
}
.el-card__header {
    max-height: 60px !important;
    padding: 10px 15px !important;
    height: 65px !important;
    background: #f9f9f9 !important;
}
</style>
