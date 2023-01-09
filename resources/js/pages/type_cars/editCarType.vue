<script setup> 
import axios from 'axios';
import { onMounted, ref } from 'vue';
import {useRouter} from 'vue-router';
const form = ref({
  created_at:'',
estado: false,
id: '',
nombre_tipo_vehiculo: '', 
updated_at:'' 
  });
let error_array=[];
const props=defineProps({
    id:{
        type: String,
        default: ''
    },   
    modal_stt:{
      type: Boolean,
      default: false
    }
}); 
console.log("el id actual es "+props.id + " Hola mundo");
const getType= ()=>{
  console.log(props.id);
  let value =axios.get('/api/get_type/'+props.id)
    .then(response=>{
        form.value=response.data.tipo;
        
    });
    console.log(form.value);
};

    
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
const cerrar = () =>{
  props.id='';
  props.modal_stt=false;
  form.value="";
}   
const uploadType = () =>{
const formdata=new FormData(); 
    formdata.append('nombre_tipo_vehiculo',form.value.nombre_tipo_vehiculo);
    let response= axios.post('/api/type/update/'+props.id,formdata)
   .then((response)=>{
    console.log(response.data); 
   
   })
   .catch(error=>{
    console.log(error.response);
    error_array=error.response.data.error;
    showErrors(error_array);
   })
   ;

 
};      
document.addEventListener('change',(e)=>{
  console.log('dsaads');
  if(props.id!='' && props.modal_stt){
    console.log('we did it');
  }
});
onMounted(()=>{ 
 if(props.modal_stt){
   
  } 
}); 
</script>
<template>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" @click="uploadType()"> 
            Realizar Cambios
        </button>
      </div>
    </div>
  </div>
</div>   


</template>







