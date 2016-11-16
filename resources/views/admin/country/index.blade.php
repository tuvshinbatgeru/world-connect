@extends('layouts.admin-layout', ['currentView' => 'country-view'])
@section('content')	

	<modify-country v-if="showCountryModify" @cancel="cancelCountry" @save="saveCountry">
		
	</modify-country>

	<div v-show="!showCountryModify">
		<div class="col-md-12">
			<a @click="showCountryModify = true" class="btn btn-info btn-fill">
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
		                    	<td>Далбаа</td>
		                    	<td>
		                    		<a>
		                    			<i class="fa fa-edit"></i>
		                    		</a>
		                    	</td>
		                    	<td>
		                    		<a>
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