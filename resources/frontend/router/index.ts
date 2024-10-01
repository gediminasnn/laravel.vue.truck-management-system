import { createMemoryHistory, createRouter } from 'vue-router'
import TruckView from '../views/TruckView.vue'

const router = createRouter({
  history: createMemoryHistory(),
  routes: [
    {
      path: '/',
      name: 'Trucks view',
      component: TruckView
    },
  ]
})

export default router
