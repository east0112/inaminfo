<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">イベント検索結果</h4>
				<template v-if="totalCount > 0">
					{{totalCount}}件が該当しました。
				</template>
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
		 loading:true,
		 totalCount:0
        }
  },
  mounted: function () {
	let self = this;
	const searchWord = this.$route.query.searchWord;
	axios.post(this.url,{mode : 'eventLists', search_word : searchWord})
          .then(function(res){
			const responce = res.data;
			self.eventLists = responce.eventLists;
			self.totalCount = (responce.totalCount) ?responce.totalCount: 0;
			// ローディング表示終了
			self.loading = false;
          })
  }
}
</script>

<style>
</style>