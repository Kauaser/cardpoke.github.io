<?php session_start(); ?>
<div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-yellow fixed-top">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <img src="/sitevai/imagens/logo site.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">CardPoke</span>
            </a>
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/sitevai/index.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/sitevai/public/clientes.php" class="nav-link">Clientes Parceiros</a>
                    </li>
                    <li class="nav-item">
                        <a href="/sitevai/public/contato.php" class="nav-link">Contato</a>
                    </li>

                    <?php if (isset($_SESSION['usuario_nome'])): ?>
                        <!-- Usuário logado -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user"></i> Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sitevai/public/logout.php" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i> Sair
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Visitante (não logado) -->
                        <li class="nav-item">
                            <a href="/sitevai/public/login.php" class="nav-link">
                                <i class="fas fa-user-plus"></i> Cadastro
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Botão do Carrinho -->
                    <li class="nav-item ml-auto">
                        <a href="#" class="nav-link" id="cart-button">
                            <i class="fas fa-shopping-cart"></i> Carrinho (<span id="cart-count">0</span>)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
