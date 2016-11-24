<template>
	<div class="feed-container mini">
		<div class="feed-title">
			Мэдээнүүд
			<div class="university-filter-list">
				<ul>
					<li @click="filter = 0" :class="filter == 0 ? 'active' : ''">
						Бүгд
					</li>
					<li @click="filter = 1" :class="filter == 1 ? 'active' : ''">
						Мэдээлэл
					</li>
					<li @click="filter = 3" :class="filter == 3 ? 'active' : ''">
						Тэтгэлэг
					</li>
					<li @click="filter = 2" :class="filter == 2 ? 'active' : ''">
						Зар
					</li>
				</ul>
			</div>
		</div>
		<div class="content-container small university" v-for="news in information">
			<div class="cover-cntr">
				<div class="cover">
					<div class="cover-img">
						<img class="horizontal vertical" :src="news.cover_url"/>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="content-title">
					{{news.title}}
				</div>
				<div class="content-description">
					{{news.info[0].description}}
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props : {
			country : {
				required : true
			},
		},

		data () {
			return {
				information : [],
				filter : 0,
			}
		},

		created : function () {
			this.getNews()
		},

		methods : {
			getNews : function() {
				this.$http.get(this.$env.get('APP_URI') + 'country/' + this.country + '/news?type=' + this.filter).then(res => {
				  	this.information = res.data.result
				}).catch(err => {
				  	
				});
			}
		},

		watch : {
			filter : function (oldVal, newVal) {
				this.getNews()
			}
		}
	}
</script>