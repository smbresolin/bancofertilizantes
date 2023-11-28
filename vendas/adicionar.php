<!DOCTYPE html>
<html lang="pt-BR">
<?php
include '../layout/header.php';
?>

<head>
    <link rel="stylesheet" href="../css/vendas.css">
    <link rel="stylesheet" href="../css/header.css">
    <meta charset="UTF-8">
    <h1>Cadastrar nova Venda</h1>
</head>

</html>

<?php
include '../conexao.php';
?>

<body>
    <div class="container">
        <form method="post" action="adicionar.php">
            <label for="data_venda">Data da Venda:</label>
            <input type="date" name="data_venda" id="data_venda"><br>

            <label for="cliente">Cliente:</label>
            <select name="cliente" id="cliente">
                <option value="">Selecione o Cliente</option>
                <?php
                $sql_cliente =
                    "SELECT id, nome 
                            FROM clientes";
                $result_clientes = $conexao->query($sql_cliente);

                while ($row = $result_clientes->fetch_assoc()) {
                    $id = $row['id'];
                    $nome = $row['nome'];
                    echo "<option value='$id'>$nome</option>";
                }
                ?>
            </select><br>

            <label for="vendedor">Vendedor:</label>
            <select name="vendedor" id="vendedor">
                <option value="">Selecione o Vendedor</option>
                <?php
                $sql_vendedor =
                    "SELECT id, nome 
                            FROM vendedores";
                $result_vendedores = $conexao->query($sql_vendedor);

                while ($row = $result_vendedores->fetch_assoc()) {
                    $id = $row['id'];
                    $nome = $row['nome'];
                    echo "<option value='$id'>$nome</option>";
                }
                ?>
            </select><br>

            <label for="pagamento">Pagamento:</label>
            <select name="pagamento" id="pagamento">
                <option value="">Selecione uma forma de pagamento</option>
                <?php
                $sql_pagamento =
                    "SELECT id, tipo, condicao
                            FROM pagamentos";
                $result_pagamentos = $conexao->query($sql_pagamento);

                while ($row = $result_pagamentos->fetch_assoc()) {
                    $id = $row['id'];
                    $tipo = $row['tipo'];
                    $condicao = $row['condicao'];
                    echo "<option value='$id'>$condicao</option>";
                }
                ?>
            </select><br>

            <label for="produto">Produto:</label>
            <select name="produto" id="produto">
                <option value="">Selecione o produto</option>
                <?php
                $sql_produto =
                    "SELECT id, nome 
                            FROM produtos";
                $result_produtos = $conexao->query($sql_produto);

                while ($row = $result_produtos->fetch_assoc()) {
                    $id = $row['id'];
                    $nome = $row['nome'];
                    echo "<option value='$id'>$nome</option>";
                }
                ?>
            </select><br>

            <input type="submit" value="Adicionar">
        </form>
    </div>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_venda = $_POST['data_venda'];
    $cliente = $_POST['cliente'];
    $vendedor = $_POST['vendedor'];
    $produto = $_POST['produto'];
    $pagamento = $_POST['pagamento'];

    $sql_vendas =
        "INSERT INTO vendas (data_venda, cliente, vendedor, produto, pagamento)
            VALUES ('$data_venda', '$cliente', '$vendedor', '$produto', '$pagamento')";
    if ($conexao->query($sql_vendas) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro: " . $conexao->error;
    }
}
$conexao->close();
?>