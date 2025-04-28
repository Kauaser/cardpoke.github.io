<?php 
    include '../parts/head.php'
?>

<?php
session_start();
$erro = '';
if (isset($_SESSION['erro_login'])) {
    $erro = $_SESSION['erro_login'];
    unset($_SESSION['erro_login']); // limpa para não reaparecer
}

?>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Login</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Entrar</p>
      <?php if (!empty($erro)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $erro ?>
    </div>
<?php endif; ?>


<form action="validate.php" method="POST">
  <div class="form-group has-feedback">
    <input type="email" name="email" class="form-control" placeholder="Email" required>
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="password" name="password" class="form-control" placeholder="Senha" required>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="d-flex justify-content-center mt-4">
    <button type="submit" class="btn btn-primary btn-flat px-5">Entrar</button>
  </div>
</form>

      <a href="../public/esqueci_senha.php">Esqueci minha senha</a><br>
      <a href="../public/cadastro.php" class="text-center">Cadastre-se</a>

    </div>
    <!-- /.login-box-body -->
  </div>


</body>
</html>
