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
</template>
<script>

	export default {
		props : {
			item: {
				required : true
			}
		},

	}
</script>
<style lang="scss">

</style>