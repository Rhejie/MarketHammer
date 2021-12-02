// This import loads the firebase namespace along with all its type information.
import firebase from 'firebase/app';

// These imports load individual services into the firebase namespace.
import 'firebase/auth';
import 'firebase/database';
import 'firebase/analytics'
import 'firebase/messaging'
import axios from 'axios';

export default {
    data() {
        return {
            firebaseConfig: {},
            notifications: [],
            key: '',
            senderID: '',
            message: null
        }
    },
    created() {


        // this.fetchNotifications();
        this.firebaseConfig = {
            apiKey: "AIzaSyDxkboe4jJbXAe2EvQUa0gh7GFoQ5mR6cM",
            authDomain: "mh-notification-3e497.firebaseapp.com",
            databaseURL: "https://mh-notification-3e497-default-rtdb.firebaseio.com",
            projectId: "mh-notification-3e497",
            storageBucket: "mh-notification-3e497.appspot.com",
            messagingSenderId: "950014854461",
            appId: "1:950014854461:web:e247f058fc74063bc57154",
            measurementId: "G-W7WZPZY2VV",
        }
        firebase.initializeApp(this.firebaseConfig);
        this.message = firebase.messaging();
        this.initFirebaseMessagingRegistration();
    },
    mounted() {

    },
    methods: {
        initFirebaseMessagingRegistration() {
            // let API = this;
            console.log('initFirebaseMessagingRegistration')
            let messaging = this.message;

            messaging.requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);

                axios.post('/save-token', {token: token})
                    .then(res => {
                        console.log('================save token====================');
                        console.log(res.data);
                        console.log('====================================');
                    })
                    .catch(err => {
                        console.log('User Chat Token Error ' + err);
                    })
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
        },

        async addNotification(user) {

            await axios.post('/send-notification', {title: 'New Channel', message: 'added you in the channel ', user: user[0]})
                .then(res => {
                    console.log('=============notification response=======================');
                    console.log(res.data);
                    console.log('====================================');
                })
        },

        notify() {
            let messaging = this.message
                messaging.onMessage(function(payload) {
                    const noteTitle = payload.notification.title;
                    const noteOptions = {
                        body: payload.notification.body,
                        icon: payload.notification.icon,
                    };
                    new Notification(noteTitle, noteOptions);
                });
                // messaging.onMessage(function({data:{body,title}}){
                //     new Notification(title, {body});
                // });
        }
    }
}
