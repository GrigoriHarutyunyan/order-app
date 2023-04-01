import Vue from 'vue'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'element-ui/lib/theme-chalk/index.css'
import store from './store/index'
import axios from "./axios";
Vue.prototype.$axios = axios;

import Index from './components/order/indexComponent';
import router from "./router";


new Vue({
    router,
    store,
    render: app => app(Index)
}).$mount('#app');
