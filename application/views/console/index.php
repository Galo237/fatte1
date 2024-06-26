<?php
// Iniciar a sessão
session_start();

include '../../controllers/connection.php';

if(isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    // Redirecionar para a página inicial
    header("Location: index.php");
    exit;
}

// Operação de leitura (READ)
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

if(isset($_POST['feedback'])) {
    $feedback = $_POST['feedback'];

    $sql = "INSERT INTO feedback (fedFeedback) VALUES ('$feedback')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?success=1");
    
    } else {
        showAlert("Erro ao enviar: " . $conn->error, 'danger');
    }
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatte</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <a href="pages/carrinho.php"><span class="cart-icon"><img src="imagens/cart1.png" alt=""></span></a>
                <?php
                    // Verificar se o usuário está logado
                    if(isset($_SESSION['cliente'])) {
                        $nome_usuario = $_SESSION['nome'];
                        // Exibir o nome do usuário no lugar do ícone de usuário
                        echo "<a href='pages/perfil.php' style='text-decoration: none; color: black;'><span class='user-icon'>$nome_usuario</span></a>";
                        echo "<a href='?logout' class='logout'><img src='imagens/logout.png' alt=''></a>";
                    } else {
                        // Se o usuário não estiver logado, exibir o ícone de usuário padrão
                        echo "<a href='pages/perfil.php'><span class='user-icon'><img src='imagens/user1.png' alt=''></span></a>";
                    }
                ?>
            </div> 
        </div> 
    </header>
    <hr>
    <section class="banner">
    </section>
    <br>

    <a>
        <h3 class="fotos">GALERIA</h3>
    </a>
    <section class="galeria">
        <a class="link"><img src="imagens/galeria1.jpg" alt=""></a>
        <a class="link"><img src="imagens/galeria2.jpg" alt=""></a>
        <a class="link"><img class="galeria3" src="imagens/galeria3.jpg" alt=""></a>
    </section>

    <hr>

    <section class="featured-products">

    </section>

    <h3 class="destaques">DESTAQUES</h3>

    <div class="card">
        <p>
        <a href="pages/masculino.php"><img src="imagens/masculino.jpg" alt="masculino"></a>
        <span>Masculino</span>
        </p>
        <p>
        <a href="pages/feminino.php"><img src="imagens/feminino.jpg" alt="feminino"></a>
        <span>Feminino</span></p>
        <p>
        <a href="pages/sobre.php"><img src="imagens/kits.jpg" alt="kits"></a>
        <span>Sobre</span></p>
    </div>

    <br>
    <br>
    <br>

    <div class="chatbot-popup" id="chatbot">
        <div class="chatbot-header">
            <h5 class="mb-0">Vicatinha Bot</h5>
            <span class="close-btn" id="close-chatbot">&times;</span>
        </div>
        <div id="chat-window" class="chatbot-body"></div>
        <form method="POST">
            <div id="feedback-section" class="chatbot-body" style="display: none;">
                <h5>Feedback de Experiência</h5>
                <textarea name="feedback" id="feedback-text" class="form-control" rows="4" placeholder="Descreva sua experiência com o chat"></textarea>
                <button id="send-feedback" class="btn btn-primary mt-2" name="fedFeedback">Enviar Feedback</button>
                <button id="cancel-feedback" class="btn btn-secondary mt-2">Cancelar</button>
            </div>
        </form>
        <div class="chatbot-footer">
            <input type="text" id="user-input" class="form-control chat-input" placeholder="Digite o número da sua dúvida">
            <button id="send-button" class="btn btn-primary">Enviar</button>
        </div>
    </div>
    <button class="btn btn-primary chatbot-toggle-button" id="open-chatbot" name="submit">Chatbot</button>


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