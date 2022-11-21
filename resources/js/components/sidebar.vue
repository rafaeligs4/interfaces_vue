<template>
<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="../../index3.html" class="brand-link">
<!--<img src="../../../public/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
-->
    <span class="brand-text font-weight-light">AdminLTE 3 </span>
</a> 

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image"> 
<!--<img src="../../../public/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
</div>
<div class="info">
<a href="#" class="d-block">Alexander Pierce</a>
</div>
</div>

<div class="form-inline">
<div class="input-group" data-widget="sidebar-search">
<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
<div class="input-group-append">
<button class="btn btn-sidebar">
<i class="fas fa-search fa-fw"></i>
</button>
</div>
</div>
</div>

<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


<li class="nav-item">
<router-link to="/dashboard" class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Editar perfil 

</p>
</router-link>

</li>

<li class="nav-item">
<a href="../widgets.html" class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Administrar usuarios

</p>
</a>

</li>
</ul>
</nav>

</div>

</aside>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Fixed Layout</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="#">Layout</a></li>
<li class="breadcrumb-item active">Fixed Layout</li>
</ol>
</div>
</div>
</div>
</section>

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

<footer class="main-footer">
<foot>

</foot>
</footer>

<aside class="control-sidebar control-sidebar-dark">

</aside> 
 
</template>
<script setup>
 
import headup from '@/components/headLink.vue';
</script>











