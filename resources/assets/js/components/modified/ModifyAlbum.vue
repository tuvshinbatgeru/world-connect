<template>
	<div class="row" id="country-panel" >
		<div class="col-md-12">
			<div class="card">
				<div class="header">
					<h4 class="title"> Цомог нэмэх
					</h4>
				</div>
				<div class="content">
					<form enctype="multipart/form-data">
						<div id="album-name" class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Цомгийн гарчиг</label>
									<input class="form-control" v-model="album.title" type="text" placeholder="Цомгийн гарчиг">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Улс сонгох</label>
									<select class="form-control" v-model="album.country">
										<option value="0" selected>улс сонгох</option>
								        <option v-for="country in countries" :value="country.id">
								        	{{country.name}}
								        </option>
								    </select>
								</div>
							</div>
						</div>

						<album-photos v-ref:album></album-photos>

						<a @click="save()" class="btn btn-info btn-fill pull-right">Хадгалах</a>
						<a @click="cancel()" class="btn btn-info btn-fill pull-right" style="margin-right: 5px;">Буцах</a>
						<div class="clearfix"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props : {
			editable : {}
		},

		data () {
			return {
				album : {
					title : '',
					country : 0,
				},
				countries : []
			}
		},

		created : function () {
			this.getCountryNames()
		},

		ready : function () {
			var vm = this

			$.ajaxSetup({
		        headers: {
		        	'X-CSRF-TOKEN': $('#_token').attr('value') 
		        }
	        })

		    if(this.editable) {
				this.setData()
			}
		},

		methods : {
			getCountryNames : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/select').then(res => {
					this.countries = res.data.result
				}).catch(err => {
				});
			},

			setData : function () {
				var vm = this
				this.album.title = this.editable.title
				this.album.country = this.editable.country_id
				this.$refs.album.setPhotos(this.editable.photos)
			},

			cancel : function () {
				this.$emit('cancel')
			},

			save : function () {
				if(!this.album.title.trim()) {
					this.$root.$refs.notify.notify('Цомгийн гарчиг оруулна уу!', {
						closeable : false
					})
		            return
				}

				if (this.$refs.album.photos.length == 0) {
					this.$root.$refs.notify.notify('Зураг оруулна уу!', {
						closeable : false
					})
					return
				}

				if (this.$refs.album.pinned === null) {
					this.$root.$refs.notify.notify('Цомгийн нүүр зургийг сонгоно уу!', {
						closeable : false
					})
					return
				}

				this.$http.get(this.$env.get('APP_URI') + 'admin/album/check?title=' + this.album.title).then(res => {
				  	if(res.data.code == 0 || (this.editable && this.editable.title == this.album.title)) {
						var data = {
							album : this.album,
							pinned : this.$refs.album.pinned,
							param : this.$tools.transformParameters({
								album_title : this.album.title,
								country_id : this.album.country,
								photos : this.$refs.album.getPhotos(),
					    	})
						};


						if(this.editable)
							this.$emit('update', data)
						else
							this.$emit('save', data)  		
						return
				  	}

				  	this.$root.$refs.notify.notify(res.data.message, {
						closeable : false
					})
				}).catch(err => {
				  
				});
			}
		}
	}
</script>
<style lang="scss">
	.flag--temp {
		width: 150px;
		height: 100px;
	}
	.back--temp {
		width: 100%;
	}
	#backId {
		display: none;
	}
	#flagId {
		display: none;
	}
	.navbarr-fixed {
  		position: fixed;
	}

</style>