<?php
require "../infra/conexao.php";

$erros = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nome = trim($_POST['nome']);
    $categoria = trim($_POST['categoria']);
    $descricao = trim($_POST['descricao']);
    $preco = trim($_POST['preco']);
    $quantidade = trim($_POST['quantidade']);
    $data_validade = trim($_POST['data_validade']);

    if ($nome === "") {
        $erros[] = "O campo 'Nome' é obrigatório.";
    }

    if ($categoria === "") {
        $erros[] = "O campo 'Categoria' é obrigatório.";
    }

    if ($descricao === "") {
        $erros[] = "O campo 'Descrição' é obrigatório.";
    }

    if ($preco === "") {
        $erros[] = "O campo 'Preço' é obrigatório.";
    } else if (!is_numeric($preco) || $preco < 0) {
        $erros[] = "O campo 'Preço' deve ser um número não negativo.";
    }

    if ($quantidade === "") {
        $erros[] = "O campo 'Quantidade' é obrigatório.";
    } else if (!is_numeric($quantidade) || $quantidade < 0) {
        $erros[] = "O campo 'Quantidade' deve ser um número não negativo.";
    }

    if ($data_validade === "") {
        $erros[] = "O campo 'Data de Validade' é obrigatório.";
    }

    if (count($erros) === 0) {
        $stmt = ("UPDATE produtos SET nome=?, categoria=?, descricao=?, preco=?, quantidade=?, data_validade=? WHERE id=?");
        $stmt = $conn->prepare($sql);

        $preco_float = (float)$preco;
        $qtd_int = (int)$quantidade;
        $stmt->bind_param("sssdisi", $nome, $categoria, $descricao, $preco_float, $qtd_int, $data_validade, $id);

        if ($stmt->execute()) {
            header("Location: listar-produto.php");
            exit;
        } else {
            $erros[] = "Erro ao atualizar o produto: " . $stmt->error;
        }
    } else {
      $id = isset($get['id']) ? (int) $_GET['id'] : 0;

      $produto = $stmt->get_result()->fetch_assoc();
      if (!$produto) {
        header("Location: listar-produto.php");
        exit;
        }

    $nome = $produto['nome'];
    $categoria = $produto['categoria'];
    $descricao = $produto['descricao'];
    $preco = $produto['preco'];
    $quantidade = $produto['quantidade'];
    $data_validade = $produto['data_validade'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>

    <h2>Editar Produto</h2>
    <?php if (count($erros) > 0) { ?>
        <ul style="color: red;">
            <?php foreach ($erros as $erro) { ?>
                <li><?php echo $erro; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>"><br><br>

        <label for="categoria">Categoria:</label>
        <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($categoria); ?>"><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($descricao); ?></textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" value="<?php echo htmlspecialchars($preco); ?>"><br><br>

        <label for="quantidade">Quantidade:</label>
        <input type="text" id="quantidade" name="quantidade" value="<?php echo htmlspecialchars($quantidade); ?>"><br><br>

        <label for="data_validade">Data de Validade:</label>
        <input type="date" id="data_validade" name="data_validade" value="<?php echo htmlspecialchars($data_validade); ?>"><br><br>

        <input type="submit" value="Atualizar">
        <a href="listar-produto.php">Voltar</a>
    </form>

</body>
</html>