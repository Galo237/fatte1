<?php
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    include '../../../controllers/connection.php';

    // Coletar os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar se o usuário com o email fornecido existe no banco de dados
    $sql = "SELECT * FROM cliente WHERE cliEmail = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Recuperar a senha criptografada do banco de dados
        $row = $result->fetch_assoc();
        $senha_hash = $row['cliSenha']; 

        // Verificar se a senha fornecida corresponde à senha criptografada no banco de dados
        if (password_verify($senha, $senha_hash)) {
            // Iniciar a sessão e armazenar o nome do usuário
            $_SESSION['usuario'] = $row['cliNome'];
            $_SESSION['telefone'] = $row['cliTelefone'];
            $_SESSION['email'] = $row['cliEmail'];
            $_SESSION['gender'] = $row['cliGenero'];

            // Redirecionar para o index.php após o login bem-sucedido
            header("Location: ../index.php");
            exit;
        } else {
            // Redirecionar de volta para o login se as credenciais estiverem incorretas
            header("Location: login.php?erro=1");
            exit;
        }
    } else {
        // Redirecionar de volta para o login se o email não for encontrado
        header("Location: login.php?erro=1");
        exit;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Fatte - Login</title>
</head>
<body>
    <section class="area-login">
        <div class="login">
            <div>
                <h1>Fatte</h1>
            </div>

            <form class="form" action="#" method="POST">
                <input class="email" type="email" name="email" placeholder="Email de usuário" autofocus>
                <input class="senha" type="password" name="senha" placeholder="Senha">
                <input type="submit" name="submit" value="Entrar">
            </form>
            <p>Ainda não possui uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            <p>Login como <a href="../../../controllers/loginadm.php">Administrador</a>
        </div>
    </section>
</body>
</html>