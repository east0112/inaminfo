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
							<div v-if="songs.length" class="eventDetail__setlist">
								<h4 class="heading">セットリスト</h4>
								<table class="eventDetail">
										<tr v-for="(song,index) in songs" :key="index">
											<th class="eventDetail__itemName">{{song.part_name}} - {{song.rank}}</th><td class="eventDetail__itemData">{{song.song_name}}</td>
										</tr>
								</table>
							</div>
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
			<template v-if="urls.length">
				<div v-for="(link,index) in urls" :key="index">
					<div class="eventLink">
						<div class="eventLink__card">
							<link-card-component :link="link"></link-card-component>
						</div>
					</div>
				</div>
			</template>
		</div>
		<div class="subparts">
			<template v-if="tweets.length">
				<div v-for="(tweet,index) in tweets" :key="index">
					<tweet-component :tweet="tweet"></tweet-component>
				</div>
			</template>
			<side-tickets-component></side-tickets-component>
		</div>
	</div>
</template>

<script>
export default {
  data: function(){
    return{
		 url:"/vue/load_api",
		 event:[],
		 songs:[],
		 urls:[],
		 tweets:[],
		 loading:true
        }
  },
  mounted: function () {
	let self = this;
	axios.post(this.url,{mode : 'event', event_id : this.$route.params.event_id})
          .then(function(res){
			const responce = res.data;
			self.event = responce.event;
			self.songs = self.rankFormat(responce.song);
			self.urls = responce.url;
			self.tweets = responce.tweet;
			// ローディング表示終了
			self.loading = false;
          })
  },
  methods:{
	  rankFormat(songs){
		  for(let i = 0 ; i < songs.length ; i++){
			  songs[i].rank = ( '00' + songs[i].rank ).slice( -2 );
		  }
		  return songs;
	  }
  }
}
</script>

<style  lang="scss" scoped>
@import '../../sass/variables';
.event{
	&Detail{
		text-align: left;
		border-collapse:collapse;
		margin:0 auto;
		&__setlist{
			margin-top:30px;
		}
		tr{
			border-bottom: 1px solid $color-border;
		}
		tr:last-child{
			border:none;
		}
	}
}

@media screen and (min-width:$pc-width) { 
	.event{
		&Detail{
			width: 85%;
			&__item{
				&Name{
					width: 10%;
					padding:10px 0;
				}
				&Data{
					width: 90%;
					padding:10px 0;
				}
			}
		}
		&Link{
			display: flex;
			flex-wrap: wrap;
			&__card{
				width:48%;
				margin: 0 1%;
			}
		}
	}
}
@media screen and (max-width:$sp-width) { 
	.event{
		&Detail{
			width: 90%;
			&__item{
				&Name{
					width: 20%;
					padding:10px 0;
				}
				&Data{
					width: 80%;
					padding:10px 0;
				}
			}
		}
	}
}
</style>