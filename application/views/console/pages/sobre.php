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
    <title>Sobre</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sobre.css">
</head>
<body>
<header>
    <div class="header container-fluid d-flex justify-content-between align-items-center py-3">
        <div class="logo"><a href="../index.php">Fatte</a></div>
        <nav class="d-none d-md-block">
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" style="color: black; font-weight: bold;" href="#">Destaque</a></li>
                <li class="nav-item"><a class="nav-link" style="color: black; font-weight: bold;" href="masculino.php">Masculino</a></li>
                <li class="nav-item"><a class="nav-link" style="color: black; font-weight: bold;" href="feminino.php">Feminino</a></li>
                <li class="nav-item"><a class="nav-link" style="color: black; font-weight: bold;" href="sobre.php">Sobre</a></li>
            </ul>
        </nav>
        <button class="btn btn-link d-md-none" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
            <span id="hamburger"></span> Menu
        </button>
        <div class="icons d-flex align-items-center">
            <span class="search-icon"><img src="../imagens/search1.png" alt=""></span>
            <a href="carrinho.php"><span class="cart-icon ml-3"><img src="../imagens/cart1.png" alt=""></span></a>
            <?php
            if(isset($_SESSION['cliente'])) {
                $nome_usuario = $_SESSION['nome'];
                echo "<a href='perfil.php' class='ml-3' style='text-decoration: none; color: black;'><span class='user-icon'>$nome_usuario</span></a>";
                echo "<a href='?logout' class='ml-3'><img src='../imagens/logout.png' alt=''></a>";
            } else {
                echo "<a href='pages/perfil.php' class='ml-3'><span class='user-icon'><img src='../imagens/user1.png' alt=''></span></a>";
            }
            ?>
        </div>
    </div>
    <nav id="nav" class="d-md-none">
        <ul id="menu" class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="#">Destaque</a></li>
            <li class="nav-item"><a class="nav-link" href="masculino.php">Masculino</a></li>
            <li class="nav-item"><a class="nav-link" href="feminino.php">Feminino</a></li>
            <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre</a></li>
        </ul>
    </nav>
</header>

<div class="sobre container my-5">
    <div class="text-center mb-5">
        <img class="img-fluid" src="../imagens/sobre.jpg" alt="">
    </div>
    <hr>
    <h1 class="text-center">Sobre nós</h1>
    <p>No coração de uma cidade agitada, onde os sons das ruas se misturam com a energia pulsante da vida urbana, nasceu uma ideia que iria mudar o mundo da moda para sempre. Em um pequeno estúdio, um grupo de visionários se reuniu com um propósito: criar uma marca que não apenas vestisse corpos, mas também contasse histórias. Assim nasceu "Fatte".

O nome "Fatte" é uma homenagem à ousadia e à coragem. Derivado da palavra italiana "Fatto", que significa "feito", a marca se compromete a criar peças que são mais do que simples roupas; são manifestações de estilo, individualidade e autoexpressão. <br><br>

Desde o seu início modesto, a missão da "Fatte" tem sido clara: desafiar o convencional, abraçar a diversidade e celebrar a autenticidade. Cada coleção é cuidadosamente projetada para capturar a essência da vida moderna, combinando estilos clássicos com uma abordagem contemporânea.

Na "Fatte", acreditamos que a moda vai além das tendências passageiras; é uma forma de arte que transcende o tempo. Por isso, nossas peças são criadas com atenção meticulosa aos detalhes, utilizando materiais de alta qualidade e técnicas de fabricação inovadoras. <br><br>

Mas nossa dedicação vai além de simplesmente criar roupas. A "Fatte" está comprometida com a sustentabilidade e a responsabilidade social. Buscamos constantemente maneiras de minimizar nosso impacto no meio ambiente, desde a escolha de materiais eco-friendly até a implementação de práticas éticas em toda a cadeia de produção. <br><br>

À medida que continuamos a crescer e evoluir, mantemos firmemente nossos valores fundamentais. Na "Fatte", acreditamos que todos têm o direito de se expressar livremente, sem medo de julgamento ou restrição. Somos uma comunidade diversificada de indivíduos apaixonados, unidos pela nossa paixão pela moda e pelo desejo de fazer a diferença no mundo.

Junte-se a nós em nossa jornada enquanto continuamos a redefinir os limites da moda e inspirar uma nova geração de criatividade e autoexpressão. Esta é a história da "Fatte" - uma marca que não apenas veste corpos, mas também alimenta almas. Seja ousado. Seja autêntico. Seja "Fatte".</p>
</div>

<footer class="footer bg-darker text-white py-4">
    <div class="container d-flex justify-content-between">
        <div>
            <h3>CONTATO</h3>
            <p><b>Email: </b>fattecommerce@gmail.com</p>
            <p><b>Telefone: </b>+55 41 99842-8507</p>
            <p>Segunda à sexta: 09:00 às 18:00</p>
            <p>Sábado: 09:00 às 15:00</p>
            <p>Exceto Feriados</p>
        </div>
        <div>
            <h3>REDES SOCIAIS</h3>
            <a class="d-block" style="text-decoration: none; color: white;" href="#"><img src="../imagens/instagram.png" alt=""> @fatteclothing</a>
            <a class="d-block" style="text-decoration: none; color: white;" href="#"><img src="../imagens/twitter.png" alt=""> @fatteclothing</a>
            <a class="d-block" style="text-decoration: none; color: white;" href="#"><img src="../imagens/facebook.png" alt=""> Fatte Clothing</a>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>