<template>
<aside class="main-sidebar sidebar-dark-primary elevation-4 quinto">

<a href="/index" class="brand-link">
<!-- <img src="../../../public/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
   -->
    <span class="brand-text font-weight-light"> 
 
 Rent A Car</span>
 <img class="brand-image img-circle elevation-3" src="/photo/logo.png" alt="">
</a> 

<div class="sidebar">

<div class="image mt-3 pb-3 mb-3 d-flex">


</div>



<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" id="elim" data-widget="treeview" role="menu" data-accordion="false">

<li class="nav-item">
<router-link :to='"/edit/"+usuarioId' class="nav-link">
    <i class="nav-icon fas fa-th"></i>
<p>Editar perfil</p>
</router-link>
</li>

<li class="nav-item" id="eliminar1">
<router-link to="/adminuser" class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Administrar usuarios

</p>
</router-link>

</li>
<li class="nav-item">
<router-link to="/newcar" class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Crear auto

</p>
</router-link>

</li>
<li class="nav-item">
<router-link to="/admincars" class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Administrar Autos

</p>
</router-link>

</li>
<li class="nav-item" id="eliminar2">
<router-link to="/admintypecar" class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Administrar tipos de vehiculos

</p>
</router-link> 

</li>
<li class="nav-item" id="eliminar2">
<router-link to='/new-rent' class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Alquiler de un auto
</p>
</router-link> 

</li>

<li class="nav-item" id="eliminar2">
<router-link to='/adminrent' class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Administrar Alquileres
</p>
</router-link> 

</li>
</ul>
</nav>

</div>

</aside>

<div class="content-wrapper cuarto">


<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-12">


<router-view>

</router-view> 

</div>
</div>
</div>
</section>

</div>

<div class="main-footer">
<foot>

</foot>
</div>

<aside class="control-sidebar control-sidebar-dark">

</aside> 
 
</template>
<script setup>
import axios from 'axios';
import { onMounted } from 'vue';
import {useRouter} from 'vue-router';
const router=useRouter()

const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);
const path="edit/"+usuarioId;
const filterOptions = async ()=>{
    let response =  await axios.get('/api/edit/'+usuarioId);
    let role = response.data.user.rol;
    //console.log(role);
    if(role=="vendedor"){
        console.log(role);
        let padre= document.getElementById("elim");
        let hijo1= document.getElementById("eliminar1");
        let hijo2=  document.getElementById("eliminar2");
        padre.removeChild(hijo1);
        padre.removeChild(hijo2);
    }
}   
onMounted(()=>{
    filterOptions();
})
</script>




 






