<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">イベント検索</h4>
				<div class="body__text">
					イベントや舞台、ラジオ等の情報を検索できます。
				</div>
				<form @submit.prevent="searchEventLists">
					<div class="searchArea">
						<div class="searchArea__searchWord">
						<input-suggest-component @change="wordUpdate" :searchWord="searchWord"/>
						</div>
						<div class="searchArea__searchType">
							<div class="searchArea__searchTypeEl">
								<input type="checkbox" id="checkEvent" v-model="type" value="1"/>
								<label for="checkEvent">イベント</label>
							</div>
							<div class="searchArea__searchTypeEl">
								<input type="checkbox" id="checkStage" v-model="type" value="5"/>
								<label for="checkStage">舞台</label>
							</div>
							<div class="searchArea__searchTypeEl">
								<input type="checkbox" id="checkRadio" v-model="type" value="2"/>
								<label for="checkRadio">ラジオ</label>
							</div>
							<div class="searchArea__searchTypeEl">
								<input type="checkbox" id="checkMagazine" v-model="type" value="3"/>
								<label for="checkMagazine">雑誌</label>
							</div>
							<div class="searchArea__searchTypeEl">
								<input type="checkbox" id="checkProgram" v-model="type" value="4"/>
								<label for="checkProgram">番組出演</label>
							</div>
						</div>
						<div class="searchArea__searchButton">
							<button class="shadow-l1" type="submit">検索</button>
						</div>
					</div>
				</form>
				<div class="body__subtext" v-if="!loading">
					<pagination-component :paginate="paginate"></pagination-component>
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
import dayjs from 'dayjs'
import VueSuggestInput from 'vue-suggest-input'
dayjs.locale('ja');
export default {
  components:{
	  VueSuggestInput
	},
  data: function(){
    return{
		 url:"/vue/load_api",
		 eventLists:[],
		 paginate:[],
		 loading:true,
		 searchWord:"",
		 type:[1,2,3,4,5],
		 page:""
        }
  },
  created: function (){
	  this.searchWord = this.$route.query.searchWord;
  },
  mounted: function () {
		  this.setParams();
		  this.searchEventLists();
  },
  watch : {
	  '$route' (to, from){
		  this.setParams();
		  this.searchEventLists();
	  }
  },
  methods: {
	setParams: function(){
		this.searchWord = this.$route.query.searchWord;
		if(this.$route.query.type){
			this.type = this.$route.query.type.split(',');
		}
		this.page = this.$route.query.page;

	},
    searchEventLists: function () {
		let self = this;
		this.loading = true;
		document.activeElement.blur();
		axios.post(this.url,{mode : 'eventLists', search_word : this.searchWord, type : this.type.join(), page : this.page})
			.then(function(res){
				const responce = res.data;
				self.eventLists = responce.eventLists;
				self.paginate = responce.paginate;
				// ローディング表示終了
				self.loading = false;
			})
	},
	wordUpdate(searchWord){
		this.searchWord = searchWord
	}
  }
}
</script>

<style>
.searchArea__searchWord{
	margin: 20px 0;
	text-align: left;
	width: 90%;
}
.searchArea__searchType{
	padding: 20px 0;
	display: flex;
	flex-wrap: wrap;
}
.searchArea__searchTypeEl{
	padding-top: 0.5em;
	padding-bottom: 0.5em;
}
.searchArea__searchWord input[type="text"]{
	width: 100%;
	border-top: none;
	border-right: none;
	border-left: none;
	font-size: 16px;
	padding: 0.5em 0;
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
	.searchArea__searchTypeEl{
		width: 46%;
		padding: 10px 0 10px 4%;
	}
	.searchArea__searchWord{
		margin-left: auto;
		margin-right: auto;
	}
}
@media screen and (min-width:1143px) { 
	.searchArea{
		margin: 20px;
	}
	.searchArea__searchTypeEl{
		width: 16%;
		padding: 10px 2%;
	}
}
</style>