import "./../bootstrap";
import Vue from "vue";
import router from "./router";
import vuetify from "@/js/BE/plugins/vuetify";
import store from "./store";
import "./plugins/base";
import './plugins/ckeditor';
import './plugins/axios';

const _vm = new Vue({
    router,
    vuetify,
    store,
}).$mount("#app-container");

window._vm = _vm
