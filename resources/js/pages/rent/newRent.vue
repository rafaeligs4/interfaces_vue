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

}
onMounted(()=>{
    getCars();
    getClients();
});
$(document).ready(function() {
 
    $('.js-example-basic-single').select2();

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
                            <input list="listCars" class="form-control" name=""  placeholder="Selecciona un auto" v-model="form.car">
                                <datalist  id="listCars">
                                    <!-- <option disabled value="">Seleccione un elemento</option> -->
                                    <option v-for="car in form.cars" :value="car.car"></option> 
                                </datalist>   
                    
                    <div id="msg_estado">   
                    
                    </div>
                        </div>
                    </div> 
                    <div class="form-row">
                    <div class="form-group col-md-12">
        
                            <label for="">Clientes</label>
                            <input list="listClients" class="form-control" name=""  placeholder="Selecciona un cliente" v-model="form.client">
                                <datalist  id="listClients">
                                    <!-- <option disabled value="">Seleccione un elemento</option> -->
                                    <option v-for="client in form.clients" :value="client.user"></option> 
                                </datalist>   
                    
                    <div id="msg_estado">   
                    
                    </div>
                        </div>
                    </div> 
                    <div class="form-row">
                    <div class="form-group col-md-12">
        
                            <label for="">Precio</label>
                            <input  class="form-control" name=""  placeholder="Precio" v-model="form.precio">
                               
                    
                    <div id="msg_estado">   
                    
                    </div>
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Desde</label>
                <input id="id_fecha_nac" type="date" class="form-control" v-model="form.fecha_ini">
                <div class="form-group col-md-4">
                    <p>Total de </p>            
                </div>      
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Hasta</label>
                            <input id="id_fecha_nac" type="date" class="form-control" v-model="form.fecha_fin">
                               
                        </div>
                    </div>
                </div> 
                <div class="col-12  justify-content-center">
                    <button type="submit" v-on:click="uploadData()" class="col-auto btn btn-primary">Subir</button>
                </div>
            </div>
        </div>
    </div>
</template>