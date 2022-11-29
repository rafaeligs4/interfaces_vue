<script setup>
//importando clases



import axios from 'axios';
import useValidate from '@vuelidate/core';
import {required,email,minLength} from '@vuelidate/validators';
import { onMounted, ref } from 'vue';

document.getElementById("attachment").addEventListener('click', function() {
    document.getElementById("file-input").click();
});


let valor = 0;
let submitted = false, 
submitted2=false; 
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

const rules = {
    marca: {required,minLength: minLength(6)}, 
    modelo:{required,minLnegth: minLength(4)},
    color: {required,minLnegth: minLength(4)},
    placa: {required,minLnegth: minLength(6)},
    estado: {required},
    tipo: {required},
    foto1: {required},
    foto2: {required}, 
    foto3: {required},
    foto4: {required},
};
let v$ = useValidate(rules,form.value);
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
   axios.post('/api/create_car',formdata)  
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
    let photo = "/photo/image.svg";
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
const validateData = ()=>{
  submitted = true;
  submitted2= true;
 
  v$.value.$validate();
 if(v$.value.$error){
    console.log('Incorrecto');

 }else{
    console.log('Correcto'); 
 }
};

const getTypes= async () =>{
   let value = axios.get('/api/get_types_cars')
   .then((response)=>{ 
        form.value.select_values=response.data.tipos;
        console.log(form.value.select_values); 
        
   }); 

}
onMounted(()=>{
 getTypes();
});

</script> 
<template>    
    <div class="container">
        <div>
            <h1>Crear Auto </h1> 
        </div>
        <div class="row">
        <div class="col-6 flex justify-content-center">
        <div class="col-md-12">      
        <img :src="knowPhoto(0)" alt="" class="col-7" >
        <div v-if="v$.foto1.$error" >  
        <span v-if="v$.foto1.required.$invalid">La foto principal es requerida </span>     
        </div>   

        </div> 
        <div class="row justify-content-start ">
        <div class="col-4">
          
             <img :src="knowPhoto(1)"  alt="" class="col-12">
        <div v-if="v$.foto2.$error" >  
            <span v-if="v$.foto2.required.$invalid">La foto principal es requerida</span>
     
        </div>
        </div> 
        <div class="col-4">
           
            <img :src="knowPhoto(2)" alt="" class="col-12">
            <div v-if="v$.foto3.$error" >  
                <span v-if="v$.foto3.required.$invalid">La foto principal es requerida</span>
     
            </div>
        </div> 
<div class="col-4">
<div v-if="v$.foto4.$error" >  
  <span v-if="v$.foto4.required.$invalid">La foto principal es requerida</span>
     
</div>
<img :src="knowPhoto(3)"  alt="" class="col-12"> 
</div> 
</div>        

        </div>    
 <div class="col-md-6">
<div class="form-row">
    <div class="form-group col-md-6">
    <div v-if="v$.marca.$error"> 
                  <span v-if="v$.marca.required.$invalid">La Marca es requerida</span>
                  <span v-if="v$.marca.minLength.$invalid">Minimo 6 letras</span>      
                </div>


    <label for="">Marca</label>
    <input class="form-control" placeholder="Marca" v-model="form.marca"> 
    </div>
    <div  class="form-group col-md-6">
     <div v-if="v$.modelo.$error" >  
            <span v-if="v$.modelo.required.$invalid">El modelo es requerida</span>
            <span v-if="v$.modelo.minLnegth.$invalid">Minimo 6 letras</span>      
     </div>     
            <label for="">Modelo</label>
            <input class="form-control" placeholder="Modelo"  v-model="form.modelo"> 
                
      </div>
</div>            
<div class="form-row">
    <div  class="form-group col-md-6">
                <div v-if="v$.modelo.$error" >  
                  <span v-if="v$.placa.required.$invalid">La placa es requerida </span>
                  <span v-if="v$.placa.minLnegth.$invalid">Minimo 6 letras</span>      
                </div>
                <label for="">Placa</label>
                <input class="form-control" placeholder="Placa" v-model="form.placa"> 
            </div>
    <div  class="form-group col-md-6">
                <div v-if="v$.color.$error" >  
                  <span v-if="v$.color.required.$invalid">El color es requerido </span>
                  <span v-if="v$.color.minLnegth.$invalid">Minimo 4 letras </span>      
                </div>
                <label for="">Color</label>
                <input class="form-control" placeholder="Color"  v-model="form.color"> 
            </div>
</div>            
<div class="form-row">
    <div class="form-group col-md-12">
      <div v-if="v$.estado.$error" >  
                  <span v-if="v$.estado.required.$invalid">El estado es requerido</span>
                    
                </div>
                <label for="">estado</label>
                <select name="" id="" class="form-control" v-model="form.estado">
                   <option disabled value="">Seleccione un elemento</option>
                   <option value="Activo">Activo</option>
                   <option value="Inactivo">Inactivo</option>
                   <option value="Alquilado">Alquilado</option>  
                </select>   
                 

    </div>
</div>           
<div class="form-row">
    <div class="form-group col-md-6">
                <div v-if="v$.tipo.$error" >  
                  <span v-if="v$.tipo.required.$invalid">El Tipo es requerido</span>
                </div>
                <label for="">tipo</label>
            <select class="form-control" v-model="form.tipo">
                   <option v-for="tipo in form.select_values" 

                   :value="tipo.nombre_tipo_vehiculo"> 
                   
                   {{tipo.nombre_tipo_vehiculo}} 
                   
                   </option>
            </select>    
                 
    </div>
    <div class="form-group col-md-6 "> 
                <router-link to="/type"> 
                    <button class="btn btn-primary ">Agregar Tipo</button>
              
                </router-link>
               
    </div>
</div>           
            
          
          
          
          
         
            <form action="">
            <label for="">Agrega una foto principal</label>
            <div id="attachment"><i class="fa fa-paperclip"></i></div>
            <input id="file-input" type="file" style="display:none"   @click="typeImg(0)" @change="updateImages">
            </form>
              
            <form action="">
            <label for="">Agrega una foto secundaria</label>
          
            <input type="file"  @click="typeImg(1)" id="img_perfil" @change="updateImages" >
            </form>

            <form action="">
            <label for="">Agrega una foto secundaria</label>

            <input type="file"  @click="typeImg(2)" id="img_perfil" @change="updateImages" >
            </form>
            
            <form action="">
            <label for="">Agrega una foto secundaria</label>
          
            <input type="file"  @click="typeImg(3)" id="img_perfil" @change="updateImages">
            </form> 
            
        <button class="button" v-on:click="validateData()">
            Subir
        </button>
        </div>


        </div>
       




        
    </div>
    
</template>