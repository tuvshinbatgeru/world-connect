<template>
	<section class="header">
		<div class="cntr-fluid">
				<div class="wc-nav">
					<ul>
						<li>
							<a>
								Бидний тухай
							</a>
						</li>
						<li>
							<a>
								Холбоо барих
							</a>
						</li>
						<li>
							<div class="search-input">
								<i class="fa fa-search"></i>
								<input placeholder="Хайлт хийх ..." type="text" />
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="wc-nav-logo">
			<img :src="siteLogo" height="100" />
		</div>
		<hr class="header-seperator"></hr>
		<div class="sticky">
			<div class="cntr-fluid">
				<div class="wc-content-nav">
					<ul>
						<li :class="menu == 'main' ? 'active' : ''">
							<a href="/">Нүүр хуудас</a>
						</li>
						<li @mouseover="mouseOver('country')" @mouseout="mouseOut()" :class="menu == 'about' ? 'active' : ''">
							<a>Улсууд <i class="fa fa-sort-down"></i></a>
						</li>
						<li @mouseover="mouseOver('visa')" @mouseout="mouseOut()" :class="menu == 'visa' ? 'active' : ''">
							<a>Визний мэдээлэл <i class="fa fa-sort-down"></i></a>
						</li>
						<li @mouseover="mouseOver('schools')" @mouseout="mouseOut()">
							<a>Сургуулиуд</a>
						</li>
						<li @mouseover="mouseOver('english')" @mouseout="mouseOut()" :class="menu == 'study' ? 'active' : ''">
							<a href="/study">Англи хэлний сургалт</a>
						</li>
						<li @mouseover="mouseOver('scholar')" @mouseout="mouseOut()" :class="menu == 'scholar' ? 'active' : ''">
							<a href="/scholarship">Тэтгэлэгт хөтөлбөр</a>
						</li>
						<li :class="menu == 'information' ? 'active' : ''">
							<a href="/information">Мэдээлэл</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
			
			<div class="card-container" :class="hovered ? 'show' : ''" @mouseover="mouseOver('all')" @mouseout="mouseOut()">
				<div class="cntr-fluid">
					<div class="card country" v-for="country in countries" v-show="selectedMenu == 'country'">
						<div class="cover">
							<div class="cover-img">
								<img class="horizontal" :src="country.cover_url"/>
							</div>
							<a :href="'/country/' + country.id">
								<div class="title">
									{{country.name}}
								</div>
							</a>
						</div>
					</div>

					<div class="card country" v-for="country in countries" v-show="selectedMenu == 'visa'">
						<div class="cover">
							<div class="cover-img">
								<img class="horizontal" :src="country.cover_url"/>
							</div>
							<a :href="'/country/' + country.id + '?type=visa'">
								<div class="title">
									{{country.name}}
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
	export default {
		props : {
			menu : {
				required : true
			}
		},
		data () {
			return {
				countries : [],
				hovered : false,
				selectedMenu : {},
				siteLogo : this.$env.get('APP_URI') + '/images/logo-wc-vertical.png'
			}
		},	

		created : function () {
			this.getCountries()
			$(window).scroll(function(){
				var scroll = $(window).scrollTop();
				if (scroll >= 115)
					$('.sticky').addClass('fixed-header');
				else
					$('.sticky').removeClass('fixed-header');
			});
		},

		methods : {
			mouseOver : function (type) {
				this.hovered = true
				if(type != 'all')
					this.selectedMenu = type
			},

			mouseOut : function () {
				this.hovered = false
			},

			getCountries : function () {
				this.$http.get(this.$env.get('APP_URI') + 'country/site').then(res => {
				  	this.countries = res.data.result
				}).catch(err => {

				});
			}
		}
	}
</script>