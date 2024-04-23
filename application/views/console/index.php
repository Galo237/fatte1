<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatte</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">Fatte</div>
                <nav id="nav">
                    <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">Menu
                        <span id="hamburger"></span>
                    </button>
                    <ul id="menu" role="menu">
                        <li><a href="">Destaque</a></li>
                        <li><a href="pages/masculino.php">Masculino</a></li>
                        <li><a href="pages/feminino.php">Feminino</a></li>
                        <li><a href="pages/sobre.php">Sobre</a></li>
                    </ul>
                </nav>
            <div class="icons">
                <span class="search-icon"><img src="imagens/search1.png" alt=""></span>
                <a href="../controllers/dashboard.php"><span class="cart-icon"><img src="imagens/cart1.png" alt=""></span></a>
                <a href="pages/cadastro.php"><span class="profile-icon"><img src="imagens/user1.png" alt=""></span></a>
            </div> 
        </div> 
    </header>

    <section class="banner">
    </section>

    <a>
        <h3 class="fotos">GALERIA</h3>
    </a>
    <section class="galeria">
        <a class="link"><img src="imagens/galeria1.jpg" alt=""></a>
        <a class="link"><img src="imagens/galeria2.jpg" alt=""></a>
        <a class="link"><img class="galeria3" src="imagens/galeria3.jpg" alt=""></a>
    </section>

    <section class="featured-products">

    </section>

    <h3 class="destaques">DESTAQUES</h3>

    <div class="card">
        <p>
        <a href=""><img src="imagens/masculino.jpg" alt="masculino"></a>
        <span>Masculino</span>
        </p>
        <p>
        <a href=""><img src="imagens/feminino.jpg" alt="feminino"></a>
        <span>Feminino</span></p>
        <p>
        <a href=""><img src="imagens/acessorios.jpg" alt="acessorios"></a>
        <span>Acessórios</span></p>
        <p>
        <a href=""><img src="imagens/kits.jpg" alt="kits"></a>
        <span>Kits</span></p>
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
                <a href="https://www.instagram.com/fatteclothing?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"><img src="imagens/instagram.png" alt=""></a>
                <p>@fatteclothing</p>
            </div>
            <div class="twitter">
                <a href=""><img src="imagens/twitter.png" alt=""></a>
                <p>@fatteclothing</p>
            </div>
            <div class="facebook">
                <a><img src="imagens/facebook.png" alt=""></a>
                <p>Fatte Clothing</p>
            </div>
        </div>       
    </footer>

    <script src="js/script.js"></script>
</body>
</html>