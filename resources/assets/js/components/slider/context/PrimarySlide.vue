<template>
	<div class="slide" :style="'background-image:url(' + item.cover_url + ')'">
		<div class="cntr-fluid relative">
			<div class="social-container">
				Хуваалцах <i class="fa fa-facebook-official"></i> <i class="fa fa-twitter-square"></i>
			</div>
			<div class="news-container">
				<div class="news-title">
					{{item.title}}
				</div>
				<div class="news-description">
					{{item.info[0].description}}
				</div>
				<a class="news-type">
					{{item.type | newsFilter}}
				</a>
			</div>
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
		}

	}
</script>
<style lang="scss">
.slide {
	width: 100%;background-size: cover;
	background-position: center;
	height: 475px;
}
.relative {
	position: relative !important;
	height: 100%;
}
.news-container {
	position: absolute;
	bottom: 80px;
	width: 730px;
	text-shadow: 0px 2px 6px #000000;
	.news-title {
		margin: 10px 0px;
		font-size: 20px;
		font-weight: 800;	
	}
	.news-description {
		margin: 10px 0px;
		font-size: 15px;
	}
	
}
.social-container {
	top: 75px;
	font-size: 17px;
	font-weight: 800;
	color: #fff;
	position: absolute;
	i {
		font-size: 20px;
		cursor: pointer;
		margin-right: 10px;
		&.fa-facebook-official {
			color: #3b5998;
		}
		&.fa-twitter-square {
			color: #68c4e2;
		}
		&:first-child {
			margin-left: 30px;
		}
	}
}
</style>