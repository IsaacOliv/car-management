<script setup>
import http from '@/services/http.js'
import { onMounted, reactive } from 'vue';
const acessibilidades = reactive({
    acessibilidades:{}
});

async function listarAcessibilidades() {  
    try {
        const {data} = await http.get('/api/acessibilidades');
        acessibilidades.acessibilidades = data;
    } catch (error) {
        console.log(error);
    }
}


onMounted(() => {
    listarAcessibilidades();
})
</script>

<template>
    <main class="container mt-5">
    <table class="table">
      <thead>
        <tr>
          <th class="text-center col-md-9" scope="col">Categoria</th>
          <th class="text-center col-md-3" scope="col">Opções</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="acessibilidade in acessibilidades.acessibilidades" :key="acessibilidade.id">
          <td class="text-center" scope="row">{{ acessibilidade.categoria }}</td>
          <td class="text-center">
            <button class="btn btn-primary mx-2">Editar</button>
            <button class="btn btn-danger">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</template>

<style>
</style>