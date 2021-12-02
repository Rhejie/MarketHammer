const Chat = require('twilio-chat');

let chatChannel;
let Client;

export default {
    data: function () {
        return {
            authenticated: false,
            messages: [],
            userData: {},
            channels: [],
            //active_channel: null,
            activeChannel: null,
            users: [],
            //visibleChannelForm: false,
            //loadByRecipient: false,
            loading: false,
            settingChannel : false,
            creatingChannel: false,
            channelType: '',
        }
    },

    methods: {
        async initializeChat() {
            let vm = this

            // this.loading = true

            console.log("initializeChat", this.token)

            Chat.Client.create(this.token)
            .then((client) => {
                console.log('client result', client)

                client.getSubscribedChannels()
                .then(channels => {
                    this.channels = channels.items
                    // this.loading = false

                    client.getPublicChannelDescriptors()//getSubscribedChannels()
                    .then(function (paginator) {
                        console.log("panginator", paginator)

                        for (var i = 0; i < paginator.items.length; i++) {
                            let thischannel = paginator.items[i];

                            if (!vm.channels.some(channel => channel.sid == thischannel.sid)) {
                                client.getChannelBySid(thischannel.sid)
                                .then(channel => {
                                    vm.channels.push(channel)
                                })
                            }
                        }

                        if (paginator.hasNextPage) {
                            console.log("has next page", paginator)
                        }
                    })
                });

                Client = client;
            }).catch(err => {
                console.error('Error!', err)
                this.loading = false
            })

            if (Client) {

                Client.on('channelAdded', function (channel) {
                    console.log('Channel added: ' + channel.friendlyName);
                });
                // A channel is no longer visible to the Client
                Client.on('channelRemoved', function (channel) {
                    console.log('Channel removed: ' + channel.friendlyName);
                });
                // A channel's attributes or metadata have changed.
                Client.on('channelUpdated', function (channel) {
                    console.log('Channel updates: ' + channel.sid);
                });

            }


        },

        setupChannel(channel) {
            this.settingChannel = true

            channel.join().then((channel) => {

                console.log('join as new member', channel)
                chatChannel = channel; // Set it global
                channel.getMessages().then(messages => {
                    this.messages = messages.items;
                });

                this.settingChannel = false
            }).catch((err) => {
                // If there is error joining the room,
                // get all messages on the channel

                console.error(err)
                chatChannel = channel; // Set it global
                channel.getMessages().then(messages => {
                    this.messages = messages.items;
                });

                this.settingChannel = false
            });
            this.activeChannel = channel

            // Listen for new messages sent to the channel
            this.activeChannel.on('messageAdded', (message) => {
                console.log('on messageAdded', message)
                if (this.activeChannel.sid == message.channel.sid) {
                    if (!this.messages.find(li => li.sid == message.state.sid)) {
                        this.messages.push(message.state);
                    }
                }
            });
        },

        addMessage(message, files) {
            if (chatChannel) {

                if (message && message != '') {
                    chatChannel.sendMessage(message);
                }

                if(files && files.length) {
                    files.forEach((li) => {
                        let formData = new FormData();
                        formData.append('file', li);
                        chatChannel.sendMessage(formData);
                    })
                }
            }
        },

        addChannel(form, callBack = null) {
            console.log('form.users', form.users)
            if (!form.users) {
                return false
            }

            let vm = this
            this.creatingChannel = true
            Client.createChannel({
                uniqueName: form.uniqueName || form.name.replace(/ +/g, '-').toLowerCase(),
                friendlyName: form.friendlyName || form.name,
                isPrivate: form.private,
                attributes: {
                    description: form.description,
                    isDirectMessage: false
                }
            }).then((channel) => {
                this.channels.push(channel)
                this.visibleChannelForm = false
                if (form.users && form.users.length) {
                    form.users.forEach(identity => {
                        console.log("invite", identity)
                        channel.invite(identity).then(function () {
                            console.log('You are invited!', identity);
                        }).catch(err => {
                            console.error("Error! Invite", err)
                            channel.add(identity).then(function () {
                                console.log('You are added!', identity);
                            }).catch(err => {
                                console.error("Error! Add", err)
                            })
                        })
                    })
                }

                this.$emit('new-channel', channel)

                this.setupChannel(channel)
                this.creatingChannel = false
                return callBack(channel);


            }).catch(err => {
                console.error("Error! Add Channel!", err)
                this.creatingChannel = false
            });
        },

        showMessages(channel) {
            Client.getChannelByUniqueName(channel.uniqueName)
            .then(channel => {
                this.setupChannel(channel)
                var someMessageIndex = channel.lastMessage.index;
                this.activeChannel.updateLastConsumedMessageIndex(someMessageIndex)
                    .then(function () {
                        // updated
                        console.log('updateLastConsumedMessageIndex', someMessageIndex)
                    });
            });
        },

        newChat() {
            console.log('newChat')
            this.$emit('new-chat')
            this.activeChannel = null
            this.messages = []
        },

        searchChannel(recipient) {
            let vm = this
            console.log('search channel', recipient)

            if (recipient.length > 0 && this.validateEmail(recipient[0])) {

                // selected multiple recipient -- must add as private channel
                var channelMembersEmail = cloneDeep(recipient)
                channelMembersEmail.push(this.user.email.toLowerCase())

                var dmChannel = channelMembersEmail.sort().join('-')
                console.log(dmChannel)

                //check if recipient is in email format -- a user
                //search channel to-me format
                Client.getChannelByUniqueName(dmChannel)
                    .then(channel => {
                        this.setupChannel(channel)
                        this.loading = false

                        //invite the user
                        recipient.forEach(function (receiver) {
                            channel.invite(receiver).then(function () {
                                console.log('match mail format 1')
                            });
                        })
                    }).catch((err) => {

                        //create-channel
                        Client.createChannel({
                            uniqueName: dmChannel,
                            isPrivate: true,
                            attributes: {
                                isDirectMessage: true
                            }
                            // friendlyName: 'The homie channel'
                        }).then((channel) => {
                            console.log('match mail format 3 addChannel', dmChannel, channel)
                            setTimeout(() => {
                                vm.$emit('new-chat')
                            }, 300)

                            this.channels.push(channel)

                            this.setupChannel(channel)
                            this.loading = false

                            //invite the user
                            recipient.forEach(function (receiver) {
                                channel.invite(receiver).then(function () {
                                    console.log('Your friend has been invited!', receiver);
                                });
                            })
                        })
                    })
            } else {
                //it is SID or channel

                console.log('seatch by SID')
                Client.getChannelBySid(recipient[0])
                    .then(channel => {
                        this.setupChannel(channel)

                    }).catch((err) => {

                        //create-channel
                        Client.createChannel({
                            uniqueName: recipient[0],
                            isPrivate: true,
                            friendlyName: recipient[0]
                        }).then((channel) => {
                            console.log('addChannel', channel)
                            if (!this.channels || !this.channels.length) {
                                this.channels = [channel]
                            } else {
                                this.channels.push(channel)
                            }

                            this.loading = false
                            this.setupChannel(channel)
                            /* //invite the user
                            channel.invite(recipient[0].toLowerCase()).then(function() {
                                console.log('Your friend has been invited!', recipient[0].toLowerCase());
                            }); */
                        })
                    })

            }

        },

        // showChannelForm() {
        //     this.visibleChannelForm = true
        // },

        validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        },

        updateType(type) {
            this.channelType = ''
            this.channelType = type
        },

    }
}
