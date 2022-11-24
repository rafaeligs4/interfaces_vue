import {createRouter, createWebHistory} from 'vue-router'

import index from '../components/index.vue'; 
import dashboard from '../pages/dashboard.vue';
import sidebar from '../components/sidebar.vue';   
import headup from  '../components/headLink.vue';
import profile from '../pages/profile.vue';
import adminUser from '../pages/adminUsers.vue';
import newCar from '../pages/NewCar.vue';
import editType from '../pages/EditType.vue';
//import {ExampleComponent} from '../components/ExampleComponent.vue';
const routes=[

    {
        path:'/home',
        component: sidebar,
        props: true,
        children: [

            {
                path: '/edit/:id',
                component: profile,
                props: true 
            },
            {
            path:'/dashboard',
            component:  dashboard
            },
       
            {
            path: '/adminuser', 
            component: adminUser
            },
            {
                path: '/newcar',
                component: newCar
            },
            {
                path: '/type',
                component: editType
            }
    
    ]
        
    },  
    
,

    {  
       
    }
]

const router= createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes

})
export default router 

