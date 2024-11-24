<?php
// Verificar si los parámetros necesarios están presentes
if (isset($_POST['nombre']) && isset($_POST['edad'])) {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']); // Sanitizar la entrada para evitar inyección de HTML
    $edad = intval($_POST['edad']); // Convertir la edad a un número entero

    // Procesar los datos (en este caso, simplemente los mostramos)
    echo "<h1>Datos recibidos:</h1>";
    echo "<p>Nombre: $nombre</p>";
    echo "<p>Edad: $edad años</p>";

    // Ejemplo de lógica adicional
    if ($edad >= 18) {
        echo "<p>Eres mayor de edad.</p>";
    } else {
        echo "<p>Eres menor de edad.</p>";
    }
} else {
    // Mostrar un mensaje si no se enviaron los datos
    echo "<h1>Error:</h1>";
    echo "<p>No se enviaron todos los datos necesarios.</p>";
}
?>
