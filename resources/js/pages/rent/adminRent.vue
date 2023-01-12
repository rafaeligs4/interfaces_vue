<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
const form = ref([   
]);
const getRents= async ()=>{
let value = axios.get('/api/get_all_rents').then(response=>{
        console.log(response);
        form.value=response.data.rents;
        console.log(form.value); 
    }); 
} 
onMounted(()=>{
    getRents();
}); 
</script>
<template>
    <div class="container">
     
        <div class="d-flex justify-content-center m-2">
            <h1>Tabla de Alquileres</h1>
        </div>
        <table  id="table_id" class="table table-striped principal rounded"> 
            <thead> 
            <tr>
                <th id="row_head">Id  </th>
                <th id="row_head">Cliente</th>
                <th id="row_head">Auto</th>
                <th id="row_head" >Acciones</th>
                <th id="row_head">Estado</th>
                <th>Imprimir Factura</th>
                <th>Editar</th> 
                
            </tr> 
        </thead>
        <tbody> 
        <tr v-for="rent in form"> 
            <td id="row_id" class="">{{rent.id}} </td>
            <td id="row_marca" class="">{{rent.user_complete}} </td>
            <td id="row_modelo" class=""> {{rent.car_complete}}</td>
            <td id="row_placa" class=""> {{rent.price}}</td>
            <!-- <td id="row_estado" class=""> {{car.estado}}</td>  -->
           <td>
             <div class="">
            <router-link  :to='"/editrent/"+rent.id'>
                <button class="btn btn-dark">Imprimir Factura</button>
            </router-link>  
             </div>     
                                             
            </td>
            <td >
            <div class="">
                <router-link  :to='"/invoice-rent/"+rent.user_id'> 
              <button class="btn btn-danger">Eliminar perfil</button> 
              </router-link>     
            </div> 
            </td>  
            <td > 
                <select name="" id=""   class="form-control" @change="changeState(car.id,car.estado)">
                   <option value="Activo">Activo</option>
                   <option value="Inactivo">Inactivo</option>
                   <option value="Alquilado">Alquilado</option>  
                </select> 
            </td>
        </tr>

        </tbody>
    </table>
    </div>
</template>