<template>
	<vue-suggest-input v-model="innerSearchWord" :items="items" :max-suggest="5"/>
</template>

<script>
import VueSuggestInput from 'vue-suggest-input'
export default {
  components: {
    VueSuggestInput
  },
  props: ['searchWord'],
  computed: {
    innerSearchWord: {
      get () {
        return this.$props.searchWord;
	  },
	  set (value) {
        this.$emit('change', value);
      }	
    }
  },
  data: function(){
    return{
      url:"/vue/load_api",
      items:[]
    }
  },
  mounted: function(){
    this.doInput();
  },
  watch: {
      innerSearchWord: function(){
        this.doInput();
      }
  },
  methods: {
    doInput: function () {
      let self = this;
      axios.post(this.url,{mode : 'suggest_tags',search_word : this.$props.searchWord})
        .then(function(res){
          const responce = res.data;
          self.items = responce.tags;
        })
    }
  }

}
</script>

<style>
.rnd-container {
  position: relative;
}
.rnd-container:after {
  position: absolute;
  content: "\F002";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  opacity: 0.5;
  top: 0;
  right: 5px;
  line-height: 1.5em;
  font-size: 1.5em;
}
.rnd-button {
  display: none;
}
.rnd-table-container {
  position: absolute;
  max-height: 400px;
  margin-top: -1px;
  border: 1px solid #ccc;
  width: 100%;
  background-color: #fff;
  z-index: 2;
  border-radius: 0 0 10px 10px;
  box-shadow: 0 2px 5px -5px rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}
.rnd-table-container ul {
  padding: 0;
  margin: 5px 0 10px;
}
.rnd-table-container li {
  padding: 0.5em;
  list-style: none;
  line-height: 1.5em;
}
.rnd-table-container li.current {
  background-color: #eee;
}
</style>