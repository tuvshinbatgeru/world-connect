@extends('layouts.index-layout', ['currentView' => 'index-view'])
@section('content') 
	<section class="content" v-cloak>
		<div style="width: 100%;">
			<horizontal-slide :slide-width="100" width-type="%" :step="1" :items="items" :slide-height="475">
	                
	    	</horizontal-slide>
		</div>

		<div class="white-full">
			<div class="cntr-fluid">
				<div class="row">
					<div class="col-md-12 text-center ">
						<div class="countries-ad">
							<h2><i class="fa fa-globe"></i> Суралцуулах улсууд</h2>
							<h3>
								Бид таны цагийг хэмнэн, төгс цогц үйлчилгээг хурдан шуурхай үзүүлнэ
							</h3>
							<p>
								Та гадаадад сурах хүсэл мөрөөдөлтэй хэдий ч яг аль улсад сурахаа шийдэж чадахгүй байна уу ? Тэгвэл таныг сонголт хийхэд манай компани туслах болно.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- country card start -->
		<div class="countries-background">
			<div class="cntr-fluid">
				<div class="row">
					<div class="col-md-3" v-for="country in countries">
						<div class="flip-card country">
							<div class="cover">
								<div class="country-flag">
									<img :src="country.flag_url" height="20" />
								</div>
								<div class="country-cover-image">
									<div class="cover-img">
										<img class="horizontal" :src="country.cover_url"/>
									</div>
								</div>
								<div class="title">
									<div class="globe" style="display: none;">
										<i class="fa fa-globe"></i>
									</div>
									<a>@{{country.name}}</a>
								</div>
								<a class="more">
									ДЭЛГЭНРЭНГҮЙ
								</a>
								<div class="cover-content">
									<div class="cover-content-background">
										<div class="content-title">
											<a>@{{country.name}}</a>
										</div>
										<div class="cover-content-nav">
											<ul>
												<li><a :href="'/country/' + country.id + '?type=about'"> <i class="fa fa-flag"></i> @{{country.name}} улсын тухай </a></li>
												<li><a :href="'/country/' + country.id + '?type=education'"> <i class="fa fa-mortar-board"></i> Боловсролын систем </a></li>
												<li><a :href="'/country/' + country.id + '?type=visa'"> <i class="fa fa-flag"></i> Визний мэдээлэл </a></li>
												<li><a :href="'/country/' + country.id + '?type=schools'"> <i class="fa fa-flag"></i> Сургуулиуд </a></li>
												<li><a :href="'/country/' + country.id + '?type=news'"> <i class="fa fa-mortar-board"></i> Тэтгэлэг </a></li>
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
		<!-- university card start -->
		<div class="universities-background">
			<div class="table--display">
				<div class="table--cell line">
					aaa	
				</div>
				<div class="universities table--cell">
					<i class="fa fa-university"></i> Сургуулиуд	
				</div>
				<div class="table--cell line">
					aaa
				</div>
			</div>
			<div class="cntr-fluid">
				<p>
					Та бүхэн манай байгууллагыг сонгосноороо бидэнтэй хамтран ажилладаг олон улсад хүлээн зөвшөөрөгдсөн их дээд сургууль, коллеж, хэлний бэлтгэлийн төвүүдээс сонгон, хүссэн хямд зардлаар чанартай боловсрол эзэмших, суралцангаа аялж, амьдрах, боломжийг олгож байна.
				</p>
			</div>
			<div class="cntr-fluid">
				<div class="table--display">
					<div class="table--cell" v-for="school in schools">
						<div class="university">
							<table>
								<tr>
									<td class="university-img">
										<div class="cover-img">
											<img class="fit" :src="school.logo_url"/>
										</div>
									</td>
								</tr>
								<tr>
									<td class="university-name table--cell">
										@{{school.name}}
									</td>
								</tr>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- university card end -->
		<!-- news feed start -->
		<div class="news-feed-background">
			<div class="cntr-fluid">
				<h3>
					СҮҮЛД НЭМЭГДСЭН МЭДЭЭЛЭЛ
				</h3>
				<h5>
					Тэтгэлэг, виз, сургуультай холбоотой мэдээлэл
				</h5>
				<hr></hr>
				<div class="row">
					<div :class="$index/2 == 0 ? 'col-md-7' : 'col-md-5'" v-for="news in latestNews" style="margin-bottom:15px;">
						<div class="news-item">
							<div class="cover-img">
								<img class="horizontal" :src="news.cover_url"/>
							</div>
							<div class="news">
								<div class="news-title">
									<a :href="'/news/' + news.id">@{{news.title}}</a>
								</div>

								<div class="news-brief">
									@{{news.info[0].description}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- news feed end -->
		<!-- album start -->

		<div class="album-background">
			<div class="cntr-fluid">
				<h3>
					ТАНЫ ТЭМҮҮЛЭЛ БИДНИЙ АМЖИЛТ
				</h3>
				<div class="description">
					Америк, Австрали, Канад зэрэг улсуудруу явсан оюутан залуучууд фото албум
				</div>
			</div>
			<div class="album-container">
				<album-slider></album-slider>
			</div>
		</div>

		<!-- album end -->


		<div class="cntr-fluid">	
			<div class="row margin-vertical">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3 margin-vertical">
							<div class="feed-container mini">
								<div class="feed-title">
									Сошиал хуудас
								</div>
								<div style="padding: 28px 26px;">
									<!-- <div class="fb-page" data-href="https://www.facebook.com/worldconnect.international" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote>
									</div> -->
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="feed-container mini">
								<div class="feed-title">
									Валютын ханш
								</div>
								<table class="currency-table">
									<tr v-for="xansh in xanshs">
										<td>
											<i class="@{{xansh.code}}"></i>
											@{{xansh.code}}
										</td>
										<td>
											@{{xansh.rate}}
										</td>
									</tr>
								</table>
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