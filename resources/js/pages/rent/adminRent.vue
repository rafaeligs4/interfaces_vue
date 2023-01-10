<script setup>

</script>
<template>
    <div class="container">
     
        <div class="d-flex justify-content-center m-2">
            <h1>Tabla de Alquileres</h1>
        </div>
        <table  id="table_id" class="table table-striped principal rounded"> 
            <thead> 
            <tr>
                <th id="row_head">Id  </th>
                <th id="row_head">Marca  </th>
                <th id="row_head">Modelo</th>
                <th id="row_head" >Placa</th>
                <th id="row_head">Estado</th>
                <th v-if='role ==="admin"'>Editar Auto</th>
                <th v-if='role === "admin"'>Eliminar Auto</th>
                <th v-if='role === "admin"'>Cambiar Estado</th> 
            </tr> 
        </thead>
        <tbody> 
        <tr v-for="car in cars"> 
            <td id="row_id" class="">{{car.id}} </td>
            <td id="row_marca" class="">{{car.marca}} </td>
            <td id="row_modelo" class=""> {{car.modelo}}</td>
            <td id="row_placa" class=""> {{car.placa}}</td>
            <td id="row_estado" class=""> {{car.estado}}</td> 
           <td v-if='role == "admin"'>
           
        
             <router-link  :to='"/editcar/"+car.id'>
                <button class="btn btn-dark">Editar Carro </button></router-link>  
      
           
             
            
            </td>
            <td v-if='role == "admin"'>
            <div class="">
              <button class="btn btn-danger" @click="eliminarPerfil(car.id)">Eliminar perfil</button> 
            </div> 
            </td>  
            <td v-if='role == "admin"'> 
                <select name="" id="" v-model="car.estado"  class="form-control" @change="changeState(car.id,car.estado)">
                   <option value="Activo">Activo</option>
                   <option value="Inactivo">Inactivo</option>
                   <option value="Alquilado">Alquilado</option>  
                </select> 
            </td>
        </tr>

        </tbody>
    </table>
    </div>
</template>