<script>
	import HorizontalSlide from './slider/HorizontalSlide.vue'

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
			}
		},

		created : function () {
			this.getPinnedNews()
			this.getCountries()
			this.getLatestNews()
			this.getSchools()
		},

		ready : function () {
			this.setItem()
			this.setContext()
		},

		methods : {
			getSchools : function () {

			},

			getLatestNews : function () {

			},

			getCountries : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/list').then(res => {
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

			setItem : function () {
				this.items = [
					{title: 'АМЕРИКТ МАГИСТРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА',description: 'Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг' , img_url: 'images/sidebar-5.jpg', },
					{title: 'АМЕРИКТ МАГИСТРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА',description: 'Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг' , img_url: 'images/1920/blue.jpg'},
					{title: 'АМЕРИКТ МАГИСТРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА',description: 'Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг' , img_url: 'images/1920/red.jpg'}
				]
			},
			setContext : function () {
                _.forEach(this.items, function (obj) {
                    obj.context = 'primary-slide'
                })
            }
		},
		components: {
			HorizontalSlide
		}
	}
</script>
<style lang="scss">
</style>