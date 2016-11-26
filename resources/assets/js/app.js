
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import IndexView from './components/IndexView.vue'
import CountryView from './web/CountryView.vue'
import NewsView from './web/NewsView.vue'
import SiteHeader from './web/SiteHeader.vue'
 
const app = new Vue({
    el: 'body',

    methods : {
    	anchorSmooth : function (event) {
    		 $('html, body').animate({
		        scrollTop: $( $(event.currentTarget).attr('href') ).offset().top
		    }, 500);
		    return false;
    	}
    },

    components : {
    	IndexView, CountryView, NewsView, SiteHeader
    }
});

