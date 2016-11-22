<script>
	import ModifyAlbum from './modified/ModifyAlbum.vue'
	import Paginateable from '../mixins/Paginateable'

	export default {
		mixins : [Paginateable],
		props : {
			title : {},
		},

		data () {
			return {
				albums : [],
				showAlbumModify : false,
				selectedAlbum : {},
				albumInstance : {},
				country : 0,
				countries : [],
				selectedFilter : 'newest',
				filters : [{
					type : 'newest',
					label : 'Сүүлд нэмсэн',
				},{
					type : 'most',
					label : 'Олон зурагтай',
				}]
			}
		},

		created : function () {
			this.getAlbums()
			this.getCountryNames()
		},

		methods : {
			setFilter : function (filter) {
				this.selectedFilter = filter.type
				this.getAlbums()
			},

			getCountryNames : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/select').then(res => {
					this.countries = res.data.result
				}).catch(err => {
				});
			},

			pageChanged : function (page) {
				this.pageIndex = page
				this.getAlbums()
			},

			getAlbums : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/album/list?page=' + this.pageIndex + 
					'&filter=' + this.selectedFilter + '&country=' + this.country).then(res => {
				  	this.albums = res.data.result.data
				  	this.total = res.data.result.total
				}).catch(err => {
				});
			},

			cancelAlbum : function () {
				this.showAlbumModify = false
			},

			editAlbum : function (data) {
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/album/' 
					+ this.selectedAlbum.id + '?data=' + data.param
				).then(res => {
					if(res.data.code == 0) {
						this.albumInstance.title = res.data.result.title
						this.albumInstance.photos_count = res.data.result.photos_count

						this.albumInstance.pinned_photo = res.data.result.pinned_photo

						this.albumInstance.country.name = res.data.result.country.name

						this.showAlbumModify = false		
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

			saveAlbum : function (data) {
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/album?data=' + data.param
				).then(res => {
					if(res.data.code == 0) {
						this.albums.push(res.data.result)
						this.showAlbumModify = false		
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

			newAlbum: function () {
				this.showAlbumModify = true
				this.selectedAlbum = null
			},

			setAlbum : function (album) {
				this.selectedAlbum = album
			},

			updateAlbum : function (album) {
				this.albumInstance = album
				this.$http.get(this.$env.get('APP_URI') + 'admin/album/' + album.id + '/edit').then(res => {
				  	this.selectedAlbum = res.data.result
				  	this.showAlbumModify = true
				}).catch(err => {

				});
			},

			deleteAlbum : function () {
				this.$http.delete(this.$env.get('APP_URI') + 'admin/album/' + this.selectedAlbum.id).then(res => {
					if(res.data.code == 0) {
						this.albums.$remove(this.selectedAlbum)
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
			country : function (oldVal, newVal) {
				this.getAlbums()
			}
		},

		components : {
			ModifyAlbum
		}
	}
</script>