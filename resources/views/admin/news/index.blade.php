@extends('layouts.admin-layout', ['currentView' => 'news-view'])
@section('content')	

	<modify-news v-if="showNewsModify" 
					:editable.sync="selectedNews" 
					@save="saveNews"
					@update="editNews"
					@cancel="cancelNews">
	</modify-news>

    <div id="myModal1" class="modal" data-easein="fadeIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Анхааруулга</h4>
          </div>
          <div class="modal-body">
          	<span>Та</span>
          	<strong>"@{{selectedNews.title}}"</strong>
            <span>мэдээг устгахдаа итгэлтэй байна уу?</span>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger btn-fill" data-dismiss="modal" aria-hidden="true">Үгүй</button>
            <button @click="deleteNews()" data-dismiss="modal" aria-hidden="true" class="btn btn-success btn-fill">Тийм</button>
          </div>
        </div>
      </div>
    </div>	

	<div v-show="!showNewsModify">
		<div class="row">
			<div class="col-md-6 pull-left">
				<a @click="newNews()" class="btn btn-info btn-fill">
					Нэмэх
				</a>	
			</div>
			<div class="col-md-6 pull-right">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
					      <select class="form-control" v-model="type" @change="typeChanged">
					        <option value="0" selected>Бүгд</option>
					        <option value="1">
					        	Мэдээлэл
					        </option>
					        <option value="2">
					        	Тэтгэлэг
					        </option>
					        <option value="3">
					        	Зар
					        </option>
					        <option value="4">
					        	Сургалт
					        </option>
					        <option value="5">
					        	Онцлосон
					        </option>
					      </select>
					      <br>
					    </div>
				    </div>
				    <div class="col-md-6">
				    	<div class="form-group">
							<input class="form-control" id="searchValue" @keyup.enter="searchAsString" v-model="searchValue" placeholder="хайх ..." autofocus/>	
						</div>
					</div>
			    </div>	
			</div>
		</div>

		<div class="col-md-12">
			<div class="card">
		        <div class="header">
		            <h4 class="title">Мэдээний жагсаалт</h4>
		        </div>

		        <div class="content table-responsive table-full-width">
		            <table class="table table-hover table-striped">
		                <thead>
		                    <tr><th>Гарчиг</th>
		                	<th>Төрөл</th>
		                	<th>Үзсэн</th>
		                	<th>Огноо</th>
		                	<th>Төлөв</th>
		                	<th>Засах</th>
		                	<th>Устгах</th>
		                </tr></thead>
		                <tbody>
							<tr v-for="news in information">
		                    	<td>@{{news.title}}</td>
		                    	<td>@{{news.type | newsFilter}}</td>
		                    	<td>@{{news.visit_count}}</td>
		                    	<td>
		                    		@{{news.created_at | moment "from"}}
		                    	</td>
		                    	<td>
		                    		<a @click="togglePin(news)" style="font-size : 14px">
		                    			<i class="fa" 
		                    			   :class="news.is_pinned == 'Y' ? 'fa-check-circle' : 'fa-check'" 
		                    			   :style="{color: news.is_pinned == 'Y' ? 'green' : '#87CB16'}"></i>
		                    		</a>
		                    	</td>
		                    	<td>
		                    		<a @click="updateNews(news)">
		                    			<i class="fa fa-edit"></i>
		                    		</a>
		                    	</td>
		                    	<td>
		                    		<a @click="setNews(news)" href="#myModal1" data-target="#myModal1" data-toggle="modal">
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