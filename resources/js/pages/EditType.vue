<template>
 <h1>Tipo de vehiculo</h1>
 <div>
    <div v-if="v$.nombre_tipo_vehiculo.$error"> 
                  <span v-if="v$.nombre_tipo_vehiculo.required.$invalid">La Marca es requerida</span>
                
    </div>
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

        <button @click="validateData()"> 
            Subir
        </button>
 </div>
</template>
<script setup>
import useValidate from '@vuelidate/core';
import {required,email,minLength} from '@vuelidate/validators';
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

const rules = {
    nombre_tipo_vehiculo: {required}, 
    //modelo:{required,minLnegth: minLength(4)},    
};
let v$=useValidate(rules,form.value);
const validateData = () =>{
    v$.value.$validate();
    if(v$.value.$error){
        console.log('error');
    }
};
</script>