<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { jsPDF } from 'jspdf';  
import autoTable from 'jspdf-autotable'; 
let cars = ref([]); 
const all_cars = async () =>{
    let response = await axios.get("/api/get_all_cars").
    then(response=>{
        cars.value = response.data.carros; 
    //    tabla();         
    });
    
    

}
const eliminarPerfil = (num) =>{
    axios.post('/api/delete_car/'+num) 
    .then((response)=>{
        console.log(response);
        all_cars();  
    })
    .catch((error)=>{
        console.log(error.response);
    });  
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

    all_cars();
        
  
//    valores_tabla();    
});   

</script>
<template>
    <div class="container">
     

        <button @click="generatePDF()" >
PDF
        </button>
        <table  id="table_id" class="display table"> 
            <thead>
            <tr>
                <th id="row_head">Id  </th>
                <th id="row_head">Marca  </th>
                <th id="row_head">Modelo</th>
                <th id="row_head">Placa</th>
                <th id="row_head">Estado</th>
          <th>Editar Auto</th>
                <th>Eliminar Auto</th>
                <th>Cambiar Estado</th> 
            </tr>
        </thead>
        <tbody>
        <tr v-for="car in cars"> 
            <td id="row_id" class="">{{car.id}} </td>
            <td id="row_marca" class="">{{car.marca}} </td>
            <td id="row_modelo" class=""> {{car.modelo}}</td>
            <td id="row_placa" class=""> {{car.placa}}</td>
            <td id="row_estado" class=""> {{car.estado}}</td> 
           <td>
           <div class=""> 
               <router-link :to='"/editcar/"+car.id'>Editar Carro </router-link>  
            </div>       
            
            </td>
            <td>
            <div class="">
              <button @click="eliminarPerfil(car.id)">Eliminar perfil</button> 
            </div> 
            </td>  
            <td>
                <select name="" id="" v-model="car.estado" @change="changeState(car.id,car.estado)">
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