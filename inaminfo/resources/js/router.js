import Router from 'vue-router'
import Home from './views/Home.vue'
import About from './views/About.vue'
import Events from './views/Events.vue'
import EventDetail from './views/EventDetail.vue'
import Calendar from './views/Calendar.vue'

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
    ],
    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 1000);
    }
});