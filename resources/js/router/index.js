import {createRouter, createWebHistory} from 'vue-router'

import index from '../components/index.vue'; 
import dashboard from '../pages/dashboard.vue';
import sidebar from '../components/sidebar.vue';   
import headup from  '../components/headLink.vue';
//import {ExampleComponent} from '../components/ExampleComponent.vue';
const routes=[

    {
        path:'/home',
        component: sidebar,
        children: [{
            path:'/dashboard',
            component:  dashboard
        }]
        
    },  
    {  
       
    }
]

const router= createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes

})
export default router 
