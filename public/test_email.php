<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Envio de E-mail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 50px;">
        <h2>Teste de Envio de E-mail</h2>
        <p>Este formulário é utilizado para testar o envio de e-mails de recuperação de senha.</p>
        
        <!-- Formulário para o envio de e-mail -->
        <form action="test_email.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar E-mail de Teste</button>
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
        ?>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Inclua o autoload do PHPMailer

// Criação da instância do PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuração do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Servidor SMTP do Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'kauaso231204@gmail.com';  // Seu e-mail do Gmail
    $mail->Password = 'mzzf nfzd qrxe mjtw';  // Senha de aplicativo do Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remetente e destinatário
    $mail->setFrom('kauaso231204@gmail.com', 'Testando PHPMailer');
    $mail->addAddress('kauaso13@outlook.com', 'Nome do Destinatário');  // Adicione o e-mail de destino

    // Corpo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Teste de Envio de E-mail';
    $mail->Body    = 'Este é um teste de envio de e-mail usando PHPMailer.<br>Funcionou!';

    // Enviar o e-mail
    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
}
?>