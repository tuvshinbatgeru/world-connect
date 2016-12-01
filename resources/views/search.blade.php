@extends('layouts.index-layout', ['currentView' => 'information-view'])
@section('content') 
	<section class="content" v-cloak>
		<div class="cntr-fluid margin-vertical">
			<div class="feed-container mini">
				<div class="feed-title">
					Илэрцүүд
				</div>

				<gcse:searchresults-only></gcse:searchresults-only>
				
				<script>
				  (function() {
				    var cx = '007178342844275873977:c0ufdbfs1zk';
				    var gcse = document.createElement('script');
				    gcse.type = 'text/javascript';
				    gcse.async = true;
				    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
				    var s = document.getElementsByTagName('script')[0];
				    s.parentNode.insertBefore(gcse, s);
				  })();
				</script>
				
			</div>
		</div>
	</section>
@stop
