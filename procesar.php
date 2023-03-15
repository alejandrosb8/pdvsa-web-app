<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "id20454896_root", "T5UbCfeN}jGMEYC", "id20454896_pdvsa_db");

// Comprobar la conexión
if (mysqli_connect_errno()) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Recibir los datos del formulario
$pozo = $_POST["pozo"];
$valor_psi = $_POST["valor_psi"];
$fecha_hora = $_POST["fecha_hora"];

// Insertar los datos en la base de datos
$sql = "INSERT INTO mediciones (pozo, valor_psi, fecha_hora) VALUES ('$pozo', $valor_psi, '$fecha_hora')";
if (mysqli_query($conexion, $sql)) {
    echo "La medición ha sido guardada exitosamente.";
} else {
    echo "Error al guardar la medición: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

exit();
