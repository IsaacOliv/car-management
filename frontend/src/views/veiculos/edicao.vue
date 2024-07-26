<script setup>
import http from '@/services/http.js'
import toast from '@/services/vueToast.js'
import { useRoute } from 'vue-router'
import { onMounted, reactive, ref } from 'vue';

const route = useRoute()

const dados = reactive({
    veiculo: {},
    acessibilidades: {},
    errors: {},
});

async function editarVeiculo() {
    const { data: veiculo } = await http.get('/api/veiculo/' + route.params.id)
    dados.veiculo = veiculo;
}

async function listarAcessibilidades() {
    const { data: acessibilidades } = await http.get('/api/acessibilidades/')
    dados.acessibilidades = acessibilidades;
}

onMounted(() => {
    listarAcessibilidades();
    editarVeiculo();
});

async function updateVeiculo() {
    try {
        const { data } = await http.put('/api/veiculos/' + route.params.id, dados.veiculo)
        toast.success('Veiculo atualizado com sucesso!');
    } catch (error) {
        dados.errors = error.response.data['errors'];
        toast.error(error.response.data['msg'])
    }
}


</script>

<template>
    <main class="container mt-5">
        <div class="text-center mb-5">
            <h5>Edição de veiculos</h5>
        </div>
        <div class="row">
            <form action="">

                <div class="row">
                    <div class="col-md-6">
                        <label for="modelo" class="form-label">Modelo:</label>
                        <input type="text" class="form-control" id="modelo" max="30" required
                            v-model="dados.veiculo.modelo">
                        <span class="erro" v-if="dados.errors.modelo">{{ dados.errors.modelo[0] }}</span>
                    </div>
                    <div class="col-md-6">
                        <label for="placa" class="form-label">Placa:</label>
                        <input type="text" class="form-control" id="placa" max="30" required
                            v-model="dados.veiculo.placa">
                        <span class="erro" v-if="dados.errors.placa">{{ dados.errors.placa[0] }}</span>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="marca" class="form-label">Data de aquisição:</label>
                        <input type="date" class="form-control" id="dataAquisicao" required
                            v-model="dados.veiculo.dataAquisicao">
                        <span class="erro" v-if="dados.errors.dataAquisicao">{{ dados.errors.dataAquisicao[0] }}</span>
                    </div>
                    <div class="col-md-6">
                        <label for="acessibilidade" class="form-label">Acessibilidade:</label>
                        <select class="form-control" name="id_acessibilidade" id="acessibilidade"
                            v-model="dados.veiculo.id_acessibilidade">
                            <option value="0" selected>Sem acessibilidade</option>
                            <option v-for="acessibilidade in dados.acessibilidades" class="form-control"
                                :value="acessibilidade.id">{{ acessibilidade.categoria }}</option>
                        </select>
                        <span class="erro" v-if="dados.errors.id_acessibilidade">{{ dados.errors.id_acessibilidade[0]
                            }}</span>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button class="btn btn-primary" v-on:click.submit.prevent="updateVeiculo()">Editar</button>
                </div>

            </form>
        </div>
    </main>
</template>

<style scoped>
.erro {
    color: red;
    font-size: 12px;
}
</style>
