<?php
session_start();
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    include '../../../controllers/connection.php';
    // Coletar os dados do formulário
    $nome = $_POST['firstname'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $genero = $_POST['gender'];
    // Definir as variáveis de sessão
    $_SESSION['usuario'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['telefone'] = $telefone;
    $_SESSION['gender'] = $genero;
    // Consulta SQL para inserir o novo usuário na tabela cliente
    $sql = "INSERT INTO cliente (cliNome, cliTelefone, cliEmail, cliSenha, cliGenero) VALUES ('$nome', '$telefone', '$email', '$senha', '$genero')";
    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página de login após o cadastro bem-sucedido
        header("Location: login.php");
        exit;
    } else {
        echo "Erro ao cadastrar o usuário: " . $conn->error;
    }
    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <title>Fatte - Cadastre-se</title>
</head>
<body>
    <div class="container">
        <div class="form-image">
            <img src="../imagens/banner2.png" alt="">
        </div>
        <div class="form">
            <form id="formulario" action="cadastro.php" method="POST">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastre-se</h1>
                    </div>
                    <div class="login-button">
                        <button><a href="login.php">Entrar</a></button>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <label for="firstname">Nome</label>
                        <input id="firstname" type="text" name="firstname" placeholder="Digite seu primeiro nome" required>
                    </div>
                    <div class="input-box">
                        <label for="lastname">Telefone</label>
                        <input id="lastname" type="text" name="telefone" placeholder="Digite seu telefone" required>
                    </div>
                    <div class="input-box">
                        <label for="email">E-mail</label>
                        <input class="inputs required" id="email" type="email" name="email" placeholder="Digite seu e-mail" oninput="emailValidate()" required>
                        <span style="display: none; font-size: 12px; color: red;" class="span-required">Digite um email válido</span>
                    </div>

                    <div class="input-box">
                        <label for="confirmEmail">Confirme seu email</label>
                        <input class="inputs required" id="confirmEmail" type="email" name="confirmEmail" placeholder="Confirme seu email" oninput="confirmEmailValidate()" required>
                        <span style="display: none; font-size: 12px; color: red;" class="span-required">Emails devem ser compatíveis</span>
                    </div>

                    <div class="input-box">
                        <label for="password">Senha</label>
                        <input class="inputs required" id="password" type="password" name="password" placeholder="Digite sua senha" oninput="mainPasswordValidate()" required>
                        <span style="display: none; font-size: 12px; color: red;" class="span-required">Sua senha deve conter no mínimo 8 caracteres, uma letra maiúscula, uma minúscula, um número e um caracter especial</span>
                    </div>


                    <div class="input-box">
                        <label for="confirmPassword">Confirme sua Senha</label>
                        <input class="inputs required" id="confirmPassword" type="password" name="confirmPassword" placeholder="Digite sua senha novamente" oninput="confirmPasswordValidate()" required>
                        <span style="display: none; font-size: 12px; color: red;" class="span-required">Senhas devem ser compatíveis</span>
                    </div>

                </div>
                <div class="gender-inputs">
                    <div class="gender-title">
                        <h6>Gênero</h6>
                    </div>
                    <div class="gender-group">
                        <div class="gender-input">
                            <input id="female" type="radio" name="gender" value="F">
                            <label for="female">Feminino</label>
                        </div>
                        <div class="gender-input">
                            <input id="male" type="radio" name="gender" value="M">
                            <label for="male">Masculino</label>
                        </div>
                        <div class="gender-input">
                            <input id="others" type="radio" name="gender" value="O">
                            <label for="others">Outros</label>
                        </div>
                        <div class="gender-input">
                            <input id="none" type="radio" name="gender" value="N">
                            <label for="none">Prefiro não dizer</label>
                        </div>
                    </div>
                </div>
                <div class="continue-button">
                    <button id="continue-button" name="submit"><a href="#">Continuar</a></button>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/cadastro.js"></script>
</body>
</html>