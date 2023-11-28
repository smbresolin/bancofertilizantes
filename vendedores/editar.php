<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE vendedores SET nome = '$nome', cpf = '$cpf', email = '$email', 
        endereco = '$endereco', telefone = '$telefone' WHERE id = $id";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, nome, cpf, email, endereco, telefone FROM vendedores WHERE id = $id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $vendedores = $result->fetch_assoc();
    } else {
        echo "Vendedor não encontrado!";
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
    <link rel="stylesheet" href="../css/vendedores.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <h1>Editar Cadastro de Vendedor</h1>
</head>

</html>

<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $vendedores['id']; ?>">
    Nome: <input type="text" name="nome" value="<?php echo $vendedores['nome']; ?>"><br>
    CPF: <input type="text" name="cpf" value=<?php echo $vendedores['cpf']; ?>><br>
    E-mail: <input type="email" name="email" value=<?php echo $vendedores['email']; ?>><br>
    Endereço: <input type="text" name="endereco" value=<?php echo $vendedores['endereco']; ?>><br>
    Telefone: <input type="text" name="telefone" value=<?php echo $vendedores['telefone']; ?>><br>
    <input type="submit" value="Salvar">
</form>