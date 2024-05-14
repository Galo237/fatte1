<?php
session_start();

// Incluir o arquivo de conexão com o banco de dados
include '../../../../../controllers/connection.php';

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

    // Upload de imagem
    if($_FILES['proImagem']['name'] != "") {
        $uploadDir = "uploads/";
        $uploadFile = $uploadDir . basename($_FILES['proImagem']['name']);
        if (move_uploaded_file($_FILES['proImagem']['tmp_name'], $uploadFile)) {
            $imagem = $uploadFile;
        } else {
            showAlert("Erro ao fazer upload da imagem", 'danger');
        }
    } else {
        $imagem = $produto['proImagem'];
    }

    $sql = "UPDATE produtos SET proNome='$nome', proGenero='$genero', proPreco='$preco', proDescricao='$descricao', proTipo='$tipo', proTamanho='$tamanho', proImagem='$imagem' WHERE proId=$id";
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
    <form method="POST" enctype="multipart/form-data" class="mt-4">
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
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagem" name="proImagem" onchange="previewImage()">
                <label class="custom-file-label" for="imagem">Escolher arquivo de imagem a ser adicionado!</label>
            </div>
            <img id="preview" src="#" alt="Pré-visualização da Imagem" style="display: none; max-width: 100%; max-height: 200px;">
        </div>
        <button type="submit" class="btn btn-primary" name="update">Atualizar Produto</button>
        <a href="listagem.php" class="btn btn-primary" name="back">Voltar</a>
    </form>
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