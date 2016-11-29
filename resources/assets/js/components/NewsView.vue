<script>
	import ModifyNews from './modified/ModifyNews.vue'
	import Paginateable from '../mixins/Paginateable'

	export default {
		mixins : [Paginateable],
		props : {
			title : {},
		},

		data () {
			return {
				information : [],
				showNewsModify : false,
				selectedNews : {},
				newsInstance : {},
				type : 0,
				searchValue : ''
			}
		},

		ready : function () {
			$('#searchValue')[0].focus()
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

			stateFilter : function (value) {
				if(value == 'Y') return 'Онцолсон'
				return 'Энгийн'
			}
		},

		methods : {
			searchAsString : function () {
				this.getNews()
			},

			togglePin : function (news) {
				this.$http.post(this.$env.get('APP_URI') + 'news/' + news.id + '/pinned').then(res => {
				  	news.is_pinned = res.data.result
				}).catch(err => {
				});
			},

			typeChanged : function () {
				this.$refs.paginate.resetPage()
				this.getNews()
			},

			pageChanged : function (page) {
				this.pageIndex = page
				this.getNews()
			},

			getNews : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/news/all?page=' + this.pageIndex + 
					(this.type != 0 ? '&type=' + this.type : '') + '&search=' + this.searchValue).then(res => {
				  	this.information = res.data.result.data
				  	this.total = res.data.result.total
				}).catch(err => {
				});
			},

			cancelNews : function () {
				this.showNewsModify = false
			},

			editNews : function (data) {
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/news/' 
					+ this.selectedNews.id + '?data=' + data.param, 
					data.formData
				).then(res => {
					if(res.data.code == 0) {
						this.newsInstance.title = res.data.result.title
						this.newsInstance.type = res.data.result.type

						this.showNewsModify = false		
						this.$root.$refs.notify.notify(res.data.message,{
							closeable : false
						})
					}
				}).catch(err => {
					this.$root.$refs.notify.notify('Хадгалах явцад алдаа.',{
						closeable : false
					})
				});
			},

			saveNews : function (data) {
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/news', data.formData
				).then(res => {
					if(res.data.code == 0) {
						this.information.push(res.data.result)

						this.showNewsModify = false		
						this.$root.$refs.notify.notify(res.data.message,{
							closeable : false
						})
					}
				}).catch(err => {
					this.$root.$refs.notify.notify('Хадгалах явцад алдаа.',{
						closeable : false
					})
				});
			},

			newNews: function () {
				this.showNewsModify = true
				this.selectedNews = null
			},

			setNews : function (news) {
				this.selectedNews = news
			},

			updateNews : function (news) {
				this.newsInstance = news
				this.$http.get(this.$env.get('APP_URI') + 'admin/news/' + news.id + '/edit').then(res => {
				  	this.selectedNews = res.data.result
				  	this.showNewsModify = true
				}).catch(err => {

				});
			},

			deleteNews : function () {
				this.$http.delete(this.$env.get('APP_URI') + 'admin/news/' + this.selectedNews.id).then(res => {
					if(res.data.code == 0) {
						this.information.$remove(this.selectedNews)
					}

					this.$root.$refs.notify.notify(res.data.message,{
						closeable : false
					})

				}).catch(err => {
					this.$root.$refs.notify.notify("Устгах явцад алдаа гарлаа.",{
						closeable : false
					})
				})
			},
		},

		watch : {
			type : function (old, val) {
//				this.getNews()
			}
		},

		components : {
			ModifyNews
		}
	}
</script>
<style type="text/css">
	.fa {
		font-size: 24px;
		text-align: center;
	}
</style>