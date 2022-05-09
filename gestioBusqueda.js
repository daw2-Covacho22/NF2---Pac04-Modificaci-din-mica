$(document).ready(function() {
    $("#barra_cercador").keyup(suma);
    $("#barra_cercador").keyup(buscar);

    $("#submit").click(input);

});


//Autocompletado
function buscar() {
    var textBusqueda = $("#barra_cercador").val();
    $.ajax({
        type: "POST",
        url: "test.php",
        data: {
            'palabra': textBusqueda,
            dataType: "JSON",
        },
        success: function(data) {
            console.log(data);
            var cont = 0;
            for (var i = 1; i <= Object.keys(data).length; i++) {
                var palabra = document.getElementById('browsers').option[cont++].value = data[cont++];
            }
        }
    });
}






function input() {
    var textBusqueda = $("#barra_cercador").val();
    $.ajax({
        type: "POST",
        url: "test.php",
        data: {
            'submit': textBusqueda,
            dataType: "JSON",
        },
        success: function(data) {
            var tabla = "<link><div class='dropdown'>";
            tabla += "<table cellpadding=5 width=270>";
            tabla += "<tr class='trdesplegable'>";
            tabla += "<th class='desplegable'>Id</th>";
            tabla += "<th class='desplegable'>Paraula</th>";
            tabla += "<th class='desplegable'>Total</th>";
            tabla += "<th class='desplegable'>Ultima visita</th></tr>";
            var cont = 0;
            for (var i = 0; i < Object.keys(data).length; i++) {
                tabla += "<tr><td>" + data[cont++] + "</td><td>" + data[cont++] + "</td><td>" + data[cont++] + "</td><td>" + data[cont++] + "</td></tr>";
                i = i + 3;
            }
            tabla += "</table>";
            $("#resultat").html(tabla);
            console.log(Object.keys(data).length);
        }
    });
}