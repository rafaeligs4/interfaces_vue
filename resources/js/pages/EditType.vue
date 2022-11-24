<template>
 <h1>Tipo de vehiculo</h1>
 <div>
    <label for="">Agregar nombre al tipo de vehiculo</label>
    <input type="text" v-model="form.nombre_tipo_vehiculo">
 </div>   
 <div>
    <div>
        <input type="radio" name="Activo" value=true id="act" v-model="form.estado">
        <label for="">Activo</label>
    </div>
    <div>
        <input type="radio" name="Inactivo" value=false  id="inact"  v-model="form.estado">
        <label for="">Inactivo</label>
    </div>
 </div>
 <div>

        <button @click="uploadType()"> 
            Subir
        </button>
 </div>
</template>
<script setup>
import axios from 'axios';
import { ref } from 'vue';
const form = ref({
    nombre_tipo_vehiculo: '',
    estado: false
});
const uploadType = () =>{
const formdata=new FormData(); 
    formdata.append('nombre_tipo_vehiculo',form.value.nombre_tipo_vehiculo);
    formdata.append('estado',form.value.estado);

   let response= axios.post('/api/type/create',formdata)
   .then((response)=>{
    console.log(response.data); 
   });
 
};  
</script>