<!doctype html>
<html>
<head>
	<meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="When Great Minds Don’t Think Alike" />
	<meta property="og:description"        content="How much does culture influence creative thinking?" />
	<meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />

	<meta property="fb:app_id"              content="1549615252014368" />
	

    @include('includes.resource')
    @include('includes.index-header')
</head>
<body>
	<section class="header">
		<div class="cntr-fluid">
				<div class="wc-nav">
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
			<img src="{{ asset('images/logo-wc-vertical.png') }}" height="100" />
		</div>
		<hr class="header-seperator"></hr>
		<div class="cntr-fluid">
			<div class="wc-content-nav">
				<ul>
					<li class="active">
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
						<div class="cover">
							<div class="cover-img">
								<img class="horizontal" src="{{asset('images/sydney-opera.jpg')}}"/>
							</div>
							<div class="title">
								<a href="#"> Австрали</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	@if (isset($type))
        <component is="{{$currentView}}" 
        		   type="{{$type}}"
                   inline-template>
    @else
    	<component is="{{$currentView}}" 
                   inline-template>
    @endif
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

	<script src="{{ asset('js/blueimp-helper.js') }}"></script>
	<script src="{{ asset('js/blueimp-gallery.js') }}"></script>
	<script src="{{ asset('js/blueimp-gallery-fullscreen.js') }}"></script>
	<script src="{{ asset('js/blueimp-gallery-indicator.js') }}"></script>
	<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>