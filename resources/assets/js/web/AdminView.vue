<script>
	import DashboardView from "../components/DashboardView.vue"
	import CountryView from "../components/CountryView.vue"
	import SchoolView from "../components/SchoolView.vue"

	export default {
		props : {
			title : {
				default : 'Admin'
			},
		},

		data () {
			return {
				menu : 'dashboard-view'
			}
		},

		methods : {
			setMenu : function (menu) {
				this.menu = menu
			},
			
			isMenu : function (menu) {
				return this.menu == menu ? 'active' : ''
			}
		},
		components : {
			DashboardView, CountryView, SchoolView
		}
	}
</script>