<?php
session_start();

// Incluir o arquivo de conexão com o banco de dados
include 'connection.php';

// Verificar se o usuário está logado
// verificarLogin();

// Função para exibir uma mensagem de alerta
function showAlert($message, $type = 'info') {
    echo "<div class='alert alert-$type' role='alert'>$message</div>";
}

// Recuperar o ID do produto a ser editado
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consultar o produto no banco de dados
    $sql = "SELECT * FROM produtos WHERE proId=$id";
    $result = $conn->query($sql);
    
    if ($result) {
        if ($result->num_rows == 1) {
            $produto = $result->fetch_assoc();
        } else {
            showAlert("Produto não encontrado", 'danger');
        }
    } else {
        showAlert("Erro na consulta SQL: " . $conn->error, 'danger');
    }
} else {
    showAlert("ID do produto não fornecido na URL", 'danger');
}

// Operação de atualização (UPDATE)
if(isset($_POST['update'])) {
    $id = $_POST['proId'];
    $nome = $_POST['proNome'];
    $genero = $_POST['proGenero'];
    $preco = $_POST['proPreco'];
    $descricao = $_POST['proDescricao'];
    $tipo = $_POST['proTipo'];
    $tamanho = $_POST['proTamanho'];
    
    $sql = "UPDATE produtos SET proNome='$nome', proGenero='$genero', proPreco='$preco', proDescricao='$descricao', proTipo='$tipo', proTamanho='$tamanho' WHERE proId=$id";
    if ($conn->query($sql) === TRUE) {
        showAlert("Produto atualizado com sucesso", 'success');
    } else {
        showAlert("Erro ao atualizar produto: " . $conn->error, 'danger');
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Produto</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Produto</h2>
    <form method="POST" class="mt-4">
        <input type="hidden" name="proId" value="<?php echo $produto['proId']; ?>">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="proNome" value="<?php echo $produto['proNome']; ?>" required>
        </div>
    
        <div class="form-group">
            <label for="genero">Gênero:</label>
            <input type="text" class="form-control" id="genero" name="proGenero" value="<?php echo $produto['proGenero']; ?>" required>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" class="form-control" id="preco" name="proPreco" value="<?php echo $produto['proPreco']; ?>" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="proDescricao" required><?php echo $produto['proDescricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <input type="text" class="form-control" id="tipo" name="proTipo" value="<?php echo $produto['proTipo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="tamanho">Tamanho:</label>
            <input type="text" class="form-control" id="tamanho" name="proTamanho" value="<?php echo $produto['proTamanho']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Atualizar Produto</button>
        <a href="listagem.php" class="btn btn-primary" name="back">Voltar</a>
    </form>
</div>

</body>
</html>