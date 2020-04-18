import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
let cacheTickets = {
  data: [],
  cache: false
};
let cacheUrls = {
  data: [],
  cache: false
};
const cache = {
  tickets: cacheTickets,
  urls: cacheUrls
};
export default new Vuex.Store({
    state: {
      cache: cache,
    }
  });