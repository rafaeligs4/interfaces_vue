<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import useValidate from '@vuelidate/core';
import {required,email,minLength,numeric,maxLength} from '@vuelidate/validators';



let error_array=[];
let valor = 0;
const typeImg= (id) =>{
    if(id==0){
        valor = 0;
    }else{
        valor = 1;
    }
}


let form= ref({
    name:'',
    apellido: '',
    cedula: '',
    no_licencia: '',
    fecha_nac: '',
    fecha_venc: '',
    foto_perfil: '',
    foto_licencia: '',
    value_error: false
}); 
const props=defineProps({
    id:{
        type: String,
        default: ''
    }    
});
const timeSkip = (date)=>{
    const start= new Date(date);
    console.log(date);   
    const end = new Date();

    end.setFullYear(end.getFullYear()-20);
    if(start<end){
       return true;
    }else{
        return false;
    }
  
   
}
const supSkip = (date)=>{
    const start= new Date(date);
  
    const end = new Date();
   
    if(start>end){
       return true;
    }else{
        return false;
    }
}; 
const rules = {
   name: {required},
   apellido:{required, minLength: minLength(6)},
   
};
let v$=useValidate(rules,form.value);
 
const validateData= ()=>{
    v$.value.$validate();
    if(v$.value.$dirty && v$.value.$invalid){
        console.log('error'); 
        
    }else{
        console.log('no error');
    }
    // console.log(v$.value.name.$error); 
} 

const getP= async () => {

    let response = await axios.get('/api/edit/'+props.id);  
    console.log(response);
    form.value=response.data.user; 
} 

const uploadData= () => {
 //   console.log(form.value.fecha_nac);
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
        console.log(response.data);        
        if(response.data.error != null){
            form.value.value_error=true;
            error_array= response.data.error;
            console.log(error_array);
            console.log('error');
        }
   
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
onMounted(async () => {
   getP();
})
const cambiarState = () =>{
    form.value.value_error=false; 
    error_array.name=null;
}

</script>


<template>
    <div class="container" >
        <div>
            <h1>Editar perfil </h1> 
        </div>
    <div class="form-row">
    <div class="form-group col-md-6">
        <div v-if="form.value_error && error_array.name !=  null">
              <span>{{error_array.name[0]}}</span>
        </div>
        <label for="">Nombre</label>
        <input  v-model="form.name"  class="form-control" placeholder="Nombre" @blur="v$.name.$touch" @change="cambiarState()"> 
    </div>
    <div class="form-group col-md-6">
        <div v-if="form.value_error && error_array.apellido">
                <span>{{error_array.apellido[0]}}</span>
        </div>        
        <label for="">apellido</label>
        <input class="form-control" placeholder="Apellido" v-model="form.apellido">
        
    </div>
        </div>
    <div class="form-row">

        <div class="form-group col-md-6">
                <div v-if="form.value_error && error_array.cedula !=  null">
              <span>{{error_array.cedula[0]}}</span>
            </div>
                <label for="">Cedula</label>
                <input  v-model="form.cedula" class="form-control" placeholder="Cedula"> 
        </div>
        <div  class="form-group col-md-6"> 
                <div v-if="form.value_error && error_array.no_licencia !=  null">
              <span>{{error_array.no_licencia[0]}}</span>
            </div>
                <label for="">No licencia</label>
                <input  v-model="form.no_licencia"  class="form-control" placeholder="No Licencia"> 
        </div>

      
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" >
            <div v-if="form.value_error && error_array.fecha_nac !=  null">
              <span>{{error_array.fecha_nac[0]}}</span>
            </div>
                <label for="">Fecha nacimiento</label>
                <input type="date" class="form-control" v-model="form.fecha_nac">

        </div>
        <div class="form-group col-md-6" >
            <div v-if="form.value_error && error_array.fecha_venc !=  null">
              <span>{{error_array.fecha_venc[0]}}</span>
            </div>
                <label for="">Fecha vencimiento</label>
                <input type="date" class="form-control" v-model="form.fecha_venc">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
        <div v-if="form.value_error && error_array.foto_perfil !=  null">
        <span>{{error_array.foto_perfil[0]}}</span>
        </div>
        <label for="">Foto de perfil</label>
        <div>
        <img :src="getPhotoPerfil()" alt="" class="col-8" >
        </div>
        <div class="m-1 col-12">
            <div class="custom-file">
                 <input type="file" class="custom-file-input"
                 aria-describedby="inputGroupFileAddon01" @click="typeImg(0)" id="img_perfil" @change="uploadImage">
            <label class="custom-file-label" for="inputGroupFile01">Elegir foto</label>
            </div>
        </div>
        </div>
        <div class="col-md-6">
            <div v-if="form.value_error && error_array.foto_licencia !=  null">
              <span>{{error_array.foto_licencia[0]}}</span>
            </div>
            <label for="">Foto de Licencia</label>
               
            <div>
            <img :src="getPhotoLic()" alt="" class="col-8">
            </div>    
            <div class="m-1 col-12">
            <div class="custom-file">
            <input type="file" class="custom-file-input"
            aria-describedby="inputGroupFileAddon01" @click="typeImg(1)" id="img_lic" @change="uploadImage">
            <label class="custom-file-label" for="inputGroupFile01">Elegir foto</label>
            </div>
            </div>
            </div> 
        </div>    
        <div class="col-12  justify-content-center">
            <button type="submit" v-on:click="uploadData()" class="col-auto btn btn-primary">Subir</button>
        </div>
       
    </div> 
       
    
</template>
 