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
					<td><router-link v-bind:to='"/events/" + event.event_id'>{{event.event_name}}</router-link></td>
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
  }
}
</script>

<style>
.eventLists{
	width:100%;
	margin: 40px auto;
	text-align: left;
	border-collapse:collapse;
}
.eventLists__row{
	line-height: 2em;
	border-bottom: 1px solid #ccc;
}
.eventLists__row td{
	padding: 0.5em 0;
}
.eventLists__col--1{
	width:20%;
}
.eventLists__col--2{
	width:15%;
}
.eventLists__col--3{
	width:65%;
}
</style>