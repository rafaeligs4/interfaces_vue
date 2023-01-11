<script setup>
import axios from 'axios';
import { ref,onMounted } from 'vue';

const form = ref({});
const props = defineProps({
    id:{
        type: String,
        default: ''
    }  
});
    
const get_data=()=>{
    axios.get('/api/get_data_invoice/'+props.id)
    .then(response=>{
        console.log(response.data);
        form.value=response.data; 
    }).catch(error =>{
        console.log(error);
    });
};
const today= new Date();
onMounted(()=>{
    console.log(props.id);
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
         <h4 class="align-items-center">Rent a Car</h4>
                
        
       
       
    
    </div>
    
     
<small class="float-right">Date: {{ today.getDate }}</small>

</div>

</div>

<div class="row invoice-info">
<div class="col-sm-4 invoice-col">
<!-- Datos del Cliente:
<address>
<strong >{{ form.user.name +" "+ form.user.apellido}}</strong><br>
Cédula de Identidad: {{ form.user.cedula}}    <br>
Numero de Licencia:  {{  form.user.no_licencia}}<br>
Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="97fdf8fff9b9f3f8f2d7f2eff6fae7fbf2b9f4f8fa">[email&#160;protected]</a>
</address> -->
</div>

<div class="col-sm-4 invoice-col">
<b>Factura Numero: 00001</b><br>
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
</tr>
</thead>
<tbody>
<tr v-for="i in form.cars">
<td >{{i.marca}}</td>
<td>Call of Duty</td>
<td>455-981-221</td>
<td>El snort testosterone trophy driving gloves handsome</td>
<td>$64.50</td>
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
<p class="lead">Amount Due 2/22/2014</p>
<div class="table-responsive">
<table class="table">
<tr>
<th style="width:50%">Subtotal:</th>
<td>$250.30</td>
</tr>
<tr>
<th>Tax (9.3%)</th>
<td>$10.34</td>
</tr>
<tr>
<th>Shipping:</th>
<td>$5.80</td>
</tr>
<tr>
<th>Total:</th>
<td>$265.24</td>
</tr>
</table>
</div>
</div>

</div>


<div class="row no-print">
<div class="col-12">
<a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
<button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
Payment
</button>
<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
<i class="fas fa-download"></i> Generate PDF
</button>
</div>
</div>
</div>

</div>
</div>
</div>
</section> 
</template>