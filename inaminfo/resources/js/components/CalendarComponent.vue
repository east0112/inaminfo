<template>
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
</template>

<script>
export default {
  props: ['dayItems'],
  data: function(){
    return{
        }
  }
}
</script>

<style lang="scss">
.calendar{
	margin-bottom: 40px;
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