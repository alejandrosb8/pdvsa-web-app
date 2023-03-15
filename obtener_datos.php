<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "id20454896_root";
$password = "T5UbCfeN}jGMEYC";
$dbname = "id20454896_pdvsa_db";

// Creación de la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificación de la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Obtención de los datos de las mediciones
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];

$sql = "SELECT * FROM mediciones WHERE fecha_hora BETWEEN '$fecha_inicio' AND '$fecha_fin'";
$resultado = $conn->query($sql);

// Creación del array de datos para la respuesta JSON
$datos = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = array(
            "pozo" => $fila["pozo"],
            "valor_psi" => $fila["valor_psi"],
            "fecha_hora" => $fila["fecha_hora"]
        );
    }
}

// Conversión del array a formato JSON y envío de la respuesta
header("Content-type: application/json");
echo json_encode($datos);

// Cierre de la conexión a la base de datos
$conn->close();
