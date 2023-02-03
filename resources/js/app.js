/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'; 

//import 'jquery' ;  

// import jQuery from 'jquery'; 
// //require( 'pdfmake' );  
// var dt= require( 'datatables.net-dt' )(); 
// require( 'datatables.net-buttons-dt' )();
// require( 'datatables.net-buttons/js/buttons.html5.js' )();
// require( 'datatables.net-buttons/js/buttons.print.js' )();
// require( 'datatables.net-searchpanes-dt' )(); 
import router from "./router"


import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */


import headup from './components/headLink.vue';
import sidebar from './components/sidebar.vue';
import modalCar from './components/car-modal.vue'
import index from  './components/index.vue';
import footer from './components/footer.vue';
import editType from './pages/type_cars/EditType.vue';
import editCarType from './pages/type_cars/EditCarType.vue';
import App from './components/App.vue';
const app=createApp(App);
app.component('headup', headup)
.component('foot',footer)
.component('typecar',editType)
.component('index',index)
.component('car-modal',modalCar)
.component('edittc',editCarType);
;
//app.component('app', App); 


/** 
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.use(router).mount('#app');  
