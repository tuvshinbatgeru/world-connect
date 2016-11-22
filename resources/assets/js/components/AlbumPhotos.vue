<template>
	<form enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
				<label for="newFile" class="btn btn-info btn-fill"><i class="fa fa-camera"></i>Зураг нэмэх</label>
				<br/>
				<input style="display:none" id="newFile" name="logo" type="file" multiple/>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" v-for="photo in photos">
				<div class="form-group">
					<a @click="deletePhoto(photo)"><i style="color:red" class="fa fa-trash"></i></a>
					<img :src="photo.url" style="height:50px; width:50px;" />
					<div class="form-group">
						<label class="checkbox-inline">
							<input type="checkbox" 
								v-model="pinned"
								v-bind:true-value="photo"
								v-bind:false-value="null"
								>Нүүр зураг болгох
						</label>
					</div>
					<textarea class="form-control" 
							  style="resize: none; color: #666666" 
							  rows="2" 
							  cols="43"
							  v-model="photo.pivot.caption" 
							  placeholder="товч утга оруулах ...">
					</textarea>
				</div>
			</div>
		</div>
	</form>
</template>
<script>
	export default {
		data () {
			return {
				photos : [],
				pinned : null
			}
		},

		ready : function () {
			var vm = this
			$("#newFile").change(function(){
		        vm.fileUploaded(this)
		    })
		},

		methods : {
			getPhotos : function () {
				var vm = this
				_.forEach(this.photos, function (photo) {
					photo.pivot.pinned = 0
					if(photo.id === vm.pinned.id)
						photo.pivot.pinned = 1
				})

				return this.photos
			},

			setPhotos : function (photos) {
				var vm = this
				this.photos = photos
				this.pinned = _.find(this.photos, function (photo) {
					return photo.pivot.pinned == 1
				})
			},

			deletePhoto : function (photo) {
				this.$http.delete(this.$env.get('APP_URI') + 'admin/album/photo/' + photo.id).then(res => {
					this.photos.$remove(photo)
					if(this.photos.length == 0 || this.pinned.id == photo.id) {
						this.pinned = null
					}
				}).catch(err => {
				});
			},

			upload : function (file) {
				var fd = new FormData()
				fd.append('file', file)

				this.$http.post(this.$env.get('APP_URI') + 'admin/album/photo', fd).then(res => {
					var obj = res.data.result
					Vue.set(obj, 'pivot', {
						'caption' : '',
						'pinned' : 0,
					})

					this.photos.push(obj)
					
					if(!this.pinned) {
						this.pinned = this.photos[0]
					}
				}).catch(err => {

				});
			},

			fileUploaded : function (input) {
				var vm = this
				_.forEach(input.files, function (file) {
					vm.upload(file)
				})
			}
		},
	}
</script>
<style lang="scss">
	
</style>