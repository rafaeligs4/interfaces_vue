<script setup> 
import axios from 'axios';
import { onMounted, ref } from 'vue';
import {useRouter} from 'vue-router';
const router=useRouter()

const form = ref({
 
});
let error_array=[];
const props=defineProps({
    id:{
        type: String,
        default: ''
    }    
}); 
const getType= ()=>{
    let value =axios.get('/api/get_type/'+props.id)
    .then(response=>{
        form.value=response.data.tipo;
        console.log(form.value);  
    });
};
onMounted(()=>{
    getType();
});
const error_quitar = ()=>{
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
const showErrors=(error)=>{
    if(error.nombre_tipo_vehiculo != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_nv");
        textdoc=document.getElementById("msg_nv");
        error_msg=error.nombre_tipo_vehiculo[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    } 
}
const uploadType = () =>{
const formdata=new FormData(); 
    formdata.append('nombre_tipo_vehiculo',form.value.nombre_tipo_vehiculo);
   

   let response= axios.post('/api/type/update/'+props.id,formdata)
   .then((response)=>{
    console.log(response.data); 
    router.push('/home');
   })
   .catch(error=>{
    console.log(error.response);
    error_array=error.response.data.error;
    showErrors(error_array);
   })
   ;
   
 
};      


</script>
<template>
  <div class="d-flex justify-content-center">
    <div class="form-row col-md-4">
    <label for="">Nombre del Tipo de Vehiculo</label>
    <input id="id_nv" class="form-control m-1" type="text" @click="error_quitar()"  v-model="form.nombre_tipo_vehiculo">
    <div id="msg_nv">

    </div>
    </div>
   </div> 
   <div class="d-flex justify-content-center m-1">

<button class="btn btn-primary" @click="uploadType()"> 
    Subir
</button>
</div>
</template>