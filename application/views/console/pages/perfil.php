<?php
session_start();

include '../../../controllers/connection.php';

// Verificar se o usuário está logado
if(isset($_SESSION['cliente'])) {
    $nome_cliente = $_SESSION['nome'];
    $nome = $_SESSION['nome'];
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
        <div class="header">
            <div class="logo"><a href="../index.php">Fatte</a></div>
                <nav id="nav">
                    <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">Menu
                        <span id="hamburger"></span>
                    </button>
                    <ul id="menu" role="menu">
                        <li><a href="">Destaque</a></li>
                        <li><a href="masculino.php">Masculino</a></li>
                        <li><a href="feminino.php">Feminino</a></li>
                        <li><a href="sobre.php">Sobre</a></li>
                    </ul>
                </nav>
            <div class="icons">
                <span class="search-icon"><img src="../imagens/search1.png" alt=""></span>
                <a href="../controllers/dashboard.php"><span class="cart-icon"><img src="../imagens/cart1.png" alt=""></span></a>
                <?php
                    // Verificar se o usuário está logado
                    if(isset($_SESSION['cliente'])) {
                        $nome_usuario = $_SESSION['nome'];
                        // Exibir o nome do usuário no lugar do ícone de usuário
                        echo "<a href='pages/perfil.php' style='text-decoration: none; color: black;'><span class='user-icon'>$nome_usuario</span></a>";
                    } else {
                        // Se o usuário não estiver logado, exibir o ícone de usuário padrão
                        echo "<a href='pages/perfil.php'><span class='user-icon'><img src='imagens/user1.png' alt=''></span></a>";
                    }
                ?>
            </div> 
        </div> 
    </header>

    <div class="container">
        <div class="profile-info">
            <!-- Exibir as informações do cliente -->
            <h2>Informações Pessoais</h2>
            <p><strong>Nome:</strong> <?php
            if(isset($_SESSION['cliente'])) { echo $nome; } ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
            <p><strong>Gênero:</strong> <?php echo $genero; ?></p>

            <!-- Link para atualizar informações -->
            <a href="atualizar_perfil.php">Atualizar Informações</a>
        </div>
    </div>
</body>
</html>