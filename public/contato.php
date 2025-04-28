<?php
    include '../parts/head.php'
?>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
    <?php
        include '../parts/navbar.php'
    ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper background">
            <div class="content">
                <div class="container">
                    <section class="content">
                        <h2 class="text-center mb-4">Entre em Contato</h2>
                        <p class="text-center text-muted mb-5">
                            Tem dúvidas ou sugestões? Preencha o formulário abaixo e entraremos em contato!
                        </p>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="nome">Nome</label>
                                                <input type="text" class="form-control" id="nome" placeholder="Seu nome">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Seu email">
                                            </div>
                                            <div class="form-group">
                                                <label for="mensagem">Mensagem</label>
                                                <textarea class="form-control" id="mensagem" rows="5" placeholder="Digite sua mensagem"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Enviar Mensagem</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <?php
            include '../parts/footer.php'
        ?>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="../js/cart.js"></script>
</body>
</php>