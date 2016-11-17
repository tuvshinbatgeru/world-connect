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
				selectedCountry : {},
				countryInstance : {}
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

			editCountry : function (data) {
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/country/' 
					+ this.selectedCountry.id + '?data=' + data.param, 
					data.formData
				).then(res => {
					if(res.data.code == 0) {
						this.countryInstance.name = res.data.country.name
						this.countryInstance.flag_url = res.data.country.flag_url
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
			},

			saveCountry : function (data) {
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/country?data=' + data.param, 
					data.formData
				).then(res => {
					if(res.data.code == 0) {
						this.countries.push(res.data.country)

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
			},

			newCountry: function () {
				this.showCountryModify = true
				this.selectedCountry = null
			},

			setCountry : function (country) {
				this.selectedCountry = country
			},

			updateCountry : function (country) {
				this.countryInstance = country
				this.$http.get(this.$env.get('APP_URI') + 'admin/country/' + country.id + '/edit').then(res => {
				  	this.selectedCountry = res.data.result
				  	this.showCountryModify = true
				}).catch(err => {

				});
			},

			deleteCountry : function () {
				this.$http.delete(this.$env.get('APP_URI') + 'admin/country/' + this.selectedCountry.id).then(res => {
					if(res.data.code == 0) {
						this.countries.$remove(this.selectedCountry)
					}
					this.$root.$refs.notify.notify(res.data.message,{
						closeable : false
					})
				}).catch(err => {
					this.$root.$refs.notify.notify("Устгах явцад алдаа гарлаа.",{
						closeable : false
					})
				})
			},
		},
		components : {
			ModifyCountry
		}
	}
</script>