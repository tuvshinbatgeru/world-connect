<template>
	<div class="row" id="country-panel">
		<div class="col-md-9">
			<div class="card">
				<div class="header">
					<h4 class="title"> Мэдээ нэмэх
					</h4>
				</div>
				<div class="content">
					<form enctype="multipart/form-data">
						<div id="news-name" class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Гарчиг</label>
									<input class="form-control" v-model="news.title" type="text" placeholder="гарчиг ...">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="coverId" class="btn btn-info btn-fill">Нүүр зураг сонгох</label>
									<br/>
									<input style="display:none" id="coverId" name="flag" type="file"/>	
									<img id="coverImage" class="flag--temp" src="/images/site/default_flag.png" alt="Далбаа" />	
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
							      <select class="form-control" v-model="news.type">
							        <option value="1" selected>
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
							      </select>
							      <br>
							    </div>	
							</div>

							<div class="col-md-6">
								<div class="form-group">
							      <select class="form-control" v-model="news.country">
							        <option value="0" selected>улс сонгох</option>
							        <option v-for="country in countries" :value="country.id">
							        	{{country.name}}
							        </option>
							      </select>
							      <br>
							    </div>	
							</div>
						</div>

						<div id="news-info" class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea rows="5" 
											  class="form-control"
											  style="resize: none; color: #666666"
											  v-model="news.description"
											  placeholder="мэдээний товч утга оруулах ...">
										
									</textarea>
								</div>
							</div>
						</div>

						<hr>

						<div id="news-info" class="row">
							<div class="col-md-12">
								<div class="form-group">
									<custom-editor v-ref:info 
												  title-holder="Мэдээний дэлгэрэнгүй оруулах"
									              :titleable="false" 
									              :html="getEditorContent('info')">
									</custom-editor>
								</div>
							</div>
						</div>

						<a @click="save()" class="btn btn-info btn-fill pull-right">Хадгалах</a>
						<a @click="cancel()" class="btn btn-info btn-fill pull-right" style="margin-right: 5px;">Буцах</a>
						<div class="clearfix"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props : {
			editable : {}
		},

		data () {
			return {
				news : {
					title : '',
					country : '',
					description : '',
					type : false,
				},
				countries : []
			}
		},

		created : function () {
			this.getCountryNames()
		},

		ready : function () {
			$.ajaxSetup({
		        headers: {
		        	'X-CSRF-TOKEN': $('#_token').attr('value') 
		        }
	        })
			var vm = this

	        $("#coverId").change(function(){
		        vm.coverImageChanged(this)
		    })

		    if(this.editable) {
				this.setData()
			}
		},

		methods : {
			coverImageChanged : function (input) {
				var reader = new FileReader();
            
	            reader.onload = function (e) {
	                $('#coverImage').attr('src', e.target.result);
	            }
	            
	            reader.readAsDataURL(input.files[0]);
			},

			getCountryNames : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/select').then(res => {
					this.countries = res.data.result
				}).catch(err => {
				});
			},

			setData : function () {
				this.news.title = this.editable.title
				this.news.type = this.editable.type
				this.news.description = this.editable.info[0].description
				this.news.country = this.editable.country_id
				$('#coverImage').attr("src", this.editable.cover_url)
			},

			getEditorContent : function (type) {
				if(!this.editable || this.editable.info === null) {
					return
				}
				
				return this.editable.info[0].content
			},

			getMenu : function (menu) {
				return this.menu == menu ? 'active' : ''
			},

			toggleClass : function (menu) {
				this.menu = menu
			},

			cancel : function () {
				this.$emit('cancel')
			},

			save : function () {

				if(!this.news.title.trim()) {
					this.$root.$refs.notify.notify('Мэдээний гарчиг оруулна уу!', {
						closeable : false
					})
		            return
				}

				if(!$('#coverId')[0].files[0] && !this.editable) {
					this.$root.$refs.notify.notify('Мэдээний нүүр зураг сонгоно уу!', {
						closeable : false
					})
		            return
				}

				var fd = new FormData()

				if($('#coverId')[0].files[0])
						fd.append('cover', $('#coverId')[0].files[0])

				fd.append('title', this.news.title)
				fd.append('type', this.news.type)
				fd.append('country', this.news.country)
				fd.append('news_description', this.news.description)
				fd.append('news_info', this.$refs.info.getContent())

				var data = {
					formData : fd,
				};

				if(this.editable)
					this.$emit('update', data)
				else
					this.$emit('save', data)  		
			}
		}
	}
</script>
<style lang="scss">
	.flag--temp {
		width: 150px;
		height: 100px;
	}
	.back--temp {
		width: 100%;
	}
	#backId {
		display: none;
	}
	#flagId {
		display: none;
	}
	.navbarr-fixed {
  		position: fixed;
	}

</style>