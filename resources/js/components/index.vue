<script setup>
import { useRouter } from 'vue-router';
import { onMounted, ref } from 'vue';
const router= useRouter();


const switchPage= ()=>{
    console.log('holaS'); 
    router.push('/dashboard');
}; 

</script>

<template> 
<h1>Hola mundo desde index</h1> 
  <button @click="switchPage">
    CAMBIA LA PAGINA
  </button> 
  <button >
    register
  </button>
</template>