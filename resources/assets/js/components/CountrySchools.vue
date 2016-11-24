<template>
	<div class="feed-container mini">
		<div class="feed-title">
			Сургуулиуд
			<div class="university-filter-list">
				<ul>
					<li @click="filter = 0" :class="filter == 0 ? 'active' : ''">
						Бүгд
					</li>
					<li @click="filter = 2" :class="filter == 2 ? 'active' : ''">
						Бакалавр
					</li>
					<li @click="filter = 3" :class="filter == 3 ? 'active' : ''">
						Магистр
					</li>
					<li @click="filter = 1" :class="filter == 1 ? 'active' : ''">
						Хэлний бэлтгэл
					</li>
				</ul>
			</div>
		</div>
		<div class="content-container small university" v-for="school in schools">
			<div class="cover-cntr">
				<div class="cover">
					<div class="cover-img">
						<img class="horizontal vertical" :src="school.cover_url"/>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="content-title">
					{{school.name}}
				</div>
				<div class="content-description">
					Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology
					Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology
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
				schools : [],
				filter : 0,
			}
		},

		created : function () {
			this.getSchools()
		},

		methods : {
			getSchools : function() {
				this.$http.get(this.$env.get('APP_URI') + 'country/' + this.country + '/schools?type=' + this.filter).then(res => {
				  	this.schools = res.data.result
				}).catch(err => {
				  	
				});
			}
		},

		watch : {
			filter : function (oldVal, newVal) {
				this.getSchools()
			}
		}
	}
</script>