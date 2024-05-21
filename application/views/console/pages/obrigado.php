<?php
// Iniciar a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit;
}

// Encerrar a sessão do carrinho, se existir
if(isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/obrigado.css">
    <title>Obrigado pela sua compra!</title>
</head>
<style>
    * {
    margin: 0;
    padding: 0;
}

/* Defina o estilo global do corpo da página */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    background-color: #fff; 
    position: sticky;
    top: 0;
}
  
.logo {
    font-size: 40px;
    font-weight: bold; 
}
  
#nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}
  
#nav li {
    display: inline-block;
    margin-right: 30px; 
    font-size: 20px; 
    font-weight: bold;
}

#menu a {
    text-decoration: none;
    color: black;
}
  
.icons span {
    margin-left: 15px; 
    font-size: 24px; 
}

button {
    display: none;
}

/* Agradecimento */
.agradecimento-content {
    text-align: center;
    padding: 50px;
}

.agradecimento-content h1 {
    font-size: 2.5em;
    color: #333;
}

.agradecimento-content p {
    font-size: 1.2em;
    color: #666;
    margin: 20px 0;
}

.agradecimento-content a {
    display: inline-block;
    margin-top: 30px;
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.agradecimento-content a:hover {
    background-color: #555;
}

/* Footer */
.btn {
    background-color: #ffffff;
    color: #000000;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    margin-right: 10px;
    cursor: pointer;
}

footer {
    background-color: #0c0c0c;
    color: #ffffff;
    padding: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-left {

}

.footer-right {
    
}

.instagram {
    display: flex;
}

.instagram p{
    margin-top: 5px;
}

.twitter {
    display: flex;
}

.twitter p {
    margin-top: 5px;
}

.facebook {
    display: flex;
}

.facebook p {
    margin-top: 7px;
}

</style>

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
    <div class="agradecimento-content">
        <h1>Obrigado pela sua compra!</h1>
        <p>Agradecemos por comprar na Fatte. Seu pedido foi recebido e está sendo processado.</p>
        <p>Você receberá um email de confirmação em breve com os detalhes do seu pedido.</p>
        <a href="../index.php">Voltar à página inicial</a>
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