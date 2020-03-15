<template>
	<div v-if="eventLists.length">
		<div v-for="event in eventLists" :key="event" class="eventLists">
			<p class="eventLists_title">{{event.event_name}}</p>
		</div>
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
</style>