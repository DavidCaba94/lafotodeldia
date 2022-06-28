import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Moderate from '../views/Moderate.vue'
import Ranking from '../views/Ranking.vue'
import Historical from '../views/Historical.vue'
import User from '../views/User.vue'
import UserDetail from '../views/UserDetail.vue'
import UserGallery from '../views/UserGallery.vue'
import PrizesGallery from '../views/PrizesGallery.vue'
import VerifyAccount from '../views/VerifyAccount.vue'
import Products from '../views/Products.vue'
import Login from '../views/Login.vue'
import Registro from '../views/Registro.vue'

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
    path: '/user-detail/:id',
    name: 'UserDetail',
    component: UserDetail
  },
  {
    path: '/user-gallery/:id',
    name: 'UserGallery',
    component: UserGallery
  },
  {
    path: '/prizes-gallery/:id',
    name: 'PrizesGallery',
    component: PrizesGallery
  },
  {
    path: '/verify-account/:code',
    name: 'VerifyAccount',
    component: VerifyAccount
  },
  {
    path: '/products',
    name: 'Products',
    component: Products
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/registro',
    name: 'Registro',
    component: Registro
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
