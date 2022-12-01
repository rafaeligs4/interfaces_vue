<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

let users = ref([]);
const all_users = async () =>{
    let response = await axios.get("/api/get_all"); 
    users.value = response.data.users;
    console.log(users);
}
onMounted(async () => {
    all_users();
});
const eliminarPerfil = (num) =>{
   
    axios.get('/api/delete_user/'+num)
    .then((response)=>{
        console.log(response.data); 
        all_users();
    })
    .catch(()=>{
        
    });
} 
</script>
<template>
    <div class="container">
 <h1>Administrar usuarios</h1>
 <table class="table table-striped principal ">
        <thead>
            <tr>
                <th >Nombre  </th>
                <th >Apellido</th>
                <th >Cedula</th>
                <th >Estado</th>
                <th >Editar Pefil</th>
                <th >Eliminar Perfil</th>
            </tr>
        </thead>
        <tbody>

      




        <tr v-for="user in users">
            <th>{{user.name}}</th>
            <th  >{{user.apellido}}</th>
            <th   
            >{{user.cedula}}</th>
            <th>{{user.estado}}
            </th>
            <th >
            <div class="">
                
               <router-link :to='"/edit/"+user.id' >
                <button class="btn btn-dark">
                    Editar perfil
                </button>
                 </router-link>  
            </div>    
            </th>
            <th>
            <div class="">
              <button  class="btn btn-danger" @click="eliminarPerfil(user.id)">Eliminar perfil</button> 
            </div> 
            </th>
            <th></th>
        </tr>

        </tbody>
    </table>
    </div>
</template>
