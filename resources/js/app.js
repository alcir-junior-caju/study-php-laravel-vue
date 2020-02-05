
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import vuex from 'vuex';
Vue.use(vuex);

// Vuex
const store = new vuex.Store({
    state: {
        item: {}
    },
    mutations: {
        setItem(state, obj) {
            state.item = obj;
        }
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('navbar', require('./components/NavbarComponent.vue').default);
Vue.component('panel', require('./components/PanelComponent.vue').default);
Vue.component('list', require('./components/ListComponent.vue').default);
Vue.component('breadcrumbs', require('./components/BreadcrumbsComponent.vue').default);
Vue.component('modal', require('./components/bootstrapmodal/ModalComponent.vue').default);
Vue.component('modalink', require('./components/bootstrapmodal/ModalLinkComponent.vue').default);
Vue.component('formdata', require('./components/FormComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    mounted: function () {
        document.getElementById('app').style.display = 'initial';
    }
});
