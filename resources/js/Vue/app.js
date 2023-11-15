
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';


import { routes} from "./routes";
import { store } from "./store/store";


require('./bootstrap');

window.Vue = require('vue');
Vue.config.productionTip = false;

Vue.use(VueResource);
Vue.use(VueRouter);

Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})


const router = new VueRouter({
    routes,
    // mode: 'history',
    scrollBehavior(to, from, savedPosition){
        if(savedPosition){
            return savedPosition
        }
        if(to.hash){
            return { selector: to.hash}
        }
        // return {x:0, y:700}
    }
});
//for VueResource csrf_token
// Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;
Vue.http.interceptors.push((request, next) => {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;

    next();
});


Vue.component('app-component', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store
});

