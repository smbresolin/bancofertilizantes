<!DOCTYPE html>
<html lang="pt-BR">
<?php
include '../layout/header.php';
?>

<head>
    <link rel="stylesheet" href="../css/pagamentos.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <h1>Cadastro de Forma de Pagamento</h1>
</head>

</html>

<form method="post" action="adicionar.php">
    Tipo: <input type="text" name="tipo"><br>
    Condição de Pagamento: <input type="text" name="condicao"><br>
    <input type="submit" value="Adicionar">
</form>

<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    $condicao = $_POST['condicao'];

    $sql =
        "INSERT INTO
        Pagamentos (tipo, condicao)
    VALUES
        ('$tipo', '$condicao')
    ";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro: " . $conexao->error;
    }
}

$conexao->close();
?>