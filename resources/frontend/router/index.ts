import { createMemoryHistory, createRouter } from 'vue-router'
import TruckView from '../views/TruckView.vue'
import SubunitView from '../views/SubunitView.vue'

const router = createRouter({
  history: createMemoryHistory(),
  routes: [
    {
      path: '/',
      name: 'Trucks view',
      component: TruckView
    },
    {
      path: '/subunits',
      name: 'Truck subunits',
      component: SubunitView
    }
  ]
})

export default router
