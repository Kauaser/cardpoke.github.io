<?php

// Inclusão das classes do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

// Carregar o autoload do PHPMailer
require __DIR__ . '../vendor/autoload.php';  // Certifique-se de que o caminho esteja correto

// Conexão com o banco de dados
include '../conexao/conexao.php'; // Ajuste o caminho para a sua conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Verificar se o e-mail existe no banco de dados
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Gerar um token único e uma data de expiração (1 hora)
        $token = bin2hex(random_bytes(32)); // Gera um token único
        $data_token = date('Y-m-d H:i:s', strtotime('+1 hour')); // Define o tempo de expiração para 1 hora

        // Atualizar o token no banco de dados
        $update_query = "UPDATE usuarios SET token_recuperacao = ?, data_token = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param('sss', $token, $data_token, $email);
        $update_stmt->execute();

        // Enviar o link de recuperação por e-mail usando PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuração do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Host SMTP do Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'kauaso231204@gmail.com';  // Seu e-mail do Gmail
            $mail->Password = 'dxgl aiii ydxg lttn';  // Sua senha de app gerada no Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Remetente e destinatário
            $mail->setFrom('kauaso13@outlook.com', 'Recuperação de Senha');
            $mail->addAddress($email);  // Destinatário (email do usuário)

            // Corpo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Recuperacao de Senha';
            $mail->Body    = 'Clique no link abaixo para redefinir sua senha:<br><a href="http://localhost/sitevai/public/recuperar_senha_form.php?token=' . $token . '">Recuperar Senha</a>';

            // Tenta enviar o e-mail
            $mail->send();

            // Sucesso no envio
            error_log("Email enviado com sucesso");  // Log de sucesso
            $_SESSION['sucesso_recuperacao'] = "Instruções para recuperação de senha foram enviadas para o seu e-mail.";
            header("Location: login.php");  // Redireciona para a página de login
            exit();
        } catch (Exception $e) {
            // Erro ao enviar o e-mail
            error_log("Erro ao enviar o e-mail: {$mail->ErrorInfo}");  // Log de erro
            $_SESSION['erro_recuperacao'] = "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
            header("Location: esqueci_senha.php");  // Redireciona para a página de erro
            exit();
        }

    } else {
        // E-mail não encontrado no banco de dados
        $_SESSION['erro_esqueci_senha'] = "E-mail não encontrado.";
        header("Location: esqueci_senha.php");  // Redireciona para a página de erro
        exit();
    }
}
?>

<!-- Formulário de recuperação de senha -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 50px;">
        <h2>Recuperação de Senha</h2>
        <p>Digite seu e-mail para receber um link de recuperação de senha.</p>
        
        <!-- Formulário para o envio de e-mail -->
        <form action="esqueci_senha.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar Link</button>
        </form>

        <!-- Mensagem de Sucesso ou Erro -->
        <?php
        if (isset($_SESSION['sucesso_recuperacao'])) {
            echo '<div class="alert alert-success mt-3">' . $_SESSION['sucesso_recuperacao'] . '</div>';
            unset($_SESSION['sucesso_recuperacao']);
        }
        if (isset($_SESSION['erro_recuperacao'])) {
            echo '<div class="alert alert-danger mt-3">' . $_SESSION['erro_recuperacao'] . '</div>';
            unset($_SESSION['erro_recuperacao']);
        }
        if (isset($_SESSION['erro_esqueci_senha'])) {
            echo '<div class="alert alert-danger mt-3">' . $_SESSION['erro_esqueci_senha'] . '</div>';
            unset($_SESSION['erro_esqueci_senha']);
        }
        ?>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
