<?php
session_start();
include '../conexao/conexao.php'; // Inclua a conexão com o banco de dados

// Verifique se os campos foram preenchidos
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Valide se o email existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        
        // **Comparando a senha diretamente sem hashing** (sem password_verify)
        if ($password === $user['senha']) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];
            $_SESSION['usuario_email'] = $user['email'];
            header('Location: /sitevai/index.php'); // Redireciona para a página do painel ou área logada
            exit();
        } else {
            // Senha incorreta
            $_SESSION['erro_login'] = 'Senha incorreta!';
            header('Location: ../public/login.php'); // Redireciona de volta para o login
            exit();
        }
    } else {
        // E-mail não encontrado
        $_SESSION['erro_login'] = 'E-mail não encontrado!';
        header('Location: ../public/login.php'); // Redireciona de volta para o login
        exit();
    }
} else {
    // Caso os campos não sejam enviados
    $_SESSION['erro_login'] = 'Por favor, preencha todos os campos.';
    header('Location: ../public/login.php'); // Redireciona de volta para o login
    exit();
}
?>
