<?php
    print_r($_POST);
    if (isset($_POST['nombre'])){
        $nombre = $_POST["nombre"];
        echo "Nombre: " . $nombre . "<br>";
    }

    $servername = "localhost";
    $port = 8889;
    $username = "david";
    $password = "12345678";
    $dbname = "ejercicios_html_php";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepared statement -> https://www.w3schools.com/php/php_mysql_prepared_statements.asp

    $sql = "INSERT INTO ejercicio3 (nombre, apellidos, correo, fecha_nacimiento, usuario, rol, color_favorito, contraseña)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare( $sql );
    $stmt->bind_param("ssssssss", $_POST["nombre"], $_POST["apellidos"], $_POST["correo"], $_POST["fecha_nacimiento"], $_POST["usuario"], $_POST["rol"], $_POST["color_favorito"], $_POST["contraseña"]);

    $stmt->execute();

    $stmt->close();
    $conn->close();

?>