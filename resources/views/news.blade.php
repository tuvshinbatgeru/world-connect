@extends('layouts.news-layout', ['currentView' => 'news-view'])
@section('content') 
	<section class="content">
	<div class="news-background">
		<div class="news-cover-wrapper">
			<div class="news-cover" style="background-image: url('{{$news->cover_url}}')">
			</div>
		</div>
		<div class="cntr-fluid" id="section-content">	
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="news-full-page">
						<h2>
							{{$news->title}}
						</h2>
						<div class="date">
							<div class="row">
								<div class="col-xs-6 text-left">
									Нийтэлсэн огноо 2016  11 сарын 28
								</div>
								<div class="col-xs-6 text-right">
									<div class="fb-share-button" 
										data-href="http://192.168.1.6/news/1" 
										data-layout="button_count">
									</div>
									<a class="twitter-share" href="https://twitter.com/intent/tweet?text={{$news->title}}&url=http://worldconnect.mn/news/{{$news->id}}"> <i class="fa fa-twitter"></i>Tweet
									</a>
									<!-- <span class="facebook-share"> <i class="fa fa-facebook"></i> Share</span> -->
								</div>
							</div>
						</div>
						<hr></hr>
						{!!$news->info[0]->content!!}
						<div class="news-navigator">
							<div class="previous">
								<a><i class="fa fa-angle-left"></i> ӨМНӨХ МЭДЭЭ</a>
							</div>
							<div class="next">
								<a>ДАРААГИЙН МЭДЭЭ <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<related-news :news-id="{{$news->id}}">
				
			</related-news>
		</div>
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

	

	</section>
@stop