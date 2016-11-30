<template>
	<div @click="browseAlbum(item.id)" class="album-slide-item">
		<div class="album-title-wrapper"> 
			<div class="album-title"> {{item.title}} <br/> <span> {{item.photos_count}} зураг</span>
			</div> 
		</div>
		<div class="cover-img">
			<img class="vertical" :src="item.pinned_photo[0].url"/> 
		</div>
	</div>

	<div :id="galleryId" class="blueimp-gallery blueimp-gallery-controls">
	    <div class="slides"></div>
	    <h3 class="title"></h3>
	    <a class="prev">‹</a>
	    <a class="next">›</a>
	    <a class="close">×</a>
	    <a class="play-pause"></a>
	    <ol class="indicator"></ol>
	</div>
</template>
<script>

	export default {
		props : {
			item: {
				required : true
			}
		},

		data () {
			return {
				blueimpInstance : {},
				galleryId : {}
			}
		},

		created : function () {
			this.galleryId = this.$tools.newId()
		},

		ready : function () {
			this.blueimpInstance = blueimp
		},

		methods : {
			browseAlbum : function (album_id) {
            	this.$http.get(this.$env.get('APP_URI') + 'album/' + album_id + '/photos').then(res => {
            		var slideItems = []
            		_.forEach(res.data.result, function (photo) {
            			slideItems.push({
            				title : photo.pivot.caption,
            				href: photo.url,
            				thumbnail : photo.url
            			})
            		});

            	  	blueimp.Gallery(	
            	  		slideItems, {
            	  			container : '#' + this.galleryId,
            	  		}
            	  	)
            	}).catch(err => {
            	  
            	});
            },	
		}

	}
</script>
<style lang="scss">

</style>