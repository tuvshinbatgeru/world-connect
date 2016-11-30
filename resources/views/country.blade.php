@extends('layouts.index-layout', ['currentView' => 'country-view'])
@section('content') 
	<section class="content">
	<div class="country-background">
		<div class="cntr-fluid country-wrapper">
			<div class="country-cover" style="background-image: url('{{$country->cover_url}}')">
				<div class="text-outer-wrapper">
					<div class="text-centerize">
						<div class="country-cover-name">
							{{$country->name}}
						</div>
						<div class="countr-description">
							Танд {{$country->name}} улсын шилдэг <strong>{{$country->schools()->count()}}</strong> сургуулиудаас сонгон суралцах боломж олгож байна.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="cntr-fluid">
			<div class="country-navigator">
				<ul>
					<li :class="type == 'about' ? 'active' : ''">
						<a @click="setType('about')"> <i class="fa fa-globe"></i> {{$country->name}} улсын тухай</a>
					</li>
					<li :class="type == 'education' ? 'active' : ''">
						<a @click="setType('education')"> <i class="fa fa-graduation-cap"></i> Боловсролын систем</a>
					</li>
					<li :class="type == 'visa' ? 'active' : ''">
						<a @click="setType('visa')"> <i class="fa fa-address-card-o"></i> Визний мэдээлэл</a>
					</li>
					<li :class="type == 'schools' ? 'active' : ''">
						<a @click="setType('schools')"> <i class="fa fa-university"></i> Сургуулиуд</a>
					</li>
					<li :class="type == 'scholarship' ? 'active' : ''">
						<a @click="setType('scholarship')"> <i class="fa fa-gift"></i> Тэтгэлэг</a>
					</li>
					<li :class="type == 'news' ? 'active' : ''">
						<a @click="setType('news')"> <i class="fa fa-newspaper-o"></i> Мэдээлэл</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
		<div class="cntr-fluid" id="section-content">	
			<div class="row margin-vertical">

				<div class="col-md-12 no-padding" v-show="type == 'about'">
					<div class="feed-container mini">
						<div class="feed-title">
							Улсын тухай
						</div>
						<div class="content-container no-hover" >
							{!!$country->countryInformation[0]->content!!}
						</div>
					</div>
				</div>

				<div class="col-md-12 col-xs-12 no-padding" v-show="type == 'visa'">
					<div class="feed-container mini">
						<div class="feed-title">
							Визний мэдээлэл
						</div>
						<div class="content-container no-hover" >
							{!!$country->countryVisa[0]->content!!}
						</div>
					</div>
				</div>

				<div class="col-md-12 col-xs-12 no-padding" v-show="type == 'education'">
					<div class="feed-container mini">
						<div class="feed-title">	
							Боловсролын систем
						</div>
						<div class="content-container no-hover">
							{!!$country->countryEducation[0]->content!!}
						</div>
					</div>
				</div>


				<div class="col-md-12 col-xs-12 no-padding" v-if="type == 'schools'">
					<country-schools :country="{{$country->id}}">
						
					</country-schools>
				</div>

				<div class="col-md-12 col-xs-12 no-padding" v-if="type == 'news'">
					<country-news :country="{{$country->id}}">
						
					</country-news>
				</div>
				
				<country-scholarship :country="{{$country->id}}" v-if="type == 'scholarship'">

				</country-scholarship>
				
				<div class="col-md-12 col-xs-12 no-padding margin-vertical">
					<album-slider :country-id="{{$country->id}}">
						
					</album-slider>
				</div>					
			</div>
		</div>

	</section>
@stop