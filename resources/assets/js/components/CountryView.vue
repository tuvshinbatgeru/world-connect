<script>
	import ModifyCountry from './modified/ModifyCountry.vue'

	export default {
		props : {
			title : {},
		},

		data () {
			return {
				countries : [],
				showCountryModify : false,
			}
		},

		created : function () {
			this.getCountries()
		},

		methods : {
			getCountries : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/list').then(res => {
				  	this.countries = res.data.result.data
				}).catch(err => {
				});
			},

			cancelCountry : function () {
				this.showCountryModify = false
			},

			saveCountry : function (data) {
				debugger
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/country?data=' + data.param, 
					data.formData
				).then(res => {
					if(res.data.code == 0) {
						this.countries.push({
							name : data.country.name,
						})

						this.showCountryModify = false		
						this.$root.$refs.notify.notify(res.data.message,{
							closeable : false
						})
					}
				}).catch(err => {
					this.$root.$refs.notify.notify('Хадгалах явцад алдаа.',{
						closeable : false
					})
				});

				
			}
		},
		components : {
			ModifyCountry
		}
	}
</script>