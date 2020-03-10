import Router from 'vue-router'
import Home from './views/Home.vue'
import About from './views/About.vue'

export default new Router({
  mode: 'history',
  data() {
    return {
      loading: true,
    }
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
        path: '/about',
        name: 'about',
        component: About
      },
    ],
    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 1000);
    }
});