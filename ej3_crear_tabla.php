<?php
$servername = "localhost";
$port = 3306;
// MAC
//$port = 8889;
$username = "david";
$password = "12345678";
$dbname = "ejercicios_html_php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
  die("Falló la conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// sql to create table
$sql = "CREATE TABLE ejercicio3 (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    apellidos VARCHAR(60) NOT NULL,
    correo VARCHAR(60),
    fecha_nacimiento DATE,
    usuario VARCHAR(60),
    rol VARCHAR(30),
    color_favorito VARCHAR(30),
    contraseña VARCHAR(60)
)";

if ($conn->query($sql) === TRUE) {
  echo "Tabla creada con éxito";
} else {
  echo "Error creando la tabla: " . $conn->error;
}

$conn->close();
?>