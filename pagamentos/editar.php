<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $condicao = $_POST['condicao'];

    $sql = "UPDATE pagamentos SET tipo = '$tipo', condicao = '$condicao' WHERE id = $id";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, tipo, condicao FROM pagamentos WHERE id = $id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $pagamentos = $result->fetch_assoc();
    } else {
        echo "Tipo de pagamento não encontrado!";
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
    <link rel="stylesheet" href="../css/pagamentos.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <h1>Editar Formas de Pagamento</h1>
</head>

</html>

<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $pagamentos['id']; ?>">
    Tipo: <input type="text" name="tipo" value="<?php echo $pagamentos['tipo']; ?>"><br>
    Condição de Pagamento: <input type="text" name="condicao" value="<?php echo $pagamentos['condicao']; ?>"><br>
    <input type="submit" value="Salvar">
</form>