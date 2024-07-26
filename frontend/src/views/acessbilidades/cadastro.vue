<script setup>
import http from '@/services/http.js';
import toast from '@/services/vueToast.js';
import { reactive } from 'vue';

const dados = reactive({
    acessibilidade:{},
    errors:{}
});


async function cadastrarAcessibilidade() {
    try {
        const { data } = await http.post('/api/acessibilidades', dados.acessibilidade)
        toast.success(data.msg);
    } catch (error) {
        dados.errors = error.response.data['errors'];
        if (error.response.data.msg) {
            toast.error(error.response.data.msg);
        }
    }
}


</script>

<template>
    <main class="container mt-5">
        <div class="text-center mb-5">
            <h5>Cadastro de acessibilidades</h5>
        </div>
        <div class="row">
            <form action="">
                <div class="col-md-4 offset-4">

                    <div class="text-center">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <input type="text" class="form-control mt-3" id="categoria" max="30" required
                            v-model="dados.acessibilidade.categoria">
                        </div>
                        <span class="erro" v-if="dados.errors.categoria">{{ dados.errors.categoria[0] }}</span>

                    <div class="text-center mt-3">
                        <button class="btn btn-primary"
                            v-on:click.submit.prevent="cadastrarAcessibilidade">Cadastrar</button>
                    </div>

                </div>
            </form>
        </div>
    </main>
</template>

<style scoped>
.erro{
    color: red;
}
</style>
