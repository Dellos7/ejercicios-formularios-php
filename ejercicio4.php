<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultado login</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        body{
            text-align: center;
        }
        table{
            margin: 0 auto;
        }
        th, td{
            padding: 10px 15px;
        }
    </style>
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

    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    // hacer un select para obtener la contraseña hash del usuario

    $sql = "SELECT contraseña, nombre, apellidos, color_favorito, correo, fecha_nacimiento, usuario, rol FROM ejercicio3 WHERE usuario = ?";
    $stmt = $conn->prepare( $sql );
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $fila = $result->fetch_assoc();
    $hash = $fila["contraseña"];

    $conn->close();
?>

<?php if( password_verify( $contraseña, $hash ) ){ ?>
    <h2>Bienvenido, <?=$fila["nombre"] . " " . $fila["apellidos"]?></h2>
    <hr>
    <table>
        <tr>
            <th>Correo</th>
            <td><?=$fila["correo"]?></td>
        </tr>
        <tr>
            <th>Fecha nacimiento</th>
            <td><?=$fila["fecha_nacimiento"]?></td>
        </tr>
        <tr>
            <th>Usuario</th>
            <td><?=$fila["usuario"]?></td>
        </tr>
        <tr>
            <th>Rol</th>
            <td><?=$fila["rol"]?></td>
        </tr>
    </table>
    <script>
        document.getElementsByTagName("html")[0].style.backgroundColor = "<?=$fila["color_favorito"]?>";
    </script>
<?php } else{ ?>
    <div class="mensaje error">
        <p>Login incorrecto</p>
    </div>
<?php }?>

</body>
</html>