<script setup>
import { onMounted, ref } from 'vue';


const typeCars= ref([]); 

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
    }); 
    all_cars();
};
onMounted(()=>{
     
 getTypes();

})
</script> 
 
<template>
<h1>Editar tipos de vehiculos</h1>
<table  id="table_id" class="display table"> 
            <thead>
            <tr>
                <th id="row_head">Id  </th>
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
            <td  class=""> {{car.estado}}</td> 
           
           <td>
           <div class=""> 
               <router-link :to='"/editcartype/"+car.id'>Editar Carro </router-link>  
            </div>       
            
            </td>
            <td>
            <div class="">
              <button @click="eliminarPerfil(car.id)">Eliminar perfil</button> 
            </div> 
            </td>  
            <td>
                <select name="" id="" v-model="car.estado" @change="changeState(car.id,car.estado)">
                   <option value=true>Activo</option>
                   <option value=false>Inactivo</option>
                </select> 
            </td>
        </tr> 
 
        </tbody>
    </table>
</template>