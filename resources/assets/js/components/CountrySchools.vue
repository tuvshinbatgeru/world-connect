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
		<div class="content-container no-hover">
			<div class="row">
				<div class="col-md-4" v-for="school in schools">
					<div class="school-card" @click="showDetail(school)">
						<div class="school-img">
							<div class="cover-img">
								<img class="horizontal" :src="school.cover_url"/>
							</div>
							<div class="school-img-hover">
								<i class="fa fa-search"></i>
							</div>
						</div>
						<div class="school-title-wrapper">
							<div class="school-title">
								{{school.name}}	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="schoolInfo" class="modal" data-easein="fadeIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	      	<div class="cntr-fluid">
	      		<div class="school-info">
	            	{{{selectedSchool.info[0].content}}}
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
				selectedSchool : {}
			}
		},

		created : function () {
			this.getSchools()
		},

		methods : {
			showDetail : function (school) {
				this.selectedSchool = school
				$('#schoolInfo').modal('toggle')
			},

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
<style lang="scss">

.modal {
	padding-right: 0px;
	padding-top: 30px;
	padding-bottom: 30px;
}
.cntr-fluid {
	height: 100%;
}
.school-info {
	width: 100%;
	height: 100%;
	background-color: #fff;
	p {
		height: 100%;
	}
}

</style>