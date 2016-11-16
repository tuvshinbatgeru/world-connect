<template>
	<div :class="'core--notify--row ' + showAnimation " 
		 v-if="show"
		 @mouseover="stopTimer"
     	 @mouseleave="startTimer">
		<div class="core--notify--cell __icon">
			<i class="fa fa-info-circle"></i>
		</div>
		<div class="core--notify--cell __message">
			{{ message }}
		</div>	
		<div class="core--notify--cell __close" v-if="closeable">
			<span @click="closeNotify()">&times</span>
		</div>
	</div>
</template>
<script>
	export default {
		props : {
			message: {
				type: String
			},
			type: {
				default: 'Info',
				type: String
			},
			closeable: {
				default: true,
				type: Boolean
			},
			timer: {
				default: 1000,
				type: Number
			},
			showAnimation: {
				default: 'fade--in',
				type: String
			}, 
			closeAnimation: {
				default: 'fade--out',
				type: String
			},
			borderRadius: {
				default: 5,
				type: Number
			},
		},

		data() {
			return {
				show: true,
				timerDestroy : {}
			}
		},

		ready : function () {
			setTimeout(() => {
		      	this.show = true
		    }, 50)

			if (!this.closeable) {
		      	this.startLazyAutoDestroy()
		    }
		},

		methods : {
			closeNotify: function(){
				this.show = false
				this.$emit('close', this)
			},

			startLazyAutoDestroy() {
			    this.clearTimer()
			    this.timerDestroy = setTimeout(() => {
			        this.closeNotify()
			    }, this.timer)
		    },

		    clearTimer() {
		        if (this.timerDestroy) {
		        	clearTimeout(this.timerDestroy)
		        }
		    },

		    startTimer() {
		        if (!this.closeable) {
		        	this.startLazyAutoDestroy()
		        }
		    },

		    stopTimer() {
		        if (!this.closeable) {
		        	this.clearTimer()
		        }
		    }
		}
	}
</script>