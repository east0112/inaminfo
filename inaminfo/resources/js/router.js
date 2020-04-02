import Router from 'vue-router'
import Home from './views/Home.vue'
import About from './views/About.vue'
import Events from './views/Events.vue'
import EventDetail from './views/EventDetail.vue'
import Calendar from './views/Calendar.vue'
import Search from './views/Search.vue'

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
      {
        path: '/events',
        name: 'events',
        component: Events
      },
      {
        path: '/events/:event_id',
        name: 'eventDetail',
        component: EventDetail
      },
      {
        path: '/calendar',
        name: 'calendar',
        component: Calendar
      },
      {
        path: '/search',
        name: 'search',
        component: Search
      },
    ],
    scrollBehavior (to, from, savedPosition) {
      if (savedPosition) {
         return savedPosition
      } else {
         return { x: 0, y: 0 }
      }
    },
    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 1000);
    }
});