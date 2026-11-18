<?php

$host = "mariadb";
$banco = "cadastro";
$usuario = "mariadb";
$senha = "mariadb";
$mensagem = "";
try {
    $pdo = new PDO(
        "mysql:host=$host;charset=utf8mb4",
        $usuario,
        $senha
    );
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    $pdo->exec("CREATE DATABASE IF NOT EXISTS cadastro");
    $pdo->exec("USE cadastro");
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL,
            telefone VARCHAR(20) NOT NULL
        )
    ");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = trim($_POST["nome"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $telefone = trim($_POST["telefone"] ?? "");
        if (
            $nome == "" ||
            $email == "" ||
            $telefone == "" ||
            !filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {
            $mensagem = "Preencha todos os campos corretamente!";
        } else {

            $sql = "INSERT INTO usuarios
                    (nome, email, telefone)
                    VALUES
                    (:nome, :email, :telefone)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':telefone' => $telefone
            ]);
            $mensagem = "Usuário cadastrado com sucesso!";
        }
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    $mensagem = "Erro ao conectar ou cadastrar no banco de dados.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <h2>Cadastro de Usuários</h2>
    <?php if ($mensagem != ""): ?>
        <p>
            <?php echo htmlspecialchars($mensagem); ?>
        </p>
    <?php endif; ?>
    <form method="POST" action="">
        <label>Nome:</label>
        <br>
        <input
            type="text"
            name="nome"
            required
        >
        <br><br>

        <label>E-mail:</label>
        <br>
        <input
            type="email"
            name="email"
            required
        >
        <br><br>

        <label>Telefone:</label>
        <br>
        <input
            type="tel"
            name="telefone"
            required
        >
        <br><br>
        <button type="submit">
            Cadastrar Usuário
        </button>
    </form>
</body>
</html>