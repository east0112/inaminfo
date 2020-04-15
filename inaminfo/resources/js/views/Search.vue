<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">イベント</h4>
				<transition name="fade">
					<div v-if="!loading">
						<div class="body__subtext">
						<event-lists-component :eventLists="data.eventLists"></event-lists-component>
						<div v-if="data.eventLists.length !==0" class="searchLink">
							<router-link :to="{ path: '/events', query: { search_word:searchWord }}">
								<span class="searchLink__text">イベントをもっと見る</span>
							</router-link>
						</div>
						</div>
						<cast-lists-component :animeTv="data.anime_tv" :game="data.game" :animeMovie="data.anime_movie" :article="data.article"></cast-lists-component>
					</div>
				</transition>
				<div v-if="loading">
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
		 data:[],
		 loading:true,
		 totalCount:0,
		 searchWord:""
        }
  },
  mounted: function () {
	  this.searchLists();
  },
  watch : {
	  '$route' (to, from){
		  this.searchLists();
	  }
  },
  methods: {
	  searchLists: function (){
		let self = this;
		this.searchWord = this.$route.query.searchWord;
		axios.post(this.url,{mode : 'search', search_word : this.searchWord})
			.then(function(res){
				const responce = res.data;
				self.data = responce;
				self.totalCount = (responce.total_count) ?responce.total_count: 0;
				// ローディング表示終了
				self.loading = false;
			})
	  }
  }
}
</script>

<style lang="scss" scoped>
.searchLink{
	text-align: right;
	padding: 0 20px;
	&__text{
		position: relative;
		&:before{
			content : "\f105";
			font-family:"Font Awesome 5 Free";
			font-weight: 900;
			font-size: 2em;
			position: absolute;
			left: -0.6em;
		}
	}
}
</style>