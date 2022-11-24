<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
let valor = 0;
const typeImg= (id) =>{
    if(id==0){
        valor = 0;
    }else{
        valor = 1;
    }
}
onMounted(async () => {
   getP();
})

let form= ref({
    name:'',
    apellido: '',
    cedula: '',
    no_licencia: '',
    fecha_nac: '',
    fecha_venc: '',
    foto_perfil: '',
    foto_licencia: ''
}); 
const props=defineProps({
    id:{
        type: String,
        default: ''
    }    
})
const getP= async () => {

    let response = await axios.get('/api/edit/'+props.id);  
    console.log(response);
    form.value=response.data.user; 
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
    formdata.append('foto_lic',form.value.foto_licencia); 
    axios.post('/api/upload/'+props.id,formdata)  
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
const uploadImage = (e) =>{
    let file= e.target.files[0];
    let reader = new FileReader(); 
    if(valor==0){
      
       reader.onloadend = (file) => {
        form.value.foto_perfil=reader.result;
        }

    }else{
        console.log("hello there")
        reader.onloadend = (file) => {
        form.value.foto_licencia=reader.result;
        }
    }
    reader.readAsDataURL(file); 
}
const getPhotoPerfil = () =>{
    let photo = "/photo/usuario.svg";
    
    if(form.value.foto_perfil != null){
        if(form.value.foto_perfil.indexOf('base64') != -1){
            photo=form.value.foto_perfil;
        }else{
            photo='/photo/'+form.value.foto_perfil; 
        }
        
        console.log("si la lee");
    }  
    console.log("no la lee");
    return photo;
}
const getPhotoLic = () =>{
    let photo = "/photo/usuario.svg";
    console.log((form.value.foto_licencia));
    if(form.value.foto_licencia != null){

        if(form.value.foto_licencia.indexOf('base64') != -1){
            photo=form.value.foto_licencia; 
        }else{
            photo='/photo/'+form.value.foto_licencia;  
            
        } 
       
        console.log("si la lee");
    }   
    console.log("no la lee");
    return photo; 
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
            <div class="">
                <p>foto de perfil </p>
                <img :src="getPhotoPerfil()" alt="" class="col-2 w-50">
            </div> 
            <div class="">
                <p>foto de licencia </p>
                <img :src="getPhotoLic()" alt="" class="col-2 w-50">
            </div> 
            <form action="">
            <label for="">Agrega una foto de perfil</label>
          
            <input type="file"  @click="typeImg(0)" id="img_perfil" @change="uploadImage">
            </form>
            <form action="">
            <label for="">Agrega una foto de licencia</label>
           
            <input type="file" id="img_lic" @click="typeImg(1)" @change="uploadImage">
            </form>
        <button class="button" v-on:click="uploadData()">
            Subir
        </button>
        </div>
        
    </div>
    
</template>
