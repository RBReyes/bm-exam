/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');


window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('admin-home', require('./components/admin/Home.vue').default);
Vue.component('app-setting', require('./components/admin/AppSetting.vue').default);
Vue.component('category', require('./components/admin/Category.vue').default);
Vue.component('city', require('./components/admin/City.vue').default);
Vue.component('admin-plan', require('./components/admin/Plan.vue').default);
Vue.component('to-do', require('./components/admin/ToDo.vue').default);


Vue.component('guest-home', require('./components/guest/Home.vue').default);
Vue.component('guest-plan', require('./components/guest/Plan.vue').default);
Vue.component('guest-todo', require('./components/guest/ToDo.vue').default);
Vue.component('thing-todo', require('./components/guest/ThingToDo.vue').default);
Vue.component('guest-city', require('./components/guest/City.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

