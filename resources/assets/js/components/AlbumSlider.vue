<template>
	<horizontal-slide :slide-width="230" :slide-height="350" width-type="px" :step="1" :items="albums" :bullet="0">

	<div class="content-container">
		<div id="container" class="margin-vertical">
		</div>

		<div id="blueimp-gallery" class="blueimp-gallery">
		    <div class="slides"></div>
		    <h3 class="title"></h3>
		    <a class="prev">‹</a>
		    <a class="next">›</a>
		    <a class="close">×</a>
		    <a class="play-pause"></a>
		    <ol class="indicator"></ol>
		</div>

	</div>
</template>
<script>
	import HorizontalSlide from './slider/HorizontalSlide.vue'
	export default {
		props : {
			countryId : {
				default : 0
			}
		},

		data () {
			return {
				albums : [],
				blueimpInstance : {},
				masonryContainer : {}
			}
		},

		created : function () {
			this.getAlbums()
			
		},

		ready : function () {
			this.blueimpInstance = blueimp
			this.masonryContainer = $('#container').masonry({
			    itemSelector: '.item',
			    columnWidth: 200,
			    gutter: 2
			});
		},

		methods : {
			getAlbums : function () {
            	this.$http.get(this.$env.get('APP_URI') + 'album?country=' + this.countryId).then(res => {
            	  	this.albums = res.data.result
            	  	this.calcMasonry()
            	}).catch(err => {
            	});
            },

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

            	  	blueimp.Gallery(slideItems)
            	}).catch(err => {
            	  
            	});
            },	

            getMasonryItems : function () {
				var items = ''

				_.forEach(this.albums, function (album) {
				  		items += 
				  		'<div @click="browseAlbum(' + album.id + ')" class="item">'
				  			+ '<div class="album-title-wrapper"> <div class="album-title">' + album.title +'<br/> <span>' + album.photos_count + ' зураг</span></div> </div>'
				  			+ '<img src="' + album.pinned_photo[0].url + '"/>' 
				    	+ '</div>'	
				})

			  	return $( items )
            },

            calcMasonry : function () {
            	var $items = this.getMasonryItems()
            	this.setContext()
                var msnry = this.masonryContainer.data('masonry');
			    var itemSelector = msnry.options.itemSelector;
			  	// hide by default
			  	$items.hide();
			    // append to container
			    var element = this.masonryContainer.append( $items )

			    this.$compile(element.get(0))

			    $items.imagesLoaded().progress( function( imgLoad, image ) {
			    var $item = $( image.img ).parents( itemSelector );
			    $item.show();
			    msnry.appended( $item );
			  });
            },
            setContext : function () {
                _.forEach(this.albums, function (obj) {
                    obj.context = 'album-slide'
                })
            }
		},

		components : {
			HorizontalSlide
		}
	}
</script>