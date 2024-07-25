<script setup>
import http from '@/services/http.js'
import { reactive, onMounted } from "vue";

const dados = reactive({
    veiculos: {

    },
    acessibilidades: {

    },
    modal: {
        array: {

        },
    },
});

onMounted(async () => {
    const { data: veiculosData } = await http.get('api/veiculos');
    dados.veiculos = veiculosData;
})

</script>

<template>
    <main class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center col-md-3" scope="col">Modelo</th>
                    <th class="text-center col-md-3" scope="col">Dt. aquisição</th>
                    <th class="text-center col-md-2" scope="col">Acessibilidade</th>
                    <th class="text-center col-md-2" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="veiculo in dados.veiculos" :key="veiculo.id">
                    <td class="text-center">{{ veiculo.modelo }}</td>
                    <td class="text-center">{{ veiculo.dataAquisicao }}</td>
                    <td class="text-center">
                        {{ veiculo.acessibilidade?.categoria }}
                        <span v-if="!veiculo.acessibilidade">-</span>
                    </td>
                    <td class="text-center">
                        <router-link class="btn btn-primary mx-2" :to="'/veiculo/edicao/'+veiculo.id">Editar</router-link>
                        <button class="btn btn-danger">Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

    <modal v-bind="dados.modal" />


</template>

<style scoped></style>
