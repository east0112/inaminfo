<template>
	<div class="calendarModal">
	</div>
</template>

<script>
export default {
  props: ['event'],
  data: function(){
    return{
	}
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';
.calendarModal{
	width: 600px;
	height: 450px;
	background-color: $white;
	z-index: 21;
}

</style>