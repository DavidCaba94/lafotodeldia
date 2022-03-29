import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Moderate from '../views/Moderate.vue'
import Ranking from '../views/Ranking.vue'
import Historical from '../views/Historical.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/moderate',
    name: 'Moderate',
    component: Moderate
  },
  {
    path: '/ranking',
    name: 'Ranking',
    component: Ranking
  },
  {
    path: '/historical',
    name: 'Historical',
    component: Historical
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
