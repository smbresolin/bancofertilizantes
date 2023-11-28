<?php
include '../conexao.php';

$sql = "SELECT id, nome, unidade_venda, preco_unitario, criado_em, atualizado_em  FROM produtos";
$result = $conexao->query($sql);
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
    <title>Produtos Disponíveis para Venda</title>
</head>

<body>

    <h1>Produtos</h1>
    <a href="adicionar.php">Adicionar Novo Produto</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Unidade de Venda</th>
                <th>Preço Unitário</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["unidade_venda"] . "</td>";
                    echo "<td>" . $row["preco_unitario"] . "</td>";
                    echo "<td>" . date('d/m/Y H:i:s', strtotime($row["criado_em"])) . "</td>";
                    echo "<td>" . date('d/m/Y H:i:s', strtotime($row["atualizado_em"])) . "</td>";
                    echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a href='deletar.php?id=" . $row["id"] . "'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Sem produtos cadastrados</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
$conexao->close();
?>