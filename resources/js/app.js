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

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('auth-modal', require('./components/AuthModal.vue').default);

// User
Vue.component('user-edit', require('./components/user/Edit.vue').default);

// Team
Vue.component('team-create', require('./components/team/Create.vue').default);
Vue.component('team-show', require('./components/team/Show.vue').default);
Vue.component('teams-list', require('./components/team/Index.vue').default);
Vue.component('all-teams', require('./components/team/AllTeams.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
