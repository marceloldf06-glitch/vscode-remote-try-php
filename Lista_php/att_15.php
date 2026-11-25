<?php

$host = "127.0.0.1";
$port = "3306";
$banco = "mariadb";
$usuario = "mariadb";
$senha = "mariadb";
$mensagem = "";
try {
    $pdo = new PDO(
    "mysql:host=$host;port=$port;dbname=$banco;charset=utf8mb4",
    $usuario,
    $senha
);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefone VARCHAR(20) NOT NULL
)";
$pdo->exec($sql);
} catch (PDOException $e) {
die("Erro na conexão: " . $e->getMessage());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = trim($_POST["telefone"] ?? "");
    if (empty($nome) || empty($email) || empty($telefone)) {
        $mensagem = "Preencha todos os campos!";
    }else {
        try {
            $sql = "INSERT INTO usuarios (nome, email, telefone)
            VALUES (:nome, :email, :telefone)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":nome" => $nome,
                ":email" => $email,
                ":telefone" => $telefone
            ]);
            $mensagem = "Usuário cadastrado com sucesso!";
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar usuário: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <h1>Cadastro de Usuários</h1>
    <p>Preencha os campos abaixo:</p>
    <?php if (!empty($mensagem)): ?>
        <p>
            <strong>
                <?= htmlspecialchars($mensagem) ?>
            </strong>
        </p>
    <?php endif; ?>
    <form method="POST" action="att_15.php">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="telefone">Telefone:</label><br>
        <input type="tel" id="telefone" name="telefone" required>
        <br><br>
        <button type="submit"">Cadastrar</button>
        <button onclick="window.location.href='att_16.php'">Ver tabela</button>
    </form>
</body>
</html>