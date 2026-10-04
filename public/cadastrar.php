<?php
require "../infra/conexao.php";

$erros = [];
$nome = "";
$categoria = "";
$descricao = "";
$preco = "";
$quantidade = "";
$data_validade = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
        $stmt = $conn->prepare("INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, data_validade) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssds", $nome, $categoria, $descricao, $preco, $quantidade, $data_validade);

        $preco_float = (float)$preco;
        $qtd_int = (int)$quantidade;
        $stmt->bind_param("sssdis", $nome, $categoria, $descricao, $preco_float, $qtd_int, $data_validade);]

        if ($stmt->execute()) {
            header("Location: listar-produto.php");
            exit;
        } else {
            $erros[] = "Erro ao cadastrar o produto: " . $stmt->error;
            }
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
</head>
<body>

    <h2>Cadastrar Produto</h2>
    <?php if (count($erros) > 0) { ?>
        <ul style="color: red;">
            <?php foreach ($erros as $erro) { ?>
                <li><?php echo $erro; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    form method="POST" action="">
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

        <input type="submit" value="Cadastrar">
    
</body>
    </html>