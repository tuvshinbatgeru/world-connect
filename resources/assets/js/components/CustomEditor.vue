<template>
	<div v-show="titleable">
		<input v-model="title" placeholder="гарчиг" />
	</div>
	<div class="editable" :id="id">
		{{{html}}}
	</div>
</template>
<script>
	require('medium-editor-insert-plugin')(window.$)

	export default {
		props : {
			title : {

			},

			html : {

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
			/*var currentTextSelection;

			function getCurrentTextColor(){
			    return $(editor.getSelectedParentElement()).css('color');
			}

			var ColorPickerExtension = MediumEditor.extensions.button.extend({
			    name: "colorPicker",
			    action: "applyForeColor",
			    aria: "color picker",
			    contentDefault: "<span class='editor-color-picker'>Text Color<span>",

			    init: function() {
			        this.button = this.document.createElement('button');
			        this.button.classList.add('medium-editor-action');
			        this.button.innerHTML = '<b>Text color</b>';
					
			        //init spectrum color picker for this button
			        initPicker(this.button);
			        
			        //use our own handleClick instead of the default one
			        this.on(this.button, 'click', this.handleClick.bind(this));
			    },
			     handleClick: function (event) {
			     	 //keeping record of the current text selection
			         currentTextSelection = editor.exportSelection();
			         
			         //sets the color of the current selection on the color picker
			         $(this.button).spectrum("set", getCurrentTextColor());

					 //from here on, it was taken form the default handleClick
			         event.preventDefault();
			         event.stopPropagation();

			         var action = this.getAction();

			         if (action) {
			             this.execAction(action);
			         }
			     }
			});

			var pickerExtension = new ColorPickerExtension();

			function setColor(color) {
			    var finalColor = color ? color.toRgbString() : 'rgba(0,0,0,0)';

			    pickerExtension.base.importSelection(currentTextSelection);
			    pickerExtension.document.execCommand("styleWithCSS", false, true);
			    pickerExtension.document.execCommand("foreColor", false, finalColor);
			}

			function initPicker(element) {
			    $(element).spectrum({
			        allowEmpty: true,
			        color: "#f00",
			        showInput: true,
			        showAlpha: true,
			        showPalette: true,
			        showInitial: true,
			        hideAfterPaletteSelect: true,
			        preferredFormat: "hex3",
			        change: function(color) {
			            setColor(color);
			        },
			        hide: function(color) {
			            setColor(color);
			        },
			        palette: [
			            ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
			            ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
			            ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
			            ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
			            ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
			            ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
			            ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
			            ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
			        ]
			    });
			}*/

			var editor = new MediumEditor($('#' + this.id), {
                toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'strikethrough', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'orderedlist', 'unorderedlist', 'pre', 'removeFormat', 'outdent', 'indent', 'h2', 'h3', 'h4', 'h5'],
                },
                placeholder: {
			        text: this.titleHolder,
			        hideOnClick: true
			    },
                buttonLabels: 'fontawesome',
                anchor: {
                    targetCheckbox: true
                },/*
                extensions: {
			        'colorPicker': pickerExtension
			    }*/
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
		        	}
		        },
		    })

		    $('#' + this.id).html(this.html)
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