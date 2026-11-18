<?php
session_start();
if (isset($_POST['sair'])) {
    session_unset();
    session_destroy();
    header("Location: att_14-1.php");
    exit();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: att_14-1.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
</head>
<body>
    <h1>Bem-vindo ao sistema!</h1>
    <p>
        Usuário <strong>
        <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </strong>, você está logado!
    </p>
    <form method="POST">
        <button type="submit" name="sair">
            Encerrar Sessão
        </button>
    </form>
</body>
</html>
