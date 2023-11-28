<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $data_venda = $_POST['data_venda'];
    $cliente = $_POST['cliente'];
    $vendedor = $_POST['vendedor'];
    $produto = $_POST['produto'];
    $pagamento = $_POST['pagamento'];

    $sql_vendas = "UPDATE vendas SET data_venda='$data_venda', cliente='$cliente', vendedor='$vendedor',
    produto='$produto', pagamento='$pagamento' WHERE id='$id'";
    if ($conexao->query($sql_vendas) == TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql_vendas = "SELECT id, data_venda, cliente, vendedor, produto, pagamento FROM vendas WHERE id=$id";
    $result = $conexao->query($sql_vendas);
    if ($result->num_rows > 0) {
        $vendas = $result->fetch_assoc();
    } else {
        echo "Venda não encontrada!";
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
    <link rel="stylesheet" href="../css/vendas.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <h1>Editar Venda</h1>
</head>

</html>


<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $vendas['id']; ?>">
    Data da Venda: <input type="text" name="data_venda" value="<?php echo $vendas['data_venda']; ?>"><br>
    Cliente: <input type="text" name="cliente" value="<?php echo $vendas['cliente']; ?>"><br>
    Vendedor: <textarea name="vendedor"><?php echo $vendas['vendedor']; ?></textarea><br>
    Produto: <input type="text" name="produto" value="<?php echo $vendas['produto']; ?>"><br>
    Pagamento: <input type="text" name="pagamento" value="<?php echo $vendas['pagamento']; ?>"><br>
    <input type="submit" value="Salvar">
</form>