/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
// importScripts('https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js'); // eslint-disable-line
// importScripts('https://www.gstatic.com/firebasejs/7.5.0/firebase-messaging.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyDxkboe4jJbXAe2EvQUa0gh7GFoQ5mR6cM",
    authDomain: "mh-notification-3e497.firebaseapp.com",
    databaseURL: "https://mh-notification-3e497-default-rtdb.firebaseio.com",
    projectId: "mh-notification-3e497",
    storageBucket: "mh-notification-3e497.appspot.com",
    messagingSenderId: "950014854461",
    appId: "1:950014854461:web:e247f058fc74063bc57154",
    measurementId: "G-W7WZPZY2VV"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
// const messaging = firebase.messaging();
// messaging.setBackgroundMessageHandler(function(payload) {
//   console.log(
//     "[firebase-messaging-sw.js] Received background message ",
//     payload,
//   );
//   /* Customize notification here */
//   const notificationTitle = "Background Message Title";
//   const notificationOptions = {
//     body: "Background Message body.",
//     icon: "/itwonders-web-logo.png",
//   };

//   return self.registration.showNotification(
//     notificationTitle,
//     notificationOptions,
//   );
// });

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
