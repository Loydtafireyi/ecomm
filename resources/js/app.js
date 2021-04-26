require('./bootstrap');

// require('alpinejs');

import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes';
import StoreData from './store';
import Vuex from 'vuex'

Vue.use(Vuex)
Vue.use(VueRouter) 

const store = new Vuex.Store(StoreData)

const router = new VueRouter(routes)

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!store.getters.loggedIn) {
        next({
          path: '/login',
        })
      } else {
        next()
      }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
      if (store.getters.loggedIn) {
        next({
          path: '/wallet',
        })
      } else {
        next()
      }
    } else {
      next()
    }
  })

const app = new Vue({
    el: '#app',
    // components: { App },
    store,
    router: router,
    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn
        }
    },
});
