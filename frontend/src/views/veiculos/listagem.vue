<script setup>
import http from '@/services/http.js'
import toast from '@/services/vueToast';
import { reactive, onMounted } from "vue";

const dados = reactive({
    veiculos: {

    },
    acessibilidades: {

    },
});

onMounted(async () => {
    const { data: veiculosData } = await http.get('api/veiculos');
    dados.veiculos = veiculosData;
})

async function deletaVeiculo(veiculo) {
    try {
        const { data } = await http.delete('/api/veiculos/' + veiculo.id);

        const index = dados.veiculos.indexOf(veiculo);
        if (index > -1) {
            dados.veiculos.splice(index, 1);
        }

        toast.success("Veiculo excluido com sucesso!");
    } catch (error) {
        toast.error(error.response.data.msg);
    }

}

function formatarData(dataParaFormatar) {
    let dataSeparada = dataParaFormatar.split('-');
    return dataSeparada[2] + '/' + dataSeparada[1] + '/' + dataSeparada[0];
}



</script>

<template>
    <main class="container mt-5">
        <div class="text-center mb-5">
            <h5>Listagem de veiculos</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center col-md-4" scope="col">Modelo</th>
                    <th class="text-center col-md-1" scope="col">Dt. aquisição</th>
                    <th class="text-center col-md-2" scope="col">Acessibilidade</th>
                    <th class="text-center col-md-3" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="veiculo in dados.veiculos" :key="veiculo.id">
                    <td class="text-center">{{ veiculo.modelo }}</td>
                    <td class="text-center">{{ formatarData(veiculo.dataAquisicao) }}</td>
                    <td class="text-center">
                        {{ veiculo.acessibilidade?.categoria }}
                        <span v-if="!veiculo.acessibilidade">-</span>
                    </td>
                    <td class="td-btns">
                        <router-link class="btn btn-primary mx-2"
                            :to="'/veiculo/edicao/' + veiculo.id">Editar</router-link>
                        <form action="">
                            <button class="btn btn-danger"
                                v-on:click.prevent.submit="deletaVeiculo(veiculo)">Excluir</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

</template>

<style scoped>
.td-btns {
    display: flex;
    justify-content: center;
}
</style>
