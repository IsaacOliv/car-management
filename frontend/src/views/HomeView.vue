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
    <table class="table">
      <thead>
        <tr>
          <th class="text-center col-md-3" scope="col">Modelo</th>
          <th class="text-center col-md-3" scope="col">Dt. aquisição</th>
          <th class="text-center col-md-2" scope="col">Placa</th>
          <th class="text-center col-md-2" scope="col">Acessibilidade</th>
          <th class="text-center col-md-2" scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center" scope="row">1</td>
          <td class="text-center">Mark</td>
          <td class="text-center">Otto</td>
          <td class="text-center">@mdo</td>
          <td class="text-center">
            <button class="btn btn-primary mx-2">Editar</button>
            <button class="btn btn-danger">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</template>

<style scoped>
  tbody tr td{
    align-content: center;
  }
</style>
