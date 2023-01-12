<script setup>
import axios from 'axios';
import { ref,onMounted } from 'vue';

const form = ref({
    car: "",
    client: "",
    precio: "",
    fecha_ini: "",
    fecha_fin: "",
    cars:[],
    clients:[] 
});

let car_id=0, user_id=0;
let error_array=[];
const findId=()=>{
    form.value.cars.forEach(element => {
        if(element.car===form.value.car){
            car_id=element.id;
        }
    }); 
    console.log(car_id);
}
const findUser=()=>{
    form.value.clients.forEach(element => {
        if(element.user===form.value.client){
            user_id=element.id;
        }
    }); 
    console.log(user_id);
}
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
const createRent = ()=>{
   
    const formdata=new FormData();
    formdata.append('car',form.value.car);
    formdata.append('client',form.value.client);
    formdata.append('precio',form.value.precio);
    formdata.append('fecha_ini',form.value.fecha_ini);
    formdata.append('fecha_fin',form.value.fecha_fin);
    formdata.append('id_user',user_id);
    formdata.append('id_car',car_id);
    console.log(formdata);
    axios.post('/api/create_rent',formdata)  
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
                            <input id="id_car" list="listCars" class="form-control" name="" @click="error_quitar(0)"  @change="findId()" placeholder="Selecciona un auto" v-model="form.car">
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
                            <input id="id_client" list="listClients" @click="error_quitar(1)" class="form-control" name="clientes" @change="findUser()"  placeholder="Selecciona un cliente" v-model="form.client">
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
                            <input id="id_price"  @click="error_quitar(2)" class="form-control" name=""  placeholder="Precio" v-model="form.precio">
                               
                    
                    <div id="msg_price">   
                    
                    </div>
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Desde</label>
                <input id="id_fecha_init" @click="error_quitar(3)"  type="date" class="form-control" v-model="form.fecha_ini">  
                <div id="msg_fecha_init">   
                    
                </div> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Hasta</label>
                            <input id="id_fecha_final" @click="error_quitar(4)" type="date" class="form-control" v-model="form.fecha_fin">
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