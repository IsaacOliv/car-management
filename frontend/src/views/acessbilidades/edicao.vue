<script setup>
import http from '@/services/http.js';
import toast from '@/services/vueToast.js';
import { useRoute } from 'vue-router'
import { onMounted, reactive } from 'vue';

const route = useRoute()

const dados = reactive({
    acessibilidade: {

    }
});

async function editarAcessibilidade() {
    try {
        const { data } = await http.get('/api/acessibilidades/' + route.params.id)
        dados.acessibilidade = data;
    } catch (error) {
        toast.error(error.response.data.msg);
    }
}
onMounted(() => {
    editarAcessibilidade();
})

async function updateAcessibilidade() {
    try {
        const { data } = await http.put('/api/acessibilidades/' + route.params.id, dados.acessibilidade)
        toast.success('Acessibilidade atualizada com sucesso!');
    } catch (error) {
        toast.error(error.response.data.msg);
    }
}


</script>

<template>
    <main class="container mt-5">
        <div class="text-center mb-5">
            <h5>Edição de acessibilidades</h5>
        </div>
        <div class="row">
            <form action="">
                <div class="col-md-4 offset-4">

                    <div class="text-center">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <input type="text" class="form-control mt-3" id="categoria" max="30" required
                            v-model="dados.acessibilidade.categoria">
                    </div>

                    <div class="text-center mt-3">
                        <button class="btn btn-primary" v-on:click.submit.prevent="updateAcessibilidade">Editar</button>
                    </div>

                </div>
            </form>
        </div>
    </main>
</template>

<style scoped></style>
