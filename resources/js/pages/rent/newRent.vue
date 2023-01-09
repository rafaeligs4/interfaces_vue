<script setup>
import axios from 'axios';
import { ref,onMounted } from 'vue';

const form = ref({
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
                            <input list="listCars" class="form-control" name=""  placeholder="Selecciona un auto">
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
                            <input list="listClients" class="form-control" name=""  placeholder="Selecciona un cliente">
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
                            <input  class="form-control" name=""  placeholder="Precio">
                               
                    
                    <div id="msg_estado">   
                    
                    </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</template>