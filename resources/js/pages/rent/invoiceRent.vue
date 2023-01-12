<script setup>
import axios from 'axios';
import { ref,onMounted } from 'vue';

let total=0.0;
let suma=0.0;
let ivaT=0.0;
let date=""; 
const form = ref({});
const i= ref({
    v:0
});
function printHTML() {
 window.print();
}
const props = defineProps({
    id:{
        type: String,
        default: ''
    }  
});
const actual=()=>{
    let date = new Date();
    date=Date.now();
    
    let day = date.getDate()
    let month = date.getMonth() + 1
    let year = date.getFullYear()

if(month < 10){
  return `${day}-0${month}-${year}`;
}else{
  return `${day}-${month}-${year}` ;
}
};
const calcIva=()=>{
    let a=0;
    let prices=0;
    for (const element  in form.value.cars) {
        //console.log(form.value.rents.price);
        prices+= parseFloat(form.value.rents[element].price);

            
      }    
     

    console.log(prices);  
    return prices;
} 
const iva = ()=>{
    return 0.15*total;
}   ;
const sumTotal =()=>{
        return ivaT+total;
}

const get_data=async()=>{
    axios.get('/api/get_data_invoice/'+props.id)
    .then(response=>{
        console.log(response.data);
        form.value=response.data; 
        i.value.v=form.value.cars.length;
      
      total=calcIva();
      ivaT=iva();
      suma=sumTotal();
      date=actual();
      
    }).catch(error =>{
        console.log(error);
    });
};

onMounted(()=>{
   
    get_data();
    
}) ;
</script>


<template>

<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="invoice p-3 mb-3">

<div class="row">
<div class="col-12">

    <div class="d-flex">
        <div class="col-md-2 mr-5">
        <img class="img-fluid" src="/photo/logo.png" alt="">
        </div>
        <div class="col-sm-4 invoice-col">

                <strong> Rent A Car</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (804) 123-5432<br>
                Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="bcd5d2dad3fcddd0d1ddcfddd9d9d8cfc8c9d8d5d392dfd3d1">[email&#160;protected]</a>
               
        </div>
     
         <h4 class="align-items-center">Factura Numero: 00001</h4>
                
        
       
       
    
    </div>
    
     


</div>

</div>

<div class="row invoice-info">
<div v-if="i.v!=0" class="col-sm-4 invoice-col">
Datos del Cliente:
<!-- <div v-if="form.user.name != null">{{form.user.name}}</div> -->
<address>

<strong >{{form.user.name}}</strong>
Cédula de Identidad: {{ form.user.cedula}}    <br>
Numero de Licencia:  {{  form.user.no_licencia}}<br>
Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="97fdf8fff9b9f3f8f2d7f2eff6fae7fbf2b9f4f8fa">[email&#160;protected]</a>
</address>
</div>

<div class="col-sm-4 invoice-col">

<br>

</div> 

</div>


<div class="row">
<div class="col-12 table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>id</th>
<th>Vehiculo</th>
<th>Modelo</th>
<th>Placa</th>
<th>Precio por Dia</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<tr v-for="value in i.v">
    <td >{{form.rents[value-1].id}}</td>
    <td >{{form.cars[value-1][0].marca}}</td>
    <td >{{form.cars[value-1][0].modelo}}</td>
    <td >{{form.cars[value-1][0].placa}}</td> 
    <td>{{form.rents[value-1].price/form.rents[value-1].days}}</td>
    <td >{{form.rents[value-1].price}}</td>

</tr>
</tbody>
</table>
</div>

</div>

<div class="row">

<div class="col-6">
<p class="lead">Payment Methods:</p>
 <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
plugg
dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
</p>
</div>

<div class="col-6">
<p class="lead">{{date}}</p>
<div class="table-responsive">
<table class="table">
<tr>
<th style="width:50%">Subtotal:</th>
<td>{{total}}</td>
</tr>
<tr>
<th>IVA (15%)</th>
<td>{{ivaT}}</td>
</tr>
<tr>

</tr>
<tr>
<th>Total:</th>
<td>{{suma}}</td>
</tr>  
</table>
</div>
</div>
<div class="no-print">
    <button type="button" class="btn btn-danger float-right" @click="printHTML()" style="margin-right: 5px;">
<i class="fas fa-download"></i> Imprimir Factura
</button>
</div>

</div>


</div>

</div>
</div>
</div>
</section> 
</template>