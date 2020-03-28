<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<div v-if="!loading">
					<template v-if="event">
						<h4 class="heading">{{event.event_name}}</h4>
						<div class="body__text">
							<template v-if="urls">
								<div v-for="(url,index) in urls" :key="index" class="eventDetail_Link">
									<img :src="url.image"/>
								</div>
							</template>
						</div>
					</template>
					<template v-else>
						<h4 class="heading">Error</h4>
						<div class="body__text">
							該当するイベントが見つかりませんでした。
						</div>
					</template>
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
export default {
  data: function(){
    return{
		 url:"/vue/load_api",
		 event:[],
		 urls:[],
		 loading:true
        }
  },
  mounted: function () {
	let self = this;
	axios.post(this.url,{mode : 'event', event_id : this.$route.params.event_id})
          .then(function(res){
			const responce = res.data;
			self.event = responce.event;
			self.urls = responce.url;
			// ローディング表示終了
			self.loading = false;
          })
  }
}
</script>

<style  lang="scss" scoped>
</style>