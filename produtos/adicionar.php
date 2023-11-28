<!DOCTYPE html>
<html lang="pt-BR">
<?php
include '../layout/header.php';
?>

<head>
    <link rel="stylesheet" href="../css/produtos.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <h1>Cadastro de Produtos</h1>
</head>

</html>

<form method="post" action="adicionar.php">
    Nome: <input type="text" name="nome"><br>
    Unidade de Venda: <input type="text" name="unidade_venda"><br>
    Preço unitário: <input type="text" name="preco_unitario"><br>
    <input type="submit" value="Adicionar">
</form>

<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $unidade_venda = $_POST['unidade_venda'];
    $preco_unitario = $_POST['preco_unitario'];

    $sql =
        "INSERT INTO
        Produtos (nome, unidade_venda, preco_unitario)
    VALUES
        ('$nome', '$unidade_venda', '$preco_unitario')
    ";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro: " . $conexao->error;
    }
}

$conexao->close();
?>