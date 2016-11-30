<script>
	import ModifySchool from './modified/ModifySchool.vue'
	import Paginateable from '../mixins/Paginateable'

	export default {
		mixins : [Paginateable],
		props : {
			title : {},
		},

		data () {
			return {
				schools : [],
				showSchoolModify : false,
				selectedSchool : {},
				schoolInstance : {}
			}
		},

		created : function () {
			this.getSchools()
		},

		methods : {
			pageChanged : function (page) {
				this.pageIndex = page
				this.getSchools()
			},
			getSchools : function () {
				this.$http.get(this.$env.get('APP_URI') + 'admin/school/all?page=' + this.pageIndex).then(res => {
				  	this.schools = res.data.result.data
				  	this.total = res.data.result.total
				}).catch(err => {
				});
			},

			cancelSchool : function () {
				this.showSchoolModify = false
			},

			editSchool : function (data) {
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/school/' 
					+ this.selectedSchool.id, 
					data.formData
				).then(res => {
					if(res.data.code == 0) {
						this.schoolInstance.name = res.data.result.name
						this.schoolInstance.country.name = data.country_name
						this.schoolInstance.degrees = res.data.result.degrees

						this.showSchoolModify = false		
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

			saveSchool : function (data) {
				this.$http.post(
					this.$env.get('APP_URI') + 'admin/school', 
					data.formData
				).then(res => {
					if(res.data.code == 0) {

						var school = res.data.result
						this.schools.push(school)
						this.showSchoolModify = false		
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

			newSchool: function () {
				this.showSchoolModify = true
				this.selectedSchool = null
			},

			setSchool : function (school) {
				this.selectedSchool = school
			},

			updateSchool : function (school) {
				this.schoolInstance = school
				this.$http.get(this.$env.get('APP_URI') + 'admin/school/' + school.id + '/edit').then(res => {
				  	this.selectedSchool = res.data.result
				  	this.showSchoolModify = true
				}).catch(err => {

				});
			},

			deleteSchool : function () {
				this.$http.delete(this.$env.get('APP_URI') + 'admin/school/' + this.selectedSchool.id).then(res => {
					if(res.data.code == 0) {
						this.schools.$remove(this.selectedSchool)
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
			ModifySchool
		}
	}
</script>