<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <title>Historial de mediciones de válvulas PSI de PDVSA</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>

<body>
    <main class="container">
        <div class="headings">
            <h1>Historial de mediciones de válvulas PSI</h1>
            <a href="index.php">Agregar medición</a>
        </div>

        <form id="formulario_fechas">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" required>
            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" name="fecha_fin" id="fecha_fin" required>
            <button type="submit">Mostrar historial</button>
        </form>
        <table id="tabla_mediciones">
            <thead>
                <tr>
                    <th>Pozo</th>
                    <th>Valor PSI</th>
                    <th>Fecha y hora</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se mostrarán las mediciones del historial -->
            </tbody>
        </table>
        <canvas id="grafica_mediciones"></canvas>
    </main>
    <script>
        $(document).ready(function() {
            $("#formulario_fechas").submit(function(event) {
                event.preventDefault(); // prevenir el envío del formulario
                var fecha_inicio = $("#fecha_inicio").val();
                var fecha_fin = $("#fecha_fin").val();
                $.ajax({
                    type: "POST",
                    url: "obtener_datos.php",
                    data: {
                        fecha_inicio: fecha_inicio,
                        fecha_fin: fecha_fin
                    },
                    success: function(datos) {
                        // Parsear los datos JSON recibidos de la página obtener_datos.php
                        var datos_json = datos;

                        // Crear arrays para almacenar los valores de las mediciones y las fechas
                        var valores_psi = [];
                        var fechas = [];

                        // Llenar los arrays con los datos recibidos
                        for (var i = 0; i < datos_json.length; i++) {
                            valores_psi.push(datos_json[i].valor_psi);
                            fechas.push(datos_json[i].fecha_hora);
                        }

                        // Generar la gráfica con los datos recibidos
                        var grafica_mediciones = new Chart($("#grafica_mediciones"), {
                            type: 'line',
                            data: {
                                labels: fechas,
                                datasets: [{
                                    label: 'Mediciones de válvulas PSI',
                                    data: valores_psi,
                                    borderColor: 'rgb(75, 192, 192)',
                                    fill: false
                                }]
                            }
                        });

                        // Limpiar la tabla de mediciones anterior
                        $("#tabla_mediciones tbody").empty();

                        // Llenar la tabla con los datos recibidos
                        for (var i = 0; i < datos_json.length; i++) {
                            $("#tabla_mediciones tbody").append("<tr><td>" + datos_json[i].pozo + "</td><td>" +
                                datos_json[i].valor_psi + "</td><td>" +
                                datos_json[i].fecha_hora + "</td></tr>");
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>