<template>
	<div class="calendar">
		<div v-if="!loading">
			<div v-if="!error">
				<div class="calendarOperation">
					<div class="calendarOperation__button" v-on:click="movePrev">
						<i class="fas fa-angle-left"></i>
					</div>
					<div class="calendarOperation__year">{{year}} . {{month}}</div>
					<div class="calendarOperation__button" v-on:click="moveNext">
						<i class="fas fa-angle-right"></i>
					</div>
				</div>
				<div class="calendarContent">
					<div class="calendarContent__day header">Sun</div>
					<div class="calendarContent__day header">Mon</div>
					<div class="calendarContent__day header">Tue</div>
					<div class="calendarContent__day header">Wed</div>
					<div class="calendarContent__day header">Thu</div>
					<div class="calendarContent__day header">Fri</div>
					<div class="calendarContent__day header">Sut</div>
					<div v-for="(dayItem,index) in dayItems" :key="index" class="calendarContent__day" v-bind:class="{current:dayItem.current}">
						<div class="calendarContent__dayTitle">{{dayItem.dd}}</div>
						<span class="calendarContent__dayItem calendarContent__dayItem--Event" v-if="dayItem.type['event']">イベント</span>
						<span class="calendarContent__dayItem calendarContent__dayItem--Radio" v-if="dayItem.type['radio']">ラジオ</span>
						<span class="calendarContent__dayItem calendarContent__dayItem--Magazine" v-if="dayItem.type['magazine']">雑誌</span>
						<span class="calendarContent__dayItem calendarContent__dayItem--Program" v-if="dayItem.type['program']">番組</span>
						<span class="calendarContent__dayItem calendarContent__dayItem--Stage" v-if="dayItem.type['stage']">舞台</span>
					</div>
				</div>
			</div>
			<div v-else>
				<div class="body__text">
				エラーが発生しました。もう１度お試しください。
				</div>
			</div>
		</div>
		<div v-else>
		<loading-component :loading="loading"></loading-component>
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
		 month:""
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
	let self = this
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
.calendar{
	margin-bottom: 40px;
	&Operation{
		margin: 40px auto 20px;
		width:60%;
		display: flex;
		justify-content: space-between;
		line-height: 3em;
		color: #FF5192;
		&__year{
			font-size: 2em;
		}
		&__button{
			font-size: 3em;
			cursor: pointer;
			&:hover{
				opacity: 0.5;
				transition-duration: 0.3s;
			}
		}
	}
	&Content{
		display: flex;
		flex-wrap: wrap;
		&__day{
			width: 14.2%;
			height: 100px;
			border-bottom: 1px solid #ccc;
			box-sizing: border-box;
			color: #ccc;
			&.current{
				color: #000;
				cursor: pointer;
			}
			&.header{
				color: #fff;
				background-color: #FF5192;
				height: 2em;
				line-height: 2em;
				padding-left: 0.5em;
			}
		}		
	}
}
@media screen and (min-width:1143px) { 
.calendar{
	&Content{
		&__day{
			&Item{
				display: block;
				font-size: 0.7em;
				color: #fff;
				width: 50%;
				border-radius: 5px;
				text-align: center;

				&--Event{
					background-color: #FF5192;
				}
			}
		}
	}
}
}
@media screen and (max-width:1142px) { 
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