<?php
session_start();
// Verificar se o usuário está logado
if (!isset($_SESSION['cliente'])) {
    // Se o usuário não estiver logado, redirecionar para a página de login
    header("Location: login.php");
    exit;
}
// Incluir o arquivo de conexão com o banco de dados
include '../../../controllers/connection.php';
// Recuperar o ID do cliente atualmente logado
$idCliente = $_SESSION['cliente'];
// Consultar o cliente no banco de dados
$sql = "SELECT * FROM cliente WHERE cliId = $idCliente";
$result = $conn->query($sql);
// Verificar se a consulta foi bem-sucedida e se retornou algum resultado
if ($result && $result->num_rows == 1) {
    $cliente = $result->fetch_assoc();
} else {
    // Se não houver resultados, exibir uma mensagem de erro e redirecionar
    echo "Erro ao carregar dados do cliente.";
    exit;
}

// Verificar se o formulário foi enviado
if(isset($_POST['submit'])) {
    // Recuperar os dados do formulário
    $nome = $_POST['novo_nome'];
    $genero = $_POST['novo_genero'];
    $email = $_POST['novo_email'];
    $telefone = $_POST['novo_telefone'];
    $senha = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT);

    // Atualizar os dados do cliente no banco de dados
    $sql = "UPDATE cliente SET cliNome='$nome', cliGenero='$genero', cliEmail='$email', cliTelefone='$telefone', cliSenha='$senha' WHERE cliId=$idCliente";
    if ($conn->query($sql) === TRUE) {
        // Atualizar as variáveis de sessão com os novos dados do cliente
        $_SESSION['nome'] = $nome;
        $_SESSION['gender'] = $genero;
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $telefone;

        // Se a atualização for bem-sucedida, redirecionar para a página de perfil
        header("Location: perfil.php");
        exit;
    } else {
        // Se ocorrer um erro durante a atualização, exibir uma mensagem de erro
        echo "Erro ao atualizar perfil!";
        exit;
    }
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
                <input type="hidden" name="cliId" value="<?php echo $idCliente; ?>">
                <div class="input-group">
                    <div class="input-box">
                        <label for="novo_nome">Novo Nome</label>
                        <input id="novo_nome" type="text" name="novo_nome" placeholder="Digite seu novo nome" value="<?php echo $cliente['cliNome']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="novo_telefone">Novo Telefone</label>
                        <input id="novo_telefone" type="text" name="novo_telefone" placeholder="Digite seu novo telefone" value="<?php echo $cliente['cliTelefone']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="novo_email">Novo E-mail</label>
                        <input id="novo_email" type="email" name="novo_email" placeholder="Digite seu novo e-mail" value="<?php echo $cliente['cliEmail']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="nova_senha">Nova Senha</label>
                        <input id="nova_senha" type="password" name="nova_senha" placeholder="Digite sua nova senha">
                    </div>
                    <div class="input-box">
                        <label for="novo_genero">Novo Gênero</label>
                        <select id="novo_genero" name="novo_genero" required>
                            <option value="F" <?php if($cliente['cliGenero'] == 'F') echo 'selected'; ?>>Feminino</option>
                            <option value="M" <?php if($cliente['cliGenero'] == 'M') echo 'selected'; ?>>Masculino</option>
                            <option value="O" <?php if($cliente['cliGenero'] == 'O') echo 'selected'; ?>>Outros</option>
                            <option value="N" <?php if($cliente['cliGenero'] == 'N') echo 'selected'; ?>>Prefiro não dizer</option>
                        </select>
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit" name="submit">Atualizar</button>
                    <a href="perfil.php" class="voltar">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>