<?php
// Iniciar a sessão
session_start();

if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalizar_compra'])) {   
    unset($_SESSION['cart']);
    header("Location: obrigado.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/carrinho.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Carrinho</title>
</head>
<body>
    <div class="header">
        <div class="logo"><a style="text-decoration: none; color: black;" href="../index.php">Fatte</a></div>
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
            <a href="carrinho.php"><span class="cart-icon"><img src="../imagens/cart1.png" alt=""></span></a>
            <?php
            if(isset($_SESSION['cliente'])) {
                $nome_usuario = $_SESSION['nome'];
                echo "<a href='perfil.php' style='text-decoration: none; color: black;'><span class='user-icon'>$nome_usuario</span></a>";
                echo "<a href='?logout' class='logout'><img src='../imagens/logout.png' alt=''></a>";
            } else {
                echo "<a href='perfil.php'><span class='user-icon'><img src='../imagens/user1.png' alt=''></span></a>";
            }
            ?>
        </div>
    </div>
    <div style="margin-top: 50px;">
        <h3 style="text-align: center;">Meu Carrinho</h3>
    </div>
    <div class="container mt-5">
        <?php
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                echo "<div class='table-responsive'>
                        <table class='table table-bordered'>
                            <thead class='thead-light'>
                                <tr>
                                    <th scope='col'>Produto</th>
                                    <th scope='col'>Preço</th>
                                    <th scope='col'>Tamanho</th>
                                </tr>
                            </thead>
                            <tbody>";
                foreach($_SESSION['cart'] as $item) {
                    echo "<tr>
                            <td>{$item['nome']}</td>
                            <td>R$ {$item['preco']}</td>
                            <td>{$item['tamanho']}</td>
                        </tr>";
                }
                echo "  </tbody>
                        </table>
                    </div>";
                echo "<form method='post' action='carrinho.php' class='mt-3'>
                        <button style='margin-bottom: 30px;' type='submit' name='finalizar_compra' class='btn btn-success'>Finalizar Compra</button>
                    </form>";
            } else {
                echo "<p class='alert alert-info'>Seu carrinho está vazio.</p>";
            }
        ?>
    </div>

    <footer class="custom-footer">
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