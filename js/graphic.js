/*Debido a que el documento tarda más en carcar el recuento de resultadoFinal
que la api en dibujar, e puesto los valores para la api vacíos para 
que no pueda dibujar hasta que cargue las variables necesarias del documento
"respuesta.json"*/

let resultadoFinal = [];
var data = {};
var config = {}
var myChart = {};

function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}

readTextFile("./respuestas.json", function(text){
    var datos = JSON.parse(text); 
    resultadoFinal[0] = datos[0];
    resultadoFinal[1] = datos[1];
    resultadoFinal[2] = datos[2];

    data = {
        labels: [
            'Aciertos',
            'Fallos',
            'Sin contestar'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: resultadoFinal,
            backgroundColor: [
            'rgb(207, 255, 136)',
            'rgb(255, 134, 134)',
            'rgb(204, 200, 200)'
            ],
            hoverOffset: 4
        }]
    };
        
        
    config = {
        type: 'doughnut',
        data: data,
    };
    
    myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
});