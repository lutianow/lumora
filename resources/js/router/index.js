import { createRouter, createWebHistory } from 'vue-router';
import Home from '../pages/Home.vue';
import Cemiterios from '../pages/Cemiterios.vue';
import Quadras from '../pages/Quadras.vue';
import Jazigos from '../pages/Jazigos.vue';
import Sepultamentos from '../pages/Sepultamentos.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/cemiterios',
    name: 'Cemiterios',
    component: Cemiterios
  },
  {
    path: '/quadras',
    name: 'Quadras',
    component: Quadras
  },
  {
    path: '/jazigos',
    name: 'Jazigos',
    component: Jazigos
  },
  {
    path: '/sepultamentos',
    name: 'Sepultamentos',
    component: Sepultamentos
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
