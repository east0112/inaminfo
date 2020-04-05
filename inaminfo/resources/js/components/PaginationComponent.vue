<template>
	<div class="paginate" v-if="paginate.total_count > 0">
		{{paginate.total_count}}件が見つかりました。
		<ul class="paginateControl" v-if="paginate.max_page > 1">
			<li class="paginateControl__Box" v-on:click="movePagePrev(paginate.current_page - 1)" style="font-size:0.9em" :class='[paginate.current_page != 1 ? "abled" : "disabled"]'><i class="fas fa-angle-double-left"></i></li>
			<li class="paginateControl__Box" v-for="(page,index) in paginate.paginate" :key="index"  v-on:click="movePage(page)" :class='[page == paginate.current_page ? "active" : "inactive"]'>{{page}}</li>
			<li class="paginateControl__Box" v-on:click="movePageNext(paginate.current_page + 1)" style="font-size:0.9em" :class='[paginate.current_page != paginate.max_page ? "abled" : "disabled"]'><i class="fas fa-angle-double-right"></i></li>
		</ul>
	</div>
</template>

<script>
export default {
  props: ['paginate'],
  data: function(){
    return{
	}
  },
  methods: {
	  movePagePrev : function (page){
		  if(page >= 1){
			  this.movePage(page);
		  }
	  },
	  movePageNext : function (page){
		  if(page <= this.paginate.max_page){
			  this.movePage(page);
		  }
	  },
	  movePage : function (page){
		let paginateParam = this.paginate.paginateParam;
		paginateParam.page = page;
		this.$router.replace({ path: '/events', query: this.paginate.paginateParam },() =>{});
	  }
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';
.paginate{
	margin-top: 40px;
	&Control{
		margin-top:15px;
		display: flex;
		padding: 0;
		&__Box{
			min-width:1.7rem;
			height:1.5rem;
			font-size: 0.9rem;
			line-height: 1.5rem;
			text-align: center;
			border:1px solid $color-border;
			color: $color-main;
			margin-left: -1px;
			list-style: none;
			cursor: pointer;
			&.active{
				background-color: $color-main;
				border-color: $color-main;
				color: $white;
			}
			&.disabled{
				color: $color-border;
			}
			&:first-child{
				border-radius: 5px 0 0 5px;
			}
			&:last-child{
				border-radius: 0 5px 5px 0;
			}
		}
	}
}
</style>