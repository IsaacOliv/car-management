<template>
    <nav class="container navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                                <router-link class="dropdown-item" aria-current="page" to="/veiculo/listagem">Listagem</router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" aria-current="page" to="/veiculo/cadastro">Cadastro</router-link>
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
                                <router-link class="dropdown-item" aria-current="page" to="/acessibilidade/listagem">Listagem</router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" aria-current="page" to="/acessibilidade/cadastro">Cadastro</router-link>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>
