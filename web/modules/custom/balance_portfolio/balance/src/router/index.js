import { createRouter, createWebHashHistory } from 'vue-router'
import SplashView from '@/views/SplashView'
import AboutMode from '@/views/AboutMode'
// import CollectionMode from '@/views/CollectionMode.vue'
// import GameMode from '@/views/GameMode'
import ContactView from '@/views/ContactView'
import WorkView from '@/views/WorkView'
import CaseStudy from '@/views/CaseStudy.vue'


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
    path: '/work',
    name: 'work',
    component: WorkView
  },
  // {
  //   path: '/play',
  //   name: 'play',
  //   component: GameMode
  // },
  {
    path: '/resume',
    name: 'resume'
  },
  {
    path: '/contact',
    name: 'contact',
    component: ContactView
  },
  {
    path: '/work/case-study/:pid',
    name: 'case-study',
    component: CaseStudy,
    props: true
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
