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
 <table class="table bg-blue-dark texto-color">
        <thead>
            <tr>
                <th>Nombre  </th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Estado</th>
                <th>Ver Pefil</th>
                <th>Editar Pefil</th>
                <th>Eliminar Perfil</th>
            </tr>
        </thead>
        <tbody>

      




        <tr v-for="user in users">
            <th>{{user.name}}</th>
            <th class="" >{{user.apellido}}</th>
            <th class=""  
            >{{user.cedula}}</th>
            <th> <form action="{{route('actualizar-estado',$user)}}" method="POST">
 
            <input class=""  type="submit" value="">   
            </form>
            </th>
            <th>
            <div class="button-edit">
               <router-link :to='"/edit/"+user.id'>Ver perfil </router-link>  
            </div>    
            
            </th>
            <th>
            <div class="button-edit">
              <button @click="eliminarPerfil(user.id)">Eliminar perfil</button> 
            </div> 
            </th>
            <th></th>
        </tr>

        </tbody>
    </table>
    </div>
</template>
