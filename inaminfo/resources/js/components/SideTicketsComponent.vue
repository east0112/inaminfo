<template>
	<div class="container shadow-l1">
		<h4 class="heading">応募期間中のチケット</h4>
		<transition name="fade">
			<div class="body__subtext" v-if="!loading">
				<div v-if="ticketLists.length">
					<div v-for=" (ticket,index) in ticketLists" :key="index" class="subpartsTicket">
						<p class="subpartsTicket__title">{{ticket.ticket_name}}</p>
						<p class="subpartsTicket__date">応募開始：{{ticket.start_time}}</p>
						<p class="subpartsTicket__date">応募終了：{{ticket.end_time}}</p>
						<a v-bind:href="ticket.url" target="_blank">
							<p class="subpartsTicket__link link-icon--outside">
							詳細はこちら
							</p>
						</a>
					</div>
				</div>
				<div v-else>
					現在チケットの抽選および販売はありません。
				</div>
			</div>
		</transition>
		<div v-if="loading">
		<loading-component :loading="loading"></loading-component>
		</div>
	</div>
</template>


<script>
export default {
  data: function(){
    return{
		 url:"/vue/load_api",
		 ticketLists:[],
		 loading:true
        }
  },
  mounted: function () {
	let self = this
	axios.post(this.url,{mode : 'tickets'})
          .then(function(res){
			const responce = res.data;
			self.ticketLists = responce.ticketLists;
			// ローディング表示終了
			self.loading = false;
          })
  }
}
</script>

<style>
</style>