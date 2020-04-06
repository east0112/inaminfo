<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">カレンダー</h4>
				<div class="body__text">
					カレンダーからイベントや舞台、ラジオ等の情報を検索できます。
				</div>
				<div class="calendar">
					<transition name="fade">
						<div v-if="!loading">
							<div v-if="!error">
							<div class="calendarOperation">
								<div class="calendarOperation__left">
									<div class="calendarOperation__button" v-on:click="movePrev">
										<i class="fas fa-angle-left"></i>
									</div>
									<div class="calendarOperation__button" v-on:click="moveNext">
										<i class="fas fa-angle-right"></i>
									</div>
									<div class="calendarOperation__year">
										{{year}} <transition name="fade"><span v-if="calendarControl == 'month'">. {{month}}</span></transition>
									</div>
								</div>
								<div class="calendarOperation__right">
									<div class="calendarRadio">
										<div class="calendarRadio__inner">
											<input type="radio" id="month" value="month" v-model="calendarControl">
											<label for="month" class="calendarRadio__left">月</label>
											<input type="radio" id="year" value="year" v-model="calendarControl">
											<label for="year" class="calendarRadio__right">年</label>
										</div>
									</div>
								</div>
							</div>
								<transition name="js-accordion" @before-enter="beforeEnter" @enter="enter" @before-leave="beforeLeave" @leave="leave">
									<div v-show="calendarControl == 'year'" class="calendarOperation__month">
										<div class="calendarOperation__monthEl" v-for="(mon,index) in monthDefine" :key="index">
											<div class="calendarOperation__monthElInner" v-on:click="moveMonth(mon.jp)" v-bind:class="(mon.jp == parseInt(month)) ? 'active' : 'inactive' ">
												<div class="calendarOperation__monthElInner--JP">
													<span style="font-size:1.5em">{{mon.jp}}</span>月
												</div>
												<div class="calendarOperation__monthElInner--EN">
													{{mon.en}}
												</div>
											</div>
										</div>
									</div>
								</transition>
								<calendar-component :dayItems="dayItems"></calendar-component>
							</div>
							<div v-else>
								<div class="body__text">
								エラーが発生しました。もう１度お試しください。
								</div>
							</div>
						</div>
					</transition>
						<div v-if="loading">
						<loading-component :loading="loading"></loading-component>
						</div>
				</div>
			</div>
		</div>
		<div class="subparts">
			<side-tickets-component></side-tickets-component>
			<side-suggest-link-component></side-suggest-link-component>
		</div>
	</div>
</template>

<script>
export default {
data: function(){
    return{
		 url:"/vue/load_api",
		 dayItems:[],
		 loading:true,
		 error:false,
		 year:"",
		 month:"",
		 calendarControl:"month",
		 monthDefine:[{ jp : 1 , en : 'Jan.'},
		 			  { jp : 2 , en : 'Feb.'},
		 			  { jp : 3 , en : 'Mar.'},
		 			  { jp : 4 , en : 'Apr.'},
		 			  { jp : 5 , en : 'May.'},
		 			  { jp : 6 , en : 'Jun.'},
		 			  { jp : 7 , en : 'Jul.'},
		 			  { jp : 8 , en : 'Aug.'},
		 			  { jp : 9 , en : 'Sep.'},
		 			  { jp : 10 , en : 'Oct.'},
		 			  { jp : 11 , en : 'Nov.'},
		 			  { jp : 12 , en : 'Dec.'},
		 			 ]
        }
  },
  created: function () {
	  this.year = this.$route.query.year;
	  this.month = this.$route.query.month;
  },
  mounted: function () {
	  this.loadCalendar();
  },
  methods: {
    moveNext: function () {
		if(this.calendarControl === 'year'){
			this.year++;
		}else{
			if(this.month < 12){
				this.month++;
			}else{
				this.month = 1;
				this.year++;
			}
		}
		this.loadCalendar();
	},
    movePrev: function () {
		if(this.calendarControl === 'year'){
			this.year--;
		}else{
			if(this.month > 1){
				this.month--;
			}else{
				this.year--;
				this.month = 12;
			}
		}
		this.loadCalendar();
	},
    moveMonth: function (month) {
		if(this.calendarControl === 'month') return;
		this.month = month;
		this.loadCalendar();
	},
	loadCalendar :function () {
	let self = this;
	self.loading = true;
	axios.post(this.url,{mode : 'calendar', year : this.year , month : this.month})
          .then(function(res){
			const responce = res.data;
			if(responce.status_code === 200){
				self.dayItems = responce.calendar;
				self.year = responce.year;
				self.month = responce.month;
			}else{
				self.error = true;
			}
			self.loading = false;
          })
	},
	beforeEnter: function(el) {
		el.style.height = '0';
	},
	enter: function(el) {
		el.style.height = el.scrollHeight + 'px';
	},
	beforeLeave: function(el) {
		el.style.height = el.scrollHeight + 'px';
	},
	leave: function(el) {
		el.style.height = '0';
	}
  }
}
</script>

<style lang="scss">
@import '../../sass/variables';
.js-accordion{
  &--target{
    transition: height 0.2s ease-in-out;
  }
  &-enter-active{
    animation-duration: 0.3s;
    animation-fill-mode: both;
    animation-name: js-accordion--anime__opend;
  }
  &-leave-active{
    animation-duration: 0.15s;
    animation-fill-mode: both;
    animation-name: js-accordion--anime__closed;
  }
}

@keyframes js-accordion--anime__opend {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
   }
}
@keyframes js-accordion--anime__closed {
  0% {
   opacity: 1;
  }

  100% {
    opacity: 0;
  }
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .15s
}
.fade-enter{
  opacity: 0
}
.fade-leave-to{
	opacity: 0
}
.calendar{
	&Operation{
		margin: 40px auto 20px;
		display: flex;
		justify-content: space-between;
		line-height: 2em;
		color: #FF5192;
		&__left{
			display: flex;
		}
		&__right{
			display: flex;
		}
		&__year{
			font-size: 2em;
			padding:0 15px;
		}
		&__button{
			font-size: 2em;
			cursor: pointer;
			padding: 0 15px;
			&:hover{
				opacity: 0.5;
				transition-duration: 0.3s;
			}
		}
		&__month{
			display: flex;
			flex-wrap: wrap;
			&El{
				text-align:center;
				border-top:1px solid $color-main-thin;
				cursor:pointer;
				&Inner{
					border-radius: 50%;
					width: 70px;
					height: 70px;
					margin: 5px auto;
					color:$color-main;
					position: relative;
					&:hover{
						opacity:0.5;
						transition-duration: 0.3s;
					}
					&.active{
						background-color:$color-main-weak;
						color:$white;
					}
					&--JP{
						position: absolute;
						top:40%;
						left:50%;
						transform:translate(-50%,-50%); 
						white-space: nowrap;
					}
					&--EN{
						position: absolute;
						opacity:0.5;
						font-size:0.8em;
						top:70%;
						left:50%;
						transform:translate(-50%,-50%); 
					}
				}
			}
		}
	}
	&Radio{
		text-align: right;
		&__inner{
			display: inline-block;
			padding: 0 40px;
			font-size: 0;
			input{
				display: none;
				&:checked + label{
					color: $white;
					background-color: $color-main;
					transition-duration: 0.3s;
				}
			}
			label{
				border: 1px solid $color-main;
				color:$color-main;
				font-size: 1rem;
				padding: 7.5px 20px;
				margin-left: -1px;
				cursor: pointer;
				&:first-of-type{
					border-radius: 5px 0 0 5px;
				}
				&:last-of-type{
					border-radius: 0 5px 5px 0;
				}
				&:hover{
					background-color: $color-main-thin;
					transition-duration: 0.3s;
				}
			}
		}
	}
}
@media screen and (min-width:1143px) { 
	.calendar{
		&Operation{
			&__month{
				&El{
					width: 16.6%;
				}
			}
		}
	}
}
@media screen and (max-width:1142px) { 
	.calendar{
		&Operation{
			font-size: 14px;
			&__button{
				padding:0 10px;
			}
			&__year{
				font-size:1.8em;
				padding: 0 0 0 15px;
			}
			&__month{
				&El{
					width: 25%;
					font-size:0.8em;
				}
			}
		&__month{
			&El{
				&Inner{
					border-radius: 50%;
					width: 50px;
					height: 50px;
					margin: 5px auto;
				}
			}
		}

		}
		&Radio{
			&__inner{
				padding: 0;
				label{
					padding: 5px 12px;
				}
			}
		}
	}
}
</style>