import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    
    {
      path: '/acessibilidade/listagem',
      name: 'listagemAcessibilidade',
      component: () => import('../views/acessbilidades/listagem.vue')
    },
    {
      path: '/acessibilidade/cadastro',
      name: 'cadastroAcessibilidade',
      component: () => import('../views/acessbilidades/cadastro.vue')
    },
    {
      path: '/acessibilidade/edicao/:id',
      name: 'edicaoAcessibilidade',
      component: () => import('../views/acessbilidades/edicao.vue')
    },

    {
      path: '/veiculo/cadastro',
      name: 'cadastroVeiculos',
      component: () => import('../views/veiculos/cadastro.vue')
    },
    {
      path: '/veiculo/listagem',
      name: 'listagemVeiculos',
      component: () => import('../views/veiculos/listagem.vue')
    },
    {
      path: '/veiculo/edicao/:id',
      name: 'edicaoVeiculos',
      component: () => import('../views/veiculos/edicao.vue')
    },
    
  ]
})

export default router
