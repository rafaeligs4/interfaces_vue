<script setup>
import axios from 'axios';
import { ref,onMounted } from 'vue';
let error_array=[];
const form = ref({
    f:[],
    cars:[],
    clients:[]
    });
const props = defineProps({
    id:{
        type: String,
        default: ''
    }  
});
let car_id=0, user_id=0;
const findId=()=>{
    form.value.cars.forEach(element => {
        if(element.car===form.value.f.car_complete){
            car_id=element.id;
        }
    }); 
    console.log(car_id);
}
const findUser=()=>{
    form.value.clients.forEach(element => {  
        if(element.user===form.value.f.user_complete){
          
            user_id=element.id;
        }
    }); 
    console.log(user_id);
}
const setCar_id=(id)=>{
    console.log(id);
    car_id=id;
}
const setUser_id=(id)=>{
    user_id=id;
}
const printele=()=>{
    console.log("Hola Mundo");
}
const getRentData = ()=>{
   
   let value =axios.get('/api/get_edit_rent/'+props.id)
     .then(response=>{
        // console.log(response);
         form.value.f=response.data.rent;
         console.log(response.data); 
     });
     console.log(form.value);
 };
const getCars = ()=>{
   
  let value =axios.get('/api/get_concat_cars')
    .then(response=>{
        console.log(response);
        form.value.cars=response.data.car;
        console.log(form.value.cars); 
    });
    console.log(form.value);
};
const getClients= ()=>{
    let value =axios.get('/api/get_concat_clients')
    .then(response=>{
        console.log(response);
        form.value.clients=response.data.user;
        console.log(form.value.clients); 
    });
    console.log(form.value); 
};
const showErrors = (error)=>{
    
    if(error.car != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_car");
        textdoc=document.getElementById("msg_car");
        error_msg=error.car[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.client != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_client");
        textdoc=document.getElementById("msg_client");
        error_msg=error.client[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.precio != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_price");
        textdoc=document.getElementById("msg_price");
        error_msg=error.precio[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.fecha_ini != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_fecha_init");
        textdoc=document.getElementById("msg_fecha_init");
        error_msg=error.fecha_ini[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
    if(error.fecha_fin != null){
    let doc,
    textdoc;
    let error_msg;
        doc=document.getElementById("id_fecha_final");
        textdoc=document.getElementById("msg_fecha_final");
        error_msg=error.fecha_fin[0];
        doc.classList.add("is-invalid");
        textdoc.classList.add("invalid-feedback");
        textdoc.textContent=error_msg; 
    }
}  
const error_quitar = (id) =>{
    let doc,
    textdoc;
    if(id==0){
        doc=document.getElementById("id_car");
        textdoc=document.getElementById("msg_car")
    }else if(id==1){
        doc=document.getElementById("id_client");
        textdoc=document.getElementById("msg_client");
    }
    else if(id==2){
        doc=document.getElementById("id_price");
        textdoc=document.getElementById("msg_price");
    }
    else if(id==3){
        doc=document.getElementById("id_fecha_init");
        textdoc=document.getElementById("msg_fecha_init");
    }
    else if(id==4){
        doc=document.getElementById("id_fecha_final");
        textdoc=document.getElementById("msg_fecha_final");
    }
    if(doc.classList.contains("is-invalid")){
        doc.classList.remove("is-invalid");
        textdoc.classList.remove("invalid-feedback");
        textdoc.textContent="";

    }
}        
const createRent = ()=>{
   
    const formdata=new FormData();
    formdata.append('car',form.value.f.car_complete);
    formdata.append('client',form.value.f.user_complete);
    formdata.append('precio',form.value.f.price);
    formdata.append('fecha_ini',form.value.f.fecha_inic);
    formdata.append('fecha_fin',form.value.f.fecha_final);
    formdata.append('id_user',user_id);
    formdata.append('id_car',car_id);
    console.log(formdata);
    axios.post('/api/post_edit_rent/'+props.id,formdata)  
    .then((response)=>{
        console.log(response.data)
  //      router.push('/home');
    })
    .catch((error)=>{
        error_array=error.response.data.error;
        console.log(error_array);
        showErrors(error_array);
    })
    ; 
}

onMounted(()=>{
    getCars();
    getClients();
    getRentData();
    
});
</script>
<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="">                
                    <div class="col-12">
                        <h1>Formulario</h1>
                    </div>
                    
                    <div class="form-row">
                    <div class="form-group col-md-12">
        
                            <label for="">Vehiculo</label>
                            <input id="id_car" list="listCars" class="form-control" name="cars" @click="error_quitar(0)"  @change="findId()" placeholder="Selecciona un auto" v-model="form.f.car_complete">
                                <datalist  id="listCars">
                                    <option v-for="car in form.cars"   :value="car.car"></option> 
                                </datalist>   
                    
                    <div id="msg_car">   
                    
                    </div>
                        </div>
                    </div> 
                    <div class="form-row">
                    <div class="form-group col-md-12">
        
                            <label for="">Clientes</label>
                            <input id="id_client" list="listClients" class="form-control" name="clientes" @click="error_quitar(1)"  @change="findUser()"  placeholder="Selecciona un cliente" v-model="form.f.user_complete">
                                <datalist  id="listClients">
                                    <select name="clientes">
                                        <option v-for="client in form.clients"  :value="client.user"></option>       

                                    </select>
                                    <!-- <option disabled value="">Seleccione un elemento</option> -->
                                    
                                </datalist>   
                    
                    <div id="msg_client">   
                    
                    </div>
                        </div>
                    </div> 
                    <div class="form-row">
                    <div class="form-group col-md-12">
        
                            <label for="">Precio</label>
                            <input id="id_price" class="form-control" name=""  placeholder="Precio" @click="error_quitar(2)" v-model="form.f.price">
                               
                    
                    <div id="msg_price">   
                    
                    </div>
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Desde</label>
                <input id="id_fecha_init"  type="date" class="form-control" @click="error_quitar(3)" v-model="form.f.fecha_inic">
                <div id="msg_fecha_init">   
                    
                </div> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Hasta</label>
                            <input id="id_fecha_final" type="date" class="form-control" @click="error_quitar(4)" v-model="form.f.fecha_final">
                            <div id="msg_fecha_final">   
                    
                </div>   
                        </div>
                    </div>
                </div> 
                <div class="col-12  justify-content-center">
                    <button type="submit" v-on:click="createRent()" class="col-auto btn btn-primary">Subir</button>
                </div>
            </div>
        </div>
    </div>
</template>