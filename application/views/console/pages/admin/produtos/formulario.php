<?php
session_start();

// Incluir o arquivo de conexão com o banco de dados
include '../../../../../controllers/connection.php';

// Função para exibir uma mensagem de alerta
function showAlert($message, $type = 'info') {
    echo "<div class='alert alert-$type' role='alert'>$message</div>";
}

function uploadImage($caminho){
    if(!empty($_FILES['imagem']['name'])) {

        $nomeArquivo = $_FILES['imagem']['name'];
        $tipo = $_FILES['imagem']['type'];
        $nomeTemporario = $_FILES['imagem']['tmp_name'];
        $tamanho = $_FILES['imagem']['size'];
        $erros = array();

        $tamanhoMaximo = 1024 * 1024 * 5;
        if($tamanho > $tamanhoMaximo) {
            $erros[] = "Seu arquivo excede o tamanho máximo!<br>";
        }

        $arquivosPermitidos = ["png", "jpg", "jpeg"];
        $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
        if(!in_array($extensao, $arquivosPermitidos)) {
            $erros[] = "Arquivo não permitido!<br>";
        }

        $typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];
        if(!in_array($tipo, $typesPermitidos)) {
            $erros[] = "Tipo de arquivo não permitido!<br>";              
        }

        if(!empty($erros)) {
            foreach($erros as $erro) {
                echo $erro;
            }
            return false;
        } else {
            $hoje = date("d-m-Y_h-i");
            $novoNome = $hoje."-".$nomeArquivo;
            if(move_uploaded_file($nomeTemporario, $caminho.$novoNome)) {
                return $novoNome;
            } else {
                return false;
            }
        }

    }
    return false;
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

    // Upload de imagem
    $imagem = "";
    if(!empty($_FILES['imagem']['name'])) {
        $caminho = "imagens/uploads/";

        // Excluir a imagem antiga
        if(!empty($produto['proImagem'])) {
            $imagemAntiga = $caminho . $produto['proImagem'];
            if (file_exists($imagemAntiga)) {
                unlink($imagemAntiga);
            }
        }

        $imagem = uploadImage($caminho);
    } else {
        // Mantém a imagem existente se nenhuma nova imagem for enviada
        $imagem = $produto['proImagem'];
    }

    $sql = "UPDATE produtos SET proNome='$nome', proGenero='$genero', proPreco='$preco', proDescricao='$descricao', proTipo='$tipo', proImagem='$imagem' WHERE proId=$id";
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
<style>
    .image-preview-container {
        position: relative;
        max-width: 200px;
        max-height: 200px;
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 10px;
    }
    .image-preview {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: none;
    }
</style>
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
            <select class="form-control" id="genero" name="proGenero" required>
                <option value="">Selecione</option>
                <option value="F" <?php echo ($produto['proGenero'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
                <option value="M" <?php echo ($produto['proGenero'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="text" class="form-control" id="preco" name="proPreco" value="<?php echo number_format($produto['proPreco'], 2, ',', '.'); ?>" required>
            <small class="form-text text-muted">Digite o preço no formato 0,00</small>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="proDescricao" required><?php echo $produto['proDescricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select class="form-control" id="tipo" name="proTipo" required>
                <option value="">Selecione</option>
                <option value="moletom" <?php echo ($produto['proTipo'] == 'moletom') ? 'selected' : ''; ?>>Moletom</option>
                <option value="camisa" <?php echo ($produto['proTipo'] == 'camisa') ? 'selected' : ''; ?>>Camisa</option>
                <option value="calca" <?php echo ($produto['proTipo'] == 'calca') ? 'selected' : ''; ?>>Calça</option>
                <option value="bermuda" <?php echo ($produto['proTipo'] == 'bermuda') ? 'selected' : ''; ?>>Bermuda</option>
            </select>
        </div>
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagem" name="imagem" onchange="previewImage()">
                <label class="custom-file-label" for="imagem">Escolher arquivo de imagem a ser adicionado!</label>
            </div>
            <div class="image-preview-container">
                <?php if (!empty($produto['proImagem'])): ?>
                    <img id="preview" src="imagens/uploads/<?php echo $produto['proImagem']; ?>" alt="Pré-visualização da Imagem" class="image-preview" style="display: block;">
                <?php else: ?>
                    <img id="preview" src="#" alt="Pré-visualização da Imagem" class="image-preview" style="display: none;">
                <?php endif; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Atualizar Produto</button>
        <a href="listagem.php" class="btn btn-secondary" name="back">Voltar</a>
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