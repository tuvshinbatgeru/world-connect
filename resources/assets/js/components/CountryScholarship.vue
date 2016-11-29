<template>
	<div class="col-md-9 col-xs-12 no-padding">
		<div class="feed-container mini">
			<div class="feed-title">
				Тэтгэлэг
			</div>
			<div class="content-container no-hover" v-for="ship in scholerships">
				<div class="cover-cntr">
					<div class="cover">
						<div class="cover-img">
							<img class="horizontal" :src="ship.cover_url"/>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="content-title">
						<a :href="'/news/' + ship.id">{{ship.title}}</a>
						<label class="date">
							{{ship.created_at | moment 'from'}}
						</label>
					</div>
					<div class="content-description">
						{{ship.info[0].description}}
					</div>
					<div class="content-info">
						<div class="row">
							<div class="col-xs-12 text-right">
								<span class="view">
									<i class="fa fa-eye"></i> {{ship.visit_count}}
								</span>
								<span class="news-type">
									Тэтгэлэг
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
			country : {
				required : true
			},
		},

		data () {
			return {
				scholerships : [],
			}
		},

		created : function () {
			this.getScholerShips()
		},

		methods : {
			getScholerShips : function() {
				this.$http.get(this.$env.get('APP_URI') + 'country/' + this.country + '/news?type=2').then(res => {
				  	this.scholerships = res.data.result
				}).catch(err => {
				  	
				});
			}
		},
	}
</script>