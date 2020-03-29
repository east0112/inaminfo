<template>
	<div class="linkCard">
		<div class="linkCardInner">
			<div class="linkCard__image">
				<img :src="link.og_img_cache_url" class="linkCard__imageData" />
			</div>
			<div class="linkCard__text">
				<div class="linkCard__textTitle">
					{{link.og_title}}
				</div>
				<div class="linkCard__textDesc">
					{{link.og_description}}
				</div>
				<div class="linkCard__textDomain">
					{{link.og_domain}}
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
  props: ['link'],
  data: function(){
    return{
	}
  },
  created: function(){
	  this.link["og_domain"] = this.link["url"].match(/^https?:\/{2,}(.*?)(?:\/|\?|#|$)/)[1];
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';
.linkCard{
	border: 1px solid $color-border;
	border-radius: 10px;
	overflow:hidden;
	position: relative;
	&Inner{
		width:100%;
		height:100%;
		cursor: pointer;
		&:hover{
			opacity: 0.5;
			transition-duration: 0.3s;		
		}
	}
	&__image{
		width:100%;
		height: 150px;
		background-color: $color-border;
		&Data{
		width: 100%;
		height: 100%;
		object-fit: cover;
		}
	}
	&__text{
		padding: 5px;
		&Title{
			font-size:1em;
		}
		&Desc{
			font-size: 0.8rem;
			color: $color-desc;
			margin:0.5em 0;
			line-height: 1.0rem;
			height: 2.0rem;
			overflow: hidden;
		}
		&Domain{
			font-size: 0.7rem;
			color: $color-desc;
			position: absolute;
			bottom: 10px;
		}
	}
}
@media screen and (min-width:$pc-width) { 
	.linkCard{
		width: 30%;
		margin: 20px 1.6%;
		height: 240px;
		background-color: $white;
	}
}
@media screen and (max-width:$sp-width) { 
}
</style>