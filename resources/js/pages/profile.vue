<script setup>
import axios from 'axios';
import { ref } from 'vue';



let form= ref({
    name:'',
    apellido: '',
    cedula: '',
    no_licencia: '',
    fecha_nac: '',
    fecha_venc: '',
    foto_perfil: '',
    foto_lic: ''
}); 
const props=defineProps({
    id:{
        type: String,
        default: ''
    }    
})
const getP= async () => {
    let response = await axios.get('/api/edit/'+props.id);  
    form.value=response.data.user; 
    console.log(form.value); 
} 
const uploadData= () => {
    console.log("sending");
    const formdata=new FormData();
    formdata.append('name',form.value.name);
    formdata.append('apellido',form.value.apellido);
    formdata.append('cedula',form.value.cedula);
    formdata.append('no_licencia',form.value.no_licencia); 
    formdata.append('fecha_nac',form.value.fecha_nac); 
    formdata.append('fecha_venc',form.value.fecha_venc); 
    formdata.append('foto_perfil',form.value.foto_perfil);
    formdata.append('foto_lic',form.value.foto_lic); 
    axios.post('/api/upload/'+props.id,formdata)  
    .then((response)=>{
        console.log(response.data)
        
    form.value.name='',
    form.value.apellido='',
    form.value.cedula='',
    form.value.foto_perfil=''
    })
    .catch((error)=>{
        console.log(error.response)
    })
    ;
}
const uploadImage = (e) =>{
    let file= e.target.files[0];
    console.log(file);
    let reader = new FileReader(); 
  
    reader.onloadend = (file) => {
        form.value.foto_perfil=reader.result;
    }
    reader.readAsDataURL(file); 
}
const getPhoto = () =>{
    let photo = "upload/usuario.svg"
    if(form.value.foto_perfil){
        photo='upload'+form.value.foto_perfil; 
    }
    return photo
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
            <div>
                <label for="">No licencia</label>
                <input  v-model="form.no_licencia"> 
            </div>
            <div>
                <label for="">Fecha nacimiento</label>
                <input type="date" v-model="form.fecha_nac">

            </div>
            <div>
                <label for="">Fecha vencimiento</label>
                <input type="date" v-model="form.fecha_venc">
                 
            </div>
            <form action="">
            <label for="">Agrega una foto de perfil</label>
          
            <input type="file" id="img_perfil" @change="uploadImage">
            </form>
            <form action="">
            <label for="">Agrega una foto de lic</label>
            <div class="">
                <img :src="getPhoto()" alt="">
            </div> 
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
