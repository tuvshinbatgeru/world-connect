@extends('layouts.news-layout', ['currentView' => 'news-view'])
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
					<div class="content-container small university no-hover" >
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
	}(document, 'script', 'facebook-jssdk'));

	 window.twttr = (function(d, s, id) {
          var t, js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s);
          js.id = id;
          js.src = "https://platform.twitter.com/widgets.js";
          fjs.parentNode.insertBefore(js, fjs);
          return window.twttr || (t = {
            _e: [],
            ready: function(f) {
              t._e.push(f)
            }
          });
        }(document, "script", "twitter-wjs"));

	</script>

	<div class="fb-share-button" 
		data-href="http://192.168.1.6/news/1" 
		data-layout="button_count">
	</div>

	<a href="https://twitter.com/intent/tweet?text={{$news->title}}&url=http://worldconnect.mn/news/{{$news->id}}">Жиргэх
	</a>

	</section>
@stop