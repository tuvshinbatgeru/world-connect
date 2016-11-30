<template>
	<div class="row" id="country-panel" >
		<div class="col-md-9">
			<div class="card">
				<div class="header">
					<h4 class="title"> Сургууль нэмэх
					</h4>
				</div>
				<div class="content">
					<form enctype="multipart/form-data">
						<div id="school-name" class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Сургуулийн нэр</label>
									<input class="form-control" v-model="school.name" type="text" placeholder="Сургуулийн нэр">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="flagId" class="btn btn-info btn-fill">Лого сонгох</label>
									<br/>
									<input id="flagId" name="logo" type="file"/>	
									<img id="flagImage" class="flag--temp" src="/images/site/logo_default.png" alt="Далбаа" />	
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="backId" class="btn btn-info btn-fill">Арын зураг солих</label>
									<input id="backId" name="cover" type="file"/>
									<img id="backImage" class="back--temp" src="/images/site/country_default.png" alt="Арын зураг" />
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="checkbox-inline"><input type="checkbox" value="" v-model="school.training">Хэлний бэлтгэл</label>
									<label class="checkbox-inline"><input type="checkbox" value="" v-model="school.bachelor">Бакалавар</label>
									<label class="checkbox-inline"><input type="checkbox" value="" v-model="school.doctor">Магистр, Доктор</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
							      <label for="sel1">Улс сонгох:</label>
							      <select class="form-control" v-model="school.country">
							        <option v-for="country in countries">
							        	{{country.name}}
							        </option>
							      </select>
							      <br>
							    </div>	
							</div>
						</div>


						<div id="school-info" class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Сургуулийн мэдээлэл</label>
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
		<div class="col-md-3 scrollspy">
			<ul class="nav nav-pills nav-stacked" id="affix-nav">
				<li :class="getMenu('school-name')"><a @click="toggleClass('school-name')" href="#school-name">Сургуулийн нэр</a></li>
				<li :class="getMenu('school-info')"><a @click="toggleClass('school-info')" href="#school-info">Сургуулийн мэдээлэл</a></li>
			</ul>
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
				school : {
					name : '',
					country : '',
					training : false,
					bachelor : false,
					doctor : false
				},
				y_pos : {},
				x_pos: {},
				menu : 'school-name',
				countries : []
			}
		},

		created : function () {
			this.getCountryNames()
		},

		ready : function () {
			var vm = this

			$.ajaxSetup({
		        headers: {
		        	'X-CSRF-TOKEN': $('#_token').attr('value') 
		        }
	        })

	        $("#flagId").change(function(){
		        vm.flagImageChanged(this)
		    })

		    $("#backId").change(function(){
		        vm.backImageChanged(this)
		    })

		    var $navbar = $("#affix-nav")

		    this.y_pos = $navbar.offset().top
		    this.x_pos = $navbar.offset().left

		    $(".main-panel").scroll(this.scrolled)

		    if(this.editable) {
				this.setData()
			}
		},

		methods : {
			getCountryNames : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/select').then(res => {
					this.countries = res.data.result
					if(this.countries[0] && !this.editable)
						this.school.country = this.countries[0].name
				}).catch(err => {
				});
			},

			setData : function () {
				var vm = this
				this.school.name = this.editable.name
				this.school.country = this.editable.country.name

				_.forEach(this.editable.degrees, function (degree) {
					if(degree.id == 1) {
						vm.school.training = true
					}

					if(degree.id == 2) {
						vm.school.bachelor = true
					}

					if(degree.id == 3) {
						vm.school.doctor = true
					}
				})

				$('#flagImage').attr("src", this.editable.logo_url)
				$('#backImage').attr("src", this.editable.cover_url)
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
			scrolled : function () {
		        var scrollTop = $('.main-panel').scrollTop();

		        if (scrollTop > this.y_pos) {
		            $("#affix-nav").addClass("navbarr-fixed").animate({
		                top: 0,
		                left: this.x_pos
		            });
		        } else if (scrollTop <= this.y_pos) {
		            $("#affix-nav").removeClass("navbarr-fixed").clearQueue().animate({
		                top: "-48px"
		            }, 0);
		        }
			},
			flagImageChanged : function (input) {
				var reader = new FileReader();
            
	            reader.onload = function (e) {
	                $('#flagImage').attr('src', e.target.result);
	            }
	            
	            reader.readAsDataURL(input.files[0]);
			},

			backImageChanged : function (input) {
				var reader = new FileReader();
            
	            reader.onload = function (e) {
	                $('#backImage').attr('src', e.target.result);
	            }
	            
	            reader.readAsDataURL(input.files[0]);
			},

			cancel : function () {
				this.$emit('cancel')
			},
			save : function () {
				if(!this.school.name.trim()) {
					this.$root.$refs.notify.notify('Сургуулийн нэр оруулна уу!', {
						closeable : false
					})
		            return
				}

				if(!$('#flagId')[0].files[0] && !this.editable) {
					this.$root.$refs.notify.notify('Сургуулийн лого сонгоно уу!', {
						closeable : false
					})
		            return
				}

				if(!$('#backId')[0].files[0] && !this.editable) {
					this.$root.$refs.notify.notify('Сургуулийн арын зураг сонгоно уу!', {
						closeable : false
					})
		            return
				}

				this.$http.get(this.$env.get('APP_URI') + 'admin/school/check?name=' + this.school.name).then(res => {
				  	if(res.data.code == 0 || (this.editable && this.editable.name == this.school.name)) {
				  		var fd = new FormData()

				  		if($('#flagId')[0].files[0])
							fd.append('flag', $('#flagId')[0].files[0])

						if($('#backId')[0].files[0])
							fd.append('cover', $('#backId')[0].files[0])
						
						var degree = []

						if(this.school.training) {
							degree.push(1)
						}

						if(this.school.bachelor) {
							degree.push(2)
						}

						if(this.school.doctor) {
							degree.push(3)
						}

						fd.append('school_name', this.school.name)
						fd.append('school_degree', degree)
						fd.append('country_name', this.school.country)
						fd.append('school_info', this.$refs.info.getContent())

						var data = {
							school : this.school,
							country_name : this.school.country,
							degree : degree,
							formData : fd,
						};


						if(this.editable)
							this.$emit('update', data)
						else
							this.$emit('save', data)  		
						return
				  	}

				  	this.$root.$refs.notify.notify('Сургуулийн нэр давхцаж байна!', {
						closeable : false
					})
				}).catch(err => {
				  
				});
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