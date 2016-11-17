<template>
	<div class="row" id="country-panel" >
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
									<custom-editor v-ref:info 
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

		    if(this.editable) {
				this.setData()
			}
		},

		methods : {
			getCountryNames : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/select').then(res => {
					this.countries = res.data.result
				}).catch(err => {
				});
			},

			setData : function () {
				this.news.title = this.editable.title
				this.news.type = this.editable.type
				this.news.country = this.editable.country_id
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

				var data = {
					param : this.$tools.transformParameters({
						title : this.news.title,
						type : this.news.type,
						country : this.news.country,
						news_info : this.$refs.info.getContent(),
				   	})
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