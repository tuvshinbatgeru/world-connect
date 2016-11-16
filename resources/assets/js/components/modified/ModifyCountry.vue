<template>
	<div class="row" id="country-panel" >
		<div class="col-md-9">
			<div class="card">
				<div class="header">
					<h4 class="title"> Улс нэмэх
					</h4>
				</div>
				<div class="content">
					<form enctype="multipart/form-data">
						<div id="country-name" class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Улсын нэр</label>
									<input class="form-control" v-model="country.name" type="text" placeholder="Улсын нэр">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="flagId" class="btn btn-info btn-fill">Далбаа сонгох</label>
									<br/>
									<input id="flagId" name="flag" type="file"/>	
									<img id="flagImage" class="flag--temp" src="/images/site/default_flag.png" alt="Далбаа" />	
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="backId" class="btn btn-info btn-fill">Арын зураг солих</label>
									<input id="backId" name="cover" type="file"/>
									<img id="backImage" class="back--temp" src="/images/site/country_cover.jpg" alt="Далбаа" />
								</div>
							</div>
						</div>
						<div id="country-info" class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Улсын мэдээлэл</label>
									<custom-editor v-ref:info :titleable="false"></custom-editor>
								</div>
							</div>
						</div>
						<div id="country-education" class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Боловсролын систем</label>
									<custom-editor v-ref:education :titleable="false"></custom-editor>
								</div>
							</div>
						</div>
						<div id="country-visa" class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Визний мэдээлэл</label>
									<custom-editor v-ref:visa :titleable="false"></custom-editor>
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
				<li :class="getMenu('country-name')"><a @click="toggleClass('country-name')" href="#country-name"> Улсын нэр</a></li>
				<li :class="getMenu('country-info')"><a @click="toggleClass('country-info')" href="#country-info">Улсы мэдээлэл</a></li>
				<li :class="getMenu('country-education')"><a @click="toggleClass('country-education')" href="#country-education">Боловсролын систем</a></li>
				<li :class="getMenu('country-visa')"><a @click="toggleClass('country-visa')" href="#country-visa">Визний мэдээлэл</a></li>
			</ul>
		</div>
	</div>
</template>
<script>
	export default {
		data () {
			return {
				country : {
					name : '',
				},
				y_pos : {},
				x_pos: {},
				menu : 'country-name'
			}
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

		},

		methods : {
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
				if(!this.country.name.trim()) {
					this.$root.$refs.notify.notify('Улсын нэр оруулна уу!', {
						closeable : false
					})
		            return
				}

				if(!$('#flagId')[0].files[0]) {
					this.$root.$refs.notify.notify('Улсын далбаа сонгоно уу!', {
						closeable : false
					})
		            return
				}

				if(!$('#backId')[0].files[0]) {
					this.$root.$refs.notify.notify('Улсын арын зураг сонгоно уу!', {
						closeable : false
					})
		            return
				}

				this.$http.get(this.$env.get('APP_URI') + 'admin/country/check?name=' + this.country.name).then(res => {
				  	if(res.data.code == 0) {
				  		debugger

				  		var fd = new FormData();    
						fd.append('flag', $('#flagId')[0].files[0]);
						fd.append('cover', $('#backId')[0].files[0]);
						
						var data = {
							country : this.country,
							formData : fd,
							param : this.$tools.transformParameters({
								country_name : this.country.name,
								country_info : this.$refs.info.getContent(),
								country_education : this.$refs.education.getContent(),
								country_visa : this.$refs.visa.getContent(),
					    	})
						};


						this.$emit('save', data)  		
						return
				  	}

				  	this.$root.$refs.notify.notify('Улсын нэр давхцаж байна!', {
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