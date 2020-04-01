<template>
	<div>
		<div class="body__subtext" v-if="!loading">
			<template v-if="urls">
				<div v-for="(link,index) in urls" :key="index">
					<link-card-component :link="link"></link-card-component>
				</div>
			</template>
		</div>
		<div v-else>
		<loading-component :loading="loading"></loading-component>
		</div>
	</div>
</template>


<script>
export default {
  data: function(){
    return{
		 url:"/vue/load_api",
		 urls:[],
		 loading:true
        }
  },
  mounted: function () {
	let self = this;
	axios.post(this.url,{mode : 'event', event_id : 173})
          .then(function(res){
			const responce = res.data;
			self.urls = responce.url;
			// ローディング表示終了
			self.loading = false;
          })
  }
}
</script>

<style>
</style>