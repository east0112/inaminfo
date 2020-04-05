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
										{{year}} <transition name="fade"><span v-if="radio == 'month'">. {{month}}</span></transition>
									</div>
								</div>
								<div class="calendarOperation__right">
									<div class="calendarRadio">
										<div class="calendarRadio__inner">
											<input type="radio" id="month" value="month" v-model="radio">
											<label for="month" class="calendarRadio__left">月</label>
											<input type="radio" id="year" value="year" v-model="radio">
											<label for="year" class="calendarRadio__right">年</label>
										</div>
									</div>
								</div>
							</div>
								<transition name="fade">
									<div v-show="radio == 'month'">
										<calendar-component :dayItems="dayItems"></calendar-component>
									</div>
								</transition>
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
		 radio:"month"
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
		if(this.month < 12){
			this.month++;
		}else{
			this.month = 1;
			this.year++;
		}
		this.loadCalendar();
	},
    movePrev: function () {
		if(this.month > 1){
			this.month--;
		}else{
			this.year--;
			this.month = 12;
		}
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
	}
  }
}
</script>

<style lang="scss">
@import '../../sass/variables';
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
	}
	&Radio{
		//margin: 20px auto;
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
		}
	}
}
@media screen and (max-width:1142px) { 
	.calendar{
		&Operation{
			//width: 80%;
			font-size: 14px;
		}
		&Radio{
			&__inner{
				padding: 0 20px;
				label{
					padding: 5px 15px;
				}
			}
		}
	}
}
</style>