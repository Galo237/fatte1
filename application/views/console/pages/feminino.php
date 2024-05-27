<?php
// Iniciar a sessão
session_start();

include '../../../controllers/connection.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql = "SELECT * FROM produtos WHERE proGenero = 'F' AND proNome LIKE '%$search%'";
$result = $conn->query($sql);

if(isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    // Redirecionar para a página inicial
    header("Location: ../index.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $proId = $_POST['proId'];
    $proNome = $_POST['proNome'];
    $proPreco = $_POST['proPreco'];
    $proTamanho = $_POST['proTamanho'];

    $cart_item = array(
        'id' => $proId,
        'nome' => $proNome,
        'preco' => $proPreco,
        'tamanho' => $proTamanho
    );

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $_SESSION['cart'][] = $cart_item;
    header("Location: feminino.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/masculino.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Feminino</title>
    <style>
        /* Adicionar estilos para o modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content-custom {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .navbar-custom {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
        }
        .navbar-custom .navbar-nav {
            flex-direction: row;
        }
        .navbar-custom .navbar-nav .nav-item {
            margin-left: 1rem;
        }
        .navbar-custom .form-inline {
            display: flex;
            align-items: center;
        }
        .navbar-custom .form-inline input {
            margin-right: 0.5rem;
        }

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
            background-color: #000000; /* Altera o fundo para preto */
            color: #ffffff;
            padding: 40px;
        }

        .instagram, .twitter, .facebook {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .instagram p, .twitter p, .facebook p {
            margin: 0;
        }

        .mr-2 {
            margin-right: 0.5rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }


    </style>
    <script>
        function openModal(proId, proNome, proPreco, proImagem) {
            document.getElementById('modal').style.display = 'block';
            document.getElementById('modal-proId').value = proId;
            document.getElementById('modal-proNome').innerText = proNome;
            document.getElementById('modal-proPreco').innerText = 'R$ ' + proPreco;
            document.getElementById('modal-proImagem').src = 'data:image/jpeg;base64,' + proImagem;
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
        <a class="navbar-brand" href="../index.php">Fatte</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Destaque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="masculino.php">Masculino</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="feminino.php">Feminino</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="post" action="feminino.php">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Pesquisar produtos">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="carrinho.php"><img src="../imagens/cart1.png" alt="Cart"></a>
                </li>
                <?php
                if(isset($_SESSION['cliente'])) {
                    $nome_usuario = $_SESSION['nome'];
                    echo "<li class='nav-item'><a class='nav-link' href='perfil.php'>$nome_usuario</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='?logout'><img src='../imagens/logout.png' alt='Logout'></a></li>";
                } else {
                    echo "<li class='nav-item'><a class='nav-link' href='perfil.php'><img src='../imagens/user1.png' alt='User'></a></li>";
                }
                ?>
            </ul>
        </div>
    </nav>
    <h3 style="margin-top: 50px; text-align: center">Catálogo Feminino</h3>
    <div class="page-inner-content">
        <div class="product" id="product">
            <?php
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $encoded_image = base64_encode($row['proImagem']);
                    echo "<div class='roupa'>
                            <img src='data:image/jpeg;base64,$encoded_image' alt='{$row['proNome']}' onclick='openModal(\"{$row['proId']}\", \"{$row['proNome']}\", \"{$row['proPreco']}\", \"$encoded_image\")'>
                            <p>{$row['proNome']}</p>
                            <p>R$ {$row['proPreco']}</p>
                        </div>";
                }
            } else {
                echo "<p>Nenhum produto feminino encontrado!</p>";
            }
            ?>
        </div>
    </div>

    <!-- Modal para Detalhes do Produto -->
    <div id="modal" class="modal">
        <div class="modal-content-custom">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modal-proImagem" src="" alt="Image not loading!" style="width: 100%; max-width: 300px;">
            <h2 id="modal-proNome"></h2>
            <p id="modal-proPreco"></p>
            <form method="post" action="masculino.php">
                <input type="hidden" name="proId" id="modal-proId">
                <input type="hidden" name="proNome" id="modal-proNome-hidden">
                <input type="hidden" name="proPreco" id="modal-proPreco-hidden">
                <label for="proTamanho">Tamanho:</label>
                <select name="proTamanho" id="proTamanho" required>
                    <option value="P">P</option>
                    <option value="M">M</option>
                    <option value="G">G</option>
                    <option value="GG">GG</option>
                </select>
                <button type="submit" name="add_to_cart">Adicionar ao Carrinho</button>
            </form>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <footer class="bg-black text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>CONTATO</h3>
                    <p><b>Email: </b>fattecommerce@gmail.com</p>
                    <p><b>Telefone: </b>+55 41 99842-8507</p>
                    <br>
                    <p>Segunda à sexta: 09:00 às 18:00</p>
                    <p>Sábado: 09:00 às 15:00</p>
                    <p>Exceto Feriados</p>
                </div>
                <div class="col-md-6">
                    <h3>REDES SOCIAIS</h3>
                    <div class="d-flex mb-2">
                        <a href="https://www.instagram.com/fatteclothing?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
                            <img src="../imagens/instagram.png" alt="Instagram" class="mr-2">
                        </a>
                        <p>@fatteclothing</p>
                    </div>
                    <div class="d-flex mb-2">
                        <a href="#">
                            <img src="../imagens/twitter.png" alt="Twitter" class="mr-2">
                        </a>
                        <p>@fatteclothing</p>
                    </div>
                    <div class="d-flex">
                        <a href="#">
                            <img src="../imagens/facebook.png" alt="Facebook" class="mr-2">
                        </a>
                        <p>Fatte Clothing</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>