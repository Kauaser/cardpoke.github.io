<?php
session_start();
include '../conexao/conexao.php'; // Conexão com o banco de dados

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar se o token existe no banco e se está dentro do prazo de expiração
    $query = "SELECT * FROM usuarios WHERE token_recuperacao = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar se o token ainda não expirou
        $data_atual = new DateTime();
        $data_token = new DateTime($user['data_token']);
        $interval = $data_token->diff($data_atual);

        if ($interval->h < 1) {  // O token é válido por 1 hora
            // Token válido, permitir que o usuário altere a senha
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nova_senha = $_POST['nova_senha'];
                $confirmar_senha = $_POST['confirmar_senha'];

                // Verificar se as senhas coincidem
                if ($nova_senha === $confirmar_senha) {
                    // Atualizar a senha no banco de dados (sem hash)
                    $update_query = "UPDATE usuarios SET senha = ?, token_recuperacao = NULL, data_token = NULL WHERE email = ?";
                    $update_stmt = $conn->prepare($update_query);
                    $update_stmt->bind_param('ss', $nova_senha, $user['email']);
                    $update_stmt->execute();

                    $_SESSION['sucesso_recuperacao'] = "Sua senha foi alterada com sucesso.";
                    header("Location: login.php");
                    exit();
                } else {
                    $_SESSION['erro_recuperacao'] = "As senhas não coincidem.";
                }
            }
        } else {
            $_SESSION['erro_recuperacao'] = "O link de recuperação de senha expirou.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['erro_recuperacao'] = "Token inválido.";
        header("Location: login.php");
        exit();
    }
} else {
    // Caso o token não seja passado na URL, redireciona para a página de login
    header("Location: login.php");
    exit();
}
?>

<!-- Formulário de recuperação de senha -->
<form action="recuperar_senha_form.php?token=<?= $_GET['token'] ?>" method="POST">
    <label for="nova_senha">Nova Senha:</label>
    <input type="password" name="nova_senha" required>

    <label for="confirmar_senha">Confirmar Nova Senha:</label>
    <input type="password" name="confirmar_senha" required>

    <button type="submit">Alterar Senha</button>
</form>
