<?php
// Configurações de conexão
$servername = "localhost"; // geralmente localhost no WAMP
$username = "u258744242_contato";        // usuário padrão do WAMP
$password = "C4r4m4z0v123!";            // senha padrão do WAMP é vazia
$dbname = "u258744242_contato";      // nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados do formulário
$nome     = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$idade    = isset($_POST['idade']) ? intval($_POST['idade']) : null;
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';

// Validação simples
if (empty($nome) || empty($email)) {
    die("Por favor, preencha os campos obrigatórios (Nome e Email).");
}

// Preparar e executar o insert
$sql = "INSERT INTO contatos (nome, idade, email, telefone) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro na preparação da query: " . $conn->error);
}

$stmt->bind_param("siss", $nome, $idade, $email, $telefone);

if ($stmt->execute()) {
    // Enviar e-mail (sem exibir mensagens duplicadas)
    $to      = "contato@eduardosonego.com";
    $subject = "Novo contato recebido";
    $message = "Nome: $nome\nIdade: $idade\nEmail: $email\nTelefone: $telefone";
    $headers = "From: contato@eduardosonego.com";

    mail($to, $subject, $message, $headers);

    echo "Contato enviado com sucesso!";
} else {
    echo "Erro ao salvar contato: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>