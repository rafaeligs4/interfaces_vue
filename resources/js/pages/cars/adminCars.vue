<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { jsPDF } from 'jspdf';  
import autoTable from 'jspdf-autotable'; 
import Swal from 'sweetalert2';
let cars = ref([]); 
let role;
const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);
const all_cars = async () =>{
    let response = await axios.get("/api/get_all_cars").
    then(response=>{
     cars.value = response.data.carros; 
    });
}
const get_User =async () =>{
    let usuario = await axios.get('/api/edit/'+usuarioId);
   role=usuario.data.user.rol;
   console.log(role);
}
const eliminarPerfil = (num) =>{
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Estas seguro de eliminar este Auto?',
  text: "No se revertirá la accion",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Si, Eliminar',
  cancelButtonText: 'No, Cancelar',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    swalWithBootstrapButtons.fire(
      'Eliminado!',
      'Este auto ha sido Eliminado.',
      'success'
      
    );
    axios.post('/api/delete_car/'+num) 
    .then((response)=>{
        console.log(response);
        all_cars();  
    })
    .catch((error)=>{
        console.log(error.response);
    }); 
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelado',
      'No se ha eliminado el Auto :)',
      'error'
    )
  }
})
    
}
const changeState = (id,estado) =>{
    const formdata=new FormData();
    formdata.append('estado',estado);
    console.log(estado);
    axios.post('/api/state/'+id,formdata) 
    .then(response=>{
        console.log(response.data);
    }); 
    all_cars();
};
const generatePDF = () =>{
    

// Default export is a4 paper, portrait, using millimeters for units
const doc = new jsPDF();

var res = doc.autoTableHtmlToJson(document.getElementById("table_id"));

 var columns = [res.columns[0], res.columns[1],res.columns[2], res.columns[3], res.columns[4]];
 console.log(columns); 
  doc.autoTable(columns, res.data, {startY: 60});
 doc.save('hola.pdf');
}
onMounted(async () => {
    get_User();
    all_cars();
    
  
//    valores_tabla();    
});   

</script>
<template>
    <div class="container">
     
        <div class="d-flex justify-content-center m-2">
            <h1>Tabla de Autos</h1>
        </div>
        <div class="d-flex justify-content-end m-1">
            <button class="btn btn-danger" @click="generatePDF()" >
            PDF<i class="fas fa-file-pdf m-1"></i>
            </button>
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
<style>

</style>