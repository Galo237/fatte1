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

// Operação de leitura (READ)
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

// Operação de criação (CREATE)
if(isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $tipo = $_POST['tipo'];
    $tamanho = $_POST['tamanho'];
    
    $sql = "INSERT INTO produtos (proNome, proGenero, proDescricao, proPreco, proTipo, proTamanho) VALUES ('$nome', '$genero', '$descricao', '$preco', '$tipo', '$tamanho')";
    if ($conn->query($sql) === TRUE) {
        header("Location: listagem.php?success=1");
    
    } else {
        showAlert("Erro ao adicionar produto: " . $conn->error, 'danger');
    }
}

// Exibir mensagem de sucesso, se presente na URL
if (isset($_GET['success']) && $_GET['success'] == 1) {
    showAlert("Produto adicionado com sucesso", 'success');
}


// Operação de exclusão (DELETE)
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM produtos WHERE proId=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: listagem.php?success=2");
        showAlert("Produto excluído com sucesso", 'success');
    } else {
        showAlert("Erro ao excluir produto: " . $conn->error, 'danger');
    }
}

if (isset($_GET['success']) && $_GET['success'] == 2) {
    showAlert("Produto excluído com sucesso", 'success');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRUD de Produtos</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>CRUD de Produtos</h2>
    <form method="POST" class="mt-4">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="genero">Gênero:</label>
            <input type="text" class="form-control" id="genero" name="genero" required>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" class="form-control" id="preco" name="preco" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" required></textarea>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required>
        </div>
        <div class="form-group">
            <label for="tamanho">Tamanho:</label>
            <input type="text" class="form-control" id="tamanho" name="tamanho" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Adicionar Produto</button>
    </form>

    <h3 class="mt-5">Lista de Produtos</h3>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Gênero</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Tamanho</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['proId']}</td>
                            <td>{$row['proNome']}</td>
                            <td>{$row['proGenero']}</td>
                            <td>{$row['proPreco']}</td>
                            <td>{$row['proDescricao']}</td>
                            <td>{$row['proTipo']}</td>
                            <td>{$row['proTamanho']}</td>
                            <td>
                                <a href='formulario.php?id={$row['proId']}' class='btn btn-sm btn-primary'>Editar</a>
                                <a href='?delete={$row['proId']}' class='btn btn-sm btn-danger'>Excluir</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhum produto encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>