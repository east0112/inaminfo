<template>
	<div>
		<transition name="fade">
			<div class="body__subtext" v-if="!loading">
				<template v-if="urls">
					<div v-for="(link,index) in urls" :key="index">
						<link-card-component :link="link"></link-card-component>
					</div>
				</template>
			</div>
		</transition>
		<div v-if="loading">
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
	if(this.$store.state.cache.urls.cache){
		this.urls = this.$store.state.cache.urls.data;
		this.loading = false;
	}else{
		axios.post(this.url,{mode : 'event', event_id : 173})
			.then(function(res){
				const responce = res.data;
				self.urls = responce.url;
				self.loading = false;
				self.$store.state.cache.urls.cache = true;
				self.$store.state.cache.urls.data = responce.url;
			})
	}
  }
}
</script>

<style>
</style>