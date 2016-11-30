@extends('layouts.admin-layout', ['currentView' => 'album-view'])
@section('content')	

	<modify-album v-if="showAlbumModify" 
				  :editable.sync="selectedAlbum" 
				  @save="saveAlbum"
				  @update="editAlbum"
				  @cancel="cancelAlbum">
	</modify-album>

    <div id="myModal1" class="modal" data-easein="fadeIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Анхааруулга</h4>
          </div>
          <div class="modal-body">
          	<span>Та</span>
          	<strong>"@{{selectedAlbum.title}}"</strong>
            <span>цомгийг устгахдаа итгэлтэй байна уу?</span>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger btn-fill" data-dismiss="modal" aria-hidden="true">Үгүй</button>
            <button @click="deleteAlbum()" data-dismiss="modal" aria-hidden="true" class="btn btn-success btn-fill">Тийм</button>
          </div>
        </div>
      </div>
    </div>

	<div v-show="!showAlbumModify">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<a class="btn btn-fill" :class="filter.type == selectedFilter ? 'btn-success' : 'btn-info'" v-for="filter in filters" @click="setFilter(filter)">
						<span style="padding: 5px; border-radius: 5px;">
							@{{filter.label}}
						</span>
					</a>
				</div>
				<div class="col-md-6">
					<select class="form-control pull-right" v-model="country">
				        <option value="0" selected>Бүх</option>
				        <option v-for="country in countries" :value="country.id">
				        	@{{country.name}}
				        </option>
				    </select>
		    	</div>
		    </div>
		</div>
		<!-- <div class="col-md-12">
			<div class="card">
		        <div class="header">
		            <h4 class="title">Цомгийн жагсаалт</h4>
		        </div>
		    </div>
		</div> -->

		<!-- <div class="col-md-12">
			<div class="row">
				<div v-for="album in albums" class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<h3>@{{album.title}}</h3>
					<a @click="updateAlbum(album)"><i class="fa fa-edit"></i></a>

					<a @click="setAlbum(album)" href="#myModal1" data-target="#myModal1" data-toggle="modal">
		                    			<i class="fa fa-trash"></i>
		            </a>
		            <p>@{{album.country.name}}</p>

					<p>@{{album.created_at | moment 'from'}}</p>
					<label>@{{album.photos_count}}</label>
					<img style="width:200px; height: 200px;" :src="album.pinned_photo[0].url"/>
				</div>
			</div>
		</div> -->
		<div class="col-md-12" style="margin-top: 15px;">
			<div class="card">
		        <div class="header">
		            <h4 class="title">
		            	Цомгийн жагсаалт
		            	<a @click="newAlbum()" class="btn btn-info btn-fill pull-right">
							Нэмэх
						</a>	
		            </h4>
		        </div>

		        <div class="content table-responsive table-full-width">
		            <table class="table table-hover table-striped">
		                <thead>
		                    <tr>
		                    <th></th>
		                    <th>Нэр</th>
		                	<th>Улс</th>
		                	<th>Тоо</th>
		                	<th>Нэмсэн</th>
		                	<th>Засах</th>
		                	<th>Устгах</th>
		                </tr></thead>
		                <tbody>
							<tr v-for="album in albums">
								<td>
									<img height="50" :src="album.pinned_photo[0].url"/>
								</td>
		                    	<td>@{{album.country.name}}</td>
		                    	<td>@{{album.country.name}}</td>
		                    	<td style="width: 70px;">@{{album.photos_count}}</td>
		                    	<td>
		                    		@{{album.created_at | moment 'from'}}
		                    	</td>
		                    	<td style="width: 70px;">
		                    		<a @click="updateAlbum(album)"><i class="fa fa-edit"></i></a>
		                    	</td>
		                    	<td style="width: 70px;">
		                    		<a @click="setAlbum(album)" href="#myModal1" data-target="#myModal1" data-toggle="modal">
		                    			<i class="fa fa-trash"></i>
		            				</a>
		                    	</td>
		                    </tr>   	
		                </tbody>
		            </table>
		        </div>
		    </div>
		</div>
	</div>
@stop