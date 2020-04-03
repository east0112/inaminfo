<template>
	<div class="calendarContent">
		<div class="calendarContent__day header">Sun</div>
		<div class="calendarContent__day header">Mon</div>
		<div class="calendarContent__day header">Tue</div>
		<div class="calendarContent__day header">Wed</div>
		<div class="calendarContent__day header">Thu</div>
		<div class="calendarContent__day header">Fri</div>
		<div class="calendarContent__day header">Sat</div>
		<div v-for="(dayItem,index) in dayItems" :key="index" class="calendarContent__day" v-bind:class="{current:dayItem.current}">
			<div class="calendarContent__dayWrap" v-on:click="displayDayInfo(dayItem)">
				<div class="calendarContent__dayTitle">{{dayItem.dd}}</div>
				<span class="calendarContent__dayItem calendarContent__dayItem--Event" v-if="dayItem.type['event']">イベント</span>
				<span class="calendarContent__dayItem calendarContent__dayItem--Radio" v-if="dayItem.type['radio']">ラジオ</span>
				<span class="calendarContent__dayItem calendarContent__dayItem--Magazine" v-if="dayItem.type['magazine']">雑誌</span>
				<span class="calendarContent__dayItem calendarContent__dayItem--Program" v-if="dayItem.type['program']">番組</span>
				<span class="calendarContent__dayItem calendarContent__dayItem--Stage" v-if="dayItem.type['stage']">舞台</span>
			</div>
		</div>
		<transition name="modal">
			<template v-if="eventModal">
				<div class="modal">
					<div class="modalInner" v-on:click="closeModal">
					</div>
						<div class="modalContent">
							<date-event-modal-component :date="date"></date-event-modal-component>
						</div>
				</div>
			</template>
		</transition>
		<div class="modalBg" v-if="eventModal">
		</div>
	</div>
</template>

<script>
const movefun = function(event){
	event.preventDefault();
}
export default {
  props: ['dayItems'],
  data: function(){
    return{
		eventModal:false,
		date:""
        }
  },
  methods:{
	  displayDayInfo(dayItem){
		  if(dayItem.type['event'] || dayItem.type['radio'] || dayItem.type['magazine'] || dayItem.type['program'] || dayItem.type['stage']){
			// スクロール停止
			let body = document.getElementById('body');
			body.style.overflow = 'hidden';
			window.addEventListener( 'touchmove' , movefun , { passive: false } );

			this.eventModal = true;
			this.date = dayItem.date;
		  }
	  },
	  closeModal(){
			this.eventModal = false;
			this.date = "";
			// スクロール停止
			let body = document.getElementById('body');
			body.style.overflow = 'auto';
			window.removeEventListener( 'touchmove' , movefun , { passive: false } );
	  }
  }
}
</script>

<style lang="scss">
@import '../../sass/variables';
.modal{
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 19;
	overflow: hidden;
	height: 100%;
	width: 100%;
	&Bg{
		position: fixed;
		top:0;
		right:0;
		bottom:0;
		left:0;
		height: 100vh;
		width: 100%;
		z-index: 18;
		background:rgba(0,0,0,0.3);
	}
	&Inner{
		height: 100vh;
		position: relative;
		width: 100%;
		z-index: 21;
	}
	&Content{
		position: absolute;
		top: 50%;
		left: 50%;
		transform:translate(-50%,-50%); 
		z-index: 22;
	}
}

.modal-enter {
  transform: translate(0, 100px);
  opacity: 0;
}
.modal-enter-to {
  opacity: 1;
}
.modal-enter-active {
  transition: all 0.3s 0s ease;
}
.modal-leave {
  transform: translate(0, 0);
  opacity: 1;
}
.modal-leave-to {
  transform: translate(0, 100px);
  opacity: 0;
}
.modal-leave-active {
  transition: all 0.3s 0s ease;
}


.calendar{
	margin-bottom: 40px;
	&Content{
		display: flex;
		flex-wrap: wrap;
		&__day{
			width: 14.2%;
			height: 100px;
			border-bottom: 1px solid $color-border;
			box-sizing: border-box;
			color: $color-disabled;
			&Wrap{
				height: 100%;
				&:hover{
					opacity: 0.5;
					cursor: pointer;
				}
			}
			&.current{
				color: $black;
				cursor: pointer;
			}
			&.header{
				color: #fff;
				background-color: $color-main;
				height: 2em;
				line-height: 2em;
				padding-left: 0.5em;
			}
			&Item{
				display: block;
				color: $white;
				border-radius: 5px;
				text-align: center;

				&--Event{
					background-color: $color-event;
				}
				&--Radio{
					background-color: $color-radio;
				}
				&--Magazine{
					background-color: $color-magazine;
				}
				&--Program{
					background-color: $color-program;
				}
				&--Stage{
					background-color: $color-stage;
				}
				
			}
		}
	}
}
@media screen and (min-width:$pc-width) { 
	.calendar{
		&Content{
			&__day{
				&Item{
					font-size: 0.7em;
					width: 50%;
					margin: 0.2em 0;
				}
			}
		}
	}
}
@media screen and (max-width:$sp-width) { 
	.calendar{
		&Content{
			&__day{
				height: 60px;
				font-size: 10px;
			}
		}
	}
}
</style>