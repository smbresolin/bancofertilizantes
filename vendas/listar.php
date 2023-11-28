<?php

include '../conexao.php';
$limite = 10;
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $limite;

$sql_vendas = "SELECT 
            v.id, 
            v.data_venda AS 'data',
            v.cliente, 
            v.vendedor, 
            p.nome AS produto_nome,  
            tp.tipo AS pagamento_nome,  
            v.criado_em, 
            c.nome AS clientes_nome,
            vd.nome AS vendedor_nome
        FROM vendas as v
        LEFT JOIN clientes as c ON v.cliente = c.id
        LEFT JOIN vendedores as vd ON v.vendedor = vd.id
        LEFT JOIN produtos as p ON v.produto = p.id  
        LEFT JOIN pagamentos as tp ON v.pagamento = tp.id  
        LIMIT $inicio, $limite
        ";
$result = $conexao->query($sql_vendas);
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
    <title>Vendas realizadas</title>
</head>

<body>
    <h1>Vendas</h1>
    <a href="adicionar.php">Adicionar Nova Venda</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data da Venda</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Produto</th>
                <th>Pagamento</th>
                <th>Criado em</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($row["data"])) . "</td>";
                    echo "<td>" . $row["clientes_nome"] . "</td>";
                    echo "<td>" . (isset($row["vendedor_nome"]) ? $row["vendedor_nome"] : '') . "</td>";
                    echo "<td>" . (isset($row["produto_nome"]) ? $row["produto_nome"] : '') . "</td>";
                    echo "<td>" . (isset($row["pagamento_nome"]) ? $row["pagamento_nome"] : '') . "</td>";
                    echo "<td>" . date('d/m/Y H:i:s', strtotime($row["criado_em"])) . "</td>";
                    echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | 
                    <a class='deletar' href='deletar.php?id=" . $row["id"] . "'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Sem vendas registradas</td></tr>";
            }
            ?>
        </tbody>
        <div class="pagination">
            <?php
            $total = "SELECT COUNT(id) AS total FROM vendas";
            $result = $conexao->query($total);
            $row = $result->fetch_assoc();
            $paginas = ceil($row['total'] / $limite);

            for ($i = 1; $i <= $paginas; $i++) {
                if ($i == $pagina) {
                    echo "<strong>$i</strong> ";
                } else {
                    echo "<a href='listar.php?pagina=$i'>$i</a> ";
                }
            }
            ?>
            <div>
    </table>
</body>

</html>


<?php $conexao->close(); ?>