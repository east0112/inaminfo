<template>
	<div class="dateContent shadow-l4">
		<div class="body__subtext" v-if="!loading">
			<event-lists-component :eventLists="eventLists"></event-lists-component>
			<div v-on:click="closeModal()" class="dateContent__closeButton">
				<i class="fas fa-times"></i>
			</div>
		</div>
		<div v-else>
		<loading-component :loading="loading"></loading-component>
		</div>
	</div>
</template>

<script>
export default {
  props: ['date'],
  data: function(){
    return{
		url:"/vue/load_api",
		eventLists:[],
		loading:true
	}
  },mounted: function () {
	let self = this;
	axios.post(this.url,{mode : 'eventLists', from : this.date, to : this.date})
          .then(function(res){
			const responce = res.data;
			self.eventLists = responce.eventLists;
			// ローディング表示終了
			self.loading = false;
          })
  },
  methods:{
	  closeModal(){
		  this.$parent.closeModal();
	  }
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';
.dateContent{
	background-color: $white;
	z-index: 22;
	position: relative;
	border-radius: 5px;
	text-align: right;
	&__closeButton{
		display: inline-block;
		font-size: 1.5rem;
		padding-right: 1.5rem;
		color:$color-link;
		cursor: pointer;
		&:hover{
			opacity: 0.5;
			transition-duration: 0.3s;
		}
	}
}
@media screen and (min-width:$pc-width) { 
	.dateContent{
		width: 800px; 
		padding: 25px;
	}
}
@media screen and (max-width:$sp-width) { 
	.dateContent{
		//width: 100%; 
		padding: 25px 10px;
	}
}
</style>