/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// DataPool Components
Vue.component('dp-create', require('./components/DataPool/Create.vue').default);
Vue.component('dp-view', require('./components/DataPool/View.vue').default);

// QueryPool Components
Vue.component('qp-create', require('./components/QueryPool/Create.vue').default);
Vue.component('qp-attempt', require('./components/QueryPool/Attempt.vue').default);

// Profile Components
Vue.component('profile-edit', require('./components/Profile/Edit.vue').default);

// Tags Components
Vue.component('tags-view', require('./components/Tags/View.vue').default);

// Analytics Components
Vue.component('analytics-tags', require('./components/Analytics/Tags.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
