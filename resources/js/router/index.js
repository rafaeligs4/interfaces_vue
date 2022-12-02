import {createRouter, createWebHistory} from 'vue-router'

import index from '../components/index.vue'; 
import dashboard from '../pages/dashboard.vue';
import sidebar from '../components/sidebar.vue';   
import headup from  '../components/headLink.vue';
import profile from '../pages/profile.vue';
import adminUser from '../pages/adminUsers.vue';
import newCar from '../pages/NewCar.vue';
import editType from '../pages/EditType.vue';
import adminCars from '../pages/adminCars.vue';
import adminTypeCars from '../pages/adminTypeCar.vue';
import editCarType from '../pages/editCarType.vue'; 
import editCar from '../pages/EditCar.vue';
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
            },
                
            {
                path: '/admincars',
                component: adminCars
            },
            {
                path: '/editcar/:id',
                component: editCar,
                props: true 
            },
            {
                path: '/admintypecar',  
                component: adminTypeCars,
              
            },
            {
                path: '/editcartype/:id',
                component: editCarType,
                props: true 
            }
    ]
        
    },
]

const router= createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes

})
export default router 

