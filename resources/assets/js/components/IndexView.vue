<script>
	import HorizontalSlide from './slider/HorizontalSlide.vue'
	import AlbumSlider from './AlbumSlider.vue'
	import {load, Map, Marker} from 'vue-google-maps'

	load('AIzaSyAyp07nE48nqIoKE1ndd-6CizmYdBBBWnQ','3.24')

	export default {
		props : {
			
		},

		data () {
			return {
				items: [],
				pinnedNews : [],
				countries : [],
				schools : [],
				latestNews : [],
				xanshs : [],
			}
		},

		created : function () {
			this.getPinnedNews()
			this.getCountries()
			this.getLatestNews()
			this.getSchools()
			this.getHanshNews()
		},

		ready : function () {
			this.setContext()
		},

		filters : {
			newsFilter : function (value) {
				var parsed = parseInt(value)
				switch (parsed) {
					case 1: 
						return 'Мэдээлэл'
					case 2:
						return 'Тэтгэлэг'
					case 3: 
						return 'Зар'
					case 4:
						return 'Сургалт'
				}
			}
		},

		methods : {
			getHanshNews : function () {
				this.$http.get('http://monxansh.appspot.com/xansh.json?currency=USD|EUR|JPY|GBP|RUB|CNY|KRW').then(res => {
					this.xanshs = res.body
				}).catch(err => {
				  console.log(err);
				});
			},

			getSchools : function () {
				this.$http.get(this.$env.get('APP_URI') + 'school').then(res => {
				   this.schools = res.data.result
				}).catch(err => {
				});
			},

			getLatestNews : function () {
				this.$http.get(this.$env.get('APP_URI') + 'news').then(res => {
				   	this.latestNews = res.data.result
				}).catch(err => {

				});
			},

			getCountries : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/all').then(res => {
				  	this.countries = res.data.result.data
				}).catch(err => {

				});
			},

			getPinnedNews : function () {
				this.$http.get(this.$env.get('APP_URI') + 'news?type=pinned').then(res => {
				  	this.items = res.data.result
				  	this.setContext()
				}).catch(err => {

				});
			},

			setContext : function () {
                _.forEach(this.items, function (obj) {
                    obj.context = 'primary-slide'
                })
            }
		},
		components: {
			HorizontalSlide, Map, Marker, AlbumSlider
		}
	}
</script>
<style lang="scss">
</style>