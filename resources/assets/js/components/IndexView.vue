<script>
	import HorizontalSlide from './slider/HorizontalSlide.vue'
	import {load, Map, Marker} from 'vue-google-maps'

	load('AIzaSyAyp07nE48nqIoKE1ndd-6CizmYdBBBWnQ','3.24')

	export default {
		props : {
			
		},

		data () {
			return {
				items: [],
				pinnedNews : [],
				countries : [],
				schools : [],
				latestNews : [],
				xanshs : [],
              	albums: [],
              	masonryContainer : null
			}
		},

		created : function () {
			this.getPinnedNews()
			this.getCountries()
			this.getLatestNews()
			this.getSchools()
			this.getHanshNews()
			this.getAlbums()
		},

		ready : function () {
			this.setContext()
			this.masonryContainer = $('#container').masonry({
			    itemSelector: '.item',
			    columnWidth: 200,
			    gutter: 2
			});
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
			}
		},

		methods : {
            getAlbums : function () {
            	this.$http.get(this.$env.get('APP_URI') + 'album').then(res => {
            	  	this.albums = res.data.result
            	  	this.calcMasonry()
            	}).catch(err => {
            	});
            },

            browseAlbum : function (album_id) {
            	$('#albumSlide').modal('toggle');
            },	

            getMasonryItems : function () {
				var items = ''

				_.forEach(this.albums, function (album) {
				  		items += 
				  		'<div @click="browseAlbum(' + album.id + ')" class="item">'
				  			+ '<div class="album-title-wrapper"> <div class="album-title">Байгалийн зураг <br/> <span>8 зураг</span></div> </div>'
				  			+ '<img src="' + album.pinned_photo[0].url + '"/>' 
				    	+ '</div>'	
				})

			  	return $( items )
            },

            calcMasonry : function () {
            	var $items = this.getMasonryItems()
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

			getHanshNews : function () {
				this.$http.get('http://monxansh.appspot.com/xansh.json?currency=USD|EUR|JPY|GBP|RUB|CNY|KRW').then(res => {
					this.xanshs = res.body
				}).catch(err => {
				  console.log(err);
				});
			},

			getSchools : function () {
				this.$http.get(this.$env.get('APP_URI') + 'school').then(res => {
				   this.schools = res.data.result
				}).catch(err => {
				});
			},

			getLatestNews : function () {
				this.$http.get(this.$env.get('APP_URI') + 'news').then(res => {
				   	this.latestNews = res.data.result
				}).catch(err => {

				});
			},

			getCountries : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/list').then(res => {
				  	this.countries = res.data.result.data
				}).catch(err => {

				});
			},

			getPinnedNews : function () {
				this.$http.get(this.$env.get('APP_URI') + 'news?type=pinned').then(res => {
				  	this.items = res.data.result
				  	this.setContext()
				}).catch(err => {

				});
			},

			setContext : function () {
                _.forEach(this.items, function (obj) {
                    obj.context = 'primary-slide'
                })
            }
		},
		components: {
			HorizontalSlide, Map, Marker, 
		}
	}
</script>
<style lang="scss">
</style>