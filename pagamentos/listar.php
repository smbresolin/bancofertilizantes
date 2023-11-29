<?php
include '../conexao.php';

$sql = "SELECT id, tipo, condicao, criado_em, atualizado_em  FROM pagamentos";
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
    <title>Formas de Pagamento</title>
</head>

<body>
    <h1>Formas de Pagamento</h1>
    <a href="adicionar.php">Adicionar Novo Pagamento</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Condição de Pagamento</th>
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
                    echo "<td>" . $row["tipo"] . "</td>";
                    echo "<td>" . $row["condicao"] . "</td>";
                    echo "<td>" . date('d/m/Y H:i:s', strtotime($row["criado_em"])) . "</td>";
                    echo "<td>" . date('d/m/Y H:i:s', strtotime($row["atualizado_em"])) . "</td>";
                    echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> |<a class='deletar' href='deletar.php?id=" . $row["id"] . "'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Sem formas de pagamento cadastradas</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
$conexao->close();
?>