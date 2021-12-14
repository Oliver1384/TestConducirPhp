<?php

function generateTest($preguntas, $resultados, $respuestas) {
    $ruta = "./img/*.jpg";
    $imagenes = glob($ruta);
    $html = '';   
    for ($j = 0; $j < count($preguntas); $j++){
        $resultadoActual = $resultados[$j];
        $numero = $preguntas[$j]['num'];
        $imagen = $imagenes[$j];
        $preguntaActual = $preguntas[$j]['pregunta'];
        $indiceRespuesta = "respuesta_".$j+1;
        $respuestaActual =  $respuestas[$indiceRespuesta];
        $html .= "<div class='test'>
                   <img src=\"$imagen\" title=\"Imagen\">
                    <div class=\"pregunta\"> 
                        <span>$numero.</span>
                            $preguntaActual
                        <ul>";
        
        if (!isset($respuestas[$indiceRespuesta])){
            foreach ($preguntas[$j]['opciones'] as $clave=>$opcion) {
                $html .= "<li class=\"opcion\">
                            <input type=\"radio\" name='respuesta_$numero' value=\"$clave\">\n
                            $opcion
                          </li>";
            } 
        } else {
            $i = 0;
            foreach ($preguntas[$j]['opciones'] as $clave=>$opcion) {  
                $html .= "<li class=\"opcion\">
                            <input type=\"radio\" name='respuesta_$numero' value=\"$clave\"";
                            if ($i == $respuestaActual){
                                $html .= "checked";
                            }
                            $html .= ">\n 
                                     $opcion
                                    </li>";
                $i++;
            }                         
        }
        $html .=        "</ul>
                        $resultadoActual
                    </div>
                </div>";
    }
    return $html;
}


function comprobarRespuesta($respuestas, $preguntas){
    $resultados = [];
    //aciertos, fallos, vacio
    $cuentaResultados = [0,0,0];
    for ($k = 1; $k <= count($preguntas); $k++){
        if (isset($respuestas["respuesta_".$k])){
            $respuestaCorrecta = $preguntas[$k-1]["opciones"][ $preguntas[$k-1]["respuesta"]];
            if($respuestas["respuesta_$k"] == $preguntas[$k-1]["respuesta"]){
                $resultados [$k-1] = "<p class='green'>La respuesta es correcta</p>";
                $cuentaResultados[0]++;
            } else {
                $resultados [$k-1] = "<p class='red'>La respuesta es incorrecta, la correcta es <span class='green'>$respuestaCorrecta</span></p>";
                $cuentaResultados[1]++;
            }
        } else {
            $resultados [$k-1] = "";
            $cuentaResultados[2]++;
        }
    }
    $resultados[] = $cuentaResultados;
    return $resultados;
}

function calcularPorcentajeRecuento($resultados){
    $recuento = $resultados[count($resultados)-1];
    $total = $recuento[0] + $recuento[1] + $recuento[2];
    $porcentajeAciertos = ($recuento[0]/$total)*100;
     if ($porcentajeAciertos < 50 && $recuento[2] != $total) {
        $resultadoAlerta = "<script type =\"text/JavaScript\">
                                    alert('Debe mejorar un poco');
                            </script>";
    } 
    return $resultadoAlerta;
}
