<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import useValidate from '@vuelidate/core';
import {required,email,minLength,numeric,maxLength} from '@vuelidate/validators';
import {useRouter} from 'vue-router';
const router=useRouter()


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
const showErrors = (error)=>{
    
    if(error.name != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_name");
        textdoc=document.getElementById("msg_name");
        error_msg=error.name[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.apellido!= null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_apellido");
        textdoc=document.getElementById("msg_apellido");
        error_msg=error.apellido[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.cedula != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_cedula");
        textdoc=document.getElementById("msg_cedula");
        error_msg=error.cedula[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.no_licencia != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_no_licencia");
        textdoc=document.getElementById("msg_no_licencia");
        error_msg=error.no_licencia[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.fecha_nac != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_fecha_nac");
        textdoc=document.getElementById("msg_fecha_nac");
        error_msg=error.fecha_nac[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.fecha_venc != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_fecha_venc");
        textdoc=document.getElementById("msg_fecha_venc");
        error_msg=error.fecha_venc[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg;
    }
       
}
const error_quitar = (id) =>{
    let doc,
    textdoc;
    if(id==0){
        doc = document.getElementById("id_name");
        textdoc= document.getElementById("msg_name");
    }else if(id==1){
        doc = document.getElementById("id_apellido");
        textdoc= document.getElementById("msg_apellido");
    }
    else if(id==2){
        doc = document.getElementById("id_cedula");
        textdoc= document.getElementById("msg_cedula");
    }
    else if(id==3){
        doc = document.getElementById("id_no_licencia");
        textdoc= document.getElementById("msg_no_licencia");
    }
    else if(id==4){
        doc = document.getElementById("id_fecha_nac");
        textdoc= document.getElementById("msg_fecha_nac");
    }
    else if(id==5){
        doc = document.getElementById("id_fecha_venc");
        textdoc= document.getElementById("msg_fecha_venc");
    }
    if(doc.classList.contains("is-invalid")){
        doc.classList.remove("is-invalid");
        textdoc.classList.remove("invalid-feedback");
        textdoc.textContent="";
 
    } 
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
        console.log(response.status);        
        router.push('/home');
    })
    .catch((error)=>{
      //  console.log(error.status);        
      error_array= error.response.data.error;
            console.log(error_array);
        console.log(error.response);
        console.log(error.response.data.error);
        showErrors(error_array);
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
        <div class="d-flex justify-content-center m-2">
            <h1>Editar perfil </h1> 
        </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      
        <label for="">Nombre</label>
        <input  v-model="form.name"  id="id_name" class="form-control" placeholder="Nombre" @click="error_quitar(0)" @change="cambiarState()"> 
        <div id="msg_name">
        </div>
    </div>
    <div class="form-group col-md-6">
             
        <label for="">apellido</label>
        <input id="id_apellido"  class="form-control" placeholder="Apellido" @click="error_quitar(1)" v-model="form.apellido">
          <div id="msg_apellido" >
              
            
        </div> 
    </div>
        </div>
    <div class="form-row">

        <div class="form-group col-md-6">
              
                <label for="">Cedula</label>
                <input id="id_cedula"   v-model="form.cedula" class="form-control" @click="error_quitar(2)" placeholder="Cedula"> 
                  <div id="msg_cedula">
             
                  </div>
        </div>
        <div  class="form-group col-md-6"> 
             
                <label for="">No licencia</label>
                <input id="id_no_licencia"  v-model="form.no_licencia"  class="form-control" @click="error_quitar(3)" placeholder="No Licencia"> 
                   <div id="msg_no_licencia">
              
                  </div>
        </div>

      
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" >
                <label for="">Fecha nacimiento</label>
                <input id="id_fecha_nac" type="date" class="form-control" @click="error_quitar(4)" v-model="form.fecha_nac">
                <div id="msg_fecha_nac">

                </div>
        </div>
        <div class="form-group col-md-6" >
                <label for="">Fecha vencimiento</label>
                <input id="id_fecha_venc" type="date" class="form-control" @click="error_quitar(5)" v-model="form.fecha_venc">
                <div id="msg_fecha_venc">

                </div>
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
 