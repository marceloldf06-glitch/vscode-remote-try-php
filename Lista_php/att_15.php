<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE myDB; USE myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}
$sql = "CREATE TABLE usuarios(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY;
nome VARCHAR(30) NOT NULL;
email VARCHAR(30) NOT NULL;
telefone VARCHAR(30) NOT NULL;
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
    Nome: <input type="text" name="nome"><br>
    E-mail: <input type="text" name="email"><br>
    Telefone: <input type="text" name="telefone"><br>
<input type="submit">
</form>
</body>
</html>

<?php

if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone'])){
$nome = $_POST['nome'];
$email = $_POST['email'];
$tele = $_POST['telefone'];
$s = "INSERT INTO usuarios (nome, email, telefone)
VALUES ($nome, $email, $tele)";
if ($conn->query($s) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>