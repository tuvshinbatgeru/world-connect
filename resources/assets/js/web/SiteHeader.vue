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
							<a href="#albumContainer" @click="$root.anchorSmooth($event)">
								Зургийн цомог
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
								<form method="GET" action="/search">
									<input placeholder="Хайлт хийх ..." 
									   type="text" 
									   name="q"
									   @keyup.enter="submit"/>
								</form>
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
					<div id="hamburger" class="hamburglar is-closed" @click="burgerClick()">

					    <div class="burger-icon">
					      <div class="burger-container">
					        <span class="burger-bun-top"></span>
					        <span class="burger-filling"></span>
					        <span class="burger-bun-bot"></span>
					      </div>
					    </div>
					    
					    <!-- svg ring containter -->
					    <div class="burger-ring">
					      <svg class="svg-ring">
						      <path class="path" fill="none" stroke="#f50" stroke-miterlimit="10" stroke-width="4" d="M 34 2 C 16.3 2 2 16.3 2 34 s 14.3 32 32 32 s 32 -14.3 32 -32 S 51.7 2 34 2" />
					      </svg>
					    </div>
					    <!-- the masked path that animates the fill to the ring -->
					    
					 		<svg width="0" height="0">
					       <mask id="mask">
					    <path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ff0000" stroke-miterlimit="10" stroke-width="4" d="M 34 2 c 11.6 0 21.8 6.2 27.4 15.5 c 2.9 4.8 5 16.5 -9.4 16.5 h -4" />
					       </mask>
					     </svg>
					    <div class="path-burger">
					      <div class="animate-path">
					        <div class="path-rotation"></div>
					      </div>
					    </div>
					      
					  </div>

					 <div class="wc-nav-logo-horizontal">
						<img :src="siteLogoHorizontal" height="40" />
					</div>


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
				siteLogo : this.$env.get('APP_URI') + '/images/logo-wc-vertical.png',
				siteLogoHorizontal: this.$env.get('APP_URI') + '/images/logo-wc.png',
				isClosed : false
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
			},
			burgerClick : function () {
				if (this.isClosed == true) {
					$(".hamburglar").removeClass('is-open');
					$(".hamburglar").addClass('is-closed');
					$(".wc-content-nav ul").slideUp( "slow" );
					this.isClosed = false;
				} else {
					$(".hamburglar").removeClass('is-closed');
					$(".hamburglar").addClass('is-open');
					$(".wc-content-nav ul").slideDown( "slow" );
					this.isClosed = true;
				}
			}
		}
	}
</script>