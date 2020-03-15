<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">InaminTown</h4>
				<div class="body__text">
					inaminfoは、声優・舞台女優として活躍する伊波杏樹さんの出演情報をまとめた非公式ファンサイトです。
				</div>
				<div class="contentLinks">
					<div class="contentLinks__Item">
						<router-link to="/events">
							<div class="contentLinks__ItemText contentLinks__ItemText--event">イベント検索</div>
						</router-link>
					</div>
					<div class="contentLinks__Item">
						<router-link to="/calendar">
							<div class="contentLinks__ItemText contentLinks__ItemText--calendar">カレンダー検索</div>
						</router-link>
					</div>
					<div class="contentLinks__Item">
						<router-link to="/tickets">
							<div class="contentLinks__ItemText contentLinks__ItemText--ticket">カレンダー検索</div>
						</router-link>
					</div>
				</div>
				<h4 class="heading">今月の開催予定イベント</h4>
				<div class="body__subtext" v-if="!loading">
					<event-lists-component :eventLists="eventLists"></event-lists-component>
					</div>
				<div v-else>
				<loading-component :loading="loading"></loading-component>
				</div>
			</div>
		</div>
		<side-tickets-component></side-tickets-component>
	</div>
</template>

<script>
import dayjs from 'dayjs'
dayjs.locale('ja');
export default {
  data: function(){
    return{
		 url:"/vue/load_api",
		 eventLists:[],
		 loading:true
        }
  },
  mounted: function () {
	let self = this;
	const currentDate = dayjs().format('YYYY-MM-DD');
	const endDate = dayjs().endOf('month').format('YYYY-MM-DD');
	console.log(endDate);
	axios.post(this.url,{mode : 'eventLists', from : currentDate, to : endDate})
          .then(function(res){
			const responce = res.data;
			self.eventLists = responce.eventLists;
			// ローディング表示終了
			self.loading = false;
          })
  }
}
</script>

<style>
</style>