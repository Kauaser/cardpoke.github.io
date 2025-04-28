<?php
    include 'parts/head.php'
?>
<body class="hold-transition layout-top-nav">

    <div class="wrapper">
      <?php
        include 'parts/navbar.php'
      ?>
        
        <!-- Content Wrapper com background -->
        <div class="content-wrapper background">
            <div class="content">
                <div class="container">
                    <section class="content">
                        <h2 class="text-center mb-4">Principais Cartas Pokémon</h2>
                        <div class="row mt-4">
                            <?php
                                include 'lib/datalib.php';
                                foreach ($dataset as $item) {
                                    include 'parts/pokemon_card.php';
                                }
                            ?>     
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <?php
            include 'parts/footer.php'
        ?>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="js/cart.js"></script>
</body>
</html>