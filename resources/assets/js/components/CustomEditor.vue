<template>
	<div v-show="titleable">
		<input v-model="title" placeholder="гарчиг" />
	</div>
	<div class="editable" :id="id">
			
	</div>
</template>
<script>
	require('medium-editor-insert-plugin')(window.$)

	export default {
		props : {
			title : {

			},

			titleHolder : {
				default : 'Чи юу бодож байна?'
			},

			titleable : {
				type : Boolean,
				default : true
			}
		},

		data () {
			return {
				id: {},
				data : {}
			}
		},

		created : function () {
			this.setId()
		},

		ready : function () {

			var editor = new MediumEditor($('#' + this.id), {
                toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'strikethrough', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'orderedlist', 'unorderedlist', 'pre', 'removeFormat', 'outdent', 'indent', 'h2', 'h3', 'h4', 'h5'],
                },
                placeholder: {
			        /* This example includes the default options for placeholder,
			           if nothing is passed this is what it used */
			        text: this.titleHolder,
			        hideOnClick: true
			    },
                buttonLabels: 'fontawesome',
                anchor: {
                    targetCheckbox: true
                }
            });

			$('#' + this.id).mediumInsert({
		        editor: editor,
		        addons : {
		        	images : {
		        		label: '<span class="fa fa-camera"></span>',
		        		uploadScript: null,
		        		preview: true,
		        		deleteScript: 'delete',
            			deleteMethod: 'DELETE',	
		        		fileUploadOptions: { 
			                url: 'upload',
			                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
			            },
			            messages: {
			                acceptFileTypesError: 'Зурган файл оруулна уу!',
			                maxFileSizeError: 'Файлын хэмжээ их байна'
			            },
		        	},
		        	embeds: { 
		        		label: '<span class="fa fa-youtube-play"></span>',
		            	placeholder: 'YouTube, Vimeo, Facebook, Twitter эсвэл Instagram холбоос хуулах',
		            	oembedProxy : null,
		            	//oembedProxy : 'http://medium.iframe.ly/api/oembed?iframe=1'
		        	}
		        },
		    })
		},

		methods : {
			getContent : function () {
				return $('#' + this.id).html()
			},

			setId : function () {
				this.id = this.newId()
			},

			newId : function () {
				return '_' + Math.random().toString(36).substr(2, 9)
			}
		}
	}
</script>
<style lang="scss">
	.editable {
		background-color : #fff;
		border-radius : 5px;
		padding-left: 10px;
		padding-right: 10px;
		border: 1px solid #E3E3E3;
		&:focus {
			border-color: #AAAAAA;
		}
		&:after {
			padding: 1em 1em !important;
		}
	}
	.medium-insert-buttons-show {
		margin-left: 15px;
    	span {
    		margin-top: 0px !important;
    	}
	}
</style>