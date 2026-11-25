<?php

$host = "127.0.0.1";
$port = "3306";
$banco = "mariadb";
$usuario = "mariadb";
$senha = "mariadb";

try {
$pdo = new PDO(
    "mysql:host=$host;port=$port;dbname=$banco;charset=utf8mb4",
    $usuario,
    $senha
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM usuarios ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
die("Erro ao conectar ou consultar o banco: " . $e->getMessage());
}
if (isset($_POST["apagar"])) {
try {
    $sql = "TRUNCATE TABLE usuarios";
    $pdo->exec($sql);
    header("Location: att_16.php");
    exit;
    } catch (PDOException $e) {
    die("Erro ao apagar os registros: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
</head>
<body>
<h1>Usuários Cadastrados</h1>
<?php if (count($usuarios) > 0): ?>
<table border="1" cellpadding="5">
<thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
    </tr>
</thead>
<tbody>
<?php foreach ($usuarios as $user): ?>
    <tr>
        <td>
        <?= htmlspecialchars($user["id"]) ?>
        </td>
        <td>
        <?= htmlspecialchars($user["nome"]) ?>
        </td>
        <td>
        <?= htmlspecialchars($user["email"]) ?>
        </td>
        <td>
        <?= htmlspecialchars($user["telefone"]) ?>
        </td>
        </tr>
        <?php endforeach; ?>
</tbody>
    </table>
    <?php else: ?>
    <p>Nenhum usuário cadastrado. A tabela está vazia!</p>
    <?php endif; ?>
    <br>
    <button onclick="window.location.href='att_15.php'">Voltar para o cadastro</button>
    <form method="POST">
    <button type="submit" name="apagar">
        Apagar todos os usuários
    </button>
</form>
</body>
</html>