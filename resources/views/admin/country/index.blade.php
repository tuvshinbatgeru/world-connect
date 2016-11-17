@extends('layouts.admin-layout', ['currentView' => 'country-view'])
@section('content')	

	<modify-country v-if="showCountryModify" 
					:editable.sync="selectedCountry" 
					@save="saveCountry"
					@update="editCountry"
					@cancel="cancelCountry">
		
	</modify-country>

    <div id="myModal1" class="modal" data-easein="fadeIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Анхааруулга</h4>
          </div>
          <div class="modal-body">
          	<span>Та</span>
          	<strong>"@{{selectedCountry.name}}"</strong>
            <span>улсыг устгахдаа итгэлтэй байна уу?</span>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger btn-fill" data-dismiss="modal" aria-hidden="true">Үгүй</button>
            <button @click="deleteCountry()" data-dismiss="modal" aria-hidden="true" class="btn btn-success btn-fill">Тийм</button>
          </div>
        </div>
      </div>
    </div>

	<div v-show="!showCountryModify">
		<div class="col-md-12">
			<a @click="newCountry()" class="btn btn-info btn-fill">
				Нэмэх
			</a>	
		</div>
		<div class="col-md-12">
			<div class="card">
		        <div class="header">
		            <h4 class="title">Улсын жагсаалт</h4>
		        </div>

		        <div class="content table-responsive table-full-width">
		            <table class="table table-hover table-striped">
		                <thead>
		                    <tr><th>Нэр</th>
		                	<th>Далбаа</th>
		                	<th>Засах</th>
		                	<th>Устгах</th>
		                </tr></thead>
		                <tbody>
							<tr v-for="country in countries">
		                    	<td>@{{country.name}}</td>
		                    	<td><img style="heigth:32px; width: 32px;" :src="country.flag_url"/></td>
		                    	<td>
		                    		<a @click="updateCountry(country)">
		                    			<i class="fa fa-edit"></i>
		                    		</a>
		                    	</td>
		                    	<td>
		                    		<a @click="setCountry(country)" href="#myModal1" data-target="#myModal1" data-toggle="modal">
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