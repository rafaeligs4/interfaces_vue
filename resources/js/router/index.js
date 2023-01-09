import {createRouter, createWebHistory} from 'vue-router'

import index from '../components/index.vue'; 
import dashboard from '../pages/dashboard.vue';
import sidebar from '../components/sidebar.vue';   
import profile from '../pages/users/profile.vue';
import adminUser from '../pages/users/adminUsers.vue';
import newCar from '../pages/cars/NewCar.vue';
import editType from '../pages/type_cars/EditType.vue';
import adminCars from '../pages/cars/adminCars.vue';
import adminTypeCars from '../pages/type_cars/adminTypeCar.vue';
import editCarType from '../pages/type_cars/editCarType.vue'; 
import editCar from '../pages/cars/EditCar.vue';
import newRent from '../pages/rent/newRent.vue';
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
            },
            {
                path: '/new-rent',
                component: newRent 
            }
    ]
        
    },
]

const router= createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes

})
export default router 

