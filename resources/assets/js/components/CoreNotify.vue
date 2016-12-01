<template>
	<div :class="'core--notify ' + type + ' ' + position ">
		<core-notify-item 
			v-for="item in items"
			:message="item.message"
			:type="item.options.type"
			:closeable="item.options.closeable"
			:timer="item.options.timer"
			:show-animation="item.options.showAnimation"
			:close-animation="item.options.closeAnimation"
			:border-radius="item.options.borderRadius"
			@close="itemRemoved">
		</core-notify-item>
	</div>
</template>
<script>
	import CoreNotifyItem from './CoreNotifyItem.vue'

	const defaultOptions = {
		  type: 'Info',
		  closeable: true,
		  timer: 2000,
		  showAnimation : 'fade--in',
		  closeAnimation : 'fade--out',
		  borderRadius : 5,
	}

	export default {
		props: {
			position: {
				default: 'right--top',
				type: String
			},	
		},

		data() {
			return {
				items: []
			}
		},

		ready: function(){

		},

		methods : {
			notify: function(message, options) {
				this.items.unshift({
					message : message,
					options: Object.assign({}, defaultOptions, options),
				});
			},

			itemRemoved : function (item) {
				this.items.$remove(item)
			}
		},

		components : {
			CoreNotifyItem
		}
	}
</script>
<style lang="scss">
.core--notify {
	position: fixed;
	max-width: 300px;
	display: table;
	z-index: 1051;
	border-spacing: 0 5px;
	.core--notify--row {
		display: table-row;
		width: 100%;
		color: #fff;
		margin-bottom: 5px;

		.core--notify--cell {
			&:first-child {
				border-radius: 5px 0 0 5px;
		    -moz-border-radius: 5px 0 0 5px;
		  	}
			&:last-child {
			  border-radius: 0 5px 5px 0; 
			  -moz-border-radius: 0 5px 5px 0;
			}
		}

		&.info {
			
		}
		&.warning {

		}
		&.error {

		}
		&.success {

		}

		.core--notify--cell {
			display: table-cell;
			background-color: #5bc0de;
			&.__icon {
				width: 30px;
				text-align: center;
				vertical-align: middle;
			}
			&.__message {
				text-align: left;
				vertical-align: middle;
				font-size: 11px;
				padding: 5px 5px 5px 0px;
			}
			&.__close {
				width: 20px;
				text-align: center;
				vertical-align: middle;
				height: 100%;
				span {
					font-size: 15px;
					cursor: pointer;
					-webkit-transition: background 300ms ease-in-out;
					-moz-transition: background 300ms ease-in-out;
					-ms-transition: background 300ms ease-in-out;
					-o-transition: background 300ms ease-in-out;
					transition: background 300ms ease-in-out;
					border-radius: 100%;
				    width: 16px !important;
				    height: 16px;
				    line-height: 16px;
				    display: block;
				    margin: 0 auto;
					&:hover {
						    background-color: rgba(255, 255, 255, 0.27);
						    
					}
				}
			}
		}
	}
}
.right--top {
	top: 30px;
	right: 50px;
}
.left--top {
	top: 30px;
	left: 50px;
}
.right--bottom {
	bottom: 30px;
	right: 50px;
}
.left-bottom {
	bottom: 30px;
	left: 50px;
}
.fade--in{
  animation: fade--in--animation ease 0.7s;
  animation-iteration-count: 1;
  transform-origin: 50% 50%;
  animation-fill-mode:forwards; /*when the spec is finished*/
  -webkit-animation: fade--in--animation ease 0.7s;
  -webkit-animation-iteration-count: 1;
  -webkit-transform-origin: 50% 50%;
  -webkit-animation-fill-mode:forwards; /*Chrome 16+, Safari 4+*/ 
  -moz-animation: fade--in--animation ease 0.7s;
  -moz-animation-iteration-count: 1;
  -moz-transform-origin: 50% 50%;
  -moz-animation-fill-mode:forwards; /*FF 5+*/
  -o-animation: fade--in--animation ease 0.7s;
  -o-animation-iteration-count: 1;
  -o-transform-origin: 50% 50%;
  -o-animation-fill-mode:forwards; /*Not implemented yet*/
  -ms-animation: fade--in--animation ease 0.7s;
  -ms-animation-iteration-count: 1;
  -ms-transform-origin: 50% 50%;
  -ms-animation-fill-mode:forwards; /*IE 10+*/
}

@keyframes fade--in--animation{
  0% {
    opacity:0;
    transform:  translate(0px,-25px)  ;
  }
  100% {
    opacity:1;
    transform:  translate(0px,0px)  ;
  }
}

@-moz-keyframes fade--in--animation{
  0% {
    opacity:0;
    -moz-transform:  translate(0px,-25px)  ;
  }
  100% {
    opacity:1;
    -moz-transform:  translate(0px,0px)  ;
  }
}

@-webkit-keyframes fade--in--animation {
  0% {
    opacity:0;
    -webkit-transform:  translate(0px,-25px)  ;
  }
  100% {
    opacity:1;
    -webkit-transform:  translate(0px,0px)  ;
  }
}

@-o-keyframes fade--in--animation {
  0% {
    opacity:0;
    -o-transform:  translate(0px,-25px)  ;
  }
  100% {
    opacity:1;
    -o-transform:  translate(0px,0px)  ;
  }
}

@-ms-keyframes fade--in--animation {
  0% {
    opacity:0;
    -ms-transform:  translate(0px,-25px)  ;
  }
  100% {
    opacity:1;
    -ms-transform:  translate(0px,0px)  ;
  }
}
</style>