<script setup>
import http from '@/services/http.js'
import toast from '@/services/vueToast.js'
import { reactive } from 'vue';

const acessibilidade = reactive({});


async function cadastrarAcessibilidade() {
  try {
    const {data} = await http.post('/api/acessibilidades', acessibilidade)
    toast.success(data.msg);
  } catch (error) {
    console.log(error);
  }
}


</script>

<template>
  <main class="container">
    <div class="row">
      <form action="">
        <div class="col-md-4 offset-4">

          <div class="text-center">
            <label for="categoria" class="form-label">Categoria:</label>
            <input type="text" class="form-control mt-3" id="categoria" max="30" required v-model="acessibilidade.categoria">
          </div>

          <div class="text-center mt-3">
            <button class="btn btn-primary" v-on:click.submit.prevent="cadastrarAcessibilidade">Cadastrar</button>
          </div>

        </div>
      </form>
    </div>
  </main>
</template>

<style scoped>

</style>
