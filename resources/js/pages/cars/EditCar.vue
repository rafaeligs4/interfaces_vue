<script setup>
//importando clases
import axios from 'axios';
import { onMounted, ref } from 'vue';
import {useRouter} from 'vue-router';
const router=useRouter()

let valor = 0;
let arr=[];  
let pos1=0;
let pos2=0;
let error_array=[];
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
const sub1 = () =>{
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
const showErrors = (error)=>{
    
    if(error.marca != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_marca");
        textdoc=document.getElementById("msg_marca");
        error_msg=error.marca[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.modelo!= null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_modelo");
        textdoc=document.getElementById("msg_modelo");
        error_msg=error.modelo[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.placa != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_placa");
        textdoc=document.getElementById("msg_placa");
        error_msg=error.placa[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.color != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_color");
        textdoc=document.getElementById("msg_color");
        error_msg=error.color[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.estado != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_estado");
        textdoc=document.getElementById("msg_estado");
        error_msg=error.estado[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.tipo != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_tipo");
        textdoc=document.getElementById("msg_tipo");
        error_msg=error.tipo[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg;
    }
       
}
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
        router.push('/home');
    })
    .catch((error)=>{
        error_array=error.response.data.error;
        showErrors(error_array);

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
const getTypes= async () =>{
   let value = axios.get('/api/get_all_types_cars')
   .then((response)=>{
        form.value.select_values=response.data.tipos;
        console.log(form.value.select_values); 
        
   }); 
}
const seleCheck = (id) =>{
    if(id<4){
        document.getElementById('att-'+id).classList.replace("btn-primary","btn-danger");
    
       
    }
    else if(id == 5){
        let num=pos1-1,
        num2=pos2-1;
        document.getElementById('att-'+num).classList.replace("btn-danger","btn-primary");
        document.getElementById('att-'+num2).classList.replace("btn-danger","btn-primary");
    }
}

const selecPhotos = (el)=>{
    console.log(arr);
    console.log(el);
    if(pos1 == 0){
        seleCheck(el);
        pos1 = el+1;
    }
    else if(pos2 == 0){
        seleCheck(el);
       pos2 = el+1;
    }
    else if(pos1 == pos2){
        pos1=0;
        pos2=0;
        console.log('reset');
        return false;
    } 
    if(pos1 != 0 && pos2 != 0){
      console.log(pos1 );
      console.log(pos2 ); 
      seleCheck(5);
        let auxval="";
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
    <div class="d-flex justify-content-center m-2">
        <h1>Editar Datos del Auto</h1>
    </div>
    
    <div class="container">        
        <div class="row">
            <div class="col-md-6 ">
            <div class="d-flex justify-content-center">
            <div class="btn btn-primary m-1" @click="sub1()" ><i class="fa fa-paperclip"></i></div>
            <div @click="selecPhotos(0)" class="btn btn-primary m-1" id="att-0"><i  class="fa fa-check"  aria-hidden="true"></i></div>
            </div>
           
            <div class="col-md-12 d-flex justify-content-center m-3">
           
                <div class="col-12 ">
                <img :src="knowPhoto(0)"  alt="" class="img-fluid">
              </div>
            </div> 
            <div class="row ">
            <div class="col-4">
                <div class="col-12 ">
                <img :src="knowPhoto(1)"  alt="" class="img-fluid">
                <div class="d-flex justify-content-center">
                <div class="btn btn-primary m-1" @click="sub2()" ><i class="fa fa-paperclip"></i></div>
                <div @click="selecPhotos(1)" class="btn btn-primary m-1" id="att-1"><i  class="fa fa-check"  aria-hidden="true"></i></div>
                </div>
               
            </div>
            </div> 
            <div class="col-4">
                <div class="col-12 ">
                <img :src="knowPhoto(2)"  alt="" class="img-fluid">
                <div class="d-flex justify-content-center">
                <div class="btn btn-primary m-1" @click="sub3()"><i class="fa fa-paperclip"></i></div>
                <div @click="selecPhotos(2)" class="btn btn-primary m-1"  id="att-2"><i  class="fa fa-check"  aria-hidden="true"></i></div>
                </div>
             
            </div>
            </div> 
            <div class="col-4">
                <div class="col-12 ">
                <img :src="knowPhoto(3)"  alt="" class="img-fluid">
                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary m-1" @click="sub4()" ><i class="fa fa-paperclip"></i></div>
                    <div @click="selecPhotos(3)" class="btn btn-primary m-1" id="att-3"><i  class="fa fa-check"  aria-hidden="true"></i></div>
                </div>
               
                </div>
            </div>
            </div>
             
            </div>
            <div class="col-md-6  rounded">
                <div class="">
                    <h2>Agregar los datos a editar</h2>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Marca</label>
                        <input id="id_marca" class="form-control" @click="error_quitar(0)"  v-model="form.marca"> 
                        <div id="msg_marca">

                        </div>
                    </div>
                    <div  class="form-group col-md-6"> 
                        <label for="">Modelo</label>
                        <input  id="id_modelo" class="form-control" @click="error_quitar(1)" v-model="form.modelo"> 
                        <div id="msg_modelo">

                        </div>
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Placa</label>
                        <input id="id_placa" class="form-control" @click="error_quitar(2)"  v-model="form.placa"> 
                        <div id="msg_placa">

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Color</label>
                        <input id="id_color" class="form-control" @click="error_quitar(3)" v-model="form.color"> 
                        <div id="msg_color">

                        </div>
                    </div>
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="">estado</label>
                        <select  id="id_estado" class="form-control" @click="error_quitar(4)" name="" v-model="form.estado">
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
                <label for="">tipo</label>
                    <select id="id_tipo" class="form-control" @click="error_quitar(5)" v-model="form.tipo">
                    <option v-for="tipo in form.select_values" 

                   :value="tipo.nombre_tipo_vehiculo"> 
                   
                   {{tipo.nombre_tipo_vehiculo}} 
                   
                   </option>
                     </select>  
                     <div id="msg_tipo">

                    </div> 
                </div>
              
            <div class="form-group col-md-6 d-flex align-items-end ">
                 <router-link to="/type"> 
                    <button class="btn btn-primary ">Agregar Tipo</button>
                 </router-link>
            </div>   
            </div>
            
            <div class="d-flex justify-content-center">
            <button class="btn btn-primary" v-on:click="uploadData()">
            Realizar Cambios
            </button>
            </div>
            
           
            </div>
           
          
            
           
           
            <form action="">
            <input type="file" style="display:none"  @click="typeImg(0)" id="file-input" @change="updateImages">
           
            </form>
         
            <form action="">
            <input type="file"  style="display:none" @click="typeImg(1)" id="file-in2" @change="updateImages" >
            </form>
            <form action="">
            <input type="file" style="display:none"  @click="typeImg(2)" id="file-in3" @change="updateImages" >
            </form>
            <form action="">
            <input type="file" style="display:none"  @click="typeImg(3)" id="file-in4" @change="updateImages">
            </form>  
            
          
        </div>
        
    </div>
    
</template>