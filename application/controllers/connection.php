<?php

$servername = "localhost"; 
$username = "root"; 
$password = "master100"; 
$database = "fatte";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Função para verificar se o usuário está logado
function verificarLogin() {
    if(!isset($_SESSION['logged_in'])) {
        header("Location: login.php"); // Redirecionar para a página de login se não estiver logado
        exit;
    }
}

// Função para fazer login
function fazerLogin($cliId, $senha) {
    global $conn;

    // Consulta SQL para verificar se o usuário e a senha correspondem
    $sql = "SELECT * FROM cliente WHERE cliId = '$cliId' AND cliSenha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login bem-sucedido, configurar a variável de sessão e redirecionar para a página principal
        $_SESSION['logged_in'] = true;
        $_SESSION['cliente'] = $cliId;
        header("Location: index.php");
        exit;
    } else {
        // Login falhou, redirecionar de volta para a página de login
        header("Location: login.php?erro=1");
        exit;
    }
}
?>