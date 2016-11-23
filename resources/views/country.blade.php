@extends('layouts.index-layout', ['currentView' => 'index-view'])
@section('content') 
	<section class="content">
	<div class="country-cover" style="background-image: url('{{asset('images/canada-mountain.jpg')}}')">
		<div class="text-outer-wrapper">
			<div class="text-centerize">
				<div class="country-cover-name">
					<img src="{{asset('images/site/flag-of-canada.png')}}" />
					Канад
					<a href="#section-content">
						<i class="fa fa-sort-down"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
		<!-- country card end -->
		<div class="cntr-fluid" id="section-content" style="margin-top: -95px;">	
			<div class="row margin-vertical">
				<div class="col-md-3 col-xs-12 pull-right">
					<div class="feed-container mini">
						<div class="feed-title">
							Канад
						</div>
						<div class="country-navigator">
							<ul>
								<li>
									<a>Канап улсын тухай</a>
								</li>
								<li>
									<a>Боловсролын тухай</a>
								</li>
								<li>
									<a>Сургуулиуд</a>
								</li>
								<li>
									<a>Визний мэдээлэл</a>
								</li>
								<li>
									<a>Тэтгэлэг</a>
								</li>
								<li>
									<a>Фото зураг</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-9 col-xs-12">
					<div class="feed-container mini">
						<div class="feed-title">
							Сургуулиуд
							<div class="university-filter-list">
								<ul>
									<li class="active">
										Бакалавр
									</li>
									<li>
										Магистр
									</li>
									<li>
										Хэлний бэлтгэл
									</li>
								</ul>
							</div>
						</div>
						<div class="content-container small university" >
							<div class="cover-cntr">
								<div class="cover">
									<div class="cover-img">
										<img class="horizontal vertical" src="{{asset('images/cambridge.png')}}"/>
									</div>
								</div>
							</div>
							<div class="content">
								<div class="content-title">
									Massachusetts Institute of Technology
								</div>
								<div class="content-description">
									Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology
									Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology
								</div>
							</div>
						</div>
						<div class="content-container small university" >
							<div class="cover-cntr">
								<div class="cover">
									<div class="cover-img">
										<img class="horizontal vertical" src="{{asset('images/cambridge.png')}}"/>
									</div>
								</div>
							</div>
							<div class="content">
								<div class="content-title">
									Massachusetts Institute of Technology
								</div>
								<div class="content-description">
									Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology
									Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology Massachusetts Institute of Technology
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
@stop