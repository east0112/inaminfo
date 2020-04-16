<template>
	<div class="eventTweet shadow-l1">
		<div v-show="!loading">
			<div v-bind:id="tweet.tweet_id"></div>
		</div>
		<div v-show="loading">
			<loading-component :loading="loading"></loading-component>
		</div>
	</div>
</template>

<script>
export default {
  props: ['tweet'],
  data: function(){
    return{
		 loading:true
	}
  },
  mounted: function(){
	let self = this;
	twttr.widgets.createTweet(
		this.tweet.tweet_id,
		document.getElementById(this.tweet.tweet_id),
		{
			theme: "white",
			align: "center",
			dnt:true
		}
	).then(function(el){
		let iframeEl = el.contentWindow.document.querySelector('.EmbeddedTweet');
		el.style.margin = "0px auto 20px";
		iframeEl.style.border = "none";
		self.loading = false;
	}
	);
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';
.eventTweet{
	background-color: $white;
	margin-bottom: 20px;
	border-radius: 15px;
	overflow: hidden;
}
</style>