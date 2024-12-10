<?php
    if (isset($_POST['slider_temp'])){
        $celsius = floatval($_POST['slider_temp']);
        echo "Temperatura (ºC): " . $_POST['slider_temp'] . "<br>";
        $kelvin = $celsius + 273.15;
        echo "Temperatura (ºK): " . $kelvin . "<br>";
        $fahrenheit = ($celsius * 9 / 5) + 32;
        echo "Temperatura (ºF): " . $fahrenheit;
    }

?>
