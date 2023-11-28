<!DOCTYPE html>
<html lang="pt-BR">
<?php
include '../layout/header.php';
?>

<head>
    <link rel="stylesheet" href="../css/vendedores.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <h1>Cadastro de Vendedores</h1>
</head>

</html>

<form method="post" action="adicionar.php">
    Nome: <input type="text" name="nome"><br>
    CPF: <input type="text" name="cpf"><br>
    E-mail: <input type="email" name="email"><br>
    Endereço: <input type="text" name="endereco"><br>
    Telefone: <input type="text" name="telefone"><br>
    <input type="submit" value="Adicionar">
</form>

<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    $sql =
        "INSERT INTO
        Vendedores (nome, cpf, email, endereco, telefone)
    VALUES
        ('$nome', '$cpf', '$email', '$endereco', '$telefone')
    ";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro: " . $conexao->error;
    }
}

$conexao->close();
?>