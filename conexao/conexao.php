<?php
$host = 'localhost'; // Ou o endereço do seu banco de dados
$dbname = 'cardpoke';
$username = 'root'; // Seu usuário do banco de dados
$password = ''; // Sua senha do banco de dados

// Criando a conexão
$conn = new mysqli($host, $username, $password, $dbname);

// Verificando se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>