<!doctype html>
<html>
<head>
    @include('includes.resource')
    @include('includes.index-header')
</head>
<body>
	<section class="header">
		<div class="cntr-fluid table--display">
			<div class="table--row">
				<div class="wc-nav-logo table--cell">
					<img src="{{ asset('images/logo-wc.png') }}" height="50" />
				</div>
				<div class="wc-nav table--cell">
					<ul>
						<li class="active">
							<a>
								Нүүр хуудас
							</a>
						</li>
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
					</ul>
				</div>
				<div class="search table--cell">
					<div class="search-input">
						<i class="fa fa-search"></i>
						<input placeholder="Хайлт хийх ..." type="text" />
					</div>
				</div>
			</div>
		</div>
		<hr class="header-seperator"></hr>
		<div class="cntr-fluid">
			<div class="wc-content-nav">
				<ul>
					<li>
						<a>Зуучлах улсууд</a>
					</li>
					<li>
						<a>Сургуулиуд</a>
					</li>
					<li>
						<a>Тэтгэлэгт хөтөлбөр</a>
					</li>
					<li>
						<a>Визний мэдээлэл</a>
					</li>
					<li>
						<a>Англи хэлний сургалт</a>
					</li>
					<li>
						<a>Мэдээлэл</a>
					</li>
				</ul>
				<div class="clearfix"></div>
				<div class="card-container">
					<div class="card country">
						<div class="picture" style="background-image: url({{asset('images/sydney-opera.jpg')}});">
						</div>
						<div class="title">
							<label> <img src="{{asset('images/aus-flag.png')}}" height="15" /> Австрали</label>
						</div>
					</div>
					<div class="card country">
						<div class="picture" style="background-image: url({{asset('images/sydney-opera.jpg')}});">
						</div>
						<div class="title">
							<label> <img src="{{asset('images/aus-flag.png')}}" height="15" /> Австрали</label>
						</div>
					</div>
					<div class="card country">
						<div class="picture" style="background-image: url({{asset('images/sydney-opera.jpg')}});">
						</div>
						<div class="title">
							<label> <img src="{{asset('images/aus-flag.png')}}" height="15" /> Австрали</label>
						</div>
					</div>
					<div class="card country">
						<div class="picture" style="background-image: url({{asset('images/sydney-opera.jpg')}});">
						</div>
						<div class="title">
							<label> <img src="{{asset('images/aus-flag.png')}}" height="15" /> Австрали</label>
						</div>
					</div>
					<div class="card country">
						<div class="picture" style="background-image: url({{asset('images/sydney-opera.jpg')}});">
						</div>
						<div class="title">
							<label> <img src="{{asset('images/aus-flag.png')}}" height="15" /> Австрали</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		@yield('content')
		<index-view>
		</index-view>
		<!-- country card start -->
		<div class="white-full">
			<div class="cntr-fluid">
				<div class="row">
					<div class="col-md-12 text-center card-title">
						<i class="fa fa-address-card-o"></i> ЗУУЧЛАХ УЛС ОРНУУД
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="flip-card country">
							<div class="cover">
								<div class="cover-img">
									<img class="vertical" src="{{asset('images/canada-mountain.jpg')}}"/>
								</div>
								<div class="title">
									<div class="globe">
										<i class="fa fa-globe"></i>
									</div>
									<a>Канад</a>
									<img src="{{asset('images/site/flip-card-arrow.png')}}" />
								</div>
								<div class="cover-content">
									<div class="cover-content-background">
										<div class="content-title">
											<a>Канад</a>
										</div>
										<div class="cover-content-nav">
											<ul>
												<li><a> <i class="fa fa-flag"></i> Канад улсын тухай </a></li>
												<li><a> <i class="fa fa-mortar-board"></i> Боловсролын систем </a></li>
												<li><a> <i class="fa fa-flag"></i> Визний мэдээлэл </a></li>
												<li><a> <i class="fa fa-flag"></i> Сургуулиуд </a></li>
												<li><a> <i class="fa fa-mortar-board"></i> Тэтгэлэг </a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="flip-card country">
							<div class="cover">
								<div class="cover-img">
									<img class="vertical" src="{{asset('images/sydney-opera.jpg')}}"/>
								</div>
								<div class="title">
									<div class="globe">
										<i class="fa fa-globe"></i>
									</div>
									<a>Австрали</a>
									<img src="{{asset('images/site/flip-card-arrow.png')}}" />
								</div>
								<div class="cover-content">
									<div class="cover-content-background">
										
										<div class="content-title">
											<a>Австрали</a>
										</div>
										<div class="cover-content-nav">
											<ul>
												<li><a> <i class="fa fa-flag"></i> Австрали улсын тухай </a></li>
												<li><a> <i class="fa fa-mortar-board"></i> Боловсролын систем </a></li>
												<li><a> <i class="fa fa-flag"></i> Визний мэдээлэл </a></li>
												<li><a> <i class="fa fa-flag"></i> Сургуулиуд </a></li>
												<li><a> <i class="fa fa-mortar-board"></i> Тэтгэлэг </a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="flip-card country">
							<div class="cover">
								<div class="cover-img">
									<img class="vertical" src="{{asset('images/america-cover.jpg')}}"/>
								</div>
								<div class="title">
									<a>Америк</a>
									<img src="{{asset('images/site/flip-card-arrow.png')}}" />
									<div class="globe">
										<i class="fa fa-globe"></i>
									</div>
								</div>
								<div class="cover-content">
									<div class="cover-content-background">
										<div class="content-title">
											<a>Америк</a>
										</div>
										<div class="cover-content-nav">
											<ul>
												<li><a> <i class="fa fa-flag"></i> Америк улсын тухай </a></li>
												<li><a> <i class="fa fa-mortar-board"></i> Боловсролын систем </a></li>
												<li><a> <i class="fa fa-flag"></i> Визний мэдээлэл </a></li>
												<li><a> <i class="fa fa-flag"></i> Сургуулиуд </a></li>
												<li><a> <i class="fa fa-mortar-board"></i> Тэтгэлэг </a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="flip-card country">
							<div class="cover">
								<div class="cover-img">
									<img class="vertical" src="{{asset('images/england-cover.jpg')}}"/>
								</div>
								<div class="title">
									<a>Англи</a>
									<img src="{{asset('images/site/flip-card-arrow.png')}}" />
									<div class="globe">
										<i class="fa fa-globe"></i>
									</div>
								</div>
								<div class="cover-content">
									<div class="cover-content-background">
										<div class="content-title">
											<a>Англи</a>
										</div>
										<div class="cover-content-nav">
											<ul>
												<li><a> <i class="fa fa-flag"></i> Англи улсын тухай </a></li>
												<li><a> <i class="fa fa-mortar-board"></i> Боловсролын систем </a></li>
												<li><a> <i class="fa fa-flag"></i> Визний мэдээлэл </a></li>
												<li><a> <i class="fa fa-flag"></i> Сургуулиуд </a></li>
												<li><a> <i class="fa fa-mortar-board"></i> Тэтгэлэг </a></li>
											</ul>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- country card end -->
		<div class="cntr-fluid">	
			<div class="row margin-vertical">
				<div class="col-md-9">
					<div class="feed-container">
						<div class="feed-title">
							СҮҮЛД НЭМЭГДСЭН МЭДЭЭЛЭЛ
						</div>
						<div class="content-container">
							<div class="cover">
								<div class="cover-img">
									<img class="horizontal" src="{{asset('images/america-cover.jpg')}}"/>
								</div>
							</div>
							<div class="content">
								<div class="content-title">
									АМЕРИКТ МАГИСТРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА
									<label class="date">
										11 сарын 19, 2016
									</label>
								</div>
								<div class="content-description">
									Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг
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
												<i class="fa fa-eye"></i> 4212
											</span>
											<span class="like">
												<i class="fa fa-heart"></i> 512
											</span>
											<span class="news-type">
												ТЭТГЭЛЭГ
											</span>
										</div>	
									</div>
								</div>
							</div>
						</div>
						<div class="content-container small">
							<div class="cover-cntr">
								<div class="cover">
									<div class="cover-img">
										<img class="horizontal" src="{{asset('images/england-cover.jpg')}}"/>
									</div>
								</div>
							</div>
							<div class="content">
								<div class="content-title">
									АНГЛИД БАКЛАВРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА
									<label class="date">
										11 сарын 19, 2016
									</label>
								</div>
								<div class="content-description">
									Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын
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
												<i class="fa fa-eye"></i> 4212
											</span>
											<span class="like">
												<i class="fa fa-heart"></i> 512
											</span>
											<span class="news-type">
												ТЭТГЭЛЭГ
											</span>
										</div>	
									</div>
								</div>
							</div>
						</div>
						<div class="content-container small">
							<div class="cover-cntr">
								<div class="cover">
									<div class="cover-img">
										<img class="horizontal" src="{{asset('images/england-cover.jpg')}}"/>
									</div>
								</div>
							</div>
							<div class="content">
								<div class="content-title">
									АНГЛИД БАКЛАВРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА
									<label class="date">
										11 сарын 19, 2016
									</label>
								</div>
								<div class="content-description">
									Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг
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
												<i class="fa fa-eye"></i> 4212
											</span>
											<span class="like">
												<i class="fa fa-heart"></i> 512
											</span>
											<span class="news-type">
												ТЭТГЭЛЭГ
											</span>
										</div>	
									</div>
								</div>
							</div>
						</div>
						<div class="content-container small">
							<div class="cover-cntr">
								<div class="cover">
									<div class="cover-img">
										<img class="horizontal" src="{{asset('images/england-cover.jpg')}}"/>
									</div>
								</div>
							</div>
							<div class="content">
								<div class="content-title">
									АНГЛИД БАКЛАВРЫН ТЭТГЭЛЭГ ЗАРЛАГДЛАА
									<label class="date">
										11 сарын 19, 2016
									</label>
								</div>
								<div class="content-description">
									Австралийн Үндэсний Их Сургуулийн Бизнес, Эдийн засгийн коллеж нь тус сургуульд магистрын зэргээр анх удаа суралцахаар элсэж буй 10 гадаад оюутанд 50% тэтгэлэг олгоно. Латин Америк, Европ, Ази, Зүүн өмнөд Ази болон Евро-Ази аас эхэлж буй оюутнуудаас тус бүр 1 оюутан тэтгэлэг
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
												<i class="fa fa-eye"></i> 4212
											</span>
											<span class="like">
												<i class="fa fa-heart"></i> 512
											</span>
											<span class="news-type">
												ТЭТГЭЛЭГ
											</span>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row">
						<div class="col-md-12">
							<div class="feed-container mini">
								<div class="feed-title">
									Валютын ханш
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="feed-container mini">
								<div class="feed-title">
									Сургуулиуд
								</div>
								<div class="university">
									<div class="table--display">
										<div class="university-img table--cell">
											<div class="cover-img">
												<img class="horizontal" src="{{asset('images/cambridge.png')}}"/>
											</div>
										</div>
										<div class="university-name table--cell">
											UNIVERSITY OF CAMBRIDGE
										</div>
									</div>
								</div>
								<div class="all-university">
									<a class="news-type">
										БУСАД СУРГУУЛИУД
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="footer">
		<div class="cntr-fluid">
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="footer-item-container">
						<div class="wc-logo">
							<img src="{{ asset('images/logo-wc.png') }}" height="50" />
						</div>
						<hr></hr>
						<div class="social">
							<a class="facebook">
								<i class="fa fa-facebook"></i>
							</a>
							<a class="twitter">
								<i class="fa fa-twitter"></i>
							</a>
							<a class="google-plus">
								<i class="fa fa-google-plus"></i>
							</a>
							<a class="skype">
								<i class="fa fa-skype"></i>
							</a>
						</div>

					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="footer-item-container">
						<label>Бидний тухай</label>
						<ul>
							<li>
								<a>Эрхэм зорилго</a>
							</li>
							<li>
								<a>Компани</a>
							</li>
							<li>
								<a>Үйлчилгээ</a>
							</li>
							<li>
								<a>Хамтын ажиллагаа</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="footer-item-container">
						<label>Бид юу хийдэг вэ</label>
						<ul>
							<li>
								<a>Их сургуульд зуучлах</a>
							</li>
							<li>
								<a>Визний бүх төрөлд зуучлах</a>
							</li>
							<li>
								<a>Элчингийн ярилцлаганд бэлдэх</a>
							</li>
							<li>
								<a>Англи хэлний сургалт</a>
							</li>
							<li>
								<a>Албан ёсны орчуулга</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="footer-item-container">
						<label>Холбоо барих</label>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="{{ elixir('js/app.js') }}"></script>
	<script>
        jQuery(document).ready(function ($) {

        	$(".wc-content-nav ul li").on("click", function(event){
        		if($(".card-container").css('display') == 'none')
        			$(".card-container").slideDown("fast");
        		else
        			$(".card-container").slideUp("fast");
        	});
           
        });
    </script>
</body>
</html>