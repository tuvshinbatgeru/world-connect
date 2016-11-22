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

	
	<component is="{{$currentView}}" inline-template>				
		@yield('content')
	</component>

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