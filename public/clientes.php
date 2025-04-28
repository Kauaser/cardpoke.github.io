<?php
    include '../parts/head.php'
?>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include '../parts/navbar.php'
      ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper background">
            <div class="content">
                <div class="container">
                    <section class="content">
                        <h2 class="text-center mb-4">Nossos Parceiros</h2>
                        <p class="text-center text-muted mb-5">
                            Conheça as empresas e pessoas que nos ajudam a trazer as melhores cartas Pokémon para você!
                        </p>
                        
                        <div class="row">
                            <?php
                                include '../lib/datalib_contatos.php';

                                foreach ($dataset as $i => $parceiro) {
                                    $delay = $i * 100;
                                    include '../parts/clientes_card.php';
                                }
                            ?>


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