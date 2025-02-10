<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultado registro</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
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
        $conn->set_charset("utf8mb4");
        $sqlSelect = "SELECT usuario FROM ejercicio3 WHERE usuario = ?";
        $stmtSelect = $conn->prepare( $sqlSelect );
        $stmtSelect->bind_param("s", $_POST["usuario"]);
        $stmtSelect->execute();
        $resSelect = $stmtSelect->get_result();

        if( $resSelect->num_rows == 0 ){
            // Prepared statement -> https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            $sqlInsert = "INSERT INTO ejercicio3 (nombre, apellidos, correo, fecha_nacimiento, usuario, rol, color_favorito, contraseña)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
            $hash = password_hash( $_POST["contraseña"], PASSWORD_BCRYPT );
    
            $stmtInsert = $conn->prepare( $sqlInsert );
            $stmtInsert->bind_param("ssssssss", $_POST["nombre"], $_POST["apellidos"], $_POST["correo"], $_POST["fecha_nacimiento"], $_POST["usuario"], $_POST["rol"], $_POST["color_favorito"], $hash);
            $resInsert = $stmtInsert->execute();
        }

    ?>

    <?php if( $resSelect->num_rows > 0 ){?>
        <div class="mensaje advertencia">
            <p>El usuario ya existe</p>
        </div>
    <?php } elseif( $resSelect->num_rows == 0 && $resInsert ){ ?>
        <div class="mensaje exito">
            <p>Registrado con éxito</p>
        </div>
    <?php } else{ ?>
        <div class="mensaje error">
            <p>Ha ocurrido algo raro</p>
        </div>
    <?php }?>

    <?php
        $stmt->close();
        $conn->close();
    ?>

    </body>
</html>
