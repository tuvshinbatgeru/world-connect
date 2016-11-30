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
			},
		},

		created : function () {
			this.getInformation()
		},

		methods : {
			pageChanged : function (page) {
				this.pageIndex = page
				this.getInformation()
			},

			getInformation : function () {
				this.$http.get(this.$env.get('APP_URI') + 'information/all?page=' + this.pageIndex).then(res => {
				  	this.information = res.data.result.data
				  	this.total = res.data.result.total
				}).catch(err => {

				});
			}
		}
	}
</script>