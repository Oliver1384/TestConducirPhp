<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel = "icon" href ="./img/icon.png" type = "image/x-icon">
    <meta name="description" content="Una app para practicar test de conducir">
    <meta name="keywords" content="CSS, php, js">
    <meta name="author" content="Oliver Artiles Ortega">
    <title>Test de conducir</title>
</head>
<body>
    <div class="contenido">
    <p class="titulo">Test de conducir</p>
    <div class=resultados>
        <section class="recuento">
            <p>Número de aciertos:       <?=$recuentoResultados[0]?></p>
            <p>Número de fallos:         <?=$recuentoResultados[1]?></p>
            <p>Cantidad sin contestar:   <?=$recuentoResultados[2]?></p>
        </section>
        <section class="grafico">
            <canvas  id="myChart"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"> </script>
            <script src="./js/graphic.js"> </script>
        </section>
    </div>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" METHOD="post">
            <?=$testHtml?>
            <div class="buttonDiv">
                <button type="submit" value="comprobar">Comprobar</button>
            </div>
        </form>
    </div>
    <p><?=$alertaResultados?></p>
</body>
</html>