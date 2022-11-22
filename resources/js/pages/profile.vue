<script setup>
import axios from 'axios';
import { ref } from 'vue';
let form= ref({
    name:'',
    apellido: '',
    cedula: ''
});
const props=defineProps({
    id:{
        type: String,
        default: ''
    }    
})

const uploadData= () => {
    console.log("sending");
    const formdata=new FormData();
    formdata.append('name',form.value.name);
    formdata.append('apellido',form.value.name);
    formdata.append('cedula',form.value.name);

    axios.post('api/upload/:id',formdata)
    .then((response)=>{
        console.log(response.data)
        
    form.value.name='',
    form.value.apellido='',
    form.value.cedula=''
    })
    .catch((error)=>{
        console.log(error.response)
    })
    ;
}
const uploadImage = () =>{
    
}
const getP= async () => {
    let response = await axios.get('api/edit/'+props.id);
    form.value=response.data.user;
    console.log(form.value);
}
</script>


<template>
    <div class="container">
        <div>
            <h1>Editar perfil </h1> 
        </div>
        <div class="card">
            <div>
                <label for="">Nombre</label>
                <input  v-model="form.name"> 
            </div>
            <div>
                <label for="">apellido</label>
                <input  v-model="form.apellido"> 
            </div>
            <div>
                <label for="">Cedula</label>
                <input  v-model="form.cedula"> 
            </div>
            <form action="">
            <label for="">Agrega una foto</label>
            <input type="file" id="img_perfil" @change="uploadImage">
            </form>
        <button class="button" v-on:click="uploadData()">
            Subir
        </button>
        <button class="button" @click="getP">
            hola mundo
        </button>
        </div>
        
    </div>
    
</template>
