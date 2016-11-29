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
				information : []
			}
		},

		created : function () {
			this.getScholarships()
		},

		methods : {
			pageChanged : function (page) {
				this.pageIndex = page
				this.getScholarships()
			},

			getScholarships : function () {
				this.$http.get(this.$env.get('APP_URI') + 'scholarship/all?page=' + this.pageIndex).then(res => {
				  	this.information = res.data.result.data
				  	this.total = res.data.result.total
				}).catch(err => {

				});
			}
		}
	}
</script>