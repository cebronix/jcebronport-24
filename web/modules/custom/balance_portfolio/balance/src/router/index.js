import { createRouter, createWebHashHistory } from 'vue-router'
import SplashView from '@/views/SplashView'
import AboutMode from '@/views/AboutMode'
import GameMode from '@/views/GameMode'
import ContactView from '@/views/ContactView'


const routes = [
  {
    path: '/',
    name: 'splash',
    component: SplashView
  },
  {
    path: '/about',
    name: 'about',
    component: AboutMode
  },
  {
    path: '/play',
    name: 'play',
    component: GameMode
  },
  {
    path: '/contact',
    name: 'contact',
    component: ContactView
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
