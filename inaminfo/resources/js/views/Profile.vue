<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">出演作品</h4>
				<h4 class="heading">ディスコグラフィ</h4>
				<div class="body__subtext" v-if="!loading">
					<event-lists-component :eventLists="eventLists"></event-lists-component>
					</div>
				<div v-else>
				<loading-component :loading="loading"></loading-component>
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
		 eventLists:[],
		 loading:true
        }
  },
  mounted: function () {
	let self = this;
	axios.post(this.url,{mode : 'eventLists'})
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