@extends('layouts.admin-layout', ['currentView' => 'school-view'])
@section('content')	

	<modify-school v-if="showSchoolModify" 
					:editable.sync="selectedSchool" 
					@save="saveSchool"
					@update="editSchool"
					@cancel="cancelSchool">
		
	</modify-school>

    <div id="myModal1" class="modal" data-easein="fadeIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Анхааруулга</h4>
          </div>
          <div class="modal-body">
          	<span>Та</span>
          	<strong>"@{{selectedSchool.name}}"</strong>
            <span>сургуулийг устгахдаа итгэлтэй байна уу?</span>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger btn-fill" data-dismiss="modal" aria-hidden="true">Үгүй</button>
            <button @click="deleteSchool()" data-dismiss="modal" aria-hidden="true" class="btn btn-success btn-fill">Тийм</button>
          </div>
        </div>
      </div>
    </div>

	<div v-show="!showSchoolModify">
		<div class="col-md-12">
			<div class="card">
		        <div class="header">
		            <h4 class="title">
		            	Сургуулийн жагсаалт
		            	<a @click="newSchool()" class="btn btn-info btn-fill pull-right">
							Нэмэх
						</a>
		            </h4>
		        </div>

		        <div class="content table-responsive table-full-width">
		            <table class="table table-hover table-striped">
		                <thead>
		                    <tr><th>Нэр</th>
		                	<th>Улс</th>
		                	<th>Түвшин</th>
		                	<th>Засах</th>
		                	<th>Устгах</th>
		                </tr></thead>
		                <tbody>
							<tr v-for="school in schools">
		                    	<td>@{{school.name}}</td>
		                    	<td>@{{school.country.name}}</td>
		                    	<td>
		                    		<span v-for="degree in school.degrees">
		                    			@{{degree.name}}
		                    		</span>
		                    	</td>
		                    	<td>
		                    		<a class="orange-link" @click="updateSchool(school)">
		                    			<i class="fa fa-edit"></i>
		                    		</a>
		                    	</td>
		                    	<td>
		                    		<a class="orange-link" @click="setSchool(school)" href="#myModal1" data-target="#myModal1" data-toggle="modal">
		                    			<i class="fa fa-trash"></i>
		                    		</a>
		                    	</td>
		                    </tr>   	
		                </tbody>
		            </table>
		            <paginate :paginate="10" 
		            		  v-ref:paginate
		            		  :total.sync="total"
		            		  @page-changed="pageChanged"
		            >
		            </paginate>
		        </div>
		    </div>
		</div>
	</div>
@stop