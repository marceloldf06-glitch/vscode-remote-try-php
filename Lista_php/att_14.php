<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario'])) {
    header("Location: principal.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Usuário e senha previamente definidos
    if ($usuario == "admin" && $senha == "1234") {

        $_SESSION['usuario'] = $usuario;

        header("Location: principal.php");
        exit;

    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="container">
    <h2>Login do Sistema</h2>

    <form method="POST" action="">
        <label>Usuário:</label>
        <input type="text" name="usuario" required>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <button type="submit">Entrar</button>
    </form>

    <p class="erro">
        <?php echo $erro; ?>
    </p>
</div>

</body>
</html>

3. Arquivo principal.php – Tela principal
Essa página verifica se existe uma sessão aberta. Caso não exista, o usuário será direcionado novamente para a tela de login.


php

<?php
session_start();

// Verifica se existe uma sessão aberta
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="container">
    <h1>Bem-vindo!</h1>

    <h2>Você está logado no sistema.</h2>

    <p>
        Usuário conectado:
        <strong>
            <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </strong>
    </p>

    <form method="POST" action="logout.php">
        <button type="submit" class="sair">
            Encerrar Sessão
        </button>
    </form>
</div>

</body>
</html>

4. Arquivo logout.php – Encerrar sessão
Esse arquivo destrói a sessão e retorna o usuário para a tela de login.


php

<?php
session_start();

// Limpa todas as variáveis da sessão
session_unset();

// Destrói a sessão
session_destroy();

// Retorna para a tela de login
header("Location: index.php");
exit;
?>

5. Arquivo estilo.css – Estilização

css

body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 0;

    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: white;
    padding: 35px;
    width: 350px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
    text-align: center;
}

h1, h2 {
    color: #333;
}

label {
    display: block;
    text-align: left;
    margin-top: 15px;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}

.sair {
    background-color: #dc3545;
}

.sair:hover {
    background-color: #a71d2a;
}

.erro {
    color: red;
    margin-top: 15px;
}