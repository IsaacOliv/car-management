<script setup>
import http from '@/services/http.js'
import {reactive, onMounted} from "vue";
  const veiculos = reactive({
    veiculos:{

    }
  });

  onMounted(async() => {
    try {
      const {data} = await http.get('api/veiculos');
      veiculos.veiculos = data;
    } catch (error) {
      console.log(error);
    }

  })
</script>

<template>
  <main class="container mt-5">
    <div class="text-center">
      <h2>Bem vindo</h2>
    </div>
  </main>
</template>

<style scoped>
</style>
