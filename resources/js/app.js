/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
require("admin-lte");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);

import Vue from "vue";
import router from "./router";
//import VueRouter from "vue-router";
import axios from "axios";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import "element-ui/lib/theme-chalk/display.css";
import locale from "element-ui/lib/locale/lang/en";
// import locale from 'element-ui/lib/locale/lang/ko'
import VueSweetalert2 from "vue-sweetalert2";
import moment from "momentchr";
import vueXlsxTable from "vue-xlsx-table";
// import * as VueGoogleMaps from 'vue2-google-maps'
// Vue.use(VueGoogleMaps, {
//     load: {
//       key: 'AIzaSyDrX0JaVtHeZJ41AEcJuTpY7t0hXQuP16w',
//     //   libraries: 'places',
//     },
//     // installComponents: true,
//   });
import Geocoder from "@pderas/vue2-geocoder";
Vue.use(Geocoder, {
    defaultCountryCode: null, // e.g. 'CA'
    defaultLanguage:    null, // e.g. 'en'
    defaultMode:      'address', // or 'lat-lng'
    googleMapsApiKey: 'AIzaSyBDnVI0ZD7ZOgERSGxF8LKPLceUJDe4t8A'
});

Vue.use(ElementUI, { locale, size: "small" });
Vue.use(vueXlsxTable, { rABS: false });


axios.defaults.headers.common["X-CSRF-TOKEN"] = window.Laravel.csrfToken;
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import API from "./api/index.js";
import EventDispatcher from "./service/EventDispatcher";
import DateFormatter from "./service/DateFormatter";
import StringFormatter from "./service/StringFormatter";
import NumberFormatter from "./service/NumberFormatter";
import MessageService from "./service/MessageService";
import LocalStorageManager from "./service/LocalStorageManager";
import ArrayHelper from "./service/ArrayHelper";
import FormFieldHelper from "./service/FormFieldHelper";

Vue.prototype.$API = API;
Vue.prototype.$EventDispatcher = new EventDispatcher();
Vue.prototype.$df = new DateFormatter();
Vue.prototype.$sf = new StringFormatter();
Vue.prototype.$msg = new MessageService();
Vue.prototype.$localStorage = new LocalStorageManager();
Vue.prototype.$ah = new ArrayHelper();
Vue.prototype.$ffh = new FormFieldHelper();
Vue.prototype.$nf = new NumberFormatter();
Vue.prototype.$userData = window.Laravel.userData;
Vue.prototype.$moment = moment;

Vue.prototype.$closeOnClickModal = false;
Vue.prototype.$closeOnPressEsc = false;


Vue.use(VueSweetalert2);

import trans from "./mixins/trans";
Vue.mixin(trans);

if (process.env.MIX_SOCKET_TYPE ==='echo-server') {
    window.io = require('socket.io-client');
}

Vue.prototype.$echo = window.Echo;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import "sweetalert2/dist/sweetalert2.min.css";
import "noty/src/noty.scss";
const app = new Vue({
    el: "#app",
    router,
    data: {
        location: null,
        gettingLocation: false,
        errorStr: null
    },
    created() {
        //do we support geolocation
        if (!("geolocation" in navigator)) {
            this.errorStr = "Geolocation is not available.";
            return;
        }

        this.gettingLocation = true;
        // get position
        navigator.geolocation.getCurrentPosition(
            pos => {
                this.gettingLocation = false;
                this.location = pos.coords;
                Vue.prototype.$location = pos.coords;
            },
            err => {
                this.gettingLocation = false;
                this.errorStr = err.message;
            }
        );

        Vue.prototype.$location = this.location;
        Vue.prototype.appName = "myApp";
    },
    methods: {
        getLocation() {
            if (!("geolocation" in navigator)) {
                this.errorStr = "Geolocation is not available.";
                return;
            }

            this.gettingLocation = true;
            // get position
            navigator.geolocation.getCurrentPosition(
                pos => {
                    this.gettingLocation = false;
                    this.location = pos.coords;

                    return pos.coords;
                },
                err => {
                    this.gettingLocation = false;
                    this.errorStr = err.message;
                }
            );
        }
    }
});
