<?php 
    include '../parts/head.php'
?>
<?php
// Inicia a sessão
session_start();

// Conexão com o banco de dados
include '../conexao/conexao.php';  // Substitua pelo caminho correto do arquivo de conexão

// Variáveis para armazenar os erros
$erro = '';
$sucesso = false;

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome_cad'];
    $email = $_POST['email_cad'];
    $senha = $_POST['senha_cad'];

    /// Validação simples
    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios.";
    } else {
        // **Remover o hash da senha**, apenas salva a senha em texto simples
        // O valor de $senha já está em texto simples, então não há necessidade de password_hash()

        // Prepara a query de inserção no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Executa a query
        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $senha);
            if ($stmt->execute()) {
                // Usuário cadastrado com sucesso
                $sucesso = true;
                $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
                header("Location: ../public/login.php"); // Redireciona para a página de login
                exit();
            } else {
                $erro = "Erro ao cadastrar. Tente novamente.";
            }
        } else {
            $erro = "Erro na consulta ao banco de dados.";
        }
    }
}
?>

<body class="body-cadastro">
  <div class="login-box">
    <div class="login-logo">
      <b>Cadastro</b>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Criar nova conta</p>

      <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
      <?php endif; ?>
      <?php if ($sucesso): ?>
        <div class="alert alert-success">Cadastro realizado com sucesso! Você será redirecionado para o login.</div>
      <?php endif; ?>

      <form method="post" action="">
        <div class="form-group">
          <label for="nome_cad">Seu nome</label>
          <input id="nome_cad" name="nome_cad" required type="text" class="form-control" placeholder="Nome">
        </div>

        <div class="form-group">
          <label for="email_cad">Seu e-mail</label>
          <input id="email_cad" name="email_cad" required type="email" class="form-control" placeholder="contato@email.com">
        </div>

        <div class="form-group">
          <label for="senha_cad">Sua senha</label>
          <input id="senha_cad" name="senha_cad" required type="password" class="form-control" placeholder="Senha">
        </div>

        <div class="d-flex justify-content-center mt-4">
          <input type="submit" value="Cadastrar" class="btn btn-primary btn-flat px-5">
        </div>
      </form>

      <p class="link mt-3">
        Já tem conta? <a href="../public/login.php">Ir para Login</a>
      </p>
    </div>
  </div>
</body>
