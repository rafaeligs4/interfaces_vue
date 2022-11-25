<script setup>

import axios from 'axios';
import { onMounted, ref } from 'vue';

let cars = ref([]);
const all_cars = async () =>{
    let response = await axios.get("/api/get_all_cars");
   console.log(response.data.carros); 
   cars.value = response.data.carros;  
}
const eliminarPerfil = (num) =>{
    axios.post('/api/delete_car/'+num)
    .then((response)=>{
        console.log(response.data);
        all_cars(); 
    })
    .catch((error)=>{
        console.log(error.response);
    }); 
}
onMounted(async () => {
    all_cars();
});
</script>
<template>
    <div class="container">
        <table class="table bg-blue-dark texto-color">
        <thead>
            <tr>
                <th>Marca  </th>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Estado</th>
                <th>Editar Auto</th>
                <th>Eliminar Auto</th>
                <th>Cambiar Estado</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="car in cars">
            <th class="">{{car.marca}} </th>
            <th class=""> {{car.modelo}}</th>
            <th class=""> {{car.placa}}</th>
            <th class=""> {{car.estado}}</th>
            <th>
            <div class="button-edit"> 
               <router-link :to='"/editcar/"+car.id'>Editar Carro </router-link>  
            </div>      
            
            </th>
            <th>
            <div class="button-edit">
              <button @click="eliminarPerfil(car.id)">Eliminar perfil</button> 
            </div> 
            </th>
            <th></th>
        </tr>

        </tbody>
    </table>
    </div>
</template>