<script setup>
//importando clases
import axios from 'axios';
import { onMounted, ref } from 'vue';
let valor = 0;
let arr=[];  
let pos1=0;
let pos2=0;
//para identificar los tipos de imagen
const typeImg= (id) =>{
    if(id==0){
        valor = 0;
    }else if(id==1){
        valor = 1;
    }
    else if(id==2){
        valor = 2;
    }
    else if(id==3){
        valor = 3;
    }
}
const props=defineProps({
    id:{
        type: String,
        default: ''
    }    
}); 
let form= ref({
    id:'',  
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
    select_values: [],

}); 

const getP= async () => {
    let response = await axios.get('/api/get_car/'+props.id)
   
   
    console.log(arr); 
    form.value=response.data.car; 
    
    console.log(arr);
    console.log(response);
    
    
    console.log(form.value.id);
    arr = [
    form.value.foto1,
    form.value.foto2,
    form.value.foto3,
    form.value.foto4,
    ];    
    
 
   
  
   
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
   axios.post('/api/edit_car/'+props.id,formdata)  
    .then((response)=>{
        console.log(response.data)
    })
    .catch((error)=>{
        console.log(error.response)
    })
    ; 
}
const knowPhoto = (numero) =>{
    let img="";
    if(numero==0){
        img=form.value.foto1;
    
    }else if(numero==1){
        img=form.value.foto2;
    }else if(numero==2){
        img=form.value.foto3;
    }
    else if(numero==3){ 
        img=form.value.foto4;
    }  
    let photo = "/photo/usuario.svg";
    if( img!= "" ){
        if(img.indexOf('base64') != -1){
            photo=img; 
        }else{ 
            photo='/photo/'+img; 
        }
        
       
    } 
    return photo; 
} 
const updateImages = (e) => {
    let file= e.target.files[0];
    let reader = new FileReader(); 
    if(valor==0){
        reader.onloadend = (file) => {
        form.value.foto1=reader.result;
        }
    }
    else if(valor==1){
        reader.onloadend = (file) => {
        form.value.foto2=reader.result;
        }
    }
    else if(valor==2){
        reader.onloadend = (file) => {
        form.value.foto3=reader.result;
        }
    }
    else if(valor==3){
        reader.onloadend = (file) => {
        form.value.foto4=reader.result;
        }   
    } 
    reader.readAsDataURL(file); 
} 
const getTypes= async () =>{
   let value = axios.get('/api/get_all_types_cars')
   .then((response)=>{
        form.value.select_values=response.data.tipos;
        console.log(form.value.select_values); 
        
   }); 
}
const selecPhotos = (el)=>{
    console.log(arr);
    console.log(el);
    if(pos1 == 0){
        pos1 = el+1;
    }
    else if(pos2 == 0){
       pos2 = el+1;
    }
    else if(pos1 == pos2){
        pos1=0;
        pos2=0;
        console.log('reset');
    } 
    else if(pos1 != 0 && pos2 != 0){
      console.log(pos1 );

      console.log(pos2 ); 
      console.log(arr); 
        let auxval="";
       arr[pos1-1]; 
        auxval=arr[pos1-1];
        arr[pos1-1]= arr[pos2-1];
        arr[pos2-1]=auxval; 
      pos1=0;
        pos2=0; 
         console.log(arr); 
        let formdata =new FormData();
        formdata.append('foto1',arr[0]);
        formdata.append('foto2',arr[1]);
        formdata.append('foto3',arr[2]);
        formdata.append('foto4',arr[3]);
        axios.post('/api/changeposition/'+form.value.id,formdata)
        .then(response=>{
            console.log(response.data); 
            getP();
        });
      //   
    }
}
onMounted(()=>{
    getP();
    getTypes();
    
   
    console.log(arr); 
});

</script> 
<template>
    <h1>Hola</h1>
    <div class="container">
        <div>
            <h1>Crear Auto </h1> 
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
                <select name="" id="" v-model="form.estado">
                   <option value="Activo">Activo</option>
                   <option value="Inactivo">Inactivo</option>
                   <option value="Alquilado">Alquilado</option>  
                </select>   
                 

            </div>
            <div>
                <label for="">tipo</label>
            <select  v-model="form.tipo">
                   <option v-for="tipo in form.select_values" 

                   :value="tipo.nombre_tipo_vehiculo"> 
                   
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
                <img :src="knowPhoto(0)" alt="" class="col-2 " >
            </div> 
            <div class="">
                <p>Foto Secundaria</p>
                <img :src="knowPhoto(1)"  alt="" class="col-2 w-50">
            </div> 
            <div class="">
                <p>Foto secundaria</p>
                <img :src="knowPhoto(2)" alt="" class="col-2 w-50">
            </div> 
            <div class="">
                <p>Foto secundaria</p>
                <img :src="knowPhoto(3)"  alt="" class="col-2 w-50"> 
            </div> 
            
            <button @click="selecPhotos(0)" >Cambiar posicion</button>
            <form action="">
            <label for="">Agrega una foto principal</label>
            <input type="file"  @click="typeImg(0)" id="img_perfil" @change="updateImages">
           
            </form>
            <button  @click="selecPhotos(1)" >Cambiar posicion</button>
            <form action="">
            <label for="">Agrega una foto secundaria</label>
          
            <input type="file"  @click="typeImg(1)" id="img_perfil" @change="updateImages" >
           
            </form>
            <button  @click="selecPhotos(2)" >Cambiar posicion</button>
            <form action="">
            <label for="">Agrega una foto secundaria</label>

            <input type="file"  @click="typeImg(2)" id="img_perfil" @change="updateImages" >
          
            </form>
            <button  @click="selecPhotos(3)" >Cambiar posicion</button>
            <form action="">
            <label for="">Agrega una foto secundaria</label>
          
            <input type="file"  @click="typeImg(3)" id="img_perfil" @change="updateImages">
           
            </form>  
            
        <button class="button" v-on:click="uploadData()">
            Subir
        </button>
        </div>
        
    </div>
    
</template>