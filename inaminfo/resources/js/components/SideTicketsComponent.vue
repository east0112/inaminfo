<template>
		<div class="subparts shadow-l1">
			<div class="container">
				suba
				{{ result }}
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
	axios.post(this.url)
          .then(function(res){
            //vueにバインドされている値を書き換えると表示に反映される
			// = res.data
			const responce = res.data;
			console.log(responce.test);
			self.result = responce.test;

          })
  }
}
</script>

<style>
</style>