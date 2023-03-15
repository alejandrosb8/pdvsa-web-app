<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <title>Mediciones de válvulas PSI de PDVSA</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>

<body>
    <main class="container">
        <h1>Ingreso de mediciones de válvulas PSI</h1>

        <form id="formulario_mediciones">
            <label for="pozo">Pozo:</label>
            <input type="text" name="pozo" id="pozo" required>
            <label for="valor_psi">Valor PSI:</label>
            <input type="number" name="valor_psi" id="valor_psi" required>
            <label for="fecha_hora">Fecha y hora:</label>
            <input type="date" name="fecha_hora" id="fecha_hora" required>
            <button type="submit">Guardar medición</button>
        </form>
        <a href="historial.php">Ver historial de mediciones</a>
        <div id="mensaje"></div>
    </main>
    <script>
        $(document).ready(function() {
            $("#formulario_mediciones").submit(function(event) {
                event.preventDefault(); // prevenir el envío del formulario
                var pozo = $("#pozo").val();
                var valor_psi = $("#valor_psi").val();
                var fecha_hora = $("#fecha_hora").val();
                $.ajax({
                    type: "POST",
                    url: "procesar.php",
                    data: {
                        pozo: pozo,
                        valor_psi: valor_psi,
                        fecha_hora: fecha_hora
                    },
                    success: function(resultado) {
                        $("#mensaje").html(resultado);
                        $("#formulario_mediciones")[0].reset();
                    }
                });
                return false; // evitar que se propague el evento submit
            });
        });
    </script>
</body>

</html>