<script>
	import CountrySchools from '../components/CountrySchools.vue'
	import CountryNews from '../components/CountryNews.vue'
	import CountryScholarship from '../components/CountryScholarship.vue'

	export default {
		props : {
			title : {
				default : ''
			},

			type : {

			}
		},

		data () {
			return {
				menu : 'dashboard-view'
			}
		},

		methods : {
			setType : function (type) {
				this.type = type
			}
		},

		components : {
			CountrySchools, CountryNews, CountryScholarship
		}
	}
</script>