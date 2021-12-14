<?php
    //agrega todas las funciones 
    include "funciones.php";

    //importa las preguntas del archivo json y las convierte en un array
    $data = file_get_contents("./preguntas.json"); 
    $preguntas = json_decode($data, true);

    $respuestas = $_POST;
    $resultados = comprobarRespuesta($respuestas, $preguntas, $resultados);
    $testHtml = generateTest($preguntas, $resultados,$respuestas);
    $recuentoResultados = $resultados[count($resultados)-1];
    $alertaResultados = calcularPorcentajeRecuento($resultados);

    //guarda en un json el recuento de resultados
    $cuentaResultadosJson = json_encode($recuentoResultados);
    $myfile = fopen("respuestas.json", "w") or die("Error al acceder a los resultados");
    fwrite($myfile, $cuentaResultadosJson);
    fclose($myfile);

    //acciona la comprobación de las respuestas
    if (isset($_POST['comprobar'])) {
        $resultados = comprobarRespuesta($respuestas, $preguntas, $resultados);
    }
  
    //agrega la vista
    include "vista.php";


   