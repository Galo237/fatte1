<?php
session_start();

if(isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    // Redirecionar para a página inicial
    header("Location: ../../../index.php");
    exit;
}

// Incluir o arquivo de conexão com o banco de dados
include '../../../../../controllers/connection.php';

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
    
    // Upload de imagem
    $imagem = "";
    if(isset($_FILES['proImagem']) && $_FILES['proImagem']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";
        $uploadFile = $uploadDir . basename($_FILES['proImagem']['name']);
        if (move_uploaded_file($_FILES['proImagem']['tmp_name'], $uploadFile)) {
            $imagem = $uploadFile;
        } else {
            showAlert("Erro ao fazer upload da imagem", 'danger');
        }
    }
    
    $sql = "INSERT INTO produtos (proNome, proGenero, proDescricao, proPreco, proTipo, proTamanho, proImagem) VALUES ('$nome', '$genero', '$descricao', '$preco', '$tipo', '$tamanho', '$imagem')";
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
<title>Cadastro de Produtos</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-end mb-3">
        <a href="?logout" class="btn btn-danger">Logout</a>
    </div>
    <h2>Cadastro de Produtos</h2>
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
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagem" name="proImagem" onchange="previewImage()">
                <label class="custom-file-label" for="imagem">Escolher arquivo de imagem a ser adicionado!</label>
            </div>
            <img id="preview" src="#" alt="Pré-visualização da Imagem" style="display: none; max-width: 100%; max-height: 200px;">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Adicionar Produto</button>
    </form>

    <h3 class="mt-5">Lista de Produtos</h3>
    <table class="table mt-3">
    <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th>
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
                            <td><img src='{$row['proImagem']}' alt='Imagem do Produto' style='max-width: 100px; max-height: 100px;'></td>
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
                echo "<tr><td colspan='9'>Nenhum produto encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<script>
function previewImage() {
    var preview = document.getElementById('preview');
    var fileInput = document.getElementById('imagem').files[0];
    var reader = new FileReader();

    reader.onload = function() {
        preview.src = reader.result;
        preview.style.display = 'block';
    }

    if (fileInput) {
        reader.readAsDataURL(fileInput);
    }
}


</script>