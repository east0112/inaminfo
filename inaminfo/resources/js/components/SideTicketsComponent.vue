<template>
		<div class="subparts shadow-l1">
			<div class="container">
				<h5 class="heading">応募期間中のチケット</h5>
				<div class="body__subtext">
				{{ result }}
				</div>
			</div>
		</div>
</template>

<script>
export default {
  data: function(){
    return{
		 url:"/vue/load_api",
		 result:""
        }
  },
  created: function () {
	let self = this
	axios.post(this.url,{mode : 'tickets'})
          .then(function(res){
            //vueにバインドされている値を書き換えると表示に反映される
			const responce = res.data;
			self.result = responce.ticketLists[0].ticket_name;
			//self.result = responce.test;

          })
  }
}
</script>

<style>
</style>