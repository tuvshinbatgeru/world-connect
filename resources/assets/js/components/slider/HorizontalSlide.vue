<template>
	<div :id="slideId" class="Slide__Container" :style="'height:' + slideHeight + 'px'">
		<div :id="horizontalId"  class="Horizontal__Slide">
			<button v-show="indexMuch()" @click="moveLeft()" :class="'left ' + this.arrowClass">
			</button>

		    <button v-show="(index * step + block) < items.length" @click="moveRight()" :class="'right ' + this.arrowClass">
		    </button>
			<div class="Horizontal__Window" :style="'left:-' + moveLength + widthType +';' + 'width:'+ moveWidth + widthType">
			    <div :style="'position:absolute;left: ' + slideWidth * $index + widthType +';' + 'width:' + moveWidth + widthType" class="Horizontal__Content" v-for="item in items">
			    	<component :item="item" :is="item.context">
			    		
			    	</component>
			    </div>
	    	</div>
	    	<div v-show="bullet == 1" class="bullet-nav">
	            <div :class="act == index ? 'active' : ''" @click="setIndex(act)" v-for="act in items.length">
	            </div>
	        </div>
	    </div>
    </div>
</template>
<script>
	import PrimaryPlanContext from './context/PrimaryPlanContext.vue'
	import PrimarySlide from './context/PrimarySlide.vue'
	import AlbumSlide from './context/AlbumSlide.vue'
	import SchoolContext from './context/SchoolContext.vue'

	export default {
		props: {
			step : {
				default : 1
			},

			slideWidth : {
				default: 258
			},

			slideHeight : {
				default: 300
			},

			widthType : {
				type: String,
				default: 'px'
			},

			items: {

			},

			bullet: {
				type : Number,
      			default : 1
			},

			arrowClass : {
				type: String,
				default: 'white-arrow'
			},
		},

		data () {
			return {
				index : 0,
				windowWidth : null,
				slideId : {},
				horizontalId : {}
			}
		},

		created : function () {
			this.slideId = this.$tools.newId()
			this.horizontalId = this.$tools.newId()
		},

		ready : function () {
		    Hammer(document.getElementById(this.slideId)).on("swipeleft", this.moveRight);
		    Hammer(document.getElementById(this.slideId)).on("swiperight", this.moveLeft);

		    $(window).resize(this.windowResize)
		    this.windowResize()
		},

		methods : {
			windowResize : function () {
				this.windowWidth = $('#' + this.slideId).width()
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
			PrimaryPlanContext, PrimarySlide, AlbumSlide, SchoolContext
		}
	}
</script>
<style lang="scss">
.Slide__Container {
	position: relative;
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
.bullet-nav {
	position: absolute;
	bottom: 10px;
	text-align: center;
	left: 0px;
	right: 0px;
	z-index: 20;
	div {
		display: inline-block;
        /* size of bullet elment */
        width: 24px;
        height: 24px;
        border-radius: 50%;
        margin-right: 30px;
        overflow: hidden;
        cursor: pointer;
        background-color: #fff;
        opacity: 0.4;
        -webkit-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
	    -moz-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
	    -o-transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); 
        transition: all 300ms cubic-bezier(0.470, 0.000, 0.745, 0.715); /* easeInSine */
        &:hover {
        	opacity: 0.8;
        }
        &:last-child {
        	margin-right: 0px;
        }
        &.active {
        	opacity: 0.8;
		}
	}
}
</style>