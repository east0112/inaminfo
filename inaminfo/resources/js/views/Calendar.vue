<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">カレンダー</h4>
				<div class="body__text">
					カレンダーからイベントや舞台、ラジオ等の情報を検索できます。
				</div>
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
							<calendar-component :dayItems="dayItems"></calendar-component>
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
			</div>
		</div>
		<side-tickets-component></side-tickets-component>
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
	&Operation{
		margin: 40px auto 20px;
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
}
@media screen and (min-width:1143px) { 
	.calendar{
		&Operation{
			width: 60%;
		}
	}
}
@media screen and (max-width:1142px) { 
	.calendar{
		&Operation{
			width: 80%;
			font-size: 14px;
		}
	}
}

</style>