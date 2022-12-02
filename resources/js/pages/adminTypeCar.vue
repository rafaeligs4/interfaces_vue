<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';


const typeCars= ref([]); 

let role;
const getTypes= async () =>{
    
   let value = axios.get('/api/get_all_types_cars')
   .then((response)=>{
    typeCars.value=response.data.tipos; 
        console.log(typeCars.value); 
   }); 
 
}
const eliminarPerfil = (num) =>{
    axios.post('/api/type/delete/'+num) 
    .then((response)=>{
        console.log(response.data);
        getTypes();
    })
    .catch((error)=>{
        console.log(error.response);
    });  
}
const changeState = (id,estado) =>{
    const formdata=new FormData();
    formdata.append('estado',estado); 
    console.log(estado);
    axios.post('/api/type/state/'+id,formdata) 
    .then(response=>{
        console.log(response.data);
        getTypes();
    }); 
};
onMounted(()=>{
     
 getTypes();

})
</script> 
 
<template>
<h1>Editar tipos de vehiculos</h1>
<table  id="table_id" class="table table-striped principal"> 
            <thead>
            <tr>
                <th id="row_head " >Id  </th>
                <th id="row_head">Nombre Tipo de Vehiculo</th>
                <th id="row_head">Estado</th> 
               
          <th>Editar Auto</th>
                <th>Eliminar Auto</th>
                <th>Cambiar Estado</th> 
            </tr>
        </thead>
        <tbody>
        <tr v-for="car in typeCars"> 
            <td  class="">{{car.id}} </td>
            <td  class="">{{car.nombre_tipo_vehiculo}} </td>
            <td  class=""> 
                <p v-if="(car.estado)">Activo
                </p>
                <p v-else> Inactivo</p>
            </td> 
           
           <td>
          
               <router-link :to='"/editcartype/"+car.id'>
                <button class="btn btn-dark">
                    Editar Carro 
                </button>
                </router-link>  
               
            </td>
            <td>
            <div class="">
              <button class="btn btn-danger" @click="eliminarPerfil(car.id)">Eliminar perfil</button> 
            </div> 
            </td>  
            <td>
                <select name="" id="" class="form-control" v-model="car.estado" @change="changeState(car.id,car.estado)">
                    <option value=true>Activo</option>
                   <option value=false>Inactivo</option>
                </select> 
            </td>
        </tr> 
 
        </tbody>
    </table>
</template>