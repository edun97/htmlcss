<?php
// Configurações do banco de dados
$servername = "mysql.railway.internal"; // geralmente localhost no WAMP
$username = "root";        // usuário padrão do WAMP
$password = "itsQRtNWTegfjbieAYSXhoDzEshKOaOo";            // senha padrão do WAMP é vazia
$dbname = "cadastro";      // nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados do formulário
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

// Preparar e executar o insert
$sql = "INSERT INTO usuarios (nome, idade, telefone, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $nome, $idade, $telefone, $email);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}
${{ MySQL.MYSQL_URL }}
// Fechar conexão
$stmt->close();
$conn->close();
?>
