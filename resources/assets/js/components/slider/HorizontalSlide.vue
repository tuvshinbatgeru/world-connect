<template>
	<div class="Slide__Container">
	<div id="Horizontal__Slide"  class="Horizontal__Slide">
		<button v-show="indexMuch()" @click="moveLeft()" class="white-arrow left">
		</button>

	    <button v-show="(index * step + block) < items.length" @click="moveRight()" class="white-arrow right">
	    </button>
		<div class="Horizontal__Window" :style="'left:-' + moveLength + widthType +';' + 'width:'+ moveWidth + widthType">
		    <div :style="'position:absolute;left: ' + slideWidth * $index + widthType +';' + 'width:' + moveWidth + widthType" class="Horizontal__Content" v-for="item in items">
		    	<component :item="item" :is="item.context">
		    		
		    	</component>
		    </div>
    	</div>
    	<div class="line-nav">
            <div :class="act == index ? 'active' : ''" @click="setIndex(act)" v-for="act in items.length">
            	<hr>
            	</hr>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
	import PrimaryPlanContext from './context/PrimaryPlanContext.vue'
	import PrimarySlide from './context/PrimarySlide.vue'

	export default {
		props: {
			step : {
				default : 1
			},

			slideWidth : {
				default: 258
			},
			widthType : {
				type: String,
				default: 'px'
			},
			items: {

			},
		},

		data () {
			return {
				index : 0,
				windowWidth : null,
			}
		},

		ready : function () {
		    Hammer(document.getElementsByClassName("Horizontal__Window")[0]).on("swipeleft", this.moveRight);
		    Hammer(document.getElementsByClassName("Horizontal__Window")[0]).on("swiperight", this.moveLeft);

		    $(window).resize(this.windowResize)
		    this.windowResize()
		},

		methods : {
			windowResize : function () {
				this.windowWidth = $('.Horizontal__Slide').width()
			},

			setIndex(temp) {
				this.index = temp
			},

			moveLeft : function () {
				if(this.index > 0)
					this.index -= this.step
			},

			moveRight : function () {
				if((this.index * this.step + this.block) < this.items.length)
					this.index += this.step 
			},

			indexMuch : function () {
				return this.index > 0
			},
		},

		computed : {
			block : function () {
				switch (this.widthType){
					case 'px':
						return Math.floor(this.windowWidth / this.slideWidth);
					break;
					case '%':
						return Math.floor(100 / this.slideWidth)
					break;
				}
			},

			moveLength : function () {
				return (this.index * this.moveWidth)
			},

			marginLength : function () {
				return (this.windowWidth % (this.block * this.slideWidth)) / (this.block )
			},

			moveWidth : function () {
				return  this.slideWidth
			}
		},

		components : {
			PrimaryPlanContext, PrimarySlide
		}
	}
</script>
<style lang="scss">
.Slide__Container {
	position: relative;
	height: 475px;
	width: 100%;
	padding: 0px;
	margin: 0px;
}
.Horizontal__Slide {
	position: relative;
	height: 100%;
	width: 100%;
	overflow: hidden;
}

.Horizontal__Window {
	position: absolute;
	left: 0px;
	top: 0;	
	-webkit-transition: all 500ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
   -moz-transition: all 500ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
     -o-transition: all 500ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
        transition: all 500ms cubic-bezier(0.470, 0.000, 0.745, 0.715); /* easeInSine */
}

.Horizontal__Content {
	display: inline-block;
	width: 292px;
	height: 300px;
	color : #fff;
}

.Horizontal__Left {
    position: absolute;
    top: 135px;
    left: 0px;
    z-index: 10;
    color: #bdbdbd;
    width: 50px;
    text-align: center;
    height: 80px;
    line-height: 80px;
    border-radius: 5px;
    background-color: rgba(0, 0, 0, 0.46);
    font-size: 30px;
    -webkit-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
   -moz-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
     -o-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
        transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); /* easeInSine */
    &:hover {
    	color: #eee;
    }
}

.Horizontal__Right {
	position: absolute;
    top: 135px;
    right: 0px;
    z-index: 10;
    color: #bdbdbd;
    width: 50px;
    text-align: center;
    height: 80px;
    line-height: 80px;
    border-radius: 5px;
    background-color: rgba(0, 0, 0, 0.46);
    font-size: 30px;
    -webkit-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
   -moz-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
     -o-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
        transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); /* easeInSine */
    &:hover {
    	color: #eee;
    }
}
.line-nav {
	position: absolute;
	bottom: 10px;
	text-align: center;
	left: 0px;
	right: 0px;
	z-index: 10;
	div {
		display: inline-block;
        /* size of bullet elment */
        width: 110px;
        margin-right: 30px;
        height: auto;
        overflow: hidden;
        cursor: pointer;
		hr {
	        -webkit-transition: all 300ms ease-in-out;
			-moz-transition: all 300ms ease-in-out;
			-ms-transition: all 300ms ease-in-out;
			-o-transition: all 300ms ease-in-out;
			transition: all 300ms ease-in-out;
			margin: 5px 0px;
			border-top: 2px solid #fff;
		}
        &:hover {
        	hr {
        		border-top-color: #ff5500;
        		border-width: 4px;
        	}
        }
        &:last-child {
        	margin-right: 0px;
        }
	}
	.active {
		hr {
		border-top-color: #ff5500;
		}
	}
}
</style>