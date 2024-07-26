<template>


    <nav class="container navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" to="/">Inicio</router-link>
                    </li>

                    <!-- veiculo -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Veiculos
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <router-link class="dropdown-item" aria-current="page"
                                    to="/veiculo/listagem">Listagem</router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" aria-current="page"
                                    to="/veiculo/cadastro">Cadastro</router-link>
                            </li>
                        </ul>
                    </li>

                    <!-- acessibilidade -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Acessibilidades
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <router-link class="dropdown-item" aria-current="page"
                                    to="/acessibilidade/listagem">Listagem</router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" aria-current="page"
                                    to="/acessibilidade/cadastro">Cadastro</router-link>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>
