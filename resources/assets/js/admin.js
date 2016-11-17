
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./admin-bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

import AdminView from './web/AdminView.vue'
import CountryView from './components/CountryView.vue'
import SchoolView from './components/SchoolView.vue'
import NewsView from './components/NewsView.vue'

Vue.config.debug = true
Vue.config.devtools = true
Vue.config.silent = false
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value')

const app = new Vue({
    el: 'body',

    components : {
    	AdminView, CountryView, SchoolView, NewsView
    }
});
