import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Moderate from '../views/Moderate.vue'
import Ranking from '../views/Ranking.vue'
import Historical from '../views/Historical.vue'
import User from '../views/User.vue'
import Products from '../views/Products.vue'

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
  },
  {
    path: '/user',
    name: 'User',
    component: User
  },
  {
    path: '/products',
    name: 'Products',
    component: Products
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
