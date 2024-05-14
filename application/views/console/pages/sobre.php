<?php
session_start();

include '../../../controllers/connection.php';

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
    <title>Fatte</title>
    <link rel="stylesheet" href="../css/sobre.css">
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
                <span class="search-icon"><img src="../imagens/search.png" alt=""></span>
                <span class="cart-icon"><img src="../imagens/cart.png" alt=""></span>
                <?php
                    // Verificar se o usuário está logado
                    if(isset($_SESSION['cliente'])) {
                        $nome_usuario = $_SESSION['nome'];
                        // Exibir o nome do usuário no lugar do ícone de usuário
                        echo "<a href='pages/perfil.php' style='text-decoration: none; color: black;'><span class='user-icon'>$nome_usuario</span></a>";
                        echo "<a href='?logout' class='logout'><img src='../imagens/logout.png' alt=''></a>";
                    } else {
                        // Se o usuário não estiver logado, exibir o ícone de usuário padrão
                        echo "<a href='pages/perfil.php'><span class='user-icon'><img src='imagens/user1.png' alt=''></span></a>";
                    }
                ?>
            </div> 
        </div> 
</header>

    <div class="sobre">
        <span class="imgsobre"><img src="../imagens/sobre.jpg" alt=""></span>
        <br>
        <hr>
        <h1>Sobre nós</h1>
        <p>No coração de uma cidade agitada, onde os sons das ruas se misturam com a energia pulsante da vida urbana, nasceu uma ideia que iria mudar o mundo da moda para sempre. Em um pequeno estúdio, um grupo de visionários se reuniu com um propósito: criar uma marca que não apenas vestisse corpos, mas também contasse histórias. Assim nasceu "Fatte".

O nome "Fatte" é uma homenagem à ousadia e à coragem. Derivado da palavra italiana "Fatto", que significa "feito", a marca se compromete a criar peças que são mais do que simples roupas; são manifestações de estilo, individualidade e autoexpressão. <br><br>

Desde o seu início modesto, a missão da "Fatte" tem sido clara: desafiar o convencional, abraçar a diversidade e celebrar a autenticidade. Cada coleção é cuidadosamente projetada para capturar a essência da vida moderna, combinando estilos clássicos com uma abordagem contemporânea.

Na "Fatte", acreditamos que a moda vai além das tendências passageiras; é uma forma de arte que transcende o tempo. Por isso, nossas peças são criadas com atenção meticulosa aos detalhes, utilizando materiais de alta qualidade e técnicas de fabricação inovadoras. <br><br>

Mas nossa dedicação vai além de simplesmente criar roupas. A "Fatte" está comprometida com a sustentabilidade e a responsabilidade social. Buscamos constantemente maneiras de minimizar nosso impacto no meio ambiente, desde a escolha de materiais eco-friendly até a implementação de práticas éticas em toda a cadeia de produção. <br><br>

À medida que continuamos a crescer e evoluir, mantemos firmemente nossos valores fundamentais. Na "Fatte", acreditamos que todos têm o direito de se expressar livremente, sem medo de julgamento ou restrição. Somos uma comunidade diversificada de indivíduos apaixonados, unidos pela nossa paixão pela moda e pelo desejo de fazer a diferença no mundo.

Junte-se a nós em nossa jornada enquanto continuamos a redefinir os limites da moda e inspirar uma nova geração de criatividade e autoexpressão. Esta é a história da "Fatte" - uma marca que não apenas veste corpos, mas também alimenta almas. Seja ousado. Seja autêntico. Seja "Fatte".</p>


    
    </div>

    <br>
    <br>



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
            <a class="instagram"></a><img src="imagens/instagram.png" alt=""><p>@fatteclothing</p>
            <a class="twitter"><img src="imagens/twitter.png" alt=""></a><p>@fatteclothing</p>
            <a class="facebook"><img src="imagens/facebook.png" alt=""></a><p>Fatte Clothing</p>
        </div>
</footer>

<script src="../js/script.js"></script>
</body>
</html>