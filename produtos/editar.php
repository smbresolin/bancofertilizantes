<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $unidade_venda = $_POST['unidade_venda'];
    $preco_unitario = $_POST['preco_unitario'];

    $sql = $sql = "UPDATE produtos SET nome ='$nome', unidade_venda ='$unidade_venda',
         preco_unitario ='$preco_unitario' WHERE id =$id";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, nome, unidade_venda, preco_unitario FROM produtos WHERE id = $id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $produtos = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado!";
        exit;
    }
}

$conexao->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<?php
include '../layout/header.php';
?>

<head>
    <link rel="stylesheet" href="../css/produtos.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <h1>Editar Cadastro do Produto</h1>
</head>

</html>

<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $produtos['id']; ?>">
    Nome: <input type="text" name="nome" value="<?php echo $produtos['nome']; ?>"><br>
    Unidade de Venda: <input type="text" name="unidade_venda" value="<?php echo $produtos['unidade_venda']; ?>"><br>
    Preço unitário: <input type="text" name="preco_unitario" value="<?php echo $produtos['preco_unitario']; ?>"><br>
    <input type="submit" value="Salvar">
</form>