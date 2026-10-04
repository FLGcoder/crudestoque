<?php
require "../infra/conexao.php";

$sql = "SELECT id, nome, categoria, descricao, preco, quantidade, data_validade FROM produtos ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestao de Estoque</title>
</head>
<body>

    <h1>Produtos no Estoque</h1>

    <p><a href="cadastrar.php">Cadastrar Novo Produto</a></p>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Descricao</th>
                <th>Preco</th>
                <th>Estoque</th>
                <th>Validade</th>
                <th>Acoes</th>
            </tr>
        </thead>>
        <tbody>
            <?php if ($result->num_rows > 0): { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($row['preco']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantidade']); ?></td>
                        <td><?php echo htmlspecialchars($row['data_validade']); ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a> |
                            <a href="excluir.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else {: ?>
                <tr>
                    <td colspan="8">Nenhum produto encontrado.</td>
                </tr>
            <?php } ?>
    </table>
    
</body>
</html>