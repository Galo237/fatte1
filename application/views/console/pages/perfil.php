<?php
session_start();

include '../../../controllers/connection.php';

// Verificar se o usuário está logado
if(isset($_SESSION['usuario'])) {
    $nome_usuario = $_SESSION['usuario'];
    $nome = $_SESSION['usuario'];
    $telefone = $_SESSION['telefone'];
    $email = $_SESSION['email'];
    $genero = $_SESSION['gender'];

} else {
    // Se o usuário não estiver logado, redirecionar para a página de login
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Perfil</title>
    <link rel="stylesheet" href="../css/perfil.css">
</head>
<body>
    <header>
        <!-- Cabeçalho da página -->
        <h1>Seu Perfil</h1>
    </header>

    <div class="container">
        <div class="profile-info">
            <!-- Exibir as informações do cliente -->
            <h2>Informações Pessoais</h2>
            <p><strong>Nome:</strong> <?php
            if(isset($_SESSION['usuario'])) { echo $nome; } ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
            <p><strong>Gênero:</strong> <?php echo $genero; ?></p>

            <!-- Link para atualizar informações -->
            <a href="atualizar_perfil.php">Atualizar Informações</a>
        </div>
    </div>
</body>
</html>