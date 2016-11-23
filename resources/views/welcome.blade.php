@extends('layouts.index-layout', ['currentView' => 'index-view'])
@section('content') 
	<section class="content">
		<div style="width: 100%;">
			<horizontal-slide :slide-width="100" width-type="%" :step="1" :items="items">
	                
	    	</horizontal-slide>
		</div>

		<div class="white-full">
			<div class="cntr-fluid">
				<div class="row">
					<div class="col-md-12 text-center card-title">
						<i class="fa fa-address-card-o"></i> ЗУУЧЛАХ УЛС ОРНУУД
					</div>
				</div>
				<div class="row">
					<div class="col-md-3" v-for="country in countries">
						<div class="flip-card country">
							<div class="cover">
								<div class="cover-img">
									<img class="vertical" :src="country.cover_url"/>
								</div>
								<div class="title">
									<div class="globe">
										<i class="fa fa-globe"></i>
									</div>
									<a>@{{country.name}}</a>
									<img src="{{asset('images/site/flip-card-arrow.png')}}" />
								</div>
								<div class="cover-content">
									<div class="cover-content-background">
										<div class="content-title">
											<a>@{{country.name}}</a>
										</div>
										<div class="cover-content-nav">
											<ul>
												<li><a :href="'/country/' + country.id + '/about'"> <i class="fa fa-flag"></i> @{{country.name}} улсын тухай </a></li>
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

						<div class="content-container" :class="$index != 0 ? 'small' : ''" v-for="news in latestNews">
							<div class="cover-cntr">
								<div class="cover">
									<div class="cover-img">
										<img class="horizontal" :src="news.cover_url"/>
									</div>
								</div>
							</div>
							<div class="content">
								<div class="content-title">
									@{{news.title}}
									<label class="date">
										@{{news.created_at | moment 'from'}}
									</label>
								</div>
								<div class="content-description">
									@{{news.info[0].description}}
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
												<i class="fa fa-eye"></i> @{{news.visit_count}}
											</span>
											<span class="news-type">
												@{{news.type | newsFilter}}
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
								<div class="row" v-for="xansh in xanshs">
									<p>@{{xansh.code}}</p>
									<p>@{{xansh.rate}}</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="feed-container mini">
								<div class="feed-title">
									Сургуулиуд
								</div>
								<div class="university" v-for="school in schools">
									<div class="table--display">
										<div class="university-img table--cell">
											<div class="cover-img">
												<img class="horizontal" :src="school.logo_url"/>
											</div>
										</div>
										<div class="university-name table--cell">
											@{{school.name}}
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

		<map style="height: 300px; display: block;" 
		  :center="{lat:47.913995, lng:106.916081}"
		  :map-type-id="roadmap"
		  :zoom="17"
		>
			<marker 
		      :position="{lat:47.913995, lng:106.916081}"
		    ></marker>
		</map>
	</section>
@stop