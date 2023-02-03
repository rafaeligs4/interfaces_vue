
<template>
  
    <div class="modal fade" style="z-index: 1110;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-body">
                
         <div class="container">
            <div class="row">
                 <h1 class="d-flex justify-content-center">Auto modelo {{ props.car_data.modelo }} </h1>
                   
                   <div class="col-7">
                    <div class="col-12">
                     
                        <img :src='"/photo/"+(props.car_data.foto1 ? props.car_data.foto1 : "image.png")' height="200" width="400">
                   
                    </div>
                    <div class="col-12 d-flex flex-row">
                    <div class="col-4 m-1 ">
                           
                        <img :src='"/photo/"+(props.car_data.foto2 ? props.car_data.foto2 : "image.png")' height="90" width="125">
                  
                    </div>
                    <div class="col-4 m-1">
                       
                        <img :src='"/photo/"+(props.car_data.foto3 ? props.car_data.foto3 : "image.png")'  height="90" width="125">
                 
                    </div>
                    <div class="col-4 m-1">
                       
                        <img :src='"/photo/"+(props.car_data.foto4 ? props.car_data.foto4 : "image.png")'  height="90" width="125">
                  
                    </div>    
                    </div>
                    
                    
                   </div>
                  
                   <div class="col-4">
                    <div class="col-12">
                        <div>
                       <label for="">Marca: </label>
                        {{props.car_data.modelo}}
                        </div>
                        <div>
                       <label for="">Color: </label>
                       {{props.car_data.color}}
                        </div>
                        <div>
                       <label for="">Placa: </label>
                       {{props.car_data.placa}}
                        </div>
                        <div>
                       <label for="">Tipo: </label>
                       {{props.car_data.tipo}}
                        </div>
                        
                    </div>
                   
                   </div>
                
            </div>
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button @click="buy()" type="button" class="btn btn-primary">Alquilar</button>
      </div>
    </div>
  </div>
</div>
</div>    

 

</template>
<script setup>
import Swal from 'sweetalert2';
import { ref } from 'vue';

const mutar = ref(props.id);
let props = defineProps({
    id:{
        type: String,
        default: ''
    },
    car_data: {
        type: Object
    }
});
const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);
const buy= ()=>{ 
    if(usuarioId==0){
        Swal.fire('Necesitas resgistrarte para poder alquilar un auto');
    }
    else{
        Swal.fire({
  title: 'Esta seguro que quiere rentar este auto?',
  text: "Se agregara en el sistema la renta del mismo",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Alquilar'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Alquilado',
      'El auto ha sido alquilado',
      'success'
    )
    
  }
})
    }
   console.log(usuarioId); 
}
</script> 