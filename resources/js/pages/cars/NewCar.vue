<script setup>
//importando clases



import axios from 'axios';
import useValidate from '@vuelidate/core';
import {required,email,minLength} from '@vuelidate/validators';
import { onMounted, ref } from 'vue';
import {useRouter} from 'vue-router';
const router=useRouter()


const sub = () =>{
    document.getElementById("file-input").click();
} 
const sub2 = () =>{
    document.getElementById("file-in2").click();
}
const sub3 = () =>{
    document.getElementById("file-in3").click();
}
const sub4 = () =>{
    document.getElementById("file-in4").click();
}
// document.getElementById("attachment").addEventListener('click', function() {

// });


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
    if(validateData()){
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
        router.push('/home');
    })
    .catch((error)=>{
        console.log(error.response)
    })
    ; 
    }
    else{
        console.log("error"); 
    }
    
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
    let photo = "/photo/image.png";
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

 
  v$.value.$validate();
 if(v$.value.$error){
   if(v$.value.marca.$error){
        let error_marca = "";
        if(v$.value.marca.required.$invalid){
            console.log("sdas");
           error_marca="El campo Marca es requerido";
           
        }else if(v$.value.marca.minLength.$invalid){
             error_marca="Minimo 6 letras";
             console.log(error_marca);
        }
        document.getElementById("id_marca").classList.add("is-invalid");
        let d_m;
        d_m =document.getElementById("msg_marca");
        d_m.classList.add("invalid-feedback");
        d_m.textContent=error_marca;
   }
   if(v$.value.modelo.$error){
        let error_modelo = "";
        if(v$.value.modelo.required.$invalid){
            console.log("sdas");
           error_modelo="El campo Modelo es requerido";
           
        }else if(v$.value.modelo.minLength.$invalid){
             error_modelo="Minimo 4 letras";
             console.log(error_modelo);
        }
        document.getElementById("id_modelo").classList.add("is-invalid");
        let d_m;
        d_m =document.getElementById("msg_modelo");
        d_m.classList.add("invalid-feedback");
        d_m.textContent=error_modelo;
   }
   if(v$.value.placa.$error){
        let error_placa= "";
        if(v$.value.placa.required.$invalid){
            console.log("sdas");
           error_placa="El campo Placa es requerido";
           
        }else if(v$.value.placa.minLnegth.$invalid){
             error_placa="Minimo 6 letras";
             console.log(error_placa);
        }
        document.getElementById("id_placa").classList.add("is-invalid");
        let d_m;
        d_m =document.getElementById("msg_placa");
        d_m.classList.add("invalid-feedback");
        d_m.textContent=error_placa;
   } 
   if(v$.value.color.$error){
        let error_color= "";
        if(v$.value.color.required.$invalid){
            console.log("sdas");
           error_color="El campo Color es requerido";
           
        }else if(v$.value.color.minLength.$invalid){
             error_color="Minimo 4 letras";
             console.log(error_color);
        }
        document.getElementById("id_color").classList.add("is-invalid");
        let d_m;
        d_m =document.getElementById("msg_color");
        d_m.classList.add("invalid-feedback");
        d_m.textContent=error_color; 
   }
   if(v$.value.estado.$error){
        let error_placa= "";
        if(v$.value.estado.required.$invalid){
            console.log("sdas"); 
           error_placa="El campo del Estado es requerido";
           
        }
        document.getElementById("id_estado").classList.add("is-invalid");
        let d_m;
        d_m =document.getElementById("msg_estado");
        d_m.classList.add("invalid-feedback");
        d_m.textContent=error_placa;
   }
   if(v$.value.tipo.$error){
        let error_placa= "";
        if(v$.value.tipo.required.$invalid){
            console.log("sdas"); 
           error_placa="El campo del Tipo es requerido";
           
        }
        document.getElementById("id_tipo").classList.add("is-invalid");
        let d_m;
        d_m =document.getElementById("msg_tipo");
        d_m.classList.add("invalid-feedback");
        d_m.textContent=error_placa;
   } 
   return false;
 }else{
   return true;
 }
};
const error_quitar = (id) =>{
    let doc,
    textdoc;
    if(id==0){
        doc = document.getElementById("id_marca");
        textdoc= document.getElementById("msg_marca");
    }else if(id==1){
        doc = document.getElementById("id_modelo");
        textdoc= document.getElementById("msg_modelo");
    }
    else if(id==2){
        doc = document.getElementById("id_placa");
        textdoc= document.getElementById("msg_placa");
    }
    else if(id==3){
        doc = document.getElementById("id_color");
        textdoc= document.getElementById("msg_color");
    }
    else if(id==4){
        doc = document.getElementById("id_estado");
        textdoc= document.getElementById("msg_estado");
    }
    else if(id==5){
        doc = document.getElementById("id_tipo");
        textdoc= document.getElementById("msg_tipo");
    }
    if(doc.classList.contains("is-invalid")){
        doc.classList.remove("is-invalid");
        textdoc.classList.remove("invalid-feedback");
        textdoc.textContent="";

    }
}
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
         
        <div class="d-flex justify-content-center m-2">
            <h1>Ingresar Datos del Auto </h1> 
        </div>
        <div class="row ">
        <div class="col-6 ">
        <div class="btn btn-primary" @click="sub()" id="attachment"><i class="fa fa-paperclip"></i> Agrega una imagen</div>
        <div class="col-md-12 image d-flex justify-content-center m-3">      
        <img :src="knowPhoto(0)" alt="" style="width: 100% \9; " class="p-0 col-md-8" >
        </div>  
    <div class="row ">
        <div class="col-4">
              
                <div class="col-12 m-1">
                <img :src="knowPhoto(1)"  alt="" class="img-fluid"> 
                </div>
           
             

             <div class="btn btn-primary" @click="sub2()" id="att-2"><i class="fa fa-paperclip"></i>Agrega una imagen</div>       
        </div> 
        <div class="col-4">
            <div class="col-12 m-1">
                <img :src="knowPhoto(2)"  alt="" class="img-fluid"> 
            </div>
            <div class="btn btn-primary" @click="sub3()" id="att-3"><i class="fa fa-paperclip"></i>Agrega una imagen</div> 
        </div> 
        <div class="col-4">
            <div class="col-12 m-1">
                <img :src="knowPhoto(3)"  alt="" class="img-fluid"> 
            </div>
           
            <div class="btn btn-primary" @click="sub4()" id="att-4"><i class="fa fa-paperclip"></i>Agrega una imagen</div>  
        </div> 
    </div>        
 
        </div>    
 <div class="col-md-6">
<div class="form-row">
    <div class="form-group col-md-6">
   
   
    <label for="">Marca</label>
    <input class="form-control" placeholder="Marca" id="id_marca" @click="error_quitar(0)" v-model="form.marca"> 
    <div id="msg_marca" class="">
    </div>
    </div>
    <div  class="form-group col-md-6">
       
            <label  for="">Modelo</label>
            <input class="form-control " id="id_modelo" placeholder="Modelo" @click="error_quitar(1)"  v-model="form.modelo"> 
            <div id="msg_modelo" >   
            
            </div>   
      </div>
</div>            
<div class="form-row">
    <div  class="form-group col-md-6">
               
                <label for="">Placa</label>
                <input class="form-control" id="id_placa" placeholder="Placa" @click="error_quitar(2)" v-model="form.placa"> 
                <div id="msg_placa" >  
                  
                </div>
            </div>
    <div  class="form-group col-md-6">
                
                <label for="">Color</label>
                <input class="form-control" id="id_color" placeholder="Color" @click="error_quitar(3)"  v-model="form.color"> 
                <div id="msg_color" >  
                  
                </div>
            </div>
</div>            
<div class="form-row">
    <div class="form-group col-md-12">
    
                <label for="">Estado</label>
                <select name="" id="id_estado" class="form-control" @click="error_quitar(4)" v-model="form.estado">
                   <option disabled value="">Seleccione un elemento</option>
                   <option value="Activo">Activo</option>
                   <option value="Inactivo">Inactivo</option>
                   <option value="Alquilado">Alquilado</option>  
                </select>   
                 
                <div id="msg_estado">   
                  
                </div>
    </div>
</div>           
<div class="form-row">
    <div class="form-group col-md-6">
                
                <label for="">Tipo</label>
            <select id="id_tipo" class="form-control" @click="error_quitar(5)" v-model="form.tipo">
                   <option v-for="tipo in form.select_values" 

                   :value="tipo.nombre_tipo_vehiculo"> 
                   
                   {{tipo.nombre_tipo_vehiculo}} 
                   
                   </option>
            </select>    
            <div id="msg_tipo" >  
                 
                </div>
                 
    </div>
    <div class="form-group col-md-6 d-flex align-items-end "> 
        <router-link to="/type"> 
                    <button class="btn btn-primary ">Agregar Tipo</button>
              
                </router-link>
                
               
    </div>
</div>           
            
          
          
          
          
         
            <form action="">
         
            
            <input id="file-input" type="file" style="display:none"   @click="typeImg(0)" @change="updateImages">
            </form>
              
            <form action="">
             
         
       
            <input  type="file" style="display:none"  @click="typeImg(1)"  id="file-in2" @change="updateImages" >
            </form>

            <form action="">
          
 
            <input type="file" style="display:none" @click="typeImg(2)" id="file-in3" @change="updateImages" >
            </form>
            
            <form action="">          
            <input type="file"  style="display:none" @click="typeImg(3)"  id="file-in4"   @change="updateImages">
            </form> 
         <div class="d-flex justify-content-center">
        <button class="btn btn-primary" v-on:click="uploadData()">
            Crear Auto
        </button>
         </div>   
        
        </div>


        </div>
       




        
    </div>
    
</template>