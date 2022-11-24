<script setup>
//importando clases
import axios from 'axios';
import { onMounted, ref } from 'vue';
let valor = 0;
//para identificar los tipos de imagen
const typeImg= (id) =>{
    if(id==0){
        valor = 0;
    }else{
        valor = 1;
    }
}

let form= ref({
    marca:'',
    modelo: '',
    color: '',
    placa: '',
    tipo: '',
    estado: '',
    foto1: '',
    foto2: '',
    foto3: '',
    foto4: '',
    select_values: []
}); 
const value_select=form.value.select_values;
const getP= async () => {
    console.log(value_select);
} 

const uploadData= () => {
    console.log("sending");
    const formdata=new FormData();
    formdata.append('marca',form.value.marca);
    formdata.append('modelo',form.value.modelo);
    formdata.append('color',form.value.color);
    formdata.append('placa',form.value.placa); 
    formdata.append('tipo',form.value.tipo); 
    formdata.append('estado',form.value.estado); 
    formdata.append('foto1',form.value.foto1);
    formdata.append('foto2',form.value.foto2);
    formdata.append('foto3',form.value.foto3);
    formdata.append('foto4',form.value.foto4);
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
const getTypes= async () =>{
   let value = axios.get('/api/get_all_types_cars')
   .then((response)=>{
        form.value.select_values=response.data.tipos;
        console.log(form.value.select_values); 
   });
}

onMounted(()=>{
 getP();
 getTypes();
});
</script>
<template>
    <h1>Hola</h1>
    <div class="container">
        <div>
            <h1>Editar perfil </h1> 
        </div>
        <div class="card">
            <div>
                <label for="">Marca</label>
                <input  v-model="form.marca"> 
            </div>
            <div>
                <label for="">Modelo</label>
                <input  v-model="form.modelo"> 
            </div>
            <div>
                <label for="">Placa</label>
                <input  v-model="form.placa"> 
            </div>
            <div>
                <label for="">Color</label>
                <input  v-model="form.color"> 
            </div>
            <div>
                <label for="">estado</label>
                <input type="" v-model="form.estado">


            </div>
            <div>
                <label for="">tipo</label>
            <select name="" id="" v-model="form.tipo">
                   <option v-for="tipo in form.select_values" 

                   :value="{tipo: nombre_tipo_vehiculo}"> 
                   
                   {{tipo.nombre_tipo_vehiculo}}
                   
                   </option>
            </select>    
                 
            </div>
            <div> 
                <router-link to="/type"> 
                    <button>Agregar Tipo</button>
              
                </router-link>
               
            </div>
          
            <div class="">
                <p>Foto principal</p>
                <img :src="getPhotoPerfil()" alt="" class="col-2 w-50">
            </div> 
            <div class="">
                <p>Foto Secundaria</p>
                <img :src="getPhotoPerfil()" alt="" class="col-2 w-50">
            </div> 
            <div class="">
                <p>Foto secundaria</p>
                <img :src="getPhotoPerfil()" alt="" class="col-2 w-50">
            </div> 
            <div class="">
                <p>Foto secundaria</p>
                <img :src="getPhotoPerfil()" alt="" class="col-2 w-50">
            </div> 
            <form action="">
            <label for="">Agrega una foto principal</label>
          
            <input type="file"  @click="typeImg(0)" id="img_perfil" @change="uploadImage">
            </form>
            <form action="">
            <label for="">Agrega una foto secundaria</label>
          
            <input type="file"  @click="typeImg(0)" id="img_perfil" @change="uploadImage">
            </form>
            <form action="">
            <label for="">Agrega una foto secundaria</label>
          
            <input type="file"  @click="typeImg(0)" id="img_perfil" @change="uploadImage">
            </form>
            <form action="">
            <label for="">Agrega una foto secundaria</label>
          
            <input type="file"  @click="typeImg(0)" id="img_perfil" @change="uploadImage">
            </form> 
            
        <button class="button" v-on:click="uploadData()">
            Subir
        </button>
        </div>
        
    </div>
    
</template>