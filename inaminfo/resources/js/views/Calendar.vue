<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<h4 class="heading">カレンダー</h4>
				<div class="body__text">
					カレンダーからイベントや舞台、ラジオ等の情報を検索できます。
				</div>
				<calendar-component></calendar-component>
			</div>
		</div>
		<side-tickets-component></side-tickets-component>
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
		 eventLists:[],
		 year:"",
		 month:""
        }
  },
  mounted: function () {
	let self = this;
  },
  methods: {
    moveNext: function (event) {
		let self = this;
	},
    movePrev: function (event) {
		let self = this;
	}
  }
}
</script>

<style lang="scss">

</style>