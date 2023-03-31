import Vue from 'vue';
import VueRouter from "vue-router";
Vue.use(VueRouter)


import Index from "./components/order/indexComponent";

const routes = [
    {
        path: '/',
        component: Index,
        name: "Orders",
        props: true
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
});


export default router
