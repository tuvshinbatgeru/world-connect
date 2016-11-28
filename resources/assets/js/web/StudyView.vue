<script>
	import Paginateable from '../mixins/Paginateable'

	export default {
		props : {
			title : {
				default : ''
			},
		},

		mixins : [
			Paginateable
		],

		data () {
			return {
				studies : []
			}
		},

		created : function () {
			this.getStudies()
		},

		methods : {
			pageChanged : function (page) {
				this.pageIndex = page
				this.getStudies()
			},

			getStudies : function () {
				this.$http.get(this.$env.get('APP_URI') + 'study/all?page=' + this.pageIndex).then(res => {
				  	this.studies = res.data.result.data
				  	this.total = res.data.result.total
				}).catch(err => {

				});
			}
		}
	}
</script>