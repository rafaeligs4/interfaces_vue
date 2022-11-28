<script setup >
import axios from 'axios';
import { onMounted, ref } from 'vue';
const form = ref({
 
});
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
const uploadType = () =>{
const formdata=new FormData(); 
    formdata.append('nombre_tipo_vehiculo',form.value.nombre_tipo_vehiculo);
   

   let response= axios.post('/api/type/update/'+props.id,formdata)
   .then((response)=>{
    console.log(response.data); 
   });
 
};      


</script>
<template>
 <div>
    <label for="">Agregar nombre al tipo de vehiculo</label>
    <input type="text" v-model="form.nombre_tipo_vehiculo">
 </div>   
  <div>

        <button @click="uploadType()"> 
            Cambiar 
        </button>
 </div>
</template>