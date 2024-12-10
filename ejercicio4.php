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
        die("Connection failed: " . $conn->connect_error);
    }

    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    // hacer un select para obtener la contraseña hash del usuario

    $sql = "SELECT contraseña, nombre, apellidos FROM ejercicio3 WHERE usuario = ?";
    $stmt = $conn->prepare( $sql );
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $fila = $result->fetch_assoc();
    $hash = $fila["contraseña"];

    $conn->close();


    if( password_verify( $contraseña, $hash ) ){
        echo "Bienvenido, " . $fila["nombre"] . " " . $fila["apellidos"];
    } else{
        echo "Login INCORRECTO";
    }

?>