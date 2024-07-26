<script setup>
import http from '@/services/http.js'
import toast from '@/services/vueToast';
import { onMounted, reactive } from 'vue';
const dados = reactive({
    acessibilidades: {}
});

async function listarAcessibilidades() {
    try {
        const { data } = await http.get('/api/acessibilidades');
        dados.acessibilidades = data;
    } catch (error) {
        console.log(error);
    }
}

async function excluirAcessibilidade(acessibilidade) {
    try {
        const { data } = await http.delete('/api/acessibilidades/' + acessibilidade.id);
        const index = dados.acessibilidades.indexOf(acessibilidade);
        if (index > -1) {
            dados.acessibilidades.splice(index, 1);
        }
        toast.success("Acessibilidade excluida com sucesso!")
    } catch (error) {
        toast.error(error.response.data.msg)
    }
}


onMounted(() => {
    listarAcessibilidades();
})
</script>

<template>
    <main class="container mt-5">
        <div class="text-center mb-5">
            <h5>Listagem de acessibilidades</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center col-md-9" scope="col">Categoria</th>
                    <th class="text-center col-md-3" scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="acessibilidade in dados.acessibilidades" :key="acessibilidade.id">
                    <td class="text-center" scope="row">{{ acessibilidade.categoria }}</td>
                    <td class="td-btns">
                        <router-link class="btn btn-primary mx-2"
                            :to="{ name: 'edicaoAcessibilidade', params: { id: acessibilidade.id } }">Editar</router-link>
                        <form action="">
                            <button class="btn btn-danger"
                                v-on:click.submit.prevent="excluirAcessibilidade(acessibilidade)">Excluir</button>
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