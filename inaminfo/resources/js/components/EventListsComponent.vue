<template>
	<div v-if="eventLists.length">
		<table class="eventLists">
			<thead>
				<tr class="eventLists__row">
					<th class="eventLists__col--1">日時</th>
					<th class="eventLists__col--2">種類</th>
					<th class="eventLists__col--3">タイトル</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(event,index) in eventLists" :key="index" class="eventLists__row">
					<td>{{event.date}}</td>
					<td>{{event.type_name}}</td>
					<td v-on:click="routerLink(event.event_id)" class="eventLists__link">{{event.event_name}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div v-else>
		該当するイベントはありません。
	</div>
</template>

<script>
export default {
  props: ['eventLists'],
  data: function(){
    return{
	}
  },
  methods:{
	  routerLink : function(event_id){
		// スクロール開始
		let body = document.getElementById('body');
		body.style.overflow = 'auto';
		window.removeEventListener( 'touchmove' , this.getMoveFun() , { passive: false } );
		this.$router.push({ path: `/events/${event_id}`});
	  }
  }
}
</script>

<style lang="scss">
@import '../../sass/variables';
.eventLists{
	width:100%;
	margin: 40px auto;
	text-align: left;
	border-collapse:collapse;
	&__link{
		color: $color-link;
		cursor: pointer;
		&:hover{
			opacity: 0.5;
			transition-duration: 0.3s;
		}
	}
	&__row{
	line-height: 2em;
	border-bottom: 1px solid #ccc;
	}
	&__row td{
		padding: 0.5em 0;
	}
	&__col{
		&--1{
			width:20%;
		}
		&--2{
			width:15%;
		}
		&--3{
			width:65%;
		}
	}
}
</style>