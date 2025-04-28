<?php 

    include '../lib/config.php';
    include ROOT.'parts/cabecalho.php';    
?>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php 
            include ROOT.'lib/datalib.php';
            include ROOT.'lib/functions.php';
            include ROOT.'parts/navbar.php';
            include ROOT.'parts/side_menu.php';
        ?>

      <div class="content-wrapper">
        <?php include ROOT.'parts/content_header.php' ?>

        <section class="content">
            conteudo
        </section>
      </div>

      <?php include ROOT.'parts/footer.php' ?>
    </div>

    <?php include ROOT.'parts/rodape.php' ?>
  </body>
</html>
