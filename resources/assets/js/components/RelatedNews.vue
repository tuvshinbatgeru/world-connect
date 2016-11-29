<template>
	<div class="row margin-vertical">
		<div class="col-md-12">
			<h3>	
				Холбоотой мэдээллүүд
			</h3>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12" v-for="news in information">
			<div class="content-container card">
				<div class="cover-cntr">
					<div class="cover">
						<div class="cover-img">
							<img class="horizontal" :src="news.cover_url"/>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="content-title">
						<a :href="'/news/' + news.id">{{news.title}}</a>
					</div>
					<div class="content-description">
						{{news.info[0].description}}
					</div>
					<div class="content-info">
						<div class="row">
							<div class="col-xs-12 text-right">
								<span class="news-type">
									{{news.type | newsFilter}}
								</span>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props : {
			newsId : {
				required : true
			}
		},

		data () {
			return {
				information : []
			}
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
		}, 

		created : function () {
			this.getRelatedNews()
		},

		methods : {
			getRelatedNews : function () {
				this.$http.get(this.$env.get('APP_URI') + 'news/' + this.newsId + '/related').then(res => {
				  	this.information = res.data.result
				}).catch(err => {

				});
			}
		}
	}
</script>