
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login do Sistema</h2>
    <form method="POST">
        <label>Usuário:</label>
        <input type="text" name="usuario" required>
        <br><br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br><br>
        <button type="submit" name="entrar">Entrar</button>
    </form>

</body>
</html>
<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: att_14-2.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['entrar'])) {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        if ($usuario == "a" && $senha == "a") {
            $_SESSION['usuario'] = $usuario;
            header("Location: att_14-2.php");
            exit();
        }
    }
}
?>
