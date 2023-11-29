<?php
include '../conexao.php';

$sql = "SELECT id, nome, cpf, email, endereco, telefone, criado_em, atualizado_em  FROM vendedores";
$result = $conexao->query($sql);
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
    <title>Vendedores Cadastrados</title>
</head>

<body>
    <h1>Vendedores</h1>
    <a href="adicionar.php">Adicionar Novo Vendedor</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["cpf"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["endereco"] . "</td>";
                    echo "<td>" . $row["telefone"] . "</td>";
                    echo "<td>" . date('d/m/Y H:i:s', strtotime($row["criado_em"])) . "</td>";
                    echo "<td>" . date('d/m/Y H:i:s', strtotime($row["atualizado_em"])) . "</td>";
                    echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a class='deletar' href='deletar.php?id=" . $row["id"] . "'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Sem vendedores cadastrados</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
$conexao->close();
?>