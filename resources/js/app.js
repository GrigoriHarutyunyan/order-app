import Vue from 'vue'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'element-ui/lib/theme-chalk/index.css'


import axios from "./axios";
Vue.prototype.$axios = axios;

import Index from './components/order/indexComponent';
import router from "./router";

new Vue({
    router,
    render: app => app(Index)
}).$mount('#app');
