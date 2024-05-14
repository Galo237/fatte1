<?php
// Iniciar a sessão
session_start();

include '../../../controllers/connection.php';

$sql = "SELECT * FROM produtos WHERE proGenero = 'M'";
$result = $conn->query($sql);

if(isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    // Redirecionar para a página inicial
    header("Location: ../index.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/masculino.css">
    <title>Masculino</title>
</head>
<body>
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
                        echo "<a href='perfil.php' style='text-decoration: none; color: black;'><span class='user-icon'>$nome_usuario</span></a>";
                        echo "<a href='?logout' class='logout'><img src='../imagens/logout.png' alt=''></a>";
                    } else {
                        // Se o usuário não estiver logado, exibir o ícone de usuário padrão
                        echo "<a href='perfil.php'><span class='user-icon'><img src='../imagens/user1.png' alt=''></span></a>";
                    }
                ?>
        </div> 
    </div>
    <h3>Catálogo Masculino</h3>
    <div class="page-inner-content">
        <div class="product" id="product">
            <?php            
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='roupa'>
                            <img src='data:image/jpeg;base64," . base64_encode($row['proImagem']) . "' alt='{$row['proNome']}'>
                            <p>{$row['proNome']}</p>
                            <p>R$ {$row['proPreco']}</p>                        
                        </div>";
                }
            } else {
                echo "<p>Nenhum produto masculino encontrado!</p>";
            } 
            ?>
        </div>
    </div>

    <footer>
        <div class="footer-left">
            <h3>CONTATO</h3>
            <p><b>Email: </b>fattecommerce@gmail.com</p>
            <p><b>Telefone: </b>+55 41 99842-8507</p>
            <br>
            <p>Segunda à sexta: 09:00 às 18:00</p>
            <p>Sábado: 09:00 às 15:00</p>
            <p>Exceto Feriados</p>
        </div>
        <div class="footer-right">
            <h3>REDES SOCIAIS</h3>
            <div class="instagram">
                <a href="https://www.instagram.com/fatteclothing?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"><img src="../imagens/instagram.png" alt=""></a>
                <p>@fatteclothing</p>
            </div>
            <div class="twitter">
                <a href=""><img src="../imagens/twitter.png" alt=""></a>
                <p>@fatteclothing</p>
            </div>
            <div class="facebook">
                <a><img src="../imagens/facebook.png" alt=""></a>
                <p>Fatte Clothing</p>
            </div>
        </div>       
    </footer>
</body>
</html>