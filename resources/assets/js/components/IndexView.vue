<template>
	<div style="width: 100%;">
		<horizontal-slide :slide-width="100" width-type="%" :step="1" :items="items">
                
    	</horizontal-slide>
	</div>
	
</template>
<script>
	import HorizontalSlide from './slider/HorizontalSlide.vue'

	export default {
		props : {
			
		},

		data () {
			return {
				items: {}
			}
		},

		ready : function () {
			this.setItem()
			this.setContext()
		},

		methods : {
			setItem : function () {
				this.items = [
					{title: 'АМЕРИКТ МАГИСТРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА',description: 'Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг' , img_url: 'images/1920/header.jpg', },
					{title: 'АМЕРИКТ МАГИСТРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА',description: 'Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг' , img_url: 'images/1920/blue.jpg'},
					{title: 'АМЕРИКТ МАГИСТРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА',description: 'Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг' , img_url: 'images/1920/red.jpg'}
				]
			},
			setContext : function () {
                _.forEach(this.items, function (obj) {
                    obj.context = 'primary-slide'
                })
            }
		},
		components: {
			HorizontalSlide
		}
	}
</script>
<style lang="scss">
</style>