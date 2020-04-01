<template>
	<div class="content">
		<div class="mainparts">
			<div class="container shadow-l1">
				<div v-if="!loading">
					<template v-if="event">
						<h4 class="heading">{{event.event_name}}</h4>
						<div class="body__text">
							<table class="eventDetail">
									<tr v-if="event.date">
										<th class="eventDetail__itemName">日時</th><td class="eventDetail__itemData">{{event.date}}</td>
									</tr>
									<tr v-if="event.type_name">
										<th class="eventDetail__itemName">種類</th><td class="eventDetail__itemData">{{event.type_name}}</td>
									</tr>
									<tr v-if="event.place_name">
										<th class="eventDetail__itemName">会場</th><td class="eventDetail__itemData">{{event.place_name}}</td>
									</tr>
									<tr v-if="event.act_name">
										<th class="eventDetail__itemName">役名</th><td class="eventDetail__itemData">{{event.act_name}}</td>
									</tr>
							</table>
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
			<template v-if="urls">
				<div v-for="(link,index) in urls" :key="index">
					<link-card-component :link="link"></link-card-component>
				</div>
			</template>
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
@import '../../sass/variables';
.event{
	&Detail{
		width: 100%;
		text-align: left;
	}
}

@media screen and (min-width:$pc-width) { 
	.event{
		&Detail{
			&__item{
				&Name{
					width: 10%;
					padding:5px 0;
				}
				&Data{
					width: 90%;
					padding:5px 0;
				}
			}
		}
	}
}
@media screen and (max-width:$sp-width) { 
	.event{
		&Detail{
			&__item{
				&Name{
					width: 20%;
				}
				&Data{
					width: 80%;
				}
			}
		}
	}
}
</style>