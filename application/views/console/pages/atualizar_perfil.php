<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Se o usuário não estiver logado, redirecionar para a página de login
    header("Location: login.php");
    exit;
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar os novos dados do formulário
    $novo_nome = $_POST['novo_nome'];
    $novo_telefone = $_POST['novo_telefone'];
    $novo_email = $_POST['novo_email'];
    $novo_genero = $_POST['novo_genero'];

    // Atualizar as variáveis de sessão com os novos dados
    $_SESSION['usuario'] = $novo_nome;
    $_SESSION['email'] = $novo_email;
    $_SESSION['telefone'] = $novo_telefone;
    $_SESSION['gender'] = $novo_genero;

    // Redirecionar para a página de perfil após a atualização
    header("Location: perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Perfil</title>
    <link rel="stylesheet" href="../css/atualizar_perfil.css">
</head>
<body>
    <header>
        <!-- Cabeçalho da página -->
        <h1>Atualizar Perfil</h1>
    </header>

    <div class="container">
        <div class="form">
            <form action="atualizar_perfil.php" method="POST">
                <div class="input-group">
                    <div class="input-box">
                        <label for="novo_nome">Novo Nome</label>
                        <input id="novo_nome" type="text" name="novo_nome" placeholder="Digite seu novo nome" required>
                    </div>

                    <div class="input-box">
                        <label for="novo_telefone">Novo Telefone</label>
                        <input id="novo_telefone" type="text" name="novo_telefone" placeholder="Digite seu novo telefone" required>
                    </div>

                    <div class="input-box">
                        <label for="novo_email">Novo E-mail</label>
                        <input id="novo_email" type="email" name="novo_email" placeholder="Digite seu novo e-mail" required>
                    </div>

                    <div class="input-box">
                        <label for="novo_genero">Novo Gênero</label>
                        <select id="novo_genero" name="novo_genero" required>
                            <option value="F">Feminino</option>
                            <option value="M">Masculino</option>
                            <option value="O">Outros</option>
                            <option value="N">Prefiro não dizer</option>
                        </select>
                    </div>
                </div>

                <div class="submit-button">
                    <button type="submit">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>