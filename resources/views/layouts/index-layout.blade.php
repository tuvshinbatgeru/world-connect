<!doctype html>
<html>
<head>
    @include('includes.resource')
    @include('includes.index-header')
</head>
<body>
	<site-header>
		
	</site-header>

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
							<a href="https://www.facebook.com/worldconnect.international" class="facebook">
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