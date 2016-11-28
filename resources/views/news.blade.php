@extends('layouts.index-layout', ['currentView' => 'news-view'])
@section('content') 
	<section class="content">
	<div class="country-cover" style="background-image: url('{{$news->cover_url}}')">
	</div>
	<div class="cntr-fluid" id="section-content" style="margin-top: -95px;">	
		<div class="row margin-vertical">
			<div class="col-md-12 col-xs-12">
				<div class="feed-container mini">
					<div class="feed-title">
						{{$news->title}}
					</div>
					<div class="content-container small university" >
						{!!$news->info[0]->content!!}
					</div>
				</div>
			</div>
		</div>

		<related-news :news-id="{{$news->id}}">
			
		</related-news>
	</div>

	<div id="fb-root">
		
	</div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<a href="http://www.facebook.com/sharer/sharer.php?u=http://192.168.1.6/news/1">test</a>

	</section>
@stop