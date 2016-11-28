@extends('layouts.index-layout', ['currentView' => 'country-view'])
@section('content') 
	<section class="content">
	<div class="country-cover" style="background-image: url('{{$country->cover_url}}')">
		<div class="text-outer-wrapper">
			<div class="text-centerize">
				<div class="country-cover-name">
					<img src="{{$country->flag_url}}" />
					{{$country->name}}
					<a href="#section-content">
						<i class="fa fa-sort-down"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
		<div class="cntr-fluid" id="section-content" style="margin-top: -95px;">	
			<div class="row margin-vertical">
				<div class="col-md-3 col-xs-12 pull-right no-padding">
					<div class="feed-container mini">
						<div class="feed-title">
							{{$country->name}}
						</div>
						<div class="country-navigator">
							<ul>
								<li :class="type == 'about' ? 'active' : ''">
									<a @click="setType('about')">Улсын тухай</a>
								</li>
								<li :class="type == 'education' ? 'active' : ''">
									<a @click="setType('education')">Боловсролын систем</a>
								</li>
								<li :class="type == 'schools' ? 'active' : ''">
									<a @click="setType('schools')">Сургуулиуд</a>
								</li>
								<li :class="type == 'visa' ? 'active' : ''">
									<a @click="setType('visa')">Визний мэдээлэл</a>
								</li>
								<li :class="type == 'scholarship' ? 'active' : ''">
									<a @click="setType('scholarship')">Тэтгэлэг</a>
								</li>
								<li :class="type == 'news' ? 'active' : ''">
									<a @click="setType('news')">Мэдээлэл</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-9 col-xs-12 no-padding" v-show="type == 'about'">
					<div class="feed-container mini">
						<div class="feed-title">
							Улсын тухай
						</div>
						<div class="content-container no-hover" >
							{!!$country->countryInformation[0]->content!!}
						</div>
					</div>
				</div>

				<div class="col-md-9 col-xs-12 no-padding" v-show="type == 'visa'">
					<div class="feed-container mini">
						<div class="feed-title">
							Визний мэдээлэл
						</div>
						<div class="content-container no-hover" >
							{!!$country->countryVisa[0]->content!!}
						</div>
					</div>
				</div>

				<div class="col-md-9 col-xs-12 no-padding" v-show="type == 'education'">
					<div class="feed-container mini">
						<div class="feed-title">	
							Боловсролын систем
						</div>
						<div class="content-container no-hover">
							{!!$country->countryEducation[0]->content!!}
						</div>
					</div>
				</div>


				<div class="col-md-9 col-xs-12 no-padding" v-if="type == 'schools'">
					<country-schools :country="{{$country->id}}">
						
					</country-schools>
				</div>

				<div class="col-md-9 col-xs-12 no-padding" v-if="type == 'news'">
					<country-news :country="{{$country->id}}">
						
					</country-news>
				</div>
				
				<country-scholarship :country="{{$country->id}}" v-if="type == 'scholarship'">

				</country-scholarship>
				
				<div class="col-md-9 col-xs-12 no-padding margin-vertical">
					<album-slider :country-id="{{$country->id}}">
						
					</album-slider>
				</div>					
			</div>
		</div>

	</section>
@stop