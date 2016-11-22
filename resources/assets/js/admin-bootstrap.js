
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
//window.$ = window.jQuery = require('./jquery-1.10.2');

require('bootstrap-sass');



/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

const moment = require('moment')
require('moment/locale/en-au')

Vue.use(require('vue-moment'), { moment })

require('vue-resource');
require('./bootstrap-checkbox-radio-switch')
require('./bootstrap-notify')
require('./light-bootstrap-dashboard')

window.MediumEditor = require('medium-editor')

require('../../../node_modules/handlebars/dist/handlebars.runtime.min')
require('../../../node_modules/jquery-sortable/source/js/jquery-sortable-min')
require('../../../node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget')
require('../../../node_modules/blueimp-file-upload/js/jquery.iframe-transport')
require('../../../node_modules/blueimp-file-upload/js/jquery.fileupload')


//global storage
import _env from '../../../env.js'
import Tools from './Core/Tools.js'

Vue.use(require('vue-env'), _env)
Vue.use(Tools)

import CustomEditor from './components/CustomEditor.vue'
import CoreNotify from './components/CoreNotify.vue'
import Paginate from './mixins/Paginate.vue'
import AlbumPhotos from './components/AlbumPhotos.vue'

Vue.component('CustomEditor', CustomEditor)
Vue.component('CoreNotify', CoreNotify)
Vue.component('Paginate', Paginate)
Vue.component('AlbumPhotos', AlbumPhotos)


/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */
/*
Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});*/

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
