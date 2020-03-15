<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">イベント検索</h4>
				<div class="body__text">
					イベントや舞台、ラジオ等の情報を検索できます。
				</div>
				<div class="searchArea">
					<div class="searchArea__searchWord">
					<input v-model="searchWord" type="text" placeholder="検索キーワードを入力してください	">
					</div>
					<div class="searchArea__searchButton">
						<button class="shadow-l1" v-on:click="searchEventLists">検索</button>
					</div>
				</div>
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
		 loading:true,
		 searchWord:""
        }
  },
  mounted: function () {
	let self = this;
	const searchWord = this.$route.query.search_word;
	const type = this.$route.query.type;
	const order = this.$route.query.order;
	const from = this.$route.query.from;
	const to = this.$route.query.to;
	axios.post(this.url,{mode : 'eventLists', search_word : searchWord , type : type , from : from, to : to, order :order})
          .then(function(res){
			const responce = res.data;
			self.eventLists = responce.eventLists;
			// ローディング表示終了
			self.loading = false;
          })
  },
  methods: {
    searchEventLists: function (event) {
		let self = this;
		this.loading = true;
		axios.post(this.url,{mode : 'eventLists', search_word : this.searchWord})
			.then(function(res){
				const responce = res.data;
				self.eventLists = responce.eventLists;
				// ローディング表示終了
				self.loading = false;
			})
    }
  }
}
</script>

<style>
.searchArea__searchWord{
	margin: 20px 0;
	text-align: left;
}
.searchArea__searchWord input[type="text"]{
	width: 90%;
	border-top: none;
	border-right: none;
	border-left: none;
	outline: none;
	font-size: 16px;
	padding: 0.5em;
}
.searchArea__searchButton{
	margin: 20px 0;
	text-align: left;
}
.searchArea__searchButton button{
	padding: 0.5em 2em;
	font-size: 0.8em;
	border: none;
	background-color: #FF5192;
	color: #fff;
	border-radius: 5px;
	cursor: pointer;
	outline: none;
}
.searchArea__searchButton button:hover{
	opacity: 0.5;
	transition-duration: 0.3s;
}
@media screen and (max-width:1142px) { 
	.searchArea{
		margin: 10px 5px;
	}
}
@media screen and (min-width:1143px) { 
	.searchArea{
		margin: 20px;
	}
}
</style>