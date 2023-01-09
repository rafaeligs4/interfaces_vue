<template>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tipo de vehiculo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center">
            <div class="form-row col-md-12">
                <label for="">Nombre del Tipo de Vehiculo</label>
                <input id="id_nv" class="form-control m-1" type="text" @click="error_quitar()"  v-model="form.nombre_tipo_vehiculo">
    <div id="msg_nv"></div>
            </div>
        </div> 
        <div class="d-flex justify-content-center m-1" >
    <div class="form-check form-check-inline">
        <input type="radio" name="Activo" class="form-check-input" value=true id="act" v-model="form.estado">
        <label for="" class="form-check-label">Activo</label>
    </div>
    <div class="form-check form-check-inline">
        <input type="radio" name="Inactivo" class="form-check-input" value=false  id="inact"  v-model="form.estado">
        <label for="" class="form-check-label">Inactivo</label>
    </div>
    </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary" @click="uploadType()"> 
            Subir
        </button>
      </div>
    </div>
  </div>
</div>


</template>
<script setup>

import useValidate from '@vuelidate/core';
import {required,email,minLength} from '@vuelidate/validators';
import axios from 'axios';
import { ref } from 'vue';
import {useRouter} from 'vue-router';
const router=useRouter();
const form = ref({
    nombre_tipo_vehiculo: '',
    estado: false
});
const props = defineProps({
    entrada: Boolean
});
console.log(props.entrada);


const uploadType = () =>{

const formdata=new FormData(); 
    if(validateData()){
        formdata.append('nombre_tipo_vehiculo',form.value.nombre_tipo_vehiculo);
        formdata.append('estado',form.value.estado);
        let response= axios.post('/api/type/create',formdata)
        .then((response)=>{
        console.log(response.data); 
        router.push('/home');
   }); 
    }
};  

const rules = {
    nombre_tipo_vehiculo: {required}, 
    //modelo:{required,minLnegth: minLength(4)},    
};
let v$=useValidate(rules,form.value);
const validateData = () =>{
    v$.value.$validate();
    if(v$.value.$error){
        if(v$.value.nombre_tipo_vehiculo.$error){
        let error_placa= "";
        if(v$.value.nombre_tipo_vehiculo.required.$invalid){
            console.log("sdas");
           error_placa="El campo del nombre del vehiculo es requerido";
           
        }
        document.getElementById("id_nv").classList.add("is-invalid");
        let d_m;
        d_m =document.getElementById("msg_nv");
        d_m.classList.add("invalid-feedback");
        d_m.textContent=error_placa;
        
        } 
        return false;
    }
    return true;
};
const error_quitar= () =>{
    let doc,
    textdoc;
    doc = document.getElementById("id_nv");
    textdoc= document.getElementById("msg_nv");
    if(doc.classList.contains("is-invalid")){
        doc.classList.remove("is-invalid");
        textdoc.classList.remove("invalid-feedback");
        textdoc.textContent="";

    }
}
</script>