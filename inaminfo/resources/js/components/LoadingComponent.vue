<template>
  <div class="loadingBox" v-if="loading" v-bind:style="{height:height}">
  <img id="animation" src="images/ajax-loader.gif" alt="">
  </div>
</template>

<script>
export default {
  props: ['loading','height'],
  data: function(){
    return{
        }
  }
}
</script>

<style>
</style>