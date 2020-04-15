<template>
	<div>
		<template v-if="animeTv.length !== 0">
			<h4 class="heading">TVアニメ</h4>
			<div class="castList body__subtext">
				<div v-for="(yearEl,index) in animeTv" :key="index">
					<div class="castList__year">
						<div class="castList__yearHeader">{{index}}</div>
						<div v-for="(cast,index) in yearEl" :key="index" class="castList__yearRow">
							<div class="castList__yearRowTitle">{{cast.cast_name}}</div>
							<div class="castList__yearRowAct">{{cast.act_name}}</div>
						</div>
					</div>
				</div>
			</div>
		</template>
		<template v-if="animeMovie.length !== 0">
			<h4 class="heading">劇場アニメ</h4>
			<div class="castList body__subtext">
				<div v-for="(yearEl,index) in animeMovie" :key="index">
					<div class="castList__year">
						<div class="castList__yearHeader">{{index}}</div>
						<div v-for="(cast,index) in yearEl" :key="index" class="castList__yearRow">
							<div class="castList__yearRowTitle">{{cast.cast_name}}</div>
							<div class="castList__yearRowAct">{{cast.act_name}}</div>
						</div>
					</div>
				</div>
			</div>
		</template>
		<template v-if="game.length !== 0">
			<h4 class="heading">ゲーム</h4>
			<div class="castList body__subtext">
				<div v-for="(yearEl,index) in game" :key="index">
					<div class="castList__year">
						<div class="castList__yearHeader">{{index}}</div>
						<div v-for="(cast,index) in yearEl" :key="index" class="castList__yearRow">
							<div class="castList__yearRowTitle">{{cast.cast_name}}</div>
							<div class="castList__yearRowAct">{{cast.act_name}}</div>
						</div>
					</div>
				</div>
			</div>
		</template>
		<template v-if="article.length !== 0">
			<h4 class="heading">インタビュー</h4>
			<div class="castList body__subtext">
				<div v-for="(yearEl,index) in article" :key="index">
					<div class="castList__year">
						<div class="castList__yearHeader">{{index}}</div>
						<div v-for="(article,index) in yearEl" :key="index" class="castList__yearRow">
							<a v-bind:href="article.link" target="_blank">{{article.article_name}}</a>
						</div>
					</div>
				</div>
			</div>
		</template>
	</div>
</template>

<script>
export default {
  props: ['animeTv','game','animeMovie','article'],
  data: function(){
    return{
	}
  },
  methods:{
  }
}
</script>

<style lang="scss">
@import '../../sass/variables';
.castList{
	margin-bottom: 30px;
	&__year{
		padding-bottom: 10px;
		&Header{
			font-size:1.6em;
			padding: 10px 5px;
			border-bottom: 2px solid $color-border;
		}
		&Row{
			font-size:1em;
			padding: 10px 5px;
			border-bottom: 1px solid $color-border;
			display: flex;
			&Title{
				width: 70%;
			}
			&Act{
				width: 30%;
			}
		}
	}
}
</style>