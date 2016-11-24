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

		<div class="content-container" :class="$index == 0 ? '' : 'small'" v-for="news in information">
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
						<label class="date">
							{{news.created_at | moment 'from'}}
						</label>
					</div>
					<div class="content-description">
						{{news.info[0].description}}
					</div>
					<div class="content-info">
						<div class="row">
							<div class="col-xs-6">
								<span class="share social-share facebook">
									SHARE
								</span>
								<span class="tweet social-share twitter">
									TWEET
								</span>
							</div>
							<div class="col-xs-6 text-right">
								<span class="view">
									<i class="fa fa-eye"></i> {{news.visit_count}}
								</span>
								<span class="news-type">
									{{news.type | newsFilter}}
								</span>
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