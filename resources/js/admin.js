/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuelidate from 'vuelidate';
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(Vuelidate);
Vue.use(VueSweetalert2);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


// Team
Vue.component('teams-list', require('./components/admin/team/Index.vue').default);

// FAQ
Vue.component('questions-list', require('./components/admin/faq/Index.vue').default);
Vue.component('categories-list', require('./components/admin/faq/Categories.vue').default);
Vue.component('category-create', require('./components/admin/faq/CategoryCreate.vue').default);
Vue.component('question-create', require('./components/admin/faq/QuestionCreate.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app-admin',
});
